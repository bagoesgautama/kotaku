@extends('MAIN/default') {{-- Page title --}} @section('title') Perencanaan - Kontrak Paket Pekerjaan Kontraktor @stop {{-- local styles --}}
@section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}}
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Perencanaan - Kontrak Paket Pekerjaan Kontraktor</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>  
            <li class="next">
                <a href="/main/perencanaan/kontrak_paket">
                    Perencanaan / Kontrak Paket Pekerjaan Kontraktor
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
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                                    <input type="text" id="tahun-input" name="tahun-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Skala Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select-skala_kegiatan-input" class="form-control select2" name="select-skala_kegiatan-input-input" required>
                                        <option value=P>Primer</option>
                                        <option value=S>Sekunder</option>
                                        <option value=T>Tersier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">KMW</label>          
                                <div class="col-sm-6">
                                    <select id="select-kode_prop-input" class="form-control select2" name="select-kode_prop-input" required>
                                        <option value=undefined>Please select</option>
                                        @foreach($kode_kmw_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kota-input" class="form-control select2" name="select-kode_kota-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">KorKot</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_korkot-input" class="form-control select2" name="select-kode_korkot-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kec-input" class="form-control select2" name="select-kode_kec-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_kel-input" class="form-control select2" name="select-kode_kel-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select-kode_faskel-input" class="form-control select2" name="select-kode_faskel-input-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Nama Kontraktor</label>
                                <div class="col-sm-6">
                                    <select id="select-id_kegiatan-input" class="form-control select2" name="select-id_kegiatan-input" required>
                                        
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
                                    <select id="select-jenis_komponen_keg-input" class="form-control select2" name="select-jenis_komponen_keg-input-input" required>
                                        <option value=L>Lingkungan</option>
                                        <option value=S>Sosial</option>
                                        <option value=E>Ekonomi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Sub Komponen</label>
                                <div class="col-sm-6">
                                    <select id="select-id_subkomponen-input" class="form-control select2" name="select-id_subkomponen-input-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Detail Sub Komponen</label>
                                <div class="col-sm-6">
                                    <select id="select-id_dtl_subkomponen-input" class="form-control select2" name="select-id_dtl_subkomponen-input-input" required>
                                        <option value=undefined>Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" class="form-control" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Volume Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dk_vol_kegiatan-input" name="dk_vol_kegiatan-input" class="form-control" placeholder="Volume Kegiatan" value="{{$dk_vol_kegiatan}}" maxlength=50 required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Satuan</label>
                                <div class="col-sm-6">
                                    <input type="number" id="dk_satuan-input" name="dk_satuan-input" class="form-control" placeholder="Satuan" value="{{$dk_satuan}}" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                 <label class="col-sm-3 control-label" for="example-text-input31">Kategori Penanganan</label>
                                <div class="col-sm-6">
                                    <select id="select-dk_tipe_penanganan-input" class="form-control select2" name="select-dk_tipe_penanganan-input-input" required>
                                        <option value=0>Rehab</option>
                                        <option value=1>Baru</option>
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
                                    <input type="number" id="nb_lainya-input" name="nb_lainya-input" class="form-control" placeholder="Rp" value="{{$nb_lainya}}" maxlength="30">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">File Document</label>
                                <div class="col-sm-6">
                                    <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Absensi</label>
                                <div class="col-sm-6">
                                    <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                    <br>
                                    <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                </div>
                            </div>
                            <div class="form-group striped-col">
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
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/persiapan/kelurahan/lembaga" type="button" class="btn btn-effect-ripple btn-danger">
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel filterable">
            <div class="panel-heading clearfix  ">
                <!-- <div class="panel-title pull-left">
                    <b>bk010201 index</b>
                </div> -->
                @if( ! empty($detil['61']))
                <div class="tools pull-right">
                    <a class="button button-glow button-rounded button-primary-flat hvr-float-shadow" href="{{'/main/persiapan/nasional/pokja/pembentukan/create'}}">Create</a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="pokja">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Kode Prop</th>
                                <th>Jenis Kegiatan</th>
                                <th>Tanggal Pembentukan</th>
                                <th>Status Pokja</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop {{-- local scripts --}} @section('footer_scripts')
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
            e.preventDefault();

            var file_document = document.getElementById('file-document-input').files[0];
            var file_absensi = document.getElementById('file-absensi-input').files[0];
            var form_data = new FormData();
            form_data.append('example-id-input', $('#example-id-input').val());
            form_data.append('file-document-input', file_document);
            form_data.append('file-absensi-input', file_absensi);
            form_data.append('uploaded-file-document', $('#uploaded-file-document').val());
            form_data.append('uploaded-file-absensi', $('#uploaded-file-absensi').val());
            form_data.append('tahun-input', $('#tahun-input').val());
            form_data.append('select-kode_kota-input', $('#select-kode_kota-input').val());
            form_data.append('select-kode_korkot-input', $('#select-kode_korkot-input').val());
            form_data.append('select-kode_kec-input', $('#select-kode_kec-input').val());
            form_data.append('select-kode_kmw-input', $('#select-kode_kmw-input').val());
            form_data.append('select-kode_kel-input', $('#select-kode_kel-input').val());
            form_data.append('select-kode_faskel-input', $('#select-kode_faskel-input').val());
            form_data.append('select-id_kegiatan-input', $('#select-id_kegiatan-input').val());
            form_data.append('select-id_dtl_kegiatan-input', $('#select-id_dtl_kegiatan-input').val());
            form_data.append('tgl_kegiatan-input', $('#tgl_kegiatan-input').val());
            form_data.append('lok_kegiatan-input', $('#lok_kegiatan-input').val());
            form_data.append('q_peserta_p-input', $('#q_peserta_p-input').val());
            form_data.append('q_peserta_w-input', $('#q_peserta_w-input').val());
            form_data.append('q_peserta_miskin-input', $('#q_peserta_miskin-input').val());
            form_data.append('diser_tgl-input', $('#diser_tgl-input').val());
            form_data.append('diser_oleh-input', $('#diser_oleh-input').val());
            form_data.append('diket_tgl-input', $('#diket_tgl-input').val());
            form_data.append('diket_oleh-input', $('#diket_oleh-input').val());
            form_data.append('diver_tgl-input', $('#diver_tgl-input').val());
            form_data.append('diver_oleh-input', $('#diver_oleh-input').val());

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

        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-id_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-id_dtl_kegiatan-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });

        var kmw = $('#select-kode_kmw-input');
        var kota = $('#select-kode_kota-input');
        var korkot = $('#select-kode_korkot-input');
        var kecamatan = $('#select-kode_kec-input');
        var kelurahan = $('#select-kode_kel-input');
        var faskel = $('#select-kode_faskel-input');
        var kegiatan = $('#select-id_kegiatan-input');
        var dtl_kegiatan = $('#select-id_dtl_kegiatan-input');
        var kmw_id,kota_id,korkot_id,kel_id,kec_id;
        var kode_kmw = {!! json_encode($kode_kmw) !!};
        var kode_kota = {!! json_encode($kode_kota) !!};
        var kode_korkot = {!! json_encode($kode_korkot) !!};
        var kode_kec = {!! json_encode($kode_kec) !!};
        var kode_kel = {!! json_encode($kode_kel) !!};
        var kode_faskel = {!! json_encode($kode_faskel) !!};
        if(kode_kmw!=null){
            kota.empty();
            kota.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kontrak_paket/select?kmw="+kode_prop,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_kota)
                            kota.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            kota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            korkot.empty();
            korkot.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kontrak_paket/select?kota="+kode_kota,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_korkot)
                            korkot.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            korkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            kecamatan.empty();
            kecamatan.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kontrak_paket/select?korkot="+kode_korkot,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_kec)
                            kecamatan.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            kecamatan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            kelurahan.empty();
            kelurahan.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kontrak_paket/select?kecamatan="+kode_kec,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_kel)
                            kelurahan.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            kelurahan.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
            faskel.empty();
            faskel.append("<option value=undefined>Please select</option>");
            $.ajax({
                type: 'get',
                "url": "/main/perencanaan/kontrak_paket/select?kelurahan="+kode_kel,
                success: function (data) {
                    data=JSON.parse(data)
                    for (var i=0;i<data.length;i++){
                        if(data[i].kode==kode_faskel)
                            faskel.append("<option value="+data[i].kode+" selected='selected'>"+data[i].nama+"</option>");
                        else
                            faskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                    }
                }
            });
        }

        kmw.change(function(){
            kmw_id=kmw.val();
            if(kmw_id!=undefined){
                kota.empty();
                kota.append("<option value=undefined>Please select</option>");
                $.ajax({
                    type: 'get',
                    "url": "/main/perencanaan/kontrak_paket/select?kmw="+kmw_id,
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
                    "url": "/main/perencanaan/kontrak_paket/select?kota="+kota_id,
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
                    "url": "/main/perencanaan/kontrak_paket/select?korkot="+kota_id,
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
                    "url": "/main/perencanaan/kontrak_paket/select?kec="+kec_id,
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
                    "url": "/main/perencanaan/kontrak_paket/select?kel="+kel_id,
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
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
@stop
