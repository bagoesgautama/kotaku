@extends('layouts/default') {{-- Page title --}} @section('title') Advanced Maps @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/leaflet/css/leaflet.css')}}" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Advanced Maps</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Advanced Maps
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                                <i class="ti-location-arrow"></i> Basic
                            </h4>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body" style="padding:10px !important;">
                <div id="advanced_map" class="gmap"></div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/leaflet/js/leaflet-src.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/advanced_maps.js')}}"></script> @stop
