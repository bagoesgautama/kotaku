@extends('layouts/default') {{-- Page title --}} @section('title') Pricing Table @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" href="css/custom_css/pricing_table.css"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Pricing Table</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Pages</li>
        <li class="active">
            Pricing Table
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<!--pricing table one-->
<div class="row text-center">
    <div class="col-sm-12 col-lg-12">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default span-btn monthly active">
                <input type="radio" name="options" id="option2" autocomplete="off" checked> Monthly Tariff
            </label>
            <label class="btn btn-default span-btn yearly">
                <input type="radio" name="options" id="option3" autocomplete="off"> Yearly Tariff
            </label>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="modal-1">
            <div class="pack-heading">
                <h4 class="pack-title"><strong>Basic</strong></h4>
                <div class="pack-price monthly-pack"><sup class="dollar">$</sup>49<span>/mo</span></div>
                <div class="pack-price yearly-pack" hidden><sup class="dollar">$</sup>540<span>/yr</span>
                </div>
                <p>$45/mo If you get yearly Pack.</p>
            </div>
            <p class="section-head">TRACKED CAMPAIGNS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>5</strong> Campaigns</li>
                <li><strong>300</strong> Keyword Ranking</li>
                <li><strong>250,000</strong> Crawled Pages</li>
                <li class="text-dummy">No Branded Reports</li>
            </ul>
            <p class="section-head">KEYWORD EXPLORER</p>
            <ul class="pack-details list-unstyled">
                <li><strong>5 Keywords Reports</strong></li>
                <li class="text-dummy">No Keywords List</li>
            </ul>
            <p class="section-head">USER ACCESS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>2</strong> Seats</li>
            </ul>
            <button class="btn btn-primary center-block btn-getit">Get it now</button>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="modal-1">
            <div class="trending-tag">
                <div class="tag-design bg-primary">Best
                    <br> Package</div>
            </div>
            <div class="pack-heading">
                <h4 class="pack-title"><strong>Econamic</strong></h4>
                <div class="pack-price monthly-pack"><sup class="dollar">$</sup>99<span>/mo</span></div>
                <div class="pack-price yearly-pack" hidden><sup class="dollar">$</sup>1104<span>/yr</span>
                </div>
                <p>$92/mo If you get yearly Pack.</p>
            </div>
            <p class="section-head">TRACKED CAMPAIGNS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>10</strong> Campaigns</li>
                <li><strong>750</strong> Keyword Ranking</li>
                <li><strong>500,000</strong> Crawled Pages</li>
                <li> <strong>Branded Reports</strong></li>
            </ul>
            <p class="section-head">KEYWORD EXPLORER</p>
            <ul class="pack-details list-unstyled">
                <li><strong>5,000</strong> Full Keywords Reports</li>
                <li><strong>30</strong> Full Keywords List</li>
            </ul>
            <p class="section-head">USER ACCESS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>10</strong> Seats</li>
            </ul>
            <button class="btn btn-danger center-block btn-getit">Get it now</button>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="modal-1">
            <div class="pack-heading">
                <h4 class="pack-title"><strong>Premium</strong></h4>
                <div class="pack-price monthly-pack"><sup class="dollar">$</sup>159<span>/mo</span></div>
                <div class="pack-price yearly-pack" hidden><sup class="dollar">$</sup>1788<span>/yr</span>
                </div>
                <p>$149/mo If you get yearly Pack.</p>
            </div>
            <p class="section-head">TRACKED CAMPAIGNS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>25</strong> Campaigns</li>
                <li><strong>1,700</strong> Keyword Ranking</li>
                <li><strong>1,125,000</strong> Crawled Pages</li>
                <li> <strong>Branded Reports</strong></li>
            </ul>
            <p class="section-head">KEYWORD EXPLORER</p>
            <ul class="pack-details list-unstyled">
                <li><strong>12,000</strong> Full Keywords Reports</li>
                <li><strong>50</strong> Full Keywords List</li>
            </ul>
            <p class="section-head">USER ACCESS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>25</strong> Seats</li>
            </ul>
            <button class="btn btn-primary center-block btn-getit">Get it now</button>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="modal-1">
            <div class="pack-heading">
                <h4 class="pack-title"><strong>Enterprise</strong></h4>
                <div class="pack-price monthly-pack"><sup class="dollar">$</sup>399<span>/mo</span></div>
                <div class="pack-price yearly-pack" hidden><sup class="dollar">$</sup>4620<span>/yr</span>
                </div>
                <p>$385/mo If you get yearly Pack.</p>
            </div>
            <p class="section-head">TRACKED CAMPAIGNS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>100</strong> Campaigns</li>
                <li><strong>7,500</strong> Keyword Ranking</li>
                <li><strong>1,250,000</strong> Crawled Pages</li>
                <li> <strong>Branded Reports</strong></li>
            </ul>
            <p class="section-head">KEYWORD EXPLORER</p>
            <ul class="pack-details list-unstyled">
                <li><strong>30,000</strong> Full Keywords Reports</li>
                <li><strong>90</strong> Full Keywords List</li>
            </ul>
            <p class="section-head">USER ACCESS</p>
            <ul class="pack-details list-unstyled">
                <li><strong>30</strong> Seats</li>
            </ul>
            <button class="btn btn-primary center-block btn-getit">Get it now</button>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12">
        <p class="pro-option">Want to be a PRO User?</p>
        <p class="contact-info">We have larger and the best plans designed for you.</p>
        <a href="javascript:void(0)" class="btn btn-contact">Contact Us</a>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script>
$(document).ready(function() {
    $(".span-btn").on("click", function() {
        if ($(this).hasClass("yearly")) {
            $(".monthly-pack").hide(500);
            $(".yearly-pack").show(500);
        } else {
            $(".monthly-pack").show(500);
            $(".yearly-pack").hide(500);
        }
    });
});
</script>
@stop
