<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010316Controller extends Controller
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
				if($item->kode_menu==108)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 321);
				return view('MAIN/bk010316/index',$data);
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
		if(!empty($request->input('prop'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
			echo json_encode($kmw);
		}
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
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'tahun',
			1 =>'kode_prop',
			2 =>'kode_kmw',
			3 =>'kode_kota',
			4 =>'kode_korkot',
			5 =>'kode_kec',
			6 =>'kode_kel',
			7 =>'kode_faskel',
			8 =>'created_time'
		);
		$query='select a.kode as kode, a.tahun, b.nama as kode_prop, c.nama as kode_kota, d.nama as kode_kec, h.nama as kode_kel, e.nama as kode_kmw, f.nama as kode_korkot, g.nama as kode_faskel, a.created_time from bkt_01030214_plan_kel a, bkt_01010101_prop b, bkt_01010102_kota c, bkt_01010103_kec d, bkt_01010110_kmw e, bkt_01010111_korkot f, bkt_01010113_faskel g, bkt_01010104_kel h where a.kode_prop = b.kode and a.kode_kota = c.kode and a.kode_kec = d.kode and a.kode_kel = h.kode and a.kode_kmw = e.kode and a.kode_korkot = f.kode and a.kode_faskel = g.kode';
		$totalData = DB::select('select count(1) cnt from bkt_01030214_plan_kel a, bkt_01010101_prop b, bkt_01010102_kota c, bkt_01010103_kec d, bkt_01010110_kmw e, bkt_01010111_korkot f, bkt_01010113_faskel g, bkt_01010104_kel h where a.kode_prop = b.kode and a.kode_kota = c.kode and a.kode_kec = d.kode and a.kode_kel = h.kode and a.kode_kmw = e.kode and a.kode_korkot = f.kode and a.kode_faskel = g.kode');
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
			$posts=DB::select($query. ' and (a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or h.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or h.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/perencanaan/kelurahan/penanganan_kumuh/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kelurahan/penanganan_kumuh/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_prop'] = $post->kode_prop;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['kode_kec'] = $post->kode_kec;
				$nestedData['kode_kel'] = $post->kode_kel;
				$nestedData['kode_kmw'] = $post->kode_kmw;
				$nestedData['kode_korkot'] = $post->kode_korkot;
				$nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==108)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['323'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['324'])){
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

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==108)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['323'])){
				$rowData = DB::select('select * from bkt_01030214_plan_kel where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['klk_q_peningkatan'] = $rowData[0]->klk_q_peningkatan;
				$data['klk_q_pencegahan'] = $rowData[0]->klk_q_pencegahan;
				$data['kl_q_kec'] = $rowData[0]->kl_q_kec;
				$data['kl_q_kel'] = $rowData[0]->kl_q_kel;
				$data['kl_q_pddk'] = $rowData[0]->kl_q_pddk;
				$data['kl_q_pddk_w'] = $rowData[0]->kl_q_pddk_w;
				$data['kl_q_pddk_mbr'] = $rowData[0]->kl_q_pddk_mbr;
				$data['kl_q_kk_miskin'] = $rowData[0]->kl_q_kk_miskin;
				$data['kl_kpdt_pddk'] = $rowData[0]->kl_kpdt_pddk;
				$data['kl_kpdt_bangunan'] = $rowData[0]->kl_kpdt_bangunan;
				$data['pkk_l_kmh'] = $rowData[0]->pkk_l_kmh;
				$data['pkk_q_rt_kmh_thn_curr'] = $rowData[0]->pkk_q_rt_kmh_thn_curr;
				$data['pkk_l_rt_kmh_thn_curr'] = $rowData[0]->pkk_l_rt_kmh_thn_curr;
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
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010316/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['322'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['klk_q_peningkatan'] = null;
				$data['klk_q_pencegahan'] = null;
				$data['kl_q_kec'] = null;
				$data['kl_q_kel'] = null;
				$data['kl_q_pddk'] = null;
				$data['kl_q_pddk_w'] = null;
				$data['kl_q_pddk_mbr'] = null;
				$data['kl_q_kk_miskin'] = null;
				$data['kl_kpdt_pddk'] = null;
				$data['kl_kpdt_bangunan'] = null;
				$data['pkk_l_kmh'] = null;
				$data['pkk_q_rt_kmh_thn_curr'] = null;
				$data['pkk_l_rt_kmh_thn_curr'] = null;
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
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_kel_list'] = DB::select('select * from bkt_01010104_kel where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010316/create',$data);
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
			DB::table('bkt_01030214_plan_kel')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'klk_q_peningkatan' => $request->input('klk-q-peningkatan'),
				'klk_q_pencegahan' => $request->input('klk-q-pencegahan'),
				'kl_q_kec' => $request->input('kl-q-kec'),
				'kl_q_kel' => $request->input('kl-q-kel'),
				'kl_q_pddk' => $request->input('kl-q-pddk'),
				'kl_q_pddk_w' => $request->input('kl-q-pddk-w'),
				'kl_q_pddk_mbr' => $request->input('kl-q-pddk-mbr'),
				'kl_q_kk_miskin' => $request->input('kl-q-kk-miskin'),
				'kl_kpdt_pddk' => $request->input('kl-kpdt-pddk'),
				'kl_kpdt_bangunan' => $request->input('kl-kpdt-bangunan'),
				'pkk_l_kmh' => $request->input('pkk-l-kmh'),
				'pkk_q_rt_kmh_thn_curr' => $request->input('pkk-q-rt-kmh-thn-curr'),
				'pkk_l_rt_kmh_thn_curr' => $request->input('pkk-l-rt-kmh-thn-curr'),
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
				$file_dokumen->move(public_path('/uploads/perencanaan/rencana_kelurahan/penangann_kumuh'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/rencana_kelurahan/penangann_kumuh'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 62);

		}else{
			DB::table('bkt_01030214_plan_kel')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'klk_q_peningkatan' => $request->input('klk-q-peningkatan'),
				'klk_q_pencegahan' => $request->input('klk-q-pencegahan'),
				'kl_q_kec' => $request->input('kl-q-kec'),
				'kl_q_kel' => $request->input('kl-q-kel'),
				'kl_q_pddk' => $request->input('kl-q-pddk'),
				'kl_q_pddk_w' => $request->input('kl-q-pddk-w'),
				'kl_q_pddk_mbr' => $request->input('kl-q-pddk-mbr'),
				'kl_q_kk_miskin' => $request->input('kl-q-kk-miskin'),
				'kl_kpdt_pddk' => $request->input('kl-kpdt-pddk'),
				'kl_kpdt_bangunan' => $request->input('kl-kpdt-bangunan'),
				'pkk_l_kmh' => $request->input('pkk-l-kmh'),
				'pkk_q_rt_kmh_thn_curr' => $request->input('pkk-q-rt-kmh-thn-curr'),
				'pkk_l_rt_kmh_thn_curr' => $request->input('pkk-l-rt-kmh-thn-curr'),
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
				$file_dokumen->move(public_path('/uploads/perencanaan/rencana_kelurahan/penangann_kumuh'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/rencana_kelurahan/penangann_kumuh'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 61);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030214_plan_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 324);
        return Redirect::to('/main/perencanaan/kelurahan/penanganan_kumuh');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 108,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
