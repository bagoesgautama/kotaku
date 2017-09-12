@extends('layouts/default') {{-- Page title --}} @section('title') Advanced Datatables @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}"> @stop {{-- Page Header--}} @section('page-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Advanced Datatables</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('index')}}">
                <i class="fa fa-fw fa-home"></i> Dashboard
            </a>
        </li>
        <li> Datatables</li>
        <li class="active">
            Advanced Datatables
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
                <div class="tools pull-right"></div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">

					<table class="table table-striped" id="users">
						<!--<thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>password</th>
                            </tr>
                        </thead>
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>User email</th>
								<th>
									Account Type
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Demetrius</td>
								<td>Cole</td>
								<td>Demetrius.Cole@yahoo.com</td>
								<td>Credit Card Account</td>
							</tr>
							<tr>
								<td>Sydnee</td>
								<td>Beahan</td>
								<td>Sydnee_Beahan41@gmail.com</td>
								<td>Home Loan Account</td>
							</tr>
							<tbody>-->
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
	        "dom": '<"m-t-10"B><"m-t-10 pull-left"f><"m-t-10 pull-right"l>rt<"pull-left m-t-10"i><"m-t-10 pull-right"p>',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('allposts') }}",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "name" , name:"name"},
                { "data": "email" , name:"email"},
                { "data": "password" , name:"password"}
            ]
	    });
        /*$('#users').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('allposts') }}",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "name" , name:"name"},
                { "data": "email" , name:"email"},
                { "data": "password" , name:"password"}
            ]
        });*/
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
<script src="{{asset('js/custom_js/advanced_datatables.js')}}" type="text/javascript"></script>

@stop
