<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010215Controller extends Controller
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
				if($item->kode_menu==66)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 176);
				return view('MAIN/bk010215/index',$data);
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
			1 =>'kode_kota',
			2 =>'kode_kec',
			3 =>'kode_kel',
			4 =>'km_ds_hkm',
			5 =>'km_q_kw_kmh',
			6 =>'km_q_kec_kmh',
			7 =>'km_q_kel_kmh',
			8 =>'km_q_rt_kmh',
			9 =>'km_q_rt_non_kmh',
			10 =>'lk_l_kw_kmh',
			11 =>'lk_l_rt_kmh'
		);
		$query='
			select * from (select 
				a.*,
				a.kode kode_info, 
				b.nama nama_prop, 
				c.nama nama_kota, 
				d.nama nama_kec, 
				e.nama nama_kel, 
				f.nama nama_korkot, 
				g.nama nama_faskel,
				h.nama nama_kmw
			from bkt_01020201_info_kel a
			 	left join bkt_01010101_prop b on a.kode_prop = b.kode
			 	left join bkt_01010102_kota c on a.kode_kota = c.kode
			 	left join bkt_01010103_kec d on a.kode_kec = d.kode
			 	left join bkt_01010104_kel e on a.kode_kel = e.kode
			 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
			 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
			 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode) b';
		$totalData = DB::select('select count(1) cnt from bkt_01020201_info_kel a
			 	left join bkt_01010101_prop b on a.kode_prop = b.kode
			 	left join bkt_01010102_kota c on a.kode_kota = c.kode
			 	left join bkt_01010103_kec d on a.kode_kec = d.kode
			 	left join bkt_01010104_kel e on a.kode_kel = e.kode
			 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
			 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
			 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode');
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
				b.kode_info like "%'.$search.'%" or 
				b.nama_prop like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_info like "%'.$search.'%" or 
				b.nama_prop like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or
				b.nama_kec like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%")) a');
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
				$url_show=url('/')."/main/persiapan/kelurahan/info/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/info/create?kode=".$show;
				$url_delete=url('/')."/main/persiapan/kelurahan/info/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_info;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['km_ds_hkm'] = $post->km_ds_hkm;
				$nestedData['km_q_kw_kmh'] = $post->km_q_kw_kmh;
				$nestedData['km_q_kec_kmh'] = $post->km_q_kec_kmh;
				$nestedData['km_q_kel_kmh'] = $post->km_q_kel_kmh;
				$nestedData['km_q_rt_kmh'] = $post->km_q_rt_kmh;
				$nestedData['km_q_rt_non_kmh'] = $post->km_q_rt_non_kmh;
				$nestedData['lk_l_kw_kmh'] = $post->lk_l_kw_kmh;
				$nestedData['lk_l_rt_kmh'] = $post->lk_l_rt_kmh;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==66)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['176'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['178'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['179'])){
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

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==66)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['176'])){
				$rowData = DB::select('select * from bkt_01020201_info_kel where kode='.$data['kode']);
				$data['detil_menu']='176';
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['cw_q_prop'] = $rowData[0]->cw_q_prop;
				$data['cw_q_kota'] = $rowData[0]->cw_q_kota;
				$data['ca_q_kec'] = $rowData[0]->ca_q_kec;
				$data['ca_q_kel'] = $rowData[0]->ca_q_kel;
				$data['ca_q_dusun'] = $rowData[0]->ca_q_dusun;
				$data['ca_q_rw'] = $rowData[0]->ca_q_rw;
				$data['ca_q_rt'] = $rowData[0]->ca_q_rt;
				$data['lw_l_wil_adm'] = $rowData[0]->lw_l_wil_adm;
				$data['lw_l_wil_adm_kota'] = $rowData[0]->lw_l_wil_adm_kota;
				$data['lw_l_wil_adm_kel'] = $rowData[0]->lw_l_wil_adm_kel;
				$data['lw_l_pmkm'] = $rowData[0]->lw_l_pmkm;
				$data['lw_l_pmkm_kota'] = $rowData[0]->lw_l_pmkm_kota;
				$data['lw_l_pmkm_kel'] = $rowData[0]->lw_l_pmkm_kel;
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
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010215/create',$data);
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
				if($item->kode_menu==66)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['178'])){
				$rowData = DB::select('select * from bkt_01020201_info_kel where kode='.$data['kode']);
				$data['detil_menu']='178';
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['cw_q_prop'] = $rowData[0]->cw_q_prop;
				$data['cw_q_kota'] = $rowData[0]->cw_q_kota;
				$data['ca_q_kec'] = $rowData[0]->ca_q_kec;
				$data['ca_q_kel'] = $rowData[0]->ca_q_kel;
				$data['ca_q_dusun'] = $rowData[0]->ca_q_dusun;
				$data['ca_q_rw'] = $rowData[0]->ca_q_rw;
				$data['ca_q_rt'] = $rowData[0]->ca_q_rt;
				$data['lw_l_wil_adm'] = $rowData[0]->lw_l_wil_adm;
				$data['lw_l_wil_adm_kota'] = $rowData[0]->lw_l_wil_adm_kota;
				$data['lw_l_wil_adm_kel'] = $rowData[0]->lw_l_wil_adm_kel;
				$data['lw_l_pmkm'] = $rowData[0]->lw_l_pmkm;
				$data['lw_l_pmkm_kota'] = $rowData[0]->lw_l_pmkm_kota;
				$data['lw_l_pmkm_kel'] = $rowData[0]->lw_l_pmkm_kel;
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
				if(empty($user->kode_faskel) && empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(!empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']= DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select distinct c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
															left join bkt_01010103_kec c on b.kode_kec=c.kode
														where a.id='.$user->id);
					$data['kode_kel_list']=DB::select('select c.kode, c.nama 
														from bkt_02010111_user a 
														left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
														left join  bkt_01010104_kel c on b.kode_kel=c.kode
														where a.id='.$user->id);
				}
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010215/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['177'])){
				$data['detil_menu']='177';
				$dataUser = DB::select('select a.*, b.kode_prop kode_prop from bkt_02010111_user a, bkt_01010110_kmw b where a.kode_kmw=b.kode and id='.$user->id);
				$data['kode_kmw'] = $dataUser[0]->kode_kmw;
				$data['kode_korkot'] = $dataUser[0]->kode_korkot;
				$data['kode_faskel'] = $dataUser[0]->kode_faskel;
				$data['kode_prop'] = $dataUser[0]->kode_prop;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['cw_q_prop'] = null;
				$data['cw_q_kota'] = null;
				$data['ca_q_kec'] = null;
				$data['ca_q_kel'] = null;
				$data['ca_q_dusun'] = null;
				$data['ca_q_rw'] = null;
				$data['ca_q_rt'] = null;
				$data['lw_l_wil_adm'] = null;
				$data['lw_l_wil_adm_kota'] = null;
				$data['lw_l_wil_adm_kel'] = null;
				$data['lw_l_pmkm'] = null;
				$data['lw_l_pmkm_kota'] = null;
				$data['lw_l_pmkm_kel'] = null;
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
				if ($data['kode_korkot']!=null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
				}elseif($data['kode_korkot']==null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
				}
				$data['kode_kec_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010215/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function select(Request $request)
	{
		if(($request->input('kec'))!=null && ($request->input('faskel'))!=null) {
			$kec_faskel = DB::select('select distinct a.kode, a.nama
										from bkt_01010103_kec a, bkt_01010114_kel_faskel b where a.kode=b.kode_kec and b.kode_faskel='.$request->input('faskel'));
			echo json_encode($kec_faskel);
		}
		elseif(($request->input('kec'))!=null && ($request->input('faskel'))==null){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kec'));
			echo json_encode($kec);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))!=null) {
			$kel_faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel').' and a.kode_faskel='.$request->input('faskel'));
			echo json_encode($kel_faskel);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))==null) {
			$kel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel'));
			echo json_encode($kel);
		}
		elseif(!empty($request->input('faskel'))){
			$faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$request->input('faskel'));
			echo json_encode($faskel);
		}
		elseif(!empty($request->input('korkot'))){
			$korkot = DB::select('select kode_korkot from bkt_01010112_kota_korkot where kode_kota='.$request->input('korkot'));
			echo json_encode($korkot);
		}
	}

	public function post_create(Request $request)
	{
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

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020201_info_kel')->where('kode', $request->input('kode'))
			->update([
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_prop' => $request->input('kode_prop-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'cw_q_prop' => $request->input('cw-q-prop'),
				'cw_q_kota' => $request->input('cw-q-kota'),
				'ca_q_kec' => $request->input('ca-q-kec'),
				'ca_q_kel' => $request->input('ca-q-kel'),
				'ca_q_dusun' => $request->input('ca-q-dusun'), 
				'ca_q_rw' => $request->input('ca-q-rw'),
				'ca_q_rt' => $request->input('ca-q-rt'),
				'lw_l_wil_adm' => $request->input('lw-l-wil-adm'),
				'lw_l_wil_adm_kota' => $request->input('lw-l-wil-adm-kota'),
				'lw_l_wil_adm_kel' => $request->input('lw-l-wil-adm-kel'),
				'lw_l_pmkm' => $request->input('lw-l-pmkm'),
				'lw_l_pmkm_kota' => $request->input('lw-l-pmkm-kota'),
				'lw_l_pmkm_kel' => $request->input('lw-l-pmkm-kel'),
				'cp_q_pdk' => $request->input('cp-q-pdk'),
				'cp_q_pdk_w' => $request->input('cp-q-pdk-w'),
				'cp_q_kk' => $request->input('cp-q-kk'),
				'cp_q_kk_mbr' => $request->input('cp-q-kk-mbr'),
				'cp_q_kk_miskin' => $request->input('cp-q-kk-miskin'),
				'cp_r_pdt_kpdk' => $request->input('cp-r-pdt-kpdk'),
				'cp_t_pdk_thn' => $request->input('cp-t-pdk-thn'),
				'km_ds_hkm' => $request->input('km-ds-hkm'),
				'km_q_kw_kmh' => $request->input('km-q-kw-kmh'),
				'km_q_kec_kmh' => $request->input('km-q-kec-kmh'),
				'km_q_kel_kmh' => $request->input('km-q-kel-kmh'),
				'km_q_rt_kmh' => $request->input('km-q-rt-kmh'),
				'km_q_rt_non_kmh' => $request->input('km-q-rt-non-kmh'),
				'lk_l_kw_kmh' => $request->input('lk-l-kw-kmh'),
				'lk_l_rt_kmh' => $request->input('lk-l-rt-kmh'),
				'cpk_q_pdk' => $request->input('cpk-q-pdk'),
				'cpk_q_pdk_w' => $request->input('cpk-q-pdk-w'),
				'cpk_q_kk' => $request->input('cpk-q-kk'),
				'cpk_q_kk_mbr' => $request->input('cpk-q-kk-mbr'),
				'cpk_q_kk_miskin' => $request->input('cpk-q-kk-miskin'),
				'cpk_r_pdt_kpdk' => $request->input('cpk-r-pdt-kpdk'),
				'cpk_t_pdk_thn' => $request->input('cpk-t-pdk-thn'),
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
				$file_document->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 178);

		}else{
			DB::table('bkt_01020201_info_kel')->insert([
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_prop' => $request->input('kode_prop-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'cw_q_prop' => $request->input('cw-q-prop'),
				'cw_q_kota' => $request->input('cw-q-kota'),
				'ca_q_kec' => $request->input('ca-q-kec'),
				'ca_q_kel' => $request->input('ca-q-kel'),
				'ca_q_dusun' => $request->input('ca-q-dusun'), 
				'ca_q_rw' => $request->input('ca-q-rw'),
				'ca_q_rt' => $request->input('ca-q-rt'),
				'lw_l_wil_adm' => $request->input('lw-l-wil-adm'),
				'lw_l_wil_adm_kota' => $request->input('lw-l-wil-adm-kota'),
				'lw_l_wil_adm_kel' => $request->input('lw-l-wil-adm-kel'),
				'lw_l_pmkm' => $request->input('lw-l-pmkm'),
				'lw_l_pmkm_kota' => $request->input('lw-l-pmkm-kota'),
				'lw_l_pmkm_kel' => $request->input('lw-l-pmkm-kel'),
				'cp_q_pdk' => $request->input('cp-q-pdk'),
				'cp_q_pdk_w' => $request->input('cp-q-pdk-w'),
				'cp_q_kk' => $request->input('cp-q-kk'),
				'cp_q_kk_mbr' => $request->input('cp-q-kk-mbr'),
				'cp_q_kk_miskin' => $request->input('cp-q-kk-miskin'),
				'cp_r_pdt_kpdk' => $request->input('cp-r-pdt-kpdk'),
				'cp_t_pdk_thn' => $request->input('cp-t-pdk-thn'),
				'km_ds_hkm' => $request->input('km-ds-hkm'),
				'km_q_kw_kmh' => $request->input('km-q-kw-kmh'),
				'km_q_kec_kmh' => $request->input('km-q-kec-kmh'),
				'km_q_kel_kmh' => $request->input('km-q-kel-kmh'),
				'km_q_rt_kmh' => $request->input('km-q-rt-kmh'),
				'km_q_rt_non_kmh' => $request->input('km-q-rt-non-kmh'),
				'lk_l_kw_kmh' => $request->input('lk-l-kw-kmh'),
				'lk_l_rt_kmh' => $request->input('lk-l-rt-kmh'),
				'cpk_q_pdk' => $request->input('cpk-q-pdk'),
				'cpk_q_pdk_w' => $request->input('cpk-q-pdk-w'),
				'cpk_q_kk' => $request->input('cpk-q-kk'),
				'cpk_q_kk_mbr' => $request->input('cpk-q-kk-mbr'),
				'cpk_q_kk_miskin' => $request->input('cpk-q-kk-miskin'),
				'cpk_r_pdt_kpdk' => $request->input('cpk-r-pdt-kpdk'),
				'cpk_t_pdk_thn' => $request->input('cpk-t-pdk-thn'),
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
				$file_document->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 177);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020201_info_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 179);
        return Redirect::to('/main/persiapan/kelurahan/info');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 66,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
