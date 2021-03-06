@extends('MAIN/default') {{-- Page title --}} @section('title') Konsultan Manajemen Pusat (KMP) @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Konsultan Manajemen Pusat (KMP)</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/kmp">
                    Master Data / Data Cakupan Program / KMP
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
    <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
        <div class="row">
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama</label>
                <div class="col-sm-6">
                    <input type="hidden" id="example-id-input" name="example-id-input" value="{{ $kode }}">
                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="Nama" value="{{ $nama }}" maxlength="50" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-textarea-input2">Alamat</label>
                <div class="col-sm-6">
                    <textarea id="alamat-input" name="alamat-input" rows="7" class="form-control resize_vertical" placeholder="Alamat" maxlength="100">{{ $alamat }}</textarea>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">Kode POS</label>
                <div class="col-sm-6">
                    <input type="text" id="kodepos-input" name="kodepos-input" class="form-control" placeholder="Kode POS" value="{{ $kodepos }}" maxlength="5" onKeyPress="return HanyaAngka(event)">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Contact Person</label>
                <div class="col-sm-6">
                    <input type="text" id="contact_person-input" name="contact_person-input" class="form-control" placeholder="Contact Person" value="{{ $contact_person }}" maxlength="50" required>
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Telepon</label>
                <div class="col-sm-6">
                    <input type="text" id="no_phone-input" name="no_phone-input" class="form-control" placeholder="Telepon" value="{{ $no_phone }}" maxlength="50" onKeyPress="return HanyaAngka(event)">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 1</label>
                <div class="col-sm-6">
                    <input type="text" id="no_hp1-input" name="no_hp1-input" class="form-control" placeholder="Handphone 1" value="{{ $no_hp1 }}" maxlength="50" onKeyPress="return HanyaAngka(event)">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-text-input1">No Handphone 2</label>
                <div class="col-sm-6">
                    <input type="text" id="no_hp2-input" name="no_hp2-input" class="form-control" placeholder="Handphone 2" value="{{ $no_hp2 }}" maxlength="50" onKeyPress="return HanyaAngka(event)">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-email">Email 1</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 1</label>
                    <input id="email1-input" type="email" class="form-control  form-control-lg" name="email1-input" value="{{ old('email') }}" placeholder="E-mail"  maxlength="255">
                </div>
            </div>
            <div class="form-group striped-col">
                <label class="col-sm-3 control-label" for="example-email">Email 2</label>
                <div class="col-sm-6">
                    <label for="email" class="sr-only"> E-mail 2</label>
                    <input id="email2-input" type="email" class="form-control  form-control-lg" name="email2-input" value="{{ old('email') }}" placeholder="E-mail"  maxlength="255">

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="example-text-input1">Nama PMS</label>
                <div class="col-sm-6">
                    <select id="select-kode_pms-input" class="form-control select2" name="select-kode_pms-input">
                        <option value>Please select</option>
                        @foreach($kode_pms_list as $list)
                            <option value="{{ $list->kode }}" @if($list->kode==$kode_pms) selected="selected" @endif >{{ $list->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="/main/kmp" type="button" class="btn btn-effect-ripple btn-danger">
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
    function HanyaAngka(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
</script>
<script>
      $(document).ready(function () {
        $('#form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            "url": "/main/kmp/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {

            alert('From Submitted.');
            window.location.href = "/main/kmp";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });

        $("#select-kode_pms-input").select2({
            theme: "bootstrap",
            placeholder: "Please Select"
        });
    });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
@stop
