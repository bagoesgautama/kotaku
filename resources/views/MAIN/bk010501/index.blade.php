@extends('MAIN/default') {{-- Page title --}} @section('title') Serah Terima Aset @stop {{-- local styles --}} @section('header_styles') 

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
                Keberlanjutan
            </li>
            <li class="next">
                Skala Kota
            </li>
            <li class="next">
                Serah Terima Aset Bangunan kepada Pemerintah Kab/Kota
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
                    <b>bk010501 index</b>
                </div>
                <!-- @if( ! empty($detil['397']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/keberlanjutan/kota/serah_terima/create'}}">Create</a>
                </div>
                @endif -->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="pokja">
                        <thead>
                            <tr>
                                <th>Option</th>
                                <th>Kode</th>
                                <th>Data Realisasi Kegiatan</th>
                                <th>Skala Kegiatan</th>
                                <th>Sumber Dana</th>
                                <th>Serah Terima Aset</th>
                                <th>Tgl Serah Terima Aset</th>
                                <th>Kota</th>
                                <th>Kawasan</th>
                                <th>Kelurahan</th>
                                <th>Tahun</th>
                                <th>Tgl Realisasi</th>
                                <th>Vol Realisasi</th>
                                <th>Satuan</th>
                                <th>Created Time</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
    $(document).ready(function () {
        var table = $('#pokja').DataTable({
            // dom: 'Bflrtip',
            
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/keberlanjutan/kota/serah_terima",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "option" , name:"option",orderable:false},
                { "data": "kode" , name:"kode"},
                { "data": "kode_parent" , name:"kode_parent"},
                { "data": "skala_kegiatan" , name:"skala_kegiatan"},
                { "data": "jns_sumber_dana" , name:"jns_sumber_dana"},
                { "data": "flag_sudah_sertias" , name:"flag_sudah_sertias"},
                { "data": "tgl_sertias" , name:"tgl_sertias"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "kode_kawasan" , name:"kode_kawasan"},
                { "data": "kode_kel" , name:"kode_kel"},
                { "data": "tahun" , name:"tahun"},
                { "data": "tgl_realisasi" , name:"tgl_realisasi"},
                { "data": "vol_realisasi" , name:"vol_realisasi"},
                { "data": "satuan" , name:"satuan"},
                { "data": "created_time" , name:"created_time"}
            ],
            "order": [[1,"desc"]]
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
