@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Perencanaan Penanganan Permukiman Kota @stop {{-- local styles --}} @section('header_styles') 

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
                Proses Penyusunan Perencanaan Tingkat Kota
            </li>
            <li class="next">
                Perencanaan Penanganan Permukiman Kota
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
                    <b>Perencanaan Penanganan Permukiman Kota</b>
                </div>
                @if( ! empty($detil['270']))
                <div class="tools pull-right">
                    <b>bk010305 index</b>
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/perencanaan/penanganan/lokasi_profile/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="pokja" width="1700px">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tahun</th>
                                <th>Kota</th>
                                <th>Nomor SK Kumuh</th>
                                <th>Luas Kumuh sesuai SK</th>
                                <th>Luas Kumuh sesuai Hasil Verifikasi (Ha)</th>
                                <th>Status Dokumen RP2KP-KP</th>
                                <th>Dasar Hukum RP2KP-KP</th>
                                <th>Jumlah Kelurahan Kumuh</th>
                                <th>Luas Kumuh Berat (Ha)</th>
                                <th>Luas Kumuh Sedang (Ha)</th>
                                <th>Luas Kumuh Ringan (Ha)</th>
                                <th>Jumlah RT Kumuh Berat</th>
                                <th>Jumlah RT Kumuh Sedang</th>
                                <th>Jumlah RT Kumuh Ringan</th>
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
        var table = $('#pokja').DataTable({
            // dom: 'Bflrtip',
            
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/perencanaan/penanganan/lokasi_profile",
                     "dataType": "json",
                     "type": "POST"
                   },

            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "tahun" , name:"tahun"},
                { "data": "kode_kota" , name:"kode_kota"},
                { "data": "lpp_sk_kmh" , name:"lpp_sk_kmh"},
                { "data": "lpp_l_kmh_sk" , name:"lpp_l_kmh_sk"},
                { "data": "lpp_l_kmh_ver" , name:"lpp_l_kmh_ver"},
                { "data": "rp2kp_stat_dok" , name:"rp2kp_stat_dok"},
                { "data": "rp2kp_ds_hukum" , name:"rp2kp_ds_hukum"},
                { "data": "pkkl_q_kel_kmh_thn_curr" , name:"pkkl_q_kel_kmh_thn_curr"},
                { "data": "tk_berat_l_wil" , name:"tk_berat_l_wil"},
                { "data": "tk_sedang_l_wil" , name:"tk_sedang_l_wil"},
                { "data": "tk_ringan_l_wil" , name:"tk_ringan_l_wil"},
                { "data": "tk_berat_q_rt" , name:"tk_berat_q_rt"},
                { "data": "tk_sedang_q_rt" , name:"tk_sedang_q_rt"},
                { "data": "tk_ringan_q_rt" , name:"tk_ringan_q_rt"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order":[[0,"desc"]]
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
