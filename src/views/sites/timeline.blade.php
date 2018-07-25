<html>
<head>
    <title>@lang('main.timeline')</title>
    <!-- Latest compiled and minified CSS -->

    <style>

        /*Standard*/
        html, body {
            padding: 0;
            margin: 0;
        }

        .fl {
            float: left;
        }
        .fw {
            width: 100%;
            display: inline-block;
        }

        /*Sidebar*/
        .sidebar {
            width: 250px;
        }

        .sidebar {
            height: 100%;

            background-color: white;
            color: rgb(42, 43, 60);

            border-color: rgb(222, 226, 230);
            border-style: solid;
            border-width: 0 1px 0 0;
        }

        .sidebar-filters {
            height: 50px;

            line-height: 50px;
            padding-left: 5px;

            box-shadow: 0 1px 3px -1px rgb(197, 197, 197);
        }

        .sidebar-content-item {
            display: inline-block;
            width: 100%;

            padding-top: 5px;
            padding-bottom: 5px;

            border-color: rgb(222, 226, 230);
            border-style: solid;
            border-width: 0 0 1px 0;

            cursor: pointer;
        }

        .sidebar-content-item:hover {
            background-color: rgb(83, 145, 255);
            color: white;
        }

        .sidebar-content-item .sidebar-content-item-method {
            float: left;

            padding: 4px;

            margin-left: 5px;
            margin-right: 5px;

            background-color: #346362;
            color: whitesmoke;
            border-radius: 4px;
        }

        .sidebar-content-item-uri {
            padding-top: 4px;
            padding-bottom: 4px;
        }


        .sidebar-content-item .sidebar-content-item-code {

            float: right;

            padding: 4px;
            border-radius: 4px;

            margin-left: 5px;
            margin-right: 5px;

            color: black;
        }

        .sidebar-content-item .sidebar-content-item-code.code-good {
            background-color: rgb(242, 243, 249);
        }

        .sidebar-content-item-client {
            margin-left: 5px;
            margin-right: 5px;
        }

        .sidebar-content-item-time {
            float: right;

            margin-left: 5px;
            margin-right: 5px;
        }


        /*content*/
        .content {
            width: calc(100% - 251px);
            height: 100%;

            background-color: rgb(243, 241, 246);
        }
        .content .content-request, .content .content-response {
            float: left;

            width: calc(50% - 1px);

            height: 100%;

            background-color: rgb(242, 243, 249);
        }

        .content-request-url {
            height: 50px;

            padding-left: 20px;

            line-height: 50px;

            background-color: white;
            box-shadow: 0 1px 3px -1px rgb(197, 197, 197);

            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .sections .section {
            height: calc(100% - 84px - 20px);
            overflow-y: auto;

            padding: 10px;
        }

        .sections .section .section-header {
            width: 100%;

            background-color: yellow;

            height: 30px;
            line-height: 30px;
        }

        .section table {
            width: 100%;
        }
        .section table th {
            text-align: left;
        }.section table td {
            word-break: break-all;
        }

        .section iframe {
            width: 100%;
            height: 100%;
        }


        .section-navigation {
            display: table;
            table-layout: fixed;

            width: 100%;

            background-color: rgb(242, 243, 249);
        }

        .section-navigation .section-trigger {
            display: table-cell;

            text-align: center;

            padding: 10px 0;

            border-color: rgb(222, 226, 230);
            border-style: solid;
            border-width: 1px 1px 1px 0;

            background-color: rgb(242, 243, 249);

            cursor: pointer;
            transition: all 0.3s ease;
        }

        .section-navigation .section-trigger.active {
            background-color: rgba(83, 145, 255, 1);
            color: white;

            transition: all 0.3s ease;
        }


        .section-wrapper {
            width: calc(100% - 30px);
            height: calc(100% - 80px);

            margin-left: 15px;

            background-color: white;
            box-shadow: 0 0 10px -3px rgb(219, 219, 219);
        }

        .section-wrapper {
            margin-top: 15px;

            border-color: rgb(222, 226, 230);
            border-style: solid;
            border-width: 1px;

            border-radius: 4px;
        }

        .section-title {
            text-align: left;

            font-size: 16pt;

            padding: 10px 15px;

            background-color: white;

            border-radius: 4px;
        }


        .section-navigation .section-trigger:first-child {
            border-left-width: 0;
        }
        .section-navigation .section-trigger:last-child {
            border-right-width: 0;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="fl sidebar">

        <div class="sidebar-filters">
            No filters active
        </div>

        <div class="sidebar-content" id="sidebar-content">
        @for($i = 0; $i < 0; $i++)
            <div class="sidebar-content-item">

                <div>
                    <div class="fl sidebar-content-item-method method-good">GET</div>
                    <div class="fl sidebar-content-item-uri">/api/users/companies</div>
                    <div class="fl sidebar-content-item-code code-good">200</div>
                </div>

                <div>
                    <div class="fl sidebar-content-item-client">Android</div>
                    <div class="fl sidebar-content-item-time">12:34</div>
                </div>

            </div>
        @endfor
        </div>
    </div>

    <div class="fl content">

        <div class="content-item content-request"></div>
        <div class="content-itme content-response"></div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/4.2.2/pusher.min.js" integrity="sha256-7eF3+QqU4h5ub57Z/dhl8nPqrXJzPtlLz61YIvRznk0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js" integrity="sha256-iaqfO5ue0VbSGcEiQn+OeXxnxAMK2+QgHXIDA5bWtGI=" crossorigin="anonymous"></script>

<script id="template-request" type="x-tmpl-mustache">

    <div class="sidebar-content-item" request="[[ id ]]">

        <div class="fw">
            <div class="fl sidebar-content-item-method method-good">[[ method ]]</div>
            <div class="fl sidebar-content-item-uri">[[ uri ]]</div>
            <div class="fl sidebar-content-item-code code-good">[[ code ]]</div>
        </div>

        <div class="fw" style="margin-top: 3px">
            <div class="fl sidebar-content-item-client">Android</div>
            <div class="fl sidebar-content-item-time">[[ time ]]</div>
        </div>

    </div>

</script>


<script id="template-content-request" type="x-tmpl-mustache">

    <div class="content-request-url">
        [[ server.SERVER_NAME ]]:[[ server.SERVER_PORT ]][[ server.REQUEST_URI ]]
    </div>

    <div class="section-wrapper">
        <div class="section-title">
            Request
        </div>

        <div class="section-navigation">
            <div class="section-trigger" section="section-request">Request</div>
            <div class="section-trigger" section="section-headers">Headers</div>
            <div class="section-trigger" section="section-files">Files</div>
            <div class="section-trigger" section="section-cookies">Cookies</div>
        </div>

        <div class="sections">
            <div class="section section-request">

                <div class="section-content">
                    [[#request.length]]
                    <table>
                        [[#request]]
                        <tr>
                            <th>[[@key]]</th>
                            <td>[[@val]]</td>
                        </tr>
                        [[/request]]
                    </table>
                    [[/request.length]]
                    [[^request.length]]
                    No request variables provided
                    [[/request.length]]
                </div>

            </div>
            <div class="section section-headers">

                <div class="section-content">
                    [[#headers.length]]
                    <table>
                        [[#headers]]
                        <tr>
                            <th>[[@key]]</th>
                            <td>[[@val]]</td>
                        </tr>
                        [[/headers]]
                    </table>
                    [[/headers.length]]
                    [[^headers.length]]
                    No headers provided
                    [[/headers.length]]
                </div>

            </div>
            <div class="section section-files">

                <div class="section-content">
                    [[#files.length]]
                    <table>
                        [[#files]]
                        <tr>
                            <th>[[@key]]</th>
                            <td>[[@val]]</td>
                        </tr>
                        [[/files]]
                    </table>
                    [[/files.length]]
                    [[^files.length]]
                    No files provided
                    [[/files.length]]
                </div>

            </div>
            <div class="section section-cookies">

                <div class="section-content">
                    [[#cookies.length]]
                    <table>
                        [[#cookies]]
                        <tr>
                            <th>[[@key]]</th>
                            <td>[[@val]]</td>
                        </tr>
                        [[/cookies]]
                    </table>
                    [[/cookies.length]]
                    [[^cookies.length]]
                    No request provided
                    [[/cookies.length]]
                </div>

            </div>
        </div>
    </div>

</script>
<script id="template-content-response" type="x-tmpl-mustache">

    <div class="content-request-url">
        [[ response_message ]]
    </div>

    <div class="section-wrapper">
        <div class="section-title">
            Response
        </div>

        <div class="section-navigation">
            <div class="section-trigger" section="section-content">Content</div>
            <div class="section-trigger" section="section-headers">Headers</div>
        </div>

        <div class="sections">
            <div class="section section-headers">
                [[#headers.length]]
                    <table>
                    [[#headers]]
                        <tr>
                            <th>[[@key]]</th>
                            <td>[[@val]]</td>
                        </tr>
                    [[/headers]]
                    </table>
                [[/headers.length]]
                [[^headers.length]]
                   No headers provided
                [[/headers.length]]
            </div>
            <div class="section section-content">
                [[#content]]
                    [[content]]
                [[/content]]
                [[^content]]
                   No content provided
                [[/content]]
            </div>
        </div>
    </div>

</script>


<script>
    /**
     * Created by PhpStorm.
     * User: bert
     * Date: 01/03/2018
     * Time: 14:00
     */


    /* Version 0.1
     * Basic implementation
     */


    /* TODO's
     * TODO relocate library keys
     *
     */

    /* Changelog
     * - Version 0.1
     *      - Added pusher
     *      - Added datatables
     *      - Added Format
     *          This should contain format functions for data like dates, booleans, ....
     *
     * - Version 0.2
     *      - Added dependencies loader TODO, imrove this
     **/


    var awjs = (function() {

        var self = {};

        self.pusher_id = '';
        self.pusher_encrypted = true;
        self.pusher_authEndpoint = '/broadcasting/auth';


        self.dependencies = function(type) {

            var self_dependencies = {};

            self_dependencies.getUrl = function() {

                if(type === 'pusher') {
                    return 'https://cdnjs.cloudflare.com/ajax/libs/pusher/4.2.2/pusher.min.js';
                }

                return null;
            };

            self_dependencies.load = function(callback) {
                var url = self_dependencies.getUrl(type);

                if(url !== null) {
                    var params = arguments;

                    return callback.apply(this, params);
                    var script = document.createElement('script');

                    script.onload = function () {
                        callback.apply(this, params);
                    };
                    script.src = url;

                    document.head.appendChild(script);
                }
            };
        };

        self.pusher = function(channel) {

            //environment
            self_pusher = {};
            self_pusher.channels = [];

            //config
            Pusher.logToConsole = true;

            //generate pusher object
            self_pusher.pusher_object = new Pusher(self.pusher_id, {
                cluster: 'eu',
                encrypted: self.pusher_encrypted,
                authEndpoint: self.pusher_authEndpoint
            });


            //make sure we've generated this channel (and no doubles)
            if(typeof self_pusher.channels[channel] == "undefined" || self_pusher.channels[channel] == null) {
                self_pusher.channels[channel] = self_pusher.pusher_object.subscribe(channel);
            }
            self_pusher.current_channel = self_pusher.channels[channel];


            //register bind function with current channel, eventId and callback
            self_pusher.bind = function(eventId, callback) {

                self_pusher.current_channel.bind(eventId, callback);

                return self_pusher;
            };


            //return current object for chaining
            return self_pusher;
        };

        self.format = (function() {

            var self_datatables_format = {};

            self_datatables_format.boolean = function(data, type) {

                if(typeof type != "undefined" && type == "export") {
                    return data;
                }

                if(typeof data === "undefined" || data == 0 || data == null) {
                    return '<i class="fa fa-times"></i>';
                }

                return '<i class="fa fa-check"></i>';
            };

            self_datatables_format.date = function(data) {

                if(typeof data == "string") {
                    if(data.indexOf(' ') !== -1) {
                        return data.split(' ')[0];
                    }

                    return data;
                }

                return null;
            };

            self_datatables_format.time = function(data) {

                if(typeof data == "string") {
                    if(data.indexOf(' ') !== -1) {
                        data = data.split(' ')[1];
                    }

                    if(data.length == 8) {
                        return data.substr(0, 5);
                    }

                    return data;
                }

                return null;
            };

            return self_datatables_format;
        })();

        self.datatables = function(jqueryObject, order, url, columns, options) {

            var self_datatables = {};


            self_datatables.create = function(jqueryObject, order, url, columns) {

                if ($.fn.dataTable.isDataTable(jqueryObject)) {
                    table = $(jqueryObject).DataTable();
                    table.destroy();
                }

                self.datatables.row_ids = [];

                var defaultOptions = {
                    scrollX: false,
                    processing: false,
                    serverSide: true,
                    "order": order,
                    ajax: {
                        "url": url,
                        "type": "get"
                    },
                    columns: columns,
                    rowId: 'id'
                };

                if(typeof options !== "undefined") {
                    jQuery.extend(defaultOptions, options);
                }

                return $(jqueryObject).DataTable(defaultOptions);
            };


            self_datatables.format = self.format;



            //letss pass on these variables to our create constrcutor (default funciton)
            if(typeof jqueryObject !== "undefined" && typeof jqueryObject !== "undefined" && typeof jqueryObject !== "undefined" && typeof jqueryObject !== "undefined") {
                return self_datatables.create(jqueryObject, order, url, columns, options);
            }

            //or return our current object for the rest of them
            return self_datatables;
        };

        return self;
    })();
</script>

<script>
    awjs.pusher_id = '6ca733902dd056763b23';
    awjs.pusher('analytics.requests').bind('requests.new', function(data) {
        console.log('INCOMMING REQUEST', data);
        handleRequest(data[0]);
    });

    awjs.pusher('analytics.responses').bind('responses.new', function(data) {
        console.log('INCOMMING RESPONSE', data);
        handleResponse(data[0]);
    });

    Mustache.tags = ['[[', ']]'];

    var cache = {
        requests: [],
        responses: [],
    };

    var templates = {
        request: $('#template-request').html(),
        content_request: $('#template-content-request').html(),
        content_response: $('#template-content-response').html(),
    };


    function handleRequest(request) {

        cache.requests[request.id] = request;

        fillTemplateRequest(request);
    }

    function fillTemplateRequest(request) {

        $('#sidebar-content').append(Mustache.render(templates.request, {
            id: request.id,
            method: request.server.REQUEST_METHOD,
            uri: request.server.REQUEST_URI.substr(0, request.server.REQUEST_URI.indexOf('?')),
            time: request.server.REQUEST_TIME,
            code: '...'
        }));

        $('.sidebar-content-item[request="' + request.id + '"]').on('click', handleRequestOnClick);
    }

    function handleResponse(response) {

        cache.responses[response.request] = response;

        updateTemplateResponse(response);
    }

    function updateTemplateResponse(response) {
        $('.sidebar-content-item[request="' + response.request + '"] .sidebar-content-item-code').html(response.status);
    }

    function handleRequestOnClick() {
        select(
            cache.requests[$(this).attr('request')],
            cache.responses[$(this).attr('request')]
        );
    }

    function objs2list(p, except) {
        if(typeof except === "undefined") {
            except = [];
        }

        r = [];
        for (var key in p) if (p.hasOwnProperty(key)) {
            if(except.indexOf(key) === -1) {
                r.push({"@key":key,"@val":p[key]});
            }
        }

        return r;
    }

    function syntaxHighlight(json) {
        var build = '<pre>';

        build += json
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span style="display: inline-block;" class="' + cls + '">' + match + '</span>';
            });

        build += '</pre>';

        build += '<style>' +
        'pre { padding: 5px; margin: 5px; }\n' +
        '.string { color: green; }\n' +
        '.number { color: darkorange; }\n' +
        '.boolean { color: blue; }\n' +
        '.null { color: magenta; }\n' +
        '.key { color: red; }\n' +
        '\n</style>';

        return build;
    }

    function select(request, response) {

        console.log('CLICKED', request, response);
        console.log(objs2list(request.headers));

        $('.content .content-request').html(Mustache.render(templates.content_request, {
            id: request.id,
            cookies: objs2list(request.cookies),
            files: objs2list(request.files),
            headers: objs2list(request.headers, ['cookie']),
            request: objs2list(request.request, ['password']),
            server: request.server
        }));

        if(typeof response !== "undefined") {
            $('.content .content-response').html(Mustache.render(templates.content_response, {
                id: response.request,
                headers: objs2list(response.headers),
                content: response.content,
                response_message: 'Response looks ok'
            }));

            if(typeof response.headers !== "undefined" && typeof response.headers['content-type'] !== "undefined" && response.headers['content-type'][0] === 'application/json') {
                json = JSON.parse(response.content);
                json = JSON.stringify(json, undefined, 4);

                if(typeof json !== "undefined" && json.length > 0) {
                    response.content = syntaxHighlight(json);
                }
            }

            frame = $('<iframe frameBorder="0"></iframe>').attr('src', 'data:text/html,' + encodeURIComponent(response.content));

            $('.content .content-response .section-content').html(frame);
        }

        load_section_events()
    }

    function section_change(section) {
        $(section).parent().find('.section-trigger').removeClass('active');
        $(section).addClass('active');

        $(section).closest('.section-wrapper').find('.section').hide();
        $(section).closest('.section-wrapper').find('.' + $(section).attr('section')).show();
    }

    function load_section_events() {
        $('.section-navigation').each(function() {
            if($(this).find('.section-trigger.active').length == 0) {
                section_change($(this).find('.section-trigger').first().addClass('active'))
            }
        });

        $('.section-trigger').off('click');
        $('.section-trigger').on('click', function() {
            section_change(this);
        });
    }

</script>


</body>
</html>
