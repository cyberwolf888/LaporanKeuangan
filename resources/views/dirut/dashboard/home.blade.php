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
                        <span data-counter="counterup" data-value="{!! $total_pasar !!}">{!! $total_pasar !!}</span>
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
                        <span data-counter="counterup" data-value="{!! $total_petugas !!}">{!! $total_petugas !!}</span></div>
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
                        <span data-counter="counterup" data-value="{!! $total_pedagang !!}">{!! $total_pedagang !!}</span>
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
                        <span data-counter="counterup" data-value="{!! $pedagang_baru !!}"></span> </div>
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
                        <i class="icon-share font-red-sunglo hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Revenue</span>
                        <span class="caption-helper">{!! date('Y') !!} stats...</span>
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
                                <span class="label label-sm label-danger"> Tahun: </span>
                                <h3>{!! date('Y') !!}</h3>
                            </div>
                        </div>
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
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Jumlah Dagang</span>
                        <span class="caption-helper">{!! date('Y') !!} stats...</span>
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
    </div>

@endsection

@push('plugin_script')
    <script src="{{ url('/assets') }}/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="{{ url('/assets') }}/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
@endpush

@push('page_script')
<script>
    var Dashboard=function(){
        return{
            initCharts:function(){
                function e(e,t,a,i){
                    $('<div id="tooltip" class="chart-tooltip">'+i+"</div>").css({
                        position:"absolute",
                        display:"none",
                        top:t-40,left:e-40,
                        border:"0px solid #ccc",
                        padding:"2px 6px",
                        "background-color":"#fff"
                    }).appendTo("body").fadeIn(200)
                }
                if(jQuery.plot){
                    var t=[
                        ["JAN",{!! $dagang[0] !!}],
                        ["FEB",{!! $dagang[1] !!}],
                        ["MAR",{!! $dagang[2] !!}],
                        ["APR",{!! $dagang[3] !!}],
                        ["MAY",{!! $dagang[4] !!}],
                        ["JUN",{!! $dagang[5] !!}],
                        ["JUL",{!! $dagang[6] !!}],
                        ["AUG",{!! $dagang[7] !!}],
                        ["SEP",{!! $dagang[8] !!}],
                        ["OCT",{!! $dagang[9] !!}],
                        ["NOV",{!! $dagang[10] !!}],
                        ["DEC",{!! $dagang[11] !!}]
                    ];
                    if(0!=$("#site_statistics").size()){
                        $("#site_statistics_loading").hide(),$("#site_statistics_content").show();
                        var a=($.plot(
                                $("#site_statistics"),
                                [
                                    {
                                        data:t,
                                        lines:{fill:.6,lineWidth:0},
                                        color:["#f89f9f"]
                                    },
                                    {
                                        data:t,
                                        points:{show:!0,fill:!0,radius:5,fillColor:"#f89f9f",lineWidth:3},
                                        color:"#fff",shadowSize:0
                                    }
                                ],
                                {
                                    xaxis:{
                                        tickLength:0,
                                        tickDecimals:0,
                                        mode:"categories",
                                        min:0,
                                        font:{lineHeight:14,style:"normal",variant:"small-caps",color:"#6F7B8A"}
                                    },
                                    yaxis:{
                                        ticks:5,
                                        tickDecimals:0,
                                        tickColor:"#eee",
                                        font:{lineHeight:14,style:"normal",variant:"small-caps",color:"#6F7B8A"}
                                    },
                                    grid:{
                                        hoverable:!0,
                                        clickable:!0,
                                        tickColor:"#eee",
                                        borderColor:"#eee",
                                        borderWidth:1
                                    }
                                }
                        ),null);

                        $("#site_statistics").bind("plothover",function(t,i,l){
                            if($("#x").text(i.x.toFixed(2)),$("#y").text(i.y.toFixed(2)),l){
                                if(a!=l.dataIndex){
                                    a=l.dataIndex,$("#tooltip").remove();
                                    l.datapoint[0].toFixed(2),l.datapoint[1].toFixed(2);
                                    e(
                                            l.pageX,
                                            l.pageY,
                                            l.datapoint[0],
                                            l.datapoint[1]+" dagang"
                                    )
                                }
                            }else
                                $("#tooltip").remove(),a=null
                        })
                    }

                    if(0!=$("#site_activities").size()){
                        var i=null;
                        $("#site_activities_loading").hide(),$("#site_activities_content").show();
                        var l=[
                            ["JAN",{!! $revenue[0] !!}],
                            ["FEB",{!! $revenue[1] !!}],
                            ["MAR",{!! $revenue[2] !!}],
                            ["APR",{!! $revenue[3] !!}],
                            ["MAY",{!! $revenue[4] !!}],
                            ["JUN",{!! $revenue[5] !!}],
                            ["JUL",{!! $revenue[6] !!}],
                            ["AUG",{!! $revenue[7] !!}],
                            ["SEP",{!! $revenue[8] !!}],
                            ["OCT",{!! $revenue[9] !!}],
                            ["NOV",{!! $revenue[10] !!}],
                            ["DEC",{!! $revenue[11] !!}]
                        ];

                        $.plot($("#site_activities"),[
                                    {
                                        data:l,
                                        lines:{fill:.2,lineWidth:0},
                                        color:["#BAD9F5"]
                                    },
                                    {
                                        data:l,
                                        points:{show:!0,fill:!0,radius:4,fillColor:"#9ACAE6",lineWidth:2},
                                        color:"#9ACAE6",shadowSize:1
                                    },
                                    {
                                        data:l,
                                        lines:{show:!0,fill:!1,lineWidth:3},
                                        color:"#9ACAE6",shadowSize:0
                                    }
                                ],
                                {
                                    xaxis:{
                                        tickLength:0,
                                        tickDecimals:0,
                                        mode:"categories",
                                        min:0,
                                        font:{lineHeight:18,style:"normal",variant:"small-caps",color:"#6F7B8A"}
                                    },
                                    yaxis:{
                                        ticks:5,
                                        tickDecimals:0,
                                        tickColor:"#eee",
                                        font:{lineHeight:14,style:"normal",variant:"small-caps",color:"#6F7B8A"}
                                    },
                                    grid:{
                                        hoverable:!0,
                                        clickable:!0,
                                        tickColor:"#eee",
                                        borderColor:"#eee",
                                        borderWidth:1
                                    }
                                }
                        );

                        $("#site_activities").bind("plothover",function(t,a,l){
                            if($("#x").text(a.x.toFixed(2)),$("#y").text(a.y.toFixed(2)),l&&i!=l.dataIndex){
                                i=l.dataIndex,$("#tooltip").remove();
                                l.datapoint[0].toFixed(2),l.datapoint[1].toFixed(2);
                                e(
                                        l.pageX,
                                        l.pageY,
                                        l.datapoint[0],
                                        "Rp. "+l.datapoint[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
                                )
                            }
                        }),
                                $("#site_activities").bind("mouseleave",function(){$("#tooltip").remove()})
                    }
                }
            },
            init:function(){
                this.initCharts()
            }
        }
    }();
    App.isAngularJsApp()===!1&&jQuery(document).ready(function(){Dashboard.init()});
</script>
@endpush