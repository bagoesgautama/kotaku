<!DOCTYPE html>
<html>

<head>
    <title>:: Lockscreen ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- styles -->
    <!--page level css -->
    <link href="{{asset('css/lockscreen.css')}}" rel="stylesheet">
    <!--end page level css-->
</head>
<body>
<div class="preloader">
    <div class="loader_img"><img src="{{asset('img/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<div class="top">
    <div class="colors"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <div class="lockscreen-container">
                <div id="output"></div>
                <img src="{{asset('img/logo.png')}}" alt="Logo">
                <div class="form-box">
                    <div class="avatar"></div>
                    <form action="#" method="post">
                        <div class="form">
                            <div class="row">
                                <h4 class="user-name hidden-sm hidden-md hidden-lg">Addision</h4>
                                <div class="col-sm-6">
                                    <input type="text" class="hidden-xs" value="Addison" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="user" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <button class="btn login" id="index" type="submit">
                                <img src="{{asset('img/pages/arrow-right.png')}}" alt="Go" width="30" height="30">
                            </button>
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
<!-- page css -->
<script src="{{asset('js/lockscreen.js')}}"></script>
<!-- end of page css -->
</body>

</html>