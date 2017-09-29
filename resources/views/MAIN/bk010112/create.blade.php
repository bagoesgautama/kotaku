@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping Kota ke KorKot @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Mapping Kota ke KorKot Form</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/hrm">
                <i class="fa fa-fw fa-home"></i> MAIN
            </a>
        </li>
        <li><a href="/main/kmp_slum_program">Mapping Kota ke KorKot</a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama KorKot</label>
                <div class="col-sm-6">
                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                    <input type="text" id="example-text-input1" name="example-kode_korkot-input" class="form-control" placeholder="KorKot" value="{{ $kode_korkot }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama kota</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-kode_kota-input" class="form-control" placeholder="Kota" value="{{ $kode_kota }}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama MS</label>
                <div class="col-sm-6">
                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                    <input type="text" id="example-text-input1" name="example-ms_kode-input" class="form-control" placeholder="MS" value="{{ $ms_kode }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Paket MS</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-ms_paket-input" class="form-control" placeholder="Kota" value="{{ $ms_paket }}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_time }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_by }}</label>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_time }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_by }}</label>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/hrm/role" type="button" class="btn btn-effect-ripple btn-danger">
                        Cancel
                    </a>
                    <button type="submit" id="dodol" class="btn btn-effect-ripple btn-primary">
                        Submit
                    </button>
                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#dodol').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/hrm/role_level/create",
            data: $('form').serialize(),
            success: function () {
    alert('Success !!!');
    window.location.href = "/hrm/role_level";
   },
   error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
          });
        });
      });
</script>
@stop
