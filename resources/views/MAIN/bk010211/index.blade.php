@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Keberfungsian Forum @stop {{-- local styles --}} @section('header_styles')

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
    <h1>MAIN Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                Persiapan
            </li>
            <li class="next">
                Kota atau Kabupaten
            </li>
            <li class="next">
                Forum Kota
            </li>
            <li class="next">
                Keberfungsian Forum
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
                    <b>Keberfungsian Forum</b>
                </div>
                @if( ! empty($detil['160']))
                <div class="tools pull-right">
                    <b>bk010211 index</b>
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ '/main/persiapan/kota/forum/f_forum/create' }}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="kegiatan" width="2000px">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Forum</th>
								<th>Kota</th>
                                <th>Kode Kegiatan</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Peserta Pria</th>
								<th>Peserta Wanita</th>
								<th>Peserta Pemda</th>
								<th>Total</th>
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
        var table = $('#kegiatan').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kota/forum/f_forum",
                     "dataType": "json",
                     "type": "POST"
                   },
            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "jns_forum_convert" , name:"jns_forum_convert"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "kode_kegiatan_convert" , name:"kode_kegiatan_convert"},
                { "data": "tgl_kegiatan" , name:"tgl_kegiatan"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "q_peserta_p" , name:"q_peserta_p"},
				{ "data": "q_peserta_w" , name:"q_peserta_w"},
				{ "data": "q_peserta_pemda" , name:"q_peserta_pemda"},
				{ "data": "total" , name:"total"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order": [[0,"desc"]]
        });
        $('#kegiatan_filter input').unbind();
        $('#kegiatan_filter input').bind('keyup', function(e) {
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
