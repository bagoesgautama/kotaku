@extends('MAIN/default') {{-- Page title --}} @section('title') Slum Program @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Slum Program</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                Master Data
            </li>
            <li class="next">
                Data Cakupan Program
            </li>
            <li class="next">
                Slum Program
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
    <form enctype="multipart/form-data" class="signup_validator form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Urut</label>
                <div class="col-sm-6">
                <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                    <input type="number" id="no_urut-input" name="no_urut-input" class="form-control" placeholder="No Urut" value="{{ $nourut }}" maxlength="4">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama</label>
                <div class="col-sm-6">
                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="Nama" value="{{ $nama }}" maxlength="50">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Keterangan</label>
                <div class="col-sm-6">
                    <textarea id="keterangan-input" name="keterangan-input" rows="7" class="form-control resize_vertical" placeholder="Keterangan" maxlength="300">{{ $keterangan }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-select1">Kota</label>
                <div class="col-sm-6">
                    <select id="select-kode_kota-input" name="select-kode_kota-input" class="form-control" size="1">
                        @foreach($kode_kota_list as $list)
                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat</label>
                <div class="col-sm-6">
                    <textarea id="alamat-input" name="alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat" maxlength="100">{{ $alamat }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Kode POS</label>
                <div class="col-sm-6">
                    <input type="number" id="kodepos-input" name="kodepos-input" class="form-control" placeholder="Kode POS" value="{{ $kodepos }}" maxlength="5">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Contact Person</label>
                <div class="col-sm-6">    
                    <input type="text" id="contact_person-input" name="contact_person-input" class="form-control" placeholder="Contact Person" value="{{ $contact_person }}" maxlength="50">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Telepon</label>
                <div class="col-sm-6">
                    <input type="number" id="no_phone-input" name="no_phone-input" class="form-control" placeholder="Telepon" value="{{ $no_phone }}" maxlength="30">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No FAX</label>
                <div class="col-sm-6">   
                    <input type="number" id="no_fax-input" name="no_fax-input" class="form-control" placeholder="Fax" value="{{ $no_fax }}" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 1</label>
                <div class="col-sm-6">
                    <input type="number" id="no_hp1-input" name="no_hp1-input" class="form-control" placeholder="Handphone 1" value="{{ $no_hp1 }}" maxlength="30">
                </div>
            </div>
            <div class="form-group  striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 2</label>
                <div class="col-sm-6">
                    <input type="number" id="no_hp2-input" name="no_hp2-input" class="form-control" placeholder="Handphone 2" value="{{ $no_hp2 }}" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-email">Email 1</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 1</label>
                    <input id="email1-input" type="email" class="form-control  form-control-lg" name="email1-input" value="{{ $email1}}" placeholder="E-mail" required maxlength="255">

                    @if ($errors->has('email1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-email">Email 2</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 2</label>
                    <input id="email2-input" type="email" class="form-control  form-control-lg" name="email2-input" value="{{ $email2 }}" placeholder="E-mail" required maxlength="255">

                    @if ($errors->has('email2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama PMS</label>
                <div class="col-sm-6">
                    <input type="text" id="pms_nama-input" name="pms_nama-input" class="form-control" placeholder="Nama PMS" value="{{ $pms_nama }}" maxlength="50">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat PMS</label>
                <div class="col-sm-6">
                    <textarea id="pms_alamat-input" name="pms_alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat PMS" maxlength="100">{{ $pms_alamat }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="return_date">Tanggal Akhir</label>
                <div class="col-sm-6">
                    <input class="form-control" id="tgl_akhir-input" name="tgl_akhir-input" placeholder="Klik disini untuk memilih tanggal" data-provide="datepicker" value="{{ $tgl_akhir}}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Tahun APBD 1</label>
                <div class="col-sm-6">
                    <input type="number" id="tahun_apbd1-input" name="tahun_apbd1-input" class="form-control" placeholder="APBD 1" value="{{ $tahun_apbd1 }}" maxlength="4">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Tahun APBD 2</label>
                <div class="col-sm-6">
                    <input type="number" id="tahun_apbd2-input" name="tahun_apbd2-input" class="form-control" placeholder="APBD 2" value="{{ $tahun_apbd2 }}" maxlength="4">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-select1">Status</label>
                <div class="col-sm-6">
                    <select id="select-status-input" name="select-status-input" class="form-control" size="1">
                        <option value="0" @if($status==0) selected="selected" @endif >Tidak Aktif</option>
                        <option value="1" @if($status==1) selected="selected" @endif >Aktif</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Project</label>
                <div class="col-sm-6">
                    <input type="text" id="project-input" name="project-input" class="form-control" placeholder="Project" value="{{ $project }}" maxlength="4">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Departemen</label>
                <div class="col-sm-6">
                    <select id="select-kode_departemen-input" name="select-kode_departemen-input" class="form-control" size="1">
                        <option value="0" @if($kode_departemen==0) selected="selected" @endif >Departemen 1</option>
                        <option value="1" @if($kode_departemen==1) selected="selected" @endif >Departemen 2</option>
                        <option value="2" @if($kode_departemen==2) selected="selected" @endif >Departemen 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Glosary Caption</label>
                <div class="col-sm-6">
                    <input type="text" id="glosary_caption-input" name="glosary_caption-input" class="form-control" placeholder="Glosary Caption" value="{{ $glosary_caption }}" maxlength="50">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Jenis Siklus</label>
                <div class="col-sm-6">
                    <select id="select-jenis_siklus-input" name="select-jenis_siklus-input" class="form-control" size="1">
                        <option value="0" @if($jenis_siklus==0) selected="selected" @endif >0</option>
                        <option value="1" @if($jenis_siklus==1) selected="selected" @endif >1</option>
                        <option value="2" @if($jenis_siklus==2) selected="selected" @endif >2</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_time }}</label>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $created_by }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_time }}</label>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                <div class="col-sm-6">
                    <label class="form-control">{{ $updated_by }}</label>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/main/slum_program" type="button" class="btn btn-effect-ripple btn-danger">
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
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            "url": "/main/slum_program/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/slum_program";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });

        $("#example-select-kota").select2({
            theme: "bootstrap",
            placeholder: "single select"
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


