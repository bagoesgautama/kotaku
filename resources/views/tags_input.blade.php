@extends('layouts/default') {{-- Page title --}} @section('title') Tags Input @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/insignia/css/insignia.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('css/custom_css/insignia_custom.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Tags Input</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Tags Input
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-tag"></i> Markup
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="example example_markup">
                    <div class='parent'>
                        <label for='ty' class="m-t-b-15">Enter a space-separated list of tags:</label>
                        <div class='input'>
                            <input id='ty' value="hi">
                        </div>
                    </div>
                    <label for='custom' class="m-t-b-15">Enter a list of tags using a custom delimiter: </label>
                    <div class='input'>
                        <input id='custom' value="hello">
                    </div>
                    <label for='del' class="m-t-b-15">If you want, you can allow humans to remove tags by clicking on the crosses.
                    </label>
                    <div class='input'>
                        <input id='del' value="welcome">
                    </div>
                    <label for='def' class="m-t-b-15">Default values are naturally welcome.</label>
                    <div class='input'>
                        <input id='def' value='tagging as a service'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-tag"></i> Categorizing tags
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="example example_tagclass">
                    <label for='dup' class="m-t-b-15">Duplicates are okay sometimes: </label>
                    <div class='input'>
                        <input id='dup' value='hello hello hello'>
                    </div>
                    <label for='lng' class="m-t-b-15">Really long lists behave reasonably well, too.</label>
                    <div class='input'>
                        <input id='lng' value='Really long lists behave reasonably well, too. Especially if you take into account this is JavaScript!'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/insignia/js/insignia.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/insignia_custom.js')}}"></script> @stop
