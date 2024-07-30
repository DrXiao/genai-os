#!/bin/python3
# -#- coding: UTF-8 -*-

import os
import re
import gc
import sys
import logging
import asyncio
import functools
import itertools
import requests
import json
import i18n
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

from typing import Generator
from kuwa.executor import LLMExecutor, Modelfile
from kuwa.executor.modelfile import ParameterDict

from src.docqa import DocQa
from src.kuwa_llm_client import KuwaLlmClient
from src.document_store import DocumentStore

logger = logging.getLogger(__name__)

class NoUrlException(Exception):
    def __init__(self, msg):
        self.msg = msg
    def __str__(self):
        return self.msg

class SearchQaExecutor(LLMExecutor):
    def __init__(self):
        super().__init__()

    def extend_arguments(self, parser):
        parser.add_argument('--num_url', default=3, type=int, help='Search results reference before RAG.')
        
        parser.add_argument('--visible_gpu', default=None, help='Specify the GPU IDs that this executor can use. Separate by comma.')
        parser.add_argument('--lang', default="en", help='The language code to internationalize the aplication. See \'lang/\'')

        search_group = parser.add_argument_group('Search Engine Options')
        search_group.add_argument('--google_api_key', default=None, help='The API key of Google API.')
        search_group.add_argument('--google_cse_id', default=None, help='The ID of Google Custom Search Engine.')
        search_group.add_argument('--advanced_search_params', default='-site:youtube.com -site:facebook.com -site:instagram.com -site:twitter.com -site:threads.net -site:play.google.com -site:apps.apple.com -site:www.messenger.com', help='Advanced search parameters')
        
        crawler_group = parser.add_argument_group('Crawler Options')
        crawler_group.add_argument('--user_agent', default="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36",
                                            help='The user agent string when issuing the crawler.')

        retriever_group = parser.add_argument_group('Retriever Options')
        retriever_group.add_argument('--embedding_model', default="intfloat/multilingual-e5-small", help='The HuggingFace name of the embedding model.')
        retriever_group.add_argument('--mmr_k', default=6, type=int, help='Number of chunk to retrieve after Maximum Marginal Relevance (MMR).')
        retriever_group.add_argument('--mmr_fetch_k', default=12, type=int, help='Number of chunk to retrieve before Maximum Marginal Relevance (MMR).')
        retriever_group.add_argument('--chunk_size', default=512, type=int, help='The charters in the chunk.')
        retriever_group.add_argument('--chunk_overlap', default=128, type=int, help='The overlaps between chunks.')
        retriever_group.add_argument('--vector_db_ttl_sec', default=600, type=int, help='The duration of a cached on-demand vector database remains active before requiring an update from the source.')
        
        generator_group = parser.add_argument_group('Generator Options')
        generator_group.add_argument('--api_base_url', default="http://127.0.0.1/", help='The API base URL of Kuwa multi-chat WebUI')
        generator_group.add_argument('--api_key', default=None, help='The API authentication token of Kuwa multi-chat WebUI')
        generator_group.add_argument('--limit', default=3072, type=int, help='The limit of the LLM\'s context window')
        generator_group.add_argument('--model', default=None, help='The model name (access code) on Kuwa multi-chat WebUI')
        
        display_group = parser.add_argument_group('Display Options')
        display_group.add_argument('--hide_ref', action="store_true", help="Do not show the reference at the end.")
        display_group.add_argument('--hide_ref_content', action="store_true", help="Do not show the content of references.")

    def setup(self):

        if self.args.visible_gpu:
            os.environ["CUDA_VISIBLE_DEVICES"] = self.args.visible_gpu
        
        self.google_api_key = self.args.google_api_key
        self.searching_engine_id = self.args.google_cse_id

        self._app_setup()

    def _app_setup(self, params:ParameterDict=ParameterDict()):
        general_params = params["_"]
        search_params = params["search_"]
        crawler_params = params["crawler_"]
        retriever_params = params["retriever_"]
        generator_params = params["generator_"]
        display_params = params["display_"]
        
        lang = general_params.get("lang", self.args.lang)
        lang = lang if lang in os.listdir("lang/") else "en"
        i18n.load_path.append(f'lang/{lang}/')
        i18n.config.set("error_on_missing_translation", True)
        i18n.config.set("fallback", "en")
        i18n.config.set("locale", lang)

        self.advanced_search_params = search_params.get("advanced_params", self.args.advanced_search_params)
        self.num_url = search_params.get("num_url", self.args.num_url)
        self.user_agent = crawler_params.get("user_agent", self.args.user_agent)
        self.with_ref = not display_params.get("hide_ref", self.args.hide_ref)
        self.display_ref_content = not display_params.get("hide_ref_content", self.args.hide_ref_content)
        
        self.llm = KuwaLlmClient(
            base_url = self.args.api_base_url,
            kernel_base_url = self.kernel_url,
            model=generator_params.get("model", self.args.model),
            auth_token=general_params.get("user_token", self.args.api_key),
            limit=generator_params.get("limit", self.args.limit)
        )
        self.document_store = DocumentStore(
            embedding_model = retriever_params.get("embedding_model", self.args.embedding_model),
            mmr_k = retriever_params.get("mmr_k", self.args.mmr_k),
            mmr_fetch_k = retriever_params.get("mmr_fetch_k", self.args.mmr_fetch_k),
            chunk_size = retriever_params.get("chunk_size", self.args.chunk_size),
            chunk_overlap = retriever_params.get("chunk_overlap", self.args.chunk_overlap)
        )
        self.docqa = DocQa(
            document_store = self.document_store,
            vector_db_ttl_sec = retriever_params.get("ttl_sec", self.args.vector_db_ttl_sec),
            llm = self.llm,
            lang = lang,
            with_ref = self.with_ref,
            display_ref_content = self.display_ref_content,
            user_agent=self.user_agent
        )
        self.proc = False
        
        self.document_store.load_embedding_model()
        gc.collect()

    async def is_url_reachable(self, url:str, timeout=5) -> bool:
        loop = asyncio.get_running_loop()
        resp = None
        try:
            resp = await loop.run_in_executor(
                None,
                functools.partial(
                requests.get,
                url,
                timeout=timeout,
                headers = {} if self.user_agent is None else {"User-Agent": self.user_agent},
                verify=False
                )
            )
        except Exception as e:
            logger.debug(str(e))
        finally:
            return resp != None and resp.ok

    async def search_url(self, chat_history: [dict], parsed_modelfile) -> ([dict[str, str]],[str]):
        """
        Get first URL from the search result.
        """

        latest_user_record = next(filter(lambda x: x["role"] == "user", reversed(chat_history)))
        latest_user_msg = latest_user_record["content"]

        query = "{user} {params}".format(user=latest_user_msg, params=self.advanced_search_params)
        logger.debug(f'Query: {query}')

        endpoint = 'https://customsearch.googleapis.com/customsearch/v1'
        params = {
            'key': self.google_api_key,
            'cx': self.searching_engine_id,
            'q': query
        }

        urls = []

        try:

            loop = asyncio.get_running_loop()
            resp = await loop.run_in_executor(
                None,
                functools.partial(
                requests.get,
                endpoint,
                params = params
                )
            )
            
            logger.debug(f'Search response ({resp.status_code}):\n{resp.content}')

            if not resp.ok or 'error' in resp.json(): raise ValueError()
            resp  = resp.json()
            
            urls = [item['link'] for item in resp['items']]
            # titles = [item['title'] for item in resp['items']]
            urls_reachable = await asyncio.gather(*[self.is_url_reachable(url) for url in urls])
            logger.debug(list(zip(urls, urls_reachable)))
            # urls = list(zip(urls, titles))
            urls = list(itertools.compress(urls, urls_reachable))
            urls = urls[:min(len(urls), self.num_url)]
        
        except Exception as e:
            logger.exception('Error while getting URLs for Google searching API')
        
        finally:
            return urls, [latest_user_record]

    async def llm_compute(self, history: list[dict], modelfile:Modelfile):
        self._app_setup(params=modelfile.parameters)
        auth_token = modelfile.parameters["_"]["user_token"] or self.args.api_key

        try:
        
            urls, history = await self.search_url(history, modelfile)

            if len(urls) == 0: raise NoUrlException(i18n.t("searchqa.search_unreachable"))
        
            self.proc = True
            response_generator = self.docqa.process(
                urls=urls,
                chat_history=history,
                auth_token=auth_token,
                modelfile=modelfile,
            )
            async for reply in response_generator:
                if not self.proc:
                    await response_generator.aclose()
                yield reply

        except NoUrlException as e:
            await asyncio.sleep(2) # To prevent SSE error of web page.
            yield 

        except Exception as e:
            await asyncio.sleep(2) # To prevent SSE error of web page.
            logger.exception('Unexpected error')
            yield i18n.t("searchqa.default_exception_msg")
        finally:
            logger.info("Done")

    async def abort(self):
        if self.proc:
            self.proc = False
            logger.debug("aborted")
            return "Aborted"
        return "No process to abort"

if __name__ == "__main__":
    executor = SearchQaExecutor()
    executor.run()