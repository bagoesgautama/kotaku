@extends('layouts/default') {{-- Page title --}} @section('title') Advanced Calendar @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-calendar/css/calendar.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/jquerydaterangepicker/css/daterangepicker.min.css')}}">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/calendar_custom2.css')}}" rel="stylesheet" type="text/css" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Advanced Calendar</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Calendar</li>
        <li class="active">
            Advanced Calendar
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="page-header">
    <div class="pull-right form-inline">
        <div class="btn-group m-t-10">
            <button class="btn btn-primary" data-calendar-nav="prev">
                <i class="fa fa-fw ti-angle-double-left" aria-hidden="true"></i> Prev
            </button>
            <button class="btn btn-default" data-calendar-nav="today">Today</button>
            <button class="btn btn-primary" data-calendar-nav="next">Next <i class="fa fa-fw ti-angle-double-right" aria-hidden="true"></i>
            </button>
        </div>
        <div class="btn-group m-t-10">
            <button class="btn btn-warning" data-calendar-view="year">Year</button>
            <button class="btn btn-warning active" data-calendar-view="month">Month</button>
            <button class="btn btn-warning" data-calendar-view="week">Week</button>
            <button class="btn btn-warning" data-calendar-view="day">Day</button>
        </div>
    </div>
    <h3></h3>
</div>
<div class="row">
    <div class="col-md-9">
        <div id="calendar" class="m-b-25"></div>
    </div>
    <div class="col-md-3 calendar-settings">
        <div class="row">
            <div class="col-md-12">
                <h4>Calendar Settings</h4>
                <div class="input-group">
                    <label for="first_day">First day of week </label>
                    <select id="first_day" class="form-control">
                        <option value="" selected="selected">language-dependant</option>
                        <option value="2">Sunday</option>
                        <option value="1">Monday</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="language">Select Language</label>
                    <select id="language" class="form-control">
                        <option value="">default: English-US</option>
                        <option value="bg-BG">Bulgarian</option>
                        <option value="nl-NL">Dutch</option>
                        <option value="fr-FR">French</option>
                        <option value="de-DE">German</option>
                        <option value="el-GR">Greek</option>
                        <option value="hu-HU">Hungarian</option>
                        <option value="id-ID">Bahasa Indonesia</option>
                        <option value="it-IT">Italian</option>
                        <option value="pl-PL">Polish</option>
                        <option value="pt-BR">Portuguese (Brazil)</option>
                        <option value="ro-RO">Romania</option>
                        <option value="es-CO">Spanish (Colombia)</option>
                        <option value="es-MX">Spanish (Mexico)</option>
                        <option value="es-ES">Spanish (Spain)</option>
                        <option value="ru-RU">Russian</option>
                        <option value="sk-SR">Slovak</option>
                        <option value="sv-SE">Swedish</option>
                        <option value="zh-CN">简体中文</option>
                        <option value="zh-TW">繁體中文</option>
                        <option value="ko-KR">한국어</option>
                        <option value="th-TH">Thai (Thailand)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 m-t-10">
                <label class="checkbox">
                    <input type="checkbox" value="#events-modal" id="events-in-modal"> Open events in modal window
                </label>
            </div>
            <div class="col-md-12 m-t-10">
                <label class="checkbox">
                    <input type="checkbox" id="format-12-hours"> 12 Hour format
                </label>
            </div>
            <div class="col-md-12 m-t-10">
                <label class="checkbox">
                    <input type="checkbox" id="show_wb" checked> Show week box
                </label>
            </div>
            <div class="col-md-12 m-t-10">
                <label class="checkbox">
                    <input type="checkbox" id="show_wbn" checked> Show week box number
                </label>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-12">
                <div>
                    <h4>Events List</h4>
                </div>
                <ul id="eventlist" class="nav nav-list"></ul>
                <div class="m-t-10">
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Create
                                    event</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                                <i class="fa ti-plus icon-align"></i> Create Event
                            </h4>
            </div>
            <form role="form" name="eventform" id="eventform">
                <div class="modal-body">
                    <div class="input-group">
                        <label for="new-event">Event Name</label>
                        <input type="text" id="new-event" class="form-control" placeholder="Event">
                    </div>
                    <div class="input-group">
                        <label for="eventclass">Event Class</label>
                        <select name="eventclass" id="eventclass" class="form-control">
                            <option value="event-important" selected>Important</option>
                            <option value="event-success">Success</option>
                            <option value="event-primary">primary</option>
                            <option value="event-default">Default</option>
                            <option value="event-info">Info</option>
                            <option value="event-warning">Warning</option>
                        </select>
                    </div>
                    <label for="event_url">Event URL</label>
                    <div class="input-group">
                        <span class="input-group-addon">HTTP://</span>
                        <input type="text" class="form-control pull-right" id="event_url" placeholder="Enter The URL related to event" />
                    </div>
                    <div class="input-group">
                        <label for="date-range0">Date Range</label>
                        <input type="text" class="form-control pull-right" id="date-range0" placeholder="Select Date Range For Event" />
                    </div>
                    <!-- /input-group -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" id="close_calendar_event" data-dismiss="modal">
                        Close
                        <i class="fa ti-close icon-align"></i>
                    </button>
                    <button type="button" class="btn btn-success pull-left" id="add-new-event">
                        <i class="fa ti-plus icon-align"></i> Add
                    </button>
                    <button type="reset" class="hidden">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="events-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Event</h3>
            </div>
            <div class="modal-body" style="height: 400px">
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-danger">Close</a>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/underscore/js/underscore-min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-calendar/js/calendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/calendar_custom2.js')}}" type="text/javascript"></script>
@stop
