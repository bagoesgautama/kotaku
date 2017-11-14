@extends('MAIN/default') {{-- Page title --}} @section('title') Pelatihan Masyarakat @stop {{-- local styles --}} @section('header_styles') 

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
                Kelurahan
            </li>
            <li class="next">
                Kegiatan Kelurahan
            </li>
            <li class="next">
                Pelatihan Masyarakat
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
                    <b>Pelatihan Masyarakat</b>
                </div>
                @if( ! empty($detil['246']))
                <div class="tools pull-right">
                    <b>bk010219 index</b>
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{ '/main/persiapan/kelurahan/pelatihan/create' }}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="kegiatan">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Tahun</th>
                                <th>Jenis Pelatihan</th>
                                <th>Tgl Kegiatan</th>
                                <th>Lokasi</th>
                                <th>Peserta Laki-laki</th>
                                <th>Peserta Perempuan</th>
                                <th>Peserta Miskin/MBR</th>
                                <th>Nilai Dana</th>
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
                     "url": "/main/persiapan/kelurahan/pelatihan",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "kode_kec" , name:"kode_kec"},
                { "data": "kode_kel" , name:"kode_kel"},
                { "data": "tahun" , name:"tahun"},
                { "data": "id_pelatihan" , name:"id_pelatihan"},
                { "data": "tgl_kegiatan" , name:"tgl_kegiatan"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "q_peserta_p" , name:"q_peserta_p"},
                { "data": "q_peserta_w" , name:"q_peserta_w"},
                { "data": "q_peserta_mbr" , name:"q_peserta_mbr"},
                { "data": "nilai_dana" , name:"nilai_dana"},
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
