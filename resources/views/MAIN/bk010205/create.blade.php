 @extends('MAIN/default') {{-- Page title --}} @section('title') Main - Informasi Umum @stop {{-- local styles --}} @section('header_styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">

<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" media="all" rel="stylesheet" type="text/css"/>

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
                <a href="/main/persiapan/kota/info">
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading tab-list">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                                        Cakupan Administrasi
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                         Luas Wilayah
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                         Cakupan Penduduk
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Kawasan Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Cakupan Penduduk di Kawasan Kumuh
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                        Data Tambahan
                                    </a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <form id="form-validation" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Pilih Kota</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kode Kota</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <input type="hidden" id="kode_kmw-input" name="kode_kmw-input" value="{{ $kode_kmw }}">
                                            <input type="hidden" id="kode_korkot-input" name="kode_korkot-input" value="{{ $kode_korkot }}">
                                            <input type="hidden" id="kode_prop-input" name="kode_prop-input" value="{{ $kode_prop }}">
                                            <select id="select-kode_kota-input" name="select-kode_kota-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @if ($kode_kota_list!=null)
                                                @foreach ($kode_kota_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Administrasi</label></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah Kecamatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ca_q_kec-input" name="ca_q_kec-input" class="form-control" value="{{$ca_q_kec}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Kelurahan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ca_q_kel-input" name="ca_q_kel-input" class="form-control" value="{{$ca_q_kel}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah Dusun</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ca_q_dusun-input" name="ca_q_dusun-input" class="form-control" value="{{$ca_q_dusun}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah RW</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ca_q_rw-input" name="ca_q_rw-input" class="form-control" value="{{$ca_q_rw}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah RT</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="ca_q_rt-input" name="ca_q_rt-input" class="form-control" value="{{$ca_q_rt}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Luas Wilayah Administratif (Ha) Kota/Kab.</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="lw_l_wil_adm-input" name="lw_l_wil_adm-input" class="form-control" value="{{$lw_l_wil_adm}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Luas Permukiman (Ha) Kota/Kab.</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="lw_l_pmkm-input" name="lw_l_pmkm-input" class="form-control" value="{{$lw_l_pmkm}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Penduduk</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_q_pdk-input" name="cp_q_pdk-input" class="form-control" value="{{$cp_q_pdk}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah Penduduk Perempuan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_q_pdk_w-input" name="cp_q_pdk_w-input" class="form-control" value="{{$cp_q_pdk_w}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Kepala Keluarga</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_q_kk-input" name="cp_q_kk-input" class="form-control" value="{{$cp_q_kk}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah Kepala Rumah Tangga MBR (baseline)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_q_kk_mbr-input" name="cp_q_kk_mbr-input" class="form-control" value="{{$cp_q_kk_mbr}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Kepala Keluarga Miskin (PPLS/40% termiskin ver BPS)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_q_kk_miskin-input" name="cp_q_kk_miskin-input" class="form-control" value="{{$cp_q_kk_miskin}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kepadatan Penduduk Rata-rata</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_r_pdt_kpdk-input" name="cp_r_pdt_kpdk-input" class="form-control" value="{{$cp_r_pdt_kpdk}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Angka Pertumbuhan Penduduk Pertahun</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="cp_t_pdk_thn-input" name="cp_t_pdk_thn-input" class="form-control" value="{{$cp_t_pdk_thn}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Dasar Hukum</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="km_ds_hkm" name="km_ds_hkm" class="form-control" value="{{$km_ds_hkm}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Luas Kawasan Kumuh (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="lk_l_kw_kmh-input" name="lk_l_kw_kmh-input" class="form-control" value="{{$lk_l_kw_kmh}}" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Luas RT Kumuh Pada Tahun Berjalan (Ha)</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="lk_l_rt_kmh-input" name="lk_l_rt_kmh-input" class="form-control" value="{{$lk_l_rt_kmh}}" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Kawasan Pemukiman Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="km_q_kw_kmh-input" name="km_q_kw_kmh-input" class="form-control" value="{{$km_q_kw_kmh}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah Kecamatan Yang Memiliki Kawasan Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="km_q_kec_kmh-input" name="km_q_kec_kmh-input" class="form-control" value="{{$km_q_kec_kmh}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah Kelurahan Yang Termasuk Kawasan Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="km_q_kel_kmh-input" name="km_q_kel_kmh-input" class="form-control" value="{{$km_q_kel_kmh}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Jumlah RT Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="km_q_rt_kmh-input" name="km_q_rt_kmh-input" class="form-control" value="{{$km_q_rt_kmh}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jumlah RT Non Kumuh</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="km_q_rt_non_kmh-input" name="km_q_rt_non_kmh-input" class="form-control" value="{{$km_q_rt_non_kmh}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab6" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                            <br>
                                            <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kota/informasi/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                            <br>
                                            <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/kota/informasi/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/main/persiapan/kota/info" type="button" class="btn btn-effect-ripple btn-danger">
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
function enforce_maxlength(event) {
        var t = event.target;
        if (t.hasAttribute('maxlength')) {
            t.value = t.value.slice(0, t.getAttribute('maxlength'));
        }
    }
        
    document.body.addEventListener('input', enforce_maxlength);
        
    function test(id){
            console.log(id)
            var elem = document.getElementById(id);
            elem.parentNode.removeChild(elem);
            var elem2 = $('#'+id+'-file');
            elem2.removeAttr('value');
            return false;
        }
        
    $(document).ready(function () {

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
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

        $('#form-validation').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form-validation').on('submit', function (e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    type: 'post',
                    processData: false,
                    contentType: false,
                    "url": "/main/persiapan/kota/info/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/kota/info";
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                        $("#submit").prop('disabled', false);
                    }
                });
            });
        });

        var kota = $('#select-kode_kota-input');
        var korkot = $('#kode_korkot-input');
        var rw = $('#ca_q_rw-input');
        var rt = $('#ca_q_rt-input');
        var penduduk = $('#cp_q_pdk-input');
        var penduduk_wanita = $('#cp_q_pdk_w-input');
        var kk = $('#cp_q_kk-input');
        var kk_mbr = $('#cp_q_kk_mbr-input');
        var kk_miskin = $('#cp_q_kk_miskin-input');
        var rt_kmh = $('#km_q_rt_kmh-input');
        var rt_non_kmh = $('#km_q_rt_non_kmh-input');
        var kota_id,kec_id,kel_id;
        
        kota.change(function(){
            korkot.empty();
            kota_id=kota.val();
            console.log(kota_id)
            if(kota_id!=undefined){
                korkot.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kota/info/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.val(data[0].kode_korkot);
                        }
                    }
                });
                rw.empty();
                rt.empty();
                penduduk.empty();
                penduduk_wanita.empty();
                kk.empty();
                kk_mbr.empty();
                kk_miskin.empty();
                rt_kmh.empty();
                rt_non_kmh.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kota/info/select?data_kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            rw.val(data[0].sum_rw);
                            rt.val(data[0].sum_rt);                            
                            penduduk.val(data[0].sum_penduduk);
                            penduduk_wanita.val(data[0].sum_penduduk_wanita);
                            kk.val(data[0].sum_kk);
                            kk_mbr.val(data[0].sum_kk_mbr);
                            kk_miskin.val(data[0].sum_kk_miskin);
                            rt_kmh.val(data[0].sum_rt_kmh);
                            rt_non_kmh.val(data[0].sum_rw-data[0].sum_rt_kmh);
                        }
                    }
                });
            }
        });
    });
</script>

<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_validations.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>

@stop
