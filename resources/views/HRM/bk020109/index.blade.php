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
			<a href="/hrm">
	            <i class="fa fa-fw fa-home"></i> HRM
			</a>
        </li>
		<li class="active">
            Role akses
        </li>
    </ol>
</section>
@stop {{-- Page content --}} @section('content')
<div class="form-group">
    <label>State
		<select name="cars">
		    @foreach($apps as $type =>$name)
		          <option value="{{ $type }}">{{ $type }}
		        </option>
		    @endforeach
		</select>
    </label>
</div>
<div class="form-group">
    <label>State
		<select name="cars">
		    @foreach($apps-> as $type =>$name)
		          <option value="{{ $type }}">{{ $type }}
		        </option>
		    @endforeach
		</select>
    </label>
</div>
<div class="row">
	<div class="col-sm-8">
		<label class="control-label">
			Select File
		</label>
		<input id="input-43" type="file" class="file-loading">
		<div id="errorBlock43" class="help-block"></div>
	</div>
	<div class="col-sm-4">
		<div class="alert alert-info small m-t-10">
			Disable preview and customize your own error container and messages.
		</div>
	</div>
</div>
<!-- /.modal ends here -->@stop {{-- local scripts --}} @section('footer_scripts')

<script>
/*    $(document).ready(function () {
		var table = $('#role_level').DataTable({
	        // dom: 'Bflrtip',
	        "dom": '<"m-t-10"B><"m-t-10 pull-left"f><"m-t-10 pull-right"l>rt<"pull-left m-t-10"i><"m-t-10 pull-right"p>',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			"processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('hrm/role_level') }}",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
				{ "data": "nama" , name:"nama"},
                { "data": "deskripsi" , name:"deskripsi"},
                { "data": "status" , name:"status"},
                { "data": "created_time" , name:"created_time"},
                { "data": "created_by" , name:"created_by"},
                { "data": "update_time" , name:"update_time"},
                { "data": "update_by" , name:"update_by"},
				{ "data": "option" , name:"option",orderable:false}
            ]
	    });

    });*/
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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_elements.js')}}"></script>
@stop
