@extends('layouts/default') {{-- Page title --}} @section('title') Chartist Charts @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/chartist/css/chartist.min.css')}}">
<link href="{{asset('css/chartist.css')}}" type="text/css" rel="stylesheet"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Chartist Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Chartist Charts
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
                                <i class="ti-bar-chart"></i> Line Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart6 ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Responsive Bar Chart
                                <small>(Overlapping Bars in Mobile)</small>
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart1 ct-perfect-fourth"></div>
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
                                <i class="ti-bar-chart"></i> Series Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart2 ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> SVG Animations Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart3 ct-perfect-fourth"></div>
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
                                <i class="ti-bar-chart"></i> XY Plot Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart4 ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Fixed Scale Axis Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart5 ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Advanced SMIL Animations Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel ">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> SVG Path Animation Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div>
                    <div class="ct-chart7 ct-perfect-fourth"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/chartist/js/chartist.min.js')}}"></script>
<script src="{{asset('js/custom_js/chartist.js')}}" type="text/javascript"></script> @stop
