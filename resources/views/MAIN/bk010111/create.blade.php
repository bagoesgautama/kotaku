@extends('MAIN/default') {{-- Page title --}} @section('title') Koordinator Kota (KorKot) Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Koordinator Kota (KorKot) Form</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> HRM
            </a>
        </li>
        <li><a href="/main/korkot"> KorKot</a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="panel-body border">
    <form enctype="multipart/form-data" class="form-horizontal form-bordered signup_validator">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Kode KMW</label>
                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                <div class="col-sm-6">
                    <select id="example-select1" name="example-kode_kmw-input" class="form-control" size="1">
                        @foreach($kode_kmw_list as $list)
                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->kode }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                 <label class="col-sm-3 control-label" for="example-text-input1">Nama</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-nama-input" class="form-control" placeholder="Nama" value="{{ $nama }}" maxlength="50">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat</label>
                <div class="col-sm-6">
                    <textarea id="example-textarea-input2" name="example-alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat" maxlength="300">{{ $alamat }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Kode POS</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-kodepos-input" class="form-control" placeholder="Kode POS" value="{{ $kodepos }}" maxlength="5">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Contact Person</label>
                <div class="col-sm-6">    
                    <input type="text" id="example-text-input1" name="example-contact_person-input" class="form-control" placeholder="Contact Person" value="{{ $contact_person }}" maxlength="50">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Telepon</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_phone-input" class="form-control" placeholder="Telepon" value="{{ $no_phone }}" maxlength="30">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No FAX</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_fax-input" class="form-control" placeholder="FAX" value="{{ $no_fax }}" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 1</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_hp1-input" class="form-control" placeholder="Handphone 1" value="{{ $no_hp1 }}" maxlength="30">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 2</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-no_hp2-input" class="form-control" placeholder="Handphone 2" value="{{ $no_hp2 }}" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-email">Email 1</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 1</label>
                    <input id="email" type="email" class="form-control  form-control-lg" name="example-email1" value="{{ old('email') }}" placeholder="E-mail" required maxlength="255">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group  striped-col">
                <label class="col-sm-3 control-label" for="example-email">Email 2</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 2</label>
                    <input id="email" type="email" class="form-control  form-control-lg" name="example-email2" value="{{ old('email') }}" placeholder="E-mail" required maxlength="255">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama PMS</label>
                <div class="col-sm-6">
                    <input type="text" id="example-text-input1" name="example-pms_nama-input" class="form-control" placeholder="Nama PMS" value="{{ $pms_nama }}" maxlength="50">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat PMS</label>
                <div class="col-sm-6">
                    <textarea id="example-textarea-input2" name="example-pms_alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat PMS" maxlength="300">{{ $pms_alamat }}</textarea>
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
                    <a href="/main/korkot" type="button" class="btn btn-effect-ripple btn-danger">
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
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/korkot/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/korkot";
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

<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
@stop
