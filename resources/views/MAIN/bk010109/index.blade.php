@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping KMP ke Slum Program @stop {{-- local styles --}} @section('header_styles')

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
    <h1>Mapping KMP ke Slum Program</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> MAIN
            </a>
        </li>
        <li><a href="/hrm/kmp_slum_program">Mapping KMP ke Slum Program</a></li>
        <li class="active">
            Table
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <div class="panel-title pull-left">
                    <b>bk010109 Index</b>
                </div>
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ url('main/kmp_slum_program/create') }}">Create</a>
				</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users">
						<thead>
                            <tr>
                                <th>nama KMP</th>
                                <th>nama Slum Program</th>
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
		var table = $('#users').DataTable({
	        // dom: 'Bflrtip',

			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('main/kmp_slum_program') }}",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
				{ "data": "kode_kmp" , name:"kode_kmp"},
                { "data": "kode_slum_prog" , name:"kode_slum_prog"},
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
