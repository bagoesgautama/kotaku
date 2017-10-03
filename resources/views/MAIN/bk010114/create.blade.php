@extends('MAIN/default') {{-- Page title --}} @section('title') Mapping FasKel ke Kelurahan Form @stop {{-- local styles --}} @section('header_styles')
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('css/form_layouts.css')}}">@stop {{-- Page Header--}} @section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Role Level User Form</h1>
    <ol class="breadcrumb">
        <li>
            <a href="/main">
                <i class="fa fa-fw fa-home"></i> MAIN
            </a>
        </li>
        <li><a href="/main/kel_faskel"> Mapping FasKel ke Kelurahan </a></li>
        <li class="active">
            Create
        </li>
    </ol>
</section>
@stop
{{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kode KMP</label>
                                <input type="hidden" id="example-text-input1" name="example-id-input" value="{{ $kode }}">
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kmp_slum_prog-input">
                                        @foreach($kode_kmp_slum_program_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmp_slum_prog) selected="selected" @endif >{{ $list->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input32">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select32" class="form-control select2" name="example-kode_faskel-input" >
                                        @foreach($kode_faskel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_faskel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input33">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select33" class="form-control select2" name="example-kode_kel-input" >
                                        @foreach($kode_kel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">BLM</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-blm" class="form-control" size="1">
                                        <option value="1" @if($blm==1) selected="selected" @endif >BLM 1</option>
                                        <option value="2" @if($blm==2) selected="selected" @endif >BLM 2</option>
                                        <option value="3" @if($blm==3) selected="selected" @endif >BLM 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Jenis Project</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-jenis_project" class="form-control" size="1">
                                        <option value="1" @if($jenis_project==1) selected="selected" @endif >Project 1</option>
                                        <option value="2" @if($jenis_project==2) selected="selected" @endif >Project 2</option>
                                        <option value="3" @if($jenis_project==3) selected="selected" @endif >Project 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Glossary</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-tahun_glossary-input" class="form-control" placeholder="Tahun Glossary" value="{{ $tahun_glossary }}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Tahun Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-tahun_project-input" class="form-control" placeholder="Tahun Project" value="{{ $tahun_project }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Awal Project</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-tahun_project-input" class="form-control" placeholder="Awal Project" value="{{ $awal_project }}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Nama MS</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-kode_ms" class="form-control" size="1">
                                        <option value="1" @if($kode_ms==1) selected="selected" @endif >MS 1</option>
                                        <option value="2" @if($kode_ms==2) selected="selected" @endif >MS 2</option>
                                        <option value="3" @if($kode_ms==3) selected="selected" @endif >MS 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input34">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select34" class="form-control select2" name="example-kode_kec-input" >
                                        @foreach($kode_kec_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kec) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input35">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select35" class="form-control select2" name="example-kode_kota-input" >
                                        @foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input36">Propinsi</label>
                                <div class="col-sm-6">
                                    <select id="select36" class="form-control select2" name="example-kode_prop-input" >
                                        @foreach($kode_prop_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_prop) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi BLM</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-lokasi_blm" class="form-control" size="1">
                                        <option value="1" @if($lokasi_blm==1) selected="selected" @endif >Lokasi BLM 1</option>
                                        <option value="2" @if($lokasi_blm==2) selected="selected" @endif >Lokasi BLM 2</option>
                                        <option value="3" @if($lokasi_blm==3) selected="selected" @endif >Lokasi BLM 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-Lokasi_kumuh" class="form-control" size="1">
                                        <option value="1" @if($Lokasi_kumuh==1) selected="selected" @endif >Lokasi Kumuh 1</option>
                                        <option value="2" @if($Lokasi_kumuh==2) selected="selected" @endif >Lokasi Kumuh 2</option>
                                        <option value="3" @if($Lokasi_kumuh==3) selected="selected" @endif >Lokasi Kumuh 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-select1">Flag Kumuh</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-flag_kumuh" class="form-control" size="1">
                                        <option value="1" @if($flag_kumuh==1) selected="selected" @endif >Flag Kumuh 1</option>
                                        <option value="2" @if($flag_kumuh==2) selected="selected" @endif >Flag Kumuh 2</option>
                                        <option value="3" @if($flag_kumuh==3) selected="selected" @endif >Flag Kumuh 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-select1">Lokasi Lokasi PPMK</label>
                                <div class="col-sm-6">
                                    <select id="example-select1" name="example-select-flag_lokasi_ppmk" class="form-control" size="1">
                                        <option value="1" @if($flag_lokasi_ppmk==1) selected="selected" @endif >Flag Lokasi PPMK 1</option>
                                        <option value="2" @if($flag_lokasi_ppmk==2) selected="selected" @endif >Flag Lokasi PPMK 2</option>
                                        <option value="3" @if($flag_lokasi_ppmk==3) selected="selected" @endif >Flag Lokasi PPMK 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_time }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Created By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $created_by }}</label>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated Time</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_time }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input1">Updated By</label>
                                <div class="col-sm-6">
                                    <label class="form-control">{{ $updated_by }}</label>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/kel_faskel" type="button" class="btn btn-effect-ripple btn-danger">
                                        Cancel
                                    </a>
                                    <button type="submit" id="submit" class="btn btn-effect-ripple btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn2">
                                        Reset
                                    </button>
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
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            "url": "/main/kel_faskel/create",
            data: $('form').serialize(),
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
    
            alert('From Submitted.');
            window.location.href = "/main/kel_faskel";
            },
            error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            $("#submit").prop('disabled', false);
            }
          });
        });
      });
</script>
@stop
