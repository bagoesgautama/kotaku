@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Pembentukan Pokja @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/nasional/pokja/pembentukan">
                    Persiapan / Nasional / Pokja / Pembentukan
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
                        <form id="form-validation" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data POKJA</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                <div class="col-sm-6">
                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required data-bv-callback="true" data-bv-callback-message="Tahun melebihi current year." data-bv-callback-callback="check">
                                        <option value>Please select</option>
                                        @foreach($tahun_list as $list)
                                            <option value="{{ $list->tahun }}" {!! $list->tahun==$tahun?"selected":"" !!}>{{ $list->tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pembentukan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status Pokja</label>
                                <div class="col-sm-6">
                                    <select id="status-pokja-input" name="status-pokja-input" class="form-control" size="1" required>
                                        <option value="0" {!! $status_pokja==0 ? 'selected':'' !!}>Lama</option>
                                        <option value="1" {!! $status_pokja==1 ? 'selected':'' !!}>Baru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Dasar Pembentukan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="dsr-pembentukan-input" name="dsr-pembentukan-input" class="form-control" value="{{$ds_hkm}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Anggota POKJA</label></div>
                            </div>
                            <div class="form-group striped-col ">
                                <label class="col-sm-3 control-label" for="kode">Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_p}}" maxlength="11" required min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_w}}" maxlength="11" required min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col ">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Unsur POKJA Pemerintah</label></div>
                            </div>
                            <div class="form-group" id="kl_label">
                                <label class="col-sm-3 control-label" for="kode">Kementrian/KL</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-kementrian-input" name="upp-kementrian-input" class="form-control" placeholder="" value="{{$upp_kl}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Dinas/Badan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-dinas-input" name="upp-dinas-input" class="form-control" placeholder="" value="{{$upp_dinas}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">DPR/DPD Pusat/DPRD</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upp-dpr-input" name="upp-dpr-input" class="form-control" placeholder="" value="{{$upp_dpr}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Unsur POKJA Non Pemerintah</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">LSM/Pemerhati Permukiman</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-lsm-input" name="upnp-lsm-input" class="form-control" placeholder="" value="{{$upn_lsm}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Swasta/Badan Usaha</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-swasta-input" name="upnp-swasta-input" class="form-control" placeholder="" value="{{$unp_bu}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Praktisi/Profesional/Perguruan Tinggi</label>
                                <div class="col-sm-6">
                                    <input type="number" id="upnp-praktisi-input" name="upnp-praktisi-input" class="form-control" placeholder="" value="{{$upn_praktisi}}" maxlength="11" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;"></label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Nilai Dana Operasional</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dana-ops-input" name="dana-ops-input" class="form-control" placeholder="Jumlah" value="{{$nilai_dana_ops}}" min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Keterangan Rencana Kerja</label>
                                <div class="col-sm-6">
                                    <input type="text" id="ket-rencana-kerja-input" name="ket-rencana-kerja-input" class="form-control" placeholder="Ket. Rencana Kerja" value="{{$ket_rencana_kerja}}" maxlength="50">
                                </div>
                            </div>
							<div class="form-group">
				                <label class="col-sm-3 control-label">Sekertariat</label>
				                <div class="col-sm-6">
				                    <select id="flag_sekretariat-input" name="flag_sekretariat-input" class="form-control" size="1">
										<option value=0 {!! $flag_sekretariat===0 ? 'selected':'' !!}>Tidak</option>
				                        <option value=1 {!! $flag_sekretariat===1 ? 'selected':'' !!}>Ya</option>
				                    </select>
				                </div>
				            </div>
                            <div class="form-group striped-col">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Rencana Kerja</label>
                                <div class="col-sm-6">
                                    <input id="url_rencana_kerja-input" type="file" class="file" accept="image/*" name="url_rencana_kerja-input">
                                    <br>
                                    <img id="url_rencana_kerja" alt="gallery" src="/uploads/persiapan/nasional/pokja/pembentukan/{{$url_rencana_kerja}}" {!! $url_rencana_kerja==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="url_rencana_kerja-file" name="url_rencana_kerja-file" value="{{$url_rencana_kerja}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $url_rencana_kerja==null ? 'style="display:none"':'' !!} onclick="test('url_rencana_kerja')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/nasional/pokja/pembentukan/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/nasional/pokja/pembentukan/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/nasional/pokja/pembentukan" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='62' || $detil_menu=='61')
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
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        var p = parseInt($('#q-laki-input').val());
        var w = parseInt($('#q-perempuan-input').val());

        var kl = parseInt($('#upp-kementrian-input').val())|| 0;
        var dinas = parseInt($('#upp-dinas-input').val())|| 0;
        var dpr = parseInt($('#upp-dpr-input').val())|| 0;
        var lsm = parseInt($('#upnp-lsm-input').val())|| 0;
        var swasta = parseInt($('#upnp-swasta-input').val())|| 0;
        var prak = parseInt($('#upnp-praktisi-input').val())|| 0;
        var sum = p+w;
        var sum2 = kl+dinas+dpr+lsm+swasta+prak;
        var res = true;
        if(sum2>sum){
            res=false;
        }else if(p==0 && w==0){
			res=false;
		}

        if(thn>yearNow){
            res=false;
        }

        return res;
    };


    var p = $('#q-laki-input');
    var w = $('#q-perempuan-input'); 

    p.change(function(){
            $('#upp-kementrian-input').val(0);
            $('#upp-dinas-input').val(0);
            $('#upp-dpr-input').val(0);
            $('#upnp-lsm-input').val(0);
            $('#upnp-swasta-input').val(0);
            $('#upnp-praktisi-input').val(0);
        });
        w.change(function(){
            $('#upp-kementrian-input').val(0);
            $('#upp-dinas-input').val(0);
            $('#upp-dpr-input').val(0);
            $('#upnp-lsm-input').val(0);
            $('#upnp-swasta-input').val(0);
            $('#upnp-praktisi-input').val(0);
        });

    function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength); 
    
    $(document).ready(function () {

        $('#tgl-kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form-validation').bootstrapValidator('revalidateField', 'tgl-kegiatan-input');
                $("#submit").prop('disabled', false);
        });
        
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        
        $("#status-pokja-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        
        $("#flag_sekretariat-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $('#form-validation').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form-validation').on('submit', function (e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    type: 'post',
                    processData: false,
                    contentType: false,
                    "url": "/main/persiapan/nasional/pokja/pembentukan/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/nasional/pokja/pembentukan";
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
        
        $("#url_rencana_kerja-input").fileinput({
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
<script src="{{asset('js/custom_js/form_validations.js')}}" type="text/javascript"></script>
@stop
