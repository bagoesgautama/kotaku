@extends('layouts/default') {{-- Page title --}} @section('title') Calendar @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/fullcalendar/css/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/fullcalendar/css/fullcalendar.print.css')}}" rel="stylesheet" media='print' type="text/css">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/calendar_custom.css')}}" rel="stylesheet" type="text/css" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Calendar</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Calendar</li>
        <li class="active">
            Calendar
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-3">
        <div class="box">
            <div class="box-title">
                <h3>Draggable Events</h3>
                <div class="pull-right box-toolbar">
                    <a href="#" class="btn btn-link btn-xs" data-toggle="modal" data-target="#myModal">
                        <i class="fa ti-plus"></i>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div id='external-events'>
                    <div class='external-event palette-warning'>Team Out</div>
                    <div class='external-event palette-primary'>Product Seminar</div>
                    <div class='external-event palette-danger'>Client Meeting</div>
                    <div class='external-event palette-info'>Repeating Event</div>
                    <div class='external-event palette-success'>Anniversary Celebrations</div>
                    <p class="well no-border no-radius">
                        <input type='checkbox' class="custom_icheck" id='drop-remove' />
                        <label for='drop-remove'>remove after drop</label>
                    </p>
                </div>
            </div>
            <div class="box-footer">
                <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Create
                                event</a>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-9">
        <div class="box">
            <div class="box-body">
                <div id="calendar"></div>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                                <i class="fa ti-plus icon-align"></i> Create Event
                            </h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" id="new-event" class="form-control" placeholder="Event">
                    <div class="input-group-btn">
                        <button type="button" id="color-chooser-btn" class="btn dropdown-toggle" data-toggle="dropdown">
                            Select
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" id="color-chooser">
                            <li>
                                <a class="palette-primary" href="#">Primary</a>
                            </li>
                            <li>
                                <a class="palette-success" href="#">Success</a>
                            </li>
                            <li>
                                <a class="palette-info" href="#">Info</a>
                            </li>
                            <li>
                                <a class="palette-warning" href="#">warning</a>
                            </li>
                            <li>
                                <a class="palette-danger" href="#">Danger</a>
                            </li>
                            <li>
                                <a class="palette-default" href="#">Default</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                </div>
                <!-- /input-group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" id="close_calendar_event" data-dismiss="modal">
                    Close
                    <i class="fa ti-close icon-align"></i>
                </button>
                <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                    <i class="fa ti-plus icon-align"></i> Add
                </button>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/fullcalendar/js/fullcalendar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}"></script>
<script src="{{asset('js/custom_js/calendar_custom.js')}}" type="text/javascript"></script>@stop
