@extends('MAIN/default') {{-- Page title --}} @section('title') Main - kegiatan/Monitoring Pokja @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/nasional/pokja/kegiatan">
                    Persiapan / Nasional / Pokja / Kegitan/Monitoring Pokja
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
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Pokja</label></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pokja Nasional</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="select-kode-pokja-input" name="kode-pokja-input" class="form-control select2" size="1" required>
                                        @foreach ($kode_pokja_list as $kpl)
                                            <option value="{{$kpl->kode}}" {!! $kode_pokja==$kpl->kode ? 'selected':'' !!}>{{$kpl->kode.'-'.$kpl->tahun.'-'.$kpl->status_pokja_convert}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jenis Sub kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="sub-kegiatan-input" name="sub-kegiatan-input" class="form-control" size="1" required>
                                        <option value="2.2.3.3" {!! $jenis_subkegiatan=='2.2.3.3' ? 'selected':'' !!}>Pertemuan Rutin</option>
                                        <option value="2.2.3.4" {!! $jenis_subkegiatan=='2.2.3.4' ? 'selected':'' !!}>Monitoring</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required data-bv-callback="true" data-bv-callback-message="Tanggal kegiatan lebih kecil dari tanggal pembentukan" data-bv-callback-callback="check" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Cakupan Peserta</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_p}}" required data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota pembentuk pria" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_w}}" data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota pembentuk perempuan" data-bv-callback-callback="check" min="0" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Non Anggota</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-non-input" name="q-non-input" class="form-control" placeholder="Jumlah" value="{{$q_non_anggota}}" min="0" required>
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
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/nasional/pokja/monitoring/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/nasional/pokja/monitoring/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/nasional/pokja/kegiatan" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='66' || $detil_menu=='65')
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
		var prop = {!! json_encode($kode_pokja_list) !!};
		for(var i=0;i<prop.length;i++){
			if(prop[i].kode==$('#select-kode-pokja-input').val()){
				prop=prop[i];
				break;
			}
		}
		var p = parseInt($('#q-laki-input').val());
		var w = parseInt($('#q-perempuan-input').val());

		var kl = parseInt($('#upp-kementrian-input').val());
		var dinas = parseInt($('#upp-dinas-input').val());
		var dpr = parseInt($('#upp-dpr-input').val());
		var lsm = parseInt($('#upnp-lsm-input').val());
		var swasta = parseInt($('#upnp-swasta-input').val());
		var prak = parseInt($('#upnp-praktisi-input').val());
		var tgl=new Date($('#tgl-kegiatan-input').val());
		var sum = p+w;
		var sum2 = kl+dinas+dpr+lsm+swasta+prak;
		var res = true;
		if(sum2>sum){
			res=false;
		}else if(p==0 && w==0){
			res=false;
		}else if(prop.q_anggota_p<p || prop.q_anggota_w<w){
			res=false;
		}else if(new Date(prop.tgl_kegiatan)>tgl){
			res=false;
		}
		return res;
	};

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
                $('#form').bootstrapValidator('revalidateField', 'tgl-kegiatan-input');
                $("#submit").prop('disabled', false);
        });

        $("#select-kode-pokja-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        $("#sub-kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
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
                    "url": "/main/persiapan/nasional/pokja/kegiatan/create",
                    data: form_data,
                    beforeSend: function (){
                        $("#submit").prop('disabled', true);
                    },
                    success: function () {
                        alert('From Submitted.');
                        window.location.href = "/main/persiapan/nasional/pokja/kegiatan";
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
