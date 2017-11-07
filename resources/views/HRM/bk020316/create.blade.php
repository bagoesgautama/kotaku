@extends('HRM/default') {{-- Page title --}} @section('title') Manajemen Personil - Persetujuan Pendaftaran Personil @stop {{-- local styles --}} @section('header_styles')
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
<link href="{{asset('vendors/pnotify/css/pnotify.buttons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/pnotify/css/pnotify.css')}}" rel="stylesheet" type="text/css">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Manajemen Personil - Persetujuan Pendaftaran Personil</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
            <li class="next">
                <a href="/hrm/management/persetujuan">
                    Manajemen Personil / Persetujuan Pendaftaran Personil
                </a>
            </li>
            <li class="next">
                <a>
                    Create
                </a>
            </li>
        </ul>
    </div>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="panel-body border">

    <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group">
                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Registrasi</label></div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Username</label>
                <div class="col-sm-6">
                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                <input type="hidden" id="password-input" name="password-input" value="{{ $password }}">
                    <input type="text" id="user_name-input" name="user_name-input" class="form-control" placeholder="Text" value="{{ $user_name }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama Depan</label>
                <div class="col-sm-6">
                    <input type="text" id="nama_depan-input" name="nama_depan-input" class="form-control" placeholder="Nama Depan" value="{{ $nama_depan }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama Belakang</label>
                <div class="col-sm-6">
                    <input type="text" id="nama_belakang-input" name="nama_belakang-input" class="form-control" placeholder="Nama Belakang" value="{{ $nama_belakang }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-select1">Jenis Kelamin</label>
                <div class="col-sm-6">
                    <select id="select-kode_jenis_kelamin-input" name="select-kode_jenis_kelamin-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_jenis_kelamin}}" {!! $kode_jenis_kelamin==$dkl->kode_jenis_kelamin ? 'selected':'' !!}>{{$dkl->nama_kelamin}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Lahir</label>
                <div class="col-sm-6">
                    <input class="form-control" id="tgl_lahir-input" name="tgl_lahir-input" placeholder="Tanggal Lahir" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lahir}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Tempat Lahir</label>
                <div class="col-sm-6">
                    <select id="select-kode_tempat_lahir-input" name="select-kode_tempat_lahir-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_tempat_lahir}}" {!! $kode_tempat_lahir==$dkl->kode_tempat_lahir ? 'selected':'' !!}>{{$dkl->nama_tempat_lahir}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat</label>
                <div class="col-sm-6">
                    <textarea id="alamat-input" name="alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat" maxlength="300" readonly>{{ $alamat }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">NIK</label>
                <div class="col-sm-6">
                    <input type="text" id="nik-input" name="nik-input" class="form-control" placeholder="NIK" value="{{ $nik }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No NPWP</label>
                <div class="col-sm-6">
                    <input type="text" id="no_npwp-input" name="no_npwp-input" class="form-control" placeholder="No NPWP" value="{{ $no_npwp }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Kodepos</label>
                <div class="col-sm-6">
                    <input type="text" id="kodepos-input" name="kodepos-input" class="form-control" placeholder="Kodepos" value="{{ $kodepos }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-email">Email</label>
                <div class="col-sm-6">
                    <input id="email-input" type="email" class="form-control  form-control-lg" name="email-input" value="{{ $email }}" placeholder="E-mail"  maxlength="255" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 1</label>
                <div class="col-sm-6">
                    <input type="text" id="no_hp-input" name="no_hp-input" class="form-control" placeholder="No Handphone 1" value="{{ $no_hp }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 2</label>
                <div class="col-sm-6">
                    <input type="text" id="no_hp2-input" name="no_hp2-input" class="form-control" placeholder="No Handphone 2" value="{{ $no_hp2 }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Telepon</label>
                <div class="col-sm-6">
                    <input type="text" id="no_telp-input" name="no_telp-input" class="form-control" placeholder="No Telepon" value="{{ $no_telp }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No SPK</label>
                <div class="col-sm-6">
                    <input type="text" id="no_spk-input" name="no_spk-input" class="form-control" placeholder="Nomor SPK" value="{{ $no_spk }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Tanggal SPK</label>
                <div class="col-sm-6">
                    <input type="text" id="tgl_spk-input" name=tgl_spk-input" class="form-control" placeholder="Tanggal SPK" value="{{ $tgl_spk }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama BANK</label>
                <div class="col-sm-6">
                    <input type="text" id="nama_bank-input" name=nama_bank-input" class="form-control" placeholder="Nama BANK" value="{{ $nama_bank }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nomor Rekening</label>
                <div class="col-sm-6">
                    <input type="text" id="no_rekening-input" name=no_rekening-input" class="form-control" placeholder="Nomor Rekeing" value="{{ $no_rekening }}" maxlength="30" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Jenis Registrasi</label>
                <div class="col-sm-6">
                    <input type="text" id="jenis_registrasi-input" name="jenis_registrasi-input" class="form-control" placeholder="Text" value="{{ $jenis_registrasi }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Status Registrasi</label>
                <div class="col-sm-6">
                    <input type="text" id="status_registrasi-input" name="status_registrasi-input" class="form-control" placeholder="Text" value="{{ $status_registrasi }}" maxlength="50" readonly>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Role Level</label>
                <div class="col-sm-6">
                    <select id="select-kode_level-input" name="select-kode_level-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_level}}" {!! $kode_level==$dkl->kode_level ? 'selected':'' !!}>{{$dkl->nama_level}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Role</label>
                <div class="col-sm-6">
                    <select id="select-kode_role-input" name="select-kode_role-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_role}}" {!! $kode_role==$dkl->kode_role ? 'selected':'' !!}>{{$dkl->nama_role}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Propinsi Wilayah Kerja</label>
                <div class="col-sm-6">
                    <select id="select-wk_kd_prop-input" name="select-wk_kd_prop-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->wk_kd_prop}}" {!! $wk_kd_prop==$dkl->wk_kd_prop ? 'selected':'' !!}>{{$dkl->nama_prop}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Kota Wilayah Kerja</label>
                <div class="col-sm-6">
                    <select id="select-wk_kd_kota-input" name="select-wk_kd_kota-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->wk_kd_kota}}" {!! $wk_kd_kota==$dkl->wk_kd_kota ? 'selected':'' !!}>{{$dkl->nama_kota}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kelurahan Wilayah Kerja</label>
                <div class="col-sm-6">
                    <select id="select-wk_kd_kel-input" name="select-wk_kd_kel-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->wk_kd_kel}}" {!! $wk_kd_kel==$dkl->wk_kd_kel ? 'selected':'' !!}>{{$dkl->nama_kel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">KMP</label>
                <div class="col-sm-6">
                    <select id="select-kode_kmp-input" name="select-kode_kmp-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_kmp}}" {!! $kode_kmp==$dkl->kode_kmp ? 'selected':'' !!}>{{$dkl->nama_kmp}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">KMW</label>
                <div class="col-sm-6">
                    <select id="select-kode_kmw-input" name="select-kode_kmw-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_kmw}}" {!! $kode_kmw==$dkl->kode_kmw ? 'selected':'' !!}>{{$dkl->nama_kmw}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Propinsi</label>
                <div class="col-sm-6">
                    <select id="select-kode_prop-input" name="select-kode_prop-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_prop}}" {!! $kode_prop==$dkl->kode_prop ? 'selected':'' !!}>{{$dkl->nama_prop}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kota</label>
                <div class="col-sm-6">
                    <select id="select-kode_kota-input" name="select-kode_kota-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_kota}}" {!! $kode_kota==$dkl->kode_kota ? 'selected':'' !!}>{{$dkl->nama_kota}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Korkot</label>
                <div class="col-sm-6">
                    <select id="select-kode_korkot-input" name="select-kode_korkot-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_korkot}}" {!! $kode_korkot==$dkl->kode_korkot ? 'selected':'' !!}>{{$dkl->nama_korkot}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Kecamatan</label>
                <div class="col-sm-6">
                    <select id="select-kode_kec-input" name="select-kode_kec-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_kec}}" {!! $kode_kec==$dkl->kode_kec ? 'selected':'' !!}>{{$dkl->nama_kec}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Kelurahan</label>
                <div class="col-sm-6">
                    <select id="select-kode_kel-input" name="select-kode_kel-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_kel}}" {!! $kode_kel==$dkl->kode_kel ? 'selected':'' !!}>{{$dkl->nama_kel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label">Faskel</label>
                <div class="col-sm-6">
                    <select id="select-kode_faskel-input" name="select-kode_faskel-input" class="form-control select2" size="1">
                        <option value="">Please select</option>
                        @foreach ($data_registrasi_list as $dkl)
                            <option value="{{$dkl->kode_faskel}}" {!! $kode_faskel==$dkl->kode_faskel ? 'selected':'' !!}>{{$dkl->nama_faskel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Masukkan Catatan Persetujuan Registrasi</label></div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Catatan</label>
                <div class="col-sm-6">
                    <textarea id="validation_note-input" name="validation_note-input" rows="7" class="form-control resize_vertical" placeholder="Catatan" maxlength="300">{{ $validation_note }}</textarea>
                </div>
            </div>
            <!--<div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_time }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_by }}</label>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated TIme</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_time }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_by }}</label>
                </div>
            </div>-->
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <button type="submit" id="verify" class="btn btn-effect-ripple btn-primary">
                        Verifikasi
                    </button>
                    <button type="submit" id="tolak" class="btn btn-effect-ripple btn-danger">
                        Tolak
                    </button>
                    <a href="/hrm/management/persetujuan" type="button" class="btn btn-effect-ripple btn-default reset_btn2">
                        Cancel
                    </a>
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
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>
<script>
    $(document).ready(function () {
    $('#verify').on('click', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        "url": "/hrm/management/persetujuan/create",
        data: $('form').serialize(),
        success: function () {
        alert('Success !!!');
        window.location.href = "/hrm/management/persetujuan";
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            }
        });
      });
    });

    $(document).ready(function () {
    $('#tolak').on('click', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        "url": "/hrm/management/persetujuan/tolak",
        data: $('form').serialize(),
        success: function () {
        alert('Success !!!');
        window.location.href = "/hrm/management/persetujuan";
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            }
        });
      });
    });
        

        $("#select-wk_kd_prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-wk_kd_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-wk_kd_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_kmp-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_kmw-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_prop-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_kota-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_korkot-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_kec-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_kel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_faskel-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_jenis_kelamin-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_level-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_role-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        $("#select-kode_tempat_lahir-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select",
            width: "100%"
        });

        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            console.log(e)
            new PNotify({
                title: 'Pengisian Form Tidak Lengkap',
                text: 'Field input '+e.target.id+' belum diisi.',
                type: 'error'
            });
          };
        })(), true);

        function enforce_maxlength(event) {
            var t = event.target;
            if (t.hasAttribute('maxlength')) {
                t.value = t.value.slice(0, t.getAttribute('maxlength'));
            }
        }
        document.body.addEventListener('input', enforce_maxlength);
</script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
@stop
