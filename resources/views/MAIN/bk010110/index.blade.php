@extends('MAIN/default') {{-- Page title --}} @section('title') Konsultan Manajemen Wilayah (KMW) @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Konsultan Manajemen Wilayah (KMW)</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/kmw">
                    Master Data / Data Cakupan Program / KMW
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
                    <b>bk010110 Index</b>
                </div> -->
                @if( ! empty($detil['41']))
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ url('/main/kmw/create') }}">Create</a>
				</div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users" width="2000px">
						<thead>
                            <tr>
                                <th>Mapping KMP ke Slum Program</th>
                                <th>Propinsi</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Contact Person</th>
                                <th>No Telepon</th>
                                <th>No FAX</th>
                                <th>No Handphone 1</th>
                                <th>No Handphone 2</th>
                                <th>Email 1</th>
                                <th>Email 2</th>
                                <th>PMS</th>
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
                     "url": "/main/kmw",
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
                { "data": "kode_kmp_slum_prog" , name:"kode_kmp_slum_prog"},
                { "data": "nama_prop" , name:"nama_prop"},
                { "data": "nama" , name:"nama"},
                { "data": "alamat" , name:"alamat"},
                { "data": "contact_person" , name:"contact_person"},
                { "data": "no_phone" , name:"no_phone"},
                { "data": "no_fax" , name:"no_fax"},
                { "data": "no_hp1" , name:"no_hp1"},
                { "data": "no_hp2" , name:"no_hp2"},
                { "data": "email1" , name:"email1"},
                { "data": "email2" , name:"email2"},
                { "data": "nama_pms" , name:"nama_pms"},
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
