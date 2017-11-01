@extends('HRM/default') {{-- Page title --}} @section('title') Change Password @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
@stop {{-- Page Header--}} @section('page-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Change Password</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/hrm">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
            <li class="next">
                Managemen Personil / Change Password
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>Change Password</b>
                </div>
				<div class="tools pull-right">
					<b>bk020307 Index</b>
				</div>
            </div>
            <div class="panel-body">
				<form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Password Lama</label>
						<div class="col-sm-6">
							<input type="password" id="old-input" name="old-input" class="form-control" required />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Password Baru</label>
						<div class="col-sm-6">
							<input type="password" id="new-input" name="new-input" class="form-control" required />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Konfirmasi Password</label>
						<div class="col-sm-6">
							<input type="password" id="new2-input" name="new2-input" class="form-control" required />
						</div>
					</div>
					<div class="form-group form-actions">
						<div class="col-sm-9 col-sm-offset-3">
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
<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')
<script>
  $(document).ready(function () {

	$('#form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			"url": "/hrm/profil/user/password",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function (e) {
				if(e=="true"){
					alert("Password berhasil diganti");
					window.location.href = "/hrm/profil/user/password";
				}else{
					alert(e);
					$("#submit").prop('disabled', false);
				}
				//window.location.href = "/hrm/profil/user/password";
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
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
