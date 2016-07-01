@extends('layouts.dirut.layout1')

@section('title')
    Dashboard
@endsection

@push('plugin_css')
    {!! Helper::registerCss('/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') !!}
    {!! Helper::registerCss('/global/plugins/morris/morris.css') !!}
    {!! Helper::registerCss('/global/plugins/fullcalendar/fullcalendar.min.css') !!}
    {!! Helper::registerCss('/global/plugins/jqvmap/jqvmap/jqvmap.css') !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Dashboard','dashboard & statistics') !!}
@endsection

@section('breadcrumb')
    <li>
        <span class="active">Dashboard</span>
    </li>
@endsection

@section('content')
        <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="549">0</span>
                    </div>
                    <div class="desc"> Total Pasar </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="50">0</span></div>
                    <div class="desc"> Total Petugas </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="1349">0</span>
                    </div>
                    <div class="desc"> Total Pedagang </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number"> +
                        <span data-counter="counterup" data-value="89"></span> </div>
                    <div class="desc"> Pedagang Baru </div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Jumlah Dagang</span>
                        <span class="caption-helper">weekly stats...</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn red btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">New</label>
                            <label class="btn red btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Returning</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_statistics_loading">
                        <img src="{{ url('/assets') }}/global/img/loading.gif" alt="loading" /> </div>
                    <div id="site_statistics_content" class="display-none">
                        <div id="site_statistics" class="chart"> </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-red-sunglo hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Revenue</span>
                        <span class="caption-helper">monthly stats...</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a href="#" class="btn dark btn-outline btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter Range
                                <span class="fa fa-angle-down"> </span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;"> Q1 2014
                                        <span class="label label-sm label-default"> past </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Q2 2014
                                        <span class="label label-sm label-default"> past </span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;"> Q3 2014
                                        <span class="label label-sm label-success"> current </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Q4 2014
                                        <span class="label label-sm label-warning"> upcoming </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_activities_loading">
                        <img src="{{ url('/assets') }}/global/img/loading.gif" alt="loading" /> </div>
                    <div id="site_activities_content" class="display-none">
                        <div id="site_activities" style="height: 228px;"> </div>
                    </div>
                    <div style="margin: 20px 0 10px 30px">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                <span class="label label-sm label-info"> PPN: </span>
                                <h3>10 %</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                <span class="label label-sm label-danger"> Iuran: </span>
                                <h3>Bulanan</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-cursor font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">General Stats</span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                            <i class="fa fa-repeat"></i> Reload </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number transactions" data-percent="55">
                                    <span>+55</span>% </div>
                                <a class="title" href="javascript:;"> Transactions
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"> </div>
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number visits" data-percent="85">
                                    <span>+85</span>% </div>
                                <a class="title" href="javascript:;"> New Visits
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"> </div>
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number bounce" data-percent="46">
                                    <span>-46</span>% </div>
                                <a class="title" href="javascript:;"> Bounce
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Server Stats</span>
                        <span class="caption-helper">monthly stats...</span>
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="#" class="reload"> </a>
                        <a href="#" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar5"></div>
                                <a class="title" href="javascript:;"> Network
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"> </div>
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar6"></div>
                                <a class="title" href="javascript:;"> CPU Load
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"> </div>
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_line"></div>
                                <a class="title" href="javascript:;"> Load Rate
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin_script')
    <script src="{{ url('/assets') }}/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
@endpush

@push('page_script')
    {!! Helper::registerJs('/pages/scripts/dashboard.min.js') !!}
@endpush