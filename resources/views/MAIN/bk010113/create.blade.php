@extends('MAIN/default') {{-- Page title --}} @section('title') Tim Fasilitator Kelurahan (FasKel) Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Tim Fasilitator Kelurahan (FasKel)</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> HRM
            </a>
        </li>
        <li><a href="/main/faskel"> FasKel</a></li>
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
                <label class="col-sm-3 control-label" for="example-text-input1">Nama KMW</label>
                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                <div class="col-sm-6">
                    <select id="example-select1" name="example-kode_kmw-input" class="form-control" size="1">
                        @foreach($kode_kmw_list as $list)
                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama KorKot</label>
                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                <div class="col-sm-6">
                    <select id="example-select1" name="example-kode_korkot-input" class="form-control" size="1">
                        @foreach($kode_korkot_list as $list)
                            <option value="{{ $list->kode }}" @if($list->kode==$kode_korkot) selected="selected" @endif >{{ $list->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                 <label class="col-sm-3 control-label" for="example-text-input1">Nama</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-nama-input" class="form-control" placeholder="Nama" value="{{ $nama }}">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/hrm/role" type="button" class="btn btn-effect-ripple btn-danger">
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
        </div>
    </form>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/faskel/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/faskel";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
      });
</script>
@stop
