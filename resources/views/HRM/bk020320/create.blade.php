@extends('HRM/default') {{-- Page title --}} @section('title') Persetujuan Evaluasi Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Persetujuan Evaluasi</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/management_diri/persetujuan/evaluasi">
	                Managemen Personil / Persetujuan / Evaluasi
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
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
						<form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
							<input type="hidden" id="kode" name="kode" value="{{$kode}}">
							<div class="form-group striped-col">
				                <label class="col-sm-3 control-label">User </label>
				                <div class="col-sm-6">
									<select id="kode_personil-input" name="kode_personil-input" class="form-control" size="1" disabled >
										<option value>Please Select</option>
										@foreach ($user_list as $kpl)
				                            <option value="{{$kpl->id}}" {!! $kode_personil==$kpl->id ? 'selected':'' !!}>{{$kpl->user_name}}</option>
				                        @endforeach
									</select>
				                </div>
				            </div>
							<div class="form-group ">
                                <label class="col-sm-3 control-label" for="example-text-input1">Periode Awal</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="periode_awal-input" name="periode_awal-input" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$periode_awal}}" disabled>
                                </div>
                            </div>

							<div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Periode Akhir</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="period_akhir-input" name="period_akhir-input" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$period_akhir}}" disabled>
                                </div>
                            </div>
							<div class="form-group ">
				                <label class="col-sm-3 control-label">Catatan</label>
				                <div class="col-sm-6">
				                    <textarea id="catatal_eval-input" name="catatal_eval-input" class="form-control" >{{$catatal_eval}}</textarea>
				                </div>
				            </div>
							<div class="form-group striped-col">
								<label class="col-sm-3 control-label" for="example-select1">Evaluasi</label>
								<div class="col-sm-6">
									<select id="hasil_eval-input" name="hasil_eval-input" class="form-control" size="1">
										<option value="1" @if($hasil_eval==1) selected="selected" @endif >Sangat Kurang</option>
										<option value="2" @if($hasil_eval==2) selected="selected" @endif >Kurang</option>
										<option value="3" @if($hasil_eval==3) selected="selected" @endif >Cukup</option>
										<option value="4" @if($hasil_eval==4) selected="selected" @endif >Baik</option>
										<option value="5" @if($hasil_eval==5) selected="selected" @endif >Sangat Baik</option>
									</select>
								</div>
							</div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/hrm/management_personil/persetujuan/evaluasi" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
									@if( $id!=$kode_personil)
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
									@endif
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
<script>
	function test(id){
		var elem = document.getElementById(id);
		elem.parentNode.removeChild(elem);
		var elem2 = $('#'+id+'-file');
		elem2.removeAttr('value');
		return false;
	}
  $(document).ready(function () {
	$('#form').on('submit', function (e) {
		var form_data = new FormData(this);
		e.preventDefault();
		$.ajax({
			type: 'post',
			processData: false,
            contentType: false,
			"url": "/hrm/management_personil/persetujuan/evaluasi/create",
			data: form_data,
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {
				alert('From Submitted.');
				window.location.href = "/hrm/management_personil/persetujuan/evaluasi";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });

	$("#kode_personil-input").select2({
		theme: "bootstrap"
	})
  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
