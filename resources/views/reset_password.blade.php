<!DOCTYPE html>
<html>

<head>
    <title>Reset Password | Clear Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- end of bootstrap -->
    <!--page level css -->
    <link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
    <!--end page level css-->
</head>

<body id="sign-in">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('img/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 login-form">
                <h2 class="text-center">
                    <img src="{{asset('img/pages/clear_black.png')}}" alt="Logo">
                </h2>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center">Reset Password</h4>
                    </div>
                    <div class="col-xs-12">
                        <form action="{{url('login')}}" id="authentication" method="post" class="reset_validator">
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password"
                                           name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="confirm-password"
                                           name="password_confirm" placeholder="Confirm Password">
                                </div>
                            <div class="form-group">
                                <input type="submit" value="Reset Password" class="btn btn-primary center-block"/>
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
<!-- page level js -->
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/custom_js/reset_password.js')}}"></script>
<!-- end of page level js -->
</body>

</html>
