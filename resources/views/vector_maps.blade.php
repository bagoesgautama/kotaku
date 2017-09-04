@extends('layouts/default') {{-- Page title --}} @section('title') Vector Maps @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css')}}" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/jqvmap/css/jqvmap.css')}}">
<link href="{{asset('css/custom_css/custom_map.css')}}" rel="stylesheet" type="text/css" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Vector Maps</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Maps</li>
        <li class="active">
            Vector Maps
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> World
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="map_size" id="vmapworld"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> Asian
                            </h4>
                <span class="pull-right">
                                     <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="vmapasian" class="map_size"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> Europe
                            </h4>
                <span class="pull-right">
                                     <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="vmapeurope" class="map_size"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> North America
                            </h4>
                <span class="pull-right">
                                     <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="vmapnamerica" class="map_size"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> Germany
                            </h4>
                <span class="pull-right">
                                     <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="vmapgermany" class="map_size"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> Russia
                            </h4>
                <span class="pull-right">
                                     <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="vmaprussia" class="map_size"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.europe.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.germany.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.russia.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.asia.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.north-america.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jqvmap/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('js/custom_js/vector-maps.js')}}" type="text/javascript"></script>@stop
