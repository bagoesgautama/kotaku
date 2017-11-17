@extends('HRM/default') {{-- Page title --}} @section('title') Sidang Etik Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Sidang Etik</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/management_personil/sidang">
	                Managemen Personil / Sidang Etik
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
				                <label class="col-sm-3 control-label">User </label>
				                <div class="col-sm-6">
									<select id="kode_personil-input" name="kode_personil-input" class="form-control" size="1" required>
										<option value>Please Select</option>
										@foreach ($user_list as $kpl)
				                            <option value="{{$kpl->id}}" {!! $kode_personil==$kpl->id ? 'selected':'' !!}>{{$kpl->user_name}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Sidang</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_sidang-input" name="tgl_sidang-input" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_sidang}}" required>
                                </div>
                            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Summary Sidang</label>
				                <div class="col-sm-6">
				                    <textarea id="summary_sdg-input" name="summary_sdg-input" class="form-control" required>{{$summary_sdg}}</textarea>
				                </div>
				            </div>
							<div class="form-group ">
								<label class="col-sm-3 control-label" for="example-select1">Hasil Sidang</label>
								<div class="col-sm-6">
									<select id="hasil_sdg-input" name="hasil_sdg-input" class="form-control" size="1" required>
										<option value="0" @if($hasil_sdg==0) selected="selected" @endif >Tidak Terbukti</option>
										<option value="1" @if($hasil_sdg==1) selected="selected" @endif >Terbukti</option>
									</select>
								</div>
							</div>
							<div class="form-group striped-col">
								<label class="col-sm-3 control-label" for="example-select1">Sanksi</label>
								<div class="col-sm-6">
									<select id="sanksi-input" name="sanksi-input" class="form-control" size="1">
										<option value>Please Select</option>
										<option value="0" @if($sanksi==0) selected="selected" @endif >Pemberhentian</option>
										<option value="1" @if($sanksi==1) selected="selected" @endif >Peringatan</option>
										<option value="2" @if($sanksi==2) selected="selected" @endif >Blacklist</option>
									</select>
								</div>
							</div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Image sp 1</label>
				                <div class="col-sm-6">
									<input id="uri_img_dok1-input" type="file" class="file" accept="image/*" name="uri_img_dok1-input">
				                    <br>
									<img id="uri_img_dok1" alt="gallery" src="/uploads/sidang/{{$uri_img_dok1}}" {!! $uri_img_dok1==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok1-file" name="uri_img_dok1-file" value="{{$uri_img_dok1}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok1==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok1')">delete</button>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Image sp 2</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_dok2-input" type="file" class="file" accept="image/*" name="uri_img_dok2-input">
				                    <br>
									<img id="uri_img_dok2" alt="gallery" src="/uploads/sidang/{{$uri_img_dok2}}" {!! $uri_img_dok2==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok2-file" name="uri_img_dok2-file" value="{{$uri_img_dok2}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok2==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok2')">Delete</button>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Image sp 3</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_dok3-input" type="file" class="file" accept="image/*" name="uri_img_dok3-input">
				                    <br>
									<img id="uri_img_dok3" alt="gallery" src="/uploads/sidang/{{$uri_img_dok3}}" {!! $uri_img_dok3==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_dok3-file" name="uri_img_dok3-file" value="{{$uri_img_dok3}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_dok3==null ? 'style="display:none"':'' !!} onclick="test('uri_img_dok3')">Delete</button>
				                </div>
				            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/hrm/management_personil/sidang" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
									@if( $id!=$kode_personil)
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
									@endif
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
			"url": "/hrm/management_personil/sidang/create",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/management_personil/sidang";
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

	$("#kode_personil-input").select2({
		theme: "bootstrap"
	})
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
