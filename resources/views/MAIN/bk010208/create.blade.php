@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Kegiatan Sosialisasi @stop {{-- local styles --}} @section('header_styles')
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
                <a href="/main/persiapan/kota/kegiatan/sosialisasi">
                    Persiapan / Kota atau Kabupaten / Kegiatan / Sosialisasi
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
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Sosialisasi</label></div>
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
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="kode" name="kode" value="{{$kode}}" hidden>
                                    <input type="text" id="detil_menu" name="detil_menu" value="{{$detil_menu}}" hidden>
                                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" value="{{$nama_kegiatan}}" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Pelaksanaan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Klik Untuk Pilih Tanggal" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}" required data-bv-callback="true" data-bv-callback-message="Tanggal melebihi current date." data-bv-callback-callback="check">
                                </div>
                            </div>
                            <div class="form-group  striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <textarea id="lok-kegiatan-input" name="lok-kegiatan-input" rows="7" class="form-control resize_vertical" placeholder="Lokasi" maxlength="50" required>{{ $lok_kegiatan }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Materi Narasumber</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="materi_narsum" name="materi_narsum" class="form-control" placeholder="Materi" maxlength="1000" required>{{$materi_narsum}}</textarea>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Media</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical" id="media" name="media" class="form-control" placeholder="Media" maxlength="255" required>{{$media}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Hasil Kesepakatan</label>
                                <div class="col-sm-6">
                                    <textarea style="resize: vertical;height: 200px;" id="hasil_kesepakatan" name="hasil_kesepakatan" class="form-control" placeholder="Hasil Kesepakatan" maxlength="1000" required>{{$hasil_kesepakatan}}</textarea>
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
                            <div class="form-group">
                                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Tambahan</label></div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/persiapan/kota/kegiatan/sosialisasi/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/persiapan/kota/kegiatan/sosialisasi/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kota/kegiatan/sosialisasi" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    @if ($detil_menu=='152' || $detil_menu=='151')
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
                @if( ! empty($detil['152']) && $detil_menu=='152')
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#form_modal">Tambah</button>
                <div id="form_modal" class="modal fade animated" role="dialog">
                    <div class="modal-dialog">
                        <form action="/main/persiapan/kota/kegiatan/sosialisasi/unsur/create" enctype="multipart/form-data" class="form-horizontal form-bordered" method="post">
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
                @if( ! empty($detil['152']) && $detil_menu=='152')
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#form_modal_narsum">Tambah</button>
                <div id="form_modal_narsum" class="modal fade animated" role="dialog">
                    <div class="modal-dialog">
                        <form action="/main/persiapan/kota/kegiatan/sosialisasi/narsum/create" enctype="multipart/form-data" class="form-horizontal form-bordered" method="post">
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
    function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

    function check(value, validator) {
        var res = true;
        var tgl_kegiatan = new Date($('#tgl-kegiatan-input').val());
        if(tgl_kegiatan>new Date()){
            res=false;
        }
        return res;
    };
    
    $(document).ready(function () {
        
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#sumber_pembiayaan").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });
        
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

        $('#tgl-kegiatan-input')
            .on('changeDate show', function(e) {
                // Revalidate the date when user change it
                $('#form').bootstrapValidator('revalidateField', 'tgl-kegiatan-input');
                $("#submit").prop('disabled', false);
        });

        //unsur
        var kode = $('#kode').val();
        var detil_menu = $('#detil_menu').val();
        var table = $('#unsur').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kota/kegiatan/sosialisasi/unsur",
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
                     "url": "/main/persiapan/kota/kegiatan/sosialisasi/narsum",
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
        $('#form').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form').on('submit', function (e) {
                var form_data = new FormData(this);
              e.preventDefault();
              $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/persiapan/kota/kegiatan/sosialisasi/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function (data) {
                alert('From Submitted.');
                window.location.href = "/main/persiapan/kota/kegiatan/sosialisasi/create?kode="+data;
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
