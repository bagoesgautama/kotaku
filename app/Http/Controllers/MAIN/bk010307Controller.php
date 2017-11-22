<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010307Controller extends Controller
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
				if($item->kode_menu==92)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 277);
				return view('MAIN/bk010307/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

    public function select(Request $request)
	{
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kota_korkot'))){
			$korkot = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('kota_kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota_kec'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kec_kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec_kel'));
			echo json_encode($kel);
		}
		if(!empty($request->input('kel_faskel'))){
			$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('kel_faskel'));
			echo json_encode($faskel);
		}
		if(!empty($request->input('jns_keg'))){
			$subkomponen = DB::select('select id, kode_subkomponen, nama from bkt_01010120_subkomponen where jenis_kegiatan="'.$request->input('jns_keg').'" and status=1');
			echo json_encode($subkomponen);
		}
		if(!empty($request->input('id_subkomponen'))){
			$dtl_subkomponen = DB::select('select id, kode_dtl_subkomponen, nama, satuan from bkt_01010121_dtl_subkomponen where id_subkomponen='.$request->input('id_subkomponen').' and status=1');
			echo json_encode($dtl_subkomponen);
		}
		if(!empty($request->input('id_dtl_subkomponen'))){
			$dtl_subkomponen = DB::select('select satuan from bkt_01010121_dtl_subkomponen where id='.$request->input('id_dtl_subkomponen').' and status=1');
			echo json_encode($dtl_subkomponen);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_kota',
			3 =>'jenis_kegiatan',
			4 =>'id_subkomponen',
			5 =>'id_dtl_subkomponen',
			6 =>'lok_kegiatan'
		);
		$query='
		select * from (select 
				a.*,
				a.kode kode_plan, 
				a.tahun tahun_plan,
				a.lok_kegiatan lok_kegiatan_plan,
				case when a.skala_kegiatan=1 then "Kota/Kabupaten" when a.skala_kegiatan=2 then "Desa/Kelurahan" end skala_kegiatan_convert,
				case when a.jenis_kegiatan="L" then "Lingkungan" when a.jenis_kegiatan="S" then "Sosial" when a.jenis_kegiatan="E" then "Ekonomi" end jenis_kegiatan_convert,
				b.nama nama_kota, 
				c.nama nama_korkot, 
				d.nama nama_kec, 
				e.nama nama_kmw, 
				f.nama nama_kel, 
				g.nama nama_faskel, 
				h.nama nama_subkomponen, 
				i.nama nama_dtl_subkomponen 
			from bkt_01030204_plan_inves_thn a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010103_kec d on d.kode=a.kode_kec 
				left join bkt_01010110_kmw e on e.kode=a.kode_kmw
				left join bkt_01010104_kel f on f.kode=a.kode_kel
				left join bkt_01010113_faskel g on g.kode=a.kode_faskel
				left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
				left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
			where 
				a.skala_kegiatan="1") b';
		$totalData = DB::select('select count(1) cnt from bkt_01030204_plan_inves_thn a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010103_kec d on d.kode=a.kode_kec 
				left join bkt_01010110_kmw e on e.kode=a.kode_kmw
				left join bkt_01010104_kel f on f.kode=a.kode_kel
				left join bkt_01010113_faskel g on g.kode=a.kode_faskel
				left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
				left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
			where 
				a.skala_kegiatan="1"');
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
				b.kode_plan like "%'.$search.'%" or 
				b.nama_subkomponen like "%'.$search.'%" or 
				b.nama_dtl_subkomponen like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.jenis_kegiatan_convert like "%'.$search.'%" or
				b.tahun_plan like "%'.$search.'%" or
				b.lok_kegiatan_plan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_plan like "%'.$search.'%" or 
				b.nama_subkomponen like "%'.$search.'%" or 
				b.nama_dtl_subkomponen like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.jenis_kegiatan_convert like "%'.$search.'%" or
				b.tahun_plan like "%'.$search.'%" or
				b.lok_kegiatan_plan like "%'.$search.'%")) a');
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
				$url_show=url('/')."/main/perencanaan/penanganan/rencana_investasi/show?kode=".$edit;
				$url_edit=url('/')."/main/perencanaan/penanganan/rencana_investasi/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/penanganan/rencana_investasi/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_plan;
				$nestedData['tahun'] = $post->tahun_plan;
				// $nestedData['skala_kegiatan'] = $post->skala_kegiatan_convert;
				$nestedData['id_subkomponen'] = $post->nama_subkomponen;
				$nestedData['id_dtl_subkomponen'] = $post->nama_dtl_subkomponen;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['jenis_kegiatan'] = $post->jenis_kegiatan_convert;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan_plan;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==92)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				//show
				if(!empty($detil['277'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['279'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['280'])){
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
				if($item->kode_menu==92)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null  && !empty($data['detil']['277'])){
				$rowData = DB::select('select * from bkt_01030204_plan_inves_thn where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['detil_menu']='277';
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
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
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->jenis_kegiatan))
					$data['kode_subkomponen_list']=DB::select('select id, kode_subkomponen, nama from bkt_01010120_subkomponen where jenis_kegiatan="'.$rowData[0]->jenis_kegiatan.'" and status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_subdtlkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010307/create',$data);
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
				if($item->kode_menu==92)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if ($data['kode']!=null  && !empty($data['detil']['279'])){
				$rowData = DB::select('select * from bkt_01030204_plan_inves_thn where kode='.$data['kode']);
				$data['detil_menu']='279';
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
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
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->jenis_kegiatan))
					$data['kode_subkomponen_list']=DB::select('select id, kode_subkomponen, nama from bkt_01010120_subkomponen where jenis_kegiatan="'.$rowData[0]->jenis_kegiatan.'" and status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_subdtlkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010307/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['278'])){
				$data['detil_menu']='278';
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
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
				$data['kode_kec_list'] = [];
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = [];
				$data['kode_faskel_list'] = [];
				$data['kode_kel_list'] = [];
				$data['kode_subkomponen_list'] = [];
				$data['kode_subdtlkomponen_list'] = [];
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010307/create',$data);
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

		//kalau tidak punya kmw && punya wk_kd_prop
		if($user->wk_kd_kota != null){
			$prop_kmw = DB::select('select kode from bkt_01010110_kmw where kode_prop='.$user->wk_kd_prop);
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030204_plan_inves_thn')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => 1,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'id_subkomponen' => $request->input('kode-subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('kode-subdtlkomponen-input'),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'dk_q_kegiatan' => $request->input('dk_q_kegiatan'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan'),
				'dk_satuan' => $request->input('dk_satuan'),
				'nb_apbn_pupr' => $request->input('nb_apbn_pupr'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_hibah' => $request->input('nb_hibah'),
				'nb_non_gov' => $request->input('nb_non_gov'),
				'nb_masyarakat' => $request->input('nb_masyarakat'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
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
				$file_document->move(public_path('/uploads/perencanaan/penyusunan/rencana_investasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penyusunan/rencana_investasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 279);

		}else{
			DB::table('bkt_01030204_plan_inves_thn')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => 1,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'id_subkomponen' => $request->input('kode-subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('kode-subdtlkomponen-input'),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'dk_q_kegiatan' => $request->input('dk_q_kegiatan'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan'),
				'dk_satuan' => $request->input('dk_satuan'),
				'nb_apbn_pupr' => $request->input('nb_apbn_pupr'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_hibah' => $request->input('nb_hibah'),
				'nb_non_gov' => $request->input('nb_non_gov'),
				'nb_masyarakat' => $request->input('nb_masyarakat'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
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
				$file_document->move(public_path('/uploads/perencanaan/penyusunan/rencana_investasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penyusunan/rencana_investasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 278);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030204_plan_inves_thn')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 280);
        return Redirect::to('/main/perencanaan/penanganan/rencana_investasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 92,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
