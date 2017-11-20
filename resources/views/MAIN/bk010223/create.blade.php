@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Kelembagaan @stop {{-- local styles --}}
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
    <h1>MAIN Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/persiapan/kelurahan/lembaga">
                    Persiapan Kelurahan / Kelembagaan
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
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Kegiatan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="hidden" id="kode_kmw-input" name="kode_kmw-input" value="{{ $kode_kmw }}">
                                    <input type="hidden" id="kode_korkot-input" name="kode_korkot-input" value="{{ $kode_korkot }}">
                                    <input type="hidden" id="kode_faskel-input" name="kode_faskel-input" value="{{ $kode_faskel }}">
                                    <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required>
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
                                <label class="col-sm-3 control-label" for="example-text-input31">Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-id_kegiatan-input" class="form-control select2" name="select-id_kegiatan-input" required>
                                        <option value="">Please Select</option>
                                        @if ($kode_id_kegiatan_list!=null)
                                        @foreach ($kode_id_kegiatan_list as $kkl)
                                            <option value="{{$kkl->id}}" {!! $id_kegiatan==$kkl->id ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Detail Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-id_dtl_kegiatan-input" class="form-control select2" name="select-id_dtl_kegiatan-input">
                                        <option value="">Please Select</option>
                                        @if ($kode_id_dtl_kegiatan_list!=null)
                                        @foreach ($kode_id_dtl_kegiatan_list as $kkl)
                                            <option value="{{$kkl->id}}" {!! $id_dtl_kegiatan==$kkl->id ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl_kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Peserta Pria</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_p-input" name="q_peserta_p-input" class="form-control" placeholder="Peserta Pria" value="{{$q_peserta_p}}" maxlength="5" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Peserta Wanita</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_w-input" name="q_peserta_w-input" class="form-control" placeholder="Peserta Wanita" value="{{$q_peserta_w}}" maxlength="5" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Peserta Miskin</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_peserta_miskin-input" name="q_peserta_miskin-input" class="form-control" placeholder="Peserta Miskin" value="{{$q_peserta_miskin}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total utusan laki-laki pada seleksi tingkat basis" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Document</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/lembaga" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='339' || $detil_menu=='340')
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
        var p = parseInt($('#q_peserta_p-input').val());
        var w = parseInt($('#q_peserta_w-input').val());

        var mbr = parseInt($('#q_peserta_miskin-input').val())|| 0;
        var sum = p+w;
        var sum2 = mbr;
        var res = true;
        if(sum2>sum){
            res=false;
        }else if(p==0 && w==0){
            res=false;
        }
        return res;
    };

    var p = $('#q_peserta_p-input');
    var w = $('#q_peserta_w-input');

        p.change(function(){
            $('#q_peserta_miskin-input').val(0);
        });
        w.change(function(){
            $('#q_peserta_miskin-input').val(0);
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

        $("#select-id_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-id_dtl_kegiatan-input").select2({
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
                    "url": "/main/persiapan/kelurahan/lembaga/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/kelurahan/lembaga";
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
        var kegiatan = $('#select-id_kegiatan-input');
        var dtl_kegiatan = $('#select-id_dtl_kegiatan-input');
        var kota_id,kec_id,kel_id,faskel_id,kegiatan_id;
        
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
                    "url": "/main/persiapan/kelurahan/lembaga/select?kec="+kota_id+"&faskel="+faskel_id,
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
                    "url": "/main/persiapan/kelurahan/lembaga/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.val(data[0].kode_korkot);;
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
                    "url": "/main/persiapan/kelurahan/lembaga/select?kel="+kec_id+"&faskel="+faskel_id,
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
            console.log(kel_id)
            if(kel_id!=undefined){
                faskel.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/lembaga/select?faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.val(data[0].kode_faskel);;
                        }
                    }
                });
            }
        });
        kegiatan.change(function(){
            kegiatan_id=kegiatan.val();
            console.log(kegiatan_id)
            if(kegiatan_id!=undefined){
                dtl_kegiatan.empty();
                dtl_kegiatan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/lembaga/select?kegiatan="+kegiatan_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            dtl_kegiatan.append("<option value="+data[i].id+" >"+data[i].nama+"</option>");
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
