<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010309Controller extends Controller
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
				if($item->kode_menu==97)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 289);
				return view('MAIN/bk010309/index',$data);
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
			1 => 'kode_prop',
			2 => 'kode_kota',
			3 => 'kode_korkot',
			4 => 'kode_kec',
			5 => 'kode_kawasan',
			6 => 'tipologi_pmkm',
			7 => 'karakter_kaw',
			8 => 'pola_penanganan',
			9 => 'status_lahan',
			10 => 'status_hunian',
			11 => 'kepadatan_bangunan',
			12 => 'pdk_q_jiwa',
			13 => 'pdk_q_jiwa_w',
			14 => 'pdk_q_mbr',
			15 => 'pdk_q_kk',
			16 => 'pdk_q_kk_miskin',
			17 => 'pdk_kpdt_pddk',
			18 => 'pk_l_kaw_kmh',
			19 => 'pk_q_kel_kmh_thn_cur',
			20 => 'pk_q_rt_kmh_thn_cur',
			21 => 'pk_l_rt_kmh_thn_cur',
			22 => 'tk_berat_l_wil',
			23 => 'tk_berat_q_rt',
			24 => 'tk_sedang_l_wil',
			25 => 'tk_sedang_q_rt',
			26 => 'tk_ringan_l_wil',
			27 => 'tk_ringan_q_rt',
			28 => 'ak_val_abs_hunian',
			29 => 'ak_prcn_gap_hunian',
			30 => 'ak_val_abs_jalan',
			31 => 'ak_prcn_gap_jalan',
			32 => 'ak_val_abs_air_minum',
			33 => 'ak_prcn_gap_air_minum',
			34 => 'ak_val_abs_drainase',
			35 => 'ak_prcn_gap_drainase',
			36 => 'ak_val_abs_air_limbah',
			37 => 'ak_prcn_gap_air_limbah',
			38 => 'ak_val_abs_sampah',
			39 => 'ak_prcn_gap_sampah',
			40 => 'ak_val_abs_kebakaran',
			41 => 'ak_prcn_gap_kebakaran',
			42 => 'ak_val_abs_rtp',
			43 => 'ak_prcn_gap_rtp',
			44 => 'ak_prcn_gap_ekonomi',
			45 => 'ak_prcn_gap_sosial',
			46 => 'uri_img_document',
			47 => 'uri_img_absensi',
			48 => 'diser_tgl',
			49 => 'diser_oleh',
			50 => 'diket_tgl',
			51 => 'diket_oleh',
			52 => 'diver_tgl',
			53 => 'diver_oleh',
			54 => 'created_time',
			55 => 'created_by',
			56 => 'updated_time',
			57 => 'updated_by'
		);
		$query='select a.*, b.nama nama_prop, c.nama nama_kota, d.nama nama_korkot, e.nama nama_kec
			 from bkt_01030206_plan_kaw_prior a, 
			 	bkt_01010101_prop b, 
			 	bkt_01010102_kota c, 
			 	bkt_01010111_korkot d, 
			 	bkt_01010103_kec e 
			 where (a.kode_prop=b.kode and a.kode_kota=c.kode and a.kode_korkot=d.kode and a.kode_kec=e.kode) ';
			 
		$totalData = DB::select('select count(1) cnt from bkt_01030206_plan_kaw_prior ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/perencanaan/kawasan/perencanaan/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kawasan/perencanaan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_prop'] = $post->nama_prop;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['kode_kawasan'] = $post->kode_kawasan;
				$nestedData['tipologi_pmkm'] = $post->topologi_pmkm;
				$nestedData['karakter_kaw'] = $post->karakter_kaw;
				$nestedData['pola_penanganan'] = $post->pola_penanganan;
				$nestedData['status_lahan'] = $post->status_lahan;
				$nestedData['status_hunian'] = $post->status_hunian;
				$nestedData['kepadatan_bangunan'] = $post->kepadatan_bangunan;
				$nestedData['pdk_q_jiwa'] = $post->pdk_q_jiwa;
				$nestedData['pdk_q_jiwa_w'] = $post->pdk_q_jiwa_w;
				$nestedData['pdk_q_mbr'] = $post->pdk_q_mbr;
				$nestedData['pdk_q_kk'] = $post->pdk_q_kk;
				$nestedData['pdk_q_kk_miskin'] = $post->pdk_q_kk_miskin;
				$nestedData['pdk_kpdt_pddk'] = $post->pdk_kpdt_pddk;
				$nestedData['pk_l_kaw_kmh'] = $post->pk_l_kaw_kmh;
				$nestedData['pk_q_kel_kmh_thn_cur'] = $post->pk_q_kel_kmh_thn_cur;
				$nestedData['pk_q_rt_kmh_thn_cur'] = $post->pk_q_rt_kmh_thn_cur;
				$nestedData['pk_l_rt_kmh_thn_cur'] = $post->pk_l_rt_kmh_thn_cur;
				$nestedData['tk_berat_l_wil'] = $post->tk_berat_q_wil;
				$nestedData['tk_berat_q_rt'] = $post->tk_berat_q_rt;
				$nestedData['tk_sedang_l_wil'] = $post->tk_sedang_l_wil;
				$nestedData['tk_sedang_q_rt'] = $post->tk_sedang_q_rt;
				$nestedData['tk_ringan_l_wil'] = $post->tk_ringan_l_wil;
				$nestedData['tk_ringan_q_rt'] = $post->tk_ringan_q_rt;
				$nestedData['ak_val_abs_hunian'] = $post->ak_val_abs_hunian;
				$nestedData['ak_prcn_gap_hunian'] = $post->ak_prcn_gap_hunian;
				$nestedData['ak_val_abs_jalan'] = $post->ak_val_abs_jalan;
				$nestedData['ak_prcn_gap_jalan'] = $post->ak_prcn_gap_jalan;
				$nestedData['ak_val_abs_air_minum'] = $post->ak_val_abs_air_minum;
				$nestedData['ak_prcn_gap_air_minum'] = $post->ak_prcn_gap_air_minum;
				$nestedData['ak_val_abs_drainase'] = $post->ak_val_abs_drainase;
				$nestedData['ak_prcn_gap_drainase'] = $post->ak_prcn_gap_drainase;
				$nestedData['ak_val_abs_air_limbah'] = $post->ak_val_abs_air_limbah;
				$nestedData['ak_prcn_gap_air_limbah'] = $post->ak_prcn_gap_air_limbah;
				$nestedData['ak_val_abs_sampah'] = $post->ak_val_abs_sampah;
				$nestedData['ak_prcn_gap_sampah'] = $post->ak_prcn_gap_sampah;
				$nestedData['ak_val_abs_kebakaran'] = $post->ak_val_abs_kebakaran;
				$nestedData['ak_prcn_gap_kebakaran'] = $post->ak_prcn_gap_kebakaran;
				$nestedData['ak_val_abs_rtp'] = $post->ak_val_abs_rtp;
				$nestedData['ak_prcn_gap_rtp'] = $post->ak_prcn_gap_rtp;
				$nestedData['ak_prcn_gap_ekonomi'] = $post->ak_prcn_gap_ekonomi;
				$nestedData['ak_prcn_gap_sosial'] = $post->ak_prcn_gap_sosial;
				$nestedData['uri_img_document'] = $post->uri_img_document;
				$nestedData['uri_img_absensi'] = $post->uri_img_absensi;
				$nestedData['diser_tgl'] = $post->diser_tgl;
				$nestedData['diser_oleh'] = $post->diser_oleh;
				$nestedData['diket_tgl'] = $post->diket_tgl;
				$nestedData['diket_oleh'] = $post->diket_oleh;
				$nestedData['diver_tgl'] = $post->diver_tgl;
				$nestedData['diver_oleh'] = $post->diver_oleh;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==97)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['62'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['63'])){
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
			$kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prop'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kota'))){
			$kota = DB::select('select b.* from bkt_01010112_kota_korkot a,bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('korkot'))){
			$kota = DB::select('select a.* from bkt_01010103_kec a where a.kode_kota='.$request->input('korkot'));
			echo json_encode($kota);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==97)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
			$data['kode_prop_list'] = $kode_prop;

			$id_kawasan = DB::select('select id, nama from bkt_01010123_kawasan');
			$data['id_kawasan_list'] = $id_kawasan;

			if($data['kode']!=null  && !empty($data['detil']['291'])){
				$rowData = DB::select('select * from bkt_01030206_plan_kaw_prior where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan;
				$data['tipologi_pmkm'] = $rowData[0]->tipologi_pmkm;
				$data['karakter_kaw'] = $rowData[0]->karakter_kaw;
				$data['pola_penanganan'] = $rowData[0]->pola_penanganan;
				$data['status_lahan'] = $rowData[0]->status_lahan;
				$data['status_hunian'] = $rowData[0]->status_hunian;
				$data['kepadatan_bangunan'] = $rowData[0]->kepadatan_bangunan;
				$data['pdk_q_jiwa'] = $rowData[0]->pdk_q_jiwa;
				$data['pdk_q_jiwa_w'] = $rowData[0]->pdk_q_jiwa_w;
				$data['pdk_q_mbr'] = $rowData[0]->pdk_q_mbr;
				$data['pdk_q_kk'] = $rowData[0]->pdk_q_kk;
				$data['pdk_q_kk_miskin'] = $rowData[0]->pdk_q_kk_miskin;
				$data['pdk_kpdt_pddk'] = $rowData[0]->pdk_kpdt_pddk;
				$data['pk_l_kaw_kmh'] = $rowData[0]->pk_l_kaw_kmh;
				$data['pk_q_kel_kmh_thn_cur'] = $rowData[0]->pk_q_kel_kmh_thn_cur;
				$data['pk_q_rt_kmh_thn_cur'] = $rowData[0]->pk_q_rt_kmh_thn_cur;
				$data['pk_l_rt_kmh_thn_cur'] = $rowData[0]->pk_l_rt_kmh_thn_cur;
				$data['tk_berat_l_wil'] = $rowData[0]->tk_berat_l_wil;
				$data['tk_berat_q_rt'] = $rowData[0]->tk_berat_q_rt;
				$data['tk_sedang_l_wil'] = $rowData[0]->tk_sedang_l_wil;
				$data['tk_sedang_q_rt'] = $rowData[0]->tk_sedang_q_rt;
				$data['tk_ringan_l_wil'] = $rowData[0]->tk_ringan_l_wil;
				$data['tk_ringan_q_rt'] = $rowData[0]->tk_ringan_q_rt;
				$data['ak_val_abs_hunian'] = $rowData[0]->ak_val_abs_hunian;
				$data['ak_prcn_gap_hunian'] = $rowData[0]->ak_prcn_gap_hunian;
				$data['ak_val_abs_jalan'] = $rowData[0]->ak_val_abs_jalan;
				$data['ak_prcn_gap_jalan'] = $rowData[0]->ak_prcn_gap_jalan;
				$data['ak_val_abs_air_minum'] = $rowData[0]->ak_val_abs_air_minum;
				$data['ak_prcn_gap_air_minum'] = $rowData[0]->ak_prcn_gap_air_minum;
				$data['ak_val_abs_drainase'] = $rowData[0]->ak_val_abs_drainase;
				$data['ak_prcn_gap_drainase'] = $rowData[0]->ak_prcn_gap_drainase;
				$data['ak_val_abs_air_limbah'] = $rowData[0]->ak_val_abs_air_limbah;
				$data['ak_prcn_gap_air_limbah'] = $rowData[0]->ak_prcn_gap_air_limbah;
				$data['ak_val_abs_sampah'] = $rowData[0]->ak_val_abs_sampah;
				$data['ak_prcn_gap_sampah'] = $rowData[0]->ak_prcn_gap_sampah;
				$data['ak_val_abs_kebakaran'] = $rowData[0]->ak_val_abs_kebakaran;
				$data['ak_prcn_gap_kebakaran'] = $rowData[0]->ak_prcn_gap_kebakaran;
				$data['ak_val_abs_rtp'] = $rowData[0]->ak_val_abs_rtp;
				$data['ak_prcn_gap_rtp'] = $rowData[0]->ak_prcn_gap_rtp;
				$data['ak_prcn_gap_ekonomi'] = $rowData[0]->ak_prcn_gap_ekonomi;
				$data['ak_prcn_gap_sosial'] = $rowData[0]->ak_prcn_gap_sosial;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010309/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['290'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kawasan'] = null;
				$data['tipologi_pmkm'] = null;
				$data['karakter_kaw'] = null;
				$data['pola_penanganan'] = null;
				$data['status_lahan'] = null;
				$data['status_hunian'] = null;
				$data['kepadatan_bangunan'] = null;
				$data['pdk_q_jiwa'] = null;
				$data['pdk_q_jiwa_w'] = null;
				$data['pdk_q_mbr'] = null;
				$data['pdk_q_kk'] = null;
				$data['pdk_q_kk_miskin'] = null;
				$data['pdk_kpdt_pddk'] = null;
				$data['pk_l_kaw_kmh'] = null;
				$data['pk_q_kel_kmh_thn_cur'] = null;
				$data['pk_q_rt_kmh_thn_cur'] = null;
				$data['pk_l_rt_kmh_thn_cur'] = null;
				$data['tk_berat_l_wil'] = null;
				$data['tk_berat_q_rt'] = null;
				$data['tk_sedang_l_wil'] = null;
				$data['tk_sedang_q_rt'] = null;
				$data['tk_ringan_l_wil'] = null;
				$data['tk_ringan_q_rt'] = null;
				$data['ak_val_abs_hunian'] = null;
				$data['ak_prcn_gap_hunian'] = null;
				$data['ak_val_abs_jalan'] = null;
				$data['ak_prcn_gap_jalan'] = null;
				$data['ak_val_abs_air_minum'] = null;
				$data['ak_prcn_gap_air_minum'] = null;
				$data['ak_val_abs_drainase'] = null;
				$data['ak_prcn_gap_drainase'] = null;
				$data['ak_val_abs_air_limbah'] = null;
				$data['ak_prcn_gap_air_limbah'] = null;
				$data['ak_val_abs_sampah'] = null;
				$data['ak_prcn_gap_sampah'] = null;
				$data['ak_val_abs_kebakaran'] = null;
				$data['ak_prcn_gap_kebakaran'] = null;
				$data['ak_val_abs_rtp'] = null;
				$data['ak_prcn_gap_rtp'] = null;
				$data['ak_prcn_gap_ekonomi'] = null;
				$data['ak_prcn_gap_sosial'] = null;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010309/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030206_plan_kaw_prior')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('select-kode_prop-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'tipologi_pmkm' => $request->input('tipologi_pmkm-input'),
				'karakter_kaw' => $request->input('karakter_kaw-input'),
				'pola_penanganan' => $request->input('pola_penanganan-input'),
				'status_lahan' => $request->input('status_lahan-input'),
				'status_hunian' => $request->input('status_hunian-input'),
				'kepadatan_bangunan' => $request->input('kepadatan_bangunan-input'),
				'pdk_q_jiwa' => $request->input('pdk_q_jiwa-input'),
				'pdk_q_jiwa_w' => $request->input('pdk_q_jiwa_w-input'),
				'pdk_q_mbr' => $request->input('pdk_q_mbr-input'),
				'pdk_q_kk' => $request->input('pdk_q_kk-input'),
				'pdk_q_kk_miskin' => $request->input('pdk_q_kk_miskin-input'),
				'pdk_kpdt_pddk' => $request->input('pdk_kpdt_pddk-input'),
				'pk_l_kaw_kmh' => $request->input('pk_l_kaw_kmh-input'),
				'pk_q_kel_kmh_thn_cur' => $request->input('pk_q_kel_kmh_thn_cur-input'),
				'pk_q_rt_kmh_thn_cur' => $request->input('pk_q_rt_kmh_thn_cur-input'),
				'pk_l_rt_kmh_thn_cur' => $request->input('pk_l_rt_kmh_thn_cur-input'),
				'tk_berat_l_wil' => $request->input('tk_berat_l_wil-input'),
				'tk_berat_q_rt' => $request->input('tk_berat_q_rt-input'),
				'tk_sedang_l_wil' => $request->input('tk_sedang_l_wil-input'),
				'tk_sedang_q_rt' => $request->input('tk_sedang_q_rt-input'),
				'tk_ringan_l_wil' => $request->input('tk_ringan_l_wil-input'),
				'tk_ringan_q_rt' => $request->input('tk_ringan_q_rt-input'),
				'ak_val_abs_hunian' => $request->input('ak_val_abs_hunian-input'),
				'ak_prcn_gap_hunian' => $request->input('ak_prcn_gap_hunian-input'),
				'ak_val_abs_jalan' => $request->input('ak_val_abs_jalan-input'),
				'ak_prcn_gap_jalan' => $request->input('ak_prcn_gap_jalan-input'),
				'ak_val_abs_air_minum' => $request->input('ak_val_abs_air_minum-input'),
				'ak_prcn_gap_air_minum' => $request->input('ak_prcn_gap_air_minum-input'),
				'ak_val_abs_drainase' => $request->input('ak_val_abs_drainase-input'),
				'ak_prcn_gap_drainase' => $request->input('ak_prcn_gap_drainase-input'),
				'ak_val_abs_air_limbah' => $request->input('ak_val_abs_air_limbah-input'),
				'ak_prcn_gap_air_limbah' => $request->input('ak_prcn_gap_air_limbah-input'),
				'ak_val_abs_sampah' => $request->input('ak_val_abs_sampah-input'),
				'ak_prcn_gap_sampah' => $request->input('ak_prcn_gap_sampah-input'),
				'ak_val_abs_kebakaran' => $request->input('ak_val_abs_kebakaran-input'),
				'ak_prcn_gap_kebakaran' => $request->input('ak_prcn_gap_kebakaran-input'),
				'ak_val_abs_rtp' => $request->input('ak_val_abs_rtp-input'),
				'ak_prcn_gap_rtp' => $request->input('ak_prcn_gap_rtp-input'),
				'ak_prcn_gap_ekonomi' => $request->input('ak_prcn_gap_ekonomi-input'),
				'ak_prcn_gap_sosial' => $request->input('ak_prcn_gap_sosial-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 291);

		}else{
			DB::table('bkt_01030206_plan_kaw_prior')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('select-kode_prop-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'tipologi_pmkm' => $request->input('tipologi_pmkm-input'),
				'karakter_kaw' => $request->input('karakter_kaw-input'),
				'pola_penanganan' => $request->input('pola_penanganan-input'),
				'status_lahan' => $request->input('status_lahan-input'),
				'status_hunian' => $request->input('status_hunian-input'),
				'kepadatan_bangunan' => $request->input('kepadatan_bangunan-input'),
				'pdk_q_jiwa' => $request->input('pdk_q_jiwa-input'),
				'pdk_q_jiwa_w' => $request->input('pdk_q_jiwa_w-input'),
				'pdk_q_mbr' => $request->input('pdk_q_mbr-input'),
				'pdk_q_kk' => $request->input('pdk_q_kk-input'),
				'pdk_q_kk_miskin' => $request->input('pdk_q_kk_miskin-input'),
				'pdk_kpdt_pddk' => $request->input('pdk_kpdt_pddk-input'),
				'pk_l_kaw_kmh' => $request->input('pk_l_kaw_kmh-input'),
				'pk_q_kel_kmh_thn_cur' => $request->input('pk_q_kel_kmh_thn_cur-input'),
				'pk_q_rt_kmh_thn_cur' => $request->input('pk_q_rt_kmh_thn_cur-input'),
				'pk_l_rt_kmh_thn_cur' => $request->input('pk_l_rt_kmh_thn_cur-input'),
				'tk_berat_l_wil' => $request->input('tk_berat_l_wil-input'),
				'tk_berat_q_rt' => $request->input('tk_berat_q_rt-input'),
				'tk_sedang_l_wil' => $request->input('tk_sedang_l_wil-input'),
				'tk_sedang_q_rt' => $request->input('tk_sedang_q_rt-input'),
				'tk_ringan_l_wil' => $request->input('tk_ringan_l_wil-input'),
				'tk_ringan_q_rt' => $request->input('tk_ringan_q_rt-input'),
				'ak_val_abs_hunian' => $request->input('ak_val_abs_hunian-input'),
				'ak_prcn_gap_hunian' => $request->input('ak_prcn_gap_hunian-input'),
				'ak_val_abs_jalan' => $request->input('ak_val_abs_jalan-input'),
				'ak_prcn_gap_jalan' => $request->input('ak_prcn_gap_jalan-input'),
				'ak_val_abs_air_minum' => $request->input('ak_val_abs_air_minum-input'),
				'ak_prcn_gap_air_minum' => $request->input('ak_prcn_gap_air_minum-input'),
				'ak_val_abs_drainase' => $request->input('ak_val_abs_drainase-input'),
				'ak_prcn_gap_drainase' => $request->input('ak_prcn_gap_drainase-input'),
				'ak_val_abs_air_limbah' => $request->input('ak_val_abs_air_limbah-input'),
				'ak_prcn_gap_air_limbah' => $request->input('ak_prcn_gap_air_limbah-input'),
				'ak_val_abs_sampah' => $request->input('ak_val_abs_sampah-input'),
				'ak_prcn_gap_sampah' => $request->input('ak_prcn_gap_sampah-input'),
				'ak_val_abs_kebakaran' => $request->input('ak_val_abs_kebakaran-input'),
				'ak_prcn_gap_kebakaran' => $request->input('ak_prcn_gap_kebakaran-input'),
				'ak_val_abs_rtp' => $request->input('ak_val_abs_rtp-input'),
				'ak_prcn_gap_rtp' => $request->input('ak_prcn_gap_rtp-input'),
				'ak_prcn_gap_ekonomi' => $request->input('ak_prcn_gap_ekonomi-input'),
				'ak_prcn_gap_sosial' => $request->input('ak_prcn_gap_sosial-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 290);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030206_plan_kaw_prior')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 292);
        return Redirect::to('/main/perencanaan/kawasan/perencanaan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 97,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
