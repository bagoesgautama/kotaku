@extends('QS/default') {{-- Page title --}} @section('title') Schedule Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>schedule</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> QS
                </a>
            </li>
			<li class="next">
				<a href="/qs/master/schedule">
	                Master Data / Schedule
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
						<form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
							<input type="hidden" id="id" name="id" value="{{$id}}">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Parent</label>
				                <div class="col-sm-6">
									<select id="id_parent-input" name="id_parent-input" class="form-control" size="1">
										@foreach ($parent_list as $kpl)
				                            <option value="{{$kpl->id}}" {!! $id_agenda==$kpl->id ? 'selected':'' !!}>{{$kpl->nama_kegiatan}}</option>
				                        @endforeach
									</select>
				                </div>-
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Kode Kegiatan</label>
				                <div class="col-sm-6">
									<input type="text" id="kode_keg_kel-input" name="kode_keg_kel-input" class="form-control"  value="{{$kode_keg_kel}}" required>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">No Urut</label>
				                <div class="col-sm-6">
				                    <input type="number" id="no_urut-input" name="no_urut-input" class="form-control" value="{{$no_urut}}"/>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Nama Kegiatan</label>
				                <div class="col-sm-6">
				                    <input type="text" id="nama_kegiatan-input" name="nama_kegiatan-input" class="form-control" value="{{$nama_kegiatan}}" required>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Tanggal Mulai</label>
				                <div class="col-sm-6">
									<input class="form-control" id="tgl_mulai-input" name="tgl_mulai-input" placeholder="Tanggal Mulai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_mulai}}" >
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Tanggal Selesai</label>
				                <div class="col-sm-6">
									<input class="form-control" id="tgl_selesai-input" name="tgl_selesai-input" placeholder="Tanggal Selesai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_selesai}}" >
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Status</label>
				                <div class="col-sm-6">
				                    <select id="status-input" name="status-input" class="form-control" size="1">
				                        <option value="0" {!! $status==0 ? 'selected':'' !!}>Tidak Aktif</option>
				                        <option value="1" {!! $status==1 ? 'selected':'' !!}>Aktif</option>
				                    </select>
				                </div>
				            </div>
							<div class="form-group">
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
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/qs/master/schedule" type="button" class="btn btn-effect-ripple btn-danger">
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
<script>
  $(document).ready(function () {
	$('#form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			"url": "/qs/master/schedule/create",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {

			alert('From Submitted.');
			window.location.href = "/qs/master/schedule";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	$("#id_agenda-input").select2({
		theme: "bootstrap"
	});
	$("#id_parent-input").select2({
		theme: "bootstrap"
	});
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
@stop
