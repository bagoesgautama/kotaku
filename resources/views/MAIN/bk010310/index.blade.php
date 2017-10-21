@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Investasi 5 Tahun @stop {{-- local styles --}} @section('header_styles') 

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
                Perencanaan
            </li>
            <li class="next">
                Investasi 5 Tahun
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
                    <b>bk010310 index</b>
                </div>
                @if( ! empty($detil['294']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/kawasan/investasi/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="users">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kawasan Prioritas</th>
                                <th>KMW</th>
                                <th>Faskel</th>
                                <th>Jenis Kegiatan</th>
                                <th>Subkomponen</th>
                                <th>Detail Subkomponen</th>
                                <th>Lokasi Kegiatan</th>
                                <th>Jumlah Kegiatan</th>
                                <th>Volume Kegiatan</th>
                                <th>Satuan</th>
                                <th>APBN PUPR</th>
                                <th>APBN K/L Lain</th>
                                <th>APBD Propinsi</th>
                                <th>APBD Kab/Kota</th>
                                <th>Hibah</th>
                                <th>Non Pemerintah</th>
                                <th>Masyarakat</th>
                                <th>Lainya</th>
                                <th>Jiwa</th>
                                <th>Perempuan</th>
                                <th>MBR</th>
                                <th>KK</th>
                                <th>KK Miskin</th>
                                <th>Create Time</th>
                                <th>Create By</th>
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
                     "url": "/main/perencanaan/kawasan/investasi",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "tahun" , name:"tahun"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kawasan" , name:"nama_kawasan"},
                { "data": "nama_kmw" , name:"nama_kmw"},
                { "data": "nama_faskel" , name:"nama_faskel"},
                { "data": "jenis_kegiatan" , name:"jenis_kegiatan"},
                { "data": "id_subkomponen" , name:"id_subkomponen"},
                { "data": "id_dtl_subkomponen" , name:"id_dtl_subkomponen"},
                { "data": "lok_kegiatan" , name:"lok_kegiatan"},
                { "data": "dk_q_kegiatan" , name:"dk_q_kegiatan"},
                { "data": "dk_vol_kegiatan" , name:"dk_vol_kegiatan"},
                { "data": "dk_satuan" , name:"dk_satuan"},
                { "data": "nb_apbn_pupr" , name:"nb_apbn_pupr"},
                { "data": "nb_apbn_kl_lain" , name:"nb_apbn_kl_lain"},
                { "data": "nb_apbd_prop" , name:"nb_apbd_prop"},
                { "data": "nb_apbd_kota" , name:"nb_apbd_kota"},
                { "data": "nb_hibah" , name:"nb_hibah"},
                { "data": "nb_non_gov" , name:"nb_non_gov"},
                { "data": "nb_masyarakat" , name:"nb_masyarakat"},
                { "data": "nb_lainnya" , name:"nb_lainnya"},
                { "data": "tpm_q_jiwa" , name:"tpm_q_jiwa"},
                { "data": "tpm_q_jiwa_w" , name:"tpm_q_jiwa_w"},
                { "data": "tpm_q_mbr" , name:"tpm_q_mbr"},
                { "data": "tpm_q_kk" , name:"tpm_q_kk"},
                { "data": "tpm_q_kk_miskin" , name:"tpm_q_kk_miskin"},
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
