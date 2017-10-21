@extends('HRM/default') {{-- Page title --}} @section('title') Kuota Korkot Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kuota Korkot</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/management/kuota/korkot">
	                Managemen Personil / Kuota Personil / Kuota Korkot
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
							<input type="hidden" id="kode" name="kode" value="{{$kode}}">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Korkot Kota</label>
				                <div class="col-sm-6">
									<select id="kode_kota_korkot-input" name="kode_kota_korkot-input" class="form-control" size="1" required>
										<option value>Please Select</option>
										@foreach ($korkot_list as $kpl)
				                            <option value="{{$kpl->kode}}" {!! $kode_kota_korkot==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
				                        @endforeach
									</select>
				                </div>-
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Role</label>
				                <div class="col-sm-6">
									<select id="kode_role-input" name="kode_role-input" class="form-control" size="1" required>
										<option value>Please Select</option>
										@foreach ($role_list as $kpl)
				                            <option value="{{$kpl->kode}}" {!! $kode_role==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Kuota Personil</label>
				                <div class="col-sm-6">
				                    <input type="number" id="quota_personil-input" name="quota_personil-input" class="form-control" value="{{$quota_personil}}" required />
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
                                    <a href="/hrm/management/kuota/korkot" type="button" class="btn btn-effect-ripple btn-danger">
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
			"url": "/hrm/management/kuota/korkot/create",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {

			alert('From Submitted.');
			window.location.href = "/hrm/management/kuota/korkot";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	$("#kode_role-input").select2({
		theme: "bootstrap"
	});
	$("#kode_kota_korkot-input").select2({
		theme: "bootstrap"
	});

  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
