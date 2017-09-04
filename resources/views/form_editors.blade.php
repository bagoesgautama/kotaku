@extends('layouts/default') {{-- Page title --}} @section('title') For Editors @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" type="text/css" href="{{asset('vendors/summernote/summernote.css')}}">
<link href="{{asset('vendors/trumbowyg/css/trumbowyg.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_editors.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>For Editors</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            For Editors
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<!-- /.box -->
<div class="panel ">
    <div class="panel-heading">
        <div class=" bootstrap-admin-box-title ">
            <h3 class="panel-title">
                            Bootstrap WYSIHTML5
                        </h3>
        </div>
    </div>
    <!--main content-->
    <div class="panel-body flip_editing">
        <!-- /.box -->
        <div class='box well well-sm'>
            <div class='box-header'>
                <h3 class='box-title text-info'>
                                Bootstrap WYSIHTML5
                                <small class="text-info">Simple editor</small>
                            </h3>
                <!-- tools box -->
                <div class="pull-right box-tools"></div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
                <form>
                    <textarea class="textarea editor-cls" placeholder="Place some text here"></textarea>
                </form>
            </div>
        </div>
        <!-- /.col-->
    </div>
</div>
<div class="panel ">
    <div class="panel-heading">
        <div class=" bootstrap-admin-box-title ">
            <h3 class="panel-title">
                            Summer Note</h3>
        </div>
    </div>
    <div class="panel-body">
        <div class="bootstrap-admin-panel-content summer_noted">
            <div id="summernote"></div>
        </div>
    </div>
</div>
<div class="panel ">
    <div class="panel-heading">
        <div class=" bootstrap-admin-box-title ">
            <h3 class="panel-title">
                            Flip Editor</h3>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="bootstrap-admin-panel-content flip_editing">
                <textarea class="" id="split_editor"></textarea>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/bootstrap3-wysihtml5-bower/js/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/trumbowyg/js/trumbowyg.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('vendors/bootstrap3-wysihtml5-bower/js/bootstrap3-wysihtml5.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/summernote/summernote.min.js')}}"></script>
<script src="{{asset('js/custom_js/form_editors.js')}}" type="text/javascript"></script>
@stop
