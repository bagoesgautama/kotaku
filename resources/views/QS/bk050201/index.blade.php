@extends('QS/default') {{-- Page title --}} @section('title') Kegiatan Kota @stop {{-- local styles --}} @section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">

@stop {{-- Page Header--}} @section('page-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kegiatan Kota</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> QS
                </a>
            </li>
            <li class="next">
                Master Data / Kegiatan Kota
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
                    <b>bk050201 Index</b>
                </div>
				<div class="tools pull-left">

				</div>
            </div>
			<div class="panel-body">
				<select id="agenda-input" name="agenda-input" class="form-control" size="1" required>
					@foreach ($agenda as $kpl)
						<option value="{{$kpl->kode_slum_prog}}" >{{$kpl->nama}}</option>
					@endforeach
					<option value="999" >nama</option>
				</select>
				<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" id="show" href="#">Show</a>
                <div class="table-responsive">
					<table class="table table-striped" id="users">
						<thead>
                            <tr>
								<th>ID</th>
								<th>Agenda</th>
								<th>Parent</th>
                                <th>Kode Kegiatan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
			<!--<div class="tools pull-left">
				<a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" id="show" href="#">Show</a>
			</div>-->
        </div>
    </div>
</div>
<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
    $(document).ready(function () {
		var dodol = {
			par1: 'parameter'
		}
		var agenda=$('#agenda-input');
		var table = $('#users').DataTable({
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/qs/master/kegiatan_kota",
                     "dataType": "json",
                     "type": "POST",
					 "data": function ( d ) {
						 d.par1=agenda.val()
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
				{ "data": "id" , name:"id"},
				{ "data": "agenda" , name:"agenda"},
				{ "data": "parent" , name:"parent"},
				{ "data": "kode_keg_kota" , name:"kode_keg_kota"}
            ],
			"order": [[ 0, "desc" ]]
	    });

		function setData(){
			console.log('setData',$('#agenda-input').val())
			return {par1:$('#agenda-input').val()}
		}
		console.log('dodol',table)

		/*var table = $("#customerTable").DataTable({
			data:[],
			columns: [
				{ "data": "CompanyId" },
				{ "data": "CompanyName" },
				{ "data": "City" },
				{ "data": "Country" }
			],
			rowCallback: function (row, data) {},
			filter: false,
			info: false,
			ordering: false,
			processing: true,
			retrieve: true
		});*/
		$("#show").on("click", function (event) {
			//query_dt();

			console.log('click');
			table.ajax.reload();
		});
		function query_dt(){
			$.ajax({
				url: "/qs/monitoring/kelurahan",
				type: "post",
				data: function ( d ) {
					 d.agenda =  agenda.val();
				 }
			}).done(function (result) {
				console.log(result)
				table.clear().draw();
				table.rows.add(result).draw();
			}).fail(function (jqXHR, textStatus, errorThrown) {
			// needs to implement if it fails
			});
		}
		$('#users_filter input').unbind();
	    $('#users_filter input').bind('keyup', function(e) {
		    if(e.keyCode == 13) {
		        table.search(this.value).draw();
		    }
	    })
		$("#agenda-input").select2({
			theme: "bootstrap"
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
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
