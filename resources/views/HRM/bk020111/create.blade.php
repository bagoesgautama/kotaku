@extends('HRM/default') {{-- Page title --}} @section('title') Registrasi Manual Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Kuota KMW</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/admin/registrasi_manual">
	                Administrator / Registrasi Manual
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
                                        Data Registrasi
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Personal
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                        Data Personal (Lanjutan)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab">
                                        Role & Wilayah Kerja
                                    </a>
                    </li>
                    <!-- <li>
                        <a href="#tab5" data-toggle="tab">
                                        Tingkat Kekumuhan
                                    </a>
                    </li>
                    <li>
                        <a href="#tab6" data-toggle="tab">
                                        Aspek Kumuh (Sumber Data Baseline)
                                    </a>
                    </li>
                    <li>
                        <a href="#tab7" data-toggle="tab">
                                        Tambahan Data
                                    </a>
                    </li> -->
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                	<input type="hidden" id="kode" name="kode" value="{{$kode}}">
									<div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Username</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control form-control-lg" id="username"
		                                       name="username" placeholder="Username" required maxlength="50">

			                                @if ($errors->has('username'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('username') }}</strong>
			                                    </span>
			                                @endif
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Password</label>
						                <div class="col-sm-6">
											<input type="password" class="form-control form-control-lg" id="password"
		                                       name="password" placeholder="Password" required maxlength="255">

			                                @if ($errors->has('password'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
			                                @endif
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Email</label>
						                <div class="col-sm-6">
											<input id="email" type="email" class="form-control  form-control-lg" name="email" value="{{ old('email') }}" placeholder="E-mail" required maxlength="255">

			                                @if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
						                </div>
						            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                	<div class="form-group striped-col">
						                <label class="col-sm-3 control-label">First Name</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="first_name" name="first_name"
		                                       placeholder="First name" value="{{ old('first_name') }}" required maxlength="50">
			                                @if ($errors->has('first_name'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('first_name') }}</strong>
			                                    </span>
			                                @endif
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Last Name</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="last" name="last_name"
		                                       placeholder="Last name" maxlength="50">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Alamat</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="alamat" name="alamat"
		                                       placeholder="Alamat" maxlength="50">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Provinsi</label>
						                <div class="col-sm-6">
											<select id="kode_prop-input" name="kode_prop-input" class="form-control select2" size="1">
		                                    <option value>Provinsi</option>
		                                    @foreach ($prop_list as $kpl)
		                                        <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
		                                    @endforeach
		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kota</label>
						                <div class="col-sm-6">
											<select id="kode_kota-input" name="kode_kota-input" class="form-control select2" size="1">
		                                    <option value>Kota</option>

		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kecamatan</label>
						                <div class="col-sm-6">
											<select id="kode_kecamatan-input" name="kode_kecamatan-input" class="form-control select2" size="1">
		                                    <option value>Kecamatan</option>

		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kelurahan</label>
						                <div class="col-sm-6">
											<select id="kode_kelurahan-input" name="kode_kelurahan-input" class="form-control select2" size="1">
		                                    <option value>Kelurahan</option>

		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kodepos</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="kodepos" name="kodepos"
		                                       placeholder="kodepos" maxlength="5">
						                </div>
	                                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                	<div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Jenis Kelamin</label>
						                <div class="col-sm-3">
						                	<label class="radio-inline">
                                    		<input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="P" required checked> Pria</label>
						                </div>
						                <div class="col-sm-3">
						                	<label class="radio-inline">
                                    		<input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="W"> Wanita</label>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Tempat Lahir</label>
						                <div class="col-sm-6">
						                	<select id="kode_tempat_lahir-input" name="kode_tempat_lahir-input" class="form-control select2" size="1">
			                                    <option value>Kota</option>
			                                    @foreach ($kota_list as $kpl)
			                                        <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Tanggal Lahir</label>
						                <div class="col-sm-6">
						                	<input class="form-control" id="return_date" name="tgl_lahir" placeholder="Select Date" data-provide="datepicker">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">No. Hp</label>
						                <div class="col-sm-6">
						                	<input type="text" class="form-control  form-control-lg" id="no_hp" name="no_hp"
                                       placeholder="No. Hp" required maxlength="50">
						                </div>
						            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                	<div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Level</label>
						                <div class="col-sm-6">
						                	<select id="kode_level-input" name="kode_level-input" class="form-control select2" size="1">
			                                    <option value>Role Level</option>
						                        @foreach ($level_list as $kpl)
						                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
						                        @endforeach
						                    </select>
						                </div>
						            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab5" class="tab-pane fade">
                        <div class="panel " >
                            <div class="panel-body border">
                                <div class="row">
                                </div>
                            </div>
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
  $(document).ready(function () {

	$('#form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			"url": "/hrm/profil/kuota/kmw/create",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {

			alert('From Submitted.');
			window.location.href = "/hrm/profil/kuota/kmw";
			},
			error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			$("#submit").prop('disabled', false);
			}
		});
    });
	$('#kode_level-input').select2({
            theme: "bootstrap",
            placeholder: "Role Level",
            width: "100%"
        });
        $('#kode_role-input').select2({
            theme: "bootstrap",
            placeholder: "Role",
            width: "100%"
        });
        $('#kode_kmp-input').select2({
            theme: "bootstrap",
            placeholder: "KMP",
            width: "100%"
        });
        $('#kode_prop-input').select2({
            theme: "bootstrap",
            placeholder: "Provinsi",
            width: "100%"
        });
        $('#select-kode-kmw-input').select2({
            theme: "bootstrap",
            placeholder: "KMW",
            width: "100%"
        });
        $('#kode_kota-input').select2({
            theme: "bootstrap",
            placeholder: "Kota",
            width: "100%"
        });
        $('#select-kode-korkot-input').select2({
            theme: "bootstrap",
            placeholder: "Korkot",
            width: "100%"
        });
        $('#select-kode-kec-input').select2({
            theme: "bootstrap",
            placeholder: "Kecamatan",
            width: "100%"
        });
        $('#kode_kecamatan-input').select2({
            theme: "bootstrap",
            placeholder: "Kecamatan",
            width: "100%"
        });
        $('#kode_kelurahan-input').select2({
            theme: "bootstrap",
            placeholder: "Kelurahan",
            width: "100%"
        });
        $('#select-kode-faskel-input').select2({
            theme: "bootstrap",
            placeholder: "Faskel",
            width: "100%"
        });
        $('#kode_tempat_lahir-input').select2({
            theme: "bootstrap",
            placeholder: "Tempat Lahir",
            width: "100%"
        });
        $('#wk_kd_prop-input').select2({
            theme: "bootstrap",
            placeholder: "WK Provinsi",
            width: "100%"
        });
        $('#wk_kd_kota-input').select2({
            theme: "bootstrap",
            placeholder: "WK Kota",
            width: "100%"
        });
        $('#wk_kd_kel-input').select2({
            theme: "bootstrap",
            placeholder: "WK Kelurahan",
            width: "100%"
        });

  });
</script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
