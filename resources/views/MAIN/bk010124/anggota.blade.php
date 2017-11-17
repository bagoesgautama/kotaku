@extends('MAIN/default') {{-- Page title --}} @section('title') Realisasi Kontrak Paket Pekerjaan dari Kontraktor Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/pnotify/css/pnotify.buttons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/pnotify/css/pnotify.css')}}" rel="stylesheet" type="text/css">

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
                <a href="/main/pelaksanaan/kota_bdi/realisasi_kontrak/create?kode={{$kode_real_ktrk}}">
                    Pelaksanaan / Realisasi Kegiatan Skala Kota (BDI/Non BDI) / Realisasi Kontrak Paket Pekerjaan dari Kontraktor / Create
                </a>
            </li>
            <li class="next">
                Penerima Manfaat
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
                            <div class="form-group striped-col ">
                                <label class="col-sm-3 control-label">Nama Koordinator</label>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#form_modal">Tambah</button>
                                                <div id="form_modal" class="modal fade animated" role="dialog">
                                                    <div class="modal-dialog">
                                                        <form action="/main/data_master/bkm/anggota" enctype="multipart/form-data" class="form-horizontal form-bordered" method="post">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Tambah Anggota BKM</h4>
                                                            </div>
                                                            <form role="form">
                                                                <div class="modal-body">
                                                                    <div class="row m-t-10">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group">
                                                                                <label class="sr-only" for="first-name">Nama</label>
                                                                                <input type="hidden" id="kode" name="kode" value="{{ $id }}">
                                                                                <input type="text" id="nama" name="nama" class="form-control" maxlength="100" required placeholder="Nama" >
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-10">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group" style="width: 100%">
                                                                                <select id="sumber_pembiayaan" name="sumber_pembiayaan" class="form-control" size="1" required>
                                                                                    <option value="L">Laki-laki</option>
                                                                                    <option value="P">Perempuan</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-10">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group" style="width: 100%">
                                                                                <label class="sr-only" for="last-name">Umur</label>
                                                                                <input type="number" id="umur" name="umur" class="form-control" maxlength="3" required min="1" placeholder="Umur" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-10">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group" style="width: 100%">
                                                                                <label class="sr-only" for="last-name">Pendidikan</label>
                                                                                <select id="select-kode-pendidikan-input" name="kode-pendidikan-input" class="form-control select2" size="1">
                                                                                    <option value>Please select</option>
                                                                                    @foreach ($kode_pendidikan_list as $kkl)
                                                                                        <option value="{{$kkl->kode}}">{{$kkl->nama}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-10">
                                                                        <div class="col-md-12">
                                                                            <div class="input-group" style="width: 100%">
                                                                                <label class="sr-only" for="last-name">Pekerjaan</label>
                                                                                <select id="select-kode-pekerjaan-input" name="kode-pekerjaan-input" class="form-control select2" size="1">
                                                                                    <option value>Please select</option>
                                                                                    @foreach ($kode_pekerjaan_list as $kkl)
                                                                                        <option value="{{$kkl->kode}}">{{$kkl->nama}}</option>
                                                                                    @endforeach
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
                                                </div> -->
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

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>

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
<script>
      $(document).ready(function () {
        $('.ui-pnotify').remove();
        var kode_real_ktrk = $('#kode_real_ktrk').val();
        var where = $('#where').val();
        var table = $('#pokja3').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat",
                     "data":{kode_real_ktrk : kode_real_ktrk, where : where},
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "nik" , name:"nik"},
                { "data": "nama" , name:"nama"},
                { "data": "alamat" , name:"alamat"},
                { "data": "kode_jenis_kelamin" , name:"kode_jenis_kelamin"},
                { "data": "created_time" , name:"created_time"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order":[[4,"desc"]]
        });
        $('#pokja3_filter input').unbind();
        $('#pokja3_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                table.search(this.value).draw();
            }
        })

        $('#form').on('submit', function (e) {
            e.preventDefault();
            var form_data = new FormData(this);


          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/pelaksanaan/kota_bdi/realisasi_kontrak/pemanfaat/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/pelaksanaan/kota_bdi/realisasi_kontrak/create?kode="+kode_real_ktrk;
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
      });
</script>
@stop
