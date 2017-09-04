@extends('layouts/default') {{-- Page title --}} @section('title') Nvd3 Charts @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/nvd3/css/nv.d3.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/custom_css/nvd3_charts.css')}}" rel="stylesheet" type="text/css"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Nvd3 Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Nvd3 Charts
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Stacked/Grouped Multi-Bar Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body">
                <div id="chart1">
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Line Plus Bar Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body bg-panel">
                <div id="chart2" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Horizontal Multi-Bar Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body bg-">
                <div id="chart3" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!--row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Cumulative Line Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body">
                <div id="chart4" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!--row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel bg-panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Scatter / Bubble Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body">
                <div id="chart5" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- area chart -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Area Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body">
                <div id="chart6" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- area chart end -->
<!-- sunburst chart -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Sunburst Chart
                            </h4>
                <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
            </div>
            <div class="panel-body">
                <div id="chart7" class='with-3d-shadow with-transitions'>
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sunburst chart end -->@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/nvd3/js/nv.d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/stream_layers.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/nvd3_charts.js')}}"></script> @stop
