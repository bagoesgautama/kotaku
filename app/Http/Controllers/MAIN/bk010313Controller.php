<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010313Controller extends Controller
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
				if($item->kode_menu==107)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 317);
				return view('MAIN/bk010313/index',$data);
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
			0 => 'kode_parent',
			1 => 'lpt_l_hibah_gov',
			2 => 'lpt_l_hibah_masy',
			3 => 'lpt_l_hibah_lain',
			4 => 'lpt_l_ijin_pakai_gov',
			5 => 'lpt_l_ijin_pakai_masy',
			6 => 'lpt_l_ijin_pakai_lain',
			7 => 'lpt_l_dilalui_gov',
			8 => 'lpt_l_dilalui_masy',
			9 => 'lpt_l_dilalui_lain',
			10 => 'lpt_rp_nilai_gov',
			11 => 'lpt_rp_nilai_masy',
			12 => 'lpt_rp_nilai_lain',
			13 => 'lpt_q_pt_kk_hibah',
			14 => 'lpt_q_pt_kk_ijin_pakai',
			15 => 'lpt_q_pt_kk_ijin_dilalui',
			16 => 'kl_lt_pre',
			17 => 'kl_lt_pos',
			18 => 'kl_q_peserta',
			19 => 'kl_q_peserta_w',
			20 => 'pk_lt_pre',
			21 => 'pk_lt_pos',
			22 => 'pk_q_peserta',
			23 => 'pk_q_peserta_w',
			24 => 'mha_q_jiwa',
			25 => 'mha_q_jiwa_w',
			26 => 'mha_q_wtp',
			27 => 'mha_q_wtp_w',
			28 => 'mha_q_wpm',
			29 => 'mha_q_wpm_w',
			30 => 'mha_flag_rk_mha',
			31 => 'dl_flag_ukl_upl',
			32 => 'dl_flag_sop',
			33 => 'cb_flag_di_kaw_cb',
			34 => 'cb_flag_sop',
			35 => 'rb_flag_di_kaw_rb',
			36 => 'dl_flag_sop',
			37 => 'pk_flag_pakai_kayu',
			38 => 'pk_vol_kayu',
			39 => 'lk_flag_legal_kayu',
			40 => 'lk_vol_kayu_legal',
			41 => 'uri_img_document',
			42 => 'uri_img_absensi',
			43 => 'diser_tgl',
			44 => 'diser_oleh',
			45 => 'diket_tgl',
			46 => 'diket_oleh',
			47 => 'diver_tgl',
			48 => 'diver_oleh',
			49 => 'created_time',
			50 => 'created_by',
			51 => 'updated_time',
			52 => 'updated_by'
		);
		$query='select a.*, b.kode 
					from bkt_01030210_pkt_krj_amdal a 
						left join bkt_01030209_pkt_krj_kontraktor b on a.kode_parent=b.kode ';
			
		$totalData = DB::select('select count(1) cnt 
									from bkt_01030210_pkt_krj_amdal a 
												left join bkt_01030209_pkt_krj_kontraktor b on a.kode_parent=b.kode');
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
				$show =  $post->kode_parent;
				$edit =  $post->kode_parent;
				$delete = $post->kode_parent;

				$url_edit=url('/')."/main/perencanaan/infra/amdal/create?kode_parent=".$edit;
				$url_delete=url('/')."/main/perencanaan/infra/amdal/delete?kode_parent=".$delete;
				$nestedData['kode_parent'] = $post->kode_parent;
				$nestedData['lpt_l_hibah_gov'] = $post->lpt_l_hibah_gov;
				$nestedData['lpt_l_hibah_masy'] = $post->lpt_l_hibah_masy;
				$nestedData['lpt_l_hibah_lain'] = $post->lpt_l_hibah_lain;
				$nestedData['lpt_l_ijin_pakai_gov'] = $post->lpt_l_ijin_pakai_gov;
				$nestedData['lpt_l_ijin_pakai_masy'] = $post->lpt_l_ijin_pakai_masy;
				$nestedData['lpt_l_ijin_pakai_lain'] = $post->lpt_l_ijin_pakai_lain;
				$nestedData['lpt_l_dilalui_gov'] = $post->lpt_l_dilalui_gov;
				$nestedData['lpt_l_dilalui_masy'] = $post->lpt_l_dilalui_masy;
				$nestedData['lpt_l_dilalui_lain'] = $post->lpt_l_dilalui_lain;
				$nestedData['lpt_rp_nilai_gov'] = $post->lpt_rp_nilai_gov;
				$nestedData['lpt_rp_nilai_masy'] = $post->lpt_rp_nilai_masy;
				$nestedData['lpt_rp_nilai_lain'] = $post->lpt_rp_nilai_lain;
				$nestedData['lpt_q_pt_kk_hibah'] = $post->lpt_q_pt_kk_hibah;
				$nestedData['lpt_q_pt_kk_ijin_pakai'] = $post->lpt_q_pt_kk_ijin_pakai;
				$nestedData['lpt_q_pt_kk_ijin_dilalui'] = $post->lpt_q_pt_kk_ijin_dilalui;
				$nestedData['kl_lt_pre'] = $post->kl_lt_pre;
				$nestedData['kl_lt_pos'] = $post->kl_lt_pos;
				$nestedData['kl_q_peserta'] = $post->kl_q_peserta;
				$nestedData['kl_q_peserta_w'] = $post->kl_q_peserta_w;
				$nestedData['pk_lt_pre'] = $post->pk_lt_pre;
				$nestedData['pk_lt_pos'] = $post->pk_lt_pos;
				$nestedData['pk_q_peserta'] = $post->pk_q_peserta;
				$nestedData['pk_q_peserta_w'] = $post->pk_q_peserta_w;
				$nestedData['mha_q_jiwa'] = $post->mha_q_jiwa;
				$nestedData['mha_q_jiwa_w'] = $post->mha_q_jiwa_w;
				$nestedData['mha_q_wtp'] = $post->mha_q_wtp;
				$nestedData['mha_q_wtp_w'] = $post->mha_q_wtp_w;
				$nestedData['mha_q_wpm'] = $post->mha_q_wpm;
				$nestedData['mha_q_wpm_w'] = $post->mha_q_wpm_w;
				$nestedData['mha_flag_rk_mha'] = $post->mha_flag_rk_mha;
				$nestedData['dl_flag_ukl_upl'] = $post->dl_flag_ukl_upl;
				$nestedData['dl_flag_sop'] = $post->dl_flag_sop;
				$nestedData['cb_flag_di_kaw_cb'] = $post->cb_flag_di_kaw_cb;
				$nestedData['cb_flag_sop'] = $post->cb_flag_sop;
				$nestedData['rb_flag_di_kaw_rb'] = $post->rb_flag_di_kaw_rb;
				$nestedData['dl_flag_sop'] = $post->dl_flag_sop;
				$nestedData['pk_flag_pakai_kayu'] = $post->pk_flag_pakai_kayu;
				$nestedData['pk_vol_kayu'] = $post->pk_vol_kayu;
				$nestedData['lk_flag_legal_kayu'] = $post->lk_flag_legal_kayu;
				$nestedData['lk_vol_kayu_legal'] = $post->lk_vol_kayu_legal;
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
						if($item->kode_menu==107)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['319'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['320'])){
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
				if($item->kode_menu==107)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode_parent']=$request->input('kode_parent');

			if($data['kode_parent']!=null  && !empty($data['detil']['319'])){
				$rowData = DB::select('select * from bkt_01030210_pkt_krj_amdal where kode_parent='.$data['kode_parent']);
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['lpt_l_hibah_gov'] = $rowData[0]->lpt_l_hibah_gov;
				$data['lpt_l_hibah_masy'] = $rowData[0]->lpt_l_hibah_masy;
				$data['lpt_l_hibah_lain'] = $rowData[0]->lpt_l_hibah_lain;
				$data['lpt_l_ijin_pakai_gov'] = $rowData[0]->lpt_l_ijin_pakai_gov;
				$data['lpt_l_ijin_pakai_masy'] = $rowData[0]->lpt_l_ijin_pakai_masy;
				$data['lpt_l_ijin_pakai_lain'] = $rowData[0]->lpt_l_ijin_pakai_lain;
				$data['lpt_l_dilalui_gov'] = $rowData[0]->lpt_l_dilalui_gov;
				$data['lpt_l_dilalui_masy'] = $rowData[0]->lpt_l_dilalui_masy;
				$data['lpt_l_dilalui_lain'] = $rowData[0]->lpt_l_dilalui_lain;
				$data['lpt_rp_nilai_gov'] = $rowData[0]->lpt_rp_nilai_gov;
				$data['lpt_rp_nilai_masy'] = $rowData[0]->lpt_rp_nilai_masy;
				$data['lpt_rp_nilai_lain'] = $rowData[0]->lpt_rp_nilai_lain;
				$data['lpt_q_pt_kk_hibah'] = $rowData[0]->lpt_q_pt_kk_hibah;
				$data['lpt_q_pt_kk_ijin_pakai'] = $rowData[0]->lpt_q_pt_kk_ijin_pakai;
				$data['lpt_q_pt_kk_ijin_dilalui'] = $rowData[0]->lpt_q_pt_kk_ijin_dilalui;
				$data['kl_lt_pre'] = $rowData[0]->kl_lt_pre;
				$data['kl_lt_pos'] = $rowData[0]->kl_lt_pos;
				$data['kl_q_peserta'] = $rowData[0]->kl_q_peserta;
				$data['kl_q_peserta_w'] = $rowData[0]->kl_q_peserta_w;
				$data['pk_lt_pre'] = $rowData[0]->pk_lt_pre;
				$data['pk_lt_pos'] = $rowData[0]->pk_lt_pos;
				$data['pk_q_peserta'] = $rowData[0]->pk_q_peserta;
				$data['pk_q_peserta_w'] = $rowData[0]->pk_q_peserta_w;
				$data['mha_q_jiwa'] = $rowData[0]->mha_q_jiwa;
				$data['mha_q_jiwa_w'] = $rowData[0]->mha_q_jiwa_w;
				$data['mha_q_wtp'] = $rowData[0]->mha_q_wtp;
				$data['mha_q_wtp_w'] = $rowData[0]->mha_q_wtp_w;
				$data['mha_q_wpm'] = $rowData[0]->mha_q_wpm;
				$data['mha_q_wpm_w'] = $rowData[0]->mha_q_wpm_w;
				$data['mha_flag_rk_mha'] = $rowData[0]->mha_flag_rk_mha;
				$data['dl_flag_ukl_upl'] = $rowData[0]->dl_flag_ukl_upl;
				$data['dl_flag_sop'] = $rowData[0]->dl_flag_sop;
				$data['cb_flag_di_kaw_cb'] = $rowData[0]->cb_flag_di_kaw_cb;
				$data['cb_flag_sop'] = $rowData[0]->cb_flag_sop;
				$data['rb_flag_di_kaw_rb'] = $rowData[0]->rb_flag_di_kaw_rb;
				$data['rb_flag_sop'] = $rowData[0]->rb_flag_sop;
				$data['pk_flag_pakai_kayu'] = $rowData[0]->pk_flag_pakai_kayu;
				$data['pk_vol_kayu'] = $rowData[0]->pk_vol_kayu;
				$data['lk_flag_legal_kayu'] = $rowData[0]->lk_flag_legal_kayu;
				$data['lk_vol_kayu_legal'] = $rowData[0]->lk_vol_kayu_legal;
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
				$data['paket_kerja_kontraktor_list'] = DB::select('select * from bkt_01030209_pkt_krj_kontraktor where skala_kegiatan=2');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010313/create',$data);
			}else if ($data['kode_parent']==null  && !empty($data['detil']['318'])){
				$data['kode_parent'] = null;
				$data['lpt_l_hibah_gov'] = null;
				$data['lpt_l_hibah_masy'] = null;
				$data['lpt_l_hibah_lain'] = null;
				$data['lpt_l_ijin_pakai_gov'] = null;
				$data['lpt_l_ijin_pakai_masy'] = null;
				$data['lpt_l_ijin_pakai_lain'] = null;
				$data['lpt_l_dilalui_gov'] = null;
				$data['lpt_l_dilalui_masy'] = null;
				$data['lpt_l_dilalui_lain'] = null;
				$data['lpt_rp_nilai_gov'] = null;
				$data['lpt_rp_nilai_masy'] = null;
				$data['lpt_rp_nilai_lain'] = null;
				$data['lpt_q_pt_kk_hibah'] = null;
				$data['lpt_q_pt_kk_ijin_pakai'] = null;
				$data['lpt_q_pt_kk_ijin_dilalui'] = null;
				$data['kl_lt_pre'] = null;
				$data['kl_lt_pos'] = null;
				$data['kl_q_peserta'] = null;
				$data['kl_q_peserta_w'] = null;
				$data['pk_lt_pre'] = null;
				$data['pk_lt_pos'] = null;
				$data['pk_q_peserta'] = null;
				$data['pk_q_peserta_w'] = null;
				$data['mha_q_jiwa'] = null;
				$data['mha_q_jiwa_w'] = null;
				$data['mha_q_wtp'] = null;
				$data['mha_q_wtp_w'] = null;
				$data['mha_q_wpm'] = null;
				$data['mha_q_wpm_w'] = null;
				$data['mha_flag_rk_mha'] = null;
				$data['dl_flag_ukl_upl'] = null;
				$data['dl_flag_sop'] = null;
				$data['cb_flag_di_kaw_cb'] = null;
				$data['cb_flag_sop'] = null;
				$data['rb_flag_di_kaw_rb'] = null;
				$data['rb_flag_sop'] = null;
				$data['pk_flag_pakai_kayu'] = null;
				$data['pk_vol_kayu'] = null;
				$data['lk_flag_legal_kayu'] = null;
				$data['lk_vol_kayu_legal'] = null;
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
				$data['paket_kerja_kontraktor_list'] = DB::select('select * from bkt_01030209_pkt_krj_kontraktor where skala_kegiatan=2');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010313/create',$data);
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

		if ($request->input('kode_parent')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030210_pkt_krj_amdal')->where('kode_parent', $request->input('kode_parent'))
			->update([
				'kode_parent' => $request->input('select-paket_kerja_kontraktor-input'),
				'lpt_l_hibah_gov' => $request->input('lpt_l_hibah_gov'),
				'lpt_l_hibah_masy' => $request->input('lpt_l_hibah_masy'),
				'lpt_l_hibah_lain' => $request->input('lpt_l_hibah_lain'),
				'lpt_l_ijin_pakai_gov' => $request->input('lpt_l_ijin_pakai_gov'),
				'lpt_l_ijin_pakai_masy' => $request->input('lpt_l_ijin_pakai_masy'),
				'lpt_l_ijin_pakai_lain' => $request->input('lpt_l_ijin_pakai_lain'),
				'lpt_l_dilalui_gov' => $request->input('lpt_l_dilalui_gov'),
				'lpt_l_dilalui_masy' => $request->input('lpt_l_dilalui_masy'),
				'lpt_l_dilalui_lain' => $request->input('lpt_l_dilalui_lain'),
				'lpt_rp_nilai_gov' => $request->input('lpt_rp_nilai_gov'),
				'lpt_rp_nilai_masy' => $request->input('lpt_rp_nilai_masy'),
				'lpt_rp_nilai_lain' => $request->input('lpt_rp_nilai_lain'),
				'lpt_q_pt_kk_hibah' => $request->input('lpt_q_pt_kk_hibah'),
				'lpt_q_pt_kk_ijin_pakai' => $request->input('lpt_q_pt_kk_ijin_pakai'),
				'lpt_q_pt_kk_ijin_dilalui' => $request->input('lpt_q_pt_kk_ijin_dilalui'),
				'kl_lt_pre' => $request->input('kl_lt_pre'),
				'kl_lt_pos' => $request->input('kl_lt_pos'),
				'kl_q_peserta' => $request->input('kl_q_peserta'),
				'kl_q_peserta_w' => $request->input('kl_q_peserta_w'),
				'pk_lt_pre' => $request->input('pk_lt_pre'),
				'pk_lt_pos' => $request->input('pk_lt_pos'),
				'pk_q_peserta' => $request->input('pk_q_peserta'),
				'pk_q_peserta_w' => $request->input('pk_q_peserta_w'),
				'mha_q_jiwa' => $request->input('mha_q_jiwa'),
				'mha_q_jiwa_w' => $request->input('mha_q_jiwa_w'),
				'mha_q_wtp' => $request->input('mha_q_wtp'),
				'mha_q_wtp_w' => $request->input('mha_q_wtp_w'),
				'mha_q_wpm' => $request->input('mha_q_wpm'),
				'mha_q_wpm_w' => $request->input('mha_q_wpm_w'),
				'mha_flag_rk_mha' => intval($request->input('mha_flag_rk_mha')),
				'dl_flag_ukl_upl' => intval($request->input('dl_flag_ukl_upl')),
				'dl_flag_sop' => intval($request->input('dl_flag_sop')),
				'cb_flag_di_kaw_cb' => intval($request->input('cb_flag_di_kaw_cb')),
				'cb_flag_sop' => intval($request->input('cb_flag_sop')),
				'rb_flag_di_kaw_rb' => intval($request->input('rb_flag_di_kaw_rb')),
				'rb_flag_sop' => intval($request->input('rb_flag_sop')),
				'pk_flag_pakai_kayu' => intval($request->input('pk_flag_pakai_kayu')),
				'pk_vol_kayu' => $request->input('pk_vol_kayu'),
				'lk_flag_legal_kayu' => intval($request->input('lk_flag_legal_kayu')),
				'lk_vol_kayu_legal' => $request->input('lk_vol_kayu_legal'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				//'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				//'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				//'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/infra/amdal'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/infra/amdal'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 319);

		}else{
			DB::table('bkt_01030210_pkt_krj_amdal')->insert([
				'kode_parent' => $request->input('select-paket_kerja_kontraktor-input'),
				'lpt_l_hibah_gov' => $request->input('lpt_l_hibah_gov'),
				'lpt_l_hibah_masy' => $request->input('lpt_l_hibah_masy'),
				'lpt_l_hibah_lain' => $request->input('lpt_l_hibah_lain'),
				'lpt_l_ijin_pakai_gov' => $request->input('lpt_l_ijin_pakai_gov'),
				'lpt_l_ijin_pakai_masy' => $request->input('lpt_l_ijin_pakai_masy'),
				'lpt_l_ijin_pakai_lain' => $request->input('lpt_l_ijin_pakai_lain'),
				'lpt_l_dilalui_gov' => $request->input('lpt_l_dilalui_gov'),
				'lpt_l_dilalui_masy' => $request->input('lpt_l_dilalui_masy'),
				'lpt_l_dilalui_lain' => $request->input('lpt_l_dilalui_lain'),
				'lpt_rp_nilai_gov' => $request->input('lpt_rp_nilai_gov'),
				'lpt_rp_nilai_masy' => $request->input('lpt_rp_nilai_masy'),
				'lpt_rp_nilai_lain' => $request->input('lpt_rp_nilai_lain'),
				'lpt_q_pt_kk_hibah' => $request->input('lpt_q_pt_kk_hibah'),
				'lpt_q_pt_kk_ijin_pakai' => $request->input('lpt_q_pt_kk_ijin_pakai'),
				'lpt_q_pt_kk_ijin_dilalui' => $request->input('lpt_q_pt_kk_ijin_dilalui'),
				'kl_lt_pre' => $request->input('kl_lt_pre'),
				'kl_lt_pos' => $request->input('kl_lt_pos'),
				'kl_q_peserta' => $request->input('kl_q_peserta'),
				'kl_q_peserta_w' => $request->input('kl_q_peserta_w'),
				'pk_lt_pre' => $request->input('pk_lt_pre'),
				'pk_lt_pos' => $request->input('pk_lt_pos'),
				'pk_q_peserta' => $request->input('pk_q_peserta'),
				'pk_q_peserta_w' => $request->input('pk_q_peserta_w'),
				'mha_q_jiwa' => $request->input('mha_q_jiwa'),
				'mha_q_jiwa_w' => $request->input('mha_q_jiwa_w'),
				'mha_q_wtp' => $request->input('mha_q_wtp'),
				'mha_q_wtp_w' => $request->input('mha_q_wtp_w'),
				'mha_q_wpm' => $request->input('mha_q_wpm'),
				'mha_q_wpm_w' => $request->input('mha_q_wpm_w'),
				'mha_flag_rk_mha' => intval($request->input('mha_flag_rk_mha')),
				'dl_flag_ukl_upl' => intval($request->input('dl_flag_ukl_upl')),
				'dl_flag_sop' => intval($request->input('dl_flag_sop')),
				'cb_flag_di_kaw_cb' => intval($request->input('cb_flag_di_kaw_cb')),
				'cb_flag_sop' => intval($request->input('cb_flag_sop')),
				'rb_flag_di_kaw_rb' => intval($request->input('rb_flag_di_kaw_rb')),
				'rb_flag_sop' => intval($request->input('rb_flag_sop')),
				'pk_flag_pakai_kayu' => intval($request->input('pk_flag_pakai_kayu')),
				'pk_vol_kayu' => $request->input('pk_vol_kayu'),
				'lk_flag_legal_kayu' => intval($request->input('lk_flag_legal_kayu')),
				'lk_vol_kayu_legal' => $request->input('lk_vol_kayu_legal'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				//'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				//'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				//'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/infra/amdal'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/infra/amdal'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 318);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030210_pkt_krj_amdal')->where('kode', $request->input('kode_parent'))->delete();
		$this->log_aktivitas('Delete', 320);
        return Redirect::to('/main/perencanaan/infra/amdal');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 107,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
