@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Pengadaan / Proses Lelang @stop {{-- local styles --}}
@section('header_styles')
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
<link href="{{asset('vendors/pnotify/css/pnotify.buttons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/pnotify/css/pnotify.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">
@stop {{-- Page Header--}}
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Pengadaan / Proses Lelang</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/pengadaan_lelang">
                    Perencanaan / Pengadaan/Proses Lelang
                </a>
            </li>
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading tab-list">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                                        Pilih Paket Kerja
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Paket Kerja
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                         Input Data Kontrak
                                    </a>
                    </li>
                    <!-- <li>
                        <a href="#tab4" data-toggle="tab">
                                        Tambahan Data
                                    </a>
                    </li> -->
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pilih Paket Kerja</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                                <select id="select-kode_pkt_krj-input" name="select-kode_pkt_krj-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($kode_pkt_krj_list as $kpkl)
                                                        <option value="{{$kpkl->kode}}" {!! $kode_pkt_krj==$kpkl->kode ? 'selected':'' !!}>{{$kpkl->jenis_komponen_keg.'-'.$kpkl->nama_subkomponen.'-'.$kpkl->nama_dtl_subkomponen}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Umum</label>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Skala Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="skala_kegiatan-input" name="skala_kegiatan-input" placeholder="skala_kegiatan" value="{{$skala_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" maxlength="4" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">KMW</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kmw-input" name="select-kode_kmw-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kmw}}" {!! $kode_kmw==$dkl->kode_kmw ? 'selected':'' !!}>{{$dkl->nama_kmw}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Kota</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kota-input" name="select-kode_kota-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kota}}" {!! $kode_kota==$dkl->kode_kota ? 'selected':'' !!}>{{$dkl->nama_kota}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Korkot</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_korkot-input" name="select-kode_korkot-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_korkot}}" {!! $kode_korkot==$dkl->kode_korkot ? 'selected':'' !!}>{{$dkl->nama_korkot}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Kecamatan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kec-input" name="select-kode_kec-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kec}}" {!! $kode_kec==$dkl->kode_kec ? 'selected':'' !!}>{{$dkl->nama_kec}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Kelurahan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kel-input" name="select-kode_kel-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kel}}" {!! $kode_kel==$dkl->kode_kel ? 'selected':'' !!}>{{$dkl->nama_kel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Faskel</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_faskel-input" name="select-kode_faskel-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_faskel}}" {!! $kode_faskel==$dkl->kode_faskel ? 'selected':'' !!}>{{$dkl->nama_faskel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Komponen Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="jenis_komponen_keg-input" name="jenis_komponen_keg-input" placeholder="Subkomponen" value="{{$jenis_komponen_keg}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Subkomponen</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="id_subkomponen-input" name="id_subkomponen-input" placeholder="Subkomponen" value="{{$id_subkomponen}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Detail Subkomponen</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="id_dtl_subkomponen-input" name="id_dtl_subkomponen-input" placeholder=" Detail Subkomponen" value="{{$id_dtl_subkomponen}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Volume Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_vol_kegiatan-input" name="dk_vol_kegiatan-input" placeholder="Lokasi Kegiatan" value="{{$dk_vol_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Satuan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_satuan-input" name="dk_satuan-input" placeholder=" Tipe Penanganan" value="{{$dk_satuan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Tipe Penanganan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_tipe_penanganan-input" name="dk_tipe_penanganan-input" placeholder=" Tipe Penanganan" value="{{$dk_tipe_penanganan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Nilai Biaya</label></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBN NSUP (Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbn_nsup-input" name="nb_apbn_nsup-input" class="form-control" value="{{$nb_apbn_nsup}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBN LAIN (Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbn_lain-input" name="nb_apbn_lain-input" class="form-control" value="{{$nb_apbn_lain}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBD Provinsi(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbd_prop-input" name="nb_apbd_prop-input" class="form-control" value="{{$nb_apbd_prop}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBD Kab/Kota/BUMD(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbd_kota-input" name="nb_apbd_kota-input" class="form-control" value="{{$nb_apbd_kota}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Lainnya(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_lainnya-input" name="nb_lainnya-input" class="form-control" value="{{$nb_lainnya}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">No Kontrak</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="nomor_kontrak-input" name="nomor_kontrak-input" class="form-control" placeholder="Nomor Kontrak" value="{{$nomor_kontrak}}" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama Paket</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="nama_paket-input" name="nama_paket-input" class="form-control" placeholder="Nama Paket" value="{{$nama_paket}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Mulai Lelang</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="tgl_lelang_mulai-input" name="tgl_lelang_mulai-input" placeholder="Tanggal Mulai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_mulai}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Lelang Selesai</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="tgl_lelang_selesai-input" name="tgl_lelang_selesai-input" placeholder="Tanggal Selesai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_selesai}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">APBN NSUP (PHLN)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbn_nsup-input" name="sd_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_nsup}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">APBN Lainya (PHLN/RM)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbn_lain-input" name="sd_apbn_lain-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_lain}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">APBD PROP</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbd_prop-input" name="sd_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_prop}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">APBD KAB/KOTA</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbd_kota-input" name="sd_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_kota}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Swasta/Lainya</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_swasta-input" name="sd_swasta-input" class="form-control" placeholder="Rp" value="{{$sd_swasta}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-textarea-input2">Keterangan</label>
                                            <div class="col-sm-6">
                                                <textarea id="keterangan-input" name="keterangan-input" rows="7" class="form-control resize_vertical" placeholder="Keterangan" maxlength="300">{{ $keterangan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">File Document</label>
                                            <div class="col-sm-6">
                                                <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input">
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">File Absensi</label>
                                            <div class="col-sm-6">
                                                <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="tab4" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
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
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group form-actions">
                            <div class="col-sm-9 col-sm-offset-3">
                                <a href="/main/perencanaan/pengadaan_lelang" type="button" class="btn btn-effect-ripple btn-danger">
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
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>Daftar Peserta Lelang</b>
                </div>
                @if( ! empty($detil['302']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/pengadaan_lelang/peserta/create?kode_lelang='.$kode}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="peserta">
                        <thead>
                            <tr>
                                <th>Kode Lelang</th>
                                <th>No Urut</th>
                                <th>Kode Kontraktor</th>
                                <th>Flag Pemenang</th>
                                <th>Created Time</th>
                                <th>Created By</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')

<script>
      $(document).ready(function () {
	  	$("#file-dokumen-input").fileinput({
  	  		showUpload: false
  	  	});
  	  	$("#file-absensi-input").fileinput({
  	  		showUpload: false
  	  	});
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/perencanaan/pengadaan_lelang/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/perencanaan/pengadaan_lelang";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-skala_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-kode_pkt_krj-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            console.log(e)
            alert('Field input '+e.target.id+' belum diisi.');
          };
        })(), true);

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var paket = $('#select-kode_pkt_krj-input');
        var kmw = $('#select-kode_kmw-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kec = $('#select-kode_kec-input');
        var kel = $('#select-kode_kel-input');
        var faskel = $('#select-kode_faskel-input');
        var skala = $('#skala_kegiatan-input');
        var tahun = $('#tahun-input');
        var komponen = $('#jenis_komponen_keg-input');
        var subkomponen = $('#id_subkomponen-input');
        var dtl_subkomponen = $('#id_dtl_subkomponen-input');
        var vol = $('#dk_vol_kegiatan-input');
        var satuan = $('#dk_satuan-input');
        var lok = $('#lok_kegiatan-input');
        var penanganan = $('#dk_tipe_penanganan-input');
        var nsup = $('#nb_apbn_nsup-input');
        var lain = $('#nb_apbn_lain-input');
        var apbd_prop = $('#nb_apbd_prop-input');
        var apbd_kota = $('#nb_apbd_kota-input');
        var lainnya = $('#nb_lainnya-input');
        var paket_id;

        paket.change(function(){
            paket_id=paket.val();
            if(paket_id!=null){
                tahun.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/pengadaan_lelang/select?data_kegiatan="+paket_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kmw.append("<option value="+data[i].kode_kmw+" selected>"+data[i].nama_kmw+"</option>");
                            kota.append("<option value="+data[i].kode_kota+" selected>"+data[i].nama_kota+"</option>");
                            korkot.append("<option value="+data[i].kode_korkot+" selected>"+data[i].nama_korkot+"</option>");
                            kec.append("<option value="+data[i].kode_kec+" selected>"+data[i].nama_kec+"</option>");
                            kel.append("<option value="+data[i].kode_kel+" selected>"+data[i].nama_kel+"</option>");
                            faskel.append("<option value="+data[i].kode_faskel+" selected>"+data[i].nama_faskel+"</option>");
                            tahun.val(data[0].tahun);
                            skala.val(data[0].skala);
                            komponen.val(data[0].nama_komponen);
                            subkomponen.val(data[0].nama_subkomponen);
                            dtl_subkomponen.val(data[0].nama_dtl_subkomponen);
                            vol.val(data[0].dk_vol_kegiatan);
                            satuan.val(data[0].dk_satuan);
                            lok.val(data[0].lok_kegiatan);
                            penanganan.val(data[0].nama_penanganan);
                            nsup.val(data[0].nb_apbn_nsup);
                            lain.val(data[0].nb_apbn_lain);
                            apbd_prop.val(data[0].nb_apbd_prop);
                            apbd_kota.val(data[0].nb_apbd_kota);
                            lainnya.val(data[0].nb_lainnya);
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        var table = $('#peserta').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/perencanaan/pengadaan_lelang/peserta",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode_lelang" , name:"kode_lelang"},
                { "data": "no_urut" , name:"no_urut"},
                { "data": "kode_kontraktor" , name:"kode_kontraktor"},
                { "data": "flag_pemenang" , name:"flag_pemenang"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "option" , name:"option",orderable:false}
            ]
        });
        $('#pokja_filter input').unbind();
        $('#pokja_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            table.search(this.value).draw();
        }
    })
});
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>

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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
