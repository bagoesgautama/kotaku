@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Kontrak Paket Kerja Kontraktor @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Kontrak Paket Kerja Kontraktor</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/perencanaan/infra/penyiapan_paket">
                    Perencanaan / Penyiapan DED, Pengadaan Skala Kota / Kontrak Paket Kerja Kontraktor
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
                    <b>bk010315 index</b>
                </div>
                @if( ! empty($detil['310']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/kontrak_paket/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive"> 
                    <table class="table table-striped" id="users" width="4000px">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Skala Kegiatan</th>
                                <th>KMW</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Kode Kontraktor</th>
                                <th>Mulai Kontrak</th>
                                <th>Selesai Kontrak</th>
                                <th>Komponen Kegiatan</th>
                                <th>Subkomponen</th>
                                <th>Detail Subkomponen</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Volume Kegiatan</th>
                                <th>Satuan</th>
                                <th>Tipe Penanganan</th>
                                <th>APBN NSUP</th>
                                <th>APBN K/L Lain</th>
                                <th>APBD Propinsi</th>
                                <th>APBD Kab/Kota</th>
                                <th>Lainya</th>
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
                     "url": "/main/perencanaan/kontrak_paket",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "tahun" , name:"tahun"},
                { "data": "skala_kegiatan" , name:"skala_kegiatan"},
                { "data": "nama_kmw" , name:"nama_kmw"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kel" , name:"nama_kel"},
                { "data": "nama_faskel" , name:"nama_faskel"},
                { "data": "kode_kontraktor" , name:"kode_kontraktor"},
                { "data": "tgl_mulai_ktrk" , name:"tgl_mulai_ktrk"},
                { "data": "tgl_selesai_ktrk" , name:"tgl_selesai_ktrk"},
                { "data": "jenis_komponen_keg" , name:"jenis_komponen_keg"},
                { "data": "id_subkomponen" , name:"id_subkomponen"},
                { "data": "id_dtl_subkomponen" , name:"id_dtl_subkomponen"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "dk_vol_kegiatan" , name:"dk_vol_kegiatan"},
                { "data": "dk_satuan" , name:"dk_satuan"},
                { "data": "dk_tipe_penanganan" , name:"dk_tipe_penanganan"},
                { "data": "nb_apbn_nsup" , name:"nb_apbn_nsup"},
                { "data": "nb_apbn_lain" , name:"nb_apbn_kl_lain"},
                { "data": "nb_apbd_prop" , name:"nb_apbd_prop"},
                { "data": "nb_apbd_kota" , name:"nb_apbd_kota"},
                { "data": "nb_lainnya" , name:"nb_lainnya"},
                { "data": "option" , name:"option",orderable:false}
            ]
        });
        $('#pokja_filter input').unbind();
        $('#pokja_filter input').bind('keyup', function(e) {
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
