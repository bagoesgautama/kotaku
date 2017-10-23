@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Kawasan Prioritas @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Perencanaan - Kawasan Prioritas</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/kawasan/perencanaan">
                    Perencanaan / Kawasan Prioritas / Perencanaan Kawasan Prioritas
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
               <!--  <div class="panel-title pull-left">
                    <b>bk010309 index</b>
                </div> -->
                @if( ! empty($detil['290']))
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/kawasan/perencanaan/create'}}">Create</a>
				</div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users" width="5000px">
						<thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Propinsi</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>Kawasan</th>
                                <th>Topologi Permukiman</th>
                                <th>Karakter Kawasan</th>
                                <th>Pola Penanganan</th>
                                <th>Status Lahan</th>
                                <th>Status Hunian</th>
                                <th>Kepadatan Bangunan</th>
                                <th>Jumlah Penduduk</th>
                                <th>Jumlah Penduduk Perempuan</th>
                                <th>Jumlah Penduduk MBR</th>
                                <th>Jumlah Kepala Keluarga</th>
                                <th>Jumlah Kepala Keluarga Miskin</th>
                                <th>Kepadatan Penduduk</th>
                                <th>Luas Kawasan Kumuh</th>
                                <th>Jumlah Kelurahan Kumuh Pada Tahun Berjalan</th>
                                <th>Jumlah Rt Kumuh Pada Tahun Berjalan</th>
                                <th>Luas Rt Kumuh Pada Tahun Berjalan</th>
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

<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
    $(document).ready(function () {
		var table = $('#users').DataTable({
	        // dom: 'Bflrtip',
	        
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/perencanaan/kawasan/perencanaan",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
				{ "data": "tahun" , name:"tahun"},
                { "data": "nama_prop" , name:"nama_prop"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kawasan" , name:"nama_kawasan"},
                { "data": "tipologi_pmkm" , name:"tipologi_pmkm"},
                { "data": "karakter_kaw" , name:"karakter_kaw"},
                { "data": "pola_penanganan" , name:"pola_penanganan"},
                { "data": "status_lahan" , name:"status_lahan"},
                { "data": "status_hunian" , name:"status_hunian"},
                { "data": "kepadatan_bangunan" , name:"kepadatan_bangunan"},
                { "data": "pdk_q_jiwa" , name:"pdk_q_jiwa"},
                { "data": "pdk_q_jiwa_w" , name:"pdk_q_jiwa_w"},
                { "data": "pdk_q_mbr" , name:"pdk_q_mbr"},
                { "data": "pdk_q_kk" , name:"pdk_q_kk"},
                { "data": "pdk_q_kk_miskin" , name:"pdk_q_kk_miskin"},
                { "data": "pdk_kpdt_pddk" , name:"pdk_kpdt_pddk"},
                { "data": "pk_l_kaw_kmh" , name:"pk_l_kaw_kmh"},
                { "data": "pk_q_kel_kmh_thn_cur" , name:"pk_q_kel_kmh_thn_cur"},
                { "data": "pk_q_rt_kmh_thn_cur" , name:"pk_q_rt_kmh_thn_cur"},
                { "data": "pk_l_rt_kmh_thn_cur" , name:"pk_l_rt_kmh_thn_cur"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
				{ "data": "option" , name:"option",orderable:false}
            ]
	    });
        $('#users_filter input').unbind();
        $('#users_filter input').bind('keyup', function(e) {
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
