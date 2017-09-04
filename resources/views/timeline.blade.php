@extends('layouts/default') {{-- Page title --}} @section('title') Timeline @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/animate/animate.min.css')}}">
<link href="{{asset('css/timeline.css')}}" rel="stylesheet" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Timeline</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> UI Features</li>
        <li class="active">
            Timeline
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-8 timeline_panel">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-time"></i> Timeline
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <!--timeline-->
                <div>
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge primary wow bounceInDown center">
                                <i class="fa fa-fw ti-server"></i>
                            </div>
                            <div class="timeline-panel wow bounceInDown" style="display:inline-block;">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">We are a MNC now</h4>
                                    <p>
                                        <small class="text-primary">11 hours ago via Twitter</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Lorem Ipsum is simply dummy, vidis lio, quem amistosis quis leo..
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge danger wow lightSpeedIn center">
                                <i class="fa fa-fw ti-check-box"></i>
                            </div>
                            <div class="timeline-panel wow slideInRight">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">We won best website award</h4>
                                    <p>
                                        <small class="text-danger">May 08, 2016</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem Ipsum is simply dummy, vidis litro abertis.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge info wow lightSpeedIn center">
                                <i class="fa fa-fw ti-credit-card"></i>
                            </div>
                            <div class="timeline-panel wow slideInLeft">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Hired our first employee</h4>
                                    <p>
                                        <small class="text-info">June 10, 2005</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Lorem Ipsum is simply dummy, vidis litro abertis. Pra uium u num gostis.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge warning wow lightSpeedIn center">
                                <i class="fa fa-fw ti-map"></i>
                            </div>
                            <div class="timeline-panel wow lightSpeedIn">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Rented an office space</h4>
                                    <p>
                                        <small class="text-warning">Jan 05, 2002</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Lorem Ipsum is simply dummy, vidis litro abertis. Cais bolis eu num gostis.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge default wow bounceInUp center">
                                <i class="fa fa-fw ti-thumb-up"></i>
                            </div>
                            <div class="timeline-panel wow bounceInUp">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Planning to open an office</h4>
                                    <p>
                                        <small class="text-default-gray">jan 02, 2017</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        Lorem Ipsum is simply dummy, vidis litro abertis. depois divoltis.
                                    </p>
                                    <hr>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="glyphicon glyphicon-cog"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="#">Action</a>
                                            </li>
                                            <li>
                                                <a href="#">Another action</a>
                                            </li>
                                            <li>
                                                <a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--timeline ends-->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-sm-6 col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                                        <i class="fa fa-fw ti-comment-alt"></i> Recent Activities
                                    </h3>
                        <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
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
            <div class="col-sm-6 col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                                        <i class="fa fa-fw ti-reload"></i> Auto Update
                                    </h3>
                        <span class="pull-right">
                                        <i class="fa fa-fw ti-angle-up clickable"></i>
                                        <i class="fa fa-fw ti-close removepanel clickable"></i>
                                    </span>
                    </div>
                    <div class="panel-body">
                        <div>
                            <ul class="timeline-update">
                                <li>
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar1.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel" style="display:inline-block;">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Jade Project's Status </h4>
                                            <p>
                                                <small class="text-default-gray">11 hours ago</small>
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
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Tinder Project</h4>
                                            <p>
                                                <small class="text-default-gray">Sept 10, 2016</small>
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
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar2.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">A new branch in Virginia.</h4>
                                            <p>
                                                <small class="text-default-gray">Jan 02, 2017</small>
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
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar3.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel" style="display:inline-block;">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Daily Status </h4>
                                            <p>
                                                <small class="text-default-gray">2days ago</small>
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
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar4.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Performance report</h4>
                                            <p>
                                                <small class="text-default-gray">Aug 10, 2016</small>
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
                                    <div class="timeline-badge center">
                                        <img src="img/authors/avatar2.jpg" height="36" width="36" class="img-circle pull-right" alt="avatar-image">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Project Evaluation</h4>
                                            <p>
                                                <small class="text-default-gray">Oct 05, 2016</small>
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
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script type="text/javascript" src="{{asset('vendors/wow/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/advanced_newsTicker/js/newsTicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom_js/time_line.js')}}"></script> @stop
