@extends('layouts/default') {{-- Page title --}} @section('title') Transitions @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/animate/animate.min.css')}}" />
<link href="{{asset('css/animate1.css')}}" rel="stylesheet" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Transitions</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Transitions
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row animated fadeInDown">
    <!--row starts-->
    <div class="col-md-12">
        <!--md starts-->
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-bell"></i> Transition Effects
                            </h3>
                <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h5> Click on the Ball to see an Animations</h5>
                        </div>
                    </div>
                    <div class="panel-body text-center">
                        <!--content starts-->
                        <div class="wrap">
                            <div class="row ">
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="tad" alt="football">
                                    <p>Tada</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="fls" alt="football">
                                    <p>Flash</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="shk" alt="football">
                                    <p>Shake</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="sw" alt="football">
                                    <p>Swing</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="pul" alt="football">
                                    <p>Pulse</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="wobb" alt="football">
                                    <p>Wobble</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="jell" alt="football">
                                    <p>Jello</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="rubber" alt="football">
                                    <p>Rubber Band</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="bi" alt="football">
                                    <p>Bounce In</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="bid" alt="football">
                                    <p>Bounce In Down</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="bil" alt="football">
                                    <p>Bounce In Left</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="fiy" alt="football">
                                    <p>FlipInY</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="flp" alt="football">
                                    <p>Flip</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="fid" alt="football">
                                    <p>FadeIn Down</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="roi" alt="football">
                                    <p>Rotate In</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="lso" alt="football">
                                    <p>light Speed Out</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="ri" alt="football">
                                    <p>Roll In</p>
                                </div>
                                <div class="col-lg-2 col-sm-3">
                                    <img src="img/football.png" id="lis" alt="football">
                                    <p>Light Speed In</p>
                                </div>
                            </div>
                            <!-- row end-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- panel body ending-->
        </div>
    </div>
</div>@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('js/custom_js/transitions_custom.js')}}"></script>@stop
