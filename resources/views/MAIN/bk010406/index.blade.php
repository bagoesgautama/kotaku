@extends('MAIN/default') {{-- Page title --}} @section('title') Sertifikasi Infrastruktur @stop {{-- local styles --}} @section('header_styles') 

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
                Pelaksanaan
            </li>
            <li class="next">
                Realisasi Kegiatan Skala Kota (Non BDI Kolaborasi)
            </li>
            <li class="next">
                Sertifikasi Infrastruktur
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
                    <b>bk010406 index</b>
                </div>
                @if( ! empty($detil['367']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/pelaksanaan/kota_non/sertifikasi_infra/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="pokja">
                        <thead>
                            <tr>
                                <th>Sumber Dana</th>
                                <th>Sertifikasi</th>
                                <th>KMW</th>
                                <th>Kota</th>
                                <th>Korkot</th>
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
        var table = $('#pokja').DataTable({
            // dom: 'Bflrtip',
            
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/pelaksanaan/kota_non/sertifikasi_infra",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "jns_sumber_dana" , name:"jns_sumber_dana"},
                { "data": "hasil_sertifikasi" , name:"hasil_sertifikasi"},
                { "data": "kode_kmw" , name:"kode_kmw"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "kode_korkot" , name:"kode_korkot"},
                { "data": "kode_kawasan" , name:"kode_kawasan"},
                { "data": "id_kpp" , name:"id_kpp"},
                { "data": "tahun" , name:"tahun"},
                { "data": "tgl_realisasi" , name:"tgl_realisasi"},
                { "data": "vol_realisasi" , name:"vol_realisasi"},
                { "data": "satuan" , name:"satuan"},
                { "data": "created_time" , name:"created_time"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order":[[11,"desc"]]
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
