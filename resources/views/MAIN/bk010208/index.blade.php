@extends('MAIN/default') {{-- Page title --}} @section('title') Sosialisasi @stop {{-- local styles --}} @section('header_styles') 

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
                Kegiatan
            </li>
            <li class="next">
                Sosialisasi
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
                    <b>Sosialisasi</b>
                </div>
                @if( ! empty($detil['151']))
                <div class="tools pull-right">
                    <b>bk010208 index</b>
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ '/main/persiapan/kota/kegiatan/sosialisasi/create' }}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="kegiatan" width="2200px">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kegiatan</th>
                                <th>Tgl Pelaksanaan</th>
                                <th>Tempat Pelaksanaan</th>
                                <th>Peserta/unsur</th>
                                <th>Narasumber/Unsur</th>
                                <th>Materi Narasumber</th>
                                <th>Pemberitaan Media</th>
                                <th>Hasil Kesepakatan</th>
                                <th>Sumber Pembiayaan</th>
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
                     "url": "/main/persiapan/kota/kegiatan/sosialisasi",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "nama_kegiatan_sos" , name:"nama_kegiatan_sos"},
                { "data": "tgl_kegiatan_sos" , name:"tgl_kegiatan_sos"},
                { "data": "lok_kegiatan_sos" , name:"lok_kegiatan_sos"},
                { "data": "peserta" , name:"peserta"},
                { "data": "narasumber" , name:"narasumber"},
                { "data": "materi" , name:"materi"},
                { "data": "media" , name:"media"},
                { "data": "hasil_kesepakatan" , name:"hasil_kesepakatan"},
                { "data": "sumber_pembiayaan" , name:"sumber_pembiayaan"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order":[[0,"desc"]]
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
