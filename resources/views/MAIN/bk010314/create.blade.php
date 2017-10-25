@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Pengadaan / Proses Lelang @stop {{-- local styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">

<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}}
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Pengadaan / Proses Lelang</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/pengadaan_lelang">
                    Perencanaan / Pengadaan/Proses Lelang
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
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
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
                                    <select id="select-kode_kmw-input" class="form-control select2" name="select-kode_kmw-input" required>
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
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">KorKot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input" required>
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kode Paket Pekerjaan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_pkt_krj-input" class="form-control select2" name="select-kode_pkt_krj-input" required>
                                        @foreach($kode_pkt_krj_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_pkt_krj_list) selected="selected" @endif >{{ $list->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Mulai Lelang</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_lelang_mulai-input" name="tgl_lelang_mulai-input" placeholder="Tanggal Mulai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_mulai}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Lelang Selesai</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_lelang_selesai-input" name="tgl_lelang_selesai-input" placeholder="Tanggal Selesai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_selesai}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBN NSUP (PHLN)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="sd_apbn_nsup-input" name="sd_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_nsup}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBN Lainya (PHLN/RM)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="sd_apbn_lain-input" name="sd_apbn_lain-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_lain}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBD PROP</label>
                                <div class="col-sm-6">
                                    <input type="number" id="sd_apbd_prop-input" name="sd_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_prop}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBD KAB/KOTA</label>
                                <div class="col-sm-6">
                                    <input type="number" id="sd_apbd_kota-input" name="sd_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_kota}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Swasta/Lainya</label>
                                <div class="col-sm-6">
                                    <input type="number" id="sd_swasta-input" name="sd_swasta-input" class="form-control" placeholder="Rp" value="{{$sd_swasta}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-textarea-input2">Keterangan</label>
                                <div class="col-sm-6">
                                    <textarea id="keterangan-input" name="keterangan-input" rows="7" class="form-control resize_vertical" placeholder="Keterangan" maxlength="300">{{ $keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Document</label>
                                <div class="col-sm-6">
                                    <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                </div>
                            </div>
                            <!--<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                               <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diket_tgl-input" name="diket_tgl-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diket_oleh-input" name="diket_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diver_tgl-input" name="diver_tgl-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diver_oleh-input" name="diver_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>-->
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/perencanaan/pengadaan_lelang" type="button" class="btn btn-effect-ripple btn-danger">
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>Daftar Peserta Lelang</b>
                </div>
                @if( ! empty($detil['302']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/pengadaan_lelang/peserta/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="peserta">
                        <thead>
                            <tr>
                                <th>Kode Lelang</th>
                                <th>No Urut</th>
                                <th>Kode Kontraktor</th>
                                <th>Flag Pemenang</th>
                                <th>Created Time</th>
                                <th>Created By</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
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
	  	$("#file-dokumen-input").fileinput({
  	  		showUpload: false
  	  	});
  	  	$("#file-absensi-input").fileinput({
  	  		showUpload: false
  	  	});
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/perencanaan/pengadaan_lelang/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/perencanaan/pengadaan_lelang";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-skala_kegiatan-input").select2({
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

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_pkt_krj-input").select2({
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

        var kmw = $('#select-kode_kmw-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kecamatan = $('#select-kode_kec-input');
        var kelurahan = $('#select-kode_kel-input');
        var faskel = $('#select-kode_faskel-input');
        var kmw_id,kota_id,korkot_id,kel_id,kec_id,faskel_id;
        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=undefined){
                kota.empty();
                kota.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/rencana_kegiatan/select?kmw="+kmw_id,
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
            if(kota_id!=undefined){
                korkot.empty();
                korkot.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/rencana_kegiatan/select?kota="+kota_id,
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
                    "url": "/main/perencanaan/rencana_kegiatan/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        kecamatan.change(function(){
            kec_id=kecamatan.val();
            console.log(kec_id)
            if(kec_id!=undefined){
                kelurahan.empty();
                kelurahan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/rencana_kegiatan/select?kec="+kec_id,
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
            if(kel_id!=undefined){
                faskel.empty();
                faskel.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/rencana_kegiatan/select?faskel="+kel_id,
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
<script>
    $(document).ready(function () {
        var table = $('#peserta').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/perencanaan/pengadaan_lelang/peserta",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode_lelang" , name:"kode_lelang"},
                { "data": "no_urut" , name:"no_urut"},
                { "data": "kode_kontraktor" , name:"kode_kontraktor"},
                { "data": "flag_pemenang" , name:"flag_pemenang"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "option" , name:"option",orderable:false}
            ]
        });
        $('#pokja_filter input').unbind();
        $('#pokja_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            table.search(this.value).draw();
        }
    })
});
</script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.buttons.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.colReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.rowReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.colVis.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.print.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.scroller.js')}}"></script>
<script src="{{asset('js/custom_js/alert.js')}}" type="text/javascript"></script>
@stop
