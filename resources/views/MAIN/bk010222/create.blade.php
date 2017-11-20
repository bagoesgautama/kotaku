@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Pemilihan Ulang BKM/LKM @stop {{-- local styles --}}
@section('header_styles')

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
    <h1>Main Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/persiapan/kelurahan/pemilu_bkm/pemilu">
                    Persiapan Kelurahan / Pemilihan Ulang BKM/LKM / Pemilu
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
                        <form id="form-validation" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Umum</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="hidden" id="kode_kmw-input" name="kode_kmw-input" value="{{ $kode_kmw }}">
                                    <input type="hidden" id="kode_korkot-input" name="kode_korkot-input" value="{{ $kode_korkot }}">
                                    <input type="hidden" id="kode_faskel-input" name="kode_faskel-input" value="{{ $kode_faskel }}">
                                    <input type="text" id="utusan_p" name="kode" value="{{ $utusan_p }}">
                                    <input type="text" id="utusan_w" name="kode" value="{{ $utusan_w }}">
                                    <input type="text" id="utusan_mbr" name="kode" value="{{ $utusan_mbr }}">
                                    <input type="text" id="tgl_kegiatan" name="kode" value="{{ $tgl_kegiatan }}">
                                    <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required data-bv-callback="true" data-bv-callback-message="Tahun melebihi current year." data-bv-callback-callback="tahun">
                                        <option value>Please select</option>
                                        @foreach($tahun_list as $list)
                                            <option value="{{ $list->tahun }}" {!! $list->tahun==$tahun?"selected":"" !!}>{{ $list->tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input" required>
                                        <option value="">Please Select</option>
                                        @if ($kode_kota_list!=null)
                                        @foreach ($kode_kota_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input" required>
                                        <option value="">Please Select</option>
                                        @if ($kode_kec_list!=null)
                                        @foreach ($kode_kec_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input" required>
                                        <option value="">Please Select</option>
                                        @if ($kode_kel_list!=null)
                                        @foreach ($kode_kel_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Pemilu</label>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_kegiatan-input" name="tgl_kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Peserta Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_p-input" name="q_peserta_p-input" class="form-control" placeholder="Peserta Pria" value="{{$q_peserta_p}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total utusan laki-laki pada seleksi tingkat basis" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah Peserta Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_w-input" name="q_peserta_w-input" class="form-control" placeholder="Peserta Wanita" value="{{$q_peserta_w}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total utusan laki-laki pada seleksi tingkat basis" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Peserta Miskin/MBR</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_mbr-input" name="q_peserta_mbr-input" class="form-control" placeholder="Peserta MBR" value="{{$q_peserta_mbr}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total peserta laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah Anggota Terpilih Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_terpilih_p-input" name="q_terpilih_p-input" class="form-control" placeholder="Terpilih Pria" value="{{$q_terpilih_p}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota terpilih laki-laki & perempuan" data-bv-callback-callback="check2" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Anggota Terpilih Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_terpilih_w-input" name="q_terpilih_w-input" class="form-control" placeholder="Terpilih Wanita" value="{{$q_terpilih_w}}" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota terpilih laki-laki & perempuan" data-bv-callback-callback="check2" maxlength="5" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jumlah Anggota Terpilih Miskin/MBR</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_terpilih_mbr-input" name="q_terpilih_mbr-input" class="form-control" placeholder="Terpilih MBR" value="{{$q_terpilih_mbr}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota terpilih laki-laki & perempuan" data-bv-callback-callback="check2" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/pemilu_bkm/pemilu/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/pemilu_bkm/pemilu/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/pemilu_bkm/pemilu" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='183' || $detil_menu=='184')
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

@stop {{-- local scripts --}} @section('footer_scripts')
<script>
    function check(value, validator) {
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        var peserta_p = parseInt($('#q_peserta_p-input').val());
        var peserta_w = parseInt($('#q_peserta_w-input').val());
        var utusan_p = parseInt($('#utusan_p').val());
        var utusan_w = parseInt($('#utusan_w').val());
        var utusan_mbr = parseInt($('#utusan_mbr').val());

        var peserta_mbr = parseInt($('#q_peserta_mbr-input').val())|| 0;
        var sum_peserta = peserta_p + peserta_w;
        var sum_peserta_2 = peserta_mbr;
        var res = true;
        if(peserta_p>utusan_p){
            res=false;
        }
        if(peserta_w>utusan_w){
            res=false;
        }
        if(sum_peserta_2>sum_peserta){
            res=false;
        }
        if(peserta_mbr>utusan_mbr){
            res=false;
        }
        if(peserta_p==0 && peserta_w==0){
            res=false;
        } 
        if(thn>yearNow){
            res=false;
        }
        return res;
    };
    
    function tahun(value, validator) {
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        
        var res = true;
        if(thn>yearNow){
            res=false;
        }
        return res;
    };

    function tgl(value, validator) {
        var res = true;
        var tgl_kegiatan = new Date($('#tgl_kegiatan-input').val());
        if(tgl_kegiatan>new Date()){
            res=false;
        }
        return res;
    };

    var peserta_p = $('#q_peserta_p-input');
    var peserta_w = $('#q_peserta_w-input');

        peserta_p.change(function(){
            $('#q_peserta_mbr-input').val(0);
        });
        peserta_w.change(function(){
            $('#q_peserta_mbr-input').val(0);
        });

    function check2(value, validator) {
        var terpilih_p = parseInt($('#q_terpilih_p-input').val());
        var terpilih_w = parseInt($('#q_terpilih_w-input').val());
        var peserta_p = parseInt($('#q_peserta_p-input').val());
        var peserta_w = parseInt($('#q_peserta_w-input').val());
        var peserta_mbr = parseInt($('#q_peserta_mbr-input').val());

        var terpilih_mbr = parseInt($('#q_terpilih_mbr-input').val())|| 0;
        var sum_terpilih = terpilih_p + terpilih_w;
        var sum_terpilih_2 = terpilih_mbr;
        var res = true;

        if(sum_terpilih_2>sum_terpilih){
            res=false;
        }
        if(terpilih_p==0 && terpilih_w==0){
            res=false;
        }
        if(terpilih_p>peserta_p){
            res=false;
        }
        if(terpilih_w>peserta_w){
            res=false;
        }
        if(terpilih_mbr>peserta_mbr){
            res=false;
        }
        if(sum_terpilih<9 || sum_terpilih>13 || sum_terpilih%2==0){
            res=false;
            console.log('aa')
        }
        if(sum_terpilih_2<9 || sum_terpilih_2>13 || sum_terpilih_2%2==0){
            res=false;
            console.log('bb')
        }
        return res;
    };

    var terpilih_p = $('#q_terpilih_p-input');
    var terpilih_w = $('#q_terpilih_w-input');
    
        terpilih_p.change(function(){
            $('#q_terpilih_mbr-input').val(0);
        });
        terpilih_w.change(function(){
            $('#q_terpilih_mbr-input').val(0);
        });

    function test(id){
            console.log(id)
            var elem = document.getElementById(id);
            elem.parentNode.removeChild(elem);
            var elem2 = $('#'+id+'-file');
            elem2.removeAttr('value');
            return false;
        }

    function enforce_maxlength(event) {
        var t = event.target;
        if (t.hasAttribute('maxlength')) {
            t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
    document.body.addEventListener('input', enforce_maxlength);

    $(document).ready(function () {

        $('#tgl_kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form-validation').bootstrapValidator('revalidateField', 'tgl_kegiatan-input');
                $("#submit").prop('disabled', false);
        });
            
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $('#form-validation').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form-validation').on('submit', function (e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    type: 'post',
                    processData: false,
                    contentType: false,
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/kelurahan/pemilu_bkm/pemilu";
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
        
        var kota = $('#select-kode_kota-input');
        var kecamatan = $('#select-kode_kec-input');
        var kelurahan = $('#select-kode_kel-input');
        var korkot = $('#kode_korkot-input');
        var faskel = $('#kode_faskel-input');
        var tahun = $('#tahun-input');
        var real_p = $('#utusan_p');
        var real_w = $('#utusan_w');
        var real_mbr = $('#utusan_mbr');
        var p = $('#q_peserta_p-input');
        var w = $('#q_peserta_w-input');
        var mbr = $('#q_peserta_mbr-input');
        var kota_id,kec_id,kel_id,faskel_id,tahun_id;
        
        kota.change(function(){
            korkot.empty();
            faskel.empty();
            kota_id=kota.val();
            faskel_id=faskel.val();
            console.log(kec_id,faskel_id)
            if(kota_id!=undefined){
                kecamatan.empty();
                kecamatan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/select?kec="+kota_id+"&faskel="+faskel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
                korkot.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.val(data[0].kode_korkot);
                        }
                    }
                });
            }
        });
        kecamatan.change(function(){
            kec_id=kecamatan.val();
            faskel_id=faskel.val();
            console.log(kec_id, faskel_id)
            if(kec_id!=undefined){
                kelurahan.empty();
                kelurahan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/select?kel="+kec_id+"&faskel="+faskel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kelurahan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });   
            }
        });
        kelurahan.change(function(){
            kel_id=kelurahan.val();
            tahun_id=tahun.val();
            console.log(kel_id)
            if(kel_id!=undefined){
                faskel.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/select?faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.val(data[0].kode_faskel);
                        }
                    }
                });
                p.empty();
                w.empty();
                mbr.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/pemilu/select?utusan="+kel_id+"&tahun="+tahun_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            real_p.val(data[0].utusan_p);
                            real_w.val(data[0].utusan_w);
                            real_mbr.val(data[0].utusan_mbr);
                            p.val(data[0].utusan_p);
                            w.val(data[0].utusan_w);
                            mbr.val(data[0].utusan_mbr);
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
