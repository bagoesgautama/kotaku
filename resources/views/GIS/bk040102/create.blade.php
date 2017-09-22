@extends('GIS/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}}
@section('header_styles') 
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>GIS Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
            	<a href="/gis">
            		<i class="fa fa-fw fa-home"></i> GIS
            	</a>
            </li>
            <li class="next">
                <a href="/gis/provinsi">
                    Master Data Provinsi
                </a>
            </li>
            <li class="next">
	            Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content') 
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-6">
                    <input type="hidden" id="kode" name="kode" value="{{$kode}}">
                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="Nama" value="{{$nama}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Nama Pendek</label>
                <div class="col-sm-6">
                    <input type="text" id="nama-pndk-input" name="nama-pndk-input" class="form-control" placeholder="Nama Pendek" value="{{$nama_pendek}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Wilayah</label>
                <div class="col-sm-6">
                    <input type="text" id="wilayah-input" name="wilayah-input" class="form-control" placeholder="Wilayah" value="{{$wilayah}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">File</label>
                <div class="col-sm-6">
                    <input id="file-input" type="file" class="file" data-show-preview="false" name="file-input">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                    <select id="status-input" name="status-input" class="form-control" size="1">
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                        <option value="2">Dihapus</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/hrm/registrasi" type="button" class="btn btn-effect-ripple btn-danger">
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

@stop {{-- local scripts --}} @section('footer_scripts') 
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/gis/provinsi/create",
            data: $('form').serialize(),
            success: function () {
    alert('Form Submitted.');
    window.location.href = "/gis/provinsi";
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
