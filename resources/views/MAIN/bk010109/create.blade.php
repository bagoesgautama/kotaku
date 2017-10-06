@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping KMP ke Slum Program Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Mapping KMP ke Slum Program</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> MAIN
            </a>
        </li>
        <li><a href="/main/kmp_slum_program">Mapping KMP ke Slum Program</a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop
{{-- Page content --}} @section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
    					<form enctype="multipart/form-data" class="form-horizontal form-bordered">
				            <div class="form-group striped-col">
				                <label class="col-sm-3 control-label" for="example-text-input1">Nama KMP</label>
                                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
								<div class="col-sm-6">
	                                <select id="select21" class="form-control select2" name="example-kode_kmp-input">
	                                    @foreach($kode_kmp_list as $list)
	                                        <option value="{{ $list->kode }}" @if($list->kode==$kode_kmp) selected="selected" @endif >{{ $list->nama }}
	                                        </option>
	                                    @endforeach
	                                </select>
								</div>
                            </div>
							<div class="form-group">
				                <label class="col-sm-3 control-label" for="example-text-input1">Nama Slum Program</label>
                                <div class="col-sm-6">
                                    <select id="select22" class="form-control select2" name="example-kode_slum_prog-input" >
                                        @foreach($kode_slum_prog_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_slum_prog) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
				            </div>
				            <div class="form-group striped-col">
				                <label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
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
				                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
				                <div class="col-sm-6">
				                    <label class="form-control">{{ $updated_time }}</label>
				                </div>
				            </div>
				            <div class="form-group">
				                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
				                <div class="col-sm-6">
				                    <label class="form-control">{{ $updated_by }}</label>
				                </div>
				            </div>
				            <div class="form-group form-actions">
				                <div class="col-sm-9 col-sm-offset-3">
				                    <a href="/main/kmp_slum_program" type="button" class="btn btn-effect-ripple btn-danger">
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
            "url": "/main/kmp_slum_program/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/kmp_slum_program";
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
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>

@stop {{-- local scripts --}} @section('footer_scripts')
@stop
