@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Data BKM @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">

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
    <h1>Data BKM</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/persiapan/kelurahan/pemilu_bkm/data">
                    Persiapan / Kelurahan / Pemilihan Ulang BKM/LKM / Data BKM
                </a>
            </li>
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading tab-list">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                                        Data BKM
                                    </a>
                    </li>
                    @if($kode!=null)
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Anggota
                                    </a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label">Pemilu Ulang BKM/LKM</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="kode" name="kode" value="{{$kode}}">
                                                <input type="hidden" id="kode_bkm" name="kode_bkm" value="{{$kode_bkm}}">
                                                <input type="hidden" id="detil_menu" name="detil_menu" value="{{ $detil_menu }}">
                                                <select id="kel_bkm-input" name="kel_bkm-input" class="form-control select2" size="1" required>
                                                    <option value>Please select</option>
                                                    @foreach ($kode_pemilu_bkm_list as $kkl)
                                                        <option value="{{$kkl->kode}}" {!! $kode_pemilu==$kkl->kode ? 'selected':'' !!}>{{$kkl->tahun.'-'.$kkl->nama_kel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">BKM/LKM</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="bkm" name="bkm" class="form-control" value="{{$bkm}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="tahun" name="tahun" class="form-control" value="{{$tahun}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Anggota</label></div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label">Laki-laki </label>
                                            <div class="col-sm-6">
                                                <input type="text" id="l" name="l" class="form-control" value="{{$q_terpilih_p}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Perempuan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="p" name="p" class="form-control" value="{{$q_terpilih_w}}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="col-sm-3 control-label">MBR/Miskin</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="mbr" name="mbr" class="form-control" value="{{$q_terpilih_mbr}}" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-actions">
                                            <div class="col-sm-9 col-sm-offset-3">
                                                <a href="/main/persiapan/kelurahan/pemilu_bkm/data" type="button" class="btn btn-effect-ripple btn-danger">
                                                    Cancel
                                                </a>
                                                <!-- <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                                    Reset
                                                </button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade active">
                        <div class="panel-body border">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel filterable">
                                        <div class="panel-heading clearfix  ">
                                            <div class="panel-title pull-left">
                                                <b>Daftar Peserta BKM</b>
                                            </div>
                                            @if( ! empty($detil['589']) && $detil_menu=='589')
                                            <div class="tools pull-right">
                                                <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/persiapan/kelurahan/pemilu_bkm/data/anggota/create?kode='.$kode.'&kode_bkm='.$kode_bkm}}">Tambah</a>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="anggota">
                                                    <thead>
                                                        <tr>
                                                            <th>Kode</th>
                                                            <th>Nama Anggota</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th>Status Sosial</th>
                                                            <th>Pendidikan</th>
                                                            <th>Pekerjaan</th>
                                                            <th>Jumlah Dukungan</th>
                                                            <th>Option</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script>
      $(document).ready(function () {
        var kode_bkm = $('#kode_bkm').val();
        var kode = $('#kode').val();
        var detil_menu = $('#detil_menu').val();
        var table = $('#anggota').DataTable({
            // dom: 'Bflrtip',

            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "/main/persiapan/kelurahan/pemilu_bkm/data/anggota",
                     "dataType": "json",
                     "data": {kode_bkm : kode_bkm, kode : kode,detil_menu : detil_menu},
                     "type": "POST"
                   },
            "columns": [
                { "data": "kode" , name:"kode"},
                { "data": "nama" , name:"nama"},
                { "data": "jenis_kelamin" , name:"jenis_kelamin"},
                { "data": "status_sosial" , name:"status_sosial"},
                { "data": "nama_pendidikan" , name:"nama_pendidikan"},
                { "data": "nama_pekerjaan" , name:"nama_pekerjaan"},
                { "data": "jml_dukungan" , name:"jml_dukungan"},
                { "data": "option" , name:"option",orderable:false}
            ],
            "order": [[ 0, "desc" ]]
        });
        $('#bkm_filter input').unbind();
        $('#bkm_filter input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
                table.search(this.value).draw();
            }
        })
        
        var pemilu = $('#kel_bkm-input');
        var bkm = $('#bkm');
        var thn = $('#tahun');
        var l = $('#l');
        var p = $('#p');
        var mbr = $('#mbr');
        var pemilu_id;
        pemilu.change(function(){
            pemilu_id=pemilu.val();
            if(pemilu_id!=null){
                bkm.empty();
                thn.empty();
                l.empty();
                p.empty();
                mbr.empty();
                $.ajax({
                    type: 'get',
                    "url": "/main/persiapan/kelurahan/pemilu_bkm/data/select?kode_pemilu="+pemilu_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            bkm.val(data[i].nama_bkm);
                            $('#tahun').val(data[i].tahun);
                            $('#l').val(data[i].q_terpilih_p);
                            $('#p').val(data[i].q_terpilih_w);
                            $('#mbr').val(data[i].q_terpilih_mbr);
                        }
                    }
                });
            }
        });
        
        $("#kel_bkm-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
      });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

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
