@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Kontrak Paket Pekerjaan Kontraktor @stop {{-- local styles --}}
@section('header_styles')

<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">

@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Penyiapan DED, Pengadaan Skala Kota - Kontrak Paket Pekerjaan Kontraktor</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/perencanaan/kontrak_paket">
                    Perencanaan / Penyiapan DED, Pengadaan Skala Kota / Kontrak Paket Pekerjaan Kontraktor
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
                                <label class="col-sm-3 control-label" for="example-text-input31">Skala Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-skala_kegiatan-input" class="form-control select2" name="select-skala_kegiatan-input" required>
                                        <option value="">Please Select</option>
                                        <option value="P" {!! $skala_kegiatan=='P' ? 'selected':'' !!}>Primer</option>
                                        <option value="S" {!! $skala_kegiatan=='S' ? 'selected':'' !!}>Sekunder</option>
                                        <option value="T" {!! $skala_kegiatan=='T' ? 'selected':'' !!}>Tersier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
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
                            <div class="form-group striped-col">
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
                            <div class="form-group">
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
                            <div class="form-group striped-col">
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
                            <div class="form-group">
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
                            <div class="form-group striped-col">
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Nama Kontraktor</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kontraktor-input" class="form-control select2" name="select-kode_kontraktor-input" required> 
                                        <option value="">Please Select</option>
                                        @foreach ($kode_kontraktor_list as $ksl)
                                            <option value="{{$ksl->kode}}" {!! $kode_kontraktor==$ksl->kode ? 'selected':'' !!}>{{$ksl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Mulai Kontrak</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_mulai_ktrk-input" name="tgl_mulai_ktrk-input" placeholder="Tanggal Mulai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_mulai_ktrk}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Selesai Kontrak</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="tgl_selesai_ktrk-input" name="tgl_selesai_ktrk-input" placeholder="Tanggal Selesai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_selesai_ktrk}}" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Jenis Komponen Kegiatan</label>
                                <div class="col-sm-6">                                
                                    <select id="select-jenis_komponen_keg-input" class="form-control select2" name="select-jenis_komponen_keg-input" required>
                                        <option value="">Please Select</option>
                                        <option value="L" {!! $jenis_komponen_keg=='L' ? 'selected':'' !!}>Lingkungan</option>
                                        <option value="S" {!! $jenis_komponen_keg=='S' ? 'selected':'' !!}>Sosial</option>
                                        <option value="E" {!! $jenis_komponen_keg=='E' ? 'selected':'' !!}>Ekonomi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Sub Komponen</label>
                                <div class="col-sm-6">
                                    <select id="select-id_subkomponen-input" class="form-control select2" name="select-id_subkomponen-input" required>
                                        <option value="">Please Select</option>
                                        @foreach($kode_id_subkomponen_list as $list)
                                            <option value="{{ $list->id }}" @if($list->id==$id_subkomponen) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Detail Sub Komponen</label>
                                <div class="col-sm-6">
                                    <select id="select-id_dtl_subkomponen-input" class="form-control select2" name="select-id_dtl_subkomponen-input">
                                        <option value="">Please Select</option>
                                        @foreach ($kode_id_dtl_subkomponen_list as $ksl)
                                            <option value="{{$ksl->id}}" {!! $id_dtl_subkomponen==$ksl->id ? 'selected':'' !!}>{{$ksl->kode_dtl_subkomponen.' '.$ksl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Volume Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dk_vol_kegiatan-input" name="dk_vol_kegiatan-input" class="form-control" placeholder="Volume Kegiatan" value="{{$dk_vol_kegiatan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Satuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dk_satuan-input" name="dk_satuan-input" class="form-control" placeholder="Satuan" value="{{$dk_satuan}}" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                 <label class="col-sm-3 control-label" for="example-text-input31">Kategori Penanganan</label>
                                <div class="col-sm-6">
                                    <select id="select-dk_tipe_penanganan-input" class="form-control select2" name="select-dk_tipe_penanganan-input-input">
                                        <option value="">Please Select</option>
                                        <option value="0" {!! $dk_tipe_penanganan=='0' ? 'selected':'' !!}>Rehab</option>
                                        <option value="1" {!! $dk_tipe_penanganan=='1' ? 'selected':'' !!}>Baru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBN NSUP (PHLN)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nb_apbn_nsup-input" name="nb_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$nb_apbn_nsup}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBN Lainya (PHLN/RM)</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nb_apbn_lain-input" name="nb_apbn_lain-input" class="form-control" placeholder="Rp" value="{{$nb_apbn_lain}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">APBD PROP</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nb_apbd_prop-input" name="nb_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$nb_apbd_prop}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">APBD KAB/KOTA</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nb_apbd_kota-input" name="nb_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$nb_apbd_kota}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lainya</label>
                                <div class="col-sm-6">
                                    <input type="number" id="nb_lainnya-input" name="nb_lainnya-input" class="form-control" placeholder="Rp" value="{{$nb_lainnya}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Document</label>
                                <div class="col-sm-6">
                                    <input id="file-document-input" type="file" class="file" accept="image/*" name="file-document-input">
                                    <br>
                                    <img id="uri_img_document" alt="gallery" src="/uploads/perencanaan/kawasan/perencanaan/{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uploaded-file-document" name="uploaded-file-document" value="{{$uri_img_document}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!} onclick="test('uri_img_document')">delete</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" accept="image/*" name="file-absensi-input">
                                    <br>
                                    <img id="uri_img_absensi" alt="gallery" src="/uploads/perencanaan/kawasan/perencanaan/{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'style="width:150px"' !!} >
                                    <input type="hidden" id="uploaded-file-absensi" name="uploaded-file-absensi" value="{{$uri_img_absensi}}">
                                    <button type="button" class="btn btn-effect-ripple btn-danger" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!} onclick="test('uri_img_absensi')">delete</button>
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
                                    <a href="/main/perencanaan/kawasan/investasi" type="button" class="btn btn-effect-ripple btn-danger">
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
    function test(id){
    console.log(id)
    var elem = document.getElementById(id);
    elem.parentNode.removeChild(elem);
    var elem2 = $('#'+id+'-file');
    elem2.removeAttr('value');
    return false;
    }
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
          e.preventDefault();
          var form_data = new FormData(this);
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/perencanaan/kontrak_paket/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/perencanaan/kontrak_paket";
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

        $("#select-kode_kontraktor-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-jenis_komponen_keg-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-id_subkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-id_dtl_subkomponen-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#select-dk_tipe_penanganan-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width:"100%"
        });

        $("#file-document-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
        });
        $("#file-absensi-input").fileinput({
            previewFileType: "image",
            browseClass: "btn btn-success",
            browseLabel: " Pick Image",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
            removeClass: "btn btn-danger",
            removeLabel: "Delete",
            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
            showUpload: false
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
        var subkomponen = $('#select-id_subkomponen-input');
        var dtl_subkomponen = $('#select-id_dtl_subkomponen-input');
        var kmw_id,kota_id,korkot_id,kel_id,kec_id,faskel,subkomponen_id;
        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=undefined){
                kota.empty();
                kota.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?kmw="+kmw_id,
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
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?kota="+kota_id,
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
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?korkot="+kota_id,
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
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?kec="+kec_id,
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
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?faskel="+kel_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });
        subkomponen.change(function(){
            subkomponen_id=subkomponen.val();
            if(subkomponen_id!=undefined){
                dtl_subkomponen.empty();
                dtl_subkomponen.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/infra/penyiapan_paket/select?subkomponen="+subkomponen_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            dtl_subkomponen.append("<option value="+data[i].id+" >"+data[i].nama+"</option>");
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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
