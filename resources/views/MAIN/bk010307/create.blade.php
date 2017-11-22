@extends('MAIN/default') {{-- Page title --}} @section('title') Main - Rencana Investasi Tahunan @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
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
                <a href="/main/perencanaan/penanganan/rencana_investasi">
                    Perencanaan / Penanganan / Penanganan Pemukiman Kota / RP2KP-KP/SIAP / Rencana Investasi Tahunan
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
                                        Data Umum
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Rencana Investasi Tahunan (Form Data Kegiatan)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Rencana Investasi Tahunan (Form Nilai/Biaya)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Rencana Investasi Tahunan (Form Target Penerima Manfaat)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab5" data-toggle="tab">
                                        Dokumen
                                    </a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered" data-bv-excluded="disabled">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                        <div class="col-sm-6">
                                        <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                            <select id="tahun-input" name="tahun-input" class="form-control select2" size="1" required data-bv-callback="true" data-bv-callback-message="Tahun melebihi current year." data-bv-callback-callback="tahun">
                                                <option value>Please select</option>
                                                @foreach($tahun_list as $list)
                                                    <option value="{{ $list->tahun }}" {!! $list->tahun==$tahun?"selected":"" !!}>{{ $list->tahun }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kota</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @if ($kode_kota_list!=null)
                                                @foreach ($kode_kota_list as $kkl)
                                                    <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Jenis Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="jns-kegiatan-input" name="jns-kegiatan-input" class="form-control select2" size="1" required>
                                                <option value>Please Select</option>
                                                <option value="L" {!! $jenis_kegiatan=='L' ? 'selected':'' !!}>Lingkungan</option>
                                                <option value="S" {!! $jenis_kegiatan=='S' ? 'selected':'' !!}>Sosial</option>
                                                <option value="E" {!! $jenis_kegiatan=='E' ? 'selected':'' !!}>Ekonomi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Sub Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-subkomponen-input" name="kode-subkomponen-input" class="form-control select2" size="1" required>
                                                <option value>Please select</option>
                                                @foreach ($kode_subkomponen_list as $ksl)
                                                    <option value="{{$ksl->id}}" {!! $id_subkomponen==$ksl->id ? 'selected':'' !!}>{{$ksl->kode_subkomponen.' '.$ksl->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">Sub Detail Komponen Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="select-kode-subdtlkomponen-input" name="kode-subdtlkomponen-input" class="form-control select2" size="1">
                                                <option value>Please select</option>
                                                @if ($kode_subdtlkomponen_list!=null)
                                                @foreach ($kode_subdtlkomponen_list as $ksl)
                                                    <option value="{{$ksl->id}}" {!! $id_dtl_subkomponen==$ksl->id ? 'selected':'' !!}>{{$ksl->kode_dtl_subkomponen.' '.$ksl->nama}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-sm-3 control-label">Skala Kegiatan</label>
                                        <div class="col-sm-6">
                                            <select id="skala_kegiatan" name="skala_kegiatan" class="form-control" size="1" required>
                                                <option value="1" {!! $skala_kegiatan=='1' ? 'selected':'' !!}>Kota/Kabupaten</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lokasi Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="lok-kegiatan-input" name="lok-kegiatan-input" class="form-control" value="{{$lok_kegiatan}}" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jumlah Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="dk_q_kegiatan" name="dk_q_kegiatan" class="form-control" value="{{$dk_q_kegiatan}}" maxlength="6" placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Volume Kegiatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="dk_vol_kegiatan" name="dk_vol_kegiatan" class="form-control" value="{{$dk_vol_kegiatan}}" maxlength="50" placeholder="Volume">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Satuan</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="dk_satuan" name="dk_satuan" class="form-control" value="{{$dk_satuan}}" maxlength="50" placeholder="Satuan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBN(PUPR)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_pupr" name="nb_apbn_pupr" class="form-control" value="{{$nb_apbn_pupr}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBN(K/L Lain)(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbn_kl_lain" name="nb_apbn_kl_lain" class="form-control" value="{{$nb_apbn_kl_lain}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBD Provinsi(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_prop" name="nb_apbd_prop" class="form-control" value="{{$nb_apbd_prop}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">APBD Kab/Kota/BUMD(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_apbd_kota" name="nb_apbd_kota" class="form-control" value="{{$nb_apbd_kota}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Hibah, DAK, Dll(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_hibah" name="nb_hibah" class="form-control" value="{{$nb_hibah}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Non Pemerintah(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_non_gov" name="nb_non_gov" class="form-control" value="{{$nb_non_gov}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Masyarakat(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_masyarakat" name="nb_masyarakat" class="form-control" value="{{$nb_masyarakat}}" maxlength="27" placeholder="Nilai" step="0.01"  min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Lainnya(Rp)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="nb_lainnya" name="nb_lainnya" class="form-control" value="{{$nb_lainnya}}" maxlength="27" placeholder="Nilai" step="0.01" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jiwa</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_jiwa" name="tpm_q_jiwa" class="form-control" value="{{$tpm_q_jiwa}}" maxlength="9" placeholder="Jumlah" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Jiwa Perempuan</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_jiwa_w" name="tpm_q_jiwa_w" class="form-control" value="{{$tpm_q_jiwa_w}}" maxlength="9" placeholder="Jumlah" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">MBR</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_mbr" name="tpm_q_mbr" class="form-control" value="{{$tpm_q_mbr}}" maxlength="9" placeholder="Jumlah" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KK</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_kk" name="tpm_q_kk" class="form-control" value="{{$tpm_q_kk}}" maxlength="9" placeholder="Jumlah" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="example-text-input1">KK Miskin (40% BPS)</label>
                                        <div class="col-sm-6">
                                            <input type="number" id="tpm_q_kk_miskin" name="tpm_q_kk_miskin" class="form-control" value="{{$tpm_q_kk_miskin}}" maxlength="9" placeholder="Jumlah" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane fade ">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Format Input Manual SIM</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_document-input" type="file" class="file" accept="image/*" name="uri_img_document-input">
                                            <br>
                                            <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/penyusunan/rencana_investasi/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_document-file" name="uri_img_document-file" value="{{$uri_img_document}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">Delete</button>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label">File Absensi</label>
                                        <div class="col-sm-6">
                                            <input id="uri_img_absensi-input" type="file" class="file" accept="image/*" name="uri_img_absensi-input">
                                            <br>
                                            <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/penyusunan/rencana_investasi/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                            <input type="hidden" id="uri_img_absensi-file" name="uri_img_absensi-file" value="{{$uri_img_absensi}}">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">Delete</button>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="diser-oleh-input" name="diser-oleh-input" class="form-control" size="1">
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="diket-oleh-input" name="diket-oleh-input" class="form-control" size="1" required>
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group striped-col">
                                        <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="diver-oleh-input" name="diver-oleh-input" class="form-control" size="1" required>
                                                @foreach ($kode_user_list as $kul)
                                                    <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/main/perencanaan/penanganan/rencana_investasi" type="button" class="btn btn-effect-ripple btn-danger">
                                Cancel
                            </a>
                            @if ($detil_menu=='279' || $detil_menu=='278')
                            <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                Submit
                            </button>
                            @endif
                            <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
{{-- local scripts --}} @section('footer_scripts')
<script>
    function tahun(value, validator) {
        var yearNow = (new Date()).getFullYear();
        var thn = parseInt($('#tahun-input').val());
        
        var res = true;
        if(thn>yearNow){
            res=false;
        }
        return res;
    };
    function test(id){
        console.log(id)
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        var elem2 = $('#'+id+'-file');
        elem2.removeAttr('value');
        return false;
    }
      $(document).ready(function () {
		$("#file-dokumen-input").fileinput({
  	  		showUpload: false
  	  	});
  	  	$("#file-absensi-input").fileinput({
  	  		showUpload: false
  	  	});
        $('#jns-kegiatan-input')
            .on('change', function(e) {
                // Revalidate the date when user change it
                $('#form').bootstrapValidator('revalidateField', 'kode-subkomponen-input');
                // $("#submit").prop('disabled', false);
        });
        $("#uri_img_document-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        });

        $("#uri_img_absensi-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        }); 
        $('#form').bootstrapValidator().on('success.form.bv', function(e) { 
            $('#form').on('submit', function (e) {
                var form_data = new FormData(this);
              e.preventDefault();
              $.ajax({
                type: 'post',
                processData: false,
                contentType: false,
                "url": "/main/perencanaan/penanganan/rencana_investasi/create",
                data: form_data,
                beforeSend: function (){
                    $("#submit").prop('disabled', true);
                },
                success: function () {

                alert('From Submitted.');
                window.location.href = "/main/perencanaan/penanganan/rencana_investasi";
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
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-subkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#select-kode-subdtlkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#jns-kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
        $("#tahun-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);

        var kmw = $('#select-kode-kmw-input');
        var kota = $('#select-kode-kota-input');
        var korkot = $('#select-kode-korkot-input');
        var kec = $('#select-kode-kec-input');
        var kel = $('#select-kode-kel-input');
        var faskel = $('#select-kode-faskel-input');
        var jns_keg = $('#jns-kegiatan-input');
        var subkomponen = $('#select-kode-subkomponen-input');
        var dtlsubkomponen = $('#select-kode-subdtlkomponen-input');
        var satuan = $('#dk_satuan');
        var kmw_id,kota_id,korkot_id,kec_id,kel_id,faskel_id,subkomponen_id,dtlsubkomponen_id,jns_keg_id;

        // kmw.change(function(){
        //     kmw_id=kmw.val();
        //     if(kmw_id!=null){
        //         kota.empty();
        //         kota.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/rencana_investasi/select?kmw="+kmw_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        // kota.change(function(){
        //     kota_id=kota.val();
        //     kmw_id=kmw.val();
        //     if(kota_id!=null){
        //         korkot.empty();
        //         korkot.append("<option value>Please select</option>");
        //         $.ajax({
        //             type: 'get',
        //             "url": "/main/perencanaan/penanganan/rencana_investasi/select?kota_korkot="+kota_id,
        //             success: function (data) {
        //                 data=JSON.parse(data)
        //                 for (var i=0;i<data.length;i++){
        //                     korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
        //                 }
        //             }
        //         });
        //     }
        // });

        jns_keg.change(function(){
            jns_keg_id=jns_keg.val();
            if(jns_keg_id!=null){
                subkomponen.empty().trigger('change');;
                dtlsubkomponen.empty().trigger('change');;
                satuan.val(null).trigger('change');
                subkomponen.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/penanganan/rencana_investasi/select?jns_keg="+jns_keg_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            subkomponen.append("<option value="+data[i].id+" >"+data[i].kode_subkomponen+" "+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        subkomponen.change(function(){
            subkomponen_id=subkomponen.val();
            if(subkomponen_id!=null){
                dtlsubkomponen.empty().trigger('change');;
                satuan.val(null).trigger('change');
                dtlsubkomponen.append("<option value>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/penanganan/rencana_investasi/select?id_subkomponen="+subkomponen_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            dtlsubkomponen.append("<option value="+data[i].id+" >"+data[i].kode_dtl_subkomponen+" "+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        dtlsubkomponen.change(function(){
            dtlsubkomponen_id=dtlsubkomponen.val();
            if(dtlsubkomponen_id!=null){
                satuan.val(null).trigger('change');
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/penanganan/rencana_investasi/select?id_dtl_subkomponen="+dtlsubkomponen_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        satuan.val(data[0].satuan);
                    }
                });
            }
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
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
