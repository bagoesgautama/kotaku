@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Profile Kumuh & Rencana Penanganan 5 Tahun @stop {{-- local styles --}} @section('header_styles')
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
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom_css/wizard.css')}}" rel="stylesheet" type="text/css"/>
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
                <a href="/main/perencanaan/penanganan/profile_rencana_5thn">
                    Perencanaan / Proses Penyusunan Perencanaan Tingkat Kota / RP2KP-KP/SIAP / Profile Kumuh & Rencana Penanganan 5 Tahun
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
                                        Data Form
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Profile Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Rencana Penanganan 5 Tahun (Form Bagian 1)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Rencana Penanganan 5 Tahun (Form Bagian 2)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Rencana Penanganan 5 Tahun (Form Bagian 3)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                        Dokumen
                                    </a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered" data-bv-excluded="disabled">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                        <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required data-bv-callback="true" data-bv-callback-message="Tahun melebihi current year." data-bv-callback-callback="tahun">
                                                <option value>Please select</option>
                                                @foreach($tahun_list as $list)
                                                    <option value="{{ $list->tahun }}" {!! $list->tahun==$tahun?"selected":"" !!}>{{ $list->tahun }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kota</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @if ($kode_kota_list!=null)
                                                @foreach ($kode_kota_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                                @endif
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Hunian (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-hunian" name="pk-val-abs-hunian" class="form-control" value="{{$pk_val_abs_hunian}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-hunian" name="pk-prcn-gap-hunian" class="form-control" value="{{$pk_prcn_gap_hunian}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jalan Lingkungan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-jalan" name="pk-val-abs-jalan" class="form-control" value="{{$pk_val_abs_jalan}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-jalan" name="pk-prcn-gap-jalan" class="form-control" value="{{$pk_prcn_gap_jalan}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Penyedian Air Minum (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-air-minum" name="pk-val-abs-air-minum" class="form-control" value="{{$pk_val_abs_air_minum}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-air-minum" name="pk-prcn-gap-air-minum" class="form-control" value="{{$pk_prcn_gap_air_minum}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Drainase Lingkungan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-drainase" name="pk-val-abs-drainase" class="form-control" value="{{$pk_val_abs_drainase}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-drainase" name="pk-prcn-gap-drainase" class="form-control" value="{{$pk_prcn_gap_drainase}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Air Limbah (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-air-limbah" name="pk-val-abs-air-limbah" class="form-control" value="{{$pk_val_abs_air_limbah}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-air-limbah" name="pk-prcn-gap-air-limbah" class="form-control" value="{{$pk_prcn_gap_air_limbah}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Persampahan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-sampah" name="pk-val-abs-sampah" class="form-control" value="{{$pk_val_abs_sampah}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-sampah" name="pk-prcn-gap-sampah" class="form-control" value="{{$pk_prcn_gap_sampah}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Proteksi Kebakaran (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-kebakaran" name="pk-val-abs-kebakaran" class="form-control" value="{{$pk_val_abs_kebakaran}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-kebakaran" name="pk-prcn-gap-kebakaran" class="form-control" value="{{$pk_prcn_gap_kebakaran}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ruang Terbuka Publik (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-val-abs-rtp" name="pk-val-abs-rtp" class="form-control" value="{{$pk_val_abs_rtp}}" maxlength="9" placeholder="Nilai Absolut" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk-prcn-gap-rtp" name="pk-prcn-gap-rtp" class="form-control" value="{{$pk_prcn_gap_rtp}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ekonomi (*)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pk-prcn-gap-ekonomi" name="pk-prcn-gap-ekonomi" class="form-control" value="{{$pk_prcn_gap_ekonomi}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sosial (*)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pk-prcn-gap-sosial" name="pk-prcn-gap-sosial" class="form-control" value="{{$pk_prcn_gap_sosial}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)" step="0.01">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kawasan Kumuh Yang akan Ditangani</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp5_q_kaw_kmh_manage" name="rp5_q_kaw_kmh_manage" class="form-control" value="{{$rp5_q_kaw_kmh_manage}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kawasan Kumuh yang akan Ditangani (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp5_l_kaw_kmh_manage" name="rp5_l_kaw_kmh_manage" class="form-control" value="{{$rp5_l_kaw_kmh_manage}}" maxlength="9" placeholder="Luas" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kelurahan Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp5_q_kel_kmh" name="rp5_q_kel_kmh" class="form-control" value="{{$rp5_q_kel_kmh}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah RT Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp5_q_rt_kmh" name="rp5_q_rt_kmh" class="form-control" value="{{$rp5_q_rt_kmh}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Kumuh Menurut Tingkat Kekumuhan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh Berat (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_l_kmh_berat" name="tk_l_kmh_berat" class="form-control" value="{{$tk_l_kmh_berat}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh Sedang (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_l_kmh_sedang" name="tk_l_kmh_sedang" class="form-control" value="{{$tk_l_kmh_sedang}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh Ringan (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_l_kmh_ringan" name="tk_l_kmh_ringan" class="form-control" value="{{$tk_l_kmh_ringan}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Kawasan Penanganan Menurut Status Lahan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Masyarakat Menempati Lahan Secara Legal (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="sl_l_masy_legal" name="sl_l_masy_legal" class="form-control" value="{{$sl_l_masy_legal}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lahan Legal, Menempati tanpa Legalitas (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="sl_l_lhn_legal_tmp_ilegal" name="sl_l_lhn_legal_tmp_ilegal" class="form-control" value="{{$sl_l_lhn_legal_tmp_ilegal}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lahan Ilegal (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="sl_l_lhn_ilegal" name="sl_l_lhn_ilegal" class="form-control" value="{{$sl_l_lhn_ilegal}}" maxlength="9" placeholder="Luas"  step="0.01">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Jumlah Kawasan Berdasarkan Tipologi Permukiman Kumuh (Isi hanya pada kategori yang sesuai)</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Di Atas Air</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpk_q_atas_air" name="tpk_q_atas_air" class="form-control" value="{{$tpk_q_atas_air}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Di Tepi Air</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpk_q_tepi_air" name="tpk_q_tepi_air" class="form-control" value="{{$tpk_q_tepi_air}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Dataran Rendah</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpk_q_dataran_rendah" name="tpk_q_dataran_rendah" class="form-control" value="{{$tpk_q_dataran_rendah}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Dataran Tinggi</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpk_q_dataran_tinggi" name="tpk_q_dataran_tinggi" class="form-control" value="{{$tpk_q_dataran_tinggi}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Dataran Rawan Bencana</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpk_q_rawan_bencana" name="tpk_q_rawan_bencana" class="form-control" value="{{$tpk_q_rawan_bencana}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Jumlah Kawasan Menurut Lokasi/Penggunaan Lahan</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kawasan Pusat Kota/Pemerintahan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pl_kaw_pst_kota" name="pl_kaw_pst_kota" class="form-control" value="{{$pl_kaw_pst_kota}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kawasan Komersil (Industri, Perdagangan, Wisata, Perkantoran, dll)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pl_kaw_komersil" name="pl_kaw_komersil" class="form-control" value="{{$pl_kaw_komersil}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kawasan Permukiman Pinggiran Kota</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pl_kaw_pmkm_pinggir_kt" name="pl_kaw_pmkm_pinggir_kt" class="form-control" value="{{$pl_kaw_pmkm_pinggir_kt}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kawasan Semi Perdesaan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pl_kaw_semi_pedesaan" name="pl_kaw_semi_pedesaan" class="form-control" value="{{$pl_kaw_semi_pedesaan}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Konsep/Pola Penanganan yang Direncanakan</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pemugaran</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_kaw_pemugaran" name="kp_q_kaw_pemugaran" class="form-control" value="{{$kp_q_kaw_pemugaran}}" maxlength="6" placeholder="Jumlah Kawasan">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_l_kaw_pemugaran" name="kp_l_kaw_pemugaran" class="form-control" value="{{$kp_l_kaw_pemugaran}}" maxlength="6" placeholder="Luas Kawasan" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1"></label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_pdk_pemugaran" name="kp_q_jml_pdk_pemugaran" class="form-control" value="{{$kp_q_jml_pdk_pemugaran}}" maxlength="6" placeholder="Jumlah Penduduk (Jiwa)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_kk_pemugaran" name="kp_q_jml_kk_pemugaran" class="form-control" value="{{$kp_q_jml_kk_pemugaran}}" maxlength="6" placeholder="Jumlah Kepala Keluarga (KK)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Peremajaan</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_kaw_peremajaan" name="kp_q_kaw_peremajaan" class="form-control" value="{{$kp_q_kaw_peremajaan}}" maxlength="6" placeholder="Jumlah Kawasan">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_l_kaw_peremajaan" name="kp_l_kaw_peremajaan" class="form-control" value="{{$kp_l_kaw_peremajaan}}" maxlength="6" placeholder="Luas Kawasan" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1"></label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_pdk_peremajaan" name="kp_q_jml_pdk_peremajaan" class="form-control" value="{{$kp_q_jml_pdk_peremajaan}}" maxlength="6" placeholder="Jumlah Penduduk (Jiwa)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_kk_peremajaan" name="kp_q_jml_kk_peremajaan" class="form-control" value="{{$kp_q_jml_kk_peremajaan}}" maxlength="6" placeholder="Jumlah Kepala Keluarga (KK)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Permukiman Kembali (Dalam Kawasan yang Sama)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_kaw_pmkm_kmbl" name="kp_q_kaw_pmkm_kmbl" class="form-control" value="{{$kp_q_kaw_pmkm_kmbl}}" maxlength="6" placeholder="Jumlah Kawasan">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_l_kaw_pmkm_kmbl" name="kp_l_kaw_pmkm_kmbl" class="form-control" value="{{$kp_l_kaw_pmkm_kmbl}}" maxlength="6" placeholder="Luas Kawasan" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1"></label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_pdk_pmkm_kmbl" name="kp_q_jml_pdk_pmkm_kmbl" class="form-control" value="{{$kp_q_jml_pdk_pmkm_kmbl}}" maxlength="6" placeholder="Jumlah Penduduk (Jiwa)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_kk_pmkm_kmbl" name="kp_q_jml_kk_pmkm_kmbl" class="form-control" value="{{$kp_q_jml_kk_pmkm_kmbl}}" maxlength="6" placeholder="Jumlah Kepala Keluarga (KK)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Relokasi (Keluar Kawasan)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_kaw_relokasi" name="kp_q_kaw_relokasi" class="form-control" value="{{$kp_q_kaw_relokasi}}" maxlength="6" placeholder="Jumlah Kawasan">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_l_kaw_relokasi" name="kp_l_kaw_relokasi" class="form-control" value="{{$kp_l_kaw_relokasi}}" maxlength="6" placeholder="Luas Kawasan" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1"></label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_pdk_relokasi" name="kp_q_jml_pdk_relokasi" class="form-control" value="{{$kp_q_jml_pdk_relokasi}}" maxlength="6" placeholder="Jumlah Penduduk (Jiwa)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kp_q_jml_kk_relokasi" name="kp_q_jml_kk_relokasi" class="form-control" value="{{$kp_q_jml_kk_relokasi}}" maxlength="6" placeholder="Jumlah Kepala Keluarga (KK)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab6" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                            <br>
                                            <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/penyusunan/rencana_penanganan_5_thn/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                            <br>
                                            <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/penyusunan/rencana_penanganan_5_thn/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group striped-col">
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
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/main/perencanaan/penanganan/profile_rencana_5thn" type="button" class="btn btn-effect-ripple btn-danger">
                                Cancel
                            </a>
                            @if ($detil_menu=='274' || $detil_menu=='275')
                            <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                Submit
                            </button>
                            @endif
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
@stop
{{-- local scripts --}} @section('footer_scripts')
<script>
    function tahun(value, validator) {
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        
        var res = true;
        if(thn>yearNow){
            res=false;
        }
        return res;
    };
      $(document).ready(function () {
		$("#file-dokumen-input").fileinput({
  	  		showUpload: false
  	  	});
  	  	$("#file-absensi-input").fileinput({
  	  		showUpload: false
  	  	});
        $("#uri_img_document-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        });

        $("#uri_img_absensi-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        }); 
        $('#form').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form').on('submit', function (e) {
              e.preventDefault();
              var form_data = new FormData(this);
              $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/perencanaan/penanganan/profile_rencana_5thn/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {

                alert('From Submitted.');
                window.location.href = "/main/perencanaan/penanganan/profile_rencana_5thn";
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
                  $("#submit").prop('disabled', false);
                }
              });
            });
        }).on('error.form.bv', function(e) {
            $("#submit").prop('disabled', false);
        });
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var prop = $('#select-kode-prop-input');
        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var prop_id,kmw_id,kota_id,korkot_id;

        // prop.change(function(){
        //     prop_id=prop.val();
        //     if(prop_id!=null){
        //         kmw.empty();
        //         kmw.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/profile_rencana_5thn/select?prop="+prop_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kmw.change(function(){
        //     kmw_id=kmw.val();
        //     if(kmw_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/profile_rencana_5thn/select?kmw="+kmw_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kota.change(function(){
        //     kota_id=kota.val();
        //     if(kota_id!=null){
        //         korkot.empty();
        //         korkot.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/profile_rencana_5thn/select?kota="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });
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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
