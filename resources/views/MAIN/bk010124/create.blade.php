@extends('MAIN/default') {{-- Page title --}} @section('title') Badan Keswadayaan Mandiri (BKM) Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading tab-list">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                                        Data BKM
                                    </a>
                    </li>
                    @if($id!=null)
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Anggota
                                    </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                	<form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
										<div class="form-group ">
							                <label class="col-sm-3 control-label">Kode BKM</label>
							                <div class="col-sm-6">
							                    <input type="hidden" id="id" name="id" value="{{$id}}">
							                    <input type="text" id="kode_bkm-input" name="kode_bkm-input" class="form-control" placeholder="Kode " value="{{$kode_bkm}}" maxlength="100">
							                </div>
							            </div>
										<div class="form-group striped-col ">
							                <label class="col-sm-3 control-label">Nama</label>
							                <div class="col-sm-6">
							                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="nama" value="{{$nama}}" required maxlength="100">
							                </div>
							            </div>
							            <div class="form-group striped-col ">
							                <label class="col-sm-3 control-label">Nama Koordinator</label>
							                <div class="col-sm-6">
							                    <input type="text" id="nama_koordinator-input" name="nama_koordinator-input" class="form-control" placeholder="nama" value="{{$nama}}" required maxlength="100">
							                </div>
							            </div>
										<div class="form-group ">
							                <label class="col-sm-3 control-label">Alamat</label>
							                <div class="col-sm-6">
							                    <textarea id="alamat-input" name="alamat-input" class="form-control" placeholder="" maxlength="300">{{$alamat}}</textarea>
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
							                    <textarea id="keterangan-input" name="keterangan-input" class="form-control" placeholder="" maxlength="300">{{$keterangan}}</textarea>
							                </div>
							            </div>
										<div class="form-group ">
							                <label class="col-sm-3 control-label">Tanggal Pembentukan</label>
							                <div class="col-sm-6">
							                    <input class="form-control" id="tgl_pembentukan-input" name="tgl_pembentukan-input" placeholder="Tanggal Pembentukan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_pembentukan}}">
							                </div>
							            </div>
										<div class="form-group ">
							                <label class="col-sm-3 control-label">No. Telp</label>
							                <div class="col-sm-6">
							                    <input type="text" id="no_telp-input" name="no_telp-input" class="form-control" placeholder="nama" value="{{$no_telp}}" maxlength="45">
							                </div>
							            </div>
							            <div class="form-group ">
							                <label class="col-sm-3 control-label">Tanggal Pengesahan Notaris</label>
							                <div class="col-sm-6">
							                    <input class="form-control" id="tgl_pengesahan_notaris-input" name="tgl_pengesahan_notaris-input" placeholder="Tanggal Pengesahan Notaris" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_pengesahan_notaris}}">
							                </div>
							            </div>
							            <div class="form-group ">
							                <label class="col-sm-3 control-label">Nama Notaris</label>
							                <div class="col-sm-6">
							                    <input type="text" id="nama_notaris-input" name="nama_notaris-input" class="form-control" placeholder="Nama Notaris" value="{{$nama_notaris}}" maxlength="100">
							                </div>
							            </div>
							            <div class="form-group ">
							                <label class="col-sm-3 control-label">Nama Bank</label>
							                <div class="col-sm-6">
							                    <input type="text" id="nama_bank-input" name="nama_bank-input" class="form-control" placeholder="Nama Bank" value="{{$nama_bank}}" maxlength="100">
							                </div>
							            </div>
							            <div class="form-group ">
							                <label class="col-sm-3 control-label">No. Rekening Bank</label>
							                <div class="col-sm-6">
							                    <input type="text" id="no_rek_bank-input" name="no_rek_bank-input" class="form-control" placeholder="No. Rekening Bank" value="{{$no_rek_bank}}" maxlength="45">
							                </div>
							            </div>
										<div class="form-group ">
							                <label class="col-sm-3 control-label">Status</label>
							                <div class="col-sm-6">
							                    <select id="status-input" name="status-input" class="form-control" size="1" required>
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
                    <div id="tab2" class="tab-pane fade active">
                        <div class="panel-body border">
                            <div class="row">
                            	<div class="col-lg-12">
							        <div class="panel filterable">
							            <div class="panel-heading clearfix  ">
							                <div class="panel-title pull-left">
							                    <b>Daftar Peserta BKM</b>
							                </div>
							                @if( ! empty($detil['455']) && $detil_menu=='455')
							                <div class="tools pull-right">
							                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/data_master/bkm/anggota/create?kode_bkm='.$id}}">Tambah</a>
							                </div>
							                @endif
							            </div>
							            <div class="panel-body">
							                <div class="table-responsive">
							                    <table class="table table-striped" id="bkm">
							                        <thead>
							                            <tr>
							                                <th>Kode</th>
							                                <th>BKM</th>
							                                <th>Nama Anggota</th>
							                                <th>Jenis Kelamin</th>
							                                <th>Status Sosial</th>
							                                <th>Pendidikan</th>
							                                <th>Pekerjaan</th>
							                                <th>Jumlah Dukungan</th>
							                                <th>Option</th>
							                            </tr>
							                        </thead>
							                    </table>
							                </div>
							            </div>
							        </div>
							    </div>
                            </div>
                        </div>
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
      	var kode_bkm = $('#id').val();
      	var table = $('#bkm').DataTable({
		        // dom: 'Bflrtip',

				"processing": true,
	            "serverSide": true,
	            "ajax":{
	                     "url": "/main/data_master/bkm/anggota",
	                     "dataType": "json",
	                     "data": {kode_bkm : kode_bkm},
	                     "type": "POST"
	                   },
	            "columns": [
					{ "data": "kode" , name:"kode"},
					{ "data": "kode_bkm" , name:"kode_bkm"},
					{ "data": "nama" , name:"nama"},
					{ "data": "jenis_kelamin" , name:"jenis_kelamin"},
					{ "data": "status_sosial" , name:"status_sosial"},
	                { "data": "nama_pendidikan" , name:"nama_pendidikan"},
					{ "data": "nama_pekerjaan" , name:"nama_pekerjaan"},
					{ "data": "jml_dukungan" , name:"jml_dukungan"},
	                { "data": "option" , name:"option",orderable:false}
	            ],
				"order": [[ 0, "desc" ]]
		    });
	        $('#bkm_filter input').unbind();
	        $('#bkm_filter input').bind('keyup', function(e) {
	        if(e.keyCode == 13) {
	            table.search(this.value).draw();
	        }
	    })
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
				kota.append("<option value>Please Select</option>");
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
				kec.append("<option value>Please Select</option>");
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
				kel.append("<option value>Please Select</option>");
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
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript" src="{{asset('vendors/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.colReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.rowReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.print.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.scroller.js')}}"></script>
<script src="{{asset('js/custom_js/alert.js')}}" type="text/javascript"></script>
@stop
