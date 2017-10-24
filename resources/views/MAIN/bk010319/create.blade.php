@extends('MAIN/default') {{-- Page title --}} @section('title') Rencana Kegiatan Skala kelurahan Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/perencanaan/kelurahan/kegiatan">
                    Perencanaan / Rencana Kelurahan / Rencana Kegiatan Skala kelurahan
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
                                        Data Kegiatan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Data Nilai/Biaya
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Target Penerima Manfaat
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
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                        <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" required maxlength="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Skala Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="skala_kegiatan" name="skala_kegiatan" class="form-control" size="1" required>
                                                <option value="2" {!! $skala_kegiatan=='2' ? 'selected':'' !!}>Desa/Kelurahan</option>
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
                                            <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1">
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
                                            <select id="select-kode-kel-input" name="kode-kel-input" class="form-control select2" size="1">
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
                                            <select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1">
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
                                        <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control" size="1" required>
                                                <option value="0" {!! $jenis_kegiatan=='0' ? 'selected':'' !!}>Non Bergulir</option>
                                                <option value="1" {!! $jenis_kegiatan=='1' ? 'selected':'' !!}>Bergulir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">No Proposal</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="no_proposal" name="no_proposal" class="form-control" value="{{$no_proposal}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Proposal</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="tgl_proposal" name="tgl_proposal" placeholder="Tanggal Proposal" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_proposal}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tahun Anggaran</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="thn_anggaran" name="thn_anggaran" class="form-control" value="{{$thn_anggaran}}" maxlength="4" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kategori Penanganan</label>
                                        <div class="col-sm-6">
                                            <select id="kategori_penanganan" name="kategori_penanganan" class="form-control" size="1" required>
                                                <option value="0" {!! $kategori_penanganan=='0' ? 'selected':'' !!}>Rehab</option>
                                                <option value="1" {!! $kategori_penanganan=='1' ? 'selected':'' !!}>Baru</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="jenis_komponen_keg" name="jenis_komponen_keg" class="form-control" size="1" required>
                                                <option value="L" {!! $jenis_komponen_keg=='L' ? 'selected':'' !!}>Lingkungan</option>
                                                <option value="S" {!! $jenis_komponen_keg=='S' ? 'selected':'' !!}>Sosial</option>
                                                <option value="E" {!! $jenis_komponen_keg=='E' ? 'selected':'' !!}>Ekonomi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Sub Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-subkomponen-input" name="kode-subkomponen-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_subkomponen_list as $ksl)
                                                    <option value="{{$ksl->id}}" {!! $id_subkomponen==$ksl->id ? 'selected':'' !!}>{{$ksl->kode_subkomponen.' '.$ksl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Sub Detail Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-subdtlkomponen-input" name="kode-subdtlkomponen-input" class="form-control select2" size="1">
                                                <option value>Please select</option>
                                                @foreach ($kode_subdtlkomponen_list as $ksl)
                                                    <option value="{{$ksl->id}}" {!! $id_dtl_subkomponen==$ksl->id ? 'selected':'' !!}>{{$ksl->kode_dtl_subkomponen.' '.$ksl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Volume Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="dk_vol_kegiatan" name="dk_vol_kegiatan" class="form-control" value="{{$dk_vol_kegiatan}}" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Satuan (Meter/Unit/m<sup>2</sup>)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="dk_satuan" name="dk_satuan" class="form-control" value="{{$dk_satuan}}" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan (Dusun/Lingkungan/RT/RW)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="dk_lok_kegiatan" name="dk_lok_kegiatan" class="form-control" value="{{$dk_lok_kegiatan}}" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Verifikasi usulan Kegiatan & Dinyatakan Layak</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="dk_tgl_verifikasi" name="dk_tgl_verifikasi" placeholder="Tanggal Verifikasi Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$dk_tgl_verifikasi}}">
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">APBN (PUPR)</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">NSUP (BDI Kolaborasi)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_bdi_kolab" name="nb_a_pupr_bdi_kolab" class="form-control" value="{{$nb_a_pupr_bdi_kolab}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">NSUP (BDI PLPBK)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_bdi_plbk" name="nb_a_pupr_bdi_plbk" class="form-control" value="{{$nb_a_pupr_bdi_plbk}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">NSUP (BDI Lain)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_bdi_lain" name="nb_a_pupr_bdi_lain" class="form-control" value="{{$nb_a_pupr_bdi_lain}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">NSUP 2(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_nsup2" name="nb_a_pupr_nsup2" class="form-control" value="{{$nb_a_pupr_nsup2}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Direktorat PKP(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_dir_pkp" name="nb_a_pupr_dir_pkp" class="form-control" value="{{$nb_a_pupr_dir_pkp}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Direktorat Lain(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_a_pupr_dir_pkp_lain" name="nb_a_pupr_dir_pkp_lain" class="form-control" value="{{$nb_a_pupr_dir_pkp_lain}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;"></label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBN(K/L Lain)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_kl_lain" name="nb_apbn_kl_lain" class="form-control" value="{{$nb_apbn_kl_lain}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBD Provinsi(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_prop" name="nb_apbd_prop" class="form-control" value="{{$nb_apbd_prop}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBD Kab/Kota/BUMD(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_kota" name="nb_apbd_kota" class="form-control" value="{{$nb_apbd_kota}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">DAK(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_dak" name="nb_dak" class="form-control" value="{{$nb_dak}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Hibah(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_hibah" name="nb_hibah" class="form-control" value="{{$nb_hibah}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Non Pemerintah(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_non_gov" name="nb_non_gov" class="form-control" value="{{$nb_non_gov}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Masyarakat(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_masyarakat" name="nb_masyarakat" class="form-control" value="{{$nb_masyarakat}}" maxlength="27" placeholder="Nilai">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lainnya(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_lainnya" name="nb_lainnya" class="form-control" value="{{$nb_lainnya}}" maxlength="27" placeholder="Nilai">
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Jiwa</label></div>
                                    </div>
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
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Kepala Keluarga</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">MBR</label>
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
                            <a href="/main/perencanaan/kelurahan/kegiatan" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/perencanaan/kelurahan/kegiatan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/perencanaan/kelurahan/kegiatan";
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
            placeholder: "Please Select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kmw-input").select2({
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
        $("#select-kode-faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-subkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-subdtlkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
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
        var kec = $('#select-kode-kec-input');
        var kel = $('#select-kode-kel-input');
        var faskel = $('#select-kode-faskel-input');
        var subkomponen = $('#select-kode-subkomponen-input');
        var dtlsubkomponen = $('#select-kode-subdtlkomponen-input');
        var kmw_id,kota_id,korkot_id,kec_id,kel_id,faskel_id,subkomponen_id,dtlsubkomponen_id;
        var kode_kmw = {!! json_encode($kode_kmw) !!};
        var kode_kota = {!! json_encode($kode_kota) !!};
        var kode_korkot = {!! json_encode($kode_korkot) !!};
        var kode_kec = {!! json_encode($kode_kec) !!};
        var kode_kel = {!! json_encode($kode_kel) !!};
        var kode_faskel = {!! json_encode($kode_faskel) !!};
        var id_subkomponen = {!! json_encode($id_subkomponen) !!};
        var id_dtl_subkomponen = {!! json_encode($id_dtl_subkomponen) !!};

        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=null){
                kota.empty();
                kota.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?kmw="+kmw_id,
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
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?kota_korkot="+kota_id,
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
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?kota_kec="+kota_id,
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
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?kec_kel="+kec_id,
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
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?kel_faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        subkomponen.change(function(){
            subkomponen_id=subkomponen.val();
            if(subkomponen_id!=null){
                dtlsubkomponen.empty();
                dtlsubkomponen.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kelurahan/kegiatan/select?id_subkomponen="+subkomponen_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            dtlsubkomponen.append("<option value="+data[i].id+" >"+data[i].kode_dtl_subkomponen+" "+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
      });
</script>
@stop
