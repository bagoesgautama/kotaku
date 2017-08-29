@extends('layouts/mini_sidebar') {{-- Page title --}} @section('title') Mini Sidebar @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="css/mini_sidebar.css"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Mini Sidebar</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Layouts</li>
        <li class="active">
            Mini Sidebar
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content') @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="js/custom_js/mini_sidebar.js"></script> @stop
