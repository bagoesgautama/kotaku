@extends('layouts/default') {{-- Page title --}} @section('title') Draggable Portlets @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('css/portlet.css')}}" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Draggable Portlets</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Draggable Portlets
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row ui-sortable" id="sortable_portlets">
    <div class="col-md-4 sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-primary">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-success">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-info">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4 sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-danger">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-info">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-warning">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4 sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-warning">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box">
            <div class="portlet-title bg-primary">
                <div class="caption">
                    <i class="ti-menu"></i> Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box notsort">
            <div class="portlet-title bg-danger">
                <div class="caption">
                    <i class="ti-alert"></i> Non Draggable Portlet
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <p>Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                    </p>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('js/custom_js/draggable_portlets.jsjs/custom_js/draggable_portlets.js')}}" type="text/javascript"></script> @stop
