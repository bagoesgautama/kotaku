@extends('layouts/default') {{-- Page title --}} @section('title') DatePickers @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/daterangepicker/css/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datedropper/datedropper.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/timedropper/css/timedropper.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/jquerydaterangepicker/css/daterangepicker.min.css')}}">
<!--clock face css-->
<link rel="stylesheet" type="text/css" href="{{asset('vendors/clockpicker/css/bootstrap-clockpicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/datepicker.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>DatePickers</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            DatePickers
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-calendar"></i> Date and Time range picker
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
                        <label>
                            Date picker:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="date-range0" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>
                            Date and Time Picker:
                        </label>
                        <div class="input-group ">
                            <input type="text" class="form-control" id="dateclock" placeholder="YYYY-MM-DD HH:MM ~ YYYY-MM-DD HH:MM">
                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Span instead of Input:
                        </label>
                        <div class="input-group">
                            <span id="date-range9" style="background-color:#6699cc; color:white;padding:3px; cursor:pointer; border-radius:4px;">YYYY-MM-DD to YYYY-MM-DD</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Date picker with Animation:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-time"></i>
                            </div>
                            <input id="date-range50" size="30" value="" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>
                            Hotel booking:
                        </label>
                        <div class="input-group">
                            <input id="hotel-booking" class="form-control" size="60" value="" placeholder="Days Booked">
                            <span></span>
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Select backward:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input class="form-control" id="date-range26" size="30" value="" placeholder="YYYY-MM-DD to YYYY-MM-DD">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label>
                            Single Date mode with single month:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input class="form-control" id="date-range13-2" size="40" placeholder="YYYY-MM-DD">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label>
                            Batch mode ( week ):
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input class="form-control" id="date-range14" size="60" value="" placeholder="YYYY-MM-DD to YYYY-MM-DD">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
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
                                <i class="ti-paint-bucket"></i> Date & Time Dropper
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>
                        Date dropper:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="departure" placeholder="DD/MM/YYYY" />
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label>
                        Date format:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="departure1" placeholder="YYYY-MM-DD" />
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label>
                        Maximum Year:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="departure2" placeholder="DD/MM/YYYY" />
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label>
                        Animate date dropper
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-calendar"></i>
                        </div>
                        <input type="text" class="form-control" id="departure3" placeholder="DD/MM/YYYY" />
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label>
                        Time dropper:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-time"></i>
                        </div>
                        <input type="text" class="form-control" id="alarm" placeholder="HH-MM" />
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group">
                    <label>
                        Meridian time dropper:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-time"></i>
                        </div>
                        <input type="text" class="form-control" id="alarm1" placeholder="HH-MM" />
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="form-group">
                    <label>
                        Animate time dropper:
                    </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-fw ti-time"></i>
                        </div>
                        <input type="text" class="form-control" id="alarm2" placeholder="HH-MM" />
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-calendar"></i> Date Range picker
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
                        <label>
                            Date range:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation" placeholder="MM/DD/YYYY - MM/DD/YYYY" />
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>
                            Clock Picker:
                        </label>
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control" value="Now" placeholder="HH:MM">
                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Call Backs Clock Picker:
                        </label>
                        <div class="input-group clockpicker-with-callbacks">
                            <input type="text" class="form-control" value="Now" placeholder="HH:MM">
                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            Date and time range:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-time"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservationtime" placeholder="MM/DD/YYYY HH:MM-MM/DD/YYYY HH:MM">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>
                            Predefined Date range:
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                            <i class="fa ti-calendar"></i>
                                        </span>
                            <input type="text" class="form-control" id="reportrange" placeholder="DD/MM/YYYY-DD/MM/YYYY">
                        </div>
                    </div>
                    <!-- /.form group -->
                    <!-- time picker -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-book"></i> Input masks
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>
                            Date masks:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- phone mask -->
                    <div class="form-group">
                        <label>
                            US phone mask:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-mobile"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- phone mask -->
                    <div class="form-group">
                        <label>
                            Intl US phone mask:
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-mobile"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- IP mask -->
                    <div class="form-group">
                        <label>IP mask:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-fw ti-desktop"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<!-- InputMask -->
<script src="{{asset('vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/inputmask/inputmask.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/inputmask/jquery.inputmask.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/inputmask/inputmask/inputmask.extensions.js')}}" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="{{asset('vendors/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="{{asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/clockpicker/js/bootstrap-clockpicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/datedropper/datedropper.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/timedropper/js/timedropper.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/datepickers.js')}}" type="text/javascript"></script>
@stop
