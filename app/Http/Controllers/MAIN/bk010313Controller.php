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
				if($item->kode_menu==106)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 313);
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
			0 => 'lpt_l_hibah_gov',
			1 => 'lpt_l_hibah_masy',
			2 => 'lpt_l_hibah_lain',
			3 => 'lpt_l_ijin_pakai_gov',
			4 => 'lpt_l_ijin_pakai_masy',
			5 => 'lpt_l_ijin_pakai_lain',
			6 => 'lpt_l_dilalui_gov',
			7 => 'lpt_l_dilalui_masy',
			8 => 'lpt_l_dilalui_lain',
			9 => 'lpt_rp_nilai_gov',
			1 => 'lpt_rp_nilai_masy',
			10 => 'lpt_rp_nilai_lain',
			11 => 'lpt_q_pt_kk_hibah',
			12 => 'lpt_q_pt_kk_ijin_pakai',
			13 => 'lpt_q_pt_kk_ijin_dilalui',
			14 => 'kl_lt_pre',
			15 => 'kl_lt_pos',
			16 => 'kl_q_peserta',
			17 => 'kl_q_peserta_w',
			18 => 'pk_lt_pre',
			19 => 'pk_lt_pos',
			20 => 'pk_q_peserta',
			21 => 'pk_q_peserta_w',
			22 => 'mha_q_jiwa',
			23 => 'mha_q_jiwa_w',
			24 => 'mha_q_wtp',
			25 => 'mha_q_wtp_w',
			26 => 'mha_q_wpm',
			27 => 'mha_q_wpm_w',
			28 => 'mha_flag_rk_mha',
			29 => 'dl_flag_ukl_upl',
			30 => 'dl_flag_sop',
			31 => 'cb_flag_di_kaw_cb',
			32 => 'cb_flag_sop',
			33 => 'rb_flag_di_kaw_rb',
			34 => 'dl_flag_sop',
			35 => 'pk_flag_pakai_kayu',
			36 => 'pk_vol_kayu',
			37 => 'lk_flag_legal_kayu',
			38 => 'lk_vol_kayu_legal',
			39 => 'uri_img_document',
			40 => 'uri_img_absensi',
			41 => 'diser_tgl',
			42 => 'diser_oleh',
			43 => 'diket_tgl',
			44 => 'diket_oleh',
			45 => 'diver_tgl',
			46 => 'diver_oleh',
			47 => 'created_time',
			48 => 'created_by',
			49 => 'updated_time',
			50 => 'updated_by'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel 
			from bkt_01030209_pkt_krj_kontraktor a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010110_kec d, 
				bkt_01010110_kmw e,
				bkt_01010104_kel f,
				bkt_01010113_faskel g 
			where b.kode=a.kode_kota and c.kode=a.kode_korkot and d.kode=a.kode_kec and e.kode=a.kode_kmw and f.kode=kode_kel and g.kode=kode_faskel ';
			
		$totalData = DB::select('select count(1) cnt from bkt_01030208_usulan_keg_kt ');
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

				$url_edit=url('/')."/main/perencanaan/rencana_kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/rencana_kegiatan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['skala_kegiatan'] = $post->skala_kegiatan;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->kode_kec;
				$nestedData['nama_kmw'] = $post->kode_kmw;
				$nestedData['kode_kel'] = $post->kode_kel;
				$nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['jenis_komponen_keg'] = $post->jenis_komponen_keg;
				$nestedData['kode_kegiatan'] = $post->kode_kegiatan;
				$nestedData['id_subkomponen'] = $post->id_subkomponen;
				$nestedData['id_dtl_subkomponen'] = $post->id_dtl_subkomponen;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['dk_vol_kegiatan'] = $post->dk_vol_kegiatan;
				$nestedData['dk_satuan'] = $post->dk_satuan;
				$nestedData['dk_tipe_penanganan'] = $post->dk_tipe_penanganan;
				$nestedData['nb_apbn_nsup'] = $post->nb_apbn_nsup;
				$nestedData['nb_apbn_lain'] = $post->nb_apbn_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_lainya'] = $post->nb_lainya;
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
						if($item->kode_menu==106)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['315'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['316'])){
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
		// if(!empty($request->input('prop'))){
		// 	$kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prop'));
		// 	echo json_encode($kota);
		// }
		// else if(!empty($request->input('kota'))){
		// 	$kota = DB::select('select b.* from bkt_01010112_kota_korkot a,bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
		// 	echo json_encode($kota);
		// }
		// else if(!empty($request->input('korkot'))){
		// 	$kota = DB::select('select a.* from bkt_01010103_kec a where a.kode_kota='.$request->input('korkot'));
		// 	echo json_encode($kota);
		// }
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==106)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
			$data['kode_prop_list'] = $kode_prop;

			$id_kawasan = DB::select('select id, nama from bkt_01010123_kawasan');
			$data['id_kawasan_list'] = $id_kawasan;

			if($data['kode']!=null  && !empty($data['detil']['315'])){
				$rowData = DB::select('select * from bkt_01030209_pkt_krj_kontraktor where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_komponen_keg'] = $rowData[0]->jenis_komponen_keg;
				$data['kode_kegiatan'] = $rowData[0]->kode_kegiatan;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['dk_tipe_penanganan'] = $rowData[0]->dk_tipe_penanganan;
				$data['nb_apbn_nsup'] = $rowData[0]->nb_apbn_nsup;
				$data['nb_apbn_lain'] = $rowData[0]->nb_apbn_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;	
				$data['nb_lainya'] = $rowData[0]->nb_lainya;
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
				return view('MAIN/bk010312/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['314'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['kode_kegiatan'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['lok_kegiatan'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['dk_tipe_penanganan'] = null;
				$data['nb_apbn_nsup'] = null;
				$data['nb_apbn_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_lainya'] = null;
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
				return view('MAIN/bk010312/create',$data);
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
			DB::table('bkt_01030209_pkt_krj_kontraktor')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'kode_kegiatan' => $request->input('kode_kegiatan-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_tipe_penanganan' => $request->input('dk_tipe_penanganan-input'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup-input'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_lainya' => $request->input('nb_lainya-input'),
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

			$this->log_aktivitas('Update', 315);

		}else{
			DB::table('bkt_01030209_pkt_krj_kontraktor')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'kode_kegiatan' => $request->input('kode_kegiatan-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_tipe_penanganan' => $request->input('dk_tipe_penanganan-input'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup-input'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_lainya' => $request->input('nb_lainya-input'),
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

			$this->log_aktivitas('Create', 314);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030209_pkt_krj_kontraktor')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 315);
        return Redirect::to('/main/perencanaan/infra/penyiapan_paket');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 106,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
