@extends('MAIN/default') {{-- Page title --}} @section('title') Pembentukan POKJA Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
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
                <a href="/main/persiapan/nasional/pokja/pembentukan">
                    Persiapan / Nasional / Pokja / Pembentukan
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
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                <div class="col-sm-6">
                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="number" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}" maxlength="4" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Jenis Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control" size="1">
                                        <option value="2.1" {!! $jenis_kegiatan=='2.1' ? 'selected':'' !!}>Tingkat Nasional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Status Pokja</label>
                                <div class="col-sm-6">
                                    <select id="status-pokja-input" name="status-pokja-input" class="form-control" size="1" required>
                                        <option value="0" {!! $status_pokja==0 ? 'selected':'' !!}>Lama</option>
                                        <option value="1" {!! $status_pokja==1 ? 'selected':'' !!}>Baru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Dasar Pembentukan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="dsr-pembentukan-input" name="dsr-pembentukan-input" class="form-control" value="{{$ds_hkm}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_p}}" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_w}}" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPP Kementrian/KL</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-kementrian-input" name="upp-kementrian-input" class="form-control" placeholder="" value="{{$upp_kl}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPP Dinas/Badan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-dinas-input" name="upp-dinas-input" class="form-control" placeholder="" value="{{$upp_dinas}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPP DPR/DPD Pusat/DPRD</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-dpr-input" name="upp-dpr-input" class="form-control" placeholder="" value="{{$upp_dpr}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPNP LSM/Pemerhati Permukiman</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-lsm-input" name="upnp-lsm-input" class="form-control" placeholder="" value="{{$upn_lsm}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPNP Swasta/Badan Usaha</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-swasta-input" name="upnp-swasta-input" class="form-control" placeholder="" value="{{$unp_bu}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">UPNP Praktisi/Profesional/Perguruan Tinggi</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-praktisi-input" name="upnp-praktisi-input" class="form-control" placeholder="" value="{{$upn_praktisi}}" maxlength="11">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Nilai Dana Operasional</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dana-ops-input" name="dana-ops-input" class="form-control" placeholder="Jumlah" value="{{$nilai_dana_ops}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Rencana Kerja</label>
                                <div class="col-sm-6">
                                    <input id="rencana-kerja-input" type="file" class="file" data-show-preview="false" name="rencana-kerja-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-rnckerja" value="{{$url_rencana_kerja}}" {!! $url_rencana_kerja==null ? 'style="display:none"':'' !!}>{{$url_rencana_kerja}}</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Keterangan Rencana Kerja</label>
                                <div class="col-sm-6">
                                    <input type="text" id="ket-rencana-kerja-input" name="ket-rencana-kerja-input" class="form-control" placeholder="Ket. Rencana Kerja" value="{{$ket_rencana_kerja}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Dokumen</label>
                                <div class="col-sm-6">
                                    <input id="file-dokumen-input" type="file" class="file" data-show-preview="false" name="file-dokumen-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-dokumen" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}" required>
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser-oleh-input" name="diser-oleh-input" class="form-control" size="1" required>
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}" required>
                                </div>
                                <div class="col-sm-3">
                                    <select id="diket-oleh-input" name="diket-oleh-input" class="form-control" size="1" required>
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}" required>
                                </div>
                                <div class="col-sm-3">
                                    <select id="diver-oleh-input" name="diver-oleh-input" class="form-control" size="1" required>
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/nasional/pokja/pembentukan" type="button" class="btn btn-effect-ripple btn-danger">
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
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
            var file_dokumen = document.getElementById('file-dokumen-input').files[0];
            var file_absensi = document.getElementById('file-absensi-input').files[0];
            var file_rnckerja = document.getElementById('rencana-kerja-input').files[0];
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-dokumen-input', file_dokumen);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('rencana-kerja-input', file_rnckerja);
            form_data.append('uploaded-file-dokumen', $('#uploaded-file-dokumen').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('uploaded-file-rnckerja', $('#uploaded-file-rnckerja').val());
            form_data.append('tahun-input', $('#tahun-input').val());
            // form_data.append('kode-prop-input', $('#kode-prop-input').val());
            // form_data.append('kode-kmw-input', $('#select-kode-kmw-input').val());
            // form_data.append('kode-faskel-input', $('#select-kode-faskel-input').val());
            form_data.append('jns-kegiatan-input', $('#jns-kegiatan-input').val());
            form_data.append('tgl-kegiatan-input', $('#tgl-kegiatan-input').val());
            form_data.append('status-pokja-input', $('#status-pokja-input').val());
            form_data.append('dsr-pembentukan-input', $('#dsr-pembentukan-input').val());
            form_data.append('q-laki-input', $('#q-laki-input').val());
            form_data.append('q-perempuan-input', $('#q-perempuan-input').val());
            form_data.append('upp-kementrian-input', $('#upp-kementrian-input').val());
            form_data.append('upp-dinas-input', $('#upp-dinas-input').val());
            form_data.append('upp-dpr-input', $('#upp-dpr-input').val());
            form_data.append('upnp-lsm-input', $('#upnp-lsm-input').val());
            form_data.append('upnp-swasta-input', $('#upnp-swasta-input').val());
            form_data.append('upnp-praktisi-input', $('#upnp-praktisi-input').val());
            form_data.append('dana-ops-input', $('#dana-ops-input').val());
            form_data.append('ket-rencana-kerja-input', $('#ket-rencana-kerja-input').val());
            form_data.append('tgl-diser-input', $('#tgl-diser-input').val());
            form_data.append('diser-oleh-input', $('#diser-oleh-input').val());
            form_data.append('tgl-diket-input', $('#tgl-diket-input').val());
            form_data.append('diket-oleh-input', $('#diket-oleh-input').val());
            form_data.append('tgl-diver-input', $('#tgl-diver-input').val());
            form_data.append('diver-oleh-input', $('#diver-oleh-input').val());
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/persiapan/nasional/pokja/pembentukan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/persiapan/nasional/pokja/pembentukan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-faskel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        
      });
</script>
@stop