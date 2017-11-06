@extends('HRM/default') {{-- Page title --}} @section('title') Blacklist Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Blacklist</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/management/user/blacklist">
	                Managemen User / Blacklist
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
				                <label class="col-sm-3 control-label">User name</label>
				                <div class="col-sm-6">
				                    <label class="form-control">{{ $user_name }}</label>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Nama Depan</label>
				                <div class="col-sm-6">
				                    <label class="form-control">{{ $nama_depan }}</label>
				                </div>
				            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Nama Belakang</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $nama_belakang }}</label>
                                </div>
                            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Blacklist</label>
				                <div class="col-sm-6">
				                    <select id="flag_blacklist-input" name="flag_blacklist-input" class="form-control" size="1">
										<option value="0" {!! $flag_blacklist===0 ? 'selected':'' !!}>Tidak</option>
				                        <option value="1" {!! $flag_blacklist===1 ? 'selected':'' !!}>Ya</option>
				                    </select>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Blacklist Note</label>
				                <div class="col-sm-6">
				                    <textarea  id="blacklist_notes-input" name="blacklist_notes-input" class="form-control" >{{$blacklist_notes}}</textarea>
				                </div>
				            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Blacklist By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $blacklist_by }}</label>
                                </div>
                            </div>
							<div class="form-group striped-col">
								<label class="col-sm-3 control-label" for="example-text-input1">Blacklist Time</label>
								<div class="col-sm-6">
									<label class="form-control">{{ $blacklist_dt }}</label>
								</div>
							</div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/hrm/management/user/blacklist" type="button" class="btn btn-effect-ripple btn-danger">
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
			"url": "/hrm/management/user/blacklist/create",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/management/user/blacklist";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@stop
