@extends('layouts/default') {{-- Page title --}} @section('title') Advanced DatePickers @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/datetime/css/jquery.datetimepicker.css')}}">
<link href="{{asset('vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/datepicker.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Advanced DatePickers</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            Advanced DatePickers
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-calendar"></i> DateTime picker
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <!-- Date range -->
                    <div class="form-group">
                        <label for="datetimepicker">
                            Date and Time Picker:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datetimepicker" />
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label for='datetimepicker1'>
                            Date Picker:
                        </label>
                        <div class="input-group ">
                            <input type="text" class="form-control" id="datetimepicker1">
                            <span class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="datetimepicker2">
                            Time Picker:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-time"></i>
                            </div>
                            <input id="datetimepicker2" size="30" value="" class="form-control">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label for="datetimepicker_unixtime">
                            Date Time Picker from Unixtime:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input id="datetimepicker_unixtime" class="form-control" value="">
                            <span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="datetimepicker7">
                            MinDate and MaxDate:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input class="form-control" id="datetimepicker7" value="">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label for="datetimepicker8">
                            Invert settings minDate and maxDate:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input class="form-control" id="datetimepicker8">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="check_in_date">Check-In, Check-out Date Picker:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group m-t-10">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i></div>
                                    <input class="form-control" id="check_in_date" placeholder="Check-In Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group m-t-10">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i></div>
                                    <input class="form-control" id="check_out_date" placeholder="Check Out Date">
                                </div>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#large_modal">Date Time picker Modal
                            </button>
                            <div id="large_modal" class="modal fade animated " role="dialog">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Date and Time Picker</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <input data-format="dd/MM/yyyy hh:mm:ss" type="text" id="datetimepicker12" class="form-control" />
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw ti-calendar"></i>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.form group -->
                <!-- time picker -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-calendar"></i> Air Date Picker
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <!-- Date range -->
                    <div class="form-group">
                        <label for="my-element">
                            Date Picker:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" data-language='en' id="my-element" />
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label for="my-element1">
                            Multiple Date Picker:
                        </label>
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control" data-language='en' data-multiple-dates="3" data-multiple-dates-separator=", " id="my-element1" />
                            <span class="input-group-addon">
                                            <i class="fa fa-fw ti-calendar"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="monthpicker">
                            Month and Year selection:
                        </label>
                        <div class="input-group clockpicker-with-callbacks">
                            <input type="text" class="form-control" data-language='en' data-min-view="months" data-view="months" data-date-format="MM yyyy" id="monthpicker" />
                            <span class="input-group-addon">
                                            <i class="fa fa-fw ti-calendar"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="minMaxExample">
                            Minimum and Maximum Dates:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-time"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="minMaxExample">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label for="timepick">
                            Date and Time Picker:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input id="timepick" class="form-control pull-right" data-language='en' data-timepicker="true" data-time-format='hh:ii aa' />
                        </div>
                    </div>
                    <!-- /.form group -->
                    <!-- time picker -->
                    <!-- range of dates -->
                    <div class="form-group">
                        <label for="dateranges">
                            Range of Dates:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="form-control" id="dateranges" />
                        </div>
                    </div>
                    <!-- /.form group -->
                    <!-- Disable days of week -->
                    <div class="form-group">
                        <label for="disabled-days">
                            Disable Days of Week:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="disabled-days" />
                        </div>
                    </div>
                    <!-- /.end Disable days of week -->
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/datetime/js/jquery.datetimepicker.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/airdatepicker/js/datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/airdatepicker/js/datepicker.en.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/advanceddate_pickers.js')}}"></script> @stop
