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
                                    <input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="P" required> Pria</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" id="kode-jk" name="kode-jk" class="radio-blue" value="W" required> Wanita</label>
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
								<select id="kode_level-input" name="kode_level-input" class="form-control" size="1">
			                        @foreach ($level_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
			                    </select>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Role</label>
								<select id="kode_role-input" name="kode_role-input" class="form-control" size="1">
			                        @foreach ($role_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
			                    </select>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Provinsi</label>
								<select id="kode_prop-input" name="kode_prop-input" class="form-control" size="1">
			                        @foreach ($prop_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
			                    </select>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Kota</label>
								<select id="kode_kota-input" name="kode_kota-input" class="form-control" size="1">
			                        @foreach ($kota_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
			                    </select>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Kecamatan</label>
								<select id="kode_kecamatan-input" name="kode_kecamatan-input" class="form-control" size="1">
			                        @foreach ($kec_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
			                    </select>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="sr-only">Kelurahan</label>
								<select id="kode_kelurahan-input" name="kode_kelurahan-input" class="form-control" size="1">
			                        @foreach ($kel_list as $kpl)
			                            <option value="{{$kpl->kode}}" >{{$kpl->nama}}</option>
			                        @endforeach
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
</body>

</html>
