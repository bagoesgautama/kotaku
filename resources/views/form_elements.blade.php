
@extends('layouts/default') {{-- Page title --}} @section('title') Form Elements @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" />
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/custom_css/skins/skin-default.css')}}" type="text/css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('css/formelements.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Form Elements</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            Form Elements
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-move"></i> General Elements
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="input-text" class="col-sm-2 control-label">Input text</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text" placeholder="Input text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-text-disabled" class="col-sm-2 control-label">Disabled</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text-disabled" placeholder="Input text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-10">
                            <input type="color" class="form-control" id="color" placeholder="color">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="col-sm-2 control-label">Url</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" id="url" placeholder="URL" value="http://getbootstrap.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="range" class="col-sm-2 control-label">Range</label>
                        <div class="col-sm-10">
                            <input type="range" class="form-control " id="range" value="50" placeholder="Range">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label m-t-ng-8">Radio Buttons</label>
                        <div class="col-sm-10">
                            <div class="iradio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"> Radio Button 1
                                </label>
                            </div>
                            <div class="iradio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Radio Button 2
                                </label>
                            </div>
                            <div class="iradio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option2"> Radio Button 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label m-t-ng-8">Checkbox</label>
                        <div class="col-sm-10">
                            <div>
                                <label>
                                    <input type="checkbox" name="c1" id="c1" value=""> Checkbox 1
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="checkbox" name="c1" id="c2" value=""> Checkbox 2
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="checkbox" name="c1" id="c3" value=""> Checkbox 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Inline Radio Buttons
                        </label>
                        <div class="col-sm-10">
                            <label class="radio-inline iradio">
                                <input type="radio" id="inlineradio1" name="inlineRadios" value="option1"> Inline Radio Button 1
                            </label>
                            <label class="radio-inline iradio">
                                <input type="radio" id="inlineradio2" name="inlineRadios" value="option2"> Inline Radio Button 2
                            </label>
                            <label class="radio-inline iradio">
                                <input type="radio" id="inlineradio3" name="inlineRadios" value="option3"> Inline Radio Button 3
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Inline Checkbox
                        </label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline icheckbox">
                                <input type="checkbox" id="inlineCheckbox1" value="option1"> Inline checkbox 1
                            </label>
                            <label class="checkbox-inline icheckbox">
                                <input type="checkbox" id="inlineCheckbox2" value="option2"> Inline checkbox 2
                            </label>
                            <label class="checkbox-inline icheckbox">
                                <input type="checkbox" id="inlineCheckbox3" value="option3"> Inline checkbox 3
                            </label>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label for="input-text-has-success" class="col-sm-2 control-label">
                            Input Success
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text-has-success">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="input-text-has-warning" class="col-sm-2 control-label">
                            Input Warning
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text-has-warning">
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <label for="input-text-has-error" class="col-sm-2 control-label">
                            Input Error
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text-has-error">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Input Size</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" placeholder="input-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-lg" placeholder="input-lg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Input Group
                        </label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Currency">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" placeholder="Currency">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-6 m-b-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                                            <input type="checkbox">
                                                        </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-md-6 m-b-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                                            <input type="radio">
                                                        </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-lg-6 m-b-10">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                                            <button class="btn btn-warning" type="button">Go!</button>
                                                        </span>
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 m-b-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                        <span class="input-group-btn">
                                                            <button class="btn btn-warning" type="button">Go!</button>
                                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-lg-6 m-b-10">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
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
                                        <!-- /btn-group -->
                                        <input type="text" class="form-control">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6 m-b-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                Action
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
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
                                        <!-- /btn-group -->
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Text Area
                        </label>
                        <div class="col-sm-10 col-md-10">
                            <textarea rows="4" class="form-control resize_vertical" placeholder="Basic"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        </label>
                        <div class="col-sm-10 col-md-10">
                            <textarea rows="4" class="form-control resize_vertical" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        </label>
                        <div class="col-sm-10 col-md-10">
                            <textarea rows="4" class="form-control noresize" placeholder="No resize"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-pencil"></i> Grid sizing of Form Elements
                            </h3>
                <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xs-4">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <textarea class="form-control resize_vertical"></textarea>
                            </div>
                            <div class="col-xs-4">
                                <textarea class="form-control resize_vertical"></textarea>
                            </div>
                            <div class="col-xs-5">
                                <textarea class="form-control resize_vertical"></textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="col-xs-5">
                                <select class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-pencil"></i> Height Sizing of Input
                                Groups
                            </h3>
                <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                                <i class="fa fa-fw ti-user" aria-hidden="true"></i>
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                                <input type="checkbox">
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-lg">
                                <div class="input-group-addon ">
                                    <input type="radio">
                                </div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                                <i class="fa fa-fw ti-user" aria-hidden="true"></i>
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                                <input type="checkbox"></span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <input type="radio">
                                </div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                                <i class="fa fa-fw ti-user"></i>
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                                <input type="checkbox">
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 m-t-10">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">
                                                <input type="radio">
                                            </span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-download"></i> Advanced File Input
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-20" type="file" class="file-loading">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Display the widget as a single block button
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-21" type="file" accept="image/*" class="file-loading">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Show only image files for selection & preview. Control button labels, styles, and icons for the Pick Image, upload, and delete buttons.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-22" type="file" class="file" accept="text/plain" data-preview-file-type="text" data-preview-class="bg-warning">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Preview section control. Change preview background and display only text files content within the preview window.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8 ">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-23" type="file" class="file-loading" data-show-preview="false">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Advanced customization using templates. For example, Hide file preview thumbnails.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-40" type="file" class="file">
                        <br>
                        <button type="button" class="btn btn-warning btn-modify">Modify</button>
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Using plugin methods to alter input at runtime. For example, click the Modify button to disable the plugin and change plugin options.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-41" type="file" class="file-loading">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Allow only image and video file types to be uploaded. You can configure the condition for validating the file types using
                            <code>fileTypeSettings</code> .
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-42" type="file" class="file-loading">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Allow only specific( jpg, gif, png, txt ) file extensions.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label">
                            Select File
                        </label>
                        <input id="input-43" type="file" class="file-loading">
                        <div id="errorBlock43" class="help-block"></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info small m-t-10">
                            Disable preview and customize your own error container and messages.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<!-- page level js -->
<script src="{{asset('vendors/iCheck/js/icheck.js')}}"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_elements.js')}}"></script>
@stop
