<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010305Controller extends Controller
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
				if($item->kode_menu==86)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 269);
				return view('MAIN/bk010305/index',$data);
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
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_kota',
			3 =>'lpp_sk_kmh',
			4 =>'lpp_l_kmh_sk',
			5 =>'lpp_l_kmh_ver',
			6 =>'rp2kp_stat_dok',
			7 =>'rp2kp_ds_hukum',
			8 =>'pkkl_q_kel_kmh_thn_curr',
			9 =>'tk_berat_l_wil',
			10 =>'tk_sedang_l_wil',
			11 =>'tk_ringan_l_wil',
			12 =>'tk_berat_q_rt',
			13 =>'tk_sedang_q_rt',
			14 =>'tk_ringan_q_rt'
		);
		$query='
			select * from (select 
				a.*,
				a.kode kode_pfl, 
				a.tahun tahun_pfl, 
				case when a.rp2kp_stat_dok="0" then "Proses Awal" when a.rp2kp_stat_dok="1" then "Review" when a.rp2kp_stat_dok="2" then "Final" when a.rp2kp_stat_dok="3" then "Disahkan" end status_dok_convert,
				b.nama as nama_prop,  
				c.nama as nama_kota, 
				d.nama as nama_korkot
			from bkt_01030202_pfl_pmkm_kt a
				left join bkt_01010101_prop b on a.kode_prop=b.kode
				left join bkt_01010102_kota c on a.kode_kota=c.kode
				left join bkt_01010111_korkot d on a.kode_korkot=d.kode) b';
		$totalData = DB::select('select count(1) cnt from bkt_01030202_pfl_pmkm_kt a
				left join bkt_01010101_prop b on a.kode_prop=b.kode
				left join bkt_01010102_kota c on a.kode_kota=c.kode
				left join bkt_01010111_korkot d on a.kode_korkot=d.kode');
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
			$posts=DB::select($query. ' where (
				b.kode_pfl like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.status_dok_convert like "%'.$search.'%" or 
				b.tahun_pfl like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_pfl like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.status_dok_convert like "%'.$search.'%" or 
				b.tahun_pfl like "%'.$search.'%")) a');
			$totalFiltered = $totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				//show
				$url_show=url('/')."/main/perencanaan/penanganan/lokasi_profile/show?kode=".$edit;
				$url_edit=url('/')."/main/perencanaan/penanganan/lokasi_profile/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/penanganan/lokasi_profile/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_pfl;
				$nestedData['tahun'] = $post->tahun_pfl;
				$nestedData['kode_prop'] = $post->nama_prop;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['lpp_sk_kmh'] =  $post->lpp_sk_kmh;
				$nestedData['lpp_l_kmh_sk'] =  $post->lpp_l_kmh_sk;
				$nestedData['lpp_l_kmh_ver'] =  $post->lpp_l_kmh_ver;
				$nestedData['rp2kp_stat_dok'] =  $post->status_dok_convert;
				$nestedData['rp2kp_ds_hukum'] =  $post->rp2kp_ds_hukum;
				$nestedData['pkkl_q_kel_kmh_thn_curr'] =  $post->pkkl_q_kel_kmh_thn_curr;
				$nestedData['tk_berat_l_wil'] =  $post->tk_berat_l_wil;
				$nestedData['tk_sedang_l_wil'] =  $post->tk_sedang_l_wil;
				$nestedData['tk_ringan_l_wil'] =  $post->tk_ringan_l_wil;
				$nestedData['tk_berat_q_rt'] =  $post->tk_berat_q_rt;
				$nestedData['tk_sedang_q_rt'] =  $post->tk_sedang_q_rt;
				$nestedData['tk_ringan_q_rt'] =  $post->tk_ringan_q_rt;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==86)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				//show
				if(!empty($detil['269'])){
					$option .= "<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['271'])){
					$option .= "<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['272'])){
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
		// if(!empty($request->input('kota'))){
		// 	$korkot = DB::select('select a.kode, a.nama from bkt_01010111_korkot a, bkt_01010112_kota_korkot b where b.kode_korkot=a.kode and kode_kota='.$request->input('kota'));
		// 	echo json_encode($korkot);
		// }
		if(!empty($request->input('kota'))){
			$korkot = DB::select('select 
				sum(a.klk_q_peningkatan) kmh, 
				sum(a.klk_q_pencegahan) non_kmh 
			from bkt_01030214_plan_kel a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota
			where 
				b.kode='.$request->input('kota'));
			echo json_encode($korkot);
		}
	}

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==86)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null  && !empty($data['detil']['269'])){
				$rowData = DB::select('select * from bkt_01030202_pfl_pmkm_kt where kode='.$data['kode']);
				$data['detil_menu']='269';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['lpp_sk_kmh'] = $rowData[0]->lpp_sk_kmh;
				$data['lpp_l_kmh_sk'] = $rowData[0]->lpp_l_kmh_sk;
				$data['lpp_l_kmh_ver'] = $rowData[0]->lpp_l_kmh_ver;
				$data['prof_pmkm_kota'] = $rowData[0]->prof_pmkm_kota;
				$data['rp2kp_stat_dok'] = $rowData[0]->rp2kp_stat_dok;
				$data['rp2kp_ds_hukum'] = $rowData[0]->rp2kp_ds_hukum;
				$data['rp2kp_q_dkel_kmh'] = $rowData[0]->rp2kp_q_dkel_kmh;
				$data['rp2kp_q_dkel_non_kmh'] = $rowData[0]->rp2kp_q_dkel_non_kmh;
				$data['pkkl_q_kel_kmh_thn_curr'] = $rowData[0]->pkkl_q_kel_kmh_thn_curr;
				$data['pkkl_q_rt_kmh_thn_curr'] = $rowData[0]->pkkl_q_rt_kmh_thn_curr;
				$data['pkkl_l_rt_kmh_thn_curr'] = $rowData[0]->pkkl_l_rt_kmh_thn_curr;
				$data['pkkp_q_pddk'] = $rowData[0]->pkkp_q_pddk;
				$data['pkkp_q_pddk_w'] = $rowData[0]->pkkp_q_pddk_w;
				$data['pkkp_q_pddk_mbr'] = $rowData[0]->pkkp_q_pddk_mbr;
				$data['pkkp_q_kk_miskin'] = $rowData[0]->pkkp_q_kk_miskin;
				$data['pkkp_kpdt_pddk'] = $rowData[0]->pkkp_kpdt_pddk;
				$data['tk_non_kmh_l_wil'] = $rowData[0]->tk_non_kmh_l_wil;
				$data['tk_non_kmh_q_rt'] = $rowData[0]->tk_non_kmh_q_rt;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select a.kode, a.nama from bkt_01010111_korkot a, bkt_01010112_kota_korkot b where b.kode_korkot=a.kode and kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$rowData[0]->kode_prop);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010305/create',$data);
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==86)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if ($data['kode']!=null  && !empty($data['detil']['271'])){
				$rowData = DB::select('select * from bkt_01030202_pfl_pmkm_kt where kode='.$data['kode']);
				$data['detil_menu']='271';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['lpp_sk_kmh'] = $rowData[0]->lpp_sk_kmh;
				$data['lpp_l_kmh_sk'] = $rowData[0]->lpp_l_kmh_sk;
				$data['lpp_l_kmh_ver'] = $rowData[0]->lpp_l_kmh_ver;
				$data['prof_pmkm_kota'] = $rowData[0]->prof_pmkm_kota;
				$data['rp2kp_stat_dok'] = $rowData[0]->rp2kp_stat_dok;
				$data['rp2kp_ds_hukum'] = $rowData[0]->rp2kp_ds_hukum;
				$data['rp2kp_q_dkel_kmh'] = $rowData[0]->rp2kp_q_dkel_kmh;
				$data['rp2kp_q_dkel_non_kmh'] = $rowData[0]->rp2kp_q_dkel_non_kmh;
				$data['pkkl_q_kel_kmh_thn_curr'] = $rowData[0]->pkkl_q_kel_kmh_thn_curr;
				$data['pkkl_q_rt_kmh_thn_curr'] = $rowData[0]->pkkl_q_rt_kmh_thn_curr;
				$data['pkkl_l_rt_kmh_thn_curr'] = $rowData[0]->pkkl_l_rt_kmh_thn_curr;
				$data['pkkp_q_pddk'] = $rowData[0]->pkkp_q_pddk;
				$data['pkkp_q_pddk_w'] = $rowData[0]->pkkp_q_pddk_w;
				$data['pkkp_q_pddk_mbr'] = $rowData[0]->pkkp_q_pddk_mbr;
				$data['pkkp_q_kk_miskin'] = $rowData[0]->pkkp_q_kk_miskin;
				$data['pkkp_kpdt_pddk'] = $rowData[0]->pkkp_kpdt_pddk;
				$data['tk_non_kmh_l_wil'] = $rowData[0]->tk_non_kmh_l_wil;
				$data['tk_non_kmh_q_rt'] = $rowData[0]->tk_non_kmh_q_rt;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select a.kode, a.nama from bkt_01010111_korkot a, bkt_01010112_kota_korkot b where b.kode_korkot=a.kode and kode_kota='.$rowData[0]->kode_kota);
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010305/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['270'])){
				$data['detil_menu']='270';
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['lpp_sk_kmh'] = null;
				$data['lpp_l_kmh_sk'] = null;
				$data['lpp_l_kmh_ver'] = null;
				$data['prof_pmkm_kota'] = null;
				$data['rp2kp_stat_dok'] = null;
				$data['rp2kp_ds_hukum'] = null;
				$data['rp2kp_q_dkel_kmh'] = null;
				$data['rp2kp_q_dkel_non_kmh'] = null;
				$data['pkkl_q_kel_kmh_thn_curr'] = null;
				$data['pkkl_q_rt_kmh_thn_curr'] = null;
				$data['pkkl_l_rt_kmh_thn_curr'] = null;
				$data['pkkp_q_pddk'] = null;
				$data['pkkp_q_pddk_w'] = null;
				$data['pkkp_q_pddk_mbr'] = null;
				$data['pkkp_q_kk_miskin'] = null;
				$data['pkkp_kpdt_pddk'] = null;
				$data['tk_non_kmh_l_wil'] = null;
				$data['tk_non_kmh_q_rt'] = null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_korkot_list'] = null;
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010305/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();
		$file_document = $request->file('uri_img_document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uri_img_document-file') != null && $file_document == null){
			$uri_document = $request->input('uri_img_document-file');
			$upload_document = false;
		}elseif($request->input('uri_img_document-file') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uri_img_document-file') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('uri_img_absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uri_img_absensi-file') != null && $file_absensi == null){
			$uri_absensi = $request->input('uri_img_absensi-file');
			$upload_absensi = false;
		}elseif($request->input('uri_img_absensi-file') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uri_img_absensi-file') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		//kalau tidak punya korkot && punya wk_kd_kota
		if($user->wk_kd_kota != null){
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$user->wk_kd_kota);
		}else{
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$request->input('kode-kota-input'));
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030202_pfl_pmkm_kt')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $user->wk_kd_prop,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'lpp_sk_kmh' => $request->input('lpp-sk-kmh'),
				'lpp_l_kmh_sk' => $request->input('lpp-l-kmh-sk'),
				'lpp_l_kmh_ver' => $request->input('lpp-l-kmh-ver'),
				'prof_pmkm_kota' => intval($request->input('prof-pmkm-kota')),
				'rp2kp_stat_dok' => $request->input('rp2kp-stat-dok'),
				'rp2kp_ds_hukum' => $request->input('rp2kp-ds-hukum'),
				'rp2kp_q_dkel_kmh' => $request->input('rp2kp-q-dkel-kmh'),
				'rp2kp_q_dkel_non_kmh' => $request->input('rp2kp-q-dkel-non-kmh'),
				'pkkl_q_kel_kmh_thn_curr' => $request->input('pkkl-q-kel-kmh-thn-curr'),
				'pkkl_q_rt_kmh_thn_curr' => $request->input('pkkl-q-rt-kmh-thn-curr'),
				'pkkl_l_rt_kmh_thn_curr' => $request->input('pkkl-l-rt-kmh-thn-curr'),
				'pkkp_q_pddk' => $request->input('pkkp-q-pddk'),
				'pkkp_q_pddk_w' => $request->input('pkkp-q-pddk-w'),
				'pkkp_q_pddk_mbr' => $request->input('pkkp-q-pddk-mbr'),
				'pkkp_q_kk_miskin' => $request->input('pkkp-q-kk-miskin'),
				'pkkp_kpdt_pddk' => $request->input('pkkp-kpdt-pddk'),
				'tk_non_kmh_l_wil' => $request->input('tk-non-kmh-l-wil'),
				'tk_non_kmh_q_rt' => $request->input('tk-non-kmh-q-rt'),
				'tk_berat_l_wil' => $request->input('tk-berat-l-wil'),
				'tk_berat_q_rt' => $request->input('tk-berat-q-rt'),
				'tk_sedang_l_wil' => $request->input('tk-sedang-l-wil'),
				'tk_sedang_q_rt' => $request->input('tk-sedang-q-rt'),
				'tk_ringan_l_wil' => $request->input('tk-ringan-l-wil'),
				'tk_ringan_q_rt' => $request->input('tk-ringan-q-rt'),
				'ak_val_abs_hunian' => $request->input('ak-val-abs-hunian'),
				'ak_prcn_gap_hunian' => $request->input('ak-prcn-gap-hunian'),
				'ak_val_abs_jalan' => $request->input('ak-val-abs-jalan'),
				'ak_prcn_gap_jalan' => $request->input('ak-prcn-gap-jalan'),
				'ak_val_abs_air_minum' => $request->input('ak-val-abs-air-minum'),
				'ak_prcn_gap_air_minum' => $request->input('ak-prcn-gap-air-minum'),
				'ak_val_abs_drainase' => $request->input('ak-val-abs-drainase'),
				'ak_prcn_gap_drainase' => $request->input('ak-prcn-gap-drainase'),
				'ak_val_abs_air_limbah' => $request->input('ak-val-abs-air-limbah'),
				'ak_prcn_gap_air_limbah' => $request->input('ak-prcn-gap-air-limbah'),
				'ak_val_abs_sampah' => $request->input('ak-val-abs-sampah'),
				'ak_prcn_gap_sampah' => $request->input('ak-prcn-gap-sampah'),
				'ak_val_abs_kebakaran' => $request->input('ak-val-abs-kebakaran'),
				'ak_prcn_gap_kebakaran' => $request->input('ak-prcn-gap-kebakaran'),
				'ak_val_abs_rtp' => $request->input('ak-val-abs-rtp'),
				'ak_prcn_gap_rtp' => $request->input('ak-prcn-gap-rtp'),
				'ak_prcn_gap_ekonomi' => $request->input('ak-prcn-gap-ekonomi'),
				'ak_prcn_gap_sosial' => $request->input('ak-prcn-gap-sosial'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/penyusunan/lokasi_profile'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penyusunan/lokasi_profile'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 271);

		}else{
			DB::table('bkt_01030202_pfl_pmkm_kt')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $user->wk_kd_prop,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'lpp_sk_kmh' => $request->input('lpp-sk-kmh'),
				'lpp_l_kmh_sk' => $request->input('lpp-l-kmh-sk'),
				'lpp_l_kmh_ver' => $request->input('lpp-l-kmh-ver'),
				'prof_pmkm_kota' => intval($request->input('prof-pmkm-kota')),
				'rp2kp_stat_dok' => $request->input('rp2kp-stat-dok'),
				'rp2kp_ds_hukum' => $request->input('rp2kp-ds-hukum'),
				'rp2kp_q_dkel_kmh' => $request->input('rp2kp-q-dkel-kmh'),
				'rp2kp_q_dkel_non_kmh' => $request->input('rp2kp-q-dkel-non-kmh'),
				'pkkl_q_kel_kmh_thn_curr' => $request->input('pkkl-q-kel-kmh-thn-curr'),
				'pkkl_q_rt_kmh_thn_curr' => $request->input('pkkl-q-rt-kmh-thn-curr'),
				'pkkl_l_rt_kmh_thn_curr' => $request->input('pkkl-l-rt-kmh-thn-curr'),
				'pkkp_q_pddk' => $request->input('pkkp-q-pddk'),
				'pkkp_q_pddk_w' => $request->input('pkkp-q-pddk-w'),
				'pkkp_q_pddk_mbr' => $request->input('pkkp-q-pddk-mbr'),
				'pkkp_q_kk_miskin' => $request->input('pkkp-q-kk-miskin'),
				'pkkp_kpdt_pddk' => $request->input('pkkp-kpdt-pddk'),
				'tk_non_kmh_l_wil' => $request->input('tk-non-kmh-l-wil'),
				'tk_non_kmh_q_rt' => $request->input('tk-non-kmh-q-rt'),
				'tk_berat_l_wil' => $request->input('tk-berat-l-wil'),
				'tk_berat_q_rt' => $request->input('tk-berat-q-rt'),
				'tk_sedang_l_wil' => $request->input('tk-sedang-l-wil'),
				'tk_sedang_q_rt' => $request->input('tk-sedang-q-rt'),
				'tk_ringan_l_wil' => $request->input('tk-ringan-l-wil'),
				'tk_ringan_q_rt' => $request->input('tk-ringan-q-rt'),
				'ak_val_abs_hunian' => $request->input('ak-val-abs-hunian'),
				'ak_prcn_gap_hunian' => $request->input('ak-prcn-gap-hunian'),
				'ak_val_abs_jalan' => $request->input('ak-val-abs-jalan'),
				'ak_prcn_gap_jalan' => $request->input('ak-prcn-gap-jalan'),
				'ak_val_abs_air_minum' => $request->input('ak-val-abs-air-minum'),
				'ak_prcn_gap_air_minum' => $request->input('ak-prcn-gap-air-minum'),
				'ak_val_abs_drainase' => $request->input('ak-val-abs-drainase'),
				'ak_prcn_gap_drainase' => $request->input('ak-prcn-gap-drainase'),
				'ak_val_abs_air_limbah' => $request->input('ak-val-abs-air-limbah'),
				'ak_prcn_gap_air_limbah' => $request->input('ak-prcn-gap-air-limbah'),
				'ak_val_abs_sampah' => $request->input('ak-val-abs-sampah'),
				'ak_prcn_gap_sampah' => $request->input('ak-prcn-gap-sampah'),
				'ak_val_abs_kebakaran' => $request->input('ak-val-abs-kebakaran'),
				'ak_prcn_gap_kebakaran' => $request->input('ak-prcn-gap-kebakaran'),
				'ak_val_abs_rtp' => $request->input('ak-val-abs-rtp'),
				'ak_prcn_gap_rtp' => $request->input('ak-prcn-gap-rtp'),
				'ak_prcn_gap_ekonomi' => $request->input('ak-prcn-gap-ekonomi'),
				'ak_prcn_gap_sosial' => $request->input('ak-prcn-gap-sosial'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/penyusunan/lokasi_profile'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penyusunan/lokasi_profile'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 270);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030202_pfl_pmkm_kt')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 272);
        return Redirect::to('/main/perencanaan/penanganan/lokasi_profile');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 86,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
