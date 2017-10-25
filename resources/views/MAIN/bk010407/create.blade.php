@extends('MAIN/default') {{-- Page title --}} @section('title') Pelaksanaan - Realisasi Kegiatan Skala Kelurahan - Pagu dan Pencairan Dana Kotaku Program @stop {{-- local styles --}}
@section('header_styles')

<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">

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
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form  id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                    <input type="number" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}" maxlength="4" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">KMW</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kmw-input" class="form-control select2" name="select-kode_kmw-input" required>
                                        <option value="">Please Select</option>
                                        @foreach ($kode_kmw_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kmw==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input" required>
                                        <option value="">Please Select</option>
                                        @foreach ($kode_kota_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">KorKot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input" required>
                                        <option value="">Please Select</option>
                                        @foreach ($kode_korkot_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input">
                                        <option value="">Please Select</option>
                                        @foreach ($kode_kec_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kec==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input">
                                        <option value="">Please Select</option>
                                        @foreach ($kode_kel_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_kel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_faskel-input" class="form-control select2" name="select-kode_faskel-input">
                                        <option value="">Please Select</option>
                                        @foreach ($kode_faskel_list as $kkl)
                                            <option value="{{$kkl->kode}}" {!! $kode_faskel==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Transaksi</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_transaksi-input" name="tgl_transaksi-input" placeholder="Tanggal Transaksi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_transaksi}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Termin</label>
                                <div class="col-sm-6">
                                    <select id="select-termin-input" class="form-control select2" name="select-termin-input" required>
                                        <option value="">Please Select</option>
                                        <option value="1" {!! $termin=='1' ? 'selected':'' !!}>Termin 1</option>
                                        <option value="2" {!! $termin=='2' ? 'selected':'' !!}>Termin 2</option>
                                        <option value="3" {!! $termin=='3' ? 'selected':'' !!}>Termin 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Jenis Program</label>
                                <div class="col-sm-6">
                                    <select id="select-jns_program-input" class="form-control select2" name="select-jns_program-input" required>
                                        <option value="">Please Select</option>
                                        <option value="1" {!! $jns_program=='1' ? 'selected':'' !!}>Kolaborasi</option>
                                        <option value="2" {!! $jns_program=='2' ? 'selected':'' !!}>PLBK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Jenis Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-jenis_kegiatan-input" class="form-control select2" name="select-jenis_kegiatan-input" required>
                                        <option value="">Please Select</option>
                                        <option value="L" {!! $jenis_kegiatan=='L' ? 'selected':'' !!}>Lingkungan</option>
                                        <option value="S" {!! $jenis_kegiatan=='S' ? 'selected':'' !!}>Sosial</option>
                                        <option value="E" {!! $jenis_kegiatan=='E' ? 'selected':'' !!}>Ekonomi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Nilai Dana</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nilai_dana-input" name="nilai_dana-input" class="form-control" placeholder="Rp" value="{{$nilai_dana}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBN NSUP</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbn_nsup-input" name="nsl_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$nsl_apbn_nsup}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBN NSUP 2</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbn_nsup2-input" name="nsl_apbn_nsup2-input" class="form-control" placeholder="Rp" value="{{$nsl_apbn_nsup2}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBN Direktorat PKP</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbn_dir_pkp-input" name="nsl_apbn_dir_pkp-input" class="form-control" placeholder="Rp" value="{{$nsl_apbn_dir_pkp}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBN Direktorat Lain</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbn_dir_lain-input" name="nsl_apbn_dir_lain-input" class="form-control" placeholder="Rp" value="{{$nsl_apbn_dir_lain}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBN K/L Lain</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbn_kl_lain-input" name="nsl_apbn_kl_lain-input" class="form-control" placeholder="Rp" value="{{$nsl_apbn_kl_lain}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBD PROP</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbd_prop-input" name="nsl_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$nsl_apbd_prop}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBD KAB/KOTA</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_apbd_kota-input" name="nsl_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$nsl_apbd_kota}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">DAK</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_dak-input" name="nsl_dak-input" class="form-control" placeholder="Rp" value="{{$nsl_dak}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Hibah</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_hibah-input" name="nsl_hibah-input" class="form-control" placeholder="Rp" value="{{$nsl_hibah}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Non Pemerintah</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_non_gov-input" name="nsl_non_gov-input" class="form-control" placeholder="Rp" value="{{$nsl_non_gov}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Masyarakat</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_masyarakat-input" name="nsl_masyarakat-input" class="form-control" placeholder="Rp" value="{{$nsl_masyarakat}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Lain</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nsl_lain-input" name="nsl_lain-input" class="form-control" placeholder="Rp" value="{{$nsl_lain}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-textarea-input2">Keterangan</label>
                                <div class="col-sm-6">
                                    <textarea id="keterangan-input" name="keterangan-input" rows="7" class="form-control resize_vertical" placeholder="Keterangan" maxlength="300">{{ $keterangan }}</textarea>
                                </div>
                            </div>
                            <!-- <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                               <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diser_tgl-input" name="diser_tgl-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diser_oleh-input" name="diser_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diket_tgl-input" name="diket_tgl-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diket_oleh-input" name="diket_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                <div class="col-sm-3">
                                    <input class="form-control" id="diver_tgl-input" name="diver_tgl-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}">
                                </div>
                                <div class="col-sm-3">
                                    <select id="diver_oleh-input" name="diver_oleh-input" class="form-control" size="1">
                                        @foreach ($kode_user_list as $kul)
                                            <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/pelaksanaan/kelurahan/pagu_pencairan" type="button" class="btn btn-effect-ripple btn-danger">
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
@stop {{-- local scripts --}} @section('footer_scripts')
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/pelaksanaan/kelurahan/pagu_pencairan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });

        $("#select-skala_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-skala_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        $("#select-termin-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-jns_program-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-jenis_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            console.log(e)
            alert('Field input '+e.target.id+' belum diisi.');
          };
        })(), true);

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var kmw = $('#select-kode_kmw-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kecamatan = $('#select-kode_kec-input');
        var kelurahan = $('#select-kode_kel-input');
        var faskel = $('#select-kode_faskel-input');
        var kmw_id,kota_id,korkot_id,kel_id,kec_id,faskel_id;
        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=undefined){
                kota.empty();
                kota.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/select?kmw="+kmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        kota.change(function(){
            kota_id=kota.val();
            if(kota_id!=undefined){
                korkot.empty();
                korkot.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/select?kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
                kecamatan.empty();
                kecamatan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/select?korkot="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        kecamatan.change(function(){
            kec_id=kecamatan.val();
            console.log(kec_id)
            if(kec_id!=undefined){
                kelurahan.empty();
                kelurahan.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/select?kec="+kec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kelurahan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        kelurahan.change(function(){
            kel_id=kelurahan.val();
            if(kel_id!=undefined){
                faskel.empty();
                faskel.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/pelaksanaan/kelurahan/pagu_pencairan/select?faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
    });
</script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
@stop
