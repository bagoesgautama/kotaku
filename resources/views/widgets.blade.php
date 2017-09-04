@extends('layouts/default') {{-- Page title --}} @section('title') Widgets @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="{{asset('vendors/swiper/css/swiper.min.css')}}">
<link href="{{asset('vendors/ihover/css/ihover.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/animate/animate.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/widgets.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Widgets</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Widgets</li>
        <li class="active">
            Widgets
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<!--main content-->
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-warning pull-left">
                <i class="ti-eye text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b id="widget_count1">2652</b></h3>
                <p>Visitors</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box border_success">
            <div class="bg-icon pull-left">
                <i class="ti-pie-chart text-success"></i>
            </div>
            <div class="text-right">
                <h3 class="text-success"><b id="widget_count3">3251</b></h3>
                <p>Sales status</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="ti-cup text-primary"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b id="widget_count2">7698</b></h3>
                <p class="text-primary">Income status</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box border_danger">
            <div class="text-center">
                <h3 class="text-danger"><b id="widget_count4">4358</b></h3>
                <p>Total sales:<span class="text-success"> 3251</span><span class="pull-right"><i
                                    class="ti-angle-double-down text-danger m-r-5"></i>7.85%</span></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row m-t-10">
    <div class="col-md-4">
        <div class="slider-content m-b-20">
            <div class="cover-wrapper">
                <div id="slider-clear" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators m-b-0">
                        <li data-target="#slider-clear" data-slide-to="0" class=""></li>
                        <li data-target="#slider-clear" data-slide-to="1" class="active"></li>
                        <li data-target="#slider-clear" data-slide-to="2" class=""></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item">
                            <img alt="Clear-img" src="img/gallery/full/35.jpg" class="img-responsive">
                        </div>
                        <div class="item active">
                            <img alt="Clear-img" src="img/gallery/full/36.jpg" class="img-responsive">
                        </div>
                        <div class="item">
                            <img alt="Clear-img" src="img/gallery/full/37.jpg" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-info">
                <div class="date">
                    <span class="day">22</span>
                    <br>
                    <span class="month">Mar</span>
                </div>
                <div class="meta-container">
                    <a href="#">
                        <h4 class="m-t-0">Beautiful Cover Image Post</h4>
                    </a>
                    <div class="font-13">
                        <span class="meta">Posted by John Doe in <a href="#"><b>Web Design</b></a></span>
                    </div>
                </div>
                <p class="m-b-0">
                    Nunc nec dui vitae urna cursus lacinia. In venenatis eget justo in dictum. Vestibulum auctor raesent quisnm.
                </p>
                <div class="row m-t-10">
                    <div class="col-xs-6">
                        <div class="m-t-10 blog-widget-action">
                            <a href="javascript:void(0)">
                                <i class="ti-heart"></i> <span>28</span>
                            </a>
                            <a href="javascript:void(0)">
                                <i class="ti-comment-alt"></i> <span>46</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="" class="btn btn-sm waves-effect btn-default">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-widget">
            <div class="panel-heading">
                <h4 class="panel-title">Total Revenue</h4>
            </div>
            <div class="panel-body">
                <div class="widget-chart text-center">
                    <div id="sparkline2"></div>
                </div>
            </div>
        </div>
        <div class="panel panel-widget">
            <div class="panel-heading">
                <h4 class="panel-title">Today Sales</h4>
            </div>
            <div class="panel-body">
                <div class="widget-chart text-center">
                    <input type="text" class="knob" data-width="135" data-height="135" data-linecap=round data-fgColor="#6699cc" data-skin="tron" data-angleOffset="180" data-thickness=".15" />
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-box p-0">
            <div class="profile-widget text-center">
                <div class="bg-custom1 bg-profile"></div>
                <img src="img/images/avatar1.jpg" class="thumb-lg img-circle img-thumbnail" alt="img" height="95" width="95">
                <h4>Addison</h4>
                <p><i class="ti-location-pin"></i> London</p>
                <a href="#" class="btn btn-sm btn-success m-t-20">Follow</a>
                <a href="#" class="btn btn-sm btn-info m-t-20">Send message</a>
                <div class="">
                    <p class="m-t-20 clearfix p-10">It has survived not only five centuries, but also the leap into electronic typesetting.</p>
                    <div class="social_icons p-10 text-white bg-custom1">
                        <i class="ti-facebook" aria-hidden="true"></i>
                        <i class="ti-twitter" aria-hidden="true"></i>
                        <i class="ti-google" aria-hidden="true"></i>
                        <i class="ti-youtube" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-t-10">
    <div class="col-md-4">
        <div class="panel panel-widget">
            <div class="panel-heading stat">
                <div class="panel-title">
                    <img class="img-circle img_alt" src="img/authors/avatar.jpg" alt="User Avatar" height="85" width="85">
                </div>
                <h3 class="user-username">Toby Adey</h3>
                <h5 class="user-po"> Developer</h5>
            </div>
            <div class="panel-body">
                <ul class="nav nav-stacked nav_border">
                    <li><a href="#">Projects <span class="pull-right badge ">31</span></a></li>
                    <li><a href="#">Tasks <span class="pull-right badge ">5</span></a></li>
                    <li><a href="#">Completed Projects <span class="pull-right badge ">12</span></a></li>
                    <li><a href="#">Followers <span class="pull-right badge ">58</span></a></li>
                    <li><a href="#">Progress <span class="pull-right badge ">75</span></a></li>
                    <li><a href="#">Upcoming <span class="pull-right badge ">157</span></a></li>
                    <li><a href="#">Others <span class="pull-right badge ">842</span></a></li>
                    <li><a href="#">Extra <span class="pull-right badge ">545</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-widget">
            <div class="panel-heading p-0">
                <div class="swiper-container swiper_content">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-1"><img src="img/gallery/full/35.jpg" class="img-responsive" alt="img">
                        </div>
                        <div class="swiper-slide slide-2"><img src="img/gallery/full/36.jpg" class="img-responsive" alt="img">
                        </div>
                        <div class="swiper-slide slide-3"><img src="img/gallery/full/37.jpg" class="img-responsive" alt="img">
                        </div>
                        <div class="swiper-slide slide-4"><img src="img/gallery/full/38.jpg" class="img-responsive" alt="img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body text-justify">
                <p>It is a long established fact that a reader will be distracted by the readable content of a page.
                </p>
                <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution.
                </p>
                <p>Lorem Ipsum is therefore more -or-less always free from repetition.</p>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page. The point of using that it has distribution.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget">
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-layers-alt pull-left text-primary"></i>
                    <h4>More Features</h4>
                    <p>This is the kind of thing you really need.</p>
                </li>
                <li class="list-group-item">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-server pull-left text-primary"></i>
                    <h4>Unlimited Users</h4>
                    <p>This is the kind of thing you really need.</p>
                </li>
                <li class="list-group-item">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-cup pull-left text-primary"></i>
                    <h4>Custom Database</h4>
                    <p>This is the kind of thing you really need.</p>
                </li>
                <li class="list-group-item">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-bookmark-alt pull-left text-primary"></i>
                    <h4>Enhanced Reporting</h4>
                    <p>This is the kind of thing you really need.</p>
                </li>
                <li class="list-group-item">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-medall-alt pull-left text-primary"></i>
                    <h4>Enterprise Features</h4>
                    <p>This is the kind of thing you really need.</p>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row m-t-10">
    <div class="col-md-4">
        <div class="card-box p-0">
            <div class="profile-widget text-center">
                <div class="bg-info bg-profile"></div>
                <img src="img/authors/avatar2.jpg" class="thumb-lg img-circle img-thumbnail" alt="img" height="95" width="95">
                <h4>Awesome Gallery</h4>
                <p>1 Photo</p>
                <div class="" id="lightgallery">
                    <div class="social_icons p-10 text-white">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- normal -->
                                <div class="ih-item square colored effect1 top_to_bottom">
                                    <a href="javascript:;">
                                        <div class="img">
                                            <img src="img/gallery/full/35.jpg" class="img-responsive" alt="img">
                                        </div>
                                        <div class="info text-justify">
                                            <h4 class="text-white">Clear Nature</h4>
                                        </div>
                                    </a>
                                </div>
                                <!-- end normal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-widget">
            <div class="panel-body">
                <div class="col-xs-3">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-facebook pull-left text-primary"></i>
                </div>
                <div class="col-xs-3">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-google pull-left text-danger"></i>
                </div>
                <div class="col-xs-3">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-twitter-alt pull-left text-info"></i>
                </div>
                <div class="col-xs-3">
                    <i class="fa-2x padding-top-small padding-bottom padding-right-small fa ti-linkedin pull-left text-primary"></i>
                </div>
            </div>
        </div>
        <div class="panel panel-widget">
            <div class="panel-heading text-center">
                <img src="img/authors/avatar3.jpg" class="thumb-lg img-thumbnail img-circle" alt="">
                <h4 class="text-center"><strong>Alex Cooper</strong></h4>
            </div>
            <div class="panel-body p-b-0">
                <div class="bg-custom1  p-t-b-20 text-center row">
                    <div class="col-xs-4">
                        <h4 class="text-white">782</h4>
                        <p class="text-white">Followers</p>
                    </div>
                    <div class="col-xs-4">
                        <h4 class="text-white">834</h4>
                        <p class="text-white">Following</p>
                    </div>
                    <div class="col-xs-4">
                        <h4 class="text-white">2907</h4>
                        <p class="text-white">Likes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-widget">
            <div class="panel-body bg-primary text-center careers-item">
                <div>
                    <i class="fa-5x fa ti-user hover-rotate text-white"></i>
                </div>
            </div>
        </div>
        <div class="panel panel-widget">
            <div class="panel-body bg-warning text-center careers-item">
                <div>
                    <i class="fa-5x fa ti-bookmark-alt hover-rotate text-white"></i>
                </div>
            </div>
        </div>
        <div class="panel panel-widget">
            <div class="panel-body bg-info text-center careers-item">
                <div>
                    <i class="fa-5x fa ti-medall hover-rotate text-white"></i>
                </div>
            </div>
        </div>
        <div class="panel panel-widget">
            <div class="panel-body bg-success text-center careers-item">
                <div>
                    <i class="fa-5x fa ti-bell hover-rotate text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!--main content ends-->@stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/countUp.js/js/countUp.js')}}"></script>
<!-- Sparkline Chart -->
<script type="text/javascript" src="{{asset('vendors/jquery-knob/js/jquery.knob.js')}}"></script>
<!-- =Swiper== --->
<script src="{{asset('vendors/swiper/js/swiper.min.js')}}" type="text/javascript"></script>
<!-- sparkline chart-->
<script src="{{asset('js/custom_js/sparkline/jquery.flot.spline.js')}}"></script>
<!-- wow plugin -->
<script type="text/javascript" src="{{asset('vendors/wow/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/widgets.js')}}"></script>
@stop
