@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping Kota ke KorKot @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Mapping Kota ke KorKot</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/kota_korkot">
                    Master Data / Data Cakupan Program / Mapping Kota ke KorKot
                </a>
            </li>
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop
{{-- Page content --}} @section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered signup_validator">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama KorKot</label>
                                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                                <div class="col-sm-6">
                                    <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input">
                                        <option>Please Select</option>
                                        @foreach($kode_korkot_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_korkot) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input">
                                        <option>Please Select</option>
                                        @foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama MS</label>
                                <div class="col-sm-6">
                                    <select id="select-ms_kode-input" name="select-ms_kode-input" class="form-control" size="1">
                                        <option>Please Select</option>
                                        <option value="1" @if($ms_kode==1) selected="selected" @endif >MS 1</option>
                                        <option value="2" @if($ms_kode==2) selected="selected" @endif >MS 2</option>
                                        <option value="3" @if($ms_kode==3) selected="selected" @endif >MS 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Paket MS</label>
                                <div class="col-sm-6">
                                    <select id="select-ms_paket-input" name="select-ms_paket-input" class="form-control" size="1">
                                        <option>Please Select</option>
                                        <option value="1" @if($ms_paket==1) selected="selected" @endif >Paket MS 1</option>
                                        <option value="2" @if($ms_paket==2) selected="selected" @endif >Paket MS 2</option>
                                        <option value="3" @if($ms_paket==3) selected="selected" @endif >Paket MS 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/kota_korkot" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                        Reset
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
@stop
{{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/kota_korkot/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/kota_korkot";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });

        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        $("#select-ms_kode-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        $("#select-ms_paket-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
    });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>

<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
@stop
