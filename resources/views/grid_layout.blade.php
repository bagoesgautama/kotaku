@extends('layouts/default') {{-- Page title --}} @section('title') Grid Layout @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/gridstack/css/gridstack.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/grids_layout.css')}}" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Grid Layout</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> UI Components</li>
        <li class="active">
            Grid Layout
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-layout-menu-v"></i> Responsive Grid Examples
                            </h3>
                <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            This demostrates Bootstrap Grid system and how it responds to different screen sizes.
                        </p>
                        <div class="">
                            <p class="visible-lg">
                                lg indicates that the large grid displaying. The grid stacks horizontally &lt; 1200px.
                            </p>
                            <p class="visible-md">
                                md indicates that the medium grid displaying. The grid stacks horizontally &lt; 992px.
                            </p>
                            <p class="visible-sm">
                                sm indicates that the small grid displaying. The grid stacks horizontally &lt; 768px.
                            </p>
                            <p class="visible-xs">
                                xs indicates that the extra small grid displaying. This grid is always horizontal.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 grid-section">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-4">
                                <div class="text-center grid-property bg-primary">
                                    <span class="visible-lg">.col-lg-4</span>
                                    <span class="visible-md">.col-md-4</span>
                                    <span class="visible-sm">.col-sm-3</span>
                                    <span class="visible-xs">.col-xs-4</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-2 col-sm-3 col-xs-4">
                                <div class="text-center grid-property bg-success">
                                    <span class="visible-lg">.col-lg-4</span>
                                    <span class="visible-md">.col-md-2</span>
                                    <span class="visible-sm">.col-sm-3</span>
                                    <span class="visible-xs">.col-xs-4</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-4">
                                <div class="text-center grid-property bg-danger">
                                    <span class="visible-lg">.col-lg-4</span>
                                    <span class="visible-md">.col-md-6</span>
                                    <span class="visible-sm">.col-sm-6</span>
                                    <span class="visible-xs">.col-xs-4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="grid-section">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>xs Grid</label>
                                </div>
                                <div class="col-xs-5">
                                    <div class="text-center grid-property bg-warning">
                                        <span>.col-xs-5</span>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="text-center grid-property bg-danger">
                                        <span>.col-xs-4</span>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="text-center grid-property bg-primary">
                                        <span>.col-xs-3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="col-md-12">
                        <div class="grid-section">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>sm Grid</label>
                                </div>
                                <div class="col-sm-2">
                                    <div class="text-center grid-property bg-danger">
                                        <span>.col-sm-2</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class=" text-center grid-property bg-primary">
                                        <span>.col-sm-4</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center grid-property bg-success">
                                        <span>.col-sm-6</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="col-md-12">
                        <div class="grid-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>md Grid</label>
                                </div>
                                <div class="col-md-2">
                                    <div class=" text-center grid-property bg-success">
                                        <span>.col-md-2</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center grid-property bg-warning">
                                        <span>.col-md-4</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center grid-property bg-primary">
                                        <span>.col-md-6</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="col-md-12">
                        <div class="grid-section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>lg Grid</label>
                                </div>
                                <div class="col-lg-4">
                                    <div class=" text-center grid-property bg-warning">
                                        <span>.col-lg-4</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center grid-property bg-danger">
                                        <span>.col-lg-4</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center grid-property bg-success">
                                        <span>.col-lg-4</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <!--grif stack-->
    <div class="col-md-12 ">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-layout-grid3"></i> Gridstack
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="grid-stack" data-gs-width="12" data-gs-animate="yes">
                            <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="4" data-gs-height="2">
                                <div class="grid-stack-item-content">1</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                                <div class="grid-stack-item-content">2</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="2" data-gs-height="2" data-gs-min-width="2" data-gs-no-resize="yes">
                                <div class="grid-stack-item-content"><span class="fa ti-hand-drag"></span> Drag me!
                                </div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="10" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                                <div class="grid-stack-item-content">4</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="0" data-gs-y="2" data-gs-width="2" data-gs-height="2">
                                <div class="grid-stack-item-content">5</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="2" data-gs-y="2" data-gs-width="2" data-gs-height="4">
                                <div class="grid-stack-item-content">6</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="8" data-gs-y="2" data-gs-width="4" data-gs-height="2">
                                <div class="grid-stack-item-content">7</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="0" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                                <div class="grid-stack-item-content">8</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="4" data-gs-y="4" data-gs-width="4" data-gs-height="2">
                                <div class="grid-stack-item-content">9</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="8" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                                <div class="grid-stack-item-content">10</div>
                            </div>
                            <div class="grid-stack-item" data-gs-x="10" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                                <div class="grid-stack-item-content">11</div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/lodash/js/lodash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/gridstack/js/gridstack.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/gridstack.js')}}"></script> @stop
