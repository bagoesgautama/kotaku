@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Seleksi Utusan Tingkat Basis @stop {{-- local styles --}}
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
    <h1>MAIN Module</h1>
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
            <li class="next">
                Seleksi Utusan Tingkat Basis
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
                    <b>bk010234 index</b>
                </div>
                @if( ! empty($detil['584']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="/main/persiapan/kelurahan/pemilu_bkm/seleksi/create">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="users" width="3000px">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Tahun</th>
                                <th>RT</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Jumlah Peserta Laki-laki</th>
                                <th>Jumlah Peserta Perempuan</th>
                                <th>Jumlah Peserta Miskin/MBR</th>
                                <th>Jumlah Utusan Laki-laki</th>
                                <th>Jumlah Utusan Perempuan</th>
                                <th>Jumlah Utusan Miskin/MBR</th>
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
                     "url": "/main/persiapan/kelurahan/pemilu_bkm/seleksi",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kel" , name:"nama_kel"},
                { "data": "tahun" , name:"tahun"},
                { "data": "nama_rt" , name:"nama_rt"},
                { "data": "tgl_kegiatan" , name:"tgl_kegiatan"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "q_utusan_p" , name:"q_utusan_p"},
                { "data": "q_utusan_w" , name:"q_utusan_w"},
                { "data": "q_utusan_mbr" , name:"q_utusan_mbr"},
                { "data": "q_terpilih_p" , name:"q_terpilih_p"},
                { "data": "q_terpilih_w" , name:"q_terpilih_w"},
                { "data": "q_terpilih_mbr" , name:"q_terpilih_mbr"},
                { "data": "option" , name:"option"}
            ],
            "order":[[0,"desc"]]
        });

        $('#users_filter input').unbind();
        $('#users_filter input').bind('keyup', function(e) {
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
