@extends('layouts/default') {{-- Page title --}} @section('title') Widgets2 @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/circliful/css/jquery.circliful.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/animate/animate.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/widgets1.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Widgets2</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> widgets</li>
        <li class="active">
            Widgets2
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-server text-warning"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b id="widget_count1">3752</b></h3>
                    <p>Visitors</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <p><span id="sparkline">&nbsp;</span></p>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-wallet text-success"></i>
                </div>
                <div class="text-right">
                    <h3><b id="widget_count3">3251</b></h3>
                    <p>Sales status</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <p><span class="linechart">&nbsp;</span></p>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-pulse text-danger"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b id="widget_count2">35</b></h3>
                    <p>Errors</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <p><span class="piechart">&nbsp;</span></p>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-twitter text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b id="widget_count4">1002</b></h3>
                    <p>Followers</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <p><span class="discretechart">&nbsp;</span></p>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="row m-t-10">
    <div class="col-lg-4 col-sm-6">
        <div class="card-box image_back">
            <div class="text-center">
                <i class="fa ti-apple fa-4x"></i>
                <p><b>APPLE</b>
                    <br> Connecting The Dots
                </p>
                <p><i class="fa ti-comment"></i>&nbsp;&nbsp; 5 | <i class="fa ti-thumb-up"></i> &nbsp;&nbsp;21
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="panel text-center">
            <div class="bg-info text-white p-56">
                <div id="for"><i class="fa ti-twitter fa-4x"></i></div>
                <p>Dashgum is here! Take a look and enjoy this new Bootstrap Dashboard theme.</p>
                <p class="user">@John_doe</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <a class="block block-link-hover2" href="javascript:void(0)">
            <div class="card-box text-center text-white circle_back_img">
                <div class="flip">
                    <div class="front">
                        <img class="img-circle" src="img/authors/avatar5.jpg" alt="avatar-image">
                    </div>
                    <div class="back">
                        <div class="row bg-primary">
                            <h2>Barry</h2>
                            <h3>Logan solutions</h3>
                            <div>Web Designer</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-sm-6">
        <a class="block block-link-hover2" href="javascript:void(0)">
            <div class="card-box text-center text-white weather_img">
                <div id="fls">
                    <i class="fa fa-cloud fa-4x"></i>
                </div>
                <h2>11º C</h2>
                <h4>BUDAPEST</h4>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <img src="img/gallery/full/39.jpg" class="img-responsive" alt="image-nature">
            </div>
            <div class="panel-body padding-15">
                <div class="clearfix col-lg-8 col-md-12 col-sm-12">
                    <h3>Salar de Uyuni</h3>
                    <p>Bolivia</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center col-xs-5">
                    <img src="img/authors/avatar4.jpg" class="img-circle img-responsive" alt="avatar 4">
                </div>
                <div class="clearfix col-xs-7 padding-15">
                    <h3>Winston Bowman</h3>
                    <p>photographer</p>
                </div>
            </div>
            <div class="panel-footer padding-15 bowman_img">
                <div class="row">
                    <div class="col-xs-4  p-10">
                        <div class="text-center">
                            <div id="ziu">
                                <i class="ti-comment text-white fa-5x"></i>
                            </div>
                        </div>
                        <div class="text-center text-white">
                            1568
                        </div>
                    </div>
                    <div class="col-xs-4  p-10">
                        <div class="text-center">
                            <div id="zo">
                                <i class="ti-user text-white fa-5x"></i>
                            </div>
                        </div>
                        <div class="text-center text-white">
                            866
                        </div>
                    </div>
                    <div class="col-xs-4  p-10">
                        <div class="text-center">
                            <div id="flp">
                                <i class="ti-heart text-white fa-5x"></i>
                            </div>
                        </div>
                        <div class="text-center text-white">
                            254
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="row text-center ">
                    <div>
                        <p>Backlight</p>
                        <div class="p-10">
                            <input type="range" id="bright" min="35" max="70" value="35">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body demo">
                <div class="text-white">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card-box">
            <div class="flip">
                <div class="row text-center">
                    <div class="front" id="test-circle1"></div>
                </div>
                <div class="row text-center">
                    <div class="back" id="test-circle3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card-box">
            <div class="row text-center">
                <div id="test-circle"></div>
            </div>
        </div>
    </div>
</div>
<!--=========================================-->
<div class="row">
    <div class="main-widgets">
        <div class="col-md-4 col-sm-4 text-center">
            <div class="status-data">
                <h4><b>Status</b></h4>
                <div class="row">
                    <div class="col-xs-4 daily-data">Daily Visits
                        <br> <b>243</b></div>
                    <div class="col-xs-4 monthly-data">Monthly Visits
                        <br> <b>7.29K</b></div>
                    <div class="col-xs-4 actual">Total Visits
                        <br> <b>86.4k</b></div>
                    <div class="col-xs-12">
                        <hr>
                    </div>
                    <div class="col-xs-12">
                        <span id="visitsspark-chart"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <div class="sales-data">
                <h4><b>Sales</b></h4>
                <div class="row">
                    <div class="col-xs-4 daily-data">Daily Sales
                        <br> <b>112</b></div>
                    <div class="col-xs-4 monthly-data">Monthly Sales
                        <br> <b>3.3K</b></div>
                    <div class="col-xs-4 actual">Total Sales
                        <br> <b>40.3k</b></div>
                    <div class="col-xs-12">
                        <hr>
                    </div>
                    <div class="col-xs-12">
                        <span id="salesspark-chart"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <div class="server-load">
                <h4><b>Server Load</b></h4>
                <div class="row">
                    <div class="col-xs-4 daily-data">Used Space
                        <br> <b>617 GB</b></div>
                    <div class="col-xs-4 monthly-data">Total Space
                        <br> <b>1 TB</b></div>
                    <div class="col-xs-4 actual">Actual Load
                        <br> <b>61.7 %</b></div>
                    <div class="col-xs-12">
                        <hr>
                    </div>
                    <div class="col-xs-12">
                        <span id="loadspark-chart1" class=""></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/countUp.js/js/countUp.js')}}"></script>
<!--Sparkline Chart-->
<script type="text/javascript" src="{{asset('vendors/jquery-knob/js/jquery.knob.js')}}"></script>
<!-- flip --->
<script src="{{asset('vendors/flip/js/jquery.flip.min.js')}}" type="text/javascript"></script>
<!-- circliful -->
<script src="{{asset('vendors/circliful/js/jquery.circliful.min.js')}}" type="text/javascript"></script>
<!-- sparkline charts -->
<script src="{{asset('js/custom_js/sparkline/jquery.flot.spline.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/widgets1.js')}}"></script>@stop
