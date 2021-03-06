@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Penanganan Dampak Sosial & Lingkungan {{-- local styles --}} @section('header_styles')

<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">

@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Penanganan Dampak Sosial & Lingkungan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/infra/amdal">
                    Perencanaan / Penyiapan DED, Pengadaan Skala Kota / Penanganan Dampak Sosial & Lingkungan
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
                                        Paket Kerja Kontraktor
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Pengelolaan Dampak Sosial (Form Bagian 1)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Pengelolaan Dampak Sosial (Form Bagian 2)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Pengelolaan Dampak Lingkungan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Tambahan Data
                                    </a>
                    </li>
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
                                        <label class="col-sm-3 control-label">Paket Kerja Kontraktor</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="kode_parent" name="kode_parent" value="{{ $kode_parent }}">
                                            <select id="select-paket_kerja_kontraktor-input" name="select-paket_kerja_kontraktor-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_parent_list as $kpl)
                                                    <option value="{{$kpl->kode}}" {!! $kode_parent==$kpl->kode ? 'selected':'' !!}>{{$kpl->kode.' - '.$kpl->nama_subkomponen.' - '.$kpl->nama_dtl_subkomponen}}</option>
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Pengadaan Tanah (Ha)</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Hibah</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_hibah_gov" name="lpt_l_hibah_gov" class="form-control" value="{{$lpt_l_hibah_gov}}" maxlength="9" placeholder="Milik Pemerintah">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_hibah_masy" name="lpt_l_hibah_masy" class="form-control" value="{{$lpt_l_hibah_masy}}" maxlength="9" placeholder="Milik Masyarakat">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_hibah_lain" name="lpt_l_hibah_lain" class="form-control" value="{{$lpt_l_hibah_lain}}" maxlength="9" placeholder="Milik Lain-lain">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ijin Pakai</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_ijin_pakai_gov" name="lpt_l_ijin_pakai_gov" class="form-control" value="{{$lpt_l_ijin_pakai_gov}}" maxlength="9" placeholder="Milik Pemerintah">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_ijin_pakai_masy" name="lpt_l_ijin_pakai_masy" class="form-control" value="{{$lpt_l_ijin_pakai_masy}}" maxlength="9" placeholder="Milik Masyarakat">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_ijin_pakai_lain" name="lpt_l_ijin_pakai_lain" class="form-control" value="{{$lpt_l_ijin_pakai_lain}}" maxlength="9" placeholder="Milik Lain-lain">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ijin Dilalui</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_dilalui_gov" name="lpt_l_dilalui_gov" class="form-control" value="{{$lpt_l_dilalui_gov}}" maxlength="9" placeholder="Milik Pemerintah">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_dilalui_masy" name="lpt_l_dilalui_masy" class="form-control" value="{{$lpt_l_dilalui_masy}}" maxlength="9" placeholder="Milik Masyarakat">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_l_dilalui_lain" name="lpt_l_dilalui_lain" class="form-control" value="{{$lpt_l_dilalui_lain}}" maxlength="9" placeholder="Milik Lain-lain">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Nilai Tanah (Rp)</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_rp_nilai_gov" name="lpt_rp_nilai_gov" class="form-control" value="{{$lpt_rp_nilai_gov}}" maxlength="27" placeholder="Milik Pemerintah">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_rp_nilai_masy" name="lpt_rp_nilai_masy" class="form-control" value="{{$lpt_rp_nilai_masy}}" maxlength="27" placeholder="Milik Masyarakat">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_rp_nilai_lain" name="lpt_rp_nilai_lain" class="form-control" value="{{$lpt_rp_nilai_lain}}" maxlength="27" placeholder="Milik Lain-lain">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Pemberi Tanah (Jumlah Masyarakat/KK)</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_q_pt_kk_hibah" name="lpt_q_pt_kk_hibah" class="form-control" value="{{$lpt_q_pt_kk_hibah}}" maxlength="9" placeholder="Hibah">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_q_pt_kk_ijin_pakai" name="lpt_q_pt_kk_ijin_pakai" class="form-control" value="{{$lpt_q_pt_kk_ijin_pakai}}" maxlength="9" placeholder="Ijin Dipakai">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="number" id="lpt_q_pt_kk_ijin_dilalui" name="lpt_q_pt_kk_ijin_dilalui" class="form-control" value="{{$lpt_q_pt_kk_ijin_dilalui}}" maxlength="9" placeholder="Ijin Dilalui">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Konsolidasi Lahan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Tanah (Ha)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kl_lt_pre" name="kl_lt_pre" class="form-control" value="{{$kl_lt_pre}}" maxlength="9" placeholder="Sebelum">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kl_lt_pos" name="kl_lt_pos" class="form-control" value="{{$kl_lt_pos}}" maxlength="9" placeholder="Sesudah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Peserta</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="kl_q_peserta" name="kl_q_peserta" class="form-control" value="{{$kl_q_peserta}}" maxlength="9" placeholder="Jumlah KK">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="kl_q_peserta_w" name="kl_q_peserta_w" class="form-control" value="{{$kl_q_peserta_w}}" maxlength="9" placeholder="KK Perempuan">
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Permukiman Kembali</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Tanah (Ha)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk_lt_pre" name="pk_lt_pre" class="form-control" value="{{$pk_lt_pre}}" maxlength="9" placeholder="Sebelum">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk_lt_pos" name="pk_lt_pos" class="form-control" value="{{$pk_lt_pos}}" maxlength="9" placeholder="Sesudah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Peserta</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk_q_peserta" name="pk_q_peserta" class="form-control" value="{{$pk_q_peserta}}" maxlength="9" placeholder="Jumlah KK">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk_q_peserta_w" name="pk_q_peserta_w" class="form-control" value="{{$pk_q_peserta_w}}" maxlength="9" placeholder="KK Perempuan">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Masyarakat Hukum Adat (MHA)</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Warga</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_jiwa" name="mha_q_jiwa" class="form-control" value="{{$mha_q_jiwa}}" maxlength="9" placeholder="Jiwa">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_jiwa_w" name="mha_q_jiwa_w" class="form-control" value="{{$mha_q_jiwa_w}}" maxlength="9" placeholder="Perempuan (Jiwa)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Warga Terdampak Proyek (WTP)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_wtp" name="mha_q_wtp" class="form-control" value="{{$mha_q_wtp}}" maxlength="9" placeholder="Jiwa">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_wtp_w" name="mha_q_wtp_w" class="form-control" value="{{$mha_q_wtp_w}}" maxlength="9" placeholder="Perempuan (Jiwa)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Warga Penerima Manfaat</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_wpm" name="mha_q_wpm" class="form-control" value="{{$mha_q_wpm}}" maxlength="9" placeholder="Jiwa">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="mha_q_wpm_w" name="mha_q_wpm_w" class="form-control" value="{{$mha_q_wpm_w}}" maxlength="9" placeholder="Perempuan (Jiwa)">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada Rencana Kerja MHA (RK-MHA)</label>
                                        <div class="col-sm-6">
                                            <select id="mha_flag_rk_mha" name="mha_flag_rk_mha" class="form-control" size="1">
                                                <option value="0" {!! $mha_flag_rk_mha==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $mha_flag_rk_mha==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Dampak Lingkungan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada UKL-UPL</label>
                                        <div class="col-sm-3">
                                            <select id="dl_flag_ukl_upl" name="dl_flag_ukl_upl" class="form-control" size="1">
                                                <option value="0" {!! $dl_flag_ukl_upl==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $dl_flag_ukl_upl==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada SOP/SPPL</label>
                                        <div class="col-sm-3">
                                            <select id="dl_flag_sop" name="dl_flag_sop" class="form-control" size="1">
                                                <option value="0" {!! $dl_flag_sop==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $dl_flag_sop==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Kawasan/Benda Cagar Budaya</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada dikawasan/Benda Cagar Budaya</label>
                                        <div class="col-sm-3">
                                            <select id="cb_flag_di_kaw_cb" name="cb_flag_di_kaw_cb" class="form-control" size="1">
                                                <option value="0" {!! $cb_flag_di_kaw_cb==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $cb_flag_di_kaw_cb==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada SOP/SPPL</label>
                                        <div class="col-sm-3">
                                            <select id="cb_flag_sop" name="cb_flag_sop" class="form-control" size="1">
                                                <option value="0" {!! $cb_flag_sop==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $cb_flag_sop==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Rawan Resiko Bencana</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada dilokasi Rawan Bencana</label>
                                        <div class="col-sm-3">
                                            <select id="rb_flag_di_kaw_rb" name="rb_flag_di_kaw_rb" class="form-control" size="1">
                                                <option value="0" {!! $rb_flag_di_kaw_rb==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $rb_flag_di_kaw_rb==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada SOP/SPPL</label>
                                        <div class="col-sm-3">
                                            <select id="rb_flag_sop" name="rb_flag_sop" class="form-control" size="1">
                                                <option value="0" {!! $rb_flag_sop==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $rb_flag_sop==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Penggunaan Kayu >= 3m<sup>3</sup></label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada Menggunakan Kayu >= 3m<sup>3</sup></label>
                                        <div class="col-sm-3">
                                            <select id="pk_flag_pakai_kayu" name="pk_flag_pakai_kayu" class="form-control" size="1">
                                                <option value="0" {!! $pk_flag_pakai_kayu==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $pk_flag_pakai_kayu==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3 control-label" for="example-text-input1">Volume Kayu yang Digunakan (m<sup>3</sup>)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="pk_vol_kayu" name="pk_vol_kayu" class="form-control" value="{{$pk_vol_kayu}}" maxlength="9" placeholder="Volume">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Dokumen Legalitas Kayu</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ada Dok. Legalitas Kayu</label>
                                        <div class="col-sm-3">
                                            <select id="lk_flag_legal_kayu" name="lk_flag_legal_kayu" class="form-control" size="1">
                                                <option value="0" {!! $lk_flag_legal_kayu==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $lk_flag_legal_kayu==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-3 control-label" for="example-text-input1">Volume Kayu Memiliki Legalitas (m<sup>3</sup>)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="lk_vol_kayu_legal" name="lk_vol_kayu_legal" class="form-control" value="{{$lk_vol_kayu_legal}}" maxlength="9" placeholder="Volume">
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
                                        <label class="col-sm-3 control-label">File Document</label>
                                        <div class="col-sm-6">
                                            <input id="file-document-input" type="file" class="file" accept="image/*" name="file-document-input">
                                            <br>
                                            <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/kawasan/perencanaan/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uploaded-file-document" name="uploaded-file-document" value="{{$uri_img_document}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">delete</button>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="file-absensi-input" type="file" class="file" accept="image/*" name="file-absensi-input">
                                            <br>
                                            <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/kawasan/perencanaan/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uploaded-file-absensi" name="uploaded-file-absensi" value="{{$uri_img_absensi}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">delete</button>
                                        </div>
                                    </div>
                                    <!--<div class="form-group striped-col">
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
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/main/perencanaan/infra/amdal" type="button" class="btn btn-effect-ripple btn-danger">
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
<script>
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
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/perencanaan/infra/amdal/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/perencanaan/infra/amdal";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });

        $("#file-document-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        });

        $("#file-absensi-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        });

        $("#select-paket_kerja_kontraktor-input").select2({
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
    });
</script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
