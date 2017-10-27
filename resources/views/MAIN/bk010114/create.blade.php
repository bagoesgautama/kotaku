@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping FasKel ke Kelurahan @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Mapping FasKel ke Kelurahan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
				<a href="/main/kel_faskel">
	                Master Data / Data Cakupan Program / Mapping FasKel ke Kelurahan
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
                        <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered ">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kode KMP</label>
                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                <div class="col-sm-6">
                                    <select id="select-kode_kmp_slum_prog-input" class="form-control select2" name="select-kode_kmp_slum_prog-input">
                                        <option>Please Select</option>
                                        @foreach($kode_kmp_slum_program_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmp_slum_prog) selected="selected" @endif >{{ $list->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input36">Propinsi</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_prop-input" class="form-control select2" name="select-kode_prop-input" required>
										<option>Please Select</option>
                                        @foreach($kode_prop_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_prop) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input35">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input" required>
										<option>Please select</option>
										@foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input34">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input" required>
										<option>Please select</option>
										@foreach($kode_kec_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kec) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input33">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input" required>
										<option>Please select</option>
										@foreach($kode_kel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input32">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_faskel-input" class="form-control select2" name="select-kode_faskel-input" >
                                        <option>Please select</option>
                                        @foreach($kode_faskel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_faskel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">BLM</label>
                                <div class="col-sm-6">
                                    <select id="select-blm-input" name="select-blm-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="0" @if($blm==1) selected="selected" @endif >B</option>
                                        <option value="1" @if($blm==2) selected="selected" @endif >L</option>
                                        <option value="2" @if($blm==3) selected="selected" @endif >C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Jenis Project</label>
                                <div class="col-sm-6">
                                    <select id="select-jenis_project-input" name="select-jenis_project-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="1" @if($jenis_project==1) selected="selected" @endif >Project 1</option>
                                        <option value="2" @if($jenis_project==2) selected="selected" @endif >Project 2</option>
                                        <option value="3" @if($jenis_project==3) selected="selected" @endif >Project 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Glossary</label>
                                <div class="col-sm-6">
                                    <input type="text" id="etahun_glossary-input" name="tahun_glossary-input" class="form-control" placeholder="Tahun Glossary" value="{{ $tahun_glossary }}" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="tahun_project-input" name="tahun_project-input" class="form-control" placeholder="Tahun Project" value="{{ $tahun_project }}" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Awal Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="awal_project-input" name="awal_project-input" class="form-control" placeholder="Awal Project" value="{{ $awal_project }}" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi BLM</label>
                                <div class="col-sm-6">
                                    <select id="select-lokasi_blm-input" name="select-lokasi_blm-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="1" @if($lokasi_blm==1) selected="selected" @endif >Lokasi BLM 1</option>
                                        <option value="2" @if($lokasi_blm==2) selected="selected" @endif >Lokasi BLM 2</option>
                                        <option value="3" @if($lokasi_blm==3) selected="selected" @endif >Lokasi BLM 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="select-Lokasi_kumuh-input" name="select-Lokasi_kumuh-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="1" @if($Lokasi_Kumuh==1) selected="selected" @endif >Lokasi Kumuh 1</option>
                                        <option value="2" @if($Lokasi_Kumuh==2) selected="selected" @endif >Lokasi Kumuh 2</option>
                                        <option value="3" @if($Lokasi_Kumuh==3) selected="selected" @endif >Lokasi Kumuh 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Flag Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="select-flag_kumuh-input" name="select-flag_kumuh-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="0" @if($flag_kumuh==0) selected="selected" @endif >Peningkatan (Kumuh)</option>
                                        <option value="1" @if($flag_kumuh==1) selected="selected" @endif >Pencegahan (Tidak Kumuh)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Lokasi PPMK</label>
                                <div class="col-sm-6">
                                    <select id="select-flag_lokasi_ppmk-input" name="select-flag_lokasi_ppmk-input" class="form-control" size="1">
                                        <option>Please select</option>
                                        <option value="0" @if($flag_lokasi_ppmk==1) selected="selected" @endif >Non PPMK</option>
                                        <option value="1" @if($flag_lokasi_ppmk==2) selected="selected" @endif >PPMK</option>
                                    </select>
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
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
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

		var prov = $('#select-kode_prop-input');
		var kota = $('#select-kode_kota-input');
		var kec = $('#select-kode_kec-input');
		var kel = $('#select-kode_kel-input');
        var faskel = $('#select-kode_faskel-input')
		var prov_id,kota_id,kec_id,kel_id,faskel_id;

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

        kel.change(function(){
            kel_id=kel.val();
            if(kel_id!=undefined){
                faskel.empty();
                faskel.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/kel_faskel/select?kel="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        $("#select-kode_kmp_slum_prog-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_prop-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-blm-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-jenis_project-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-lokasi_blm-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-Lokasi_kumuh-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-flag_kumuh-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });

        $("#select-flag_lokasi_ppmk-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width:"100%"
        });
    });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>

<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
@stop
