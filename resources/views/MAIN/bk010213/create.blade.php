@extends('MAIN/default') {{-- Page title --}} @section('title') Kolaborasi Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kecamatan/kolaborasi">
                    Persiapan / Kecamatan / Forum Kolaborasi
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
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Tingkat Forum</label>
                                <div class="col-sm-6">
                                    <select id="tk-forum-input" name="tk-forum-input" class="form-control" size="1" required>
                                        <!-- <option value="1" {!! $tk_forum=='1' ? 'selected':'' !!}>Kota</option> -->
                                        <option value="2" {!! $tk_forum=='2' ? 'selected':'' !!}>Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" required>
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
                                <label class="col-sm-3 control-label">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @if ($kode_kec_list!=null)
                                        @foreach ($kode_kec_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pembentukan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_p}}" required data-bv-callback="true" data-bv-callback-message="pria & wanita tidak boleh 0" data-bv-callback-callback="check">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_w}}" required data-bv-callback="true" data-bv-callback-message="pria & wanita tidak boleh 0" data-bv-callback-callback="check">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Anggota BKM</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-bkm-input" name="q-bkm-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_bkm}}" required data-bv-callback="true" data-bv-callback-message="Jumlah BKM melebihi total pria & wanita" data-bv-callback-callback="check">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label></div>
                            </div>
                            <div class="form-group  striped-col">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="file-dokumen-input" type="file" class="file" data-show-preview="false" name="file-dokumen-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-dokumen" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kota/forum/kolaborasi" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
									@if ($detil_menu=='170' || $detil_menu=='169')
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

		var bkm = parseInt($('#q-bkm-input').val());
		var sum = p+w;
		var res = true;
		if(bkm>sum){
			res=false;
		}else if(p==0 && w==0){
			res=false;
		}

        var thn = parseInt($('#tahun-input').val());
        var yearNow = (new Date()).getFullYear();
        if(thn>yearNow){
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
	  	$("#file-dokumen-input").fileinput({
	        showUpload: false
	    });

  		$("#file-absensi-input").fileinput({
  	        showUpload: false
  	    });
        
        $('#tgl-kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form').bootstrapValidator('revalidateField', 'tgl-kegiatan-input');
                $("#submit").prop('disabled', false);
        });
        
        $("#tk-forum-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
		
        $('#form').bootstrapValidator().on('success.form.bv', function(e) {
	        $('#form').on('submit', function (e) {
	            var file_dokumen = document.getElementById('file-dokumen-input').files[0];
	            var file_absensi = document.getElementById('file-absensi-input').files[0];
	            var form_data = new FormData();
	            form_data.append('kode', $('#kode').val());
	            form_data.append('file-dokumen-input', file_dokumen);
	            form_data.append('file-absensi-input', file_absensi);
	            form_data.append('uploaded-file-dokumen', $('#uploaded-file-dokumen').val());
	            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
	            form_data.append('tahun-input', $('#tahun-input').val());
	            form_data.append('tk-forum-input', $('#tk-forum-input').val());
	            form_data.append('kode-kota-input', $('#select-kode-kota-input').val());
	            form_data.append('kode-kec-input', $('#select-kode-kec-input').val());
	            form_data.append('kode-kmw-input', $('#select-kode-kmw-input').val());
	            form_data.append('kode-korkot-input', $('#select-kode-korkot-input').val());
	            form_data.append('jns-kegiatan-input', '2.4.6');
	            form_data.append('tgl-kegiatan-input', $('#tgl-kegiatan-input').val());
	            form_data.append('q-laki-input', $('#q-laki-input').val());
	            form_data.append('q-perempuan-input', $('#q-perempuan-input').val());
	            form_data.append('q-bkm-input', $('#q-bkm-input').val());
	            form_data.append('tgl-diser-input', $('#tgl-diser-input').val());
	            form_data.append('diser-oleh-input', $('#diser-oleh-input').val());
	            form_data.append('tgl-diket-input', $('#tgl-diket-input').val());
	            form_data.append('diket-oleh-input', $('#diket-oleh-input').val());
	            form_data.append('tgl-diver-input', $('#tgl-diver-input').val());
	            form_data.append('diver-oleh-input', $('#diver-oleh-input').val());
	          e.preventDefault();
	          $.ajax({
	            type: 'post',
	            processData: false,
	            contentType: false,
	            "url": "/main/persiapan/kecamatan/kolaborasi/create",
	            data: form_data,
	            beforeSend: function (){
	                $("#submit").prop('disabled', true);
	            },
	            success: function () {
	            alert('From Submitted.');
	            window.location.href = "/main/persiapan/kecamatan/kolaborasi";
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

        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kec = $('#select-kode-kec-input');
        var kmw_id,kota_id,korkot_id,kec_id;
        var kode_kmw = {!! json_encode($kode_kmw) !!};
        var kode_kota = {!! json_encode($kode_kota) !!};
        var kode_korkot = {!! json_encode($kode_korkot) !!};
        var kode_kec = {!! json_encode($kode_kec) !!};

        // kmw.change(function(){
        //     kmw_id=kmw.val();
        //     if(kmw_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kecamatan/kolaborasi/select?kmw="+kmw_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kota.change(function(){
        //     kota_id=kota.val();
        //     kmw_id=kmw.val();
        //     if(kota_id!=null){
        //         korkot.empty();
        //         korkot.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kecamatan/kolaborasi/select?kota_korkot="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });


        //     }
        // });

        kota.change(function(){
            kota_id=kota.val();
            if(kota_id!=null){
                kec.empty();
                kec.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kecamatan/kolaborasi/select?kota_kec="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
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
