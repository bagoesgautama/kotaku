@extends('MAIN/default') {{-- Page title --}} @section('title') Lokasi & Profile Permukiman Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">
<link href="{{asset('vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet">
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" rel="stylesheet"/>
<link href="{{asset('css/custom_css/wizard.css')}}" rel="stylesheet" type="text/css"/>
@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>MAIN Module</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> MAIN
                </a>
            </li>
            <li class="next">
                <a href="/main/perencanaan/penanganan/lokasi_profile">
                    Perencanaan / Penanganan / Lokasi & Profile Permukiman, Produk Perencanaan, Profile Kumuh
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
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="commentForm" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div id="rootwizard">
                                <ul>
                                    <li>
                                        <a href="#tab1" data-toggle="tab">
                                            <span>
                                                <span>Pre</span>
                                                <br>
                                                <span>Data</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab">
                                            <span>
                                                <span>Lokasi & Profile</span>
                                                <br>
                                                <span>Permukiman</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab">
                                            <span>
                                                <span>Produk Rencana</span>
                                                <br>
                                                <span>Penanganan Rusuh</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab">
                                            <span>
                                                <span>Profile</span>
                                                <br>
                                                <span>Kumuh Kota</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab5" data-toggle="tab">
                                            <span>
                                                <span>Tingkat</span>
                                                <br>
                                                <span>Kekumuhan</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab6" data-toggle="tab">
                                            <span>
                                                <span>Aspek Kumuh</span>
                                                <br>
                                                <span>(Sumber Data Baseline)</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                            <div class="col-sm-6">
                                            <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                                <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" required maxlength="4" class="form-control" data-bv-greaterthan-inclusive="false" data-bv-lessthan-inclusive="true">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Propinsi</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode-prop-input" name="kode-prop-input" class="form-control select2" size="1" required>
                                                    @foreach ($kode_prop_list as $kpl)
                                                        <option value="{{$kpl->kode}}" {!! $kode_prop==$kpl->kode ? 'selected':'' !!}>{{$kpl->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Kota</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode-kota-input" name="kode-kota-input" class="form-control select2" size="1" required>
                                                    @foreach ($kode_kota_list as $kkl)
                                                        <option value="{{$kkl->kode}}" {!! $kode_kota==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Korkot</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode-korkot-input" name="kode-korkot-input" class="form-control select2" size="1" required>
                                                    @foreach ($kode_korkot_list as $kkl)
                                                        <option value="{{$kkl->kode}}" {!! $kode_korkot==$kkl->kode ? 'selected':'' !!}>{{$kkl->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="userName" class="control-label">User name *</label>
                                            <input id="userName" name="username" type="text" placeholder="Enter user name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email *</label>
                                            <input id="email" name="email" placeholder="Enter your Email" type="text" class="form-control required email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password *</label>
                                            <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="control-label">Confirm Password *</label>
                                            <input id="confirm" name="confirm" type="password" placeholder="Confirm your password " class="form-control required">
                                        </div> -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Nomor SK Kumuh (Yang ada atau hasil Review)</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="lpp-sk-kmh" name="lpp-sk-kmh" class="form-control" value="{{$lpp_sk_kmh}}" maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh sesuai SK (HA)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="lpp-l-kmh-sk" name="lpp-l-kmh-sk" class="form-control" value="{{$lpp_l_kmh_sk}}" maxlength="9" required data-bv-greaterthan-inclusive="false" data-bv-lessthan-inclusive="true">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Luas Kumuh sesuai Hasil Verifikasi (HA)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="lpp-l-kmh-ver" name="lpp-l-kmh-ver" class="form-control" value="{{$lpp_l_kmh_ver}}" maxlength="9" required data-bv-greaterthan-inclusive="false" data-bv-lessthan-inclusive="true">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Profile Permukiman Kota (*)</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="prof-pmkm-kota" name="prof-pmkm-kota" class="form-control" value="{{$prof_pmkm_kota}}" maxlength="100" required>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="userName" class="control-label">User name *</label>
                                            <input id="userName" name="username" type="text" placeholder="Enter user name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email *</label>
                                            <input id="email" name="email" placeholder="Enter your Email" type="text" class="form-control required email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password *</label>
                                            <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm" class="control-label">Confirm Password *</label>
                                            <input id="confirm" name="confirm" type="password" placeholder="Confirm your password " class="form-control required">
                                        </div> -->
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label for="name" class="control-label">First name *</label>
                                            <input id="name" name="fname" placeholder="Enter your First name" type="text" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="control-label">Last name *</label>
                                            <input id="surname" name="lname" type="text" placeholder=" Enter your Last name" class="form-control required">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Gender</label>
                                            <select class="form-control" name="gender" id="gender" title="Select an account type...">
                                                <option disabled="" selected="">Select</option>
                                                <option>MALE</option>
                                                <option>FEMALE</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input id="address" name="address" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="age" class="control-label">Age *</label>
                                            <input id="age" name="age" type="text" maxlength="3" class="form-control required number" data-bv-greaterthan-inclusive="false" data-bv-lessthan-inclusive="true">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <div class="form-group">
                                            <label for="phone1" class="control-label">Home number *</label>
                                            <input type="text" class="form-control" id="phone1" name="phone1" placeholder="(999)999-9999">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone2" class="control-label">Personal number *</label>
                                            <input type="text" class="form-control" id="phone2" name="phone2" placeholder="(999)999-9999">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone3" class="control-label">Alternate number *</label>
                                            <input type="text" class="form-control" id="phone3" name="phone3" placeholder="(999)999-9999">
                                        </div>
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label>
                                                <input id="acceptTerms" name="acceptTerms" type="checkbox" class="custom-checkbox"> *I agree with the <a href="javascript:void(0)">terms &amp; Conditions</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous">
                                            <a>Previous</a>
                                        </li>
                                        <li class="next">
                                            <a>Next</a>
                                        </li>
                                        <li class="next finish" style="display:none;">
                                            <a>Finish</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">User Register</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>You have Submitted Successfully.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">OK
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_wizards.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/persiapan/nasional/pokja/pembentukan/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/persiapan/nasional/pokja/pembentukan";
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status);
              alert(thrownError);
              $("#submit").prop('disabled', false);
            }
          });
        });
        $("#select-kode-kota-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-korkot-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
        $("#select-kode-prop-input").select2({
            theme: "bootstrap",
            placeholder: "single select"
        });
      });
</script>
@stop
