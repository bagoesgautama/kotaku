@extends('layouts/default') {{-- Page title --}} @section('title') Dashboard 2 @stop {{-- local styles --}} @section('header_styles')
<!--page level css -->
<link href="{{asset('vendors/nvd3/css/nv.d3.min.css')}}" rel="stylesheet" type="text/css">
<!--weathericons-->
<link href="{{asset('vendors/weathericon/css/weather-icons.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/metrojs/css/MetroJs.min.css')}}">
<link href="{{asset('css/custom_css/dashboard2.css')}}" rel="stylesheet" type="text/css" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Dashboard2</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index2')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard2
            </a>
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel" id="main-chart" style="width: 100%">
            <div class="chart-header">Recent Stats
                <div class="btn-group pull-right">
                    <span id="fullscreen-toggle" role="button">
                                    <small><i class="ti-fullscreen"></i></small>
                                </span>
                    <!--sull-screen-->
                    <span class="toggle-dropdown" role="menu" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    <i class="ti-more-alt option-more"></i>
                                </span>
                    <ul class="dropdown-menu chartoption-menu">
                        <li><a href="#">View</a>
                        </li>
                        <li><a href="#">Update</a>
                        </li>
                        <li><a href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="statchart-data">
                <div class="row">
                    <div class="data text-center">
                        <span class="percent"> 19%</span>
                        <br class="hidden-sm hidden-md hidden-lg">
                        <span>Orders</span>
                    </div>
                    <div class="data text-center">
                        <span class="percent">23%</span>
                        <br class="hidden-sm hidden-md hidden-lg">
                        <span>Sales</span>
                    </div>
                    <div class="data text-center">
                        <span class="percent">12%</span>
                        <br class="hidden-sm hidden-md hidden-lg">
                        <span>Support</span>
                    </div>
                </div>
            </div>
            <div id="sales-chart" class='with-3d-shadow with-transitions'>
                <svg></svg>
            </div>
        </div>
    </div>
</div>
<div class="row main-cards">
    <div class="col-md-3 col-sm-6">
        <div class="panel">
            <h4><b>New Users</b></h4>
            <p>14,205
                <small>Last month</small>
            </p>
            <span id="user-chart"></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel">
            <h4><b>Revenue</b></h4>
            <p>$56,180
                <small>Target</small>
            </p>
            <span id="mr-chart"></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel">
            <h4><b>Hits</b></h4>
            <p>24,525
                <small>Reached</small>
            </p>
            <span class="pull-right progress-label"><b>6</b><small>%</small> <i
                                class="ti-stats-up"></i></span>
            <div class="progress progress-xs progress-striped active hits-progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="panel">
            <h4><b>Subscribers</b></h4>
            <p>8,958
                <small>Quarterly</small>
            </p>
            <span id="subscriber-chart"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel profile-page">
            <div class="cover-image">
                <a class="btn change_pic prev_pic"><img src="img/prev.png" alt="previous"></a>
                <a class="btn change_pic next_pic pull-right"><img src="img/next.png" alt="previous"></a>
                <span class="profile-name"><b>Clinton Leo</b></span>
                <span class="follow-link"><a href="#" class="btn btn-sm">+ Follow</a></span>
            </div>
            <div class="profile-pic">
            </div>
            <div class="about">
                <div class="row">
                    <div class="col-sm-4 designation text-center">
                        <h5>Designer,<br class="hidden-xs">
                                        Team Lead.</h5>
                        <span><a href="#" class="btn btn-sm button-pill new-task">New Task +</a></span>
                    </div>
                    <div class="col-sm-8 brief">
                        <h4>About</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.deserunt eveniet facilis possimus, omnis porro possimus rem repellat, voluptate!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel weather-widget">
            <div class="row weather-data">
                <div class="col-md-12 temperature">
                    <h2><i class="wi wi-day-cloudy icon"></i><span
                                        class="pull-right">19<sup><sup>o</sup></sup>c <br><span class="location"><i
                                        class="ti-location-pin text-default" aria-hidden="true"></i>
                                    London, UK</span></span></h2>
                </div>
            </div>
            <div class="weather-footer">
                <div class="text-center">
                    <div class="col-lg-2 col-xs-2 popup">
                        <h5>MON</h5>
                        <i class="wi wi-day-lightning"></i>
                        <p>21°c</p>
                    </div>
                    <div class="col-lg-2 col-xs-2 popup">
                        <h5>TUE</h5>
                        <i class="wi wi-cloudy"></i>
                        <p>28°c</p>
                    </div>
                    <div class="col-lg-2 col-xs-2 popup">
                        <h5>WED</h5>
                        <i class="wi wi-night-rain-mix"></i>
                        <p>26°c</p>
                    </div>
                    <div class="col-lg-2 col-xs-2 popup">
                        <h5>THU</h5>
                        <i class="wi wi-day-sunny"></i>
                        <p>31°c</p>
                    </div>
                    <div class="col-xs-2 popup">
                        <h5>FRI</h5>
                        <i class="wi wi-day-lightning"></i>
                        <p>24°c</p>
                    </div>
                    <div class="col-xs-2 popup">
                        <h5>SAT</h5>
                        <i class="wi wi-night-alt-snow"></i>
                        <p>25°c</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-7">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Activities</h3>
            </div>
            <div class="panel-body">
                <ul class="schedule-cont">
                    <li class="item success">
                        <div class="data">
                            <div class="time text-muted"> Just now</div>
                            <p><span class="text-info">Jade</span> Project team has successfully completed their first phase.</p>
                        </div>
                    </li>
                    <li class="item danger">
                        <div class="data">
                            <div class="time text-muted"> 7min ago</div>
                            <p>Tinder Project's <span class="text-info">Second</span> review has completed.
                            </p>
                        </div>
                    </li>
                    <li class="item">
                        <div class="data">
                            <div class="time text-muted">5hours ago</div>
                            <p>Richard McClintock, updated his project over view report.</p>
                        </div>
                    </li>
                    <li class="item success">
                        <div class="data">
                            <div class="time text-muted"> Yesterday</div>
                            <p>Variations Project <span class="text-info">Evaluation</span> is going on to highlight the project success .</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-lg-3 col-lg-push-5">
        <div class="panel">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile_1">
                        <div class="live-tile" data-mode="carousel" data-direction="vertical" data-delay="2500">
                            <span class="tile-title feed-title">Feeds</span>
                            <div>
                                <h4 class="full"> It is a long established fact that a reader will be
                                                distracted.</h4>
                                <span class="tile-title tile-time">17 min ago</span>
                            </div>
                            <div>
                                <h4 class="full"> Many desktop publishing packages and web page
                                                editors.</h4>
                                <span class="tile-title tile-time">40 min ago</span>
                            </div>
                            <div>
                                <h4 class="full"> Richard McClintock, a Latin Trainer at
                                                Hampden-Sydney.</h4>
                                <span class="tile-title tile-time">yesterday at 4pm</span>
                            </div>
                            <div>
                                <h4 class="full"> There are many variations of passages of Lorem Ipsum
                                                available.</h4>
                                <span class="tile-title tile-time">Dec 4</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tile_2">
                        <div class="list-tile">
                            <ul class="flip-list fourTiles" data-mode="flip-list" data-delay="2000">
                                <li>
                                    <div><img class="full" src="img/profile-pic.jpg" alt="1" /></div>
                                    <div><img class="full" src="img/authors/avatar.jpg" alt="1" /></div>
                                </li>
                                <li data-direction="horizontal">
                                    <div><img class="full" src="img/authors/avatar2.jpg" alt="2" /></div>
                                    <div><img class="full" src="img/authors/avatar3.jpg" alt="2" /></div>
                                </li>
                                <li data-direction="horizontal">
                                    <div><img class="full" src="img/authors/avatar4.jpg" alt="3" /></div>
                                    <div><img class="full" src="img/authors/avatar5.jpg" alt="3" /></div>
                                </li>
                                <li>
                                    <div><img class="full" src="img/authors/avatar6.jpg" alt="4" /></div>
                                    <div><img class="full" src="img/authors/avatar7.jpg" alt="4" /></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-5 col-lg-pull-3">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="server-load text-center">
                            <input type="text" class="cpu-laod" data-width="80" data-height="80" data-linecap=round data-fgColor="#6699cc" data-skin="tron" data-angleOffset="180" data-thickness=".15" />
                            <h4>CPU-LOAD</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="server-load text-center">
                            <input type="text" class="disc-space" data-width="80" data-height="80" data-linecap=round data-fgColor="#66CC99" data-skin="tron" data-angleOffset="180" data-thickness=".15" />
                            <h4>DISC-SPACE</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="social">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="twitter text-center">
                                    <i class="ti-twitter-alt"></i>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="info-1 text-center">
                                    <h3>27k</h3>
                                    <p>Tweets</p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="info-2 text-center">
                                    <h3>9.2k</h3>
                                    <p>followers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="social">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="facebook text-center">
                                    <i class="ti-facebook"></i>
                                </div>
                            </div>
                            <div class="col-xs-6 text-center">
                                <div class="info-1">
                                    <h3>31k</h3>
                                    <p>Likes</p>
                                </div>
                            </div>
                            <div class="col-xs-6 text-center">
                                <div class="info-2">
                                    <h3>12k</h3>
                                    <p>feeds</p>
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
<!--nvd3 chart-->
<script type="text/javascript" src="{{asset('vendors/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/nvd3/js/nv.d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/screenfull/js/screenfull.min.js')}}"></script>
<!--Sparkline Chart-->
<script src="{{asset('js/custom_js/sparkline/jquery.flot.spline.js')}}"></script>
<!--knob-->
<script type="text/javascript" src="{{asset('vendors/jquery-knob/js/jquery.knob.js')}}"></script>
<!--metrojs-->
<script type="text/javascript" src="{{asset('vendors/metrojs/js/MetroJs.min.js')}}"></script>
<script src="{{asset('js/dashboard2.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@stop
