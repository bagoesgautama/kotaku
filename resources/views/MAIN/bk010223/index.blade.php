@extends('MAIN/default') {{-- Page title --}} @section('title') Persiapan Kelurahan - TAPP @stop {{-- local styles --}}
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
    <h1>Persiapan Kelurahan - TAPP</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
            	<a href="/main">
            		<i class="fa fa-fw fa-home"></i> PERSIAPAN KELURAHAN
            	</a>
            </li>
            <li class="next">
	            TAPP
            </li>
            <li class="next">
                Table
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
				@if( ! empty($detil['207']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="/main/persiapan/kelurahan/lembaga/tapp/create">Create</a>
                </div>
				@endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="provinsi">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>KMW</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Kegiatan</th>
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
        var table = $('#provinsi').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kelurahan/lembaga/tapp",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "tahun" , name:"tahun"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "kode_korkot" , name:"kode_korkot"},
                { "data": "kode_kecamatan" , name:"kode_kecamatan"},
                { "data": "kode_kmw" , name:"kode_kmw"},
                { "data": "kode_kel" , name:"kode_kel"},
                { "data": "kode_faskel" , name:"kode_faskel"},
                { "data": "id_kegiatan" , name:"id_kegiatan"},
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
