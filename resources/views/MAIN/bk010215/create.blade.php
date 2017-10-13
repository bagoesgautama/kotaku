@extends('MAIN/default') {{-- Page title --}} @section('title') Informasi Umum Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kelurahan/info">
                    Persiapan / Kelurahan / Informasi Umum
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
                                <label class="col-sm-3 control-label">Propinsi</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="kode-prop-input" name="kode-prop-input" class="form-control" size="1" required>
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
                                        @foreach ($kode_faskel_list as $kfl)
                                            <option value="{{$kfl->kode}}" {!! $kode_faskel==$kfl->kode ? 'selected':'' !!}>{{$kfl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Wilayah</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Propinsi</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cw-q-prop" name="cw-q-prop" class="form-control" value="{{$cw_q_prop}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kota</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cw-q-kota" name="cw-q-kota" class="form-control" value="{{$cw_q_kota}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Administrasi</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kecamatan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="ca-q-kec" name="ca-q-kec" class="form-control" value="{{$ca_q_kec}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kelurahan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="ca-q-kel" name="ca-q-kel" class="form-control" value="{{$ca_q_kel}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Dusun</label>
                                <div class="col-sm-6">
                                    <input type="number" id="ca-q-dusun" name="ca-q-dusun" class="form-control" value="{{$ca_q_dusun}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah RW</label>
                                <div class="col-sm-6">
                                    <input type="number" id="ca-q-rw" name="ca-q-rw" class="form-control" value="{{$ca_q_rw}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah RT</label>
                                <div class="col-sm-6">
                                    <input type="number" id="ca-q-rt" name="ca-q-rt" class="form-control" value="{{$ca_q_rt}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Wilayah</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Wilayah Administratif (Ha)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-wil-adm" name="lw-l-wil-adm" class="form-control" value="{{$lw_l_wil_adm}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Wilayah Administratif (Ha) Kota/Kab.</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-wil-adm-kota" name="lw-l-wil-adm-kota" class="form-control" value="{{$lw_l_wil_adm_kota}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Wilayah Administratif (Ha) Kelurahan.</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-wil-adm-kel" name="lw-l-wil-adm-kel" class="form-control" value="{{$lw_l_wil_adm_kel}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Permukiman (Ha)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-pmkm" name="lw-l-pmkm" class="form-control" value="{{$lw_l_pmkm}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Permukiman (Ha) Kota/Kab.</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-pmkm-kota" name="lw-l-pmkm-kota" class="form-control" value="{{$lw_l_pmkm_kota}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Permukiman (Ha) Kelurahan.</label>
                                <div class="col-sm-6">
                                    <input type="number" id="lw-l-pmkm-kel" name="lw-l-pmkm-kel" class="form-control" value="{{$lw_l_pmkm_kel}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Penduduk</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Penduduk</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-q-pdk" name="cp-q-pdk" class="form-control" value="{{$cp_q_pdk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Penduduk Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-q-pdk-w" name="cp-q-pdk-w" class="form-control" value="{{$cp_q_pdk_w}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Keluarga</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-q-kk" name="cp-q-kk" class="form-control" value="{{$cp_q_kk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Rumah Tangga MBR (baseline)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-q-kk-mbr" name="cp-q-kk-mbr" class="form-control" value="{{$cp_q_kk_mbr}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Keluarga Miskin (PPLS/40% termiskin ver BPS)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-q-kk-miskin" name="cp-q-kk-miskin" class="form-control" value="{{$cp_q_kk_miskin}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kepadatan Penduduk Rata-rata</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-r-pdt-kpdk" name="cp-r-pdt-kpdk" class="form-control" value="{{$cp_r_pdt_kpdk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Angka Pertumbuhan Penduduk Pertahun</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cp-t-pdk-thn" name="cp-t-pdk-thn" class="form-control" value="{{$cp_t_pdk_thn}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Kawasan Kumuh (Kota/Kab)</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Dasar Hukum</label>
                                <div class="col-sm-6">
                                    <input type="text" id="km-ds-hkm" name="km-ds-hkm" class="form-control" value="{{$km_ds_hkm}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kawasan Pemukiman Kumuh</label>
                                <div class="col-sm-6">
                                    <input type="number" id="km-q-kw-kmh" name="km-q-kw-kmh" class="form-control" value="{{$km_q_kw_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kecamatan Yang Memiliki Kawasan Kumuh</label>
                                <div class="col-sm-6">
                                    <input type="number" id="km-q-kec-kmh" name="km-q-kec-kmh" class="form-control" value="{{$km_q_kec_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kelurahan Yang Termasuk Kawasan Kumuh</label>
                                <div class="col-sm-6">
                                    <input type="number" id="km-q-kel-kmh" name="km-q-kel-kmh" class="form-control" value="{{$km_q_kel_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah RT Kumuh</label>
                                <div class="col-sm-6">
                                    <input type="number" id="km-q-rt-kmh" name="km-q-rt-kmh" class="form-control" value="{{$km_q_rt_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah RT Non Kumuh</label>
                                <div class="col-sm-6">
                                    <input type="number" id="km-q-rt-non-kmh" name="km-q-rt-non-kmh" class="form-control" value="{{$km_q_rt_non_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Luas Kawasan Kumuh (Kota/Kab)</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas Kawasan Kumuh (Ha)</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lk-l-kw-kmh" name="lk-l-kw-kmh" class="form-control" value="{{$lk_l_kw_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Luas RT Kumuh Pada Tingkat RT Pada Tahun Berjalan (Ha)</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lk-l-rt-kmh" name="lk-l-rt-kmh" class="form-control" value="{{$lk_l_rt_kmh}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Penduduk di Kawasan Umum</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Penduduk</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-q-pdk" name="cpk-q-pdk" class="form-control" value="{{$cpk_q_pdk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Penduduk Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-q-pdk-w" name="cpk-q-pdk-w" class="form-control" value="{{$cpk_q_pdk_w}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Keluarga</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-q-kk" name="cpk-q-kk" class="form-control" value="{{$cpk_q_kk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Rumah Tangga MBR (baseline)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-q-kk-mbr" name="cpk-q-kk-mbr" class="form-control" value="{{$cpk_q_kk_mbr}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Kepala Keluarga Miskin (PPLS/40% termiskin ver BPS)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-q-kk-miskin" name="cpk-q-kk-miskin" class="form-control" value="{{$cpk_q_kk_miskin}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kepadatan Penduduk Rata-rata</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-r-pdt-kpdk" name="cpk-r-pdt-kpdk" class="form-control" value="{{$cpk_r_pdt_kpdk}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Angka Pertumbuhan Penduduk Pertahun</label>
                                <div class="col-sm-6">
                                    <input type="number" id="cpk-t-pdk-thn" name="cpk-t-pdk-thn" class="form-control" value="{{$cpk_t_pdk_thn}}">
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
                                    <a href="/main/persiapan/kelurahan/info" type="button" class="btn btn-effect-ripple btn-danger">
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
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-dokumen-input', file_dokumen);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('uploaded-file-dokumen', $('#uploaded-file-dokumen').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('kode-prop-input', $('#kode-prop-input').val());
            form_data.append('kode-kota-input', $('#select-kode-kota-input').val());
            form_data.append('kode-kec-input', $('#select-kode-kec-input').val());
            form_data.append('kode-kel-input', $('#select-kode-kel-input').val());
            form_data.append('kode-kmw-input', $('#select-kode-kmw-input').val());
            form_data.append('kode-korkot-input', $('#select-kode-korkot-input').val());
            form_data.append('kode-faskel-input', $('#select-kode-faskel-input').val());
            form_data.append('cw-q-prop', $('#cw-q-prop').val());
            form_data.append('cw-q-kota', $('#cw-q-kota').val());
            form_data.append('ca-q-kec', $('#ca-q-kec').val());
            form_data.append('ca-q-kel', $('#ca-q-kel').val());
            form_data.append('ca-q-dusun', $('#ca-q-dusun').val());
            form_data.append('ca-q-rw', $('#ca-q-rw').val());
            form_data.append('ca-q-rt', $('#ca-q-rt').val());
            form_data.append('lw-l-wil-adm', $('#lw-l-wil-adm').val());
            form_data.append('lw-l-wil-adm-kota', $('#lw-l-wil-adm-kota').val());
            form_data.append('lw-l-wil-adm-kel', $('#lw-l-wil-adm-kel').val());
            form_data.append('lw-l-pmkm', $('#lw-l-pmkm').val());
            form_data.append('lw-l-pmkm-kota', $('#lw-l-pmkm-kota').val());
            form_data.append('lw-l-pmkm-kel', $('#lw-l-pmkm-kel').val());
            form_data.append('cp-q-pdk', $('#cp-q-pdk').val());
            form_data.append('cp-q-pdk-w', $('#cp-q-pdk-w').val());
            form_data.append('cp-q-kk', $('#cp-q-kk').val());
            form_data.append('cp-q-kk-mbr', $('#cp-q-kk-mbr').val());
            form_data.append('cp-q-kk-miskin', $('#cp-q-kk-miskin').val());
            form_data.append('cp-r-pdt-kpdk', $('#cp-r-pdt-kpdk').val());
            form_data.append('cp-t-pdk-thn', $('#cp-t-pdk-thn').val());
            form_data.append('km-ds-hkm', $('#km-ds-hkm').val());
            form_data.append('km-q-kw-kmh', $('#km-q-kw-kmh').val());
            form_data.append('km-q-kec-kmh', $('#km-q-kec-kmh').val());
            form_data.append('km-q-kel-kmh', $('#km-q-kel-kmh').val());
            form_data.append('km-q-rt-kmh', $('#km-q-rt-kmh').val());
            form_data.append('km-q-rt-non-kmh', $('#km-q-rt-non-kmh').val());
            form_data.append('lk-l-kw-kmh', $('#lk-l-kw-kmh').val());
            form_data.append('lk-l-rt-kmh', $('#lk-l-rt-kmh').val());
            form_data.append('cpk-q-pdk', $('#cpk-q-pdk').val());
            form_data.append('cpk-q-pdk-w', $('#cpk-q-pdk-w').val());
            form_data.append('cpk-q-kk', $('#cpk-q-kk').val());
            form_data.append('cpk-q-kk-mbr', $('#cpk-q-kk-mbr').val());
            form_data.append('cpk-q-kk-miskin', $('#cpk-q-kk-miskin').val());
            form_data.append('cpk-r-pdt-kpdk', $('#cpk-r-pdt-kpdk').val());
            form_data.append('cpk-t-pdk-thn', $('#cpk-t-pdk-thn').val());
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
            "url": "/main/persiapan/kelurahan/info/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/kelurahan/info";
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
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-kel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-korkot-input").select2({
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
