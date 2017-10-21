@extends('QS/default') {{-- Page title --}} @section('title') Kegiatan Kelurahan @stop {{-- local styles --}} @section('header_styles')

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
    <h1>Kegiatan Kelurahan</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> QS
                </a>
            </li>
            <li class="next">
                Master Data / Kegiatan Kelurahan
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
                    <b>bk050102 Index</b>
                </div>
                @if( ! empty($detil['484']))
                <div class="tools pull-right">
					<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="/qs/master/kegiatan_kelurahan/create">Create</a>
				</div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users">
						<thead>
                            <tr>
								<th>ID</th>
								<th>Agenda</th>
								<th>Parent</th>
								<th>Kode Kegiatan</th>
								<th>No Urut</th>
								<th>Nama Kegiatan</th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
								<th>Status</th>
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
                     "url": "/qs/master/kegiatan_kelurahan",
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
				{ "data": "agenda" , name:"agenda"},
				{ "data": "parent" , name:"parent"},
				{ "data": "kode_keg_kel" , name:"kode_keg_kel"},
				{ "data": "no_urut" , name:"no_urut"},
				{ "data": "nama_kegiatan" , name:"nama_kegiatan"},
				{ "data": "tgl_mulai" , name:"tgl_mulai"},
				{ "data": "tgl_selesai" , name:"tgl_selesai"},
				{ "data": "status" , name:"status"},
                { "data": "option" , name:"option",orderable:false}
            ],
			"order": [[ 8, "asc" ]]
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
