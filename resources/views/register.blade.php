<!DOCTYPE html>
<html>

<head>
    <title>::Admin Register::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- global css -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <!-- end of global css -->
    <!--page level css -->
    <link type="text/css" href="{{asset('vendors/themify/css/themify-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
    <!--end of page level css-->
</head>

<body id="sign-up">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('img/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 login-form">
            <!-- <div class="panel-header">
                <h2 class="text-center">
                    <img src="{{asset('img/pages/clear_black.png')}}" alt="Logo">
                </h2>
            </div> -->
            <div class="panel-body">
                <div class="row">
                    <form action="/registrasi" id="authentication" method="post" class="signup_validator">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" class="form-control form-control-lg" id="username"
                                           name="username" placeholder="Username" required maxlength="50">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password"
                                           name="password" placeholder="Password" required maxlength="255">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first" class="sr-only">First Name</label>
                                    <input type="text" class="form-control  form-control-lg" id="first_name" name="first_name"
                                           placeholder="First name" value="{{ old('first_name') }}" required autofocus maxlength="50">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last" class="sr-only">Last Name</label>
                                    <input type="text" class="form-control  form-control-lg" id="last" name="last_name"
                                           placeholder="Last name" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Alamat</label>
                                    <input type="text" class="form-control  form-control-lg" id="alamat" name="alamat"
                                           placeholder="Alamat" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Provinsi</label>
                                    <select id="kode_prop-input" name="kode_prop-input" class="form-control select2" size="1">
                                        <option value>Provinsi</option>
                                        @foreach ($prop_list as $kpl)
                                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kota</label>
                                    <select id="kode_kota-input" name="kode_kota-input" class="form-control select2" size="1">
                                        <option value>Kota</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kecamatan</label>
                                    <select id="kode_kecamatan-input" name="kode_kecamatan-input" class="form-control select2" size="1">
                                        <option value>Kecamatan</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kelurahan</label>
                                    <select id="kode_kelurahan-input" name="kode_kelurahan-input" class="form-control select2" size="1">
                                        <option value>Kelurahan</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kodepos" class="sr-only">Kodepos</label>
                                    <input type="text" class="form-control  form-control-lg" id="kodepos" name="kodepos"
                                           placeholder="kodepos" maxlength="5">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="last" class="sr-only">NIK</label>
                                    <input type="number" class="form-control  form-control-lg" id="nik" name="nik"
                                           placeholder="NIK" maxlength="16" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="last" class="sr-only">No. NPWP</label>
                                    <input type="number" class="form-control  form-control-lg" id="no_npwp" name="no_npwp"
                                           placeholder="No. NPWP" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="form-group">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <p class="form-group">
                                    Jenis Kelamin
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="P" required checked> Pria</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="W"> Wanita</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="form-group">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Tempat Lahir</label>
                                    <select id="kode_tempat_lahir-input" name="kode_tempat_lahir-input" class="form-control select2" size="1">
                                        <option value>Kota</option>
                                        @foreach ($kota_list as $kpl)
                                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="return_date" name="tgl_lahir" placeholder="Tanggal Lahir" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="sr-only"> E-mail</label>
                                    <input id="email" type="email" class="form-control  form-control-lg" name="email" value="{{ old('email') }}" placeholder="E-mail" required maxlength="255">

                                    <!-- <input type="text" class="form-control  form-control-lg" id="email" name="email" placeholder="E-mail"> -->
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">No. Hp</label>
                                    <input type="number" class="form-control  form-control-lg" id="no_hp" name="no_hp"
                                           placeholder="No. Hp" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">No. Telp</label>
                                    <input type="text" class="form-control  form-control-lg" id="no_telp" name="no_telp"
                                           placeholder="No. Telp" maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <p class="form-group">
                                    Role Level
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Level</label>
                                    <select id="kode_level-input" name="kode_level-input" class="form-control select2" size="1">
                                        <option value>Role Level</option>
                                        @foreach ($level_list as $kpl)
                                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Role</label>
                                    <select id="kode_role-input" name="kode_role-input" class="form-control select2" size="1">
                                        <option value>Role</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="no_spk_label" hidden>
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">No. SPK</label>
                                    <input type="number" class="form-control  form-control-lg" id="no_spk" name="no_spk"
                                           placeholder="No. SPK" maxlength="45">
                                </div>
                            </div>
                            <div class="col-md-12" id="tgl_spk_label" hidden>
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">Tgl. SPK</label>
                                    <input class="form-control" id="return_date" name="tgl_spk" placeholder="Tanggal SPK" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-md-12" id="nama_bank_label" hidden>
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">Nama Bank</label>
                                    <input type="text" class="form-control  form-control-lg" id="nama_bank" name="nama_bank"
                                           placeholder="Bank" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-12" id="no_rekening_label" hidden>
                                <div class="form-group">
                                    <label for="no_hp" class="sr-only">No. Rekening</label>
                                    <input type="number" class="form-control  form-control-lg" id="no_rekening" name="no_rekening"
                                           placeholder="No. Rekening" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-12" id="kmp_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">KMP</label>
                                    <select id="kode_kmp-input" name="kode_kmp-input" class="form-control select2" size="1">
                                        <option value>KMP</option>
                                        @foreach ($kmp_list as $kpl)
                                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="wil_kerja_label" hidden>
                                <p class="form-group">
                                    Wilayah Kerja
                                </p>
                            </div>
                            <div class="col-md-12" id="kmw_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">KMW</label>
                                    <select id="select-kode-kmw-input" name="kode-kmw-input" class="form-control select2" size="1">
                                        <option value>KMW</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="prov_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Provinsi</label>
                                    <select id="wk_kd_prop-input" name="wk_kd_prop-input" class="form-control select2" size="1">
                                        <option value>WK Provinsi</option>
                                        @foreach ($wk_kd_prop_list as $kpl)
                                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="kota_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kota</label>
                                    <select id="wk_kd_kota-input" name="wk_kd_kota-input" class="form-control select2" size="1">
                                        <option value>WK Kota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="korkot_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Korkot</label>
                                    <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1">
                                        <option value>Korkot</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="kec_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kecamatan</label>
                                    <select id="select-kode-kec-input" name="kode-kec-input" class="form-control select2" size="1">
                                        <option value>Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="kel_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Kelurahan</label>
                                    <select id="wk_kd_kel-input" name="wk_kd_kel-input" class="form-control select2" size="1">
                                        <option value>WK Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="faskel_label" hidden>
                                <div class="form-group">
                                    <label for="alamat" class="sr-only">Faskel</label>
                                    <select id="select-kode-faskel-input" name="kode-faskel-input" class="form-control select2" size="1">
                                        <option value>Faskel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="form-group">
                                    Jenis Registrasi
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" id="kode-jr" name="kode-jr" class="radio-blue" value="0" checked> Mandiri</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" id="kode-jr" name="kode-jr" class="radio-blue" value="1" disabled> Manual</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Sign Up" class="btn btn-primary btn-block"/>
                                </div>
                                <span class="sign-in">Already a member? <a href="login">Sign In</a></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <p class="form-group" style="text-align: center;">
                                Jenis Kelamin
                            </p>
                        </div> -->
                        
                        
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/register.js')}}"></script>
<!-- end of page level js -->
<script>
    $(document).ready(function () {
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
                    "url": "/register/select?level="+level_id,
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
                    "url": "/register/select?role_flag_koor="+role_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        if(data!=null){
                            if(data[0].flag_konsultan==1){
                                if(level_id!=null){
                                    if(level_id==2){
                                        wkkota.empty();
                                        $('#kota_label').hide();
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
                                        $('#kmw_label').show();
                                        $('#kota_label').show();
                                        $('#kec_label').show();
                                        $('#kel_label').show();

                                    }else{
                                        kmp.val(null).trigger('change');
                                        $('#kmp_label').hide();
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
                                }
                                $('#kmp_label').show();
                                $('#no_spk_label').show();
                                $('#tgl_spk_label').show();
                                $('#nama_bank_label').show();
                                $('#no_rekening_label').show();
                                if(data[0].flag_koordinator==1 && data[0].kode_level==2){
                                    $('#korkot_label').show();
                                    wkfaskel.empty();
                                    $('#faskel_label').hide();
                                }else if(data[0].flag_koordinator==0 && data[0].flag_konsultan==1 && data[0].kode_level==2){
                                    $('#korkot_label').show();
                                    $('#faskel_label').show();
                                }
                            }else if(data[0].flag_konsultan==0){
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
                                    wkkec.empty();
                                    $('#kec_label').hide();
                                    wkkel.empty();
                                    $('#kel_label').hide();
                                }
                            kmp.val(null).trigger('change');
                            $('#kmp_label').hide();
                            $('#no_spk_label').hide();
                            $('#tgl_spk_label').hide();
                            $('#nama_bank_label').hide();
                            $('#no_rekening_label').hide();
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
                    "url": "/register/select?prop="+prop_id,
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
                    "url": "/register/select?kota="+kota_id,
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
                    "url": "/register/select?kec="+kec_id,
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
                wkkota.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/register/select?wk_kd_prop_kota="+wkprop_id,
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
                wkkmw.append("<option value>Kota</option>");
                $.ajax({
                    type: 'get',
                    "url": "/register/select?wk_kd_kmp_kmw="+kmp_id,
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
                wkprop.append("<option value>KMW</option>");
                $.ajax({
                    type: 'get',
                    "url": "/register/select?wk_kd_kmw_prop="+wkkmw_id,
                    success: function (data) {
                        data=JSON.parse(data)
                        for (var i=0;i<data.length;i++){
                            wkprop.append("<option value="+data[i].kode+" >"+data[i].nama+"</option>");
                        }
                    }
                });

                wkkorkot.empty();
                wkkorkot.append("<option value>Korkot</option>");
                $.ajax({
                    type: 'get',
                    "url": "/register/select?wk_kd_kmw_korkot="+wkkmw_id,
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
                    "url": "/register/select?wk_kd_kmw_faskel="+wkkmw_id,
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
                    "url": "/register/select?wk_kd_kota_kec="+wkkota_id,
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
                    "url": "/register/select?wk_kd_kec_kel="+wkkec_id,
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
</body>

</html>
