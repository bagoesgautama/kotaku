@extends('MAIN/default') {{-- Page title --}} @section('title') Konsultan Manajemen Pusat (KMP) @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Konsultan Manajemen Pusat (KMP) Form</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> MAIN
            </a>
        </li>
        <li><a href="/hrm/kmp">Konsultan Manajemen Pusat (KMP)</a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama</label>
                <div class="col-sm-6">
                    <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                    <input type="text" id="example-text-input1" name="example-nama-input" class="form-control" placeholder="Nama" value="{{ $nama }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat</label>
                <div class="col-sm-6">
                    <textarea id="example-textarea-input2" name="example-alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat">{{ $alamat }}</textarea>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Kode POS</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-kodepos-input" class="form-control" placeholder="Kode POS" value="{{ $kodepos }}" maxlength="5">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Contact Person</label>
                <div class="col-sm-6">    
                    <input type="text" id="example-text-input1" name="example-contact_person-input" class="form-control" placeholder="Contact Person" value="{{ $contact_person }}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Telepon</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_phone-input" class="form-control" placeholder="Telepon" value="{{ $no_phone }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 1</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_hp1-input" class="form-control" placeholder="Handphone 1" value="{{ $no_hp1 }}">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 2</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_hp2-input" class="form-control" placeholder="Handphone 2" value="{{ $no_hp2 }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-email">Email 1</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 1</label>
                    <input id="email" type="email" class="form-control  form-control-lg" name="example-email1" value="{{ old('email1') }}" placeholder="E-mail" required>

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
                    <input id="email" type="email" class="form-control  form-control-lg" name="example-email2" value="{{ old('email2') }}" placeholder="E-mail" required>

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
                    <input type="text" id="example-text-input1" name="example-pms_nama-input" class="form-control" placeholder="Nama PMS" value="{{ $pms_nama }}">
                </div>
            </div>
            <div class="form-group  striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat PMS</label>
                <div class="col-sm-6">
                    <textarea id="example-textarea-input2" name="example-pms_alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat PMS">{{ $pms_alamat }}</textarea>
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
                    <a href="/main/kmp" type="button" class="btn btn-effect-ripple btn-danger">
                        Cancel
                    </a>
                    <button type="submit" id="dodol" class="btn btn-effect-ripple btn-primary">
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
        $('#dodol').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            "url": "/main/kmp/create",
            data: $('form').serialize(),
            success: function () {
                alert('Success !!!');
            window.location.href = "/main/kmp";
           },
           error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status);
                  alert(thrownError);
                }
          });
        });
      });
</script>

<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
@stop