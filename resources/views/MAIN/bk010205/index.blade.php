@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Informasi Umum @stop {{-- local styles --}} @section('header_styles')

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
                Persiapan
            </li>
            <li class="next">
                Kota atau Kabupaten
            </li>
            <li class="next">
                Informasi Umum
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
                    <b>Informasi Umum</b>
                </div>
                <div class="tools pull-right">
                    <b>bk010205 index</b>
                    <!-- <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ '/main/persiapan/kota/info/create' }}">Create</a> -->
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="kegiatan" width="1500px">
                        <thead>
                            <tr>
                                <th>Kota</th>
								<th>Dasar Hukum</th>
								<th>Jumlah Kawasan Kumuh</th>
								<th>Jumlah Kecamatan Kumuh</th>
								<th>Jumlah Kelurahan Kumuh</th>
								<th>Jumlah RT Kumuh</th>
								<th>Jumlah RT Non Kumuh</th>
                                <th>option</th>
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
        var table = $('#kegiatan').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kota/info",
                     "dataType": "json",
                     "type": "POST"
                   },
            "columns": [
                { "data": "nama" , name:"nama"},
				{ "data": "km_ds_hkm" , name:"km_ds_hkm"},
				{ "data": "km_q_kw_kmh" , name:"km_q_kw_kmh"},
				{ "data": "km_q_kec_kmh" , name:"km_q_kec_kmh"},
				{ "data": "km_q_kel_kmh" , name:"km_q_kel_kmh"},
				{ "data": "km_q_rt_kmh" , name:"km_q_rt_kmh"},
				{ "data": "km_q_rt_non_kmh" , name:"km_q_rt_non_kmh"},
                { "data": "option" , name:"option",orderable:false}
            ]
        });
        $('#kegiatan_filter input').unbind();
        $('#kegiatan_filter input').bind('keyup', function(e) {
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
