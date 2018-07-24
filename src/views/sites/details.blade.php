<html>
<head>
    <title>@lang('main.user')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">

            <div class="box-header">
                <p class="box-title">
                    <i class="fa fa-user"></i> @lang('main.site')
                </p>
            </div>

            <form class="box-body box-primary">


                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('analytics.sites.update', $site->id) }}" method="post" enctype="multipart/form-data"
                <table id="users-table" class="table table-bordered  table-striped" style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>@lang('main.name')</th>
                        <td>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" required="required" {{ isset($enableChanges) && $enableChanges ? 'disabled="disabled"' : ''}} value="{{ $site->name }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('main.logs_dir')</th>
                        <td>
                            <div class="form-group">
                                <label for="logs_dir">Logs directory</label>
                                <input type="text" name="logs_dir" required="required" {{ isset($enableChanges) && $enableChanges ? 'disabled="disabled"' : ''}} value="{{ $site->logs_dir }}">
                            </div>
                        </td>
                    </tr>
                    </thead>
                </table>
                @if(isset($enableChanges) && $enableChanges)
                    <input type="submit" class="btn btn-primary pull-right" value="Submit" style="margin-top: 5px">
                @endif
            </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <canvas id="chart-month" style="height: 250px;"></canvas>
    </div>
</div>

<div class="row" style="margin-bottom: 15px;">
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.logs_count')</div>
            <div class="box-body box-primary data_logs_count size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.api_count')</div>
            <div class="box-body box-primary data_api_count size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.web_count')</div>
            <div class="box-body box-primary data_web_count size-28" style="overflow: hidden !important;text-overflow: ellipsis;white-space: nowrap;">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.file_count')</div>
            <div class="box-body box-primary data_file_count size-28">Loading...</div>
        </div>
    </div>

    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.error_count')</div>
            <div class="box-body box-primary data_error_count size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.get_count')</div>
            <div class="box-body box-primary data_get_count size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.post_count')</div>
            <div class="box-body box-primary data_post_count size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.average_response_size')</div>
            <div class="box-body box-primary data_average_response_size size-28">Loading...</div>
        </div>
    </div>

    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.average_web_response_size')</div>
            <div class="box-body box-primary data_average_web_response_size size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.average_api_response_size')</div>
            <div class="box-body box-primary data_average_api_response_size size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.average_web_response_time')</div>
            <div class="box-body box-primary data_average_web_response_time size-28">Loading...</div>
        </div>
    </div>
    <div class="col-sm-3 text-center">
        <div class="box box-primary">
            <div class="box-header bold">@lang('main.average_api_response_time')</div>
            <div class="box-body box-primary data_average_api_response_time size-28">Loading...</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">

            <div class="box-header">
                <p class="box-title">
                    <i class="fa fa-tasks"></i> @lang('main.log_files')
                </p>
            </div>

            <div class="box-body box-primary">

                <table id="tasks-table" class="table table-bordered  table-striped" style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>@lang('main.filename')</th>
                        <th>@lang('main.synced_at')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($site->log_files as $log_file)
                        <tr>
                            <td>{{ $log_file->filename }}</td>
                            <td>{{ $log_file->synced_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">

            <div class="box-header">
                <p class="box-title">
                    <i class="fa fa-code"></i> @lang('main.projects')
                </p>
            </div>

            <div class="box-body box-primary">

                <table id="projects-table" class="table table-bordered  table-striped" style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>@lang('main.task_name')</th>
                        <th>@lang('main.hours')</th>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">

            <div class="box-header">
                <p class="box-title">
                    <i class="fa fa-tag"></i> @lang('main.entries')
                </p>
            </div>

            <div class="box-body box-primary">

                <table id="entries-table" class="table table-bordered  table-striped" style="margin-bottom: 0px;">
                    <thead>
                    <tr>
                        <th>@lang('main.project_name')</th>
                        <th>@lang('main.task_name')</th>
                        <th>@lang('main.hours')</th>
                        <th>@lang('main.notes')</th>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.actions')</th>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="{{ asset('/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/plugins/dataTables.bootstrap.min.js') }}"></script>


<script src="/js/ChartJs.min.js"></script>


<script>

    var routes = {
        stats: '{{ route('analytics.sites.details.stats', $site->id) }}',
        charts: '{{ route('analytics.sites.details.charts', $site->id) }}',
    }

    function numericToDate(data) {
        hours = Math.floor(data);
        if(hours.length < 2) {
            hours = "0" + hours;
        }
        return hours + ":" + ("00" + Math.round((data - Math.floor(data)) * 60)).slice(-2);
    }

    $(function() {
        $.get(routes.stats, function(data) {

            for(var k in data) {
                $('.' + k).html(data[k]);
            }
        });

        var chartCache = [];
        $.get(charts + "?start_date=" + $('input[name="start_date"]').val() + "&end_date=" + $('input[name="end_date"]').val() , function(data) {

            charts = data.charts;

            charts.forEach(function (chart) {

                var ctx = document.getElementById(chart.id).getContext("2d");
                if(typeof chartCache[chart.id] != "undefined") {
                    chartCache[chart.id].destroy();
                }

                chartCache[chart.id] = new Chart(ctx, {
                    type: chart.type,
                    data: {
                        labels: chart.labels,
                        datasets: chart.datasets,
                    },
                    options: chart.options
                });
            });
        });
    });

</script>

</body>
</html>
