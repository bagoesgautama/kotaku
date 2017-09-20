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
                    <form action="{{'/registrasi'}}" id="authentication" method="post" class="signup_validator">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="hari" name="hari" required>
                                    <option value="0">Hari</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="bulan-" name="bulan" required>
                                    <option value="0">Bulan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" id="tahun" name="tahun" required>
                                    <option value="0">Tahun</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2000">2000</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
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
                            <p class="form-group">
                                Jenis Registrasi
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" id="kode-jr" name="kode-jr" class="radio-blue" value="0"> Mandiri</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" id="kode-jr" name="kode-jr" class="radio-blue" value="1"> Manual</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group checkbox">
                                <label for="terms">
                                    <input type="checkbox" name="terms" id="terms">&nbsp; I accept the <a href="javascript:void(0)">terms &amp; Conditions</a>
                                </label>
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
