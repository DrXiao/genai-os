# -#- coding: UTF-8 -*-
import time, re
from src.variable import *
from flask import Flask
from flask_sse import ServerSentEventsBlueprint
from routes.worker import worker
from routes.chat import chat


if __name__ == '__main__':
    app = Flask(__name__)
    app.config["REDIS_URL"] = "redis://localhost:6379/0"
    sse = ServerSentEventsBlueprint('sse', __name__)
    app.register_blueprint(sse, url_prefix='/')
    app.register_blueprint(worker, url_prefix=f'/{version}/worker')
    app.register_blueprint(chat, url_prefix=f'/{version}/chat')
    print("Route list:\n","\n".join([str(i) for i in app.url_map.iter_rules()]))
    app.run(port=9000, host="0.0.0.0", threaded=True)
    print("\n\nServer started")