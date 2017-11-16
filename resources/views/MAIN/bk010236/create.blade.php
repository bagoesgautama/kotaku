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

<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">
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
                <a href="/main/persiapan/propinsi/sosialisasi">
                    Persiapan / Propinsi / Sosialisasi
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
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="hidden" id="detil_menu" name="detil_menu" value="{{ $detil_menu }}">
                                    <select id="skala_kegiatan" name="skala_kegiatan" class="form-control" size="1" required>
                                        <option value="2" {!! $skala_kegiatan=='2' ? 'selected':'' !!}>Skala Propinsi</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group striped-col">
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
                            </div> -->
                            <!-- <div class="form-group striped-col">
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
                            </div> -->
                            <!-- <div class="form-group ">
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
                            </div> -->
                            
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" value="{{$nama_kegiatan}}" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pelaksanaan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Pelaksanaan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50" required>
                                </div>
                            </div>
                            
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Media</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="media" name="media" class="form-control" maxlength="255" required>{{$media}}</textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Hasil Kesepakatan</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical;height: 200px;" id="hasil_kesepakatan" name="hasil_kesepakatan" class="form-control" maxlength="1000" required>{{$hasil_kesepakatan}}</textarea>
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
                            
                            <div class="form-group ">
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
                                    <a href="/main/persiapan/propinsi/sosialisasi" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='597' || $detil_menu=='596')
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
@if($kode!=null)
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>Daftar Unsur Peserta</b>
                </div>
                @if( ! empty($detil['597']) && $detil_menu=='597')
                <!-- <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/persiapan/kota/kegiatan/sosialisasi/unsur/create?kode_sosialisasi='.$kode}}">Create</a>
                </div> -->
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#form_modal">Tambah</button>
                <div id="form_modal" class="modal fade animated" role="dialog">
                    <div class="modal-dialog">
                        <form action="/main/persiapan/propinsi/sosialisasi/unsur/create" enctype="multipart/form-data" class="form-horizontal form-bordered" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Daftar Unsur</h4>
                            </div>
                            <form role="form">
                                <div class="modal-body">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label class="sr-only" for="first-name">Unsur</label>
                                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                                <select id="select-kode-unsur-input" name="kode-unsur-input" class="form-control select2" size="1" required>
                                                    <option value>Please select</option>
                                                    @if ($kode_unsur_list!=null)
                                                    @foreach ($kode_unsur_list as $kkl)
                                                        <option value="{{$kkl->id}}">{{$kkl->nama}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="input-group" style="width: 100%">
                                                <label class="sr-only" for="last-name">Jumlah Peserta</label>
                                                <input type="number" id="jml_peserta" name="jml_peserta" class="form-control" maxlength="11" required min="1" placeholder="Jumlah Peserta" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="unsur">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Unsur</th>
                                <th>Jml Peserta</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($kode!=null)
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>Daftar Narasumber</b>
                </div>
                @if( ! empty($detil['597']) && $detil_menu=='597')
                <!-- <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/persiapan/kota/kegiatan/sosialisasi/narsum/create?kode_sosialisasi='.$kode}}">Create</a>
                </div> -->
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#form_modal_narsum">Tambah</button>
                <div id="form_modal_narsum" class="modal fade animated" role="dialog">
                    <div class="modal-dialog">
                        <form action="/main/persiapan/propinsi/sosialisasi/narsum/create" enctype="multipart/form-data" class="form-horizontal form-bordered" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Daftar Narasumber</h4>
                            </div>
                            <form role="form">
                                <div class="modal-body">
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <label class="sr-only" for="first-name">Unsur</label>
                                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                                <select id="select-kode-unsur-n-input" name="kode-unsur-n-input" class="form-control select2" size="1" required>
                                                    <option value>Please select</option>
                                                    @if ($kode_unsur_n_list!=null)
                                                    @foreach ($kode_unsur_n_list as $kkl)
                                                        <option value="{{$kkl->id}}">{{$kkl->nama}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="input-group" style="width: 100%">
                                                <label class="sr-only" for="last-name">Nama Narasumber</label>
                                                <input type="text" id="nama_narsum" name="nama_narsum" class="form-control" maxlength="100" required placeholder="Nama Narasumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-10">
                                        <div class="col-md-12">
                                            <div class="input-group" style="width: 100%">
                                                <label class="sr-only" for="last-name">Materi Narasumber</label>
                                                <textarea style="resize: vertical;height: 200px" id="materi_narsum" name="materi_narsum" class="form-control" maxlength="1000" required placeholder="Materi Narasumber"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="narasumber">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Unsur</th>
                                <th>Narasumber</th>
                                <th>Materi</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        //unsur
        var kode = $('#kode').val();
        var detil_menu = $('#detil_menu').val();
        var table = $('#unsur').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/propinsi/sosialisasi/unsur",
                     "data":{kode : kode,detil_menu : detil_menu},
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "nama_unsur" , name:"nama_unsur"},
                { "data": "jml_peserta" , name:"jml_peserta"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order": [[0,"desc"]]
        });
        $('#unsur_filter input').unbind();
        $('#unsur_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                table.search(this.value).draw();
            }
        })

        //narsum
        var kode = $('#kode').val();
        var detil_menu = $('#detil_menu').val();
        var table = $('#narasumber').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/propinsi/sosialisasi/narsum",
                     "data":{kode : kode,detil_menu : detil_menu},
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "nama_unsur" , name:"nama_unsur"},
                { "data": "nama_narsum" , name:"nama_narsum"},
                { "data": "materi_narsum" , name:"materi_narsum"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order": [[0,"desc"]]
        });
        $('#narasumber_filter input').unbind();
        $('#narasumber_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                table.search(this.value).draw();
            }
        })

        $('#form').on('submit', function (e) {
            var form_data = new FormData(this);
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/persiapan/propinsi/sosialisasi/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/propinsi/sosialisasi";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
        // $("#select-kode-prop-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        
        // $("#select-kode-kec-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        // $("#select-kode-kel-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        // $("#select-kode-kmw-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        // $("#select-kode-korkot-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        // $("#select-kode-faskel-input").select2({
        //     theme: "bootstrap",
        //     placeholder: "Please Select",
        //     width:"100%"
        // });
        $("#select-kode-unsur-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        $("#select-kode-unsur-n-input").select2({
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

        // prop.change(function(){
        //     prop_id=prop.val();
        //     if(prop_id!=null){
        //         kmw.empty();
        //         kmw.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?prop="+prop_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kmw.change(function(){
        //     kmw_id=kmw.val();
        //     if(kmw_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?kmw="+kmw_id,
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
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?kota_korkot="+kota_id,
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
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?kota_kec="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kec.change(function(){
        //     kec_id=kec.val();
        //     if(kec_id!=null){
        //         kel.empty();
        //         kel.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?kec_kel="+kec_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kel.change(function(){
        //     kel_id=kel.val();
        //     if(kel_id!=null){
        //         faskel.empty();
        //         faskel.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/persiapan/kota/kegiatan/sosialisasi/select?kel_faskel="+kel_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }s
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