@extends('MAIN/default') {{-- Page title --}} @section('title') Operasional Pemeliharaan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
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
                <a href="/main/keberlanjutan/kota/operasional">
                    Keberlanjutan / Skala Kota / Operasional Pemeliharaan
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
                                        Data Realisasi Kegiatan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Umum
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Data Serah Terima Aset & Sertifikasi
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Operasional Pemeliharaan
                                    </a>
                    </li>
                    <!-- <li>
                        <a href="#tab12" data-toggle="tab">
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
                                        <label class="col-sm-3 control-label">Data Realisasi Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <select id="select-kode-parent-input" name="kode-parent-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_parent_list as $kpl)
                                                    <option value="{{$kpl->kode}}" {!! $kode_real_keg==$kpl->kode ? 'selected':'' !!}>{{$kpl->jenis_komponen_keg.$kpl->usulan_komponen.'-'.$kpl->nama_subkomponen.'-'.$kpl->nama_dtl_subkomponen.'-'.$kpl->nama_kota.'-'.$kpl->nama_kawasan}}</option>
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
                                        <label class="col-sm-3 control-label">Skala kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="skala_kegiatan" name="skala_kegiatan" class="form-control" size="1" readonly disabled>
                                                <option value="1" {!! $jns_sumber_dana=='1' ? 'selected':'' !!}>Kota/Kabupaten</option>
                                                <option value="2" {!! $jns_sumber_dana=='1' ? 'selected':'' !!}>Desa/Kelurahan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Sumber Dana</label>
                                        <div class="col-sm-6">
                                            <select id="jns_sumber_dana" name="jns_sumber_dana" class="form-control" size="1" readonly disabled>
                                                <option value="1" {!! $jns_sumber_dana=='1' ? 'selected':'' !!}>BDI/Non BDI</option>
                                                <option value="2" {!! $jns_sumber_dana=='2' ? 'selected':'' !!}>Non BDI Kolaborasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tahun-keg-input" name="tahun-keg-input" placeholder="Tahun" value="{{$tahun_keg}}" readonly maxlength="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">KMW</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1" readonly value="{{$kode_kmw}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kota</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" readonly value="{{$kode_kota}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Korkot</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1" readonly value="{{$kode_korkot}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Kawasan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="select-kode-kawasan-input" name="kode-kawasan-input" class="form-control select2" size="1" readonly value="{{$kode_kawasan}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">KSM</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="select-kode-ksm-input" name="id_ksm" class="form-control select2" size="1" readonly value="{{$id_ksm}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Realisasi</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="tgl_realisasi" name="tgl_realisasi" placeholder="Tanggal Realisasi" value="{{$tgl_realisasi}}" readonly>
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
                                        <label class="col-sm-3 control-label" for="example-text-input1">Serah Terima Aset</label>
                                        <div class="col-sm-6">
                                            <select id="flag_sudah_sertias" name="flag_sudah_sertias" class="form-control" size="1" readonly disabled>
                                                <option value="0" {!! $flag_sudah_sertias==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $flag_sudah_sertias==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Serah Terima Aset</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="tgl_sertias" name="tgl_sertias" placeholder="Tanggal Serah Terima Aset" value="{{$tgl_sertias}}" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Sertifikasi</label>
                                        <div class="col-sm-6">
                                            <select id="hasil_sertifikasi" name="hasil_sertifikasi" class="form-control" size="1" readonly disabled>
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
                    <div id="tab4" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="kode">Tahun O & P</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" required maxlength="4" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Infrastruktur yang Masih Berfungsi dan Dimanfaatkan</label></div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan yang Masih Ada</label>
                                        <div class="col-sm-6">
                                            <select id="kkp_flag_bgn_msh_ada" name="kkp_flag_bgn_msh_ada" class="form-control" size="1">
                                                <option value="0" {!! $kkp_flag_bgn_msh_ada==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kkp_flag_bgn_msh_ada==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Dengan Kondisi Baik</label>
                                        <div class="col-sm-6">
                                            <select id="kkp_flag_bgn_msh_baik" name="kkp_flag_bgn_msh_baik" class="form-control" size="1">
                                                <option value="0" {!! $kkp_flag_bgn_msh_baik==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kkp_flag_bgn_msh_baik==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan masih Berfungsi</label>
                                        <div class="col-sm-6">
                                            <select id="kkp_flag_bgn_msh_fungsi" name="kkp_flag_bgn_msh_fungsi" class="form-control" size="1">
                                                <option value="0" {!! $kkp_flag_bgn_msh_fungsi==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kkp_flag_bgn_msh_fungsi==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan masih Dimanfaatkan</label>
                                        <div class="col-sm-6">
                                            <select id="kkp_flag_bgn_msh_man" name="kkp_flag_bgn_msh_man" class="form-control" size="1">
                                                <option value="0" {!! $kkp_flag_bgn_msh_man==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kkp_flag_bgn_msh_man==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Bangunan Dikembangkan/Ditingkatkan</label>
                                        <div class="col-sm-6">
                                            <select id="kkp_flag_bgn_msh_dev" name="kkp_flag_bgn_msh_dev" class="form-control" size="1">
                                                <option value="0" {!! $kkp_flag_bgn_msh_dev==0 ? 'selected':'' !!}>Tidak</option>
                                                <option value="1" {!! $kkp_flag_bgn_msh_dev==1 ? 'selected':'' !!}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="tab12" class="tab-pane fade ">
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
                            <a href="/main/keberlanjutan/kota/operasional" type="button" class="btn btn-effect-ripple btn-danger">
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

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>

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
<script>
      $(document).ready(function () {
        $('.ui-pnotify').remove();

        $('#form').on('submit', function (e) {
            var form_data = new FormData(this);
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/keberlanjutan/kota/operasional/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/keberlanjutan/kota/operasional";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-parent-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

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

        var parent = $('#select-kode-parent-input');
        var tahun = $('#tahun-keg-input');
        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kawasan = $('#select-kode-kawasan-input');
        var kelurahan = $('#select-kode-kel-input');
        var ksm = $('#select-kode-ksm-input');
        var skala_kegiatan = $('#skala_kegiatan');
        var jns_sumber_dana = $('#jns_sumber_dana');
        var tgl_realisasi = $('#tgl_realisasi');
        var tgl_sertias = $('#tgl_sertias');
        var flag_sudah_sertias = $('#flag_sudah_sertias');
        var hasil_sertifikasi = $('#hasil_sertifikasi');
        var parent_id,kmw_id,kota_id,korkot_id;

        parent.change(function(){
            parent_id=parent.val();
            if(parent_id!=null){
                tahun.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/keberlanjutan/kota/operasional/select?kode_parent="+parent_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            tahun.val(data[0].tahun);
                            skala_kegiatan.val((data[0].usulan_skala==null?data[0].skala_kegiatan:data[0].usulan_skala));
                            jns_sumber_dana.val(data[0].jns_sumber_dana);
                            kmw.val(data[0].nama_kmw);
                            kota.val(data[0].nama_kota);
                            korkot.val(data[0].nama_korkot);
                            kawasan.val(data[0].kode_kawasan+' '+data[0].nama_kawasan);
                            kelurahan.val(data[0].nama_kel);
                            ksm.val(data[0].kode_ksm+' '+data[0].nama_ksm);
                            tgl_realisasi.val(data[0].tgl_realisasi);
                            tgl_sertias.val(data[0].tgl_sertias);
                            flag_sudah_sertias.val(data[0].flag_sudah_sertias);
                            hasil_sertifikasi.val(data[0].hasil_sertifikasi);
                        }
                    }
                });
            }
        });
      });
</script>
@stop
