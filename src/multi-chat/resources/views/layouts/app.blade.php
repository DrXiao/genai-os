<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-hidden h-full">
@php
    $languages = config('app.LANGUAGES');
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('css/flowbite.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontBunny.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/font_awesome..all.min.css') }}" />
    <link href="{{ asset('css/highlight_default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dracula.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/marked.min.js') }}"></script>
    <script src="{{ asset('js/highlight.min.js') }}"></script>
    <script src="{{ asset('js/purify.min.js') }}"></script>
</head>

<body class="font-sans antialiased h-full">
    @if (Auth::user()->term_accepted)
        <div data-modal-target="tos_modal"></div>
    @endif
    @if (Auth::user()->announced)
        <div data-modal-target="system_announcement_modal"></div>
    @endif
    @if (\App\Models\SystemSetting::where('key', 'announcement')->first()->value != '')
        <div id="system_announcement_modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ __('manage.label.anno') }}
                        </h3>
                        <button type="button" onclick="$modal1.hide();"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="system_announcement_modal">
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    {{-- blade-formatter-disable --}}
                    <div class="content p-4 text-base leading-relaxed text-gray-500 dark:text-gray-400">{{ \App\Models\SystemSetting::where('key', 'announcement')->first()->value }}</div>
                    {{-- blade-formatter-enable --}}
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="system_announcement_modal" type="button" onclick="$modal1.hide();"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('manage.button.close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (\App\Models\SystemSetting::where('key', 'tos')->first()->value != '')
        <div id="tos_modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ __('manage.label.tos') }}
                        </h3>
                    </div>
                    <!-- Modal body -->
                    {{-- blade-formatter-disable --}}
                    <div class="content p-4 text-base leading-relaxed text-gray-500 dark:text-gray-400">{{ \App\Models\SystemSetting::where('key', 'tos')->first()->value }}</div>
                    {{-- blade-formatter-enable --}}
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="tos_modal" type="button" onclick="$modal2.hide();"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('manage.button.accept') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="flex flex-col h-full bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main
            class="flex-1 overflow-y-{{ request()->routeIs('dashboard.*') || request()->routeIs('profile.edit') ? 'auto' : 'hidden' }} scrollbar">
            {{ $slot }}
        </main>
    </div>
    <script>
        function markdown(node) {
            $(node).html(marked.parse(DOMPurify.sanitize(node[0], {
                ALLOWED_TAGS: [],
                ALLOWED_ATTR: []
            })));

            $(node).find('table').addClass('table-auto');
            $(node).find('table *').addClass(
                'border border-2 border-gray-500 border-solid p-1');
            $(node).find('ul').addClass('list-inside list-disc');
            $(node).find('ol').addClass('list-inside list-decimal');
            $(node).find('> p').addClass('whitespace-pre-wrap');
            $(node).find('a').addClass(
                'text-blue-700 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-500').prop('target',
                '_blank');
            $(node).find('pre code').each(function() {
                $(this).html(this.textContent)
                hljs.highlightElement($(this)[0]);
            });
            $(node).find('pre code').addClass(
                "scrollbar scrollbar-3 rounded-b-lg")
            $(node).find('pre').each(function() {
                let languageClass = '';
                $(this).children("code")[0].classList.forEach(cName => {
                    if (cName.startsWith('language-')) {
                        languageClass = cName.replace('language-', '');
                        return;
                    }
                })
                $(this).prepend(
                    `<div class="flex items-center text-gray-200 bg-gray-800 px-4 py-2 rounded-t-lg">
<span class="mr-auto">${languageClass}</span>
<button onclick="copytext(this, $(this).parent().parent().children('code').text().trim())"
class="flex items-center"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
stroke-linejoin="round" class="icon-sm" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
</path>
<rect x="8" y="2" width="8" height="4" rx="1" ry="1">
</rect>
</svg>
<svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
stroke-linejoin="round" class="icon-sm" style="display:none;" height="1em" width="1em"
xmlns="http://www.w3.org/2000/svg">
<polyline points="20 6 9 17 4 12"></polyline>
</svg><span class="ml-2">{{ __('Copy') }}</span></button></div>`
                )
            })

            $(node).find("h5").each(function() {
                var pattern = /<%ref-(\d+)%>/;
                var match = DOMPurify.sanitize(this).replaceAll("&lt;", "<").replaceAll("&gt;", ">").match(pattern);
                if (match) {
                    var refNumber = match[1];
                    $msg = DOMPurify.sanitize($("#history_" + refNumber).find("div:eq(1) div div")[
                        0], {
                        ALLOWED_TAGS: [],
                        ALLOWED_ATTR: []
                    }).trim()
                    var $button = $("<button>")
                        .addClass("bg-gray-700 rounded p-2 hover:bg-gray-800")
                        .data("tooltip-target", "ref-tooltip")
                        .data("tooltip-placement", "top")
                        .attr("onmouseover", "refToolTip(" + refNumber + ")")
                        .attr("onclick", "scrollToRef(" + refNumber + ")");
                    $button.text($msg.substring(0, 30) + ($msg.length < 30 ? "" : "..."));

                    $(this).empty().append($button);
                }
            });
        }

        @if (\App\Models\SystemSetting::where('key', 'tos')->first()->value != '')
            $modal1 = new Modal(document.getElementById('system_announcement_modal'), {
                backdrop: 'static',
                closable: true,
                onHide: () => {
                    $.get("{{ route('announcement') }}")
                    $modal1 = new Modal(document.getElementById('system_announcement_modal'), {
                        backdrop: 'static',
                        closable: true,
                        onHide: () => {}
                    });
                }
            });
            $modal2 = new Modal(document.getElementById('tos_modal'), {
                backdrop: 'static',
                closable: true,
                onHide: () => {
                    $.get("{{ route('tos') }}")
                    @if (\App\Models\SystemSetting::where('key', 'announcement')->first()->value != '' && !Auth::user()->announced)
                        $modal1.show();
                    @endif
                    $modal2 = new Modal(document.getElementById('tos_modal'), {
                        backdrop: 'static',
                        closable: true,
                        onHide: () => {}
                    });
                }
            });
        @elseif (\App\Models\SystemSetting::where('key', 'announcement')->first()->value != '')
            $modal1 = new Modal(document.getElementById('system_announcement_modal'), {
                backdrop: 'static',
                closable: true,
                onHide: () => {
                    $.get("{{ route('announcement') }}")
                    $modal1 = new Modal(document.getElementById('system_announcement_modal'), {
                        backdrop: 'static',
                        closable: true,
                        onHide: () => {}
                    });
                }
            });
        @endif


        @if (\App\Models\SystemSetting::where('key', 'tos')->first()->value != '' && !Auth::user()->term_accepted)
            $modal2.show();
        @elseif (\App\Models\SystemSetting::where('key', 'announcement')->first()->value != '' && !Auth::user()->announced)
            $modal1.show();
        @endif


        markdown($("#system_announcement_modal .content"))
        markdown($("#tos_modal .content"))

        function chain_toggle() {
            $.get("{{ route('room.chain') }}", {
                switch: $('#chained').prop('disabled')
            }, function() {
                $('#chained').prop('disabled', !$('#chained').prop('disabled'));
                $('#chain_btn').toggleClass('bg-green-500 hover:bg-green-600 bg-red-600 hover:bg-red-700');
                $('#chain_btn').text($('#chained').prop('disabled') ? '{{ __('chat.button.unchain') }}' :
                    '{{ __('chat.button.chained') }}')
            })
        }

        function uploadcheck() {
            if ($("#upload")[0].files && $("#upload")[0].files.length > 0 && $("#upload")[0].files[0].size <= 10 * 1024 *
                1024) {
                $("#attachment").show();
                $("#attachment button").text($("#upload")[0].files[0].name)
            } else if ($("#upload")[0].files.length > 0) {
                $("#error_alert >span").text("{{ __('File Too Large') }}")
                $("#error_alert").fadeIn();
                $("#upload_btn").toggleClass("bg-green-500 hover:bg-green-600 bg-red-600 hover:bg-red-700")
                $("#upload").val("");
                $("#attachment").hide();
                setTimeout(function() {
                    $("#error_alert").fadeOut();
                    $("#upload_btn").toggleClass("bg-green-500 hover:bg-green-600 bg-red-600 hover:bg-red-700")
                }, 3000);
            }
        }

        function adjustTextareaRows(obj) {
            obj = $(obj)
            if (obj.length) {
                const textarea = obj;
                const maxRows = parseInt(textarea.attr('max-rows')) || 5;
                const lineHeight = parseInt(textarea.css('line-height'));

                textarea.attr('rows', 1);
                const contentHeight = textarea[0].scrollHeight;
                const rowsToDisplay = Math.floor(contentHeight / lineHeight);

                textarea.attr('rows', Math.min(maxRows, rowsToDisplay));
            }
        }

        function modelfile_parse(data) {
            const commands = [];
            let currentCommand = {
                Name: '',
                Args: ''
            };

            let systemCommandProcessed = false; // Flag to track if a system command has been processed

            // Split the input data into lines
            const lines = data.split('\n');

            // Iterate over each line
            lines.forEach(line => {
                // Trim whitespace from the beginning and end of the line
                line = line.trim();

                // If the line is empty, skip it
                if (!line) return;

                // Check if the line starts with a command keyword
                if (line.toUpperCase().startsWith('FROM') ||
                    line.toUpperCase().startsWith('ADAPTER') ||
                    line.toUpperCase().startsWith('LICENSE') ||
                    line.toUpperCase().startsWith('TEMPLATE') ||
                    line.toUpperCase().startsWith('SYSTEM') ||
                    line.toUpperCase().startsWith('PARAMETER') ||
                    line.toUpperCase().startsWith('MESSAGE')) {
                    // If a command is already being accumulated, push it to the commands array
                    if (currentCommand.Name !== '' && currentCommand.Args.trim() !== '') {
                        commands.push(currentCommand);
                    }
                    // Start a new command
                    currentCommand = {
                        Name: '',
                        Args: ''
                    };

                    // Split the line into command type and arguments
                    let [commandType, commandArgs] = line.split(/\s+(.+)/);
                    if (!commandArgs) commandArgs = '';

                    // Set the current command's name and arguments
                    currentCommand.Name = commandType.toLowerCase();
                    currentCommand.Args = commandArgs.trim();

                    // If the command is a system command and it has already been processed, skip it
                    if (currentCommand.Name === 'system' && systemCommandProcessed) {
                        currentCommand = {
                            Name: '',
                            Args: ''
                        };
                    } else if (currentCommand.Name === 'system') {
                        systemCommandProcessed = true; // Set the flag to true if a system command is processed
                    }
                } else {
                    // If the line does not start with a command keyword, append it to the current command's arguments
                    currentCommand.Args += '\n' + line;
                }
            });

            // Push the last command to the commands array if it has non-empty arguments
            if (currentCommand.Name !== '' && currentCommand.Args.trim() !== '') {
                commands.push(currentCommand);
            }

            // Remove triple-quotes at the start or end of arguments
            commands.forEach(command => {
                if (command.Args.startsWith('"""')) {
                    command.Args = command.Args.slice(3);
                }
                if (command.Args.endsWith('"""')) {
                    command.Args = command.Args.slice(0, -3);
                }
            });

            return commands;
        }

        function modelfile_update(node) {
            let data = modelfile_parse(node.val());
            for (let obj of data) {
                if (obj.Name === 'system') {
                    $("#bot-system_prompt").val(obj.Args)
                }
            }
            node.val(modelfile_to_string(data));
        }

        function modelfile_to_string(array) {
            return array.map(item => {
                let args = item.Args;
                if (args.includes('\n')) {
                    args = '"""' + args + '"""';
                }
                return `${item.Name.toUpperCase()} ${args}`;
            }).join('\n');
        }
    </script>
</body>

</html>
