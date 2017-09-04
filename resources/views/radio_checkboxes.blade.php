@extends('layouts/default') {{-- Page title --}} @section('title') Radios and Checkboxes @stop {{-- local styles --}} @section('header_styles')
<!--page level css -->
<!--prettycheckable --->
<link href="{{asset('vendors/prettycheckable/css/prettyCheckable.css')}}" rel="stylesheet" type="text/css" />
<!-- labelauty -->
<link href="{{asset('vendors/jquerylabel/css/jquery-labelauty.css')}}" rel="stylesheet" type="text/css" />
<!--select css-->
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" />
<!--clock face css-->
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" />
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/awesomebootstrapcheckbox/css/awesome-bootstrap-checkbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/radio_checkbox.css')}}">
<!--end of page level css-->
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Radios and Checkboxes</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            Radios and Checkboxes
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-arrow-circle-down"></i> iCheck - Checkbox Inputs
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="square-blue" checked/>
                        </label>
                        <label>
                            <input type="checkbox" class="square-blue" />
                        </label>
                        <label>
                            <input type="checkbox" class="square-blue" disabled/>
                        </label>
                        <label class="m-l-10">
                            Square blue skin checkbox
                        </label>
                    </div>
                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="flat-red" checked/>
                        </label>
                        <label>
                            <input type="checkbox" class="flat-red" />
                        </label>
                        <label>
                            <input type="checkbox" class="flat-red" disabled/>
                        </label>
                        <label class="m-l-10">
                            Flat red skin checkbox
                        </label>
                    </div>
                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="minimal" checked/>
                        </label>
                        <label>
                            <input type="checkbox" class="minimal" />
                        </label>
                        <label>
                            <input type="checkbox" class="minimal" disabled/>
                        </label>
                        <label class="m-l-10">
                            Minimal skin checkbox
                        </label>
                    </div>
                    <!-- Minimal red style -->
                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="minimal-red" checked/>
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-red" />
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-red" disabled/>
                        </label>
                        <label class="m-l-10">
                            Minimal red skin checkbox
                        </label>
                    </div>
                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="minimal-green" checked/>
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-green" />
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-green" disabled/>
                        </label>
                        <label class="m-l-10">
                            Minimal green skin checkbox
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-basketball"></i> iCheck - Radio Inputs
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <!-- radio -->
                <div class="form-group">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" class="square-blue" checked>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" class="square-blue">
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" class="square-blue" disabled/>
                    </label>
                    <label class="m-l-10">
                        Square blue skin radio
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="r3" class="flat-red" checked/>
                    </label>
                    <label>
                        <input type="radio" name="r3" class="flat-red" />
                    </label>
                    <label>
                        <input type="radio" name="r3" class="flat-red" disabled/>
                    </label>
                    <label class="m-l-10">
                        Flat red skin radio
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" name="r1" class="minimal" checked/>
                    </label>
                    <label>
                        <input type="radio" name="r1" class="minimal" />
                    </label>
                    <label>
                        <input type="radio" name="r1" class="minimal" disabled/>
                    </label>
                    <label class="m-l-10">
                        Minimal skin radio
                    </label>
                </div>
                <!-- radio -->
                <div class="form-group">
                    <label>
                        <input type="radio" name="r2" class="minimal-red" checked/>
                    </label>
                    <label>
                        <input type="radio" name="r2" class="minimal-red" />
                    </label>
                    <label>
                        <input type="radio" name="r2" class="minimal-red" disabled/>
                    </label>
                    <label class="m-l-10">
                        Minimal red skin radio
                    </label>
                </div>
                <!-- radio -->
                <div class="form-group">
                    <label>
                        <input type="radio" name="r4" class="minimal-green" checked/>
                    </label>
                    <label>
                        <input type="radio" name="r4" class="minimal-green" />
                    </label>
                    <label>
                        <input type="radio" name="r4" class="minimal-green" disabled/>
                    </label>
                    <label class="m-l-10">
                        Minimal green skin radio
                    </label>
                </div>
                <!-- radio -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-check-box"></i> Multiple Select with Search Option
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="search" class="form-control" id="search" placeholder="Search your options..">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="searchable-container">
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Coffee</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Tea</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Cool Drink</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="searchable-container">
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Burger</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Pizza</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="items col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="info-block block-info clearfix">
                                    <div class="square-box pull-left">
                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                    </div>
                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                        <label class="btn btn-default">
                                            <input type="checkbox" name="var_id[]" value="">
                                            <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                            <br>
                                            <span>Cookies</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <i class="fa fa-fw ti-check-box"></i> Labelauty Radio and Checkboxes
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body" id="lby-content">
                <div class="row" id="lby-demo">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <h4>Labeled Checkboxes</h4>
                        <input class="to-labelauty synch-icon1" data-labelauty="Unselected|Australia" type="checkbox" checked/>
                        <input class="to-labelauty terms-icon" type="checkbox" data-labelauty="Unselected|Selected" />
                        <input class="to-labelauty synch-icon" type="checkbox" data-labelauty="I am disabled!" disabled/>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <h4>Non-labeled Check</h4>
                        <input class="to-labelauty-icon check-icon" type="checkbox" checked/>
                        <input class="to-labelauty-icon check-icon" type="checkbox" />
                        <input class="to-labelauty-icon check-icon" type="checkbox" disabled checked/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <h4>Labeled Radio Buttons</h4>
                        <input class="to-labelauty synch-icon2" type="radio" name="rd2" data-labelauty="Unselected|USA" />
                        <input class="to-labelauty terms-icon" type="radio" name="rd2" data-labelauty="Unselected|Selected" checked/>
                        <input class="to-labelauty synch-icon" type="radio" name="rd3" disabled checked/>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <h4>Non-labeled Radio</h4>
                        <input class="to-labelauty-icon" type="radio" name="rd4" checked/>
                        <input class="to-labelauty-icon" type="radio" name="rd4" />
                        <input class="to-labelauty-icon" type="radio" name="rd3" disabled checked/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-check"></i> jQuery prettyCheckable
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="Test1">Right positioned label</label>
                    <input type="checkbox" class="test1" value="1" id="Test1" name="Test1" checked/>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="TestDisabled" value="3" id="TestDisabled" name="TestDisabled" disabled data-label='Disabled Checkbox'>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="test2" value="2" id="Test2" name="Test2" data-label="Left positioned label" data-labelPosition="left" />
                </div>
                <div class="form-group">
                    <label class="test_radio">Radios! </label>
                    <input type="radio" class="test3" value="1" id="Test3_0" name="Test3" data-label="Yes" checked data-customclass="margin-right" />
                    <input type="radio" class="test4" value="2" id="Test3_1" name="Test3" data-label="No" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-arrow-circle-up"></i> Awesome Radio &amp; Checkbox
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 awesomeradio_grid_sep">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Checkboxes</h4>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-default">
                                            <input id="checkbox1" class="styled" type="checkbox">
                                            <label for="checkbox1">
                                                &nbsp;Default
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox2" class="styled" type="checkbox">
                                            <label for="checkbox2">
                                                &nbsp;Primary
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox3" class="styled" type="checkbox">
                                            <label for="checkbox3">
                                                &nbsp;Success
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-info">
                                            <input id="checkbox4" class="styled" type="checkbox">
                                            <label for="checkbox4">
                                                &nbsp;Info
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-warning">
                                            <input id="checkbox5" type="checkbox" class="styled">
                                            <label for="checkbox5">
                                                &nbsp;Warning
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-danger">
                                            <input id="checkbox6" type="checkbox" class="styled">
                                            <label for="checkbox6">
                                                &nbsp;Danger
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Inline checkboxes</h4>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-inline m-l-18">
                                            <input type="checkbox" class="styled" id="inlineCheckbox1" value="option1">
                                            <label for="inlineCheckbox1"> &nbsp;Inline One </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-inline m-l-18">
                                            <input type="checkbox" class="styled" id="inlineCheckbox2" value="option1">
                                            <label for="inlineCheckbox2"> &nbsp;Inline Two </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-inline m-l-18">
                                            <input type="checkbox" class="styled" id="inlineCheckbox3" value="option1">
                                            <label for="inlineCheckbox3"> &nbsp;Inline Three </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Circled checkboxes</h4>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-circle">
                                            <input id="checkbox7" class="styled" type="checkbox">
                                            <label for="checkbox7">
                                                &nbsp;Simply Rounded
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-info checkbox-circle">
                                            <input id="checkbox8" class="styled" type="checkbox">
                                            <label for="checkbox8">
                                                &nbsp;Me too
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                                    Disabled
                                                </h4>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox">
                                            <input class="styled" id="checkbox9" type="checkbox" disabled>
                                            <label for="checkbox9">
                                                &nbsp;Can't check
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-success">
                                            <input class="styled styled" id="checkbox10" type="checkbox" disabled checked>
                                            <label for="checkbox10">
                                                &nbsp;This too
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="checkbox checkbox-warning checkbox-circle">
                                            <input class="styled" id="checkbox11" type="checkbox" disabled checked>
                                            <label for="checkbox11">
                                                &nbsp;And this
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Checkboxes with indeterminate state</h4>
                                    <div class="col-md-12">
                                        <div class="checkbox checkbox-primary">
                                            <input id="indeterminateCheckbox" class="styled" type="checkbox" onclick="changeState(this)">
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Radios</h4>
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <input type="radio" name="radio1" id="radio1" value="option1">
                                            <label for="radio1">
                                                &nbsp;Small
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="radio1" id="radio2" value="option2">
                                            <label for="radio2">
                                                &nbsp;Big
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio radio-danger">
                                            <input type="radio" name="radio2" id="radio3" value="option1">
                                            <label for="radio3">
                                                &nbsp;Next
                                            </label>
                                        </div>
                                        <div class="radio radio-danger">
                                            <input type="radio" name="radio2" id="radio4" value="option2">
                                            <label for="radio4">
                                                &nbsp;One
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                                    Disabled state
                                                </h4>
                                    <div class="col-md-6">
                                        <div class="radio radio-danger">
                                            <input type="radio" name="radio3" id="radio5" value="option1" disabled>
                                            <label for="radio5">
                                                &nbsp;Next
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input type="radio" name="radio3" id="radio6" value="option2" checked disabled>
                                            <label for="radio6">
                                                &nbsp;One
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Inline radios</h4>
                                    <div class="col-md-6">
                                        <div class="radio radio-info radio-inline m-l-18">
                                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline">
                                            <label for="inlineRadio1"> &nbsp;Inline One </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio radio-inline m-l-18">
                                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                            <label for="inlineRadio2"> &nbsp;Inline Two </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                                    Radio As Checkboxes
                                                </h4>
                                    <div class="checkbox checkbox-default">
                                        <input type="radio" name="radio4" id="radio7" value="option1" checked>
                                        <label for="radio7">
                                            &nbsp;Default
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-success">
                                        <input type="radio" name="radio4" id="radio8" value="option2">
                                        <label for="radio8">
                                            &nbsp;<span>Success</span>
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-danger">
                                        <input type="radio" name="radio4" id="radio9" value="option3">
                                        <label for="radio9">
                                            &nbsp;<span>Danger</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<!-- begining of page level js -->
<!---prettycheckbale --->
<script src="{{asset('vendors/prettycheckable/js/prettyCheckable.min.js')}}"></script>
<!--- labelauty -->
<script src="{{asset('vendors/jquerylabel/js/jquery-labelauty.js')}}"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}"></script>
<script src="{{asset('js/custom_js/radio_checkbox.js')}}"></script>
<!-- end of page level js -->
@stop
