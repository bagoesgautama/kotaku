@extends('layouts/default') {{-- Page title --}} @section('title') Amcharts @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/amcharts/css/export.css')}}" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/amcharts.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Amcharts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Amcharts
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Column and Line mix Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="amchart1" id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Column chart with images on top
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="amchart1" id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> 3D Stacked Column Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="amchart1" id="chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-md-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Duration on Value Axis Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="amchart1" id="chart4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Reversed Value Axis Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="amchart1" id="chart5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/amcharts/js/amcharts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/amcharts/js/serial.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/amcharts/js/export.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/amcharts/js/light.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/amcharts.js')}}"></script> @stop
