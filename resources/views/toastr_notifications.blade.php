@extends('layouts/default') {{-- Page title --}} @section('title') Toastr Notifications @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/toastr/css/toastr.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/iCheck/css/minimal/blue.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/toastr_notificatons.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Toastr Notifications</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Toastr Notifications
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-bell"></i> Toastr Notifications
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-fw ti-info-alt text-info message"></i> When changing
                                            toastr position clear all toasts to see the effect</h4></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="title"><b>Title</b></label>
                                <input id="title" type="text" class="form-control" value="Toastr Notifications" placeholder="Enter a title ...">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="message"><b>Message</b></label>
                                <textarea class="form-control resize_vertical" id="message" rows="3" placeholder="Enter a message ...">Gnome &amp; Growl type non-blocking notifications</textarea>
                            </div>
                            <form>
                                <div class="form-group" id="positionGroup">
                                    <label class="position-type"><b>Toaster Position</b></label>
                                    <select name="toast-position" class="form-control" id="position-change">
                                        <option value="0">Top Left</option>
                                        <option value="1" selected>Top Right</option>
                                        <option value="2">Top Center</option>
                                        <option value="3">Top Full Width</option>
                                        <option value="4">Bottom Left</option>
                                        <option value="5">Bottom Right</option>
                                        <option value="6">Bottom Center</option>
                                        <option value="7">Bottom Full Width</option>
                                    </select>
                                    <div hidden>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-top-left"> Top Left
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-top-right" checked=""> Top Right
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-top-center" /> Top Center
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-top-full-width"> Top Full Width
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-bottom-left"> Bottom Left
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-bottom-right"> Bottom Right
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-bottom-center" /> Bottom Center
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" class="custom-radio" name="positions" value="toast-bottom-full-width"> Bottom Full Width
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 ">
                            <div class="form-group" id="toastTypeGroup">
                                <label class="toast-type">Toast Type</label>
                                <div>
                                    <label class="text-success">
                                        <input type="radio" name="toasts" class="custom-radio" value="success" checked=""> Success
                                    </label>
                                </div>
                                <div>
                                    <label class="text-info">
                                        <input type="radio" name="toasts" class="custom-radio" value="info"> Info
                                    </label>
                                </div>
                                <div>
                                    <label class="text-warning">
                                        <input type="radio" name="toasts" class="custom-radio" value="warning"> Warning
                                    </label>
                                </div>
                                <div>
                                    <label class="text-danger">
                                        <input type="radio" name="toasts" class="custom-radio" value="error"> Error
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="closeButton">
                                        <input id="closeButton" type="checkbox" checked="" class="input-small custom-checkbox"> Close Button
                                    </label>
                                </div>
                                <div>
                                    <label for="addBehaviorOnToastClick">
                                        <input id="addBehaviorOnToastClick" type="checkbox" class="input-small custom-checkbox"> Add behavior on toast click
                                    </label>
                                </div>
                                <div>
                                    <label for="debugInfo">
                                        <input id="debugInfo" type="checkbox" class="input-small custom-checkbox"> Debug
                                    </label>
                                </div>
                                <div>
                                    <label for="progressBar">
                                        <input id="progressBar" type="checkbox" class="input-small custom-checkbox" /> Progress Bar
                                    </label>
                                </div>
                                <div>
                                    <label for="preventDuplicates">
                                        <input id="preventDuplicates" type="checkbox" class="input-small custom-checkbox" /> Prevent Duplicates
                                    </label>
                                </div>
                                <div>
                                    <label for="addClear">
                                        <input id="addClear" type="checkbox" class="input-small custom-checkbox" /> Force clearing button
                                    </label>
                                </div>
                                <div>
                                    <label for="newestOnTop">
                                        <input id="newestOnTop" type="checkbox" class="input-small custom-checkbox" /> Newest on top
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="controls">
                                <div class="form-group">
                                    <label class="control-label" for="showEasing">Show Easing</label>
                                    <select class="form-control input-small" id="showEasing">
                                        <option>swing</option>
                                        <option>linear</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="hideEasing">Hide Easing</label>
                                    <select id="hideEasing" class="form-control input-small">
                                        <option>swing</option>
                                        <option>linear</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="showMethod">Show Method</label>
                                    <select id="showMethod" class="form-control input-small">
                                        <option value="show">show</option>
                                        <option value="fadeIn">fadeIn</option>
                                        <option value="slideDown">slideDown</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="hideMethod">Hide Method</label>
                                    <select class="form-control input-small" id="hideMethod">
                                        <option value="">hide</option>
                                        <option value="fadeOut">fadeOut</option>
                                        <option value="slideUp">slideUp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="controls">
                                <div class="form-group">
                                    <label class="control-label" for="showDuration">Show Duration</label>
                                    <input id="showDuration" type="text" placeholder="ms" class="form-control input-small" value="1000">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="hideDuration">Hide Duration</label>
                                    <input id="hideDuration" type="text" placeholder="ms" class="form-control input-small" value="1000">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="timeOut">Time out</label>
                                    <input id="timeOut" type="text" placeholder="ms" class="form-control input-small" value="5000">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="timeOut">Extended time out</label>
                                    <input id="extendedTimeOut" type="text" placeholder="ms" class="form-control input-small" value="1000">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-sm-2 col-xs-6">
                                <button type="button" class="btn btn-success btn-raised toastrshow" id="showtoast">
                                    Show Toast
                                </button>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <button type="button" class="btn btn-danger btn-raised toastrshow" id="cleartoasts">
                                    Clear Toasts
                                </button>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <button type="button" class="btn btn-warning btn-raised toastrshow" id="clearlasttoast">
                                    Clear Last Toast
                                </button>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row margin-top-10">
                        <div class="col-md-12">
                            <pre id="toastrOptions"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/toastr/js/toastr.min.js')}}"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/toastr_notifications.js')}}"></script>@stop
