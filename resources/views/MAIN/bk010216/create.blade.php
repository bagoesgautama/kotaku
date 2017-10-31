@extends('MAIN/default') {{-- Page title --}} @section('title') Sosialisasi Form @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kelurahan/sosialisasi">
                    Persiapan / Kelurahan / Kegiatan Kelurahan / Kegiatan Sosialisasi
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
                                <label class="col-sm-3 control-label">Skala kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="skala_kegiatan" name="skala_kegiatan" class="form-control" size="1" required>
                                        <option value="2" {!! $skala_kegiatan=='2' ? 'selected':'' !!}>Skala Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Propinsi</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <select id="select-kode-prop-input" name="kode-prop-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @foreach ($kode_prop_list as $kpl)
                                            <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">KMW</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @if ($kode_kmw_list!=null)
                                        @foreach ($kode_kmw_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kmw==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
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
                                <label class="col-sm-3 control-label">Korkot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @if ($kode_korkot_list!=null)
                                        @foreach ($kode_korkot_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
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
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-kel-input" name="kode-kel-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @if ($kode_kel_list!=null)
                                        @foreach ($kode_kel_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1" required>
                                        <option value>Please select</option>
                                        @if ($kode_faskel_list!=null)
                                        @foreach ($kode_faskel_list as $kfl)
                                            <option value="{{$kfl->kode}}" {!! $kode_faskel==$kfl->kode ? 'selected':'' !!}>{{$kfl->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" value="{{$nama_kegiatan}}" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="kode">Unsur</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-unsur-input" name="kode-unsur-input" class="form-control select2" size="1" required>
                                        @foreach ($kode_unsur_list as $kul)
                                            <option value="{{$kul->id}}" {!! $kode_unsur==$kul->id ? 'selected':'' !!}>{{$kul->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Materi Narasumber</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="materi_narsum" name="materi_narsum" class="form-control" maxlength="1000" required>{{$materi_narsum}}</textarea>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama Narasumber</label>
                                <div class="col-sm-6">
                                    <input type="text" id="nama_narsum" name="nama_narsum" class="form-control" value="{{$nama_narsum}}" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Peserta</label>
                                <div class="col-sm-6">
                                    <input type="number" id="jml_peserta" name="jml_peserta" class="form-control" value="{{$jml_peserta}}" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Media</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="media" name="media" class="form-control" maxlength="255" required>{{$media}}</textarea>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Hasil Kesepakatan</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="hasil_kesepakatan" name="hasil_kesepakatan" class="form-control" maxlength="1000" required>{{$hasil_kesepakatan}}</textarea>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Sumber Pembiayaan</label>
                                <div class="col-sm-6">
                                    <select id="sumber_pembiayaan" name="sumber_pembiayaan" class="form-control" size="1" required>
                                        <option value="1" {!! $sumber_pembiayaan=='1' ? 'selected':'' !!}>APBN</option>
                                        <option value="2" {!! $sumber_pembiayaan=='2' ? 'selected':'' !!}>APBD</option>
                                        <option value="3" {!! $sumber_pembiayaan=='3' ? 'selected':'' !!}>CSR</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Dokumen</label>
                                <div class="col-sm-6">
                                    <input id="file-dokumen-input" type="file" class="file" data-show-preview="false" name="file-dokumen-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-dokumen" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                </div>
                            </div>
                            <!-- <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}" required>
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser-oleh-input" name="diser-oleh-input" class="form-control" size="1" required>
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
                            </div> -->
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/sosialisasi" type="button" class="btn btn-effect-ripple btn-danger">
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
      $(document).ready(function () {
	  	$("#file-dokumen-input").fileinput({
	        showUpload: false
	    });
  		$("#file-absensi-input").fileinput({
  	        showUpload: false
  	    });
        $('#form').on('submit', function (e) {
            var form_data = new FormData(this);
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/persiapan/kelurahan/sosialisasi/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/kelurahan/sosialisasi";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-unsur-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var prop = $('#select-kode-prop-input');
        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kec = $('#select-kode-kec-input');
        var kel = $('#select-kode-kel-input');
        var faskel = $('#select-kode-faskel-input');
        var kmw_id,kota_id,korkot_id,kec_id,kel_id,faskel_id;

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=null){
                kmw.empty();
                kmw.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?prop="+prop_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=null){
                kota.empty();
                kota.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?kmw="+kmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kota.change(function(){
            kota_id=kota.val();
            kmw_id=kmw.val();
            if(kota_id!=null){
                korkot.empty();
                korkot.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?kota_korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });


            }
        });

        kota.change(function(){
            kota_id=kota.val();
            if(kota_id!=null){
                kec.empty();
                kec.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?kota_kec="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kec.change(function(){
            kec_id=kec.val();
            if(kec_id!=null){
                kel.empty();
                kel.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?kec_kel="+kec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kel.change(function(){
            kel_id=kel.val();
            if(kel_id!=null){
                faskel.empty();
                faskel.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/sosialisasi/select?kel_faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
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

@stop
