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
        //$this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['username'] = '';
	    if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }
		return view('MAIN/bk010205/index',$data);
    }

	public function show()
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('slum_program',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_kota'
		);
		$query='select bkt_01010102_kota.nama as kode_kota from bkv_01020201_info_kota inner join bkt_01010102_kota on bkv_01020201_info_kota.kode_kota = bkt_01010102_kota.kode';
		$totalData = DB::select('select count(1) cnt from bkv_01020201_info_kota ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkv_01020201_info_kota.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and bkt_01010102_kota.nama like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and bkt_01010102_kota.nama like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode_kota;
				$edit =  $post->kode_kota;
				$delete = $post->kode_kota;
				$url_edit=url('/')."/main/persiapan/kota/info/create?kode_kota=".$show;
				$url_delete=url('/')."/main/persiapan/kota/info/delete?kode_kota=".$delete;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='Show' ><span class='fa fa-fw fa-edit'></span></a>";
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
		$data['username'] = '';
		$data['test']=true;
		$data['kode_kota']=$request->input('kode');
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
		}else{
			$data['ca_q_kec'] = null;
			$data['ca_q_kel'] = null;
			$data['ca_q_dusun'] = null;
			$data['ca_q_rw'] = null;
			$data['ca_q_rt'] = null;
			$data['lw_l_wil_adm'] = null;
			$data['lw_l_pmkm'] = null;
			$data['cp_q_pdk'] = null;
			$data['cp_q_pdk_w'] = null;
			$data['cp_q_kk'] = null;
			$data['cp_q_kk_mbr'] = null;
			$data['cp_q_kk_miskin'] = null;
			$data['cp_r_pdt_kpdk'] = null;
			$data['cp_t_pdk_thn'] = null;
			$data['km_ds_hkm'] = null;
			$data['km_q_kw_kmh'] = null;
			$data['km_q_kec_kmh'] = null;
			$data['km_q_kel_kmh'] = null;
			$data['km_q_rt_kmh'] = null;
			$data['km_q_rt_non_kmh'] = null;
			$data['lk_l_kw_kmh'] = null;
			$data['lk_l_rt_kmh'] = null;
			$data['cpk_q_pdk'] = null;
			$data['cpk_q_pdk_w'] = null;
			$data['cpk_q_kk'] = null;
			$data['cpk_q_kk_mbr'] = null;
			$data['cpk_q_kk_miskin'] = null;
			$data['cpk_r_pdt_kpdk'] = null;
			$data['cpk_t_pdk_thn'] = null;
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
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
		return view('MAIN/bk010205/create',$data);
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
}
