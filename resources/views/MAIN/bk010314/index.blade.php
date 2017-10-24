@extends('MAIN/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Perencanaan - Pengadaan / Proses Lelang</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/perencanaan/pengadaan_lelang">
                    Perencanaan / Pengadaan/Proses Lelang
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
                <!-- <div class="panel-title pull-left">
                    <b>bk010201 index</b>
                </div> -->
                @if( ! empty($detil['302']))
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/pengadaan_lelang/create'}}">Create</a>
				</div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users" width="4000px">
						<thead>
                            <tr>
                                <th colspan="6">Data Umum</th>
                            </tr>    
                            <tr>
                                <th>Tahun</th>
                                <th>KMW</th>
                                <th>Kota</th>
                                <th>KorKot</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Kode Paket Kerja</th>
                                <th>Mulai Lelang</th>
                                <th>Selesai Lelang</th>
                                <th>No Kontrak</th>
                                <th>APBN NSUP</th>
                                <th>APBN Lain</th>
                                <th>APBD Propinsi</th>
                                <th>APBD Kota</th>
                                <th>Swasta</th>
                                <th>Keterangan</th>
                                <th>Paket</th>
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
                     "url": "/main/perencanaan/pengadaan_lelang",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
				{ "data": "tahun" , name:"tahun"},
                { "data": "nama_kmw" , name:"nama_kmw"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kel" , name:"nama_kel"},
                { "data": "nama_faskel" , name:"nama_faskel"},
                { "data": "kode_pkt_krj" , name:"kode_pkt_krj"},
                { "data": "tgl_lelang_mulai" , name:"tgl_lelang_mulai"},
                { "data": "tgl_lelang_selesai" , name:"tgl_lelang_selesai"},
                { "data": "nomor_kontrak" , name:"nomor_kontrak"},
                { "data": "sd_apbn_nsup" , name:"sd_apbn_nsup"},
                { "data": "sd_apbn_lain" , name:"sd_apbn_lain"},
                { "data": "sd_apbd_prop" , name:"sd_apbd_prop"},
                { "data": "sd_apbd_kota" , name:"sd_apbd_kota"},
                { "data": "sd_swasta" , name:"sd_swasta"},
                { "data": "keterangan" , name:"keterangan"},
                { "data": "nama_paket" , name:"nama_paket"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
				{ "data": "option" , name:"option",orderable:false}
            ]
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
