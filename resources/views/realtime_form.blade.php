@extends('layouts/default') {{-- Page title --}} @section('title') Real Time Forms @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('vendors/datetime/css/jquery.datetimepicker.css')}}">
<link href="{{asset('vendors/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('css/custom_css/realtime_form.css')}}"> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Real Time Forms</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            Real Time Forms
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-user"></i> Book Flight Tickets
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div class="row icheck-element">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="radio-inline iradio">
                                <input type="radio" id="one_way" name="trip-type" value="option1"> One Way
                            </label>
                            <label class="radio-inline iradio">
                                <input type="radio" id="round_trip" name="trip-type" value="option2" checked> Round trip
                            </label>
                            <label class="radio-inline iradio">
                                <input type="radio" id="multi_stops" name="trip-type" value="option3"> Multi Stops
                            </label>
                        </div>
                    </div>
                </div>
                <form id="single-stop">
                    <div class="row m-t-10">
                        <div class="trip-type visible-xs">
                            <i class="fa-rotate-90 fa ti-exchange-vertical icon"></i>
                        </div>
                        <div class="col-sm-5 col-xs-6">
                            <div class="form-group">
                                <label for="origin" class="control-label">From</label>
                                <input type="text" class="form-control" id="origin" placeholder="Origin City">
                            </div>
                        </div>
                        <div class="col-sm-2 hidden-xs">
                            <div class="trip-type">
                                <i class="fa-rotate-90 fa ti-exchange-vertical icon"></i>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xs-6">
                            <div class="form-group">
                                <label for="destination" class="control-label">To</label>
                                <input type="text" class="form-control" id="destination" placeholder="Destination City">
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="departure_date">Departure</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i></div>
                                            <input class="form-control" id="departure_date" placeholder="Select Date">
                                        </div>
                                    </div>
                                    <br class="visible-xs">
                                    <div class="col-sm-6">
                                        <label for="return_date">Return</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i></div>
                                            <input class="form-control" id="return_date" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="class-type">Class</label>
                                        <select name="class" id="class-type" class="form-control">
                                            <option value="">Economy</option>
                                            <option value="">Business</option>
                                            <option value="">First</option>
                                            <option value="">Premium Economy</option>
                                        </select>
                                    </div>
                                    <br class="visible-xs">
                                    <div class="col-sm-6">
                                        <label for="pref-Air" class="control-label">Preferred Airline
                                        </label>
                                        <input type="text" class="form-control" id="pref-Air" placeholder="Airline name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-sm-8 col-md-10 col-lg-8">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="adult">Adult</label>
                                        <input id="adult" type="text" value="1" readonly name="adult_count">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="child">Child</label>
                                        <input id="child" type="text" value="0" readonly name="child_count">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="infant">Infant</label>
                                        <input id="infant" type="text" value="0" readonly name="infant_count">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-sm-8">
                            <div class="form-group icheck-element">
                                <label class="price-alert">
                                    <input type="checkbox" name="c1" id="c1" value=""> Alert me when price changes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-warning btn-block">Search Flights</button>
                        </div>
                    </div>
                </form>
                <!--multistop flight form-->
                <form id="nonsingle-stop" hidden>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="flight-count">
                                <div class="row multi-flight-data">
                                    <div class="trip-type visible-xs">
                                        <i class="fa ti-arrow-right icon"></i>
                                    </div>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">From
                                                <input type="text" class="form-control" placeholder="Origin City">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 hidden-xs">
                                        <div class="trip-type-multi">
                                            <i class="fa ti-arrow-right icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">To
                                                <input type="text" class="form-control" placeholder="Destination City">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-0 col-xs-12">
                                        <label class="m-l-16">Departure</label>
                                        <div class="input-group m-l-16">
                                            <div class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i></div>
                                            <input class="form-control departure_date" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row multi-flight-data">
                                    <div class="trip-type visible-xs">
                                        <i class="fa ti-arrow-right icon"></i>
                                    </div>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">From
                                                <input type="text" class="form-control" placeholder="Origin City">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 hidden-xs">
                                        <div class="trip-type-multi">
                                            <i class="fa ti-arrow-right icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">To
                                                <input type="text" class="form-control" placeholder="Destination City">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-sm-offset-0 col-xs-12">
                                        <label class="m-l-16">Departure</label>
                                        <div class="input-group m-l-16">
                                            <div class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i></div>
                                            <input class="form-control departure_date" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-sm-6">
                                    <a class="btn btn-default" id="add-flight">
                                        <i class="fa fa-fw ti-plus"></i> Add flight
                                    </a>
                                    <label>Add Flight(Upto 6)</label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="class-type1">Class</label>
                                    <select name="class" class="form-control" id="class-type1">
                                        <option value="">Economy</option>
                                        <option value="">Business</option>
                                        <option value="">First</option>
                                        <option value="">Premium Economy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-sm-8 col-md-10 col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="adult-multi">Adult</label>
                                                <input id="adult-multi" type="text" value="1" readonly name="adult_count">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="child-multi">Child</label>
                                                <input id="child-multi" type="text" value="0" readonly name="child_count">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="infant-multi">Infant</label>
                                                <input id="infant-multi" type="text" value="0" readonly name="infant_count">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-2 col-lg-4">
                                    <label for="multi-air" class="control-label">Preferred Airline
                                    </label>
                                    <input type="text" class="form-control" id="multi-air" placeholder="Airline name">
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-sm-8">
                                    <div class="form-group icheck-element">
                                        <label class="price-alert">
                                            <input type="checkbox" name="price-alert" value=""> Alert me when price changes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-warning btn-block">Search Flights</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-home"></i> Book your Stay
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" placeholder="City, Area or Hotel">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="checkin_date">Check-In</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i></div>
                                    <input class="form-control" id="checkin_date" placeholder="Select Check-in Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="checkout_date">Check-Out</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw ti-calendar"></i></div>
                                    <input class="form-control" id="checkout_date" placeholder="Select Check-out Date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="adult-number">Adult</label>
                                <select name="count" id="adult-number" class="form-control">
                                    <option value="0">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="child-number">Child</label>
                                <select name="count" id="child-number" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group icheck-element">
                                <label class="guest-rooms">
                                    <input type="checkbox" name="price-alert" value=""> Guest Rooms
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-warning btn-block">Search Hotels</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-car"></i> Book a Drive
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                        <div class="ride-time">
                            <input type="radio" name="rGroup" value="1" id="r1" checked="checked" />
                            <label class="ride-on" for="r1">Ride Now</label>
                            <input type="radio" name="rGroup" value="2" id="r2" />
                            <label class="ride-on" for="r2">Ride Later</label>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" id="pick-l">
                                <label class="control-label">Pick-Up Point</label>
                                <input type="text" class="form-control route_point" id="pick_up" value="delhi" placeholder="Your Location">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Drop Point</label>
                                <input type="text" class="form-control route_point dest-point" id="drop_down" value="noida" placeholder="Drop Location">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!--DOM object for directions instructions-->
                            <ul id="instructions" hidden>
                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <div id="map" class="gmap"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                            <div class="cab-types">
                                <input type="radio" name="rGroup" value="1" id="cab1" checked="checked" />
                                <label class="cab-type" for="cab1">Sedan</label>
                                <input type="radio" name="rGroup" value="2" id="cab2" />
                                <label class="cab-type" for="cab2">SUV</label>
                                <input type="radio" name="rGroup" value="2" id="cab3" />
                                <label class="cab-type" for="cab3">LUX</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-warning btn-block">Confirm Ride</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-money"></i> Fund Transfer
                            </h3>
                <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form id="form-validation" action="realtime_form.html" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="skill">
                                    Select Account :
                                </label>
                                <div class="col-sm-7">
                                    <select id="skill" name="skill" class="form-control">
                                        <option value="" disabled="" selected="">
                                            Select account
                                        </option>
                                        <option value="234">0000432187653456</option>
                                        <option value="345">0000891236543567</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="number">
                                    Amount :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="number" name="number" class="form-control" placeholder="Enter amount" onkeypress="return isNumber(event, this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="val-username">
                                    Sender name :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="val-username" name="firstName" class="form-control" placeholder="Account holder name">
                                </div>
                            </div>
                            <h4><b>Information of the account you want to transfer fund</b></h4>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="holder-name">
                                    Account Holder name :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="holder-name" name="holderName" class="form-control" placeholder="Account holder name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="bank-name">
                                    Name of the Bank :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="bank-name" name="bankName" class="form-control" placeholder="Bank name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="swift-code">
                                    SWIFT Code :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="swift-code" name="bankName" class="form-control" placeholder="SWIFT code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="acc-number">
                                    Account Number/BAN :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="acc-number" name="number" class="form-control" placeholder="Account Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="purpose">
                                    Purpose (optional) :
                                </label>
                                <div class="col-sm-7">
                                    <input type="text" id="purpose" name="purpose" class="form-control" placeholder="optional">
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-7 col-sm-offset-5">
                                    <button type="submit" class="btn btn-effect-ripple btn-primary">
                                        Transfer
                                    </button>
                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/datetime/js/jquery.datetimepicker.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<!--google maps api-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyADWjiTRjsycXf3Lo0ahdc7dDxcQb475qw&libraries=places"></script>
<script type="text/javascript" src="{{asset('vendors/gmaps/js/gmaps.min.js')}}"></script>
<script src="{{asset('js/custom_js/realtime_form.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
<script>
// fund transfer amount restrict other than decimal number

function isNumber(evt, element) {

    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (
        (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}
</script>
@stop
