@extends('MAIN/default') {{-- Page title --}} @section('title') Blank @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">@stop {{-- Page Header--}} @section('page-header')
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
                <a href="/main/persiapan/nasional/pokja/kegiatan">
                    Persiapan / Kota atau Kabupaten / Informasi Umum
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
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Kota</label>
                <div class="col-sm-6">
                    <input type="hidden" id="kode_kota" name="kode_kota" value="{{ $kode_kota }}">
                    <select id="kode-kota-input" name="kode-kota-input" class="form-control" size="1">
                        @foreach ($kode_kota_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
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
                <label class="col-sm-3 control-label">Luas Wilayah Administratif (Ha) Kota/Kab.</label>
                <div class="col-sm-6">
                    <input type="number" id="lw-l-wil-adm" name="lw-l-wil-adm" class="form-control" value="{{$lw_l_wil_adm}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Luas Permukiman (Ha) Kota/Kab.</label>
                <div class="col-sm-6">
                    <input type="number" id="lw-l-pmkm" name="lw-l-pmkm" class="form-control" value="{{$lw_l_pmkm}}">
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
                    <input type="text" id="km-ds-hkm" name="km-ds-hkm" class="form-control" value="{{$km_ds_hkm}}">
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
                    <input type="text" id="lk-l-kw-kmh" name="k-l-kw-kmh" class="form-control" value="{{$lk_l_kw_kmh}}">
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
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diser-oleh-input" name="diser-oleh-input" class="form-control" placeholder="Diserahkan Oleh" value="{{$diser_oleh}}" value="{{$diket_tgl}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diket-oleh-input" name="diket-oleh-input" class="form-control" placeholder="Diketahui Oleh" value="{{$diket_oleh}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diver-oleh-input" name="diver-oleh-input" class="form-control" placeholder="Diverifikasi Oleh" value="{{$diver_oleh}}">
                </div>
            </div>
        </div>
    </form>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<!-- <script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/persiapan/propinsi/pokja/kegiatan/create",
            data: $('form').serialize(),
            success: function () {
    alert('From Submitted.');
    window.location.href = "/main/persiapan/propinsi/pokja/kegiatan";
   },
   error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
          });
        });
      });
</script> -->
@stop
