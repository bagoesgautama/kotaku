@extends('HRM/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>HRM Module</h1>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-fw fa-home"></i> HRM
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <i class="ti-export"></i> <b>Want to export data?</b>
                </div>
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ url('hrm/modul/create') }}">Create</a>
				</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="modul">
						<thead>
                            <tr>
                                <th>nama</th>
                                <th>deskripsi</th>
                                <th>status</th>
                                <th>kode apps</th>
                                <th>created time</th>
                                <th>created by</th>
                                <th>update time</th>
                                <th>update by</th>
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
		var table = $('#modul').DataTable({
	        // dom: 'Bflrtip',
	        "dom": '<"m-t-10"B><"m-t-10 pull-left"f><"m-t-10 pull-right"l>rt<"pull-left m-t-10"i><"m-t-10 pull-right"p>',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('hrm/modul') }}",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
				{ "data": "nama" , name:"nama"},
                { "data": "deskripsi" , name:"deskripsi"},
                { "data": "status" , name:"status"},
                { "data": "kode_apps" , name:"kode_apps"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "update_time" , name:"update_time"},
                { "data": "update_by" , name:"update_by"},
				{ "data": "option" , name:"option",orderable:false}
            ]
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
