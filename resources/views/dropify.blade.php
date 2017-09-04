@extends('layouts/default') {{-- Page title --}} @section('title') Dropify @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/dropify/css/dropify.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/dropify.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dropify</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Gallery</li>
        <li class="active">
            Dropify
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-fw ti-dropbox"></i> Dropify</h3>
            </div>
            <div class="panel-body p-30">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Dropify Basic</h5>
                        <input type="file" class="dropify" />
                    </div>
                    <div class="col-md-6">
                        <h5>AllowedFileExtensions (PDF, PNG and PSD )</h5>
                        <input type="file" class="dropify" data-allowed-file-extensions="pdf png psd" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Max File Size</h5>
                        <input type="file" data-max-file-size="3M" />
                    </div>
                    <div class="col-md-6">
                        <h5>Disabled</h5>
                        <input type="file" class="dropify" disabled="disabled" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Default File</h5>
                        <input type="file" class="dropify" data-default-file="img/pages/slider2.jpg" />
                    </div>
                    <div class="col-md-6">
                        <h5>Without Remove Button</h5>
                        <input type="file" class="dropify" data-show-remove="false" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/dropify/js/dropify.js')}}"></script>
<script src="{{asset('js/custom_js/dropify_custom.js')}}" type="text/javascript"></script> @stop
