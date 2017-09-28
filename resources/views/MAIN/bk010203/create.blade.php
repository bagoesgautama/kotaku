@extends('MAIN/default') {{-- Page title --}} @section('title') Blank @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
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
                <a href="/main/persiapan/propinsi/pokja/pembentukan">
                    Persiapan / Propinsi / Pokja / Pembentukan
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
                <label class="col-sm-3 control-label" for="kode">Tahun</label>
                <div class="col-sm-6">
                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                    <input type="number" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Prop</label>
                <div class="col-sm-6">
                    <select id="kode-prop-input" name="kode-prop-input" class="form-control" size="1">
                        @foreach ($kode_prop_list as $kpl)
                            <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Korkot</label>
                <div class="col-sm-6">
                    <select id="kode-korkot-input" name="kode-korkot-input" class="form-control" size="1">
                        @foreach ($kode_korkot_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Faskel</label>
                <div class="col-sm-6">
                    <select id="kode-faskel-input" name="kode-faskel-input" class="form-control" size="1">
                        @foreach ($kode_faskel_list as $kfl)
                            <option value="{{$kfl->kode}}" {!! $kode_faskel==$kfl->kode ? 'selected':'' !!}>{{$kfl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Jenis Kegiatan</label>
                <div class="col-sm-6">
                    <input type="text" id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control" value="{{$jenis_kegiatan}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Kegiatan</label>
                <div class="col-sm-6">
                    <input class="form-control" id="tgl-kegiatan-input" name="tgl-kegiatan-input" placeholder="Tanggal Kegiatan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_kegiatan}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Status Pokja</label>
                <div class="col-sm-6">
                    <select id="status-pokja-input" name="status-pokja-input" class="form-control" size="1">
                        <option value="0" {!! $status_pokja==0 ? 'selected':'' !!}>Lama</option>
                        <option value="1" {!! $status_pokja==1 ? 'selected':'' !!}>Baru</option>
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Dasar Pembentukan</label>
                <div class="col-sm-6">
                    <input type="text" id="dsr-pembentukan-input" name="dsr-pembentukan-input" class="form-control" value="{{$ds_hkm}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Anggota Laki-laki</label>
                <div class="col-sm-6">
                    <input type="number" id="q-laki-input" name="q-laki-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_p}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Anggota Perempuan</label>
                <div class="col-sm-6">
                    <input type="number" id="q-perempuan-input" name="q-perempuan-input" class="form-control" placeholder="Jumlah" value="{{$q_anggota_w}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPP Kementrian/KL</label>
                <div class="col-sm-6">
                    <input type="number" id="upp-kementrian-input" name="upp-kementrian-input" class="form-control" placeholder="" value="{{$upp_kl}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPP Dinas/Badan</label>
                <div class="col-sm-6">
                    <input type="number" id="upp-dinas-input" name="upp-dinas-input" class="form-control" placeholder="" value="{{$upp_dinas}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPP DPR/DPD Pusat/DPRD</label>
                <div class="col-sm-6">
                    <input type="number" id="upp-dpr-input" name="upp-dpr-input" class="form-control" placeholder="" value="{{$upp_dpr}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPNP LSM/Pemerhati Permukiman</label>
                <div class="col-sm-6">
                    <input type="number" id="upnp-lsm-input" name="upnp-lsm-input" class="form-control" placeholder="" value="{{$upn_lsm}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPNP Swasta/Badan Usaha</label>
                <div class="col-sm-6">
                    <input type="number" id="upnp-swasta-input" name="upnp-swasta-input" class="form-control" placeholder="" value="{{$unp_bu}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">UPNP Praktisi/Profesional/Perguruan Tinggi</label>
                <div class="col-sm-6">
                    <input type="number" id="upnp-praktisi-input" name="upnp-praktisi-input" class="form-control" placeholder="" value="{{$upn_praktisi}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Nilai Dana Operasional</label>
                <div class="col-sm-6">
                    <input type="number" id="dana-ops-input" name="dana-ops-input" class="form-control" placeholder="Jumlah" value="{{$nilai_dana_ops}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Rencana Kerja</label>
                <div class="col-sm-6">
                    <input type="text" id="rencana-kerja-input" name="rencana-kerja-input" class="form-control" placeholder="Rencana Kerja" value="{{$url_rencana_kerja}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Keterangan Rencana Kerja</label>
                <div class="col-sm-6">
                    <input type="text" id="ket-rencana-kerja-input" name="ket-rencana-kerja-input" class="form-control" placeholder="Ket. Rencana Kerja" value="{{$ket_rencana_kerja}}">
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
                    <a href="/main/persiapan/nasional/pokja/pembentukan" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/persiapan/propinsi/pokja/pembentukan/create",
            data: $('form').serialize(),
            success: function () {
    alert('From Submitted.');
    window.location.href = "/main/persiapan/propinsi/pokja/pembentukan";
   },
   error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
          });
        });
      });
</script>
@stop
