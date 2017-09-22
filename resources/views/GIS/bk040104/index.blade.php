@extends('GIS/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}}
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
    <h1>GIS Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
            	<a href="/gis">
            		<i class="fa fa-fw fa-home"></i> GIS
            	</a>
            </li>
            <li class="next">
	            Master Data Kecamatan
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content') 
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ url('gis/kecamatan/create') }}">Create</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="kecamatan">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nama Pendek</th>
                                <th>Kode Kota</th>
                                <th>Status</th>
                                <th>Created Time</th>
                                <th>Created By</th>
                                <th>Updated Time</th>
                                <th>Updated By</th>
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
        var table = $('#kecamatan').DataTable({
            // dom: 'Bflrtip',
            
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/gis/kecamatan",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "nama" , name:"nama"},
                { "data": "nama_pendek" , name:"nama_pendek"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "status" , name:"status"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "updated_time" , name:"updated_time"},
                { "data": "updated_by" , name:"updated_by"},
                { "data": "option" , name:"option"}
            ]
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
