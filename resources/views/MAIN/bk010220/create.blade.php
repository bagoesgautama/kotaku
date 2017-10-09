@extends('MAIN/default') {{-- Page title --}} @section('title') Persiapan Kelurahan - Forum Kolaborasi - Keanggotaan @stop {{-- local styles --}}
@section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}}
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Persiapan Kelurahan - Forum Kolaborasi - Keanggotaan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> PERSIAPAN KELURAHAN
                </a>
            </li>
            <li class="next">
                Forum Kolaborasi - Keanggotaan
            </li>
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                                    <input type="text" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input">
                                        @foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama KorKot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input">
                                        @foreach($kode_korkot_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_korkot) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input">
                                        @foreach($kode_kec_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kec) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input2">KMW</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kmw-input" class="form-control select2" name="select-kode_kmw-input">
                                        @foreach($kode_kmw_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input">
                                        @foreach($kode_kel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_faskel-input" class="form-control select2" name="select-kode_faskel-input">
                                        @foreach($kode_faskel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_faskel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Jenis Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-jenis_kegiatan-input" name="select-jenis_kegiatan-input" class="form-control" size="1">
                                        <option value="0" @if($jenis_kegiatan==0) selected="selected" @endif >Kegiatan 1</option>
                                        <option value="1" @if($jenis_kegiatan==1) selected="selected" @endif >Kegiatan 2</option>
                                        <option value="2" @if($jenis_kegiatan==2) selected="selected" @endif >Kegiatan 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl_kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Anggota Pria</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_p-input" name="q_anggota_p-input" class="form-control" placeholder="Anggota Pria" value="{{$q_anggota_p}}" maxlength="5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Anggota Wanita</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_w-input" name="q_anggota_w-input" class="form-control" placeholder="Anggota Wanita" value="{{$q_anggota_w}}" maxlength="5">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Anggota Pemerintah Desa</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_pem_desa-input" name="q_anggota_pem_desa-input" class="form-control" placeholder="Anggota Desa" value="{{$q_anggota_pem_desa}}" maxlength="5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Anggota Pemerintah BPD</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_pem_bpd-input" name="q_anggota_pem_bpd-input" class="form-control" placeholder="Anggota BPD" value="{{$q_anggota_pem_bpd}}" maxlength="5">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Anggota Non Pemerintah</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_non_pem-input" name="q_anggota_non_pem-input" class="form-control" placeholder="Anggota Non Pemerintah" value="{{$q_anggota_non_pem}}" maxlength="5">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="diser-oleh-input" name="diser_oleh-input" class="form-control" placeholder="Diserahkan Oleh" value="{{$diser_oleh}}" value="{{$diket_tgl}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="diket-oleh-input" name="diket_oleh-input" class="form-control" placeholder="Diketahui Oleh" value="{{$diket_oleh}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="diver-oleh-input" name="diver_oleh-input" class="form-control" placeholder="Diverifikasi Oleh" value="{{$diver_oleh}}">
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
                            <div class="form-group  striped-col">
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
                                    <a href="/main/persiapan/kelurahan/forum/keanggotaan" type="button" class="btn btn-effect-ripple btn-danger">
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

@stop {{-- local scripts --}} @section('footer_scripts')
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
			e.preventDefault();
			var file_dokumen = document.getElementById('file-dokumen-input').files[0];
            var file_absensi = document.getElementById('file-absensi-input').files[0];
            var file_dok_rencana_kerja = document.getElementById('file-dok_rencana_kerja-input').files[0];
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-dok_rencana_kerja-input', file_dok_rencana_kerja);
            form_data.append('file-dokumen-input', file_dokumen);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('uploaded-file-dok_rencana_kerja', $('#uploaded-file-dok_rencana_kerja').val());
            form_data.append('uploaded-file-dokumen', $('#uploaded-file-dokumen').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('tahun-input', $('#tahun-input').val());
            form_data.append('select-kode_kota-input', $('#select-kode_kota-input').val());
            form_data.append('select-kode_korkot-input', $('#select-kode_korkot-input').val());
            form_data.append('select-kode_kec-input', $('#select-kode_kec-input').val());
            form_data.append('select-kode_kmw-input', $('#select-kode_kmw-input').val());
            form_data.append('select-kode_kel-input', $('#select-kode_kel-input').val());
            form_data.append('select-kode_faskel-input', $('#select-kode_faskel-input').val());
            form_data.append('select-jenis_kegiatan-input', $('#select-jenis_kegiatan-input').val());
            form_data.append('tgl_kegiatan-input', $('#tgl_kegiatan-input').val());
            form_data.append('lok_kegiatan-input', $('#lok_kegiatan-input').val());
            form_data.append('q_anggota_p-input', $('#q_anggota_p-input').val());
            form_data.append('q_anggota_w-input', $('#q_anggota_w-input').val());
            form_data.append('q_anggota_pem_desa-input', $('#q_anggota_pem_desa-input').val());
            form_data.append('q_anggota_pem_bpd-input', $('#q_anggota_pem_bpd-input').val());
            form_data.append('q_anggota_non_pem-input', $('#q_anggota_non_pem-input').val());
            form_data.append('nilai_dana_ops-input', $('#nilai_dana_ops-input').val());
            form_data.append('tgl-diser-input', $('#diver-oleh-input').val());
            form_data.append('diser_oleh-input', $('#diser_oleh-input').val());
            form_data.append('tgl_diket-input', $('#tgl_diket-input').val());
            form_data.append('diket_oleh-input', $('#diket_oleh-input').val());
            form_data.append('tgl_diver-input', $('#tgl_diver-input').val());
            form_data.append('diver_oleh-input', $('#diver_oleh-input').val());
			console.log('aaaaa')
			/*$.ajax({
	            type: 'post',
				processData: false,
	            contentType: false,
	            "url": "/main/persiapan/kelurahan/forum/keanggotaan/create",
	            data: form_data,
	            beforeSend: function (){
	                $("#submit").prop('disabled', true);
	            },
	            success: function () {
	            	alert('From Submitted.');
	            	window.location.href = "/main/persiapan/kelurahan/forum/keanggotaan";
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	            	alert(xhr.status);
	            	alert(thrownError);
	            	$("#submit").prop('disabled', false);
	            }
			});*/
        });
        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
      });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
@stop
