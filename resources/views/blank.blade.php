@extends('layouts/default') {{-- Page title --}} @section('title') Blank @stop {{-- local styles --}} @section('header_styles') @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blank</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Blank
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content') @stop {{-- local scripts --}} @section('footer_scripts') @stop
