@extends('MAIN/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}}
@section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>MAIN Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
            	<a href="/main">
            		<i class="fa fa-fw fa-home"></i> MAIN
            	</a>
            </li>
            <li class="next">
                <a href="/main/data_wilayah/kelurahan">
                    Master Data Kelurahan
                </a>
            </li>
            <li class="next">
	            Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="panel-body border">
    <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-6">
                    <input type="hidden" id="kode" name="kode" value="{{$kode}}">
                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="Nama" value="{{$nama}}"  required>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-6">
                    <input type="text" id="keterangan-input" name="keterangan-input" class="form-control" placeholder="Keterangan" value="{{$keterangan}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode BPS</label>
                <div class="col-sm-6">
                    <input type="text" id="kode-bps-input" name="kode-bps-input" class="form-control" placeholder="Kode BPS" value="{{$kode_bps}}">
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-3 control-label">Stat Kode BPSS</label>
                <div class="col-sm-6">
                    <input type="text" id="stat-kode-bps" name="stat-kode-bps-input" class="form-control" placeholder="Stat Kode BPS" value="{{$stat_kode_bps}}">
                </div>
            </div>
			<div class="form-group striped-col">
                <label class="col-sm-3 control-label">Provinsi</label>
                <div class="col-sm-6">
                    <select id="kode-prop-input" name="kode-prop-input" class="form-control" size="1">
						<option value=undefined>Please select</option>
                        @foreach ($kode_prop_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_prop==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-3 control-label">Kota</label>
                <div class="col-sm-6">
                    <select id="kode-kota-input" name="kode-kota-input" class="form-control" size="1" required>
                        @foreach ($kode_kota_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kecamatan</label>
                <div class="col-sm-6">
                    <select id="kode-kec-input" name="kode-kec-input" class="form-control" size="1" required>
                        @foreach ($kode_kec_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-3 control-label">File</label>
                <div class="col-sm-6">
                    <input id="file-input" type="file" class="file" data-show-preview="false" name="file-input">
                    <br>
                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file" value="{{$file}}" {!! $file==null ? 'style="display:none"':'' !!}>{{$file}}</button>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                    <select id="status-input" name="status-input" class="form-control" size="1">
                        <option value="0" {!! $status==0 ? 'selected':'' !!}>Tidak Aktif</option>
                        <option value="1" {!! $status==1 ? 'selected':'' !!}>Aktif</option>
                    </select>
                </div>
            </div>
            <div class="form-group ">
                <label class="col-sm-3 control-label">Latitude</label>
                <div class="col-sm-6">
                    <input type="number" id="latitude-input" name="latitude-input" class="form-control" placeholder="Latitude" value="{{$latitude}}" step="0.001">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Longitude</label>
                <div class="col-sm-6">
                    <input type="number" id="longitude-input" name="longitude-input" class="form-control" placeholder="Longitude" value="{{$longitude}}" step="0.001">
                </div>
            </div>
			<div class="form-group ">
                <label class="col-sm-3 control-label">Luas Wilayah</label>
                <div class="col-sm-6">
                    <input type="number" id="luas-input" name="luas-input" class="form-control" value="{{$luas}}" step="0.001">
                </div>
            </div>
			<div class="form-group striped-col">
                <label class="col-sm-3 control-label">Tipologi Kelurahan</label>
                <div class="col-sm-6">
                    <select id="tipologi_kel-input" name="tipologi_kel-input" class="form-control" size="1">
                        <option value="1" {!! $tipologi_kel==1 ? 'selected':'' !!}>Jasa & Perdagangan</option>
						<option value="2" {!! $tipologi_kel==2 ? 'selected':'' !!}>Perkebunan</option>
						<option value="3" {!! $tipologi_kel==3 ? 'selected':'' !!}>Nelayan</option>
                    </select>
                </div>
            </div>
			<div class="form-group ">
                <label class="col-sm-3 control-label">Kategori Kelurahan</label>
                <div class="col-sm-6">
                    <select id="kategori_kel-input" name="kategori_kel-input" class="form-control" size="1">
						<option value="0" {!! $kategori_kel==1 ? 'selected':'' !!}>Kecil</option>
						<option value="1" {!! $kategori_kel==1 ? 'selected':'' !!}>Sedang</option>
						<option value="2" {!! $kategori_kel==2 ? 'selected':'' !!}>Besar</option>
						<option value="3" {!! $kategori_kel==3 ? 'selected':'' !!}>Metro</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/main/data_wilayah/kelurahan" type="button" class="btn btn-effect-ripple btn-danger">
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
        </div>
    </form>
</div>

@stop {{-- local scripts --}} @section('footer_scripts')
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
            var file_data = document.getElementById('file-input').files[0];
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-input', file_data);
            form_data.append('uploaded-file', $('#uploaded-file').val());
            form_data.append('nama-input', $('#nama-input').val());
            form_data.append('keterangan-input', $('#keterangan-input').val());
            form_data.append('kode-bps-input', $('#kode-bps-input').val());
            form_data.append('stat-kode-bps-input', $('#stat-kode-bps').val());
            form_data.append('kode-kec-input', $('#kode-kec-input').val());
            form_data.append('status-input', $('#status-input').val());
            form_data.append('latitude-input', $('#latitude-input').val());
            form_data.append('longitude-input', $('#longitude-input').val());
			form_data.append('luas-input', $('#luas-input').val());
			form_data.append('tipologi_kel-input', $('#tipologi_kel-input').val());
			form_data.append('kategori_kel-input', $('#kategori_kel-input').val());
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/data_wilayah/kelurahan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('Form Submitted.');
            window.location.href = "/main/data_wilayah/kelurahan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
		var prov = $('#kode-prop-input');
		var kota = $('#kode-kota-input');
		var kec = $('#kode-kec-input');
		prov.change(function(){
			prov_id=prov.val();
			if(prov_id!=undefined){
				kota.empty();
				kec.empty();
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

		$("#kode-prop-input").select2({
            theme: "bootstrap"
        });
		$("#kode-kota-input").select2({
            theme: "bootstrap"
        });
		$("#kode-kec-input").select2({
            theme: "bootstrap"
        });
		$("#file-input").fileinput({
	        showUpload: false
	    });
      });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
