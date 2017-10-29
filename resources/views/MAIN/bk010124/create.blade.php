@extends('MAIN/default') {{-- Page title --}} @section('title') Badan Keswadayaan Mandiri (BKM) Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Badan Keswadayaan Mandiri (BKM)</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
			<li class="next">
				<a href="/main/data_master/bkm">
	                Master Data / Data Master / Badan Keswadayaan Mandiri (BKM)
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
<script>
</script>
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Kode BKM</label>
				                <div class="col-sm-6">
				                    <input type="hidden" id="id" name="id" value="{{$id}}">
				                    <input type="text" id="kode_bkm-input" name="kode_bkm-input" class="form-control" placeholder="Kode " value="{{$kode_bkm}}" >
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Nama</label>
				                <div class="col-sm-6">
				                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="nama" value="{{$nama}}" required>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">alamat</label>
				                <div class="col-sm-6">
				                    <textarea id="alamat-input" name="alamat-input" class="form-control" placeholder="" >{{$alamat}}</textarea>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Provinsi</label>
				                <div class="col-sm-6">
									<input type="hidden" id="id" name="id" value="{{$id}}">
				                    <select id="kode_prop-input" name="kode_prop-input" class="form-control" size="1" required>
										<option value>Please select</option>
				                        @foreach ($kode_prop_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_prop==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group ">
				                <label class="col-sm-3 control-label">Kota</label>
				                <div class="col-sm-6">
				                    <select id="kode_kota-input" name="kode_kota-input" class="form-control" size="1" required>
				                        @foreach ($kode_kota_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
				            <div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Kecamatan</label>
				                <div class="col-sm-6">
				                    <select id="kode_kec-input" name="kode_kec-input" class="form-control" size="1" required>
				                        @foreach ($kode_kec_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Kelurahan</label>
				                <div class="col-sm-6">
				                    <select id="kode_kel-input" name="kode_kel-input" class="form-control" size="1" required>
				                        @foreach ($kode_kel_list as $kkl)
				                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
				                        @endforeach
				                    </select>
				                </div>
				            </div>
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">Keterangan</label>
				                <div class="col-sm-6">
				                    <textarea id="keterangan-input" name="keterangan-input" class="form-control" placeholder="" >{{$keterangan}}</textarea>
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Jumlah Anggota</label>
				                <div class="col-sm-6">
				                    <input type="number" id="jml_anggt-input" name="jml_anggt-input" class="form-control" placeholder="nama" value="{{$jml_anggt}}" >
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Jumlah Anggota Wanita</label>
				                <div class="col-sm-6">
				                    <input type="text" id="jml_anggt_w-input" name="jml_anggt_w-input" class="form-control" placeholder="nama" value="{{$jml_anggt_w}}" >
				                </div>
				            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Status</label>
				                <div class="col-sm-6">
				                    <select id="status-input" name="status-input" class="form-control" size="1">
				                        <option value="0" {!! $status==0 ? 'selected':'' !!}>Tidak Aktif</option>
				                        <option value="1" {!! $status==1 ? 'selected':'' !!}>Aktif</option>
				                    </select>
				                </div>
				            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/data_master/bkm" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/data_master/bkm/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/data_master/bkm";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            $("#submit").prop('disabled', false);
            }
          });
        });
		var prov = $('#kode_prop-input');
		var kota = $('#kode_kota-input');
		var kec = $('#kode_kec-input');
		var kel = $('#kode_kel-input');
		prov.change(function(){
			prov_id=prov.val();
			if(prov_id!=undefined){
				kota.empty();
				kec.empty();
				kel.empty();
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
				kel.empty();
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
		$("#kode_prop-input").select2({
            theme: "bootstrap"
        });
		$("#kode_kota-input").select2({
            theme: "bootstrap"
        });
		$("#kode_kec-input").select2({
            theme: "bootstrap"
        });
		$("#kode_kel-input").select2({
            theme: "bootstrap"
        });
      });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
