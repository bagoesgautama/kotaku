@extends('HRM/default') {{-- Page title --}} @section('title') Profil @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Profil</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/hrm">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
            <li class="next">
                Managemen Personil / Profil
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
                    <b>bk020312 Index</b>
                </div>
            </div>
            <div class="panel-body">
				<form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Username</label>
						<div class="col-sm-6">
							<label class="form-control">{{ $user->user_name }}</label>
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Nama Depan</label>
						<div class="col-sm-6">
							<input type="text" id="nama_depan-input" name="nama_depan-input" value="{{$user->nama_depan}}" class="form-control" required />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Nama Belakang</label>
						<div class="col-sm-6">
							<input type="text" id="nama_belakang-input" name="nama_belakang-input" value="{{$user->nama_belakang}}" class="form-control"  />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Profile picture</label>
						<div class="col-sm-6">
							<input id="uri_img_profile-input" type="file" class="file" accept="image/*" name="uri_img_profile-input">
							<br>
							<img id="uri_img_profile" alt="gallery" src="/uploads/profil/{{$user->uri_img_profile}}" {!! $user->uri_img_profile==null ? 'style="display:none"':'style="width:150px"' !!} >
							<input type="hidden" id="uri_img_profile-file" name="uri_img_profile-file" value="{{$user->uri_img_profile}}">
							<button type="button" class="btn btn-effect-ripple btn-danger" {!! $user->uri_img_profile==null ? 'style="display:none"':'' !!} onclick="test('uri_img_profile')">Delete</button>
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Alamat</label>
						<div class="col-sm-6">
							<textarea id="alamat-input" name="alamat-input" >{{$user->alamat}}</textarea>
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-6">
							<input type="text" id="email-input" name="email-input" value="{{$user->email}}" class="form-control" />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">No HP</label>
						<div class="col-sm-6">
							<input type="text" id="no_hp-input" name="no_hp-input" value="{{$user->no_hp}}" class="form-control"  />
						</div>
					</div>
					<div class="form-group striped-col">
						<label class="col-sm-3 control-label">No HP 2</label>
						<div class="col-sm-6">
							<input type="text" id="no_hp2-input" name="no_hp2-input" value="{{$user->no_hp2}}" class="form-control"  />
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
function test(id){
  var elem = document.getElementById(id);
  elem.parentNode.removeChild(elem);
  var elem2 = $('#'+id+'-file');
  elem2.removeAttr('value');
  return false;
}
  $(document).ready(function () {

	$('#form').on('submit', function (e) {
		e.preventDefault();
		var form_data = new FormData(this);
		$.ajax({
			type: 'post',
			processData: false,
            contentType: false,
			"url": "/hrm/profil/user/profil",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function (e) {
				if(e=="true"){
					alert("profil berhasil diganti");
					window.location.href = "/hrm/profil/user/profil";
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
	$("#uri_img_profile-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
