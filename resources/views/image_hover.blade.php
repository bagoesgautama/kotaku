@extends('layouts/default') {{-- Page title --}} @section('title') Image Hover @stop {{-- local styles --}} @section('header_styles')
<link type="text/css" href="{{asset('vendors/imagehover/css/imagehover.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset('css/custom_css/img_hover.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Image Hover</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Gallery</li>
        <li class="active">
            Image Hover
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="ti-image"></i> Image Hover
                            </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-fade">
                                <img src="img/gallery/full/7.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Fade
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-push-up">
                                <img src="img/gallery/full/8.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Push-up
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-push-down">
                                <img src="img/gallery/full/11.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Push-down
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-slide-right">
                                <img src="img/gallery/full/14.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Slide-right
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-slide-left">
                                <img src="img/gallery/full/17.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Slide-left
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-reveal-up">
                                <img src="img/gallery/full/19.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Reveal-up
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-reveal-left">
                                <img src="img/gallery/full/20.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Reveal-left
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-reveal-down">
                                <img src="img/gallery/full/24.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Reaveal-down
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-hinge-up">
                                <img src="img/gallery/full/28.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Hinge-up
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-hinge-right">
                                <img src="img/gallery/full/29.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Hinge-right
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-flip-horiz">
                                <img src="img/gallery/full/32.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Flip-horizontal
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-flip-vert">
                                <img src="img/gallery/full/33.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Flip-vertical
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-flip-diag-1">
                                <img src="img/gallery/full/30.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Flip-diagonal
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-shutter-out-vert">
                                <img src="img/gallery/full/14.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Shutter-out-vertical
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-fold-right">
                                <img src="img/gallery/full/19.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Fold-right
                                </figcaption>
                            </figure>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 text-center">
                            <figure class="imghvr-zoom-out-down">
                                <img src="img/gallery/full/17.jpg" class="img-responsive" width="295" height="185">
                                <figcaption>
                                    Zoom out down
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts') @stop
