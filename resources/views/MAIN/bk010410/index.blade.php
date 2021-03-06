@extends('MAIN/default') {{-- Page title --}} @section('title') Pelaksanaan - Realisasi Kegiatan Skala Kelurahan BDI/Non BDI @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Pelaksanaan - Realisasi Kegiatan Skala Kelurahan BDI/Non BDI</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/pelaksanaan/kelurahan/realisasi_kegiatan">
                    Pelaksanaan / Realisasi Kegiatan Skala Kelurahan / BDI/Non BDI
                </a>
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
                    <b>bk010410 index</b>
                </div>
                @if( ! empty($detil['383']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/pelaksanaan/kelurahan/realisasi_kegiatan/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="users" width="3000px">
                        <thead>
                            <tr>
                                <th>Data Usulan Kegiatan</th>
                                <th>Sumber Dana</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Kawasan</th>
                                <th>KPP</th>
                                <th>Tahun</th>
                                <th>Tgl Realisasi</th>
                                <th>Vol Realisasi</th>
                                <th>Satuan</th>
                                <th>Created Time</th>
                                <th>Option</th>
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
        var table = $('#users').DataTable({
            // dom: 'Bflrtip',
            
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/pelaksanaan/kelurahan/realisasi_kegiatan",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode_parent" , name:"kode_parent"},
                { "data": "jns_sumber_dana" , name:"jns_sumber_dana"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "kode_korkot" , name:"kode_korkot"},
                { "data": "kode_kec" , name:"kode_kec"},
                { "data": "kode_kel" , name:"kode_kel"},
                { "data": "kode_faskel" , name:"kode_faskel"},
                { "data": "kode_kawasan" , name:"kode_kawasan"},
                { "data": "id_kpp" , name:"id_kpp"},
                { "data": "tahun" , name:"tahun"},
                { "data": "tgl_realisasi" , name:"tgl_realisasi"},
                { "data": "vol_realisasi" , name:"vol_realisasi"},
                { "data": "satuan" , name:"satuan"},
                { "data": "created_time" , name:"created_time"},
                { "data": "option" , name:"option",orderable:false}
            ],
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
