@extends('HRM/default') {{-- Page title --}} @section('title') Pendidikan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Pendidikan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/profil/pendidikan">
	                Managemen Personil / User / Pendidikan
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
				                <label class="col-sm-3 control-label">Nama Lembaga</label>
				                <div class="col-sm-6">
				                    <input type="text" id="nama_lembaga-input" name="nama_lembaga-input" class="form-control" value="{{$nama_lembaga}}" required />
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Fakultas</label>
				                <div class="col-sm-6">
				                    <input type="text" id="fakultas-input" name="fakultas-input" class="form-control" value="{{$fakultas}}"/>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Bidang Studi</label>
				                <div class="col-sm-6">
				                    <input type="text" id="bidang_studi-input" name="bidang_studi-input" class="form-control" value="{{$bidang_studi}}"/>
				                </div>
				            </div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tingkat</label>
								<div class="col-sm-6">
									<select id="tingkat-input" name="tingkat-input" class="form-control select2" size="1">
										<option value></option>
										@foreach ($tingkatan as $tkt)
											<option value="{{$tkt}}" {!! $tingkat==$tkt ? 'selected':'' !!}>{{$tkt}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Tahun Masuk</label>
				                <div class="col-sm-6">
				                    <input type="number" id="thn_masuk-input" name="thn_masuk-input" class="form-control" value="{{$thn_masuk}}"/>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Tahun Lulus</label>
				                <div class="col-sm-6">
				                    <input type="number" id="thn_lulus-input" name="thn_lulus-input" class="form-control" value="{{$thn_lulus}}" required/>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Deskripsi</label>
				                <div class="col-sm-6">
				                    <textarea id="deskripsi-input" name="deskripsi-input" class="form-control" >{{$deskripsi}}</textarea>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Scan Ijazah</label>
				                <div class="col-sm-6">
									<input id="uri_img_dok1-input" type="file" class="file" accept="image/*" name="uri_img_dok1-input">
				                    <br>
									<img id="uri_img_dok1" alt="gallery" src="/uploads/pendidikan/{{$uri_img_dok1}}" {!! $uri_img_dok1==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok1-file" name="uri_img_dok1-file" value="{{$uri_img_dok1}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok1==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok1')">delete</button>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Scan Transkrip</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_dok2-input" type="file" class="file" accept="image/*" name="uri_img_dok2-input">
				                    <br>
									<img id="uri_img_dok2" alt="gallery" src="/uploads/pendidikan/{{$uri_img_dok2}}" {!! $uri_img_dok2==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok2-file" name="uri_img_dok2-file" value="{{$uri_img_dok2}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok2==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok2')">Delete</button>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Lain - Lain</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_dok3-input" type="file" class="file" accept="image/*" name="uri_img_dok3-input">
				                    <br>
									<img id="uri_img_dok3" alt="gallery" src="/uploads/pendidikan/{{$uri_img_dok3}}" {!! $uri_img_dok3==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok3-file" name="uri_img_dok3-file" value="{{$uri_img_dok3}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok3==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok3')">Delete</button>
				                </div>
				            </div>
							<!--<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_by }}</label>
                                </div>
                            </div>
							<div class="form-group ">
								<label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
								<div class="col-sm-6">
									<label class="form-control">{{ $created_time }}</label>
								</div>
							</div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_by }}</label>
                                </div>
                            </div>
							<div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_time }}</label>
                                </div>
                            </div>-->
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/hrm/profil/pendidikan" type="button" class="btn btn-effect-ripple btn-danger">
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
		var form_data = new FormData(this);
		e.preventDefault();
		$.ajax({
			type: 'post',
			processData: false,
            contentType: false,
			"url": "/hrm/profil/pendidikan/create",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/profil/pendidikan";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	$("#uri_img_dok1-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#uri_img_dok2-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#uri_img_dok3-input").fileinput({
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
