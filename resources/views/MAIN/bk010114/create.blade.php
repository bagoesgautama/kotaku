@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping FasKel ke Kelurahan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>RMapping FasKel ke Kelurahan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                Master Data
            </li>
            <li class="next">
                Data Cakupan Program
            </li>
            <li class="next">
                Mapping FasKel ke Kelurahan
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
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered signup_validator" >
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kode KMP</label>
                                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kmp_slum_prog-input">
                                        @foreach($kode_kmp_slum_program_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmp_slum_prog) selected="selected" @endif >{{ $list->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input32">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select32" class="form-control select2" name="example-kode_faskel-input" >
                                        @foreach($kode_faskel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_faskel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input36">Propinsi</label>
                                <div class="col-sm-6">
                                    <select id="select36" class="form-control select2" name="example-kode_prop-input" >
										<option value=undefined>Please select</option>
                                        @foreach($kode_prop_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_prop) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input35">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select35" class="form-control select2" name="example-kode_kota-input" >
										<option value=undefined>Please select</option>
										@foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input34">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select34" class="form-control select2" name="example-kode_kec-input" >
										<option value=undefined>Please select</option>
										@foreach($kode_kec_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kec) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input33">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select33" class="form-control select2" name="example-kode_kel-input" >
										<option value=undefined>Please select</option>
										@foreach($kode_kel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">BLM</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-blm" class="form-control" size="1">
                                        <option value="0" @if($blm==1) selected="selected" @endif >B</option>
                                        <option value="1" @if($blm==2) selected="selected" @endif >L</option>
                                        <option value="2" @if($blm==3) selected="selected" @endif >C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Jenis Project</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-jenis_project" class="form-control" size="1">
                                        <option value="1" @if($jenis_project==1) selected="selected" @endif >Project 1</option>
                                        <option value="2" @if($jenis_project==2) selected="selected" @endif >Project 2</option>
                                        <option value="3" @if($jenis_project==3) selected="selected" @endif >Project 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Glossary</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-tahun_glossary-input" class="form-control" placeholder="Tahun Glossary" value="{{ $tahun_glossary }}" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-tahun_project-input" class="form-control" placeholder="Tahun Project" value="{{ $tahun_project }}" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Awal Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-awal_project-input" class="form-control" placeholder="Awal Project" value="{{ $awal_project }}" maxlength="4">
                                </div>
                            </div>

                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi BLM</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-lokasi_blm" class="form-control" size="1">
                                        <option value="1" @if($lokasi_blm==1) selected="selected" @endif >Lokasi BLM 1</option>
                                        <option value="2" @if($lokasi_blm==2) selected="selected" @endif >Lokasi BLM 2</option>
                                        <option value="3" @if($lokasi_blm==3) selected="selected" @endif >Lokasi BLM 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-Lokasi_kumuh" class="form-control" size="1">
                                        <option value="1" @if($Lokasi_Kumuh==1) selected="selected" @endif >Lokasi Kumuh 1</option>
                                        <option value="2" @if($Lokasi_Kumuh==2) selected="selected" @endif >Lokasi Kumuh 2</option>
                                        <option value="3" @if($Lokasi_Kumuh==3) selected="selected" @endif >Lokasi Kumuh 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Flag Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-flag_kumuh" class="form-control" size="1">
                                        <option value="0" @if($flag_kumuh==0) selected="selected" @endif >Peningkatan (Kumuh)</option>
                                        <option value="1" @if($flag_kumuh==1) selected="selected" @endif >Pencegahan (Tidak Kumuh)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Lokasi PPMK</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-flag_lokasi_ppmk" class="form-control" size="1">
                                        <option value="0" @if($flag_lokasi_ppmk==1) selected="selected" @endif >Non PPMK</option>
                                        <option value="1" @if($flag_lokasi_ppmk==2) selected="selected" @endif >PPMK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_time }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_by }}</label>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_time }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_by }}</label>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/kel_faskel" type="button" class="btn btn-effect-ripple btn-danger">
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
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/kel_faskel/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/kel_faskel";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
		var prov = $('#select36');
		var kota = $('#select35');
		var kec = $('#select34');
		var kel = $('#select33');
		var prov_id,kota_id;
		var kode_prop = {!! json_encode($kode_prop) !!};
		var kode_kota = {!! json_encode($kode_kota) !!};
		var kode_kec = {!! json_encode($kode_kec) !!};
		var kode_kel = {!! json_encode($kode_kel) !!};
		/*if(kode_prop!=null){
			kota.empty();
			kota.append("<option value=undefined>Please select</option>");
			$.ajax({
				type: 'get',
				"url": "/main/kel_faskel/select?prov="+kode_prop,
				success: function (data) {
					data=JSON.parse(data)
					for (var i=0;i<data.length;i++){
						if(data[i].kode==kode_kota)
							kota.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
						else
							kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
					}
				}
			});
			kec.empty();
			kec.append("<option value=undefined>Please select</option>");
			$.ajax({
				type: 'get',
				"url": "/main/kel_faskel/select?kota="+kode_kota,
				success: function (data) {
					data=JSON.parse(data)
					for (var i=0;i<data.length;i++){
						if(data[i].kode==kode_kec)
							kec.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
						else
							kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
					}
				}
			});
			kel.empty();
			kel.append("<option value=undefined>Please select</option>");
			$.ajax({
				type: 'get',
				"url": "/main/kel_faskel/select?kec="+kode_kec,
				success: function (data) {
					data=JSON.parse(data)
					for (var i=0;i<data.length;i++){
						if(data[i].kode==kode_kel)
							kel.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
						else
							kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
					}
				}
			});
		}*/

		prov.change(function(){
			prov_id=prov.val();
			if(prov_id!=undefined){
				kota.empty();
				kota.append("<option value=undefined>Please select</option>");
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
				kec.empty();
				kec.append("<option value=undefined>Please select</option>");
				$.ajax({
					type: 'get',
					"url": "/main/kel_faskel/select?kota="+kota_id,
					success: function (data) {
						data=JSON.parse(data)
						for (var i=0;i<data.length;i++){
							kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
						}
					}
				});
			}
		});
		kec.change(function(){
			kec_id=kec.val();
			if(kec_id!=undefined){
				kel.empty();
				kel.append("<option value=undefined>Please select</option>");
				$.ajax({
					type: 'get',
					"url": "/main/kel_faskel/select?kec="+kec_id,
					success: function (data) {
						data=JSON.parse(data)
						for (var i=0;i<data.length;i++){
							kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
						}
					}
				});
			}
		});
      });
</script>
@stop
