@extends('MAIN/default') {{-- Page title --}} @section('title') Persiapan Kelurahan - Pemilihan Ulang BKM/LKM @stop {{-- local styles --}}
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
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Persiapan Kelurahan - Pemilihan Ulang BKM/LKM</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> PERSIAPAN KELURAHAN
                </a>
            </li>
            <li class="next">
                Pemilihan Ulang BKM/LKM
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>bk010222 index</b>
                </div>
                @if( ! empty($detil['183']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="/main/persiapan/kelurahan/pemilu_bkm/create">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="users" width="2000px">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>KMW</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Tanggal</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Peserta Pria</th>
                                <th>Peserta Wanita</th>
                                <th>Peserta MBR</th>
                                <th>Utusan Pria</th>
                                <th>Utusan Wanita</th>
                                <th>Terpilih Pria</th>
                                <th>Terpilih Wanita</th>
                                <th>Terpilih MBR</th>
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
<script>
    $(document).ready(function () {
        var table = $('#users').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kelurahan/pemilu_bkm",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "tahun" , name:"tahun"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kmw" , name:"nama_kmw"},
                { "data": "nama_kel" , name:"nama_kel"},
                { "data": "nama_faskel" , name:"nama_faskel"},
                { "data": "tgl_kegiatan" , name:"tgl_kegiatan"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "q_peserta_p" , name:"q_peserta_p"},
                { "data": "q_peserta_w" , name:"q_peserta_w"},
                { "data": "q_peserta_mbr" , name:"q_peserta_mbr"},
                { "data": "q_utusan_p" , name:"q_peserta_mbr"},
                { "data": "q_utusan_w" , name:"q_utusan_w"},
                { "data": "q_terpilih_p" , name:"q_terpilih_p"},
                { "data": "q_terpilih_w" , name:"q_terpilih_w"},
                { "data": "q_terpilih_mbr" , name:"q_terpilih_mbr"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "option" , name:"option"}
            ]
        });

        $('#provinsi_filter input').unbind();
        $('#provinsi_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                table.search(this.value).draw();
            }
        });

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
