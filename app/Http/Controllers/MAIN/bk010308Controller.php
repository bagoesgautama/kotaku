<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010308Controller extends Controller
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
				if($item->kode_menu==88)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 281);
				return view('MAIN/bk010308/index',$data);
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
			0 =>'kode_parent',
			1 =>'created_time'
		);
		$query='select a.kode_parent, a.created_time from bkt_01030205_plan_amdal_sos a, bkt_01030204_plan_inves_thn b where a.kode_parent=b.kode and b.skala_kegiatan="1"';
		$totalData = DB::select('select count(1) cnt from bkt_01030205_plan_amdal_sos a, bkt_01030204_plan_inves_thn b where a.kode_parent=b.kode and b.skala_kegiatan="1"');
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
			$posts=DB::select($query. ' and (a.kode_parent like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.kode_parent like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode_parent;
				$edit =  $post->kode_parent;
				$delete = $post->kode_parent;

				$url_edit=url('/')."/main/perencanaan/penanganan/pengamanan_dampak/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/penanganan/pengamanan_dampak/delete?kode=".$delete;
				$nestedData['kode_parent'] = $post->kode_parent;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==88)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['283'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['284'])){
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
				if($item->kode_menu==88)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['283'])){
				$rowData = DB::select('select * from bkt_01030205_plan_amdal_sos where kode_parent='.$data['kode']);
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
				$data['kode_plan_inves_list'] = DB::select('select * from bkt_01030204_plan_inves_thn where skala_kegiatan=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010308/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['282'])){
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
				$data['kode_plan_inves_list'] = DB::select('select * from bkt_01030204_plan_inves_thn where skala_kegiatan=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010308/create',$data);
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
			DB::table('bkt_01030205_plan_amdal_sos')->where('kode', $request->input('kode'))
			->update([
				'kode_parent' => $request->input('kode-plan-inves-input'),
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
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/pengamanan_dampak'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/pengamanan_dampak'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 283);

		}else{
			DB::table('bkt_01030205_plan_amdal_sos')->insert([
				'kode_parent' => $request->input('kode-plan-inves-input'),
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
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/pengamanan_dampak'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/pengamanan_dampak'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 282);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030205_plan_amdal_sos')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 284);
        return Redirect::to('/main/perencanaan/penanganan/pengamanan_dampak');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 88,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
