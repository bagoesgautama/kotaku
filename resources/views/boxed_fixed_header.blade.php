@extends('layouts/boxed_fixed_header') {{-- Page title --}} @section('title') Boxed and Fixed Header @stop {{-- local styles --}} @section('header_styles') @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Boxed and Fixed Header</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Layouts</li>
        <li class="active">
            Boxed and Fixed Header
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content') @stop {{-- local scripts --}} @section('footer_scripts') @stop
