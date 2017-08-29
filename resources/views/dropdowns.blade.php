@extends('layouts/default') {{-- Page title --}} @section('title') Dropdowns @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dropdowns</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            Dropdowns
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-widget-alt"></i> Select2
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select21" class="control-label">
                                Select2 single select
                            </label>
                            <select id="select21" class="form-control select2" style="width:100%">
                                <option value="">Select value...</option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">
                                        North Dakota
                                    </option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">
                                        Mississippi
                                    </option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">
                                        South Dakota
                                    </option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">
                                        Connecticut
                                    </option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">
                                        Massachusetts
                                    </option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">
                                        New Hampshire
                                    </option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">
                                        North Carolina
                                    </option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">
                                        Pennsylvania
                                    </option>
                                    <option value="RI">
                                        Rhode Island
                                    </option>
                                    <option value="SC">
                                        South Carolina
                                    </option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">
                                        West Virginia
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select22" class="control-label">
                                Select2 multi select
                            </label>
                            <select id="select22" class="form-control select2" multiple style="width:100%">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">
                                        North Dakota
                                    </option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">
                                        Mississippi
                                    </option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">
                                        South Dakota
                                    </option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">
                                        Connecticut
                                    </option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">
                                        Massachusetts
                                    </option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">
                                        New Hampshire
                                    </option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">
                                        North Carolina
                                    </option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">
                                        Pennsylvania
                                    </option>
                                    <option value="RI">
                                        Rhode Island
                                    </option>
                                    <option value="SC">
                                        South Carolina
                                    </option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">
                                        West Virginia
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select23" class="control-label">
                                Select2 single select with country flag
                            </label>
                            <select id="select23" class="form-control select2" style="width:100%">
                                <option value="">Select a value...</option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">
                                        North Dakota
                                    </option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">
                                        Mississippi
                                    </option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">
                                        South Dakota
                                    </option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">
                                        Connecticut
                                    </option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">
                                        Massachusetts
                                    </option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">
                                        New Hampshire
                                    </option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">
                                        North Carolina
                                    </option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">
                                        Pennsylvania
                                    </option>
                                    <option value="RI">
                                        Rhode Island
                                    </option>
                                    <option value="SC">
                                        South Carolina
                                    </option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">
                                        West Virginia
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="select24" class="control-label">
                                Select2 append
                            </label>
                            <div class="input-group select2-bootstrap-append">
                                <select id="select24" class="form-control" style="width:100%">
                                    <option value="">Select value...</option>
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                    <optgroup label="Pacific Time Zone">
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>
                                    </optgroup>
                                    <optgroup label="Mountain Time Zone">
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">
                                            North Dakota
                                        </option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup label="Central Time Zone">
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">
                                            Mississippi
                                        </option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">
                                            South Dakota
                                        </option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </optgroup>
                                    <optgroup label="Eastern Time Zone">
                                        <option value="CT">
                                            Connecticut
                                        </option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="IN">Indiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">
                                            Massachusetts
                                        </option>
                                        <option value="MI">Michigan</option>
                                        <option value="NH">
                                            New Hampshire
                                        </option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">
                                            North Carolina
                                        </option>
                                        <option value="OH">Ohio</option>
                                        <option value="PA">
                                            Pennsylvania
                                        </option>
                                        <option value="RI">
                                            Rhode Island
                                        </option>
                                        <option value="SC">
                                            South Carolina
                                        </option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WV">
                                            West Virginia
                                        </option>
                                    </optgroup>
                                </select>
                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"
                                                            data-select2-open="single-append-text">
                                                        <span class="ti-search"></span>
                                </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select25" class="control-label">
                                Select2 prepend
                            </label>
                            <div class="input-group select2-bootstrap-prepend">
                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button"
                                                            data-select2-open="single-prepend-text">
                                                        <span class="ti-search"></span>
                                </button>
                                </span>
                                <select id="select25" class="form-control" style="width:100%">
                                    <option value="">Select value...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select26" class="control-label">
                                Select2 multi append
                            </label>
                            <div class="input-group select2-bootstrap-append">
                                <select id="select26" class="form-control select2" style="width:100%">
                                    <option value="">Select value...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button" data-select2-open="multi-append">
                                        <span class="ti-search"></span>
                                    </button>
                                    <button class="btn btn-default" type="button" data-select2-open="multi-prepend">
                                        State
                                    </button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        Action
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Action</a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                            Another action
                                                        </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                            Something else here
                                                        </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                            Separated link
                                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--ends-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-arrow-circle-down"></i> Selectric Select
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <!-- Time Picker -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Get selected option value:</label>
                                <select id="get_value" class="form-control">
                                    <option value="pitons">Pitons</option>
                                    <option value="cams">Cams</option>
                                    <option value="nuts">Nuts</option>
                                    <option value="bolts">Bolts</option>
                                    <option value="stoppers">Stoppers</option>
                                    <option value="sling">Sling</option>
                                    <option value="skis">Skis</option>
                                    <option value="skins">Skins</option>
                                    <option value="poles">Poles</option>
                                </select>
                                <p id="select_value">Current value: <strong>oranges</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Option:</label>
                                <select id="set_value" class="form-control">
                                    <option value="First option">First option</option>
                                    <option value="Second option">Second option</option>
                                    <option value="Third option">Third option</option>
                                    <option value="Third option">Fourth option</option>
                                </select>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <button class="btn btn-info btn_selection" id="set_first_option">
                                                Select 1<sup>st</sup> option
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <button class="btn btn-info btn_selection" id="set_second_option">
                                                Select 2<sup>nd</sup> option
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <button class="btn btn-info btn_selection" id="set_third_option"> Select 3
                                                <sup>rd</sup> option
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-sm-3 col-xs-12">
                                            <button class="btn btn-info btn_selection" id="set_fourth_option"> Select 4
                                                <sup>th</sup> option
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Change options:</label>
                                <select id="dynamic" class="form-control">
                                    <option value="strawberries">Strawberries</option>
                                    <option value="mango">Mango</option>
                                    <option value="bananas">Bananas</option>
                                    <option value="watermelon">Watermelon</option>
                                    <option value="apples">Apples</option>
                                    <option value="grapes">Grapes</option>
                                    <option value="oranges">Oranges</option>
                                    <option value="pineapple">Pineapple</option>
                                    <option value="peaches">Peaches</option>
                                    <option value="cherries">Cherries</option>
                                </select>
                                <br>
                                <p>
                                    <input type="text" class="form-control" id="add_val" name="add_val" placeholder="Enter text">
                                </p>
                                <p>
                                    <button class="btn btn-info" id="bt_add_val">Add Option</button>
                                </p>
                            </div>
                            <!-- /.form group -->
                        </div>
                    </div>
                </div>
                <!-- /.form group -->
            </div>
            <!-- /.box-body -->
        </div>
        <!--select-->
    </div>
    <!--col-md-6 ends-->
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa ti-video-camera" aria-hidden="true"></i> Bootstrap Multi-select
                            </h3>
                <span class="pull-right ">
                                   <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label" for="multiselect1">Single Select using Radiobutton:
                        </label>
                        <select id="multiselect1" class="form-control">
                            <option value="cheese">Cheese</option>
                            <option value="tomatoes">Tomatoes</option>
                            <option value="mozarella">Mozzarella</option>
                            <option value="mushrooms">Mushrooms</option>
                            <option value="pepperoni">Pepperoni</option>
                            <option value="onions">Onions</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="multiselect2">Multi Select using checkbox:</label>
                        <select id="multiselect2" multiple="multiple" class="form-control">
                            <option value="cheese">Cheese</option>
                            <option value="tomatoes">Tomatoes</option>
                            <option value="mozarella">Mozzarella</option>
                            <option value="mushrooms">Mushrooms</option>
                            <option value="pepperoni">Pepperoni</option>
                            <option value="onions">Onions</option>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!--col-md-6 ends-->
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa ti-reload" aria-hidden="true"></i> Selectize Tagging and Select
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="box-body">
                    <!-- Time Picker -->
                    <div class="form-group">
                        <label>Default Selectize:</label>
                        <select id="select-gear" class="form-control">
                            <optgroup label="Climbing">
                                <option value="pitons">Pitons</option>
                                <option value="cams">Cams</option>
                                <option value="nuts">Nuts</option>
                                <option value="bolts">Bolts</option>
                                <option value="stoppers">Stoppers</option>
                                <option value="sling">Sling</option>
                            </optgroup>
                            <optgroup label="Skiing">
                                <option value="skis">Skis</option>
                                <option value="skins">Skins</option>
                                <option value="poles">Poles</option>
                            </optgroup>
                        </select>
                    </div>
                    <!-- /.form group -->
                    <!-- time Picker -->
                    <div class="form-group">
                        <label class="control-label">Selectize with max limit:</label>
                        <select id="selectize3" class="form-control">
                            <option value="">Select gear...</option>
                            <option value="pitons">Pitons</option>
                            <option value="cams">Cams</option>
                            <option value="nuts">Nuts</option>
                            <option value="bolts">Bolts</option>
                            <option value="stoppers">Stoppers</option>
                            <option value="sling">Sling</option>
                            <option value="skis">Skis</option>
                            <option value="skins">Skins</option>
                            <option value="poles">Poles</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Selectize Tags:</label>
                        <input type="text" id="selectize-tags1" class="form-control" value="web development,design">
                        <p>Press the [backspace] key and go back to editing the item without it being fully removed.
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Selectize Tags with remove button:</label>
                        <input type="text" id="selectize-tags2" class="demo-default" value="science,biology,chemistry">
                        <p>This selectize adds classic a classic remove button to each item for behavior that mimics Select2 and Choosen.</p>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            </div>
            <!-- /.box-body -->
        </div>
        <!--select-->
    </div>
    <!--col-md-6 ends-->
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
@stop
