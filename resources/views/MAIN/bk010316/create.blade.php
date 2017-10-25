@extends('MAIN/default') {{-- Page title --}} @section('title') Rencana Penanganan Kumuh Kelurahan Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/perencanaan/kelurahan/penanganan_kumuh">
                    Perencanaan / Rencana Kelurahan / Rencana Penanganan Kumuh Kelurahan
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
                                        Kategori Lokasi Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Karakteristik Kelurahan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Profile Kumuh Kelurahan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Tingkat Kekumuhan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                        Aspek Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab7" data-toggle="tab">
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
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                        <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" required maxlength="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Propinsi</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-prop-input" name="kode-prop-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_prop_list as $kpl)
                                                    <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">KMW</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1" required>
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
                                            <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" required>
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
                                            <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_korkot_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kecamatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_kec_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kelurahan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kel-input" name="kode-kel-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_kel_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Faskel</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_faskel_list as $kfl)
                                                    <option value="{{$kfl->kode}}" {!! $kode_faskel==$kfl->kode ? 'selected':'' !!}>{{$kfl->nama}}</option>
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Lokasi Peningkatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="klk-q-peningkatan" name="klk-q-peningkatan" class="form-control" value="{{$klk_q_peningkatan}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Lokasi Pencegahan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="klk-q-pencegahan" name="klk-q-pencegahan" class="form-control" value="{{$klk_q_pencegahan}}" maxlength="6" placeholder="Jumlah">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kecamatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-kec" name="kl-q-kec" class="form-control" value="{{$kl_q_kec}}" maxlength="11" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kelurahan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-kel" name="kl-q-kel" class="form-control" value="{{$kl_q_kel}}" maxlength="11" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk (Jiwa)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-pddk" name="kl-q-pddk" class="form-control" value="{{$kl_q_pddk}}" maxlength="11" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk Perempuan (Jiwa)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-pddk-w" name="kl-q-pddk-w" class="form-control" value="{{$kl_q_pddk_w}}" maxlength="11" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Penduduk MBR</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-pddk-mbr" name="kl-q-pddk-mbr" class="form-control" value="{{$kl_q_pddk_mbr}}" maxlength="11" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kepala Keluarga Miskin (40% termiskin, data BPJS)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-q-kk-miskin" name="kl-q-kk-miskin" class="form-control" value="{{$kl_q_kk_miskin}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kepadatan Penduduk (Jiwa/Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-kpdt-pddk" name="kl-kpdt-pddk" class="form-control" value="{{$kl_kpdt_pddk}}" maxlength="9" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kepadatan Bangunan rata-rata (Unit Bangunan/Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="kl-kpdt-bangunan" name="kl-kpdt-bangunan" class="form-control" value="{{$kl_kpdt_bangunan}}" maxlength="9" placeholder="Jumlah">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas Kawasan Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkk-l-kmh" name="pkk-l-kmh" class="form-control" value="{{$pkk_l_kmh}}" maxlength="9" placeholder="Luas">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah RT Kumuh Pada Tahun Berjalan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkk-q-rt-kmh-thn-curr" name="pkk-q-rt-kmh-thn-curr" class="form-control" value="{{$pkk_q_rt_kmh_thn_curr}}" maxlength="5" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Luas RT Kumuh Pada Tahun Berjalan (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="pkk-l-rt-kmh-thn-curr" name="pkk-l-rt-kmh-thn-curr" class="form-control" value="{{$pkk_l_rt_kmh_thn_curr}}" maxlength="9" placeholder="Luas">
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Non Kumuh (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-non-kmh-l-wil" name="tk-non-kmh-l-wil" class="form-control" value="{{$tk_non_kmh_l_wil}}" maxlength="9" placeholder="Luas (Ha)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-non-kmh-q-rt" name="tk-non-kmh-q-rt" class="form-control" value="{{$tk_non_kmh_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Berat (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-berat-l-wil" name="tk-berat-l-wil" class="form-control" value="{{$tk_berat_l_wil}}" maxlength="9" placeholder="Luas (Ha)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-berat-q-rt" name="tk-berat-q-rt" class="form-control" value="{{$tk_berat_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sedang (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-sedang-l-wil" name="tk-sedang-l-wil" class="form-control" value="{{$tk_sedang_l_wil}}" maxlength="9" placeholder="Luas (Ha)">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-sedang-q-rt" name="tk-sedang-q-rt" class="form-control" value="{{$tk_sedang_q_rt}}" maxlength="9" placeholder="Jumlah RT">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Ringan (*)</label>
                                        <div class="col-sm-3">
                                            <input type="number" id="tk-ringan-l-wil" name="tk-ringan-l-wil" class="form-control" value="{{$tk_ringan_l_wil}}" maxlength="9" placeholder="Luas (Ha)">
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
                                    <div class="form-group striped-col">
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
                                    <div class="form-group striped-col">
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
                                    <div class="form-group striped-col">
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
                                    <div class="form-group striped-col">
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
                                    <div class="form-group striped-col">
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
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Dokumen</label>
                                        <div class="col-sm-6">
                                            <input id="file-dokumen-input" type="file" class="file" data-show-preview="false" name="file-dokumen-input">
                                            <br>
                                            <input type="text" class="btn btn-warning btn-modify" id="uploaded-file-dokumen" name="uploaded-file-dokumen" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!} readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                            <br>
                                            <input type="text" class="btn btn-warning btn-modify" id="uploaded-file-absensi" name="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} readonly>
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
                            <a href="/main/perencanaan/kelurahan/penanganan_kumuh" type="button" class="btn btn-effect-ripple btn-danger">
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
<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>
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
            "url": "/main/perencanaan/kelurahan/penanganan_kumuh/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/perencanaan/kelurahan/penanganan_kumuh";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
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

        var prop = $('#select-kode-prop-input');
        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kec = $('#select-kode-kec-input');
        var kel = $('#select-kode-kel-input');
        var faskel = $('#select-kode-faskel-input');
        var prop_id,kmw_id,kota_id,korkot_id,kec_id,kel_id,faskel_id;

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=null){
                kmw.empty();
                kmw.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?prop="+prop_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=null){
                kota.empty();
                kota.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?kmw="+kmw_id,
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
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?kota_korkot="+kota_id,
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
                kec.empty();
                kec.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?kota_kec="+kota_id,
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
            if(kec_id!=null){
                kel.empty();
                kel.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?kec_kel="+kec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kel.change(function(){
            kel_id=kel.val();
            if(kel_id!=null){
                faskel.empty();
                faskel.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/penanganan_kumuh/select?kel_faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

      });
</script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
