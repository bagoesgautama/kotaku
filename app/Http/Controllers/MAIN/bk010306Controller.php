<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010306Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==91)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 273);
				return view('MAIN/bk010306/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'tahun',
			1 =>'kode_prop',
			2 =>'kode_kmw',
			3 =>'kode_kota',
			4 =>'kode_korkot',
			5 =>'created_time'
		);
		$query='select a.kode, a.tahun, b.nama as kode_prop, c.nama as kode_kmw, d.nama as kode_kota, e.nama as kode_korkot, a.created_time from bkt_01030203_rp2kp_siap a, bkt_01010101_prop b, bkt_01010110_kmw c, bkt_01010102_kota d, bkt_01010111_korkot e where a.kode_prop=b.kode and a.kode_kmw=c.kode and a.kode_kota=d.kode and a.kode_korkot=e.kode';
		$totalData = DB::select('select count(1) cnt from bkt_01030203_rp2kp_siap a, bkt_01010101_prop b, bkt_01010110_kmw c, bkt_01010102_kota d, bkt_01010111_korkot e where a.kode_prop=b.kode and a.kode_kmw=c.kode and a.kode_kota=d.kode and a.kode_korkot=e.kode');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by a.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and (a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%") ) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/perencanaan/penanganan/profile_rencana_5thn/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/penanganan/profile_rencana_5thn/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_prop'] = $post->kode_prop;
				$nestedData['kode_kmw'] = $post->kode_prop;
				$nestedData['kode_kota'] = $post->kode_prop;
				$nestedData['kode_korkot'] = $post->kode_prop;
				$nestedData['created_time'] =  $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==91)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['275'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['276'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				}
				$nestedData['option'] = $option;
				$data[] = $nestedData;
			}
		}

		$json_data = array(
					"draw"            => intval($request->input('draw')),
					"recordsTotal"    => intval($totalData[0]->cnt),
					"recordsFiltered" => intval($totalFiltered),
					"data"            => $data
					);

		echo json_encode($json_data);
	}

	public function select(Request $request)
	{
		if(!empty($request->input('prop'))){
			$kmw = DB::select('select kode, nama from bkt_01010110_kmw where kode_prop='.$request->input('prop'));
			echo json_encode($kmw);
		}
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kota'))){
			$korkot = DB::select('select a.kode, a.nama from bkt_01010111_korkot a, bkt_01010112_kota_korkot b where b.kode_korkot=a.kode and kode_kota='.$request->input('kota'));
			echo json_encode($korkot);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==91)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['275'])){
				$rowData = DB::select('select * from bkt_01030203_rp2kp_siap where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['pk_val_abs_hunian'] = $rowData[0]->pk_val_abs_hunian;
				$data['pk_prcn_gap_hunian'] = $rowData[0]->pk_prcn_gap_hunian;
				$data['pk_val_abs_jalan'] = $rowData[0]->pk_val_abs_jalan;
				$data['pk_prcn_gap_jalan'] = $rowData[0]->pk_prcn_gap_jalan;
				$data['pk_val_abs_air_minum'] = $rowData[0]->pk_val_abs_air_minum;
				$data['pk_prcn_gap_air_minum'] = $rowData[0]->pk_prcn_gap_air_minum;
				$data['pk_val_abs_drainase'] = $rowData[0]->pk_val_abs_drainase;
				$data['pk_prcn_gap_drainase'] = $rowData[0]->pk_prcn_gap_drainase;
				$data['pk_val_abs_air_limbah'] = $rowData[0]->pk_val_abs_air_limbah;
				$data['pk_prcn_gap_air_limbah'] = $rowData[0]->pk_prcn_gap_air_limbah;
				$data['pk_val_abs_sampah'] = $rowData[0]->pk_val_abs_sampah;
				$data['pk_prcn_gap_sampah'] = $rowData[0]->pk_prcn_gap_sampah;
				$data['pk_val_abs_kebakaran'] = $rowData[0]->pk_val_abs_kebakaran;
				$data['pk_prcn_gap_kebakaran'] = $rowData[0]->pk_prcn_gap_kebakaran;
				$data['pk_val_abs_rtp'] = $rowData[0]->pk_val_abs_rtp;
				$data['pk_prcn_gap_rtp'] = $rowData[0]->pk_prcn_gap_rtp;
				$data['pk_prcn_gap_ekonomi'] = $rowData[0]->pk_prcn_gap_ekonomi;
				$data['pk_prcn_gap_sosial'] = $rowData[0]->pk_prcn_gap_sosial;
				$data['rp5_q_kaw_kmh_manage'] = $rowData[0]->rp5_q_kaw_kmh_manage;
				$data['rp5_l_kaw_kmh_manage'] = $rowData[0]->rp5_l_kaw_kmh_manage;
				$data['rp5_q_kel_kmh'] = $rowData[0]->rp5_q_kel_kmh;
				$data['rp5_q_rt_kmh'] = $rowData[0]->rp5_q_rt_kmh;
				$data['tk_l_kmh_berat'] = $rowData[0]->tk_l_kmh_berat;
				$data['tk_l_kmh_sedang'] = $rowData[0]->tk_l_kmh_sedang;
				$data['tk_l_kmh_ringan'] = $rowData[0]->tk_l_kmh_ringan;
				$data['sl_l_masy_legal'] = $rowData[0]->sl_l_masy_legal;
				$data['sl_l_lhn_legal_tmp_ilegal'] = $rowData[0]->sl_l_lhn_legal_tmp_ilegal;
				$data['sl_l_lhn_ilegal'] = $rowData[0]->sl_l_lhn_ilegal;
				$data['tpk_q_atas_air'] = $rowData[0]->tpk_q_atas_air;
				$data['tpk_q_tepi_air'] = $rowData[0]->tpk_q_tepi_air;
				$data['tpk_q_dataran_rendah'] = $rowData[0]->tpk_q_dataran_rendah;
				$data['tpk_q_dataran_tinggi'] = $rowData[0]->tpk_q_dataran_tinggi;
				$data['tpk_q_rawan_bencana'] = $rowData[0]->tpk_q_rawan_bencana;
				$data['pl_kaw_pst_kota'] = $rowData[0]->pl_kaw_pst_kota;
				$data['pl_kaw_komersil'] = $rowData[0]->pl_kaw_komersil;
				$data['pl_kaw_pmkm_pinggir_kt'] = $rowData[0]->pl_kaw_pmkm_pinggir_kt;
				$data['pl_kaw_semi_pedesaan'] = $rowData[0]->pl_kaw_semi_pedesaan;
				$data['kp_q_kaw_pemugaran'] = $rowData[0]->kp_q_kaw_pemugaran;
				$data['kp_l_kaw_pemugaran'] = $rowData[0]->kp_l_kaw_pemugaran;
				$data['kp_q_jml_pdk_pemugaran'] = $rowData[0]->kp_q_jml_pdk_pemugaran;
				$data['kp_q_jml_kk_pemugaran'] = $rowData[0]->kp_q_jml_kk_pemugaran;
				$data['kp_q_kaw_peremajaan'] = $rowData[0]->kp_q_kaw_peremajaan;
				$data['kp_l_kaw_peremajaan'] = $rowData[0]->kp_l_kaw_peremajaan;
				$data['kp_q_jml_pdk_peremajaan'] = $rowData[0]->kp_q_jml_pdk_peremajaan;
				$data['kp_q_jml_kk_peremajaan'] = $rowData[0]->kp_q_jml_kk_peremajaan;
				$data['kp_q_kaw_pmkm_kmbl'] = $rowData[0]->kp_q_kaw_pmkm_kmbl;
				$data['kp_l_kaw_pmkm_kmbl'] = $rowData[0]->kp_l_kaw_pmkm_kmbl;
				$data['kp_q_jml_pdk_pmkm_kmbl'] = $rowData[0]->kp_q_jml_pdk_pmkm_kmbl;
				$data['kp_q_jml_kk_pmkm_kmbl'] = $rowData[0]->kp_q_jml_kk_pmkm_kmbl;
				$data['kp_q_kaw_relokasi'] = $rowData[0]->kp_q_kaw_relokasi;
				$data['kp_l_kaw_relokasi'] = $rowData[0]->kp_l_kaw_relokasi;
				$data['kp_q_jml_pdk_relokasi'] = $rowData[0]->kp_q_jml_pdk_relokasi;
				$data['kp_q_jml_kk_relokasi'] = $rowData[0]->kp_q_jml_kk_relokasi;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diket_tgl;
				$data['diket_oleh'] = $rowData[0]->diket_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select kode, nama from bkt_01010110_kmw where kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota.' and b.kode_kmw ='.$rowData[0]->kode_kmw);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010306/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['274'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['pk_val_abs_hunian'] = null;
				$data['pk_prcn_gap_hunian'] = null;
				$data['pk_val_abs_jalan'] = null;
				$data['pk_prcn_gap_jalan'] = null;
				$data['pk_val_abs_air_minum'] = null;
				$data['pk_prcn_gap_air_minum'] = null;
				$data['pk_val_abs_drainase'] = null;
				$data['pk_prcn_gap_drainase'] = null;
				$data['pk_val_abs_air_limbah'] = null;
				$data['pk_prcn_gap_air_limbah'] = null;
				$data['pk_val_abs_sampah'] = null;
				$data['pk_prcn_gap_sampah'] = null;
				$data['pk_val_abs_kebakaran'] = null;
				$data['pk_prcn_gap_kebakaran'] = null;
				$data['pk_val_abs_rtp'] = null;
				$data['pk_prcn_gap_rtp'] = null;
				$data['pk_prcn_gap_ekonomi'] = null;
				$data['pk_prcn_gap_sosial'] = null;
				$data['rp5_q_kaw_kmh_manage'] = null;
				$data['rp5_l_kaw_kmh_manage'] = null;
				$data['rp5_q_kel_kmh'] = null;
				$data['rp5_q_rt_kmh'] = null;
				$data['tk_l_kmh_berat'] = null;
				$data['tk_l_kmh_sedang'] = null;
				$data['tk_l_kmh_ringan'] = null;
				$data['sl_l_masy_legal'] = null;
				$data['sl_l_lhn_legal_tmp_ilegal'] = null;
				$data['sl_l_lhn_ilegal'] = null;
				$data['tpk_q_atas_air'] = null;
				$data['tpk_q_tepi_air'] = null;
				$data['tpk_q_dataran_rendah'] = null;
				$data['tpk_q_dataran_tinggi'] = null;
				$data['tpk_q_rawan_bencana'] = null;
				$data['pl_kaw_pst_kota'] = null;
				$data['pl_kaw_komersil'] = null;
				$data['pl_kaw_pmkm_pinggir_kt'] = null;
				$data['pl_kaw_semi_pedesaan'] = null;
				$data['kp_q_kaw_pemugaran'] = null;
				$data['kp_l_kaw_pemugaran'] = null;
				$data['kp_q_jml_pdk_pemugaran'] = null;
				$data['kp_q_jml_kk_pemugaran'] = null;
				$data['kp_q_kaw_peremajaan'] = null;
				$data['kp_l_kaw_peremajaan'] = null;
				$data['kp_q_jml_pdk_peremajaan'] = null;
				$data['kp_q_jml_kk_peremajaan'] = null;
				$data['kp_q_kaw_pmkm_kmbl'] = null;
				$data['kp_l_kaw_pmkm_kmbl'] = null;
				$data['kp_q_jml_pdk_pmkm_kmbl'] = null;
				$data['kp_q_jml_kk_pmkm_kmbl'] = null;
				$data['kp_q_kaw_relokasi'] = null;
				$data['kp_l_kaw_relokasi'] = null;
				$data['kp_q_jml_pdk_relokasi'] = null;
				$data['kp_q_jml_kk_relokasi'] = null;
				$data['uri_img_document'] = null;
				$data['uri_img_absensi'] = null;
				$data['diser_tgl'] = null;
				$data['diser_oleh'] = null;
				$data['diket_tgl'] = null;
				$data['diket_oleh'] = null;
				$data['diver_tgl'] = null;
				$data['diver_oleh'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010306/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_dokumen = $request->file('file-dokumen-input');
		$url_dokumen = null;
		$upload_dokumen = false;
		if($request->input('uploaded-file-dokumen') != null && $file_dokumen == null){
			$url_dokumen = $request->input('uploaded-file-dokumen');
			$upload_dokumen = false;
		}elseif($request->input('uploaded-file-dokumen') != null && $file_dokumen != null){
			$url_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}elseif($request->input('uploaded-file-dokumen') == null && $file_dokumen != null){
			$url_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$url_absensi = null;
		$upload_absensi = false;
		if($request->input('uploaded-file-absensi') != null && $file_absensi == null){
			$url_absensi = $request->input('uploaded-file-absensi');
			$upload_absensi = false;
		}elseif($request->input('uploaded-file-absensi') != null && $file_absensi != null){
			$url_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uploaded-file-absensi') == null && $file_absensi != null){
			$url_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030203_rp2kp_siap')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'pk_val_abs_hunian' => $request->input('pk-val-abs-hunian'),
				'pk_prcn_gap_hunian' => $request->input('pk-prcn-gap-hunian'),
				'pk_val_abs_jalan' => $request->input('pk-val-abs-jalan'),
				'pk_prcn_gap_jalan' => $request->input('pk-prcn-gap-jalan'),
				'pk_val_abs_air_minum' => $request->input('pk-val-abs-air-minum'),
				'pk_prcn_gap_air_minum' => $request->input('pk-prcn-gap-air-minum'),
				'pk_val_abs_drainase' => $request->input('pk-val-abs-drainase'),
				'pk_prcn_gap_drainase' => $request->input('pk-prcn-gap-drainase'),
				'pk_val_abs_air_limbah' => $request->input('pk-val-abs-air-limbah'),
				'pk_prcn_gap_air_limbah' => $request->input('pk-prcn-gap-air-limbah'),
				'pk_val_abs_sampah' => $request->input('pk-val-abs-sampah'),
				'pk_prcn_gap_sampah' => $request->input('pk-prcn-gap-sampah'),
				'pk_val_abs_kebakaran' => $request->input('pk-val-abs-kebakaran'),
				'pk_prcn_gap_kebakaran' => $request->input('pk-prcn-gap-kebakaran'),
				'pk_val_abs_rtp' => $request->input('pk-val-abs-rtp'),
				'pk_prcn_gap_rtp' => $request->input('pk-prcn-gap-rtp'),
				'pk_prcn_gap_ekonomi' => $request->input('pk-prcn-gap-ekonomi'),
				'pk_prcn_gap_sosial' => $request->input('pk-prcn-gap-sosial'),

				'rp5_q_kaw_kmh_manage' => $request->input('rp5_q_kaw_kmh_manage'),
				'rp5_l_kaw_kmh_manage' => $request->input('rp5_l_kaw_kmh_manage'),
				'rp5_q_kel_kmh' => $request->input('rp5_q_kel_kmh'),
				'rp5_q_rt_kmh' => $request->input('rp5_q_rt_kmh'),
				'tk_l_kmh_berat' => $request->input('tk_l_kmh_berat'),
				'tk_l_kmh_sedang' => $request->input('tk_l_kmh_sedang'),
				'tk_l_kmh_ringan' => $request->input('tk_l_kmh_ringan'),
				'sl_l_masy_legal' => $request->input('sl_l_masy_legal'),
				'sl_l_lhn_legal_tmp_ilegal' => $request->input('sl_l_lhn_legal_tmp_ilegal'),
				'sl_l_lhn_ilegal' => $request->input('sl_l_lhn_ilegal'),
				'tpk_q_atas_air' => $request->input('tpk_q_atas_air'),
				'tpk_q_tepi_air' => $request->input('tpk_q_tepi_air'),
				'tpk_q_dataran_rendah' => $request->input('tpk_q_dataran_rendah'),
				'tpk_q_dataran_tinggi' => $request->input('tpk_q_dataran_tinggi'),
				'tpk_q_rawan_bencana' => $request->input('tpk_q_rawan_bencana'),
				'pl_kaw_pst_kota' => $request->input('pl_kaw_pst_kota'),
				'pl_kaw_komersil' => $request->input('pl_kaw_komersil'),
				'pl_kaw_pmkm_pinggir_kt' => $request->input('pl_kaw_pmkm_pinggir_kt'),
				'pl_kaw_semi_pedesaan' => $request->input('pl_kaw_semi_pedesaan'),
				'kp_q_kaw_pemugaran' => $request->input('kp_q_kaw_pemugaran'),
				'kp_l_kaw_pemugaran' => $request->input('kp_l_kaw_pemugaran'),
				'kp_q_jml_pdk_pemugaran' => $request->input('kp_q_jml_pdk_pemugaran'),
				'kp_q_jml_kk_pemugaran' => $request->input('kp_q_jml_kk_pemugaran'),
				'kp_q_kaw_peremajaan' => $request->input('kp_q_kaw_peremajaan'),
				'kp_l_kaw_peremajaan' => $request->input('kp_l_kaw_peremajaan'),
				'kp_q_jml_pdk_peremajaan' => $request->input('kp_q_jml_pdk_peremajaan'),
				'kp_q_jml_kk_peremajaan' => $request->input('kp_q_jml_kk_peremajaan'),
				'kp_q_kaw_pmkm_kmbl' => $request->input('kp_q_kaw_pmkm_kmbl'),
				'kp_l_kaw_pmkm_kmbl' => $request->input('kp_l_kaw_pmkm_kmbl'),
				'kp_q_jml_pdk_pmkm_kmbl' => $request->input('kp_q_jml_pdk_pmkm_kmbl'),
				'kp_q_jml_kk_pmkm_kmbl' => $request->input('kp_q_jml_kk_pmkm_kmbl'),
				'kp_q_kaw_relokasi' => $request->input('kp_q_kaw_relokasi'),
				'kp_l_kaw_relokasi' => $request->input('kp_l_kaw_relokasi'),
				'kp_q_jml_pdk_relokasi' => $request->input('kp_q_jml_pdk_relokasi'),
				'kp_q_jml_kk_relokasi' => $request->input('kp_q_jml_kk_relokasi'),

				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/rencana_penanganan_5_thn'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/rencana_penanganan_5_thn'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 275);

		}else{
			DB::table('bkt_01030203_rp2kp_siap')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'pk_val_abs_hunian' => $request->input('pk-val-abs-hunian'),
				'pk_prcn_gap_hunian' => $request->input('pk-prcn-gap-hunian'),
				'pk_val_abs_jalan' => $request->input('pk-val-abs-jalan'),
				'pk_prcn_gap_jalan' => $request->input('pk-prcn-gap-jalan'),
				'pk_val_abs_air_minum' => $request->input('pk-val-abs-air-minum'),
				'pk_prcn_gap_air_minum' => $request->input('pk-prcn-gap-air-minum'),
				'pk_val_abs_drainase' => $request->input('pk-val-abs-drainase'),
				'pk_prcn_gap_drainase' => $request->input('pk-prcn-gap-drainase'),
				'pk_val_abs_air_limbah' => $request->input('pk-val-abs-air-limbah'),
				'pk_prcn_gap_air_limbah' => $request->input('pk-prcn-gap-air-limbah'),
				'pk_val_abs_sampah' => $request->input('pk-val-abs-sampah'),
				'pk_prcn_gap_sampah' => $request->input('pk-prcn-gap-sampah'),
				'pk_val_abs_kebakaran' => $request->input('pk-val-abs-kebakaran'),
				'pk_prcn_gap_kebakaran' => $request->input('pk-prcn-gap-kebakaran'),
				'pk_val_abs_rtp' => $request->input('pk-val-abs-rtp'),
				'pk_prcn_gap_rtp' => $request->input('pk-prcn-gap-rtp'),
				'pk_prcn_gap_ekonomi' => $request->input('pk-prcn-gap-ekonomi'),
				'pk_prcn_gap_sosial' => $request->input('pk-prcn-gap-sosial'),

				'rp5_q_kaw_kmh_manage' => $request->input('rp5_q_kaw_kmh_manage'),
				'rp5_l_kaw_kmh_manage' => $request->input('rp5_l_kaw_kmh_manage'),
				'rp5_q_kel_kmh' => $request->input('rp5_q_kel_kmh'),
				'rp5_q_rt_kmh' => $request->input('rp5_q_rt_kmh'),
				'tk_l_kmh_berat' => $request->input('tk_l_kmh_berat'),
				'tk_l_kmh_sedang' => $request->input('tk_l_kmh_sedang'),
				'tk_l_kmh_ringan' => $request->input('tk_l_kmh_ringan'),
				'sl_l_masy_legal' => $request->input('sl_l_masy_legal'),
				'sl_l_lhn_legal_tmp_ilegal' => $request->input('sl_l_lhn_legal_tmp_ilegal'),
				'sl_l_lhn_ilegal' => $request->input('sl_l_lhn_ilegal'),
				'tpk_q_atas_air' => $request->input('tpk_q_atas_air'),
				'tpk_q_tepi_air' => $request->input('tpk_q_tepi_air'),
				'tpk_q_dataran_rendah' => $request->input('tpk_q_dataran_rendah'),
				'tpk_q_dataran_tinggi' => $request->input('tpk_q_dataran_tinggi'),
				'tpk_q_rawan_bencana' => $request->input('tpk_q_rawan_bencana'),
				'pl_kaw_pst_kota' => $request->input('pl_kaw_pst_kota'),
				'pl_kaw_komersil' => $request->input('pl_kaw_komersil'),
				'pl_kaw_pmkm_pinggir_kt' => $request->input('pl_kaw_pmkm_pinggir_kt'),
				'pl_kaw_semi_pedesaan' => $request->input('pl_kaw_semi_pedesaan'),
				'kp_q_kaw_pemugaran' => $request->input('kp_q_kaw_pemugaran'),
				'kp_l_kaw_pemugaran' => $request->input('kp_l_kaw_pemugaran'),
				'kp_q_jml_pdk_pemugaran' => $request->input('kp_q_jml_pdk_pemugaran'),
				'kp_q_jml_kk_pemugaran' => $request->input('kp_q_jml_kk_pemugaran'),
				'kp_q_kaw_peremajaan' => $request->input('kp_q_kaw_peremajaan'),
				'kp_l_kaw_peremajaan' => $request->input('kp_l_kaw_peremajaan'),
				'kp_q_jml_pdk_peremajaan' => $request->input('kp_q_jml_pdk_peremajaan'),
				'kp_q_jml_kk_peremajaan' => $request->input('kp_q_jml_kk_peremajaan'),
				'kp_q_kaw_pmkm_kmbl' => $request->input('kp_q_kaw_pmkm_kmbl'),
				'kp_l_kaw_pmkm_kmbl' => $request->input('kp_l_kaw_pmkm_kmbl'),
				'kp_q_jml_pdk_pmkm_kmbl' => $request->input('kp_q_jml_pdk_pmkm_kmbl'),
				'kp_q_jml_kk_pmkm_kmbl' => $request->input('kp_q_jml_kk_pmkm_kmbl'),
				'kp_q_kaw_relokasi' => $request->input('kp_q_kaw_relokasi'),
				'kp_l_kaw_relokasi' => $request->input('kp_l_kaw_relokasi'),
				'kp_q_jml_pdk_relokasi' => $request->input('kp_q_jml_pdk_relokasi'),
				'kp_q_jml_kk_relokasi' => $request->input('kp_q_jml_kk_relokasi'),

				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/rencana_penanganan_5_thn'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/rencana_penanganan_5_thn'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 274);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030203_rp2kp_siap')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 276);
        return Redirect::to('/main/perencanaan/penanganan/profile_rencana_5thn');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 91,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
