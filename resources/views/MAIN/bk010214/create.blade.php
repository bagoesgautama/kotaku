@extends('MAIN/default') {{-- Page title --}} @section('title') Blank @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">@stop {{-- Page Header--}} @section('page-header')
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
                <a href="/main/persiapan/kecamatan/keberfungsian">
                    Persiapan / Kecamatan / Keberfungsian Forum
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
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Jenis Forum</label>
                <div class="col-sm-6">
                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                    <select id="jns-forum-input" name="jns-forum-input" class="form-control" size="1">
                        <option value="1" {!! $jns_forum=='1' ? 'selected':'' !!}>BKM/LKM Tingkat Kota</option>
                        <option value="2" {!! $jns_forum=='2' ? 'selected':'' !!}>Kolaborasi Tingkat Kota</option>
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode BKM</label>
                <div class="col-sm-6">
                    <select id="kode-bkm-input" name="kode-bkm-input" class="form-control" size="1">
                        @foreach ($kode_bkm_list as $kbl)
                            <option value="{{$kbl->kode}}" {!! $kode_bkm==$kbl->kode ? 'selected':'' !!}>{{$kbl->kode}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Kolab</label>
                <div class="col-sm-6">
                    <select id="kode-kolab-input" name="kode-kolab-input" class="form-control" size="1">
                        @foreach ($kode_kolab_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kolab==$kkl->kode ? 'selected':'' !!}>{{$kkl->kode}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode kegiatan</label>
                <div class="col-sm-6">
                    <select id="kode-keg-input" name="kode-keg-input" class="form-control" size="1">
                        <option value="0" {!! $kode_kegiatan=='0' ? 'selected':'' !!}>Rapat Internal</option>
                        <option value="1" {!! $kode_kegiatan=='1' ? 'selected':'' !!}>Rapat Dengan Pemda</option>
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                <div class="col-sm-6">
                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                <div class="col-sm-6">
                    <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                <div class="col-sm-6">
                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_p}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                <div class="col-sm-6">
                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_w}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Anggota Pemda</label>
                <div class="col-sm-6">
                    <input type="number" id="q-pemda-input" name="q-pemda-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_pemda}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diser-oleh-input" name="diser-oleh-input" class="form-control" placeholder="Diserahkan Oleh" value="{{$diser_oleh}}" value="{{$diket_tgl}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diket-oleh-input" name="diket-oleh-input" class="form-control" placeholder="Diketahui Oleh" value="{{$diket_oleh}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                <div class="col-sm-3">
                    <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                </div>
                <div class="col-sm-3">
                    <input type="text" id="diver-oleh-input" name="diver-oleh-input" class="form-control" placeholder="Diverifikasi Oleh" value="{{$diver_oleh}}">
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/main/persiapan/kecamatan/keberfungsian" type="button" class="btn btn-effect-ripple btn-danger">
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
        </div>
    </form>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/persiapan/kecamatan/keberfungsian/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/kecamatan/keberfungsian";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
      });
</script>
@stop
