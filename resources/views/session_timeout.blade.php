@extends('layouts/default') {{-- Page title --}} @section('title') Session Timeout @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('css/session_timeout.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Session Timeout</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Session Timeout
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">Widget settings form goes here</div>
            <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-lock"></i> Session Timeout
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="note note-success">
                    <p>
                        <span class="alert-information">
                                        If you keep looking at the page with out any actions for <b>7</b> Seconds,the page will redirect to lock screen
                                        after showing an Alert.
                                    </span>
                        <br>
                        <span class="official-link">
                                        It is an Enhanced Security feature for your Page.
                                    </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('js/jquery.sessionTimeout.min.js')}}"></script>
<script src="{{asset('js/custom_js/session_timeout.js')}}" type="text/javascript"></script>
@stop
