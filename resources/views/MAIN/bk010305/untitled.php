@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Kawasan Prioritas @stop {{-- local styles --}}
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
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom_css/wizard.css')}}" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Kawasan Prioritas</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/penanganan/lokasi_profile">
                    Perencanaan / Kawasan Prioritas / Perencanaan Kawasan Prioritas
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
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="commentForm" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div id="rootwizard">
                                <ul>
                                    <li>
                                        <a href="#tab1" data-toggle="tab">
                                            <span>
                                                <span>Karakteristik Kawasan</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab">
                                            <span>
                                                <span>Penduduk</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab">
                                            <span>
                                                <span>Profile Kumuh</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab">
                                            <span>
                                                <span>Aspek Kumuh</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab5" data-toggle="tab">
                                            <span>
                                                <span>Upload Dokumen</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                                                <input type="text" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Prop</label>          
                                            <div class="col-sm-6">
                                                <select id="select-kode_prop-input" class="form-control select2" name="select-kode_prop-input">
                                                    <option value=undefined>Please select</option>
                                                    @foreach($kode_prop_list as $list)
                                                        <option value="{{ $list->kode }}" @if($list->kode==$kode_prop) selected="selected" @endif >{{ $list->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input">
                                                    <option value=undefined>Please select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">KorKot</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input">
                                                    <option value=undefined>Please select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Kecamatan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input" required>
                                                    <option value=undefined>Please select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input31">Kawasan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kawasan-input" class="form-control select2" name="select-kode_kawasan-input-input" required>
                                                    @foreach($id_kawasan_list as $list)
                                                        <option value="{{ $list->id }}" @if($list->id==$kode_kawasan) selected="selected" @endif >{{ $list->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-textarea-input2">Tipologi Pemukiman</label>
                                            <div class="col-sm-6">
                                                <textarea id="tipologi_pmkm-input" name="tipologi_pmkm-input" rows="7" class="form-control resize_vertical" placeholder="Tipologi Pemukiman" maxlength="100" required>{{ $tipologi_pmkm }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-textarea-input2">Karakter Kawasan</label>
                                            <div class="col-sm-6">
                                                <textarea id="karakter_kaw-input" name="karakter_kaw-input" rows="7" class="form-control resize_vertical" placeholder="Karakter Kawasan" maxlength="100" required>{{ $karakter_kaw }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-textarea-input2">Pola Penanganan</label>
                                            <div class="col-sm-6">
                                                <textarea id="pola_penanganan-input" name="pola_penanganan-input" rows="7" class="form-control resize_vertical" placeholder="Topologi Pemukiman" maxlength="100" required>{{ $pola_penanganan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Status Lahan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="status_lahan-input" name="status_lahan-input" class="form-control" placeholder="Status Lahan" value="{{$status_lahan}}" maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status Hunian</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="status_hunian-input" name="status_hunian-input" class="form-control" placeholder="Status Hunian" value="{{$status_hunian}}" maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Kepadatan Bangunan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_kpdt_pddk-input" name="pdk_kpdt_pddk-input" class="form-control" placeholder="Peserta Miskin" value="{{$pdk_kpdt_pddk}}" maxlength="12" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah Penduduk</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_q_jiwa-input" name="pdk_q_jiwa-input" class="form-control" placeholder="Jiwa" value="{{$pdk_q_jiwa}}" maxlength="11" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Jumlah Penduduk Perempuan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_q_jiwa_w-input" name="pdk_q_jiwa_w-input" class="form-control" placeholder="Jiwa" value="{{$pdk_q_jiwa_w}}" maxlength="11" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah Penduduk MBR</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_q_mbr-input" name="pdk_q_mbr-input" class="form-control" placeholder="Jiwa" value="{{$pdk_q_mbr}}" maxlength="11" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Jumlah Kepala Keluarga</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_q_kk-input" name="pdk_q_kk-input" class="form-control" placeholder="Kepala Keluarga" value="{{$pdk_q_kk}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah Kepala Keluarga Miskin</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_q_kk_miskin-input" name="pdk_q_kk_miskin-input" class="form-control" placeholder="Kepala Keluarga Miskin" value="{{$pdk_q_kk_miskin}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Kepadatan Penduduk</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pdk_kpdt_pddk-input" name="pdk_kpdt_pddk-input" class="form-control" placeholder="Jiwa/Ha" value="{{$pdk_kpdt_pddk}}" maxlength="12" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Luas Kawasan Kumuh</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pk_l_kaw_kmh-input" name="pk_l_kaw_kmh-input" class="form-control" placeholder="m2" value="{{$pk_l_kaw_kmh}}" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Jumlah Kawasan Kumuh Pada Tahun Berjalan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pk_q_kel_kmh_thn_cur-input" name="pk_q_kel_kmh_thn_cur-input" class="form-control" placeholder="Jumlah Kawasan Kumuh Pada Tahun Berjalan" value="{{$pk_q_kel_kmh_thn_cur}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah RT Kumuh Pada Tahun Berjalan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pk_q_rt_kmh_thn_cur-input" name="pk_q_rt_kmh_thn_cur-input" class="form-control" placeholder="Jumlah RT Kumuh Pada Tahun Berjalan" value="{{$pk_q_rt_kmh_thn_cur}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Luas RT Kumuh Pada Tahun Berjalan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pk_l_rt_kmh_thn_cur-input" name="pk_l_rt_kmh_thn_cur-input" class="form-control" placeholder="Luas RT Kumuh Pada Tahun Berjalan" value="{{$pk_l_rt_kmh_thn_cur}}" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Jumlah RT Kumuh Pada Tahun Berjalan</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="pk_q_rt_kmh_thn_cur-input" name="pk_q_rt_kmh_thn_cur-input" class="form-control" placeholder="Jumlah RT Kumuh Pada Tahun Berjalan" value="{{$pk_q_rt_kmh_thn_cur}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Berat</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_berat_l_wil-input" name="tk_berat_l_wil-input" class="form-control" placeholder="Luas (Ha)" value="{{$tk_berat_l_wil}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_berat_q_rt-input" name="tk_berat_q_rt-input" class="form-control" placeholder="Jumlah RT" value="{{$tk_berat_q_rt}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Sedang</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_sedang_l_wil-input" name="tk_sedang_l_wil-input" class="form-control" placeholder="Luas (Ha)" value="{{$tk_sedang_l_wil}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_sedang_q_rt-input" name="tk_sedang_q_rt-input" class="form-control" placeholder="Jumlah RT" value="{{$tk_sedang_q_rt}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Ringan</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_ringan_l_wil-input" name="tk_ringan_l_wil-input" class="form-control" placeholder="Luas (Ha)" value="{{$tk_ringan_l_wil}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="tk_ringan_q_rt-input" name="tk_ringan_q_rt-input" class="form-control" placeholder="Jumlah RT" value="{{$tk_ringan_q_rt}}" maxlength="9" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Hunian</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_hunian-input" name="ak_val_abs_hunian-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_hunian}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_hunian-input" name="ak_prcn_gap_hunian-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_hunian}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Jalan Lingkungan</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_jalan-input" name="ak_val_abs_jalan-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_jalan}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_jalan-input" name="ak_prcn_gap_jalan-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_jalan}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Penyediaan Air Minum</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_air_minum-input" name="ak_val_abs_air_minum-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_air_minum}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_air_minum-input" name="ak_prcn_gap_air_minum-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_air_minum}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Drainase Lingkungan</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_drainase-input" name="ak_val_abs_drainase-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_drainase}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_drainase-input" name="ak_prcn_gap_drainase-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_drainase}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Air Limbah</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_air_limbah-input" name="ak_val_abs_air_limbah-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_air_limbah}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_air_limbah-input" name="ak_prcn_gap_air_limbah-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_air_limbah}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Pengelolaan Persampahan</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_sampah-input" name="ak_val_abs_sampah-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_sampah}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_sampah-input" name="ak_prcn_gap_sampah-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_sampah}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Proteksi Kebakaran</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_kebakaran-input" name="ak_val_abs_kebakaran-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_kebakaran}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_kebakaran-input" name="ak_prcn_gap_kebakaran-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_kebakaran}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Ruang Terbuka Publik</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_val_abs_rtp-input" name="ak_val_abs_rtp-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_val_abs_rtp}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_rtp-input" name="ak_prcn_gap_rtp-input" class="form-control" placeholder="Presentasi Gap (Nilai Negatif)" value="{{$ak_prcn_gap_rtp}}" maxlength="9" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Ekonomi</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_ekonomi-input" name="ak_prcn_gap_ekonomi-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_prcn_gap_ekonomi}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Sosial</label>
                                            <div class="col-sm-3">
                                                <input type="number" id="ak_prcn_gap_sosial-input" name="ak_prcn_gap_sosial-input" class="form-control" placeholder="Nilai Absolut" value="{{$ak_prcn_gap_sosial}}" maxlength="9" required>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">File Document</label>
                                            <div class="col-sm-6">
                                                <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input" required>
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                            </div>
                                        </div>   
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">File Absensi</label>
                                            <div class="col-sm-6">
                                                <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input" required>
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                           <label class="col-sm-3 control-label" for="example-text-input1">Diserahkan Oleh</label>
                                            <div class="col-sm-3">
                                                <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Diketahui Oleh</label>
                                            <div class="col-sm-3">
                                                <select id="diket_oleh-input" name="diket_oleh-input" class="form-control" size="1">
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="diket_tgl-input" name="diket_tgl-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Diverifikasi Oleh</label>
                                            <div class="col-sm-3">
                                                <select id="diver_oleh-input" name="diver_oleh-input" class="form-control" size="1">
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="diver_tgl-input" name="diver_tgl-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                            </div>
                                        </div>
                                        <div class="form-group form-actions">
                                            <div class="col-sm-9 col-sm-offset-3">
                                                <a href="/main/perencanaan/kawasan/perencanaan" type="button" class="btn btn-effect-ripple btn-danger">
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
                                    <ul class="pager wizard">
                                        <li class="previous">
                                            <a>Previous</a>
                                        </li>
                                        <li class="next">
                                            <a>Next</a>
                                        </li>
                                       <!--  <li class="next finish" style="display:none;">
                                            <a>Finish</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">User Register</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have Submitted Successfully.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">OK
                                            </button>
                                        </div>
                                    </div>
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
            
            var file_document = document.getElementById('file-document-input').files[0];
            var file_absensi = document.getElementById('file-absensi-input').files[0];
            var form_data = new FormData();
            form_data.append('example-id-input', $('#example-id-input').val());
            form_data.append('file-document-input', file_document);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('uploaded-file-document', $('#uploaded-file-document').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('tahun-input', $('#tahun-input').val());
            form_data.append('select-kode_prop-input', $('#select-kode_prop-input').val());
            form_data.append('select-kode_kota-input', $('#select-kode_kota-input').val());
            form_data.append('select-kode_korkot-input', $('#select-kode_korkot-input').val());
            form_data.append('select-kode_kec-input', $('#select-kode_kec-input').val());
            form_data.append('select-kode_kawasan-input', $('#select-kode_kawasan-input').val());
            form_data.append('tipologi_pmkm-input', $('#tipologi_pmkm-input').val());
            form_data.append('karakter_kaw-input', $('#karakter_kaw-input').val());
            form_data.append('pola_penanganan-input', $('#pola_penanganan-input').val());
            form_data.append('status_lahan-input', $('#status_lahan-input').val());
            form_data.append('status_hunian-input', $('#status_hunian-input').val());
            form_data.append('kepadatan_bangunan-input', $('#kepadatan_bangunan-input').val());
            form_data.append('pdk_q_jiwa-input', $('#pdk_q_jiwa-input').val());
            form_data.append('pdk_q_jiwa_w-input', $('#pdk_q_jiwa_w-input').val());
            form_data.append('pdk_q_mbr-input', $('#pdk_q_mbr-input').val());
            form_data.append('pdk_q_kk-input', $('#pdk_q_kk-input').val());
            form_data.append('pdk_q_kk_miskin-input', $('#pdk_q_kk_miskin-input').val());
            form_data.append('pk_l_kaw_kmh-input', $('#pk_l_kaw_kmh-input').val());
            form_data.append('pk_q_kel_kmh_thn_cur-input', $('#pk_q_kel_kmh_thn_cur-input').val());
            form_data.append('pk_q_rt_kmh_thn_cur-input', $('#pk_q_rt_kmh_thn_cur-input').val());
            form_data.append('pk_l_rt_kmh_thn_cur-input', $('#pk_l_rt_kmh_thn_cur-input').val());
            form_data.append('tk_berat_l_wil-input', $('#tk_berat_l_wil-input').val());
            form_data.append('tk_berat_q_rt-input', $('#tk_berat_q_rt-input').val());
            form_data.append('tk_sedang_l_wil-input', $('#tk_sedang_l_wil-input').val());
            form_data.append('tk_sedang_q_rt-input', $('#tk_sedang_q_rt-input').val());
            form_data.append('tk_ringan_l_wil-input', $('#tk_ringan_l_wil-input').val());
            form_data.append('tk_ringan_q_rt-input', $('#tk_ringan_q_rt-input').val());
            form_data.append('ak_val_abs_hunian-input', $('#ak_val_abs_hunian-input').val());
            form_data.append('ak_prcn_gap_hunian-input', $('#ak_prcn_gap_hunian-input').val());
            form_data.append('ak_val_abs_jalan-input', $('#ak_val_abs_jalan-input').val());
            form_data.append('ak_prcn_gap_jalan-input', $('#ak_prcn_gap_jalan-input').val());
            form_data.append('ak_val_abs_air_minum-input', $('#ak_val_abs_air_minum-input').val());
            form_data.append('ak_prcn_gap_air_minum-input', $('#ak_prcn_gap_air_minum-input').val());
            form_data.append('ak_val_abs_drainase-input', $('#ak_val_abs_drainase-input').val());
            form_data.append('ak_prcn_gap_drainase-input', $('#ak_prcn_gap_drainase-input').val());
            form_data.append('ak_val_abs_air_limbah-input', $('#ak_val_abs_air_limbah-input').val());
            form_data.append('ak_prcn_gap_air_limbah-input', $('#ak_prcn_gap_air_limbah-input').val());
            form_data.append('ak_val_abs_sampah-input', $('#ak_val_abs_sampah-input').val());
            form_data.append('ak_prcn_gap_sampah-input', $('#ak_prcn_gap_sampah-input').val());
            form_data.append('ak_val_abs_kebakaran-input', $('#ak_val_abs_kebakaran-input').val());
            form_data.append('ak_prcn_gap_kebakaran-input', $('#ak_prcn_gap_kebakaran-input').val());
            form_data.append('ak_val_abs_rtp-input', $('#ak_val_abs_rtp-input').val());
            form_data.append('ak_prcn_gap_rtp-input', $('#ak_prcn_gap_rtp-input').val());
            form_data.append('ak_prcn_gap_ekonomi-input', $('#ak_prcn_gap_ekonomi-input').val());
            form_data.append('ak_prcn_gap_sosial-input', $('#ak_prcn_gap_sosial-input').val());
            form_data.append('diser_tgl-input', $('#diser_tgl-input').val());
            form_data.append('diser_oleh-input', $('#diser_oleh-input').val());
            form_data.append('diket_tgl-input', $('#diket_tgl-input').val());
            form_data.append('diket_oleh-input', $('#diket_oleh-input').val());
            form_data.append('diver_tgl-input', $('#diver_tgl-input').val());
            form_data.append('diver_oleh-input', $('#diver_oleh-input').val());

            $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/perencanaan/kawasan/perencanaan/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {
                    alert('From Submitted.');
                    window.location.href = "/main/perencanaan/kawasan/perencanaan";

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                    $("#submit").prop('disabled', false);
                }
            });
         });

        $("#select-kode_prop-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width: '100%'
        });
        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width: '100%'
        });
        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width: '100%'
        });
        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select",
            width: '100%'
        });

        var prop = $('#select-kode_prop-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kecamatan = $('#select-kode_kec-input');
        var prop_id, kota_id, korkot_id, kec_id;
        var kode_prop = {!! json_encode($kode_prop) !!};
        var kode_kota = {!! json_encode($kode_kota) !!};
        var kode_korkot = {!! json_encode($kode_korkot) !!};
        var kode_kec = {!! json_encode($kode_kec) !!};
        if(kode_prop!=null){
            kota.empty();
            kota.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kawasan/perencanaan/select?prop="+kode_prop,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_kota)
                            kota.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            korkot.empty();
            korkot.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kawasan/perencanaan/select?kota="+kode_kota,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_korkot)
                            korkot.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            kecamatan.empty();
            kecamatan.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kawasan/perencanaan/select?korkot="+kode_korkot,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_kec)
                            kecamatan.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
         }   

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=undefined){
                kota.empty();
                kota.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?prop="+prop_id,
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
                korkot.empty();
                korkot.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
                kecamatan.empty();
                kecamatan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>
@stop



