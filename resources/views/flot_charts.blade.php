@extends('layouts/default') {{-- Page title --}} @section('title') Flot Charts @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('css/custom_css/flot_charts.css')}}" rel="stylesheet" type="text/css"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Flot Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Flot Charts
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Spline Line Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="basicFlotLegend1" class="flotLegend"></div>
                <div id="basicflot" class="flotChart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Line Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div id="basicFlotLegend" class="flotLegend"></div>
                <div id="line-chart" class="flotChart1"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Stack charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Bar Charts
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body body-bg">
                <div id="basicFlotLegend-barchart" class="flotLegend"></div>
                <div id="bar-chart" class="flotChart1"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Stack charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Stacked Bar Charts
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="basicFlotLegend-stac" class="flotLegend"></div>
                <div id="bar-chart-stacked" class="flotChart1"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-4">
        <!-- Stack charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Donut
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="donut" class="flotChart2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <!-- Stack charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Pie Charts
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <div id="placeholdertranslabel" class="flotChart1"></div>
                </div>
                <div class="col-lg-6">
                    <div id="placeholdertiltedpie" class="flotChart1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Charts with symbols charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Real Time Charts
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="realtime" class="flotChart3"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Real time charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Area Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div id="area-chart" class="flotChart3"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Real time charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Spline Area Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div id="chart-spline" class="flotChart3"></div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/flotchart/js/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/flotchart/js/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{asset('vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
<script language="javascript" type="text/javascript" src="{{asset('vendors/flotchart/js/jquery.flot.time.js')}}"></script>
<script src="{{asset('vendors/flotspline/js/jquery.flot.spline.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/flotchart/js/jquery.flot.categories.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/flotchart/js/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/flot.tooltip/js/jquery.flot.tooltip.js')}}" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="{{asset('js/custom_js/flot_charts.js')}}"></script> @stop
