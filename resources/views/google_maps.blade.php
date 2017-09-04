@extends('layouts/default') {{-- Page title --}} @section('title') Gmaps @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{url('css/gmaps_cust.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Gmaps</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Maps</li>
        <li class="active">
            Gmaps
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map"></i> Basic
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="gmap-top" class="gmap"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map-alt"></i> Terrain
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="gmap-terrain" class="gmap"></div>
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
                                <i class="ti-map-alt"></i> Satellite
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="gmap-satellite" class="gmap"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-location-pin"></i> Markers
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="gmap-markers" class="gmap"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map-alt"></i> Styled Maps
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div id="gmap-styled" class="gmap"></div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="col-lg-6">
        <!-- Basic charts strats here-->
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-map-alt"></i> Maps Types
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div id="gmap-types" class="gmap"></div>
            </div>
        </div>
    </div>
</div>
<!-- row -->@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyADWjiTRjsycXf3Lo0ahdc7dDxcQb475qw&libraries=places"></script>
<script type="text/javascript" src="{{asset('vendors/gmaps/js/gmaps.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/custommaps.js')}}"></script>
@stop
