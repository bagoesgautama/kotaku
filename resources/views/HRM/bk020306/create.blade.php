@extends('HRM/default') {{-- Page title --}} @section('title') Perubahan Status Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perubahan Status</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/profil/user/perubahan">
	                Managemen Personil / User / Perubahan Status
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
							<input type="hidden" id="kode_role_lama" name="kode_role_lama" value="{{$kode_role_lama}}">
							<input type="hidden" id="kode_prop_lama" name="kode_prop_lama" value="{{$kode_prop_lama}}">
							<input type="hidden" id="kode_kota_lama" name="kode_kota_lama" value="{{$kode_kota_lama}}">
							<input type="hidden" id="kode_kel_lama" name="kode_kel_lama" value="{{$kode_kel_lama}}">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Perubahan Status </label>
				                <div class="col-sm-6">
									<select id="kode_jns_perubahan-input" name="kode_jns_perubahan-input" class="form-control" size="1" required>
										<option value>Please Select</option>
										@foreach ($perubahan as $kpl)
				                            <option value="{{$kpl->kode}}" {!! $kode_jns_perubahan==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Role Lama</label>
				                <div class="col-sm-6">
									<select id="kode_role_lama-input" name="kode_role_lama-input" class="form-control" size="1" required disabled="disable">
										<option value>Please Select</option>
										@foreach ($role as $kpl)
				                            <option value="{{$kpl->kode}}" {!! $kode_role_lama==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Role Baru</label>
				                <div class="col-sm-6">
									<select id="kode_role_baru-input" name="kode_role_baru-input" class="form-control" size="1" required>
										<option value>Please Select</option>
										@foreach ($role as $kpl)
				                            <option value="{{$kpl->kode}}" {!! $kode_role_baru==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Efektif</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_efektif_role_baru-input" name="tgl_efektif_role_baru-input" placeholder="Tanggal Penghargaan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_efektif_role_baru}}" required>
                                </div>
                            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Provinsi lama</label>
				                <div class="col-sm-6">
									<select id="kode_prop_lama-input" name="kode_prop_lama-input" class="form-control" size="1" disabled="disable">
										<option value>Please select</option>
				                        @foreach ($prop_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_prop_lama==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group ">
				                <label class="col-sm-3 control-label">Kota lama</label>
				                <div class="col-sm-6">
									<select id="kode_kota_lama-input" name="kode_kota_lama-input" class="form-control" size="1" disabled="disable">
										<option value>Please select</option>
				                        @foreach ($kota_lama_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kota_lama==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Kelurahan lama</label>
				                <div class="col-sm-6">
									<select id="kode_kel_lama-input" name="kode_kel_lama-input" class="form-control" size="1" disabled="disable">
										<option value>Please select</option>
				                        @foreach ($kel_lama_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kel_lama==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Provinsi baru</label>
				                <div class="col-sm-6">
									<select id="kode_prop_baru-input" name="kode_prop_baru-input" class="form-control" size="1" >
										<option value>Please select</option>
				                        @foreach ($prop_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_prop_baru==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Kota baru</label>
				                <div class="col-sm-6">
									<select id="kode_kota_baru-input" name="kode_kota_baru-input" class="form-control" size="1" >
										<option value>Please select</option>
				                        @foreach ($kota_baru_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kota_baru==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group ">
				                <label class="col-sm-3 control-label">Kelurahan baru</label>
				                <div class="col-sm-6">
									<select id="kode_kel_baru-input" name="kode_kel_baru-input" class="form-control" size="1" >
										<option value>Please select</option>
				                        @foreach ($kel_baru_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kel_baru==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Catatan</label>
				                <div class="col-sm-6">
				                    <textarea id="catatan-input" name="catatan-input" class="form-control" >{{$catatan}}</textarea>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Image 1</label>
				                <div class="col-sm-6">
									<input id="uri_img_sk1-input" type="file" class="file" accept="image/*" name="uri_img_sk1-input">
				                    <br>
									<img id="uri_img_sk1" alt="gallery" src="/uploads/perubahan/{{$uri_img_sk1}}" {!! $uri_img_sk1==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_sk1-file" name="uri_img_sk1-file" value="{{$uri_img_sk1}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_sk1==null ? 'style="display:none"':'' !!} onclick="test('uri_img_sk1')">delete</button>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Image 2</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_sk2-input" type="file" class="file" accept="image/*" name="uri_img_sk2-input">
				                    <br>
									<img id="uri_img_sk2" alt="gallery" src="/uploads/perubahan/{{$uri_img_sk2}}" {!! $uri_img_sk2==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_sk2-file" name="uri_img_sk2-file" value="{{$uri_img_sk2}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_sk2==null ? 'style="display:none"':'' !!} onclick="test('uri_img_sk2')">Delete</button>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Image 3</label>
				                <div class="col-sm-6">
				                    <input id="uri_img_sk3-input" type="file" class="file" accept="image/*" name="uri_img_sk3-input">
				                    <br>
									<img id="uri_img_sk3" alt="gallery" src="/uploads/perubahan/{{$uri_img_sk3}}" {!! $uri_img_sk3==null ? 'style="display:none"':'style="width:150px"' !!} >
									<input type="hidden" id="uri_img_sk3-file" name="uri_img_sk3-file" value="{{$uri_img_sk3}}">
				                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_sk3==null ? 'style="display:none"':'' !!} onclick="test('uri_img_sk3')">Delete</button>
				                </div>
				            </div>
							<!--<div class="form-group ">
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
							<div class="form-group ">
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
                                    <a href="/hrm/profil/user/perubahan" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
									@if( empty($divalidasi_oleh))
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
			"url": "/hrm/profil/user/perubahan/create",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/profil/user/perubahan";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	var prov = $('#kode_prop_baru-input');
	var kota = $('#kode_kota_baru-input');
	var kel = $('#kode_kel_baru-input');
	prov.change(function(){
		prov_id=prov.val();
		if(prov_id!=undefined){
			kota.empty();
			kel.empty();
			kota.append("<option value>Please Select</option>");
			kel.append("<option value>Please Select</option>");
			$.ajax({
				type: 'get',
				"url": "/main/kel_faskel/select?prov="+prov_id,
				success: function (data) {
					data=JSON.parse(data)
					for (var i=0;i<data.length;i++){
						kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
					}
				}
			});
		}
	});
	kota.change(function(){
		kota_id=kota.val();
		if(kota_id!=undefined){
			kel.empty();
			kel.append("<option value>Please Select</option>");
			$.ajax({
				type: 'get',
				"url": "/main/kel_faskel/select?kota_baru="+kota_id,
				success: function (data) {
					data=JSON.parse(data)
					for (var i=0;i<data.length;i++){
						kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
					}
				}
			});
		}
	});

	$("#uri_img_sk1-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#uri_img_sk2-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#uri_img_sk3-input").fileinput({
        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: " Pick Image",
        browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
		showUpload: false
    });
	$("#kode_role_baru-input").select2({
		theme: "bootstrap"
	});
	$("#kode_kel_baru-input").select2({
		theme: "bootstrap"
	});
	$("#kode_prop_baru-input").select2({
		theme: "bootstrap"
	});
	$("#kode_kota_baru-input").select2({
		theme: "bootstrap"
	});
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
