<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010205Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // parent::__construct();
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
				if($item->kode_menu==40)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 107);
				return view('MAIN/bk010205/index',$data);
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
			0 =>'nama',
			1 =>'km_ds_hkm',
			2 =>'km_q_kw_kmh',
			3 =>'km_q_kec_kmh',
			4 =>'km_q_kel_kmh',
			5 =>'km_q_rt_kmh',
			6 =>'km_q_rt_non_kmh'
		);
		$query='select a.*, b.nama as nama from bkv_01020201_info_kota a inner join bkt_01010102_kota b on a.kode_kota = b.kode';
		$totalData = DB::select('select count(1) cnt from bkv_01020201_info_kota inner join bkt_01010102_kota on bkv_01020201_info_kota.kode_kota = bkt_01010102_kota.kode');
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
			$posts=DB::select($query. ' and b.nama like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and b.nama like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode_kota;
				$edit =  $post->kode_kota;
				$delete = $post->kode_kota;
				$url_edit="/main/persiapan/kota/info/create?kode_kota=".$show;
				$url_show="/main/persiapan/kota/info/show?kode_kota=".$show;
				$url_delete="/main/persiapan/kota/info/delete?kode_kota=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['km_ds_hkm'] = $post->km_ds_hkm;
				$nestedData['km_q_kw_kmh'] = $post->km_q_kw_kmh;
				$nestedData['km_q_kec_kmh'] = $post->km_q_kec_kmh;
				$nestedData['km_q_kel_kmh'] = $post->km_q_kel_kmh;
				$nestedData['km_q_rt_kmh'] = $post->km_q_rt_kmh;
				$nestedData['km_q_rt_non_kmh'] = $post->km_q_rt_non_kmh;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==40)
							$detil[$item->kode_menu_detil]='a';
					}
				}
				$option = '';
				if(!empty($detil['107'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['578'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
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

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==40)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['kode_kota']=$request->input('kode_kota');
				if($data['kode_kota']!=null){
					$rowData = DB::select('select * from bkv_01020201_info_kota where kode_kota='.$data['kode_kota']);
					$data['ca_q_kec'] = $rowData[0]->ca_q_kec;
					$data['ca_q_kel'] = $rowData[0]->ca_q_kel;
					$data['ca_q_dusun'] = $rowData[0]->ca_q_dusun;
					$data['ca_q_rw'] = $rowData[0]->ca_q_rw;
					$data['ca_q_rt'] = $rowData[0]->ca_q_rt;
					$data['lw_l_wil_adm'] = $rowData[0]->lw_l_wil_adm;
					$data['lw_l_pmkm'] = $rowData[0]->lw_l_pmkm;
					$data['cp_q_pdk'] = $rowData[0]->cp_q_pdk;
					$data['cp_q_pdk_w'] = $rowData[0]->cp_q_pdk_w;
					$data['cp_q_kk'] = $rowData[0]->cp_q_kk;
					$data['cp_q_kk_mbr'] = $rowData[0]->cp_q_kk_mbr;
					$data['cp_q_kk_miskin'] = $rowData[0]->cp_q_kk_miskin;
					$data['cp_r_pdt_kpdk'] = $rowData[0]->cp_r_pdt_kpdk;
					$data['cp_t_pdk_thn'] = $rowData[0]->cp_t_pdk_thn;
					$data['km_ds_hkm'] = $rowData[0]->km_ds_hkm;
					$data['km_q_kw_kmh'] = $rowData[0]->km_q_kw_kmh;
					$data['km_q_kec_kmh'] = $rowData[0]->km_q_kec_kmh;
					$data['km_q_kel_kmh'] = $rowData[0]->km_q_kel_kmh;
					$data['km_q_rt_kmh'] = $rowData[0]->km_q_rt_kmh;
					$data['km_q_rt_non_kmh'] = $rowData[0]->km_q_rt_non_kmh;
					$data['lk_l_kw_kmh'] = $rowData[0]->lk_l_kw_kmh;
					$data['lk_l_rt_kmh'] = $rowData[0]->lk_l_rt_kmh;
					$data['cpk_q_pdk'] = $rowData[0]->cpk_q_pdk;
					$data['cpk_q_pdk_w'] = $rowData[0]->cpk_q_pdk_w;
					$data['cpk_q_kk'] = $rowData[0]->cpk_q_kk;
					$data['cpk_q_kk_mbr'] = $rowData[0]->cpk_q_kk_mbr;
					$data['cpk_q_kk_miskin'] = $rowData[0]->cpk_q_kk_miskin;
					$data['cpk_r_pdt_kpdk'] = $rowData[0]->cpk_r_pdt_kpdk;
					$data['cpk_t_pdk_thn'] = $rowData[0]->cpk_t_pdk_thn;
				}
				if (Auth::check()) {
					$user = Auth::user();
					$data['username'] = Auth::user()->name;
				}
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				return view('MAIN/bk010205/create',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}

	}

	// public function post_create(Request $request)
	// {
	// 	if ($request->input('example-id-input')!=null){
	// 		DB::table('bkt_02010101_role_level')->where('kode', $request->input('example-id-input'))
	// 		->update(['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
	// 			]);

	// 	}else{
	// 		DB::table('bkt_02010101_role_level')->insert(
 //       			['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
 //       			]);
	// 	}
	// }

	// public function delete(Request $request)
	// {
	// 	DB::table('bkt_02010101_role_level')->where('kode', $request->input('kode'))->delete();
 //        return Redirect::to('/hrm/role_level');
 //    }

	public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 40,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
