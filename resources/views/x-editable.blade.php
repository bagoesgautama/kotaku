@extends('layouts/default') {{-- Page title --}} @section('title') X-Editable @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/x-editable/css/typeahead.js-bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('vendors/iCheck/css/all.css')}}" type="text/css" />
<link href="{{asset('css/inlinedit.css')}}" rel="stylesheet" type="text/css" /> @stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>X-Editable</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Forms</li>
        <li class="active">
            X-Editable
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">
                                <i class="fa fa-fw ti-slice"></i> X-editable
                            </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 m-t-10">
                        <div class="form-group">
                            <label class="m-t-10">
                                <input type="checkbox" id="autoopen" class="custom-checkbox" /> Auto-open next field</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 m-t-10">
                        <button id="enable" class="btn btn-success btn-sm">Enable / Disable</button>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <form method="get" id="frm" class="form-inline" action="#">
                            <div class="form-group">
                                <label for="c" class="m-t-10">Mode</label>
                                <select name="c" id="c" class="form-control input-sm m-l-10 m-t-10">
                                    <option value="popup">Popup</option>
                                    <option value="inline">Inline</option>
                                </select>
                                <button type="submit" class="btn btn-responsive btn-warning btn-sm m-l-10 m-t-10">
                                    Refresh
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td class="table_simple">Simple text field</td>
                            <td class="table_superuser">
                                <a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username" class="editable editable-click" data-original-title="" title="">superuser</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Empty text field, required</td>
                            <td>
                                <a href="#" id="firstname" data-type="text" data-pk="1" data-placement="top" data-placeholder="Required" data-title="Enter your firstname" class="editable editable-click editable-empty" data-original-title="" title="">Change It</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Combodate (date)</td>
                            <td>
                                <a href="#" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-title="Select Date of birth" class="editable editable-click">15/05/1984</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Combodate (datetime)</td>
                            <td>
                                <a href="#" id="event" data-type="combodate" data-template="D / MMM / YYYY , HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM/D/YYYY, HH:mm" data-pk="1" data-title="Setup event date and time" class="editable editable-click editable-empty">Empty</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Textarea</td>
                            <td>
                                <a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click">awesome user!</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Twitter typeahead.js</td>
                            <td>
                                <a href="#" id="state2" data-type="typeaheadjs" data-pk="1" data-placement="top" data-title="Start typing State.." class="editable editable-click">California</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Checklist</td>
                            <td>
                                <a href="#" id="fruits" data-type="checklist" data-value="2,3" data-title="Select fruits" class="editable editable-click">
                                            peach
                                            <br>apple</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Custom input, several fields</td>
                            <td>
                                <a id="address" data-type="address" data-pk="1" data-title="Please, fill address" class="editable editable-click" data-original-title="" title=""> <b>Moscow</b> , Lenina st., bld. 12
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> @stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/jquery-mockjax/js/jquery.mockjax.js')}}"></script>
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
<script src="{{asset('vendors/x-editable/js/bootstrap-editable.js')}}"></script>
<script src="{{asset('vendors/x-editable/js/typeahead.js')}}"></script>
<script src="{{asset('vendors/x-editable/js/typeaheadjs.js')}}"></script>
<script src="{{asset('vendors/x-editable/js/address.js')}}"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/demo-mock.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/custom_js/x-editable.js')}}"></script>
@stop
