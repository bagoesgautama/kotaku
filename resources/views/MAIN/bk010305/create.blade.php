@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Perencanaan Penanganan Permukiman Kota @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/perencanaan/penanganan/lokasi_profile">
                    Perencanaan / Proses Penyusunan Perencanaan Tingkat Kota / Perencanaan Penanganan Permukiman Kota
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
                                        Lokasi Profile & Permukiman
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Produk Rencana Penanganan Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Profile Kumuh Kota
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Tingkat Kekumuhan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                        Aspek Kumuh (Sumber Data Baseline)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab7" data-toggle="tab">
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
                                    
                                    <div class="form-group">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Nomor SK Kumuh (Yang ada atau hasil Review)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="lpp-sk-kmh" name="lpp-sk-kmh" class="form-control" value="{{$lpp_sk_kmh}}" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh sesuai SK (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="lpp-l-kmh-sk" name="lpp-l-kmh-sk" class="form-control" value="{{$lpp_l_kmh_sk}}" maxlength="9" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh sesuai Hasil Verifikasi (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="lpp-l-kmh-ver" name="lpp-l-kmh-ver" class="form-control" value="{{$lpp_l_kmh_ver}}" maxlength="9" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Profile Permukiman Kota (*)</label>
                                        <div class="col-sm-6">
                                            <select id="prof-pmkm-kota" name="prof-pmkm-kota" class="form-control" size="1">
                                                <option value="0" {!! $prof_pmkm_kota==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $prof_pmkm_kota==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Status Dokumen RP2KP-KP</label>
                                        <div class="col-sm-6">
                                            <select id="rp2kp-stat-dok" name="rp2kp-stat-dok" class="form-control" size="1">
                                                <option value="0" {!! $rp2kp_stat_dok=='0' ? 'selected':'' !!}>Proses Awal</option>
                                                <option value="1" {!! $rp2kp_stat_dok=='1' ? 'selected':'' !!}>Review</option>
                                                <option value="2" {!! $rp2kp_stat_dok=='2' ? 'selected':'' !!}>Final</option>
                                                <option value="3" {!! $rp2kp_stat_dok=='3' ? 'selected':'' !!}>Disahkan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Dasar Hukum RP2KP-KP</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="rp2kp-ds-hukum" name="rp2kp-ds-hukum" class="form-control" value="{{$rp2kp_ds_hukum}}" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah RPLP diKelurahan Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp2kp-q-dkel-kmh" name="rp2kp-q-dkel-kmh" class="form-control" value="{{$rp2kp_q_dkel_kmh}}" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah RPLP diKelurahan Non Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="rp2kp-q-dkel-non-kmh" name="rp2kp-q-dkel-non-kmh" class="form-control" value="{{$rp2kp_q_dkel_non_kmh}}" maxlength="5">
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Kawasan Kumuh (Ha)</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kelurahan Kumuh pada Tahun Berjalan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkl-q-kel-kmh-thn-curr" name="pkkl-q-kel-kmh-thn-curr" class="form-control" value="{{$pkkl_q_kel_kmh_thn_curr}}" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah RT Kumuh pada Tahun Berjalan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkl-q-rt-kmh-thn-curr" name="pkkl-q-rt-kmh-thn-curr" class="form-control" value="{{$pkkl_q_rt_kmh_thn_curr}}" maxlength="5">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas RT Kumuh pada Tahun Berjalan (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkl-l-rt-kmh-thn-curr" name="pkkl-l-rt-kmh-thn-curr" class="form-control" value="{{$pkkl_l_rt_kmh_thn_curr}}" maxlength="9" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Penduduk</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk (Jiwa)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkp-q-pddk" name="pkkp-q-pddk" class="form-control" value="{{$pkkp_q_pddk}}" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk Perempuan (Jiwa)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkp-q-pddk-w" name="pkkp-q-pddk-w" class="form-control" value="{{$pkkp_q_pddk_w}}" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk MBR</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkp-q-pddk-mbr" name="pkkp-q-pddk-mbr" class="form-control" value="{{$pkkp_q_pddk_mbr}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan." data-bv-callback-callback="check">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kepala Keluarga Miskin (40% termiskin, data BPS)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkp-q-kk-miskin" name="pkkp-q-kk-miskin" class="form-control" value="{{$pkkp_q_kk_miskin}}" maxlength="9">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kepadatan Penduduk (Jiwa/Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkkp-kpdt-pddk" name="pkkp-kpdt-pddk" class="form-control" value="{{$pkkp_kpdt_pddk}}" maxlength="9">
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
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Non Kumuh (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-non-kmh-l-wil" name="tk-non-kmh-l-wil" class="form-control" value="{{$tk_non_kmh_l_wil}}" maxlength="9" placeholder="Luas (Ha)" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-non-kmh-q-rt" name="tk-non-kmh-q-rt" class="form-control" value="{{$tk_non_kmh_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Berat (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-berat-l-wil" name="tk-berat-l-wil" class="form-control" value="{{$tk_berat_l_wil}}" maxlength="9" placeholder="Luas (Ha)" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-berat-q-rt" name="tk-berat-q-rt" class="form-control" value="{{$tk_berat_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sedang (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-sedang-l-wil" name="tk-sedang-l-wil" class="form-control" value="{{$tk_sedang_l_wil}}" maxlength="9" placeholder="Luas (Ha)" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-sedang-q-rt" name="tk-sedang-q-rt" class="form-control" value="{{$tk_sedang_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ringan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-ringan-l-wil" name="tk-ringan-l-wil" class="form-control" value="{{$tk_ringan_l_wil}}" maxlength="9" placeholder="Luas (Ha)" step="0.01">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-ringan-q-rt" name="tk-ringan-q-rt" class="form-control" value="{{$tk_ringan_q_rt}}" maxlength="9" placeholder="Jumlah RT">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Hunian (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-hunian" name="ak-val-abs-hunian" class="form-control" value="{{$ak_val_abs_hunian}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-hunian" name="ak-prcn-gap-hunian" class="form-control" value="{{$ak_prcn_gap_hunian}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jalan Lingkungan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-jalan" name="ak-val-abs-jalan" class="form-control" value="{{$ak_val_abs_jalan}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-jalan" name="ak-prcn-gap-jalan" class="form-control" value="{{$ak_prcn_gap_jalan}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Penyedian Air Minum (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-air-minum" name="ak-val-abs-air-minum" class="form-control" value="{{$ak_val_abs_air_minum}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-air-minum" name="ak-prcn-gap-air-minum" class="form-control" value="{{$ak_prcn_gap_air_minum}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Drainase Lingkungan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-drainase" name="ak-val-abs-drainase" class="form-control" value="{{$ak_val_abs_drainase}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-drainase" name="ak-prcn-gap-drainase" class="form-control" value="{{$ak_prcn_gap_drainase}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Air Limbah (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-air-limbah" name="ak-val-abs-air-limbah" class="form-control" value="{{$ak_val_abs_air_limbah}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-air-limbah" name="ak-prcn-gap-air-limbah" class="form-control" value="{{$ak_prcn_gap_air_limbah}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Persampahan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-sampah" name="ak-val-abs-sampah" class="form-control" value="{{$ak_val_abs_sampah}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-sampah" name="ak-prcn-gap-sampah" class="form-control" value="{{$ak_prcn_gap_sampah}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Proteksi Kebakaran (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-kebakaran" name="ak-val-abs-kebakaran" class="form-control" value="{{$ak_val_abs_kebakaran}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-kebakaran" name="ak-prcn-gap-kebakaran" class="form-control" value="{{$ak_prcn_gap_kebakaran}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ruang Terbuka Publik (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-val-abs-rtp" name="ak-val-abs-rtp" class="form-control" value="{{$ak_val_abs_rtp}}" maxlength="9" placeholder="Nilai Absolut">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="ak-prcn-gap-rtp" name="ak-prcn-gap-rtp" class="form-control" value="{{$ak_prcn_gap_rtp}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ekonomi (*)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ak-prcn-gap-ekonomi" name="ak-prcn-gap-ekonomi" class="form-control" value="{{$ak_prcn_gap_ekonomi}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sosial (*)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ak-prcn-gap-sosial" name="ak-prcn-gap-sosial" class="form-control" value="{{$ak_prcn_gap_sosial}}" maxlength="6" placeholder="Presentase Gap (Nilai Negatif)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab7" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                            <br>
                                            <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/penyusunan/lokasi_profile/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                            <br>
                                            <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/penyusunan/lokasi_profile/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
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
                            <a href="/main/perencanaan/penanganan/lokasi_profile" type="button" class="btn btn-effect-ripple btn-danger">
                                Cancel
                            </a>
                            @if ($detil_menu=='271' || $detil_menu=='270')
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
    function check(value, validator) {
        var p = parseInt($('#pkkp-q-pddk').val());
        var w = parseInt($('#pkkp-q-pddk-w').val());

        var mbr = parseInt($('#pkkp-q-pddk-mbr').val())|| 0;
        var sum = p+w;
        var res = true;
        if(mbr>sum){
            res=false;
        }

        return res;
    };
    function tahun(value, validator) {
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        
        var res = true;
        if(thn>yearNow){
            res=false;
        }
        return res;
    };
    function test(id){
        console.log(id)
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        var elem2 = $('#'+id+'-file');
        elem2.removeAttr('value');
        return false;
    }
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
                "url": "/main/perencanaan/penanganan/lokasi_profile/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {

                alert('From Submitted.');
                window.location.href = "/main/perencanaan/penanganan/lokasi_profile";
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
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var prop = $('#select-kode-prop-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var rplp_kmh = $('#rp2kp-q-dkel-kmh');
        var rplp_non_kmh = $('#rp2kp-q-dkel-non-kmh');
        var prop_id,kota_id,korkot_id;

        // prop.change(function(){
        //     prop_id=prop.val();
        //     if(prop_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/lokasi_profile/select?prop="+prop_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        kota.change(function(){
            kota_id=kota.val();
            if(kota_id!=null){
                rplp_kmh.empty();
                rplp_non_kmh.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/penanganan/lokasi_profile/select?kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        rplp_kmh.val(data[0].kmh);
                        rplp_non_kmh.val(data[0].non_kmh);
                    }
                });
            }
        });

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
