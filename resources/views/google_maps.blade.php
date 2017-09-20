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
    <div class="col-md-12 " >
            <div class="panel-body" >
                <div id="gmap-top" class="gmap" style="height:600px"></div>
            </div>
    </div>
</div>

<!-- row -->
@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCZ3sUKS6BLuxnrGVQl2xRR2FFaljwPb2o&libraries=places"></script>
<script type="text/javascript" src="{{asset('vendors/gmaps/js/gmaps.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/custommaps.js')}}"></script>
@stop
