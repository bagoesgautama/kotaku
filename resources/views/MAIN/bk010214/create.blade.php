@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Keberfungsian Forum @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kecamatan/keberfungsian">
                    Persiapan / Kecamatan / Keberfungsian Forum
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
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Forum</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Jenis Forum</label>
                                <div class="col-sm-6">
                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="jns-forum-input" name="jns-forum-input" class="form-control select2" size="1" required>
                                        <option value>Please Select</option>
                                        <option value="1" {!! $jns_forum=='1' ? 'selected':'' !!}>BKM/LKM Tingkat Kota</option>
                                        <option value="2" {!! $jns_forum=='2' ? 'selected':'' !!}>Kolaborasi Tingkat Kota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col" id="bkm_label" {!! $jns_forum==1?'':'hidden'!!}>
                                <label class="col-sm-3 control-label">Forum BKM</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-bkm-input" name="kode-bkm-input" class="form-control select2" size="1">
                                        <option value=null>Please Select</option>
                                        @foreach ($kode_bkm_list as $kbl)
                                            <option value="{{$kbl->kode}}" {!! $kode_bkm==$kbl->kode ? 'selected':'' !!}>{{$kbl->tahun.'-'.$kbl->nama_kota."-".$kbl->nama_kec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col" id="kolab_label" {!! $jns_forum==2?'':'hidden'!!}>
                                <label class="col-sm-3 control-label">Forum Kolaborasi</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kolab-input" name="kode-kolab-input" class="form-control select2" size="1">
                                        <option value=null>Please Select</option>
                                        @foreach ($kode_kolab_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kolab==$kkl->kode ? 'selected':'' !!}>{{$kkl->tahun.'-'.$kkl->nama_kota.'-'.$kkl->nama_kec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kode kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="kode-keg-input" name="kode-keg-input" class="form-control" size="1" required>
                                        <option value="0" {!! $kode_kegiatan=='0' ? 'selected':'' !!}>Rapat Internal</option>
                                        <option value="1" {!! $kode_kegiatan=='1' ? 'selected':'' !!}>Rapat Dengan Pemda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" data-bv-callback="true" data-bv-callback-message="Tanggal lebih kecil dari BKM/Forum Kolaborasi yang dipilih atau melebihi tanggal sekarang." data-bv-callback-callback="tgl">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_p}}" data-bv-callback="true" data-bv-callback-message="Jumlah peserta melebihi dari peserta BKM/Forum Kolaborasi yang dipilih." data-bv-callback-callback="laki">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_w}}" data-bv-callback="true" data-bv-callback-message="Jumlah peserta melebihi dari peserta BKM/Forum Kolaborasi yang dipilih." data-bv-callback-callback="perempuan">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Pemda</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-pemda-input" name="q-pemda-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_pemda}}" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kecamatan/forum/keberfungsian/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/kecamatan/forum/keberfungsian/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kota/forum/forum_f" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
									@if ($detil_menu=='172' || $detil_menu=='173')
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
									@endif
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
<script>
    function check(value, validator) {
        
        var p = parseInt($('#q-laki-input').val());
        var w = parseInt($('#q-perempuan-input').val());

        var pemda = parseInt($('#q-pemda-input').val())|| 0;
        var sum = p+w;
        var res = true;
        if(pemda>sum){
            res=false;
        }else if(p==0 && w==0){
            res=false;
        }

        return res;
    };
    function laki(value, validator) {
        var bkm = {!! json_encode($kode_bkm_list) !!};
        for(var i=0;i<bkm.length;i++){
            if(bkm[i].kode==$('#select-kode-bkm-input').val()){
                bkm=bkm[i];
                break;
            }
        }
        var kolab = {!! json_encode($kode_kolab_list) !!};
        for(var i=0;i<kolab.length;i++){
            if(kolab[i].kode==$('#select-kode-kolab-input').val()){
                kolab=kolab[i];
                break;
            }
        }
        
        var p = parseInt($('#q-laki-input').val());
        var w = parseInt($('#q-perempuan-input').val());

        var pemda = parseInt($('#q-pemda-input').val())|| 0;
        var sum = p+w;
        var res = true;
        if(document.getElementById("bkm_label").style.visibility = "visible"){
            if(bkm.q_anggota_p<p){
                res=false;
            }
        }else if(document.getElementById("kolab_label").style.visibility = "visible"){
            if(kolab.q_anggota_p<p){
                res=false;
            }
        }

        return res;
    };
    function perempuan(value, validator) {
        var bkm = {!! json_encode($kode_bkm_list) !!};
        for(var i=0;i<bkm.length;i++){
            if(bkm[i].kode==$('#select-kode-bkm-input').val()){
                bkm=bkm[i];
                break;
            }
        }
        var kolab = {!! json_encode($kode_kolab_list) !!};
        for(var i=0;i<kolab.length;i++){
            if(kolab[i].kode==$('#select-kode-kolab-input').val()){
                kolab=kolab[i];
                break;
            }
        }
        
        var p = parseInt($('#q-laki-input').val());
        var w = parseInt($('#q-perempuan-input').val());

        var pemda = parseInt($('#q-pemda-input').val())|| 0;
        var sum = p+w;
        var res = true;
        if(document.getElementById("bkm_label").style.visibility = "visible"){
            if(bkm.q_anggota_w<w){
                res=false;
            }
        }else if(document.getElementById("kolab_label").style.visibility = "visible"){
            if(kolab.q_anggota_w<w){
                res=false;
            }
        }

        return res;
    };

    function tgl(value, validator) {
        var bkm = {!! json_encode($kode_bkm_list) !!};
        for(var i=0;i<bkm.length;i++){
            if(bkm[i].kode==$('#select-kode-bkm-input').val()){
                bkm=bkm[i];
                break;
            }
        }
        var kolab = {!! json_encode($kode_kolab_list) !!};
        for(var i=0;i<kolab.length;i++){
            if(kolab[i].kode==$('#select-kode-kolab-input').val()){
                kolab=kolab[i];
                break;
            }
        }

        var res = true;
        var tgl_kegiatan = new Date($('#tgl-kegiatan-input').val());
        if(tgl_kegiatan>new Date()){
            res=false;
        }
        if(document.getElementById("bkm_label").style.visibility = "visible"){
            if(new Date(bkm.tgl_kegiatan)>tgl_kegiatan){
                res=false;
            }
        }
        if(document.getElementById("kolab_label").style.visibility = "visible"){
            if(new Date(kolab.tgl_kegiatan)>tgl_kegiatan){
                res=false;
            }
        }
        return res;
    };
    $(document).ready(function () {
	  	
        $("#select-kode-bkm-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode-kolab-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#jns-forum-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#kode-keg-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $('#tgl-kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form').bootstrapValidator('revalidateField', 'tgl-kegiatan-input');
                $("#submit").prop('disabled', false);
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
                    "url": "/main/persiapan/kecamatan/keberfungsian/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/kecamatan/keberfungsian";
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
        
        var jns_forum = $('#jns-forum-input');
        var bkm_label = $('#bkm_label');
        var kolab_label = $('#kolab_label');
        var bkm = $('#select-kode-bkm-input');
        var kolab = $('#select-kode-kolab-input');
        var jns_forum_id;
        var kode_bkm = {!! json_encode($kode_bkm) !!};
        var kode_kolab = {!! json_encode($kode_kolab) !!};

        jns_forum.change(function(){
            jns_forum_id=jns_forum.val();
            if(jns_forum_id!=null && jns_forum_id=='1'){
                bkm_label.prop('hidden', false);
                kolab_label.prop('hidden', true);
                kolab.val(kode_kolab).trigger('change');
            }else if(jns_forum_id!=null && jns_forum_id=='2'){
                kolab_label.prop('hidden', false);
                bkm_label.prop('hidden', true);
                bkm.val(kode_bkm).trigger('change');
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
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>

@stop
