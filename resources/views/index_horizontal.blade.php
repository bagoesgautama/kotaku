@extends('layouts/horizontal_menu') {{-- Page title --}} @section('title') Clear Admin Template @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/swiper/css/swiper.min.css')}}">
<link href="{{asset('vendors/nvd3/css/nv.d3.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset('vendors/lcswitch/css/lc_switch.css')}}">
<link href="{{asset('css/custom_css/dashboard1.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/custom_css/dashboard1_timeline.css')}}" rel="stylesheet" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-eye text-warning"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>3752</b></h3>
                    <p>Daily Visits</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <span id="loadspark-chart"></span>
                    <hr>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-shopping-cart text-success"></i>
                </div>
                <div class="text-right">
                    <h3><b id="widget_count3">3251</b></h3>
                    <p>Sales status</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <span class="linechart" id="salesspark-chart"></span>
                    <hr>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-thumb-up text-danger"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>1532</b></h3>
                    <p>Hits</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <span id="visitsspark-chart"></span>
                    <hr>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-user text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>1252</b></h3>
                    <p>Subscribers</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-bg-color-icon card-box back">
                <div class="text-center">
                    <span id="subscribers-chart"></span>
                    <hr>
                    <p>Check summary</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-xs-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel main-chart">
                    <div class="panel-heading panel-tabs">
                        <ul class="nav nav-tabs nav-float" role="tablist">
                            <li class="active text-center">
                                <a href="#home" role="tab" data-toggle="tab">Live Feeds</a>
                            </li>
                            <li class="text-center">
                                <a href="#profile" role="tab" data-toggle="tab"><span class="hidden-xs">Annual</span>
                                                Revenue</a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="form-group">
                                    <input type="checkbox" id="toggle_real" name="my-checkbox" data-size="small" checked>
                                </div>
                                <div id="live-chart" class="livechart-tab1 m-t-10"></div>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="chart-container">
                                    <span class="">
                                                    <i class="ti-reload redraw-cart pull-right set-animate"></i>
                                                </span>
                                    <canvas id="dashboard-chart1" width="800" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="panel">
                    <div class="swiper-container swiper_news">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-1 gradient-color">
                                <div class="slider-content">
                                    <div class="news-head">
                                        <h3>The Need For Inc. in Energy</h3>
                                        <span class="pull-right">Yesterday</span>
                                        <hr>
                                    </div>
                                    <div class="news-cont">
                                        <h4>The strategy of adjusting and optimizing energy, using systems
                                                        and
                                                        procedures so as to reduce energy requirements per unit of
                                                        output
                                                        while holding ...</h4>
                                        <p class="text-right read-more"><a class="read-more" href="javascript:void(0)">Read
                                                        more <i class="ti-angle-double-right"></i></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide slide-2 gradient-color">
                                <div class="slider-content">
                                    <div class="news-head">
                                        <h3>What to expect in the final race..</h3>
                                        <span class="pull-right">5min ago</span>
                                        <hr>
                                    </div>
                                    <div class="news-cont">
                                        <h4>The strategy of adjusting and optimizing energy, using systems
                                                        and
                                                        procedures so as to reduce energy per unit of output
                                                        while holding ...</h4>
                                        <p class="text-right read-more"><a class="read-more" href="javascript:void(0)">Read
                                                        more <i class="ti-angle-double-right"></i></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide slide-3 gradient-color">
                                <div class="slider-content">
                                    <div class="news-head">
                                        <h3>First ever Largest open Air Purifier</h3>
                                        <span class="pull-right">On 28th Oct</span>
                                        <hr>
                                    </div>
                                    <div class="news-cont">
                                        <h4>The strategy of adjusting and optimizing energy, using systems
                                                        and
                                                        procedures so as to reduce energy requirements per unit of
                                                        output
                                                        while holding ...</h4>
                                        <p class="text-right read-more"><a class="read-more" href="javascript:void(0)">Read
                                                        more <i class="ti-angle-double-right"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="panel real-timechart">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 text-center">
                                <h3 class="">Real-Time Visits</h3>
                                <div class="real-value">
                                    <p><span></span>k</p>
                                </div>
                            </div>
                            <div class="col-xs-6 text-center">
                                <h3 class="">Returning Visitors</h3>
                                <div class="return-value">
                                    <p><span></span>k</p>
                                </div>
                            </div>
                        </div>
                        <div id="realtime-views" class="real-chart"></div>
                        <hr>
                        <div class="row ratings">
                            <div class="col-xs-4 text-center">
                                <h4>81%</h4>
                                <p>Satisfied</p>
                            </div>
                            <div class="col-xs-4 text-center">
                                <h4>8%</h4>
                                <p>Unsatisfied</p>
                            </div>
                            <div class="col-xs-4 text-center">
                                <h4>11%</h4>
                                <p>NA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel nvd3-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Project Status</h3>
                    </div>
                    <div class="panel-body">
                        <div class="nvd3-chart line-chart text-center" data-x-grid="false">
                            <svg></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4  col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-sm-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Timeline</h3>
                    </div>
                    <div class="panel-body">
                        <div>
                            <ul class="timeline timeline-update">
                                <li>
                                    <div class="timeline-badge primary wow lightSpeedIn center">
                                        <img src="img/authors/avatar1.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft" style="display:inline-block;">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Jade Project's Status </h4>
                                            <p>
                                                <small class="text-primary">11 hours ago</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Jade Project team has completed their first phase.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge info wow lightSpeedIn center">
                                        <img src="img/authors/avatar.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Tinder Project</h4>
                                            <p>
                                                <small class="text-primary">Sept 10, 2016</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Tinder Project's Final review has completed.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge default wow lightSpeedIn center">
                                        <img src="img/authors/avatar2.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">A new branch in Virginia.</h4>
                                            <p>
                                                <small class="text-primary">Jan 02, 2017</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Planning to have a branch in virginia in the coming year.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge primary wow lightSpeedIn center">
                                        <img src="{{asset('img/authors/avatar3.jpg')}}" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft" style="display:inline-block;">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Daily Status </h4>
                                            <p>
                                                <small class="text-primary">2days ago</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Manager schedules to keep a daily project status track.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge info wow lightSpeedIn center">
                                        <img src="img/authors/avatar4.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Performance report</h4>
                                            <p>
                                                <small class="text-primary">Aug 10, 2016</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Richard, updated his Team over view Performance report.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge default wow lightSpeedIn center">
                                        <img src="img/authors/avatar2.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel wow slideInLeft">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Project Evaluation</h4>
                                            <p>
                                                <small class="text-primary">Oct 05, 2016</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                Variations Project Evaluation is going on to highlight project.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-6">
                <div class="panel personal-chat">
                    <div class="panel-heading">
                        <div class="panel-title"><img class="chat-image img-circle pull-left" height="36" width="36" src="img/authors/avatar5.jpg" alt="avatar-image">
                            <div class="header-elements">Wilton zeph
                                <br>
                                <small class="status"><b>Online</b></small>
                                <div class="pull-right options">
                                    <div class="btn-group">
                                        <span class="toggle-dropdown" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" role="menu">
                                                    <i class="ti-clip attachment"></i>
                                                </span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="ti-file text-primary"></i>Document</a>
                                            </li>
                                            <li><a href="#"><i
                                                                class="ti-gallery text-primary"></i>Gallery</a>
                                            </li>
                                            <li><a href="#"><i class="ti-location-arrow text-primary"></i>Location</a>
                                            </li>
                                            <li><a href="#"><i class="ti-camera text-primary"></i>Camera</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <span class="toggle-dropdown" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" role="menu">
                                                    <i class="ti-more-alt more"></i>
                                                </span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#">Profile</a>
                                            </li>
                                            <li><a href="#">Media</a>
                                            </li>
                                            <li><a href="#">Mute</a>
                                            </li>
                                            <li><a href="#">More</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!--</div>-->
                        <div class="chat-conversation">
                            <ul class="conversation-list">
                                <li class="clearfix odd conversers1">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap m-t-10">
                                            <p class="text-left">
                                                Hello Wilton, are the review papers ready?
                                                <i class="text-right">8:31 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix  m-t-10 conversers2">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p>
                                                Not yet, it will take a bit of time for you to get them.
                                                <br><i class="text-right">8:31 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix odd m-t-10 conversers1">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p class="text-left">
                                                Treat this on urgent Basis.
                                                <i class="text-right">8:33 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix  m-t-10 conversers2">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p>
                                                I will make it as early as possible.
                                                <br><i class="text-right">8:34 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix odd m-t-10 conversers1">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p class="text-left">
                                                Okay.
                                                <i class="text-right">8:35 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix m-t-10 conversers2">
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <p>
                                                If there is anything else..
                                                <br><i class="text-right">8:35 pm</i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <form id="main_input_box">
                                <div class="row">
                                    <div class="col-xs-12 m-b-15">
                                        <div class="input-group text-field">
                                            <input type="search" class="form-control chat-input custom_textbox" id="custom_textbox" placeholder="Type a message" required>
                                            <span class="input-group-btn">
                                                    <button class="btn btn-success send-btn"
                                                            type="submit"><i
                                                            class="menu-icon ti-location-arrow text-white"></i></button>
                                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<!--Sparkline Chart-->
<script type="text/javascript" src="{{asset('js/custom_js/sparkline/jquery.flot.spline.js')}}"></script>
<!-- flip --->
<script type="text/javascript" src="{{asset('vendors/flip/js/jquery.flip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/lcswitch/js/lc_switch.min.js')}}"></script>
<!--flot chart-->
<script type="text/javascript" src="{{asset('vendors/flotchart/js/jquery.flot.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/flotchart/js/jquery.flot.resize.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/flotspline/js/jquery.flot.spline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/flot.tooltip/js/jquery.flot.tooltip.js')}}"></script>
<!--swiper-->
<script type="text/javascript" src="{{asset('vendors/swiper/js/swiper.min.js')}}"></script>
<!--chartjs-->
<script src="{{asset('vendors/chartjs/js/Chart.js')}}"></script>
<!--nvd3 chart-->
<script type="text/javascript" src="{{asset('js/nvd3/d3.v3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/nvd3/js/nv.d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/advanced_newsTicker/js/newsTicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dashboard1.js')}}"></script>
<!-- end of page level js -->
@stop
