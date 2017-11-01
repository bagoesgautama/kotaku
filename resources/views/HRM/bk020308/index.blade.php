@extends('HRM/default') {{-- Page title --}} @section('title') Blacklist @stop {{-- local styles --}} @section('header_styles')

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
    <h1>Blacklist</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/hrm">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
            <li class="next">
                Managemen User / Blacklist
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
                    <b>Blacklist Index</b>
                </div>
				<div class="tools pull-right">
					<b>bk020307 Index</b>
				</div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users">
						<thead>
                            <tr>
								<th>ID</th>
								<th>Username</th>
								<th>Nama Depan</th>
                                <th>Nama Belakang</th>
								<th>Role</th>
								<th>Level</th>
								<th>Blacklist</th>
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
			"processing": true,
            "serverSide": true,
            "ajax":{
	             "url": "/hrm/management/blacklist",
	             "dataType": "json",
	             "type": "POST"
	           },
            success: function(data) {
                 alert('success')
              },
              error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              },
			  "columns": [
				{ "data": "id" , name:"id"},
				{ "data": "user_name" , name:"user_name"},
				{ "data": "nama_depan" , name:"nama_depan"},
				{ "data": "nama_belakang" , name:"nama_belakang"},
				{ "data": "role" , name:"role"},
				{ "data": "level" , name:"level"},
				{ "data": "flag_blacklist" , name:"flag_blacklist"},
				{ "data": "option" , name:"option",orderable:false}
            ],
			"order": [[ 0, "desc" ]]
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
