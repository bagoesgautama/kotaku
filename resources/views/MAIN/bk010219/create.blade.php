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
                <a href="/main/persiapan/kelurahan/pelatihan">
                    Persiapan / Kelurahan / Kegiatan Kelurahan / Pelatihan Masyarakat
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
                <label class="col-sm-3 control-label">Kode Prop</label>
                <div class="col-sm-6">
                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                    <select id="kode-prop-input" name="kode-prop-input" class="form-control" size="1">
                        @foreach ($kode_prop_list as $kpl)
                            <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Kota</label>
                <div class="col-sm-6">
                    <select id="kode-kota-input" name="kode-kota-input" class="form-control" size="1">
                        @foreach ($kode_kota_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Kecamatan</label>
                <div class="col-sm-6">
                    <select id="kode-kec-input" name="kode-kec-input" class="form-control" size="1">
                        @foreach ($kode_kec_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kode Kelurahan</label>
                <div class="col-sm-6">
                    <select id="kode-kel-input" name="kode-kel-input" class="form-control" size="1">
                        @foreach ($kode_kel_list as $kkl)
                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
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
                <label class="col-sm-3 control-label">Kode Pelatihan</label>
                <div class="col-sm-6">
                    <select id="id-pelatihan-input" name="id-pelatihan-input" class="form-control" size="1">
                        @foreach ($kode_pelatihan_list as $kpl)
                            <option value="{{$kpl->id}}" {!! $id_pelatihan==$kpl->id ? 'selected':'' !!}>{{$kpl->kode_pelatihan}}</option>
                        @endforeach
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
                <label class="col-sm-3 control-label" for="kode">Anggota Miskin/MBR</label>
                <div class="col-sm-6">
                    <input type="number" id="q-mbr-input" name="q-mbr-input" class="form-control" placeholder="Jumlah" value="{{$q_peserta_mbr}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Pembiayaan Pelatihan BDI</label>
                <div class="col-sm-6">
                    <input type="number" id="rp-bdi-input" name="rp-bdi-input" class="form-control" placeholder="Jumlah" value="{{$rp_dana_bdi}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Pembiayaan Pelatihan Swadaya</label>
                <div class="col-sm-6">
                    <input type="number" id="rp-swadaya-input" name="rp-swadaya-input" class="form-control" placeholder="Jumlah" value="{{$rp_dana_swadaya}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="kode">Keterangan</label>
                <div class="col-sm-6">
                    <input type="text" id="keterangan-input" name="keterangan-input" class="form-control" placeholder="Keterangan" value="{{$keterangan}}">
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
                    <a href="/main/persiapan/kelurahan/pelatihan" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/persiapan/kelurahan/pelatihan/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('From Submitted.');
            window.location.href = "/main/persiapan/kelurahan/pelatihan";
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
