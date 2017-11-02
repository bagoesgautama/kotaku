<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading tab-list">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                                        Pilih Paket Kerja
                                    </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">
                                        Data Paket Kerja
                                    </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">
                                         Input Data Kontrak
                                    </a>
                    </li>
                    <!-- <li>
                        <a href="#tab5" data-toggle="tab">
                                        Tambahan Data
                                    </a>
                    </li> -->
                </ul>
            </div>
            <div class="panel-body">
                <form id="form" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pilih Paket Kerja</label>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="kode" name="kode" value="{{ $kode }}">
                                                <select id="select-kode_pkt_krj-input" name="select-kode_pkt_krj-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($kode_pkt_krj_list as $kpkl)
                                                        <option value="{{$kpl->kode}}" {!! $kode_pkt_krj==$kpkl->kode ? 'selected':'' !!}>{{$kpkl->jenis_komponen_keg.'-'.$kpkl->nama_subkomponen.'-'.$kpkl->nama_dtl_subkomponen}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group striped-col">
                                            <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Data Umum</label></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Skala Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="skala_kegiatan-input" name="skala_kegiatan-input" placeholder="Sumber Dana" value="{{$skala_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="kode">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="tahun-input" name="tahun-input" placeholder="Tahun" value="{{$tahun}}" maxlength="4" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">KMW</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kmw-input" name="select-kode_kmw-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kmw}}" {!! $kode_kmw==$dkl->kode_kmw ? 'selected':'' !!}>{{$dkl->nama_kmw}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Kota</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kota-input" name="select-kode_kota-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kota}}" {!! $kode_kota==$dkl->kode_kota ? 'selected':'' !!}>{{$dkl->nama_kota}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Korkot</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_korkot-input" name="select-kode_korkot-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_korkot}}" {!! $kode_korkot==$dkl->kode_korkot ? 'selected':'' !!}>{{$dkl->nama_korkot}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Kecamatan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kec-input" name="select-kode_kec-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kec}}" {!! $kode_kec==$dkl->kode_kec ? 'selected':'' !!}>{{$dkl->nama_kec}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Kelurahan</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_kel-input" name="select-kode_kel-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_kel}}" {!! $kode_kel==$dkl->kode_kel ? 'selected':'' !!}>{{$dkl->nama_kel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Faskel</label>
                                            <div class="col-sm-6">
                                                <select id="select-kode_faskel-input" name="select-kode_faskel-input" class="form-control select2" size="1">
                                                    <option value="">Please select</option>
                                                    @foreach ($data_kegiatan_list as $dkl)
                                                        <option value="{{$dkl->kode_faskel}}" {!! $kode_faskel==$dkl->kode_faskel ? 'selected':'' !!}>{{$dkl->nama_faskel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Komponen Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="jenis_komponen_keg-input" name="jenis_komponen_keg-input" placeholder="Subkomponen" value="{{$jenis_komponen_keg}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Subkomponen</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="id_subkomponen-input" name="id_subkomponen-input" placeholder="Subkomponen" value="{{$id_subkomponen}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Detail Subkomponen</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="id_dtl_subkomponen-input" name="id_dtl_subkomponen-input" placeholder=" Detail Subkomponen" value="{{$id_dtl_subkomponen}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Volume Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_vol_kegiatan-input" name="dk_vol_kegiatan-input" placeholder="Lokasi Kegiatan" value="{{$dk_vol_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Satuan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_satuan-input" name="dk_satuan-input" placeholder=" Tipe Penanganan" value="{{$dk_satuan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="lok_kegiatan-input" name="lok_kegiatan-input" placeholder="Lokasi Kegiatan" value="{{$lok_kegiatan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">Tipe Penanganan</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="dk_tipe_penanganan-input" name="dk_tipe_penanganan-input" placeholder=" Tipe Penanganan" value="{{$dk_tipe_penanganan}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <div class="control-label" style="text-align: center;"><label style="text-decoration: underline; font-weight: bold;">Nilai Biaya</label></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBN NSUP (Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_a_pupr_bdi_kolab-input" name="nb_a_pupr_bdi_kolab-input" class="form-control" value="{{$nb_a_pupr_bdi_kolab}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBN LAIN (Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_a_pupr_bdi_plbk-input" name="nb_a_pupr_bdi_plbk-input" class="form-control" value="{{$nb_a_pupr_bdi_plbk}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBD Provinsi(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbd_prop-input" name="nb_apbd_prop-input" class="form-control" value="{{$nb_apbd_prop}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">APBD Kab/Kota/BUMD(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_apbd_kota-input" name="nb_apbd_kota-input" class="form-control" value="{{$nb_apbd_kota}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Lainnya(Rp)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="nb_lainnya-input" name="nb_lainnya-input" class="form-control" value="{{$nb_lainnya}}" maxlength="27" placeholder="Nilai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Mulai Lelang</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="tgl_lelang_mulai-input" name="tgl_lelang_mulai-input" placeholder="Tanggal Mulai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_mulai}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Lelang Selesai</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="tgl_lelang_selesai-input" name="tgl_lelang_selesai-input" placeholder="Tanggal Selesai" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$tgl_lelang_selesai}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">APBN NSUP (PHLN)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbn_nsup-input" name="sd_apbn_nsup-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_nsup}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">APBN Lainya (PHLN/RM)</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbn_lain-input" name="sd_apbn_lain-input" class="form-control" placeholder="Rp" value="{{$sd_apbn_lain}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">APBD PROP</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbd_prop-input" name="sd_apbd_prop-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_prop}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">APBD KAB/KOTA</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_apbd_kota-input" name="sd_apbd_kota-input" class="form-control" placeholder="Rp" value="{{$sd_apbd_kota}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Swasta/Lainya</label>
                                            <div class="col-sm-6">
                                                <input type="number" id="sd_swasta-input" name="sd_swasta-input" class="form-control" placeholder="Rp" value="{{$sd_swasta}}" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-textarea-input2">Keterangan</label>
                                            <div class="col-sm-6">
                                                <textarea id="keterangan-input" name="keterangan-input" rows="7" class="form-control resize_vertical" placeholder="Keterangan" maxlength="300">{{ $keterangan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label">File Document</label>
                                            <div class="col-sm-6">
                                                <input id="file-document-input" type="file" class="file" data-show-preview="false" name="file-document-input">
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-document" value="{{$uri_img_document}}" {!! $uri_img_document==null ? 'style="display:none"':'' !!}>{{$uri_img_document}}</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">File Absensi</label>
                                            <div class="col-sm-6">
                                                <input id="file-absensi-input" type="file" class="file" data-show-preview="false" name="file-absensi-input">
                                                <br>
                                                <button type="button" class="btn btn-warning btn-modify" id="uploaded-file-absensi" value="{{$uri_img_absensi}}" {!! $uri_img_absensi==null ? 'style="display:none"':'' !!}>{{$uri_img_absensi}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="tab4" class="tab-pane fade ">
                            <div class="panel " >
                                <div class="panel-body border">
                                    <div class="row">
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diserahkan & Diserahkan Oleh</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="tgl-diser-input" name="tgl-diser-input" placeholder="Tanggal Diserahkan" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diser_tgl}}">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="diser-oleh-input" name="diser-oleh-input" class="form-control" size="1">
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diser_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diketahui & Diketahui Oleh</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="tgl-diket-input" name="tgl-diket-input" placeholder="Tanggal Diketahui" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diket_tgl}}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="diket-oleh-input" name="diket-oleh-input" class="form-control" size="1" required>
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diket_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group striped-col">
                                            <label class="col-sm-3 control-label" for="example-text-input1">Tanggal Diverifikasi & Diverifikasi Oleh</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" id="tgl-diver-input" name="tgl-diver-input" placeholder="Tanggal Diverifikasi" data-provide="datepicker" data-date-format="yyyy-mm-dd" value="{{$diver_tgl}}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="diver-oleh-input" name="diver-oleh-input" class="form-control" size="1" required>
                                                    @foreach ($kode_user_list as $kul)
                                                        <option value="{{$kul->id}}" {!! $diver_oleh==$kul->id ? 'selected':'' !!}>{{$kul->nama_depan}} {{$kul->nama_belakang}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group form-actions">
                            <div class="col-sm-9 col-sm-offset-3">
                                <a href="/main/perencanaan/pengadaan_lelang" type="button" class="btn btn-effect-ripple btn-danger">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>