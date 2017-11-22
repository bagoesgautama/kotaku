@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Proses Penyusunan Perencanaan Tingkat Kota @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/perencanaan/penyusunan">
                    Perencanaan / Proses Penyusunan Perencanaan Tingkat Kota / Proses Penyusunan Perencanaan Tingkat Kota
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                <div class="col-sm-6">
                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required data-bv-callback="true" data-bv-callback-message="Tahun melebihi current year." data-bv-callback-callback="tahun">
                                        <option value>Please select</option>
                                        @foreach($tahun_list as $list)
                                            <option value="{{ $list->tahun }}" {!! $list->tahun==$tahun?"selected":"" !!}>{{ $list->tahun }}
                                            </option>
                                        @endforeach
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
                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1">
                                        <option value>Please select</option>
                                        @if ($kode_kec_list!=null)
                                        @foreach ($kode_kec_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control" size="1" required>
                                        <option value="3.1.1" {!! $jenis_kegiatan=='3.1.1' ? 'selected':'' !!}>Pembangunan Visi</option>
                                        <option value="3.1.2" {!! $jenis_kegiatan=='3.1.2' ? 'selected':'' !!}>Pelaksanaan RPK</option>
                                        <option value="3.3.1" {!! $jenis_kegiatan=='3.3.1' ? 'selected':'' !!}>Lokakarya Perencanaan</option>
                                        <option value="3.4" {!! $jenis_kegiatan=='3.4' ? 'selected':'' !!}>Konsultasi Perencanaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required data-bv-callback="true" data-bv-callback-message="Tanggal melebihi current date." data-bv-callback-callback="tgl">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Peserta Laki-laki</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_p}}" required min="0">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Peserta Perempuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_w}}" required min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="kode">Peserta Miskin/MBR</label>
                                <div class="col-sm-6">
                                    <input type="number" id="q-mbr-input" name="q-mbr-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_mbr}}" required data-bv-callback="true" data-bv-callback-message="Jumlah melebihi total anggota laki-laki & perempuan" data-bv-callback-callback="check" min="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/penyusunan/{{$dir}}/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/penyusunan/{{$dir}}/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/perencanaan/penyusunan" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='747' || $detil_menu=='746')
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

        var mbr = parseInt($('#q-mbr-input').val())|| 0;
        var sum = p+w;
        var res = true;
        if(mbr>sum){
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
    function test(id){
        console.log(id)
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        var elem2 = $('#'+id+'-file');
        elem2.removeAttr('value');
        return false;
    }
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
        $('#form').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form').on('submit', function (e) {
                var form_data = new FormData(this);
              e.preventDefault();
              $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/perencanaan/penyusunan/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {

                alert('From Submitted.');
                window.location.href = "/main/perencanaan/penyusunan";
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
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

         function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kec = $('#select-kode-kec-input');
        var kmw_id,kota_id,korkot_id;
        // var kode_kmw = {!! json_encode($kode_kmw) !!};
        // var kode_kota = {!! json_encode($kode_kota) !!};
        // var kode_korkot = {!! json_encode($kode_korkot) !!};

        // kmw.change(function(){
        //     kmw_id=kmw.val();
        //     if(kmw_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/pembangunan_visi/select?kmw="+kmw_id,
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
        //             "url": "/main/perencanaan/penyusunan/select?kota_korkot="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });


        //     }
        // });

        // kota.change(function(){
        //     kota_id=kota.val();
        //     if(kota_id!=null){
        //         kec.empty();
        //         kec.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penyusunan/select?kota_kec="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });
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
