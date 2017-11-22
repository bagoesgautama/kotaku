@extends('HRM/default') {{-- Page title --}} @section('title') Sertifikasi Pelatihan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Sertifikasi Pelatihan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/profil/pelatihan">
	                Managemen Personil / User / Sertifikasi Pelatihan
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
				                <label class="col-sm-3 control-label">Nama</label>
				                <div class="col-sm-6">
				                    <input type="text" id="nama-input" name="nama-input" class="form-control" value="{{$nama}}" required />
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Deskripsi</label>
				                <div class="col-sm-6">
				                    <textarea id="deskripsi-input" name="deskripsi-input" class="form-control" >{{$deskripsi}}</textarea>
				                </div>
				            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pelatihan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_pelatihan-input" name="tgl_pelatihan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_pelatihan}}" >
                                </div>
                            </div>
							<div class="form-group ">
								<label class="col-sm-3 control-label">Penyelenggara</label>
								<div class="col-sm-3">
									<label class="radio-inline">
										<input type="radio" id="flag_kotaku" name="flag_kotaku" value="1" {!! $flag_kotaku===1 ? 'checked':'checked' !!}> Kotaku</label>
								</div>
								<div class="col-sm-3">
									<label class="radio-inline">
										<input type="radio" id="flag_kotaku" name="flag_kotaku" value="0" {!! $flag_kotaku===0 ? 'checked':''!!}> Luar Kotaku</label>
								</div>
							</div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Instansi</label>
				                <div class="col-sm-6">
				                    <input type="text" id="instansi-input" name="instansi-input" class="form-control" value="{{$instansi}}"/>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Scan Sertifikat Hal. Depan</label>
				                <div class="col-sm-6">
									<input id="uri_img_sertifikat1-input" type="file" class="file" accept="image/*" name="uri_img_sertifikat1-input">
				                    <br>
									<img id="uri_img_sertifikat1" alt="gallery" src="/uploads/pelatihan/{{$uri_img_sertifikat1}}" {!! $uri_img_sertifikat1==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_sertifikat1-file" name="uri_img_sertifikat1-file" value="{{$uri_img_sertifikat1}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_sertifikat1==null ? 'style="display:none"':'' !!} onclick="test('uri_img_sertifikat1')">delete</button>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Scan Sertifikat Hal. Belakang</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_sertifikat2-input" type="file" class="file" accept="image/*" name="uri_img_sertifikat2-input">
				                    <br>
									<img id="uri_img_sertifikat2" alt="gallery" src="/uploads/pelatihan/{{$uri_img_sertifikat2}}" {!! $uri_img_sertifikat2==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_sertifikat2-file" name="uri_img_sertifikat2-file" value="{{$uri_img_sertifikat2}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_sertifikat2==null ? 'style="display:none"':'' !!} onclick="test('uri_img_sertifikat2')">Delete</button>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Lain-lain</label>
				                <div class="col-sm-6">
				                    <input id="url_img_sertifikat3-input" type="file" class="file" accept="image/*" name="url_img_sertifikat3-input">
				                    <br>
									<img id="url_img_sertifikat3" alt="gallery" src="/uploads/pelatihan/{{$url_img_sertifikat3}}" {!! $url_img_sertifikat3==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="url_img_sertifikat3-file" name="url_img_sertifikat3-file" value="{{$url_img_sertifikat3}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $url_img_sertifikat3==null ? 'style="display:none"':'' !!} onclick="test('url_img_sertifikat3')">Delete</button>
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
                                    <a href="/hrm/profil/pelatihan" type="button" class="btn btn-effect-ripple btn-danger">
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
	function test(id){
		console.log(id)
		var elem = document.getElementById(id);
		elem.parentNode.removeChild(elem);
		var elem2 = $('#'+id+'-file');
		elem2.removeAttr('value');
		return false;
	}
  $(document).ready(function () {

	$('#form').on('submit', function (e) {

		var uri_img_sertifikat1 = document.getElementById('uri_img_sertifikat1-input').files[0];
		var uri_img_sertifikat2 = document.getElementById('uri_img_sertifikat2-input').files[0];
		var url_img_sertifikat3 = document.getElementById('url_img_sertifikat3-input').files[0];
		var form_data = new FormData();
		//console.log(this)
		//console.log(form_data)
		form_data.append('kode', $('#kode').val());
		form_data.append('uri_img_sertifikat1-input', uri_img_sertifikat1);
		form_data.append('uri_img_sertifikat2-input', uri_img_sertifikat2);
		form_data.append('url_img_sertifikat3-input', url_img_sertifikat3);
		form_data.append('uri_img_sertifikat1-file', $('#uri_img_sertifikat1-file').val());
		form_data.append('uri_img_sertifikat2-file', $('#uri_img_sertifikat2-file').val());
		form_data.append('url_img_sertifikat3-file', $('#url_img_sertifikat3-file').val());
		form_data.append('nama-input', $('#nama-input').val());
		form_data.append('deskripsi-input', $('#deskripsi-input').val());
		form_data.append('tgl_pelatihan-input', $('#tgl_pelatihan-input').val());
		form_data.append('flag_kotaku', $('#flag_kotaku:checked').val());
		form_data.append('instansi-input', $('#instansi-input').val());
		e.preventDefault();
		$.ajax({
			type: 'post',
			processData: false,
            contentType: false,
			"url": "/hrm/profil/pelatihan/create",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/profil/pelatihan";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	$("#uri_img_sertifikat1-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#uri_img_sertifikat2-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#url_img_sertifikat3-input").fileinput({
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
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
@stop
