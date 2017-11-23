<!DOCTYPE html>
<html>

<head>
    <title>SIM Module</title>
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
        <div class="col-md-12 ">
			<div class="row">
				<div class="col-md-4 ">
				    <div class="panel-body">
						<a href='hrm'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                    <i class="fa-5x fa ti-user hover-rotate text-white">HRM</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@if( ! empty($apps['1']))
				<div class="col-md-4 ">
				    <div class="panel-body">
						<a href='main'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                    <i class="fa-5x fa fa-tasks hover-rotate text-white">MAIN</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@endif
				@if( ! empty($apps['5']))
				<div class="col-md-4 ">
				    <div class="panel-body">
						<a href='qs'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                   	<i class="fa-5x fa fa-bolt hover-rotate text-white">QS</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@endif
			</div>
			<div class="row">
				@if( ! empty($apps['4']))
				<div class="col-md-4 ">
					<div class="panel-body">
						<a href='#'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                    <i class="fa-5x fa fa-group hover-rotate text-white">PPM</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@endif
				@if( ! empty($apps['4']))
				<div class="col-md-4 ">
				    <div class="panel-body">
						<a href='gis'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                   	<i class="fa-5x fa fa-map-marker hover-rotate text-white">GIS</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@endif
				@if( ! empty($apps['6']))
				<div class="col-md-4 ">
					<div class="panel-body">
						<a href='slum'>
							<div class="panel panel-widget">
					            <div class="panel-body bg-primary text-center careers-item">
					                <div>
					                    <i class="fa-5x fa fa-bar-chart-o hover-rotate text-white">Profile</i>
					                </div>
					            </div>
					        </div>
						</a>
		            </div>
				</div>
				@endif
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
