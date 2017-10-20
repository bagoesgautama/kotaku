@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Penyiapan Paket (DED, RAB, RKS) @stop {{-- local styles --}} @section('header_styles')
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
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom_css/wizard.css')}}" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Rencana Kegiatan Skala Kota</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/perencanaan/infra/penyiapan_paket">
                    Perencanaan / Penyiapan DED, Pengadaan Skala Kot / Penyiapan Paket (DED, RAB, RKS)
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
                            Data Umum
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                            Data Kegiatan
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                            Nilai/Biaya
                        </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                            Data Tambahan
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tahun</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                                            <input type="text" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Skala Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-skala_kegiatan-input" class="form-control select2" name="select-skala_kegiatan-input-input" required>
                                                <option value=P>Primer</option>
                                                <option value=S>Sekunder</option>
                                                <option value=T>Tersier</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KMW</label>          
                                        <div class="col-sm-6">
                                            <select id="select-kode_prop-input" class="form-control select2" name="select-kode_prop-input">
                                                <option value=undefined>Please select</option>
                                                @foreach($kode_kmw_list as $list)
                                                    <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input">
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KorKot</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input">
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kecamatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input" required>
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Kelurahan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input" required>
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Faskel</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode_faskel-input" class="form-control select2" name="select-kode_faskel-input-input" required>
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Jenis Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-jenis_komponen_keg-input" class="form-control select2" name="select-jenis_komponen_keg-input-input" required>
                                                <option value=L>Lingkungan</option>
                                                <option value=S>Sosial</option>
                                                <option value=E>Ekonomi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kode Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="kode_kegiatan-input" name="kode_kegiatan-input" class="form-control" placeholder="Kode Kegiatan" value="{{$kode_kegiatan}}" maxlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Sub Komponen</label>
                                        <div class="col-sm-6">
                                            <select id="select-id_subkomponen-input" class="form-control select2" name="select-id_subkomponen-input-input" required>
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input31">Detail Sub Komponen</label>
                                        <div class="col-sm-6">
                                            <select id="select-id_dtl_subkomponen-input" class="form-control select2" name="select-id_dtl_subkomponen-input-input" required>
                                                <option value=undefined>Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Volume Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="dk_vol_kegiatan-input" name="dk_vol_kegiatan-input" class="form-control" placeholder="Volume Kegiatan" value="{{$dk_vol_kegiatan}}" maxlength=50 required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Satuan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="dk_satuan-input" name="dk_satuan-input" class="form-control" placeholder="Satuan" value="{{$dk_satuan}}" maxlength="50" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                         <label class="col-sm-3 control-label" for="example-text-input31">Kategori Penanganan</label>
                                        <div class="col-sm-6">
                                            <select id="select-dk_tipe_penanganan-input" class="form-control select2" name="select-dk_tipe_penanganan-input-input" required>
                                                <option value=0>Rehab</option>
                                                <option value=1>Baru</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">APBN NSUP</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_nsup-input" name="nb_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$nb_apbn_nsup}}" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">APBN Lain</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_lain-input" name="nb_apbn_lain-input" class="form-control" placeholder="Rp" value="{{$nb_apbn_lain}}" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">APBD Propinsi</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_prop-input" name="nb_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$nb_apbd_prop}}" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">APBD Kab/Kota</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_kota-input" name="nb_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$nb_apbd_kota}}" maxlength="30" required>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lainya</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_lainya-input" name="nb_lainya-input" class="form-control" placeholder="Rp" value="{{$nb_lainya}}" maxlength="30" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">File Document</label>
                                        <div class="col-sm-6">
                                            <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input" required>
                                            <br>
                                            <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                        </div>
                                    </div>   
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input" required>
                                            <br>
                                            <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                       <label class="col-sm-3 control-label" for="example-text-input1">Diserahkan Oleh</label>
                                        <div class="col-sm-3">
                                            <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Diketahui Oleh</label>
                                        <div class="col-sm-3">
                                            <select id="diket_oleh-input" name="diket_oleh-input" class="form-control" size="1">
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="diket_tgl-input" name="diket_tgl-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Diverifikasi Oleh</label>
                                        <div class="col-sm-3">
                                            <select id="diver_oleh-input" name="diver_oleh-input" class="form-control" size="1">
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="diver_tgl-input" name="diver_tgl-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/main/perencanaan/kawasan/investasi" type="button" class="btn btn-effect-ripple btn-danger">
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
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/perencanaan/rencana_kegiatan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/perencanaan/rencana_kegiatan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode_prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        
        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kawasan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            console.log(e)
            alert('Field input '+e.target.id+' belum diisi.');
          };
        })(), true);

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var prop = $('#select-kode_prop-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kecamatan = $('#select-kode_kec-input');
        var kawasan = $('#select-kode_kawasan-input');
        var prop_id,kota_id,korkot_id,kec_id,kaw_id;

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=null){
                kota.empty();
                kota.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?prop="+prop_id,
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
            if(kota_id!=null){
                korkot.empty();
                korkot.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
                kecamatan.empty();
                kecamatan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
                kawasan.empty();
                kawasan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kawasan/perencanaan/select?kec="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kawasan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
       
      });
</script>
@stop
