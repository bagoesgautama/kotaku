 @extends('MAIN/default') {{-- Page title --}} @section('title') Main - Keanggotaan @stop {{-- local styles --}}
@section('header_styles')

<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">

<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" media="all" rel="stylesheet" type="text/css"/>

@stop {{-- Page Header--}}
@section('page-header')
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
                <a href="/main/persiapan/kelurahan/forum/keanggotaan">
                    Persiapan Kelurahan / Forum Kolaborasi / Keanggotaan
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
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Forum</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="hidden" id="kode_kmw-input" name="kode_kmw-input" value="{{ $kode_kmw }}">
                                    <input type="hidden" id="kode_korkot-input" name="kode_korkot-input" value="{{ $kode_korkot }}">
                                    <input type="hidden" id="kode_faskel-input" name="kode_faskel-input" value="{{ $kode_faskel }}">
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
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pembentukan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_kegiatan-input" name="tgl_kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required data-bv-callback="true" data-bv-callback-message="Tanggal melebihi current date." data-bv-callback-callback="tgl">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Anggota Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_p-input" name="q_anggota_p-input" class="form-control" placeholder="Anggota Pria" value="{{$q_anggota_p}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Anggota Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_w-input" name="q_anggota_w-input" class="form-control" placeholder="Anggota Wanita" value="{{$q_anggota_w}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Unsur Pemerintah Desa</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_pem_desa-input" name="q_anggota_pem_desa-input" class="form-control" placeholder="Anggota Desa" value="{{$q_anggota_pem_desa}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Unsur Pemerintah BPD</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_pem_bpd-input" name="q_anggota_pem_bpd-input" class="form-control" placeholder="Anggota BPD" value="{{$q_anggota_pem_bpd}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Unsur Non Pemerintah</label>
                                <div class="col-sm-6">
                                    <input type="text" id="q_anggota_non_pem-input" name="q_anggota_non_pem-input" class="form-control" placeholder="Anggota Non Pemerintah" value="{{$q_anggota_non_pem}}" maxlength="5" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nilai Dana Operasional</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nilai_dana_ops-input" name="nilai_dana_ops-input" class="form-control" placeholder="Jumlah Dana Operasional" value="{{$nilai_dana_ops}}" maxlength="30" min="0" step="0.1" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dokumen Rencana Kerja</label>
                                <div class="col-sm-6">
                                    <input id="uri_dok_rencana_kerja-input" type="file" class="file" accept="image/*" name="uri_dok_rencana_kerja-input">
                                    <br>
                                    <img id="uri_dok_rencana_kerja" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan/{{$uri_dok_rencana_kerja}}" {!! $uri_dok_rencana_kerja==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_dok_rencana_kerja-file" name="uri_dok_rencana_kerja-file" value="{{$uri_dok_rencana_kerja}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_dok_rencana_kerja==null ? 'style="display:none"':'' !!} onclick="test('uri_dok_rencana_kerja')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kelurahan/forumkolaborasi/keanggotaan/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group">
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
                                    <a href="/main/persiapan/kelurahan/forum/keanggotaan" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='199' || $detil_menu=='200')
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
        var p = parseInt($('#q_anggota_p-input').val());
        var w = parseInt($('#q_anggota_w-input').val());

        var desa = parseInt($('#q_anggota_pem_desa-input').val())|| 0;
        var bpd = parseInt($('#q_anggota_pem_bpd-input').val())|| 0;
        var non = parseInt($('#q_anggota_non_pem-input').val())|| 0;
        var sum = p+w;
        var sum2 = desa+bpd+non;
        var res = true;
        if(sum2>sum){
            res=false;
        }else if(p==0 && w==0){
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
        var tgl_kegiatan = new Date($('#tgl-kegiatan-input').val());
        if(tgl_kegiatan>new Date()){
            res=false;
        }
        return res;
    };

    var p = $('#q_anggota_p-input');
    var w = $('#q_anggota_w-input');

        p.change(function(){
            $('#q_anggota_pem_desa-input').val(0);
            $('#q_anggota_pem_bpd-input').val(0);
            $('#q_anggota_non_pem-input').val(0);
        });
        w.change(function(){
            $('#q_anggota_pem_desa-input').val(0);
            $('#q_anggota_pem_bpd-input').val(0);
            $('#q_anggota_non_pem-input').val(0);
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

        $("#uri_dok_rencana_kerja-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
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

        $("#select-jenis_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $('#tgl-kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form-validation').bootstrapValidator('revalidateField', 'tgl_kegiatan-input');
                $("#submit").prop('disabled', false);
        });
        $('#form-validation').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form-validation').on('submit', function (e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    type: 'post',
                    processData: false,
                    contentType: false,
                    "url": "/main/persiapan/kelurahan/forum/keanggotaan/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/kelurahan/forum/keanggotaan";
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
        
        var kota = $('#select-kode_kota-input');
        var kecamatan = $('#select-kode_kec-input');
        var kelurahan = $('#select-kode_kel-input');
        var korkot = $('#kode_korkot-input');
        var faskel = $('#kode_faskel-input');
        var kota_id,kec_id,kel_id,faskel_id;
        
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
                    "url": "/main/persiapan/kelurahan/forum/keanggotaan/select?kec="+kota_id+"&faskel="+faskel_id,
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
                    "url": "/main/persiapan/kelurahan/forum/keanggotaan/select?korkot="+kota_id,
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
                    "url": "/main/persiapan/kelurahan/forum/keanggotaan/select?kel="+kec_id+"&faskel="+faskel_id,
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
                    "url": "/main/persiapan/kelurahan/forum/keanggotaan/select?faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.val(data[0].kode_faskel);;
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
