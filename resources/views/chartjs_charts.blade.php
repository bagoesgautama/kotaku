@extends('layouts/default') {{-- Page title --}} @section('title') Chartjs Charts @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('css/custom_css/chartjs-charts.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Chartjs Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Chartjs Charts
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Bar Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <canvas id="bar-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Polar Area Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <canvas id="polar-area-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
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
                <div>
                    <canvas id="line-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Radar Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <canvas id="radar-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Donut Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <canvas id="doughnut-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
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
                <div>
                    <canvas id="pie-chart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/chartjs/js/Chart.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/chartjs-charts.js')}}"></script> @stop
