@extends('layouts/default') {{-- Page title --}} @section('title') Dimple Charts @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/amcharts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dimple Charts</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Charts</li>
        <li class="active">
            Dimple Charts
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-pie-chart"></i> Animated Pie Bubbles Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chartBox1" class="chartWindow">
                            <div id="chartContainer1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Time Bubble Lines Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chartBox2" class="chartWindow">
                            <div id="chartContainer2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Grouped Multi Step Line Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chartBox3" class="chartWindow">
                            <div id="chartContainer3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart"></i> Price Change Chart
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chartBox4" class="chartWindow">
                            <div id="chartContainer4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<!-- dynamic line colors -->
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-bar-chart-alt"></i> Chart with Dynamic Line Colors
                            </h4>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="chartBox5" class="chartWindow">
                            <div id="chartContainer5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- dynamic line colors end -->@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/d3v4/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/dimple/js/dimple.latest.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/dimple.js')}}"></script>
@stop
