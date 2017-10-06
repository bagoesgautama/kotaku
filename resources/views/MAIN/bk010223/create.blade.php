@extends('MAIN/default') {{-- Page title --}} @section('title') @stop {{-- local styles --}}
@section('header_styles')
<link href="{{asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectric/css/selectric.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css">@stop {{-- Page Header--}}
@section('page-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Persiapan Kelurahan - TAPP</h1>
    <div class="bs-example">
        <ul class="breadcrumb">
            <li class="next">
                <a href="/main">
                    <i class="fa fa-fw fa-home"></i> PERSIAPAN KELURAHAN
                </a>
            </li>
            <li class="next">
                TAPP
            </li>
            <li class="next">
                Create
            </li>
        </ul>
    </div>
</section>
@stop {{-- Page content --}} @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label">Tahun</label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="kode" name="kode" value="{{$kode}}">
                                    <input type="text" id="nama-input" name="nama-input" class="form-control" placeholder="Tahun" value="{{$tahun}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kota</label>
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kota-input">
                                        @foreach($kode_kota_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kota) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Nama KorKot</label>            
                                <div class="col-sm-6">
                                    <select id="select21" class="form-control select2" name="example-kode_korkot-input">
                                        @foreach($kode_korkot_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_korkot) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kecamatan</label>
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kec-input">
                                        @foreach($kode_kec_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kec) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input2">KMW</label>          
                                <div class="col-sm-6">
                                    <select id="select22" class="form-control select2" name="example-kode_kmw-input">
                                        @foreach($kode_kmw_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kmw) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kelurahan</label>
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kel-input">
                                        @foreach($kode_kel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_kel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Faskel</label>
                                <div class="col-sm-6">
                                    <select id="select27" class="form-control select2" name="example-kode_faskel-input">
                                        @foreach($kode_faskel_list as $list)
                                            <option value="{{ $list->kode }}" @if($list->kode==$kode_faskel) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="example-text-input31">Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select31" class="form-control select2" name="example-kode_kel-input">
                                        @foreach($kode_id_kegiatan_list as $list)
                                            <option value="{{ $list->id }}" @if($list->id==$id_kegiatan) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input31">Detail Kegiatan</label>
                                <div class="col-sm-6">
                                    <select id="select27" class="form-control select2" name="example-kode_faskel-input">
                                        @foreach($kode_id_dtl_kegiatan_list as $list)
                                            <option value="{{ $list->id }}" @if($list->id==$id_dtl_kegiatan) selected="selected" @endif >{{ $list->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="return_date">Tanggal Diserahkan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="return_date" name="diser_tgl" placeholder="Klik disini untuk memilih tanggal" data-provide="datepicker" value="{{ $diser_tgl}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Diserahkan Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-diser_oleh-input" class="form-control" placeholder="Diserahkan Oleh" value="{{ $diser_oleh }}" maxlength="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="return_date">Tanggal Diketahui</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="return_date" name="diket_tgl" placeholder="Klik disini untuk memilih tanggal" data-provide="datepicker" value="{{ $diket_tgl}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Diketahui Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-diket_oleh-input" class="form-control" placeholder="Diketahui Oleh" value="{{ $diser_oleh }}" maxlength="">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label" for="return_date">Tanggal Diverivikasi</label>
                                <div class="col-sm-6">
                                    <input class="form-control" id="return_date" name="diver_tgl" placeholder="Klik disini untuk memilih tanggal" data-provide="datepicker" value="{{ $diver_tgl}}">
                                </div>
                            </div>
                            <div class="form-group striped-col">
                                <label class="col-sm-3 control-label" for="example-text-input1">Diverivikasi Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" id="example-text-input1" name="example-diket_oleh-input" class="form-control" placeholder="Diverivikasi Oleh" value="{{ $diver_oleh }}" maxlength="">
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="/main/data_wilayah/provinsi" type="button" class="btn btn-effect-ripple btn-danger">
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

@stop {{-- local scripts --}} @section('footer_scripts')
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/form_layouts.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script>
      $(document).ready(function () {
        $('#submit').on('click', function (e) {
            var file_data = document.getElementById('file-input').files[0];
            var form_data = new FormData();
            form_data.append('kode', $('#kode').val());
            form_data.append('file-input', file_data);
            form_data.append('uploaded-file', $('#uploaded-file').val());
            form_data.append('nama-input', $('#nama-input').val());
            form_data.append('nama-pndk-input', $('#nama-pndk-input').val());
            form_data.append('wilayah-input', $('#wilayah-input').val());
            form_data.append('status-input', $('#status-input').val());
            form_data.append('latitude-input', $('#latitude-input').val());
            form_data.append('longitude-input', $('#longitude-input').val());
          e.preventDefault();
          $.ajax({
            type: 'post',
            processData: false,
            contentType: false,
            "url": "/main/data_wilayah/provinsi/create",
            data: form_data,
            beforeSend: function (){
                $("#submit").prop('disabled', true);
            },
            success: function () {
            alert('Form Submitted.');
            window.location.href = "/main/data_wilayah/provinsi";
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

<script src="{{asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/select2/js/select2.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectize/js/standalone/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/iCheck/js/icheck.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/selectric/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/custom_js/custom_elements.js')}}" type="text/javascript"></script>
@stop
