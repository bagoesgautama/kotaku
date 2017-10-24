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
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 login-form">
            <!-- <div class="panel-header">
                <h2 class="text-center">
                    <img src="{{asset('img/pages/clear_black.png')}}" alt="Logo">
                </h2>
            </div> -->
            <div class="panel-body">
                <div class="row">
                    <form action="/registrasi" id="authentication" method="post" class="signup_validator">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" class="form-control form-control-lg" id="username"
                                       name="username" placeholder="Username" required>

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
                                       name="password" placeholder="Password" required>

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
                                       placeholder="First name" value="{{ old('first_name') }}" required autofocus>
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
                                       placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Alamat</label>
                                <input type="text" class="form-control  form-control-lg" id="alamat" name="alamat"
                                       placeholder="Alamat" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kodepos" class="sr-only">Kodepos</label>
                                <input type="text" class="form-control  form-control-lg" id="kodepos" name="kodepos"
                                       placeholder="kodepos" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <p class="form-group" style="text-align: center;">
                                Jenis Kelamin
                            </p>
                        </div> -->
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
                                Tanggal Lahir
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" id="return_date" name="tgl_lahir" placeholder="Select Date" data-provide="datepicker">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="sr-only"> E-mail</label>
                                <input id="email" type="email" class="form-control  form-control-lg" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

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
                                <input type="text" class="form-control  form-control-lg" id="no_hp" name="no_hp"
                                       placeholder="No. Hp" required>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Level</label>
								<select id="kode_level-input" name="kode_level-input" class="form-control select2" size="1">
                                    <option value>Level</option>
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
                            <p class="form-group">
                                Jenis Registrasi
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" id="kode-jr" name="kode-jr" class="radio-blue" value="0" > Mandiri</label>
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
            placeholder: "Level"
        });
        $('#kode_role-input').select2({
            theme: "bootstrap",
            placeholder: "Role"
        });
        $('#kode_prop-input').select2({
            theme: "bootstrap",
            placeholder: "Provinsi"
        });
        $('#kode_kota-input').select2({
            theme: "bootstrap",
            placeholder: "Kota"
        });
        $('#kode_kecamatan-input').select2({
            theme: "bootstrap",
            placeholder: "Kecamatan"
        });
        $('#kode_kelurahan-input').select2({
            theme: "bootstrap",
            placeholder: "Kelurahan"
        });
        var level = $('#kode_level-input');
        var role = $('#kode_role-input');
        var prop = $('#kode_prop-input');
        var kota = $('#kode_kota-input');
        var kec = $('#kode_kecamatan-input');
        var kel = $('#kode_kelurahan-input');
        var level_id,role_id,prop_id,kota_id,kec_id,kel_id;

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
    });
</script>
</body>

</html>
