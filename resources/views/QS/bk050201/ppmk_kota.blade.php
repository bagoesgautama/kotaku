@extends('QS/default') {{-- Page title --}} @section('title') PPMK @stop {{-- local styles --}} @section('header_styles')
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
    <h1>PPMK</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> QS
                </a>
            </li>
            <li class="next">
				<a href="/qs/monitoring/kelurahan">
	                Monitoring / Kegiatan Kelurahan
				</a>
            </li>
			<li class="next">
				<a href="/qs/monitoring/kelurahan/kota?kode={{$kode_prov}}&agenda={{$agenda}}">
					{{$prov}}
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
                <div class="panel-title pull-left">
                    <b>bk050201 PPMK</b>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
					<table class="table table-striped" id="users">
						<thead>
                            <tr>
								<th>kode</th>
								<th>Kegiatan</th>
								<th>Belum</th>
								<th>Proses</th>
								<th>Selesai</th>
                            </tr>
                        </thead>
						<tbody>
							@foreach ($data as $i)
								<tr >
									<td >{{$i->kode_keg_kel}}</td>
									<td >{{$i->nama_kegiatan}}</td>
									<td>{{$i->q0_ppmk_baru}}</td>
									<td>{{$i->q1_ppmk_baru}}</td>
									<td>{{$i->q2_ppmk_baru}}</td>
								 </tr>
							@endforeach
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
    $(document).ready(function () {
		var kode = {!! json_encode($kode) !!};
		var agenda = {!! json_encode($agenda) !!};
		/*var table = $('#users').DataTable({
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/qs/monitoring/kelurahan/kelurahan",
                     "dataType": "json",
                     "type": "POST",
					 "data": function ( d ) {
						 d.agenda=agenda
						 d.kode=kode
				     }
                   },
            success: function(data) {
                 alert('success')
              },
              error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
              },
			  "columns": [
				{ "data": "kode" , name:"kode"},
				{ "data": "nama" , name:"nama"},
				{ "data": "peningkatan" , name:"peningkatan",orderable:false},
                { "data": "pencegahan" , name:"pencegahan",orderable:false},
				{ "data": "ppmk" , name:"ppmk",orderable:false},
				{ "data": "bdi" , name:"bdi",orderable:false}
            ],
			"order": [[ 0, "asc" ]]
	    });*/
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
