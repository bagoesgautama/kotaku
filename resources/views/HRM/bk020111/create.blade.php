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
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Role</label>
						                <div class="col-sm-6">
						                	<select id="kode_role-input" name="kode_role-input" class="form-control select2" size="1">
			                                    <option value>Role</option>

			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">KMP</label>
						                <div class="col-sm-6">
						                	<select id="kode_kmp-input" name="kode_kmp-input" class="form-control select2" size="1">
			                                    <option value>KMP</option>
			                                    @foreach ($kmp_list as $kpl)
			                                        <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col" id="wil_kerja_label">
                                        <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Wilayah Kerja</label></div>
                                    </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Provinsi</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_prop-input" name="wk_kd_prop-input" class="form-control select2" size="1">
			                                    <option value>WK Provinsi</option>
			                                    @foreach ($wk_kd_prop_list as $kpl)
			                                        <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                                    @endforeach
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">KMW</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1">
			                                    <option value>KMW</option>
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kota</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_kota-input" name="wk_kd_kota-input" class="form-control select2" size="1">
			                                    <option value>WK Kota</option>
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Korkot</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1">
			                                    <option value>Korkot</option>
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kecamatan</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1">
			                                    <option value>Kecamatan</option>
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Kelurahan</label>
						                <div class="col-sm-6">
						                	<select id="wk_kd_kel-input" name="wk_kd_kel-input" class="form-control select2" size="1">
			                                    <option value>WK Kelurahan</option>
			                                </select>
						                </div>
						            </div>
						            <div class="form-group striped-col">
						                <label class="col-sm-3 control-label">Faskel</label>
						                <div class="col-sm-6">
						                	<select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1">
			                                    <option value>Faskel</option>
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
                    "url": "hrm/admin/registrasi_manual/select?level="+level_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            role.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        level.change(function(){
            level_id=level.val();
            role_id=role.val();
            kmp_id=kmp.val();

            if(level_id!=null){
                if(level_id==2){
                    wkkota.empty();
                    $('#kota_label').hide();
                    wkfaskel.empty();
                    $('#faskel_label').hide();
                    wkkec.empty();
                    $('#kec_label').hide();
                    wkkel.empty();
                    $('#kel_label').hide();
                    $('#wil_kerja_label').show();
                    wkprop.val(null).trigger('change');
                    $('#prov_label').show();
                    $('#kmw_label').show();

                }else if(level_id==3){
                    wkkorkot.empty();
                    $('#korkot_label').hide();
                    wkkec.empty();
                    $('#kec_label').hide();
                    wkkel.empty();
                    $('#kel_label').hide();
                    $('#wil_kerja_label').show();
                    wkprop.val(null).trigger('change');
                    $('#prov_label').show();
                    $('#kmw_label').show();
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
                    $('#wil_kerja_label').show();
                    wkprop.val(null).trigger('change');
                    $('#prov_label').show();
                    $('#kmw_label').show();
                    $('#kota_label').show();
                    $('#kec_label').show();

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
                    $('#kmw_label').show();
                    $('#kota_label').show();
                    $('#kec_label').show();
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
                }
            }
        });

        prop.change(function(){
            prop_id=prop.val();
            if(prop_id!=null){
                kota.empty();
                kota.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?prop="+prop_id,
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
                    "url": "hrm/admin/registrasi_manual/select?kota="+kota_id,
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
                    "url": "hrm/admin/registrasi_manual/select?kec="+kec_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            kel.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        role.change(function(){
            role_id=role.val();
            if(role_id!=null){
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?role_flag_koor="+role_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        if(data!=null){
                            if(data[0].flag_koordinator==1 && data[0].kode_level==2){
                                $('#korkot_label').show();
                            }else if(data[0].flag_koordinator==1 && data[0].kode_level==3){
                                $('#faskel_label').show();
                            }else{
                                if(data[0].kode_level==2){
                                    wkkorkot.val(null).trigger('change');
                                    $('#korkot_label').hide();
                                }else if(data[0].kode_level==3){
                                    wkfaskel.val(null).trigger('change');
                                    $('#faskel_label').hide();
                                }
                                
                            }
                        }
                    }
                });
            }
        });

        wkprop.change(function(){
            wkprop_id=wkprop.val();
            if(wkprop_id!=null){
                wkkmw.empty();
                wkkmw.append("<option value>KMW</option>");
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_prop_kmw="+wkprop_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkmw.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

                wkkota.empty();
                wkkota.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_prop_kota="+wkprop_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkota.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });
            }
        });

        wkkmw.change(function(){
            wkkmw_id=wkkmw.val();
            if(wkkmw_id!=null){
                wkkorkot.empty();
                wkkorkot.append("<option value>Korkot</option>");
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_kmw_korkot="+wkkmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkkorkot.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

                wkfaskel.empty();
                wkfaskel.append("<option value>Faskel</option>");
                $.ajax({
                    type: 'get',
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_kmw_faskel="+wkkmw_id,
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
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_kota_kec="+wkkota_id,
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
                    "url": "hrm/admin/registrasi_manual/select?wk_kd_kec_kel="+wkkec_id,
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
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
@stop
