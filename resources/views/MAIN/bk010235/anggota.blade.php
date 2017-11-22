@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Data BKM @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/colReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/rowReorder.bootstrap.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/buttons.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/datatables/css/scroller.bootstrap.css')}}">
<link href="{{asset('vendors/hover/css/hover-min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons_sass.css')}}" rel="stylesheet">

<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
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
                <a href="/main/persiapan/kelurahan/pemilu_bkm/data/create?kode={{$kode}}">
                    Persiapan / Kelurahan / Pemilihan Ulang BKM/LKM / Data BKM / Create
                </a>
            </li>
            <li class="next">
                Peserta BKM
            </li>
        </ul>
    </div>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col ">
                                <label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="hidden" id="kode_bkm" name="kode_bkm" value="{{ $kode_bkm }}">
                                    <input type="hidden" id="kode_anggota" name="kode_anggota" value="{{ $kode_anggota }}">
                                    <input type="text" id="nama" name="nama" class="form-control" maxlength="100" placeholder="Nama" value="{{$nama}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Jenis Kelamin</label>
                                <div class="col-sm-6">
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select2" size="1" data-bv-callback="true" data-bv-callback-message="Jumlah peserta pemilu BKM terpilih dengan jenis kelamin yang dipiilih tidak boleh melebihi jumlah yang ada." data-bv-callback-callback="gender">
                                        <option value>Please Select</option>
                                        <option value="L" {!! $jenis_kelamin=='L'?'selected':'' !!}>Laki-laki</option>
                                        <option value="P" {!! $jenis_kelamin=='P'?'selected':'' !!}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Status Sosial</label>
                                <div class="col-sm-6">
                                    <select id="status_sosial" name="status_sosial" class="form-control select2" size="1" data-bv-callback="true" data-bv-callback-message="Jumlah peserta pemilu BKM terpilih MBR/Miskin tidak boleh melebihi jumlah yang ada." data-bv-callback-callback="mbr">
                                        <option value>Please Select</option>
                                        <option value="0" {!! $status_sosial=='0'?'selected':'' !!}>Miskin dan Rentan</option>
                                        <option value="1" {!! $status_sosial=='1'?'selected':'' !!}>Non Miskin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Umur</label>
                                <div class="col-sm-6">
                                    <input type="number" id="umur" name="umur" class="form-control" maxlength="3" required min="1" placeholder="Umur" value="{{$umur}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Pendidikan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-pendidikan-input" name="kode-pendidikan-input" class="form-control select2" size="1">
                                        <option value>Please select</option>
                                        @foreach ($kode_pendidikan_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_pendidikan==$kkl->kode?'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Pekerjaan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode-pekerjaan-input" name="kode-pekerjaan-input" class="form-control select2" size="1">
                                        <option value>Please select</option>
                                        @foreach ($kode_pekerjaan_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_pekerjaan==$kkl->kode?'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Jumlah Pendukung</label>
                                <div class="col-sm-6">
                                    <input type="number" id="jml_dukungan" name="jml_dukungan" class="form-control" maxlength="6" required min="0" placeholder="Jumlah Pendukung" value="{{$jml_dukungan}}">
                                </div>
                            </div>
                            @if($kode_anggota!=null)
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select id="status" name="status" class="form-control" size="1">
                                        <option value="0" {!! $status=='0'?'selected':'' !!}>Tidak Aktif</option>
                                        <option value="1" {!! $status=='1'?'selected':'' !!}>Aktif</option>
                                        <option value="2" {!! $status=='2'?'selected':'' !!}>Sudah Dihapus</option>
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/pemilu_bkm/data/create?kode={{$kode}}" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')

<script>
    function gender(value, validator) {
        var pemilu_bkm = {!! json_encode($pemilu_bkm) !!};
        var anggota_pemilu_bkm_p = {!! json_encode($anggota_pemilu_bkm_p) !!};
        var anggota_pemilu_bkm_w = {!! json_encode($anggota_pemilu_bkm_w) !!};

        var res = true;
        var jenis_kelamin = $('#jenis_kelamin').val();
        if(jenis_kelamin=="P"){
            if(pemilu_bkm[0].q_terpilih_w==anggota_pemilu_bkm_w[0].cnt){
                res=false;
            }
        }else if(jenis_kelamin=="L"){
            if(pemilu_bkm[0].q_terpilih_p==anggota_pemilu_bkm_p[0].cnt){
                res=false;
            }
        }
        
        return res;
    }; 
    function mbr(value, validator) {
        var pemilu_bkm = {!! json_encode($pemilu_bkm) !!};
        var anggota_pemilu_bkm_mbr = {!! json_encode($anggota_pemilu_bkm_mbr) !!};

        var res = true;
        var status_sosial = parseInt($('#status_sosial').val());
        if(status_sosial==0){
            if(pemilu_bkm[0].q_terpilih_mbr==anggota_pemilu_bkm_mbr[0].cnt){
                res=false;
            }
        }
        
        return res;
    }; 
      $(document).ready(function () {
        var kode = $('#kode').val();

        $("#select-kode-pendidikan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#select-kode-pekerjaan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#jenis_kelamin").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });
        $("#status_sosial").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $('#form').bootstrapValidator().on('success.form.bv', function(e) {
            $('#form').on('submit', function (e) {
                e.preventDefault();
                var form_data = new FormData(this);
              $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/persiapan/kelurahan/pemilu_bkm/data/anggota/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {

                // alert('From Submitted.');
                window.location.href = "/main/persiapan/kelurahan/pemilu_bkm/data/create?kode="+kode;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
                  $("#submit").prop('disabled', false);
                }
              });
            });
        }).on('error.form.bv', function(e) {
            $("#submit").prop('disabled', false);
        });
      });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>

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

<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
@stop
