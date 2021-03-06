<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010310Controller extends Controller
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
				if($item->kode_menu==98)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 293);
				return view('MAIN/bk010310/index',$data);
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
			1 => 'kode_kota',
			2 => 'kode_korkot',
			3 => 'kode_kaw_prior',
			4 => 'kode_kmw',
			5 => 'kode_faskel',
			6 => 'jenis_kegiatan',
			7 => 'id_subkomponen',
			8 => 'id_dtl_subkomponen',
			9 => 'lok_kegiatan',
			10 => 'dk_q_kegiatan',
			11 => 'dk_vol_kegiatan',
			12 => 'dk_satuan',
			13 => 'nb_apbn_pupr',
			14 => 'nb_apbn_kl_lain',
			15 => 'nb_apbd_prop',
			16 => 'nb_apbd_kota',
			17 => 'nb_hibah',
			18 => 'nb_non_gov',
			19 => 'nb_masyarakat',
			20 => 'nb_lainnya',
			21 => 'tpm_q_jiwa',
			22 => 'tpm_q_jiwa_w',
			23 => 'tpm_q_mbr',
			24 => 'tpm_q_kk',
			25 => 'tpm_q_kk_miskin',
			26 => 'uri_img_document',
			27 => 'uri_img_absensi',
			28 => 'diser_tgl',
			29 => 'diser_oleh',
			30 => 'diket_tgl',
			31 => 'diket_oleh',
			32 => 'diver_tgl',
			33 => 'diver_oleh',
			34 => 'created_time',
			35 => 'created_by',
			36 => 'updated_time',
			37 => 'updated_by'
		);
		$query='select a.*, 
					b.nama nama_kota, 
					c.nama nama_korkot, 
					d.nama nama_kmw, 
					e.nama nama_faskel, 
					g.nama nama_kawasan,
					h.nama nama_subkomponen,
					i.nama nama_dtl_subkomponen,
					case 
						when a.jenis_kegiatan = "L" then "Lingkungan"
						when a.jenis_kegiatan = "S" then "Sosial"
						when a.jenis_kegiatan = "E" then "EKonomi"
					end nama_jenis_kegiatan
				from bkt_01030207_k_prior_inv_5th a 
					left join bkt_01010102_kota b on b.kode=a.kode_kota
					left join bkt_01010111_korkot c on c.kode=a.kode_korkot
					left join bkt_01010110_kmw d on d.kode=a.kode_kmw
					left join bkt_01010113_faskel e on e.kode=a.kode_faskel
					left join bkt_01030206_plan_kaw_prior f on f.kode=a.kode_kaw_prior
					left join bkt_01010123_kawasan g on g.id=f.kode_kawasan
					left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
					left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen';
			
		$totalData = DB::select('select count(1) cnt from bkt_01030207_k_prior_inv_5th a 
									left join bkt_01010102_kota b on b.kode=a.kode_kota
									left join bkt_01010111_korkot c on c.kode=a.kode_korkot
									left join bkt_01010110_kmw d on d.kode=a.kode_kmw
									left join bkt_01010113_faskel e on e.kode=a.kode_faskel
									left join bkt_01030206_plan_kaw_prior f on f.kode=a.kode_kaw_prior
									left join bkt_01010123_kawasan g on g.id=f.kode_kawasan
									left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
									left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen ');
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
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" or
					d.nama like "%'.$search.'%" or 
					e.nama like "%'.$search.'%" or
					g.nama like "%'.$search.'%" or
					lower(a.jenis_kegiatan) = "'.strtolower(substr($search,0,1)).'" or  
					h.nama like "%'.$search.'%" or 
					i.nama like "%'.$search.'%" or
					a.tahun like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.nama like "%'.$search.'%" or 
					c.nama like "%'.$search.'%" or
					d.nama like "%'.$search.'%" or 
					e.nama like "%'.$search.'%" or
					g.nama like "%'.$search.'%" or
					lower(a.jenis_kegiatan) = "'.strtolower(substr($search,0,1)).'" or 
					h.nama like "%'.$search.'%" or 
					i.nama like "%'.$search.'%" or
					a.tahun like "%'.$search.'%"
					)) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_show=url('/')."/main/perencanaan/kawasan/investasi/show?kode=".$edit;
				$url_edit=url('/')."/main/perencanaan/kawasan/investasi/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kawasan/investasi/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kawasan'] = $post->nama_kawasan;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['nama_jenis_kegiatan'] = $post->nama_jenis_kegiatan;
				$nestedData['nama_subkomponen'] = $post->nama_subkomponen;
				$nestedData['nama_dtl_subkomponen'] = $post->nama_dtl_subkomponen;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['dk_q_kegiatan'] = $post->dk_q_kegiatan;
				$nestedData['dk_vol_kegiatan'] = $post->dk_vol_kegiatan;
				$nestedData['dk_satuan'] = $post->dk_satuan;
				$nestedData['nb_apbn_pupr'] = $post->nb_apbn_pupr;
				$nestedData['nb_apbn_kl_lain'] = $post->nb_apbn_kl_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_hibah'] = $post->nb_hibah;
				$nestedData['nb_non_gov'] = $post->nb_non_gov;
				$nestedData['nb_masyarakat'] = $post->nb_masyarakat;
				$nestedData['nb_lainnya'] = $post->nb_lainnya;
				$nestedData['tpm_q_jiwa'] = $post->tpm_q_jiwa;
				$nestedData['tpm_q_jiwa_w'] = $post->tpm_q_jiwa_w;
				$nestedData['tpm_q_mbr'] = $post->tpm_q_mbr;
				$nestedData['tpm_q_kk'] = $post->tpm_q_kk;
				$nestedData['tpm_q_kk_miskin'] = $post->tpm_q_kk_miskin;
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
						if($item->kode_menu==98)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				//show
				if(!empty($detil['293'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['295'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['296'])){
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
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select * from bkt_01010110_kmw a,bkt_01010102_kota b
				where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kota'))){
			$kota = DB::select('select b.* from bkt_01010112_kota_korkot a,bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('korkot'))){
			$kota = DB::select('select kode, nama from bkt_01010113_faskel where kode_korkot='.$request->input('korkot'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kaw_prior'))){
			$kota = DB::select('select a.id, a.nama, b.kode from bkt_01010123_kawasan a, bkt_01030206_plan_kaw_prior b where b.kode_korkot='.$request->input('kaw_prior'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('subkomponen'))){
			$kota = DB::select('select b.id, b.nama from bkt_01010120_subkomponen a, bkt_01010121_dtl_subkomponen b where b.id_subkomponen='.$request->input('subkomponen'));
			echo json_encode($kota);
		}
	}

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==98)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			$id_subkomponen = DB::select('select id, nama from bkt_01010120_subkomponen');
			$data['kode_id_subkomponen_list'] = $id_subkomponen;
			
			if($data['kode']!=null  && !empty($data['detil']['293'])){
				$rowData = DB::select('select * from bkt_01030207_k_prior_inv_5th where kode='.$data['kode']);
				$data['detil_menu']='293';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kaw_prior'] = $rowData[0]->kode_kaw_prior;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['dk_q_kegiatan'] = $rowData[0]->dk_q_kegiatan;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['nb_apbn_pupr'] = $rowData[0]->nb_apbn_pupr;
				$data['nb_apbn_kl_lain'] = $rowData[0]->nb_apbn_kl_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_hibah'] = $rowData[0]->nb_hibah;
				$data['nb_non_gov'] = $rowData[0]->nb_non_gov;
				$data['nb_masyarakat'] = $rowData[0]->nb_masyarakat;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select * from bkt_01010110_kmw a,bkt_01010102_kota b
							where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_korkot))
					$data['kode_faskel_list']=DB::select('select kode, nama from bkt_01010113_faskel where kode_korkot='.$rowData[0]->kode_korkot);
				if(!empty($rowData[0]->kode_korkot))
					$data['kode_kaw_prior_list']=DB::select('select a.nama, b.kode from bkt_01010123_kawasan a, bkt_01030206_plan_kaw_prior b where b.kode_korkot='.$rowData[0]->kode_korkot);
				$data['kode_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_id_dtl_subkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010310/create',$data);
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
				if($item->kode_menu==98)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			$id_subkomponen = DB::select('select id, nama from bkt_01010120_subkomponen');
			$data['kode_id_subkomponen_list'] = $id_subkomponen;

			if($data['kode']!=null  && !empty($data['detil']['295'])){
				$rowData = DB::select('select * from bkt_01030207_k_prior_inv_5th where kode='.$data['kode']);
				$data['detil_menu']='295';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kaw_prior'] = $rowData[0]->kode_kaw_prior;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['dk_q_kegiatan'] = $rowData[0]->dk_q_kegiatan;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['nb_apbn_pupr'] = $rowData[0]->nb_apbn_pupr;
				$data['nb_apbn_kl_lain'] = $rowData[0]->nb_apbn_kl_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_hibah'] = $rowData[0]->nb_hibah;
				$data['nb_non_gov'] = $rowData[0]->nb_non_gov;
				$data['nb_masyarakat'] = $rowData[0]->nb_masyarakat;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select * from bkt_01010110_kmw a,bkt_01010102_kota b
							where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_korkot))
					$data['kode_faskel_list']=DB::select('select kode, nama from bkt_01010113_faskel where kode_korkot='.$rowData[0]->kode_korkot);
				if(!empty($rowData[0]->kode_korkot))
					$data['kode_kaw_prior_list']=DB::select('select a.nama, b.kode from bkt_01010123_kawasan a, bkt_01030206_plan_kaw_prior b where b.kode_korkot='.$rowData[0]->kode_korkot);
				$data['kode_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_id_dtl_subkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010310/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['294'])){
				$data['detil_menu']='294';
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kaw_prior'] = null;
				$data['kode_kmw'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['lok_kegiatan'] = null;
				$data['dk_q_kegiatan'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['nb_apbn_pupr'] = null;
				$data['nb_apbn_kl_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_hibah'] = null;
				$data['nb_non_gov'] = null;
				$data['nb_masyarakat'] = null;
				$data['nb_lainnya'] = null;
				$data['tpm_q_jiwa'] = null;
				$data['tpm_q_jiwa_w'] = null;
				$data['tpm_q_mbr'] = null;
				$data['tpm_q_kk'] = null;
				$data['tpm_q_kk_miskin'] = null;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_kaw_prior_list'] = DB::select('select a.nama, b.kode from bkt_01010123_kawasan a, bkt_01030206_plan_kaw_prior b where b.kode_kawasan=a.id');
				$data['kode_id_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				$data['kode_id_dtl_subkomponen_list'] = DB::select('select * from bkt_01010121_dtl_subkomponen where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010310/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_document = $request->file('file-document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uploaded-file-document') != null && $file_document == null){
			$uri_document = $request->input('uploaded-file-document');
			$upload_document = false;
		}elseif($request->input('uploaded-file-document') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uploaded-file-document') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uploaded-file-absensi') != null && $file_absensi == null){
			$uri_absensi = $request->input('uploaded-file-absensi');
			$upload_absensi = false;
		}elseif($request->input('uploaded-file-absensi') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uploaded-file-absensi') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030207_k_prior_inv_5th')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kaw_prior' => $request->input('select-kode_kaw_prior-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_q_kegiatan' => $request->input('dk_q_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'nb_apbn_pupr' => $request->input('nb_apbn_pupr-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/kawasan/investasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/kawasan/investasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 295);

		}else{
			DB::table('bkt_01030207_k_prior_inv_5th')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kaw_prior' => $request->input('select-kode_kaw_prior-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_q_kegiatan' => $request->input('dk_q_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'nb_apbn_pupr' => $request->input('nb_apbn_pupr-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/kawasan/investasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/kawasan/investasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 294);
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
		$this->log_aktivitas('Delete', 295);
        return Redirect::to('/main/perencanaan/kawasan/investasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 98,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
