@extends('MAIN/default') {{-- Page title --}} @section('title') Relawan Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kelurahan/relawan">
                    Persiapan / Kelurahan / Kegiatan Kelurahan / Relawan
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
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kota</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1">
                                        @foreach ($kode_kota_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1">
                                        @foreach ($kode_kec_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kel-input" name="kode-kel-input" class="form-control select2" size="1">
                                        @foreach ($kode_kel_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">KMW</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1">
                                        @foreach ($kode_kmw_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kmw==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Korkot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1">
                                        @foreach ($kode_korkot_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1">
                                        @foreach ($kode_faskel_list as $kfl)
                                            <option value="{{$kfl->kode}}" {!! $kode_faskel==$kfl->kode ? 'selected':'' !!}>{{$kfl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jenis kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control" size="1">
                                        <option value="2.5.1" {!! $jenis_kegiatan=='2.5.1' ? 'selected':'' !!}>Sosialisasi</option>
                                        <option value="2.5.1.4" {!! $jenis_kegiatan=='2.5.1.4' ? 'selected':'' !!}>Relawan</option>
                                        <option value="2.5.1.5" {!! $jenis_kegiatan=='2.5.1.5' ? 'selected':'' !!}>Agen Sosialisasi</option>
                                        <option value="2.5.3" {!! $jenis_kegiatan=='2.5.3' ? 'selected':'' !!}>Pelatihan Masyarakat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_p}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_w}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Miskin/MBR</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-mbr-input" name="q-mbr-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_mbr}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Bahan Sosialisasi</label>
                                <div class="col-sm-6">
                                    <select id="bhn-sosialisasi-input" name="bhn-sosialisasi-input" class="form-control" size="1">
                                        @foreach ($kode_bhn_sos_list as $kbsl)
                                            <option value="{{$kbsl->id}}" {!! $id_bhn_sosialisasi==$kbsl->id ? 'selected':'' !!}>{{$kbsl->kode_bhn_sosialisasi}}</option>
                                        @endforeach
                                    </select>
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
                                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser-oleh-input" name="diser-oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diket-oleh-input" name="diket-oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diver-oleh-input" name="diver-oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/relawan" type="button" class="btn btn-effect-ripple btn-danger">
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
        $('#submit').on('click', function (e) {
            var file_dokumen = document.getElementById('file-dokumen-input').files[0];
            var file_absensi = document.getElementById('file-absensi-input').files[0];
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-dokumen-input', file_dokumen);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('uploaded-file-dokumen', $('#uploaded-file-dokumen').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('kode-kota-input', $('#select-kode-kota-input').val());
            form_data.append('kode-kec-input', $('#select-kode-kec-input').val());
            form_data.append('kode-kel-input', $('#select-kode-kel-input').val());
            form_data.append('kode-kmw-input', $('#select-kode-kmw-input').val());
            form_data.append('kode-korkot-input', $('#select-kode-korkot-input').val());
            form_data.append('kode-faskel-input', $('#select-kode-faskel-input').val());
            form_data.append('jns-kegiatan-input', $('#jns-kegiatan-input').val());
            form_data.append('tgl-kegiatan-input', $('#tgl-kegiatan-input').val());
            form_data.append('lok-kegiatan-input', $('#lok-kegiatan-input').val());
            form_data.append('q-laki-input', $('#q-laki-input').val());
            form_data.append('q-perempuan-input', $('#q-perempuan-input').val());
            form_data.append('q-mbr-input', $('#q-mbr-input').val());
            form_data.append('bhn-sosialisasi-input', $('#bhn-sosialisasi-input').val());
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
            "url": "/main/persiapan/kelurahan/relawan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/kelurahan/relawan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-kel-input").select2({
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
