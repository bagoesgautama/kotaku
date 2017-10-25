@extends('MAIN/default') {{-- Page title --}} @section('title') Pelaksanaan - Realisasi Kegiatan Skala Kelurahan - Pagu dan Pencairan Dana Kotaku Program @stop {{-- local styles --}} @section('header_styles') 

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
    <h1>Pelaksanaan - Realisasi Kegiatan Skala Kelurahan - Pagu dan Pencairan Dana Kotaku Program</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/pelaksanaan/kelurahan/pagu_pencairan">
                    Pelaksanaan / Realisasi Kegiatan Skala Kelurahan / Pagu dan Pencairan Dana Kotaku Program
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
                    <b>bk010407 index</b>
                </div>
                @if( ! empty($detil['370']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/pelaksanaan/kelurahan/pagu_pencairan/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive"> 
                    <table class="table table-striped" id="users" width="4000px">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>KMW</th>
                                <th>Kota</th>
                                <th>Korkot</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Faskel</th>
                                <th>Tanggal Transaksi</th>
                                <th>Termin</th>
                                <th>Jenis Program</th>
                                <th>Jenis Kegiatan</th>
                                <th>Nilai Dana</th>
                                <th>APBN NSUP</th>
                                <th>APBN NSUP2</th>
                                <th>APBN Direktorat PKP</th>
                                <th>APBN Direktorat Lain</th>
                                <th>APBN K/L Lain</th>
                                <th>APBD Propinsi</th>
                                <th>APBD Kab/Kota</th>
                                <th>Dak</th>
                                <th>Hibah</th>
                                <th>Non Pemerintah</th>
                                <th>Masyarakat</th>
                                <th>Lain</th>
                                <th>Keterangan</th>
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
                     "url": "/main/pelaksanaan/kelurahan/pagu_pencairan",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "tahun" , name:"tahun"},
                { "data": "nama_kmw" , name:"nama_kmw"},
                { "data": "nama_kota" , name:"nama_kota"},
                { "data": "nama_korkot" , name:"nama_korkot"},
                { "data": "nama_kec" , name:"nama_kec"},
                { "data": "nama_kel" , name:"nama_kel"},
                { "data": "nama_faskel" , name:"nama_faskel"},
                { "data": "tgl_transaksi" , name:"tgl_transaksi"},
                { "data": "termin" , name:"termin"},
                { "data": "jns_program" , name:"jns_program"},
                { "data": "jenis_kegiatan" , name:"jenis_kegiatan"},
                { "data": "nilai_dana" , name:"nilai_dana"},
                { "data": "nsl_apbn_nsup" , name:"nsl_apbn_nsup"},
                { "data": "nsl_apbn_nsup2" , name:"nsl_apbn_nsup2"},
                { "data": "nsl_apbn_dir_pkp" , name:"nsl_apbn_dir_pkp"},
                { "data": "nsl_apbn_dir_lain" , name:"nsl_apbn_dir_lain"},
                { "data": "nsl_apbn_kl_lain" , name:"nsl_apbn_kl_lain"},
                { "data": "nsl_apbd_prop" , name:"nsl_apbd_prop"},
                { "data": "nsl_apbd_kota" , name:"nsl_apbd_kota"},
                { "data": "nsl_dak" , name:"nsl_dak"},
                { "data": "nsl_hibah" , name:"nsl_hibah"},
                { "data": "nsl_non_gov" , name:"nsl_non_gov"},
                { "data": "nsl_masyarakat" , name:"nsl_masyarakat"},
                { "data": "nsl_lain" , name:"nsl_lain"},
                { "data": "keterangan" , name:"keterangan"},
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
