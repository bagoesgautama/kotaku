@extends('MAIN/default') {{-- Page title --}} @section('title') Pemanfaatan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Pemanfaatan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
			<li class="next">
				<a href="/main/data_master/pemanfaatan">
	                Master Data / Data Master / Pemanfaatan
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
<script>
</script>
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">NIK</label>
				                <div class="col-sm-6">
				                    <input type="hidden" id="kode" name="kode" value="{{$kode}}">
				                    <input type="text" id="nik-input" name="nik-input" class="form-control" placeholder="NIK" value="{{$nik}}" required>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Nama</label>
				                <div class="col-sm-6">
				                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="nama" value="{{$nama}}" required>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Alamat</label>
				                <div class="col-sm-6">
				                    <textarea id="alamat-input" name="alamat-input" class="form-control" placeholder="" required >{{$alamat}}</textarea>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Jenis Kelamin</label>
				                <div class="col-sm-6">
									<select id="kode_jenis_kelamin-input" name="kode_jenis_kelamin-input" class="form-control" size="1">
				                        <option value="P" {!! $kode_jenis_kelamin=="P" ? 'selected':'' !!}>Pria</option>
				                        <option value="W" {!! $kode_jenis_kelamin=="W" ? 'selected':'' !!}>Wanita</option>
				                    </select>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Flag mbr</label>
				                <div class="col-sm-6">
									<select id="flag_mbr-input" name="flag_mbr-input" class="form-control" size="1">
				                        <option value=0 {!! $flag_mbr==0 ? 'selected':'' !!}>True</option>
				                        <option value=1 {!! $flag_mbr==1 ? 'selected':'' !!}>False</option>
				                    </select>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Longitude</label>
				                <div class="col-sm-6">
				                    <input type="number" id="longitude-input" name="longitude-input" class="form-control"  value="{{$longitude}}">
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Latitude</label>
				                <div class="col-sm-6">
				                    <input type="number" id="latitude-input" name="latitude-input" class="form-control"  value="{{$latitude}}">
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Status</label>
				                <div class="col-sm-6">
				                    <select id="status-input" name="status-input" class="form-control" size="1">
				                        <option value="0" {!! $status==0 ? 'selected':'' !!}>Tidak Aktif</option>
				                        <option value="1" {!! $status==1 ? 'selected':'' !!}>Aktif</option>
				                    </select>
				                </div>
				            </div>
							<!--<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_by }}</label>
                                </div>
                            </div>
							<div class="form-group striped-col">
								<label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
								<div class="col-sm-6">
									<label class="form-control">{{ $created_time }}</label>
								</div>
							</div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_by }}</label>
                                </div>
                            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_time }}</label>
                                </div>
                            </div>-->
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/data_master/pemanfaatan" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/data_master/pemanfaatan/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/data_master/pemanfaatan";
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
