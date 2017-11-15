@extends('HRM/default') {{-- Page title --}} @section('title') User List Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom_css/wizard.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/pnotify/css/pnotify.buttons.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/pnotify/css/pnotify.css')}}" rel="stylesheet" type="text/css">
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Registrasi Manual</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/qs">
                    <i class="fa fa-fw fa-home"></i> HRM
                </a>
            </li>
			<li class="next">
				<a href="/hrm/management/registrasi_manual">
	                Administrator / User List
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
                                        Validasi Registrasi
                                    </a>
                    </li> -->
                    <!-- <li>
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
		                                       name="username" placeholder="Username" required maxlength="50" value="{{$user_name}}">

			                                @if ($errors->has('username'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('username') }}</strong>
			                                    </span>
			                                @endif
						                </div>
						            </div>
						            @if($kode==null)
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
						            @endif
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Email</label>
						                <div class="col-sm-6">
											<input id="email" type="email" class="form-control  form-control-lg" name="email" placeholder="E-mail" required maxlength="255" value="{{$email}}">

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
											<input type="text" class="form-control  form-control-lg" id="first_name" name="first_name" placeholder="First name" required maxlength="50" value="{{$nama_depan}}">
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
		                                       placeholder="Last name" maxlength="50" value="{{$nama_belakang}}">
						                </div>
						            </div>
						            
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Alamat</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="alamat" name="alamat"
		                                       placeholder="Alamat" maxlength="50" value="{{$alamat}}">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Provinsi</label>
						                <div class="col-sm-6">
											<select id="kode_prop-input" name="kode_prop-input" class="form-control select2" size="1">
		                                    <option value>Provinsi</option>
		                                    @foreach ($prop_list as $kpl)
		                                        <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
		                                    @endforeach
		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kota</label>
						                <div class="col-sm-6">
											<select id="kode_kota-input" name="kode_kota-input" class="form-control select2" size="1">
		                                    <option value>Kota</option>
		                                    @if($kota_list!=null)
		                                    @foreach ($kota_list as $kpl)
		                                        <option value="{{$kpl->kode}}" {!! $kode_kota==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
		                                    @endforeach
		                                    @endif
		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kecamatan</label>
						                <div class="col-sm-6">
											<select id="kode_kecamatan-input" name="kode_kecamatan-input" class="form-control select2" size="1">
		                                    <option value>Kecamatan</option>
		                                    @if($kec_list!=null)
		                                    @foreach ($kec_list as $kpl)
		                                        <option value="{{$kpl->kode}}" {!! $kode_kec==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
		                                    @endforeach
		                                    @endif
		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kelurahan</label>
						                <div class="col-sm-6">
											<select id="kode_kelurahan-input" name="kode_kelurahan-input" class="form-control select2" size="1">
		                                    <option value>Kelurahan</option>
		                                    @if($kel_list!=null)
		                                    @foreach ($kel_list as $kpl)
		                                        <option value="{{$kpl->kode}}" {!! $kode_kel==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
		                                    @endforeach
		                                    @endif
		                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kodepos</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="kodepos" name="kodepos"
		                                       placeholder="kodepos" maxlength="5" value="{{$kodepos}}">
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
						                <label class="col-sm-3 control-label">NIK</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="nik" name="nik"
                                       placeholder="NIK" maxlength="16" required value="{{$nik}}">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">No. NPWP</label>
						                <div class="col-sm-6">
											<input type="text" class="form-control  form-control-lg" id="no_npwp" name="no_npwp"
                                       placeholder="No. NPWP" maxlength="20" value="{{$no_npwp}}">
						                </div>
						            </div>
                                	<div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Jenis Kelamin</label>
						                <div class="col-sm-3">
						                	<label class="radio-inline">
                                    		<input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="P" required {!! $kode_jenis_kelamin=='P' ? 'checked':'checked'!!}> Pria</label>
						                </div>
						                <div class="col-sm-3">
						                	<label class="radio-inline">
                                    		<input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="W" {!! $kode_jenis_kelamin=='W' ? 'checked':''!!}> Wanita</label>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Tempat Lahir</label>
						                <div class="col-sm-6">
						                	<select id="kode_tempat_lahir-input" name="kode_tempat_lahir-input" class="form-control select2" size="1">
			                                    <option value>Kota</option>
			                                    @foreach ($kota_lahir_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $kode_kota_lahir==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Tanggal Lahir</label>
						                <div class="col-sm-6">
						                	<input class="form-control" id="return_date" name="tgl_lahir" placeholder="Select Date" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lahir}}">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">No. Hp</label>
						                <div class="col-sm-6">
						                	<input type="number" class="form-control  form-control-lg" id="no_hp" name="no_hp"
                                       placeholder="No. Hp" maxlength="50" value="{{$no_hp}}">
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">No. Telp</label>
						                <div class="col-sm-6">
						                	<input type="text" class="form-control  form-control-lg" id="no_telp" name="no_telp" placeholder="No. Telp" maxlength="45" value="{{$no_telp}}">
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
						                	<select id="kode_level-input" name="kode_level-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>Role Level</option>
						                        @foreach ($level_list as $kpl)
						                            <option value="{{$kpl->kode}}" {!! $kode_level==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
						                        @endforeach
						                    </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Role</label>
						                <div class="col-sm-6">
						                	<select id="kode_role-input" name="kode_role-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>Role</option>
			                                    @if($role_list!=null)
			                                    @foreach ($role_list as $kpl)
						                            <option value="{{$kpl->kode}}" {!! $kode_role==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
						                        @endforeach
						                        @endif
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="no_spk_label" {!! $no_spk!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">No. SPK</label>
						                <div class="col-sm-6">
						                	<input type="number" class="form-control  form-control-lg" id="no_spk" name="no_spk"
                                           placeholder="No. SPK" maxlength="45" value="{{$no_spk}}" {!! $kode!=null ? 'disabled':'' !!}>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="tgl_spk_label" {!! $tgl_spk!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Tgl. SPK</label>
						                <div class="col-sm-6">
						                	<input class="form-control" id="return_date" name="tgl_spk" placeholder="Tanggal SPK" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_spk}}" {!! $kode!=null ? 'disabled':'' !!}>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="nama_bank_label" {!! $nama_bank!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Bank</label>
						                <div class="col-sm-6">
						                	<input type="text" class="form-control  form-control-lg" id="nama_bank" name="nama_bank"
                                           placeholder="Bank" maxlength="100" value="{{$nama_bank}}" {!! $kode!=null ? 'disabled':'' !!}>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="no_rekening_label" {!! $no_rekening!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">No. Rekening</label>
						                <div class="col-sm-6">
						                	<input type="number" class="form-control  form-control-lg" id="no_rekening" name="no_rekening"
                                           placeholder="No. Rekening" maxlength="20" value="{{$no_rekening}}" {!! $kode!=null ? 'disabled':'' !!}>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="kmp_label" {!! $kode_kmp!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">KMP</label>
						                <div class="col-sm-6">
						                	<select id="kode_kmp-input" name="kode_kmp-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>KMP</option>
			                                    @foreach ($kmp_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $kode_kmp==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="wil_kerja_label" {!! $kode!=null ? '':'hidden' !!}>
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Wilayah Kerja</label></div>
                                    </div>
                                    <div class="form-group striped-col" id="kmw_label" {!! $kode_kmw!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">KMW</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>KMW</option>
			                                    @if($wk_kd_kmw_list!=null)
			                                    @foreach ($wk_kd_kmw_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $kode_kmw==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                    @endif
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="prov_label" {!! $wk_kd_prop!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Provinsi</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_prop-input" name="wk_kd_prop-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>WK Provinsi</option>
			                                    @foreach ($wk_kd_prop_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $wk_kd_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            
						            <div class="form-group striped-col" id="kota_label" {!! $wk_kd_kota!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Kota</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_kota-input" name="wk_kd_kota-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>WK Kota</option>
			                                    @if($wk_kd_kota_list!=null)
			                                    @foreach ($wk_kd_kota_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $wk_kd_kota==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                    @endif
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="korkot_label" {!! $kode_korkot!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Korkot</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>Korkot</option>
			                                    @if($wk_kd_korkot_list!=null)
			                                    @foreach ($wk_kd_korkot_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $kode_korkot==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                    @endif
			                                </select>
						                </div>
						            </div>
						            @if($kode==null)
						            <div class="form-group striped-col" id="kec_label" {!! $kode!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Kecamatan</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>Kecamatan</option>
			                                </select>
						                </div>
						            </div>
						            @endif
						            <div class="form-group striped-col" id="kel_label" {!! $wk_kd_kel!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Kelurahan</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_kel-input" name="wk_kd_kel-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>WK Kelurahan</option>
			                                    @if($wk_kd_kel_list!=null)
			                                    @foreach ($wk_kd_kel_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $wk_kd_kel==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                    @endif
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="faskel_label" {!! $kode_faskel!=null ? '':'hidden' !!}>
						                <label class="col-sm-3 control-label">Faskel</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1" {!! $kode!=null ? 'disabled':'' !!}>
			                                    <option value>Faskel</option>
			                                    @if($wk_kd_faskel_list!=null)
			                                    @foreach ($wk_kd_faskel_list as $kpl)
			                                        <option value="{{$kpl->kode}}" {!! $kode_faskel==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
			                                    @endforeach
			                                    @endif
			                                </select>
						                </div>
						            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group form-actions">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="/hrm/management/registrasi_manual" type="button" class="btn btn-effect-ripple btn-danger">
                                Cancel
                            </a>
                            @if ($kode==null)
                            <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                Reset
                            </button>
                            @endif
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
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>

<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('vendors/pnotify/js/pnotify.js')}}"></script>
<script src="{{asset('js/custom_js/notifications.js')}}"></script>
<script>
  $(document).ready(function () {
  	$('.ui-pnotify').remove();
	$('#form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			"url": "/hrm/management/registrasi_manual/create",
			data: $('form').serialize(),
			beforeSend: function (){
			    $("#submit").prop('disabled', true);
			},
			success: function () {

			alert('From Submitted.');
			window.location.href = "/hrm/management/registrasi_manual";
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

        var level = $('#kode_level-input');
        var role = $('#kode_role-input');
        var kmp = $('#kode_kmp-input');
        var prop = $('#kode_prop-input');
        var kota = $('#kode_kota-input');
        var kec = $('#kode_kecamatan-input');
        var kel = $('#kode_kelurahan-input');
        var wkprop = $('#wk_kd_prop-input');
        var wkkmw = $('#select-kode-kmw-input');
        var wkkota = $('#wk_kd_kota-input');
        var wkkorkot = $('#select-kode-korkot-input');
        var wkkec = $('#select-kode-kec-input');
        var wkkel = $('#wk_kd_kel-input');
        var wkfaskel = $('#select-kode-faskel-input');
        var level_id,role_id,kmp_id,prop_id,kota_id,kec_id,kel_id,wkprop_id,wkkota_id,wkkmw_id,wkkorkot_id,wkkec_id,wkfaskel_id;

        level.change(function(){
            level_id=level.val();
            if(level_id!=null){
                role.empty();
                role.append("<option value>Role</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?level="+level_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            role.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        role.change(function(){
            role_id=role.val();
            level_id=level.val();
            if(role_id!=null && level_id!=null){
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?role_flag_koor="+role_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        if(data!=null){
                            if(data[0].flag_konsultan==1){
                                if(level_id!=null){
                                    if(level_id==2){
                                    	wkkorkot.empty();
                                        $('#korkot_label').hide();
                                        wkfaskel.empty();
                                        $('#faskel_label').hide();
                                        wkkota.empty();
                                        $('#kota_label').hide();
                                        wkkec.empty();
                                        $('#kec_label').hide();
                                        wkkel.empty();
                                        $('#kel_label').hide();

                                        $('#wil_kerja_label').show();
                                        wkprop.empty();
                                        $('#prov_label').show();
                                        wkkmw.empty();
                                        $('#kmw_label').show();

                                    }else if(level_id==3){
                                        wkkorkot.empty();
                                        $('#korkot_label').hide();
                                        wkfaskel.empty();
                                        $('#faskel_label').hide();
                                        wkkec.empty();
                                        $('#kec_label').hide();
                                        wkkel.empty();
                                        $('#kel_label').hide();

                                        $('#wil_kerja_label').show();
                                        wkprop.empty();
                                        $('#prov_label').show();
                                        wkkmw.empty();
                                        $('#kmw_label').show();
                                        wkkota.empty();
                                        $('#kota_label').show();

                                    }else if(level_id==4){
                                        wkkorkot.empty();
                                        $('#korkot_label').hide();
                                        wkkota.empty();
                                        $('#kota_label').hide();
                                        wkfaskel.empty();
                                        $('#faskel_label').hide();
                                        wkkel.empty();
                                        $('#kel_label').hide();
                                        $('#wil_kerja_label').hide();
                                        wkprop.empty();
                                        $('#prov_label').hide();
                                        wkkmw.empty();
                                        $('#kmw_label').hide();
                                        wkkec.empty();
                                        $('#kec_label').hide();

                                    }else if(level_id==5){
                                        wkkorkot.empty();
                                        $('#korkot_label').hide();
                                        wkkota.empty();
                                        $('#kota_label').hide();
                                        wkfaskel.empty();
                                        $('#faskel_label').hide();
                                        wkkec.empty();
                                        $('#kec_label').hide();

                                        $('#wil_kerja_label').show();
                                        wkprop.empty();
                                        $('#prov_label').show();
                                        wkkmw.empty();
                                        $('#kmw_label').show();
                                        wkkota.empty();
                                        $('#kota_label').show();
                                        wkkec.empty();
                                        $('#kec_label').show();
                                        wkkel.empty();
                                        $('#kel_label').show();

                                    }else{
                                        kmp.val(null).trigger('change');
                                        $('#kmp_label').hide();
                                        $('#wil_kerja_label').hide();
                                        wkprop.empty();
                                        $('#prov_label').hide();
                                        wkkmw.empty();
                                        $('#kmw_label').hide();
                                        wkkorkot.empty();
                                        $('#korkot_label').hide();
                                        wkkota.empty();
                                        $('#kota_label').hide();
                                        wkfaskel.empty();
                                        $('#faskel_label').hide();
                                        wkkec.empty();
                                        $('#kec_label').hide();
                                        wkkel.empty();
                                        $('#kel_label').hide();
                                    }
                                }
                                kmp.val(null).trigger('change');
                                $('#kmp_label').show();
                                $('#no_spk_label').show();
                                $('#tgl_spk_label').show();
                                $('#info_bank').show();
                                $('#nama_bank_label').show();
                                $('#no_rekening_label').show();
                                if(data[0].flag_koordinator==1 && data[0].kode_level==2){
                                	wkkorkot.empty();
                                    $('#korkot_label').show();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                }else if(data[0].flag_koordinator==0 && data[0].flag_konsultan==1 && data[0].kode_level==2){
                                	wkkorkot.empty();
                                    $('#korkot_label').show();
                                    wkfaskel.empty();
                                    $('#faskel_label').show();
                                }
                            }else if(data[0].flag_konsultan==0){
                                wkprop.append("<option value>WK Provinsi</option>");
                                wkprop.append("@foreach ($wk_kd_prop_list as $kpl)<option value='{{$kpl->kode}}'>{{$kpl->nama}}</option>@endforeach");
                                if(level_id==2){
                                    wkkota.empty();
                                    $('#kota_label').hide();
                                    wkkec.empty();
                                    $('#kec_label').hide();
                                    wkkel.empty();
                                    $('#kel_label').hide();
                                    wkkorkot.empty();
                                    $('#korkot_label').hide();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                    wkkmw.empty();
                                    $('#kmw_label').hide();

                                    $('#wil_kerja_label').show();
                                    wkprop.val(null).trigger('change');
                                    $('#prov_label').show();

                                }else if(level_id==3){
                                    wkkorkot.empty();
                                    $('#korkot_label').hide();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                    wkkec.empty();
                                    $('#kec_label').hide();
                                    wkkel.empty();
                                    $('#kel_label').hide();

                                    $('#wil_kerja_label').show();
                                    wkprop.val(null).trigger('change');
                                    $('#prov_label').show();
                                    wkkmw.empty();
                                    $('#kmw_label').hide();
                                    wkkota.empty();
                                    $('#kota_label').show();

                                }else if(level_id==4){
                                    wkkorkot.empty();
                                    $('#korkot_label').hide();
                                    wkkota.empty();
                                    $('#kota_label').hide();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                    wkkel.empty();
                                    $('#kel_label').hide();

                                    $('#wil_kerja_label').hide();
                                    wkprop.val(null).trigger('change');
                                    $('#prov_label').hide();
                                    wkkmw.empty();
                                    $('#kmw_label').hide();
                                    wkkec.empty();
                                    $('#kec_label').hide();

                                }else if(level_id==5){
                                    wkkorkot.empty();
                                    $('#korkot_label').hide();
                                    wkkota.empty();
                                    $('#kota_label').hide();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                    wkkec.empty();
                                    $('#kec_label').hide();

                                    $('#wil_kerja_label').show();
                                    wkprop.val(null).trigger('change');
                                    $('#prov_label').show();
                                    wkkmw.empty();
                                    $('#kmw_label').hide();
                                    wkkota.empty();
                                    $('#kota_label').show();
                                    wkkec.empty();
                                    $('#kec_label').show();
                                    wkkel.empty();
                                    $('#kel_label').show();

                                }else{
                                    
                                    $('#wil_kerja_label').hide();
                                    wkprop.val(null).trigger('change');
                                    $('#prov_label').hide();
                                    wkkmw.empty();
                                    $('#kmw_label').hide();
                                    wkkorkot.empty();
                                    $('#korkot_label').hide();
                                    wkkota.empty();
                                    $('#kota_label').hide();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                    wkkec.empty();
                                    $('#kec_label').hide();
                                    wkkel.empty();
                                    $('#kel_label').hide();
                                }
                            kmp.val(null).trigger('change');
                            $('#kmp_label').hide();
                            $('#no_spk_label').hide();
                            $('#tgl_spk_label').hide();
                            $('#info_bank').hide();
                            $('#nama_bank_label').hide();
                            $('#no_rekening_label').hide();
                            wkkmw.empty();
                            $('#kmw_label').hide();
                            }
                        }
                    }
                });
            }
        });

        level.change(function(){
            $('#wil_kerja_label').hide();
            wkprop.val(null).trigger('change');
            $('#prov_label').hide();
            wkkmw.empty();
            $('#kmw_label').hide();
            wkkorkot.empty();
            $('#korkot_label').hide();
            wkkota.empty();
            $('#kota_label').hide();
            wkfaskel.empty();
            $('#faskel_label').hide();
            kmp.val(null).trigger('change');
            $('#kmp_label').hide();
            wkkec.empty();
            $('#kec_label').hide();
            wkkel.empty();
            $('#kel_label').hide();
            $('#no_spk_label').hide();
            $('#tgl_spk_label').hide();
            $('#info_bank').hide();
            $('#nama_bank_label').hide();
            $('#no_rekening_label').hide();
        });

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=null){
                kota.empty();
                kota.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?prop="+prop_id,
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
            if(prop_id!=null){
                kec.empty();
                kec.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?kota="+kota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kec.change(function(){
            kec_id=kec.val();
            if(kec_id!=null){
                kel.empty();
                kel.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?kec="+kec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });


        wkprop.change(function(){
            wkprop_id=wkprop.val();
            if(wkprop_id!=null){

                wkkota.empty();
                wkkota.append("<option value>WK Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_prop_kota="+wkprop_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        kmp.change(function(){
            kmp_id=kmp.val();
            if(kmp_id!=null){

                wkkmw.empty();
                wkkmw.append("<option value>WK KMW</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kmp_kmw="+kmp_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        wkkmw.change(function(){
            wkkmw_id=wkkmw.val();
            if(wkkmw_id!=null){
                wkprop.empty();
                wkprop.append("<option value>WK Provinsi</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kmw_prop="+wkkmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkprop.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

                wkkorkot.empty();
                wkkorkot.append("<option value>WK Korkot</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kmw_korkot="+wkkmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkorkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

                wkfaskel.empty();
                wkfaskel.append("<option value>WK Faskel</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kmw_faskel="+wkkmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkfaskel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        wkkota.change(function(){
            wkkota_id=wkkota.val();
            if(wkkota_id!=null){
                wkkec.empty();
                wkkec.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kota_kec="+wkkota_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkec.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        wkkec.change(function(){
            wkkec_id=wkkec.val();
            if(wkkec_id!=null){
                wkkel.empty();
                wkkel.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/hrm/management/registrasi_manual/select?wk_kd_kec_kel="+wkkec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

  });
</script>

@stop
