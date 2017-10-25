@extends('MAIN/default') {{-- Page title --}} @section('title') Sertifikasi Infrastruktur Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/pelaksanaan/kota_non/sertifikasi_infra">
                    Pelaksanaan / Realisasi Kegiatan Skala Kota (Non BDI Kolaborasi) / Sertifikasi Infrastruktur
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
                                        Data Umum
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Realisasi Kegiatan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                         Nilai/Biaya
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                         Jumlah Penerima Manfaat
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                         Tenaga Kerja
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                         KKP
                                    </a>
                    </li>
                    <li>
                        <a href="#tab7" data-toggle="tab">
                                        Sertifikasi
                                    </a>
                    </li>
                    <li>
                        <a href="#tab8" data-toggle="tab">
                                        Koordinat Lokasi
                                    </a>
                    </li>
                    <li>
                        <a href="#tab9" data-toggle="tab">
                                         Dokumentasi Foto Kegiatan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab10" data-toggle="tab">
                                        Progress Pemanfaatan Dana dan Fisik
                                    </a>
                    </li><!-- 
                    <li>
                        <a href="#tab11" data-toggle="tab">
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
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Sumber Dana</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <select id="jns_sumber_dana" name="jns_sumber_dana" class="form-control" size="1" required>
                                                <option value="2" {!! $jns_sumber_dana=='2' ? 'selected':'' !!}>Non BDI Kolaborasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" required maxlength="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">KMW</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1" >
                                                <option value>Please select</option>
                                                @foreach ($kode_kmw_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kmw==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kota</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1">
                                                <option value>Please select</option>
                                                @foreach ($kode_kota_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Korkot</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1">
                                                <option value>Please select</option>
                                                @foreach ($kode_korkot_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kawasan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kawasan-input" name="kode-kawasan-input" class="form-control select2" size="1" >
                                                <option value>Please select</option>
                                                @foreach ($kode_kawasan_list as $kkl)
                                                    <option value="{{$kkl->id}}" {!! $kode_kawasan==$kkl->id ? 'selected':'' !!}>{{$kkl->kode_kawasan." ".$kkl->nama}}</option>
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
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Realisasi</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="tgl_realisasi" name="tgl_realisasi" placeholder="Tanggal Proposal" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_realisasi}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Fisik</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Volume</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="vol_realisasi" name="vol_realisasi" class="form-control" value="{{$vol_realisasi}}" maxlength="9" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Satuan (Meter/Unit/m<sup>2</sup>)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="satuan" name="satuan" class="form-control" value="{{$satuan}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Progress Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="progress_keg" name="progress_keg" class="form-control" value="{{$progress_keg}}" maxlength="9" required>
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
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">APBN</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBN NSUP (PHLN)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_nsup" name="nb_apbn_nsup" class="form-control" value="{{$nb_apbn_nsup}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBN Lainnya (PHLN/RM)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_lain" name="nb_apbn_lain" class="form-control" value="{{$nb_apbn_lain}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">APBD</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">PROP (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_prop" name="nb_apbd_prop" class="form-control" value="{{$nb_apbd_prop}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KAB/KOTA (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_kota" name="nb_apbd_kota" class="form-control" value="{{$nb_apbd_kota}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;"></label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lainnya (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_lainnya" name="nb_lainnya" class="form-control" value="{{$nb_lainnya}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Progress Keuangan (Realisasi/Rencana)/100%</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="progress_keuangan" name="progress_keuangan" class="form-control" value="{{$progress_keuangan}}" maxlength="6" placeholder="Nilai">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jiwa</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_jiwa" name="tpm_q_jiwa" class="form-control" value="{{$tpm_q_jiwa}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jiwa Perempuan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_jiwa_w" name="tpm_q_jiwa_w" class="form-control" value="{{$tpm_q_jiwa_w}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KRT MBR</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_mbr" name="tpm_q_mbr" class="form-control" value="{{$tpm_q_mbr}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KK</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_kk" name="tpm_q_kk" class="form-control" value="{{$tpm_q_kk}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KK Miskin (40% BPS)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_kk_miskin" name="tpm_q_kk_miskin" class="form-control" value="{{$tpm_q_kk_miskin}}" maxlength="9" placeholder="Jumlah">
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Jumlah Pekerja</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">laki</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_q_tkp" name="tk_q_tkp" class="form-control" value="{{$tk_q_tkp}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Perempuan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_q_tkw" name="tk_q_tkw" class="form-control" value="{{$tk_q_tkw}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;"></label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah HOK(HOK)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_q_hok" name="tk_q_hok" class="form-control" value="{{$tk_q_hok}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Nilai HOK(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tk_q_nilai_hok" name="tk_q_nilai_hok" class="form-control" value="{{$tk_q_nilai_hok}}" maxlength="9" placeholder="Nilai">
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
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">KPP</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kpp-input" name="id_kpp" class="form-control select2" size="1" >
                                                <option value>Please select</option>
                                                @foreach ($kode_kpp_list as $kkl)
                                                    <option value="{{$kkl->id}}" {!! $id_kpp==$kkl->id ? 'selected':'' !!}>{{$kkl->kode_kpp." ".$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Infrastruktur yang Masih Berfungsi dan Dimanfaatkan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan yang Masih Ada</label>
                                        <div class="col-sm-6">
                                            <select id="kpp_flag_bgn_msh_ada" name="kpp_flag_bgn_msh_ada" class="form-control" size="1">
                                                <option value="0" {!! $kpp_flag_bgn_msh_ada==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kpp_flag_bgn_msh_ada==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan dengan Kondisi Baik</label>
                                        <div class="col-sm-6">
                                            <select id="kpp_flag_bgn_msh_baik" name="kpp_flag_bgn_msh_baik" class="form-control" size="1">
                                                <option value="0" {!! $kpp_flag_bgn_msh_baik==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kpp_flag_bgn_msh_baik==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Masih Berfungsi</label>
                                        <div class="col-sm-6">
                                            <select id="kpp_flag_bgn_msh_fungsi" name="kpp_flag_bgn_msh_fungsi" class="form-control" size="1">
                                                <option value="0" {!! $kpp_flag_bgn_msh_fungsi==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kpp_flag_bgn_msh_fungsi==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Masih Dimanfaatkan</label>
                                        <div class="col-sm-6">
                                            <select id="kpp_flag_bgn_msh_man" name="kpp_flag_bgn_msh_man" class="form-control" size="1">
                                                <option value="0" {!! $kpp_flag_bgn_msh_man==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kpp_flag_bgn_msh_man==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Dikembangkan/Ditingkatkan</label>
                                        <div class="col-sm-6">
                                            <select id="kpp_flag_bgn_msh_dev" name="kpp_flag_bgn_msh_dev" class="form-control" size="1">
                                                <option value="0" {!! $kpp_flag_bgn_msh_dev==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kpp_flag_bgn_msh_dev==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
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
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sertifikasi</label>
                                        <div class="col-sm-6">
                                            <select id="hasil_sertifikasi" name="hasil_sertifikasi" class="form-control" size="1">
                                                <option value="KB" {!! $hasil_sertifikasi=='KB' ? 'selected':'' !!}>Kualitas Baik</option>
                                                <option value="KC" {!! $hasil_sertifikasi=='KC' ? 'selected':'' !!}>Kualitas Cukup</option>
                                                <option value="KK" {!! $hasil_sertifikasi=='KK' ? 'selected':'' !!}>Kualitas Kurang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab8" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Latitude</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="longitude" name="longitude" class="form-control" value="{{$longitude}}" maxlength="18">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Longitude</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="latitude" name="latitude" class="form-control" value="{{$latitude}}" maxlength="18">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab9" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">0%</label>
                                        <div class="col-sm-2">
                                            <select id="flag_foto_prcn0" name="flag_foto_prcn0" class="form-control" size="1">
                                                <option value="0" {!! $flag_foto_prcn0==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $flag_foto_prcn0==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="url_img_prcn0" type="file" class="file" data-show-preview="false" name="url_img_prcn0">
                                            <br>
                                            <input type="text" class="btn btn-warning btn-modify" id="uploaded-url_img_prcn0" name="uploaded-url_img_prcn0" value="{{$url_img_prcn0}}" {!! $url_img_prcn0==null ? 'style="display:none"':'' !!} readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">50%</label>
                                        <div class="col-sm-2">
                                            <select id="flag_foto_prcn50" name="flag_foto_prcn50" class="form-control" size="1">
                                                <option value="0" {!! $flag_foto_prcn50==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $flag_foto_prcn50==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="url_img_prcn50" type="file" class="file" data-show-preview="false" name="url_img_prcn50">
                                            <br>
                                            <input type="text" class="btn btn-warning btn-modify" id="uploaded-url_img_prcn50" name="uploaded-url_img_prcn50" value="{{$url_img_prcn50}}" {!! $url_img_prcn50==null ? 'style="display:none"':'' !!} readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">100%</label>
                                        <div class="col-sm-2">
                                            <select id="flag_foto_prcn100" name="flag_foto_prcn100" class="form-control" size="1">
                                                <option value="0" {!! $flag_foto_prcn100==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $flag_foto_prcn100==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="url_img_prcn100" type="file" class="file" data-show-preview="false" name="url_img_prcn100">
                                            <br>
                                            <input type="text" class="btn btn-warning btn-modify" id="uploaded-url_img_prcn100" name="uploaded-url_img_prcn100" value="{{$url_img_prcn100}}" {!! $url_img_prcn100==null ? 'style="display:none"':'' !!} readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab10" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Pencairan/Penyaluran Dana ke KSM</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tahap I. 60% (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pencairan_dana1" name="pencairan_dana1" class="form-control" value="{{$pencairan_dana1}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tahap II. 30% (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pencairan_dana2" name="pencairan_dana2" class="form-control" value="{{$pencairan_dana2}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tahap III. 10% (Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pencairan_dana3" name="pencairan_dana3" class="form-control" value="{{$pencairan_dana3}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Pemanfaatan Dana KSM</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pemanfaatan_dana" name="pemanfaatan_dana" class="form-control" value="{{$pemanfaatan_dana}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">(%)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pemanfaatan_data_prcn" name="pemanfaatan_data_prcn" class="form-control" value="{{$pemanfaatan_data_prcn}}" maxlength="6" placeholder="Persentase">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Fisik</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">(%)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="progres_fisik" name="progres_fisik" class="form-control" value="{{$progres_fisik}}" maxlength="26" placeholder="Persentase">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="tab11" class="tab-pane fade ">
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
                            <a href="/main/pelaksanaan/kota_non/sertifikasi_infra" type="button" class="btn btn-effect-ripple btn-danger">
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

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
            var form_data = new FormData(this);
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/pelaksanaan/kota_non/sertifikasi_infra/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/pelaksanaan/kota_non/sertifikasi_infra";
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
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-kawasan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-ksm-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-kpp-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $('.ui-pnotify').remove();
        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            console.log(e)
            new PNotify({
                title: 'Pengisian Form Tidak Lengkap',
                text: 'Field input '+e.target.id+' belum diisi.',
                type: 'error'
            });
          };
        })(), true);

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kawasan = $('#select-kode-kawasan-input');
        var kmw_id,kota_id,korkot_id;

        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=null){
                kota.empty();
                kota.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kota_non/sertifikasi_infra/select?kmw="+kmw_id,
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
            kmw_id=kmw.val();
            if(kota_id!=null){
                korkot.empty();
                korkot.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kota_non/sertifikasi_infra/select?kota_korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

               
            }
        });

        kota.change(function(){
            kota_id=kota.val();
            if(kota_id!=null){
                kawasan.empty();
                kawasan.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kota_non/sertifikasi_infra/select?kota_kawasan="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kawasan.append("<option value="+data[i].id+" >"+data[0].kode_kawasan+" "+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
      });
</script>
@stop
