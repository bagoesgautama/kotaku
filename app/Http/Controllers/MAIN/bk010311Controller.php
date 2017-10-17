<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010311Controller extends Controller
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
				if($item->kode_menu==94)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 297);
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
			1 => 'skala_kegiatan',
			2 => 'kode_kota',
			3 => 'kode_korkot',
			4 => 'kode_kec',
			5 => 'kode_kmw',
			6 => 'kode_kel',
			7 => 'kode_faskel',
			8 => 'jenis_kegiatan',
			9 => 'no_proposal',
			10 => 'tgl_proposal',
			11 => 'thn_anggaran',
			12 => 'kategori_penanganan',
			13 => 'jenis_komponen_keg',
			14 => 'id_subkomponen',
			15 => 'id_dtl_subkomponen',
			16 => 'dk_vol_kegiatan',
			17 => 'dk_satuan',
			18 => 'dk_lok_kegiatan',
			19 => 'dk_tgl_verivikasi',
			20 => 'nb_a_pupr_bdi_kolab',
			21 => 'nb_a_pupr_bdi_plbk',
			22 => 'nb_a_pupr_bdi_lain',
			23 => 'nb_a_pupr_nsup2',
			24 => 'nb_a_pupr_pkp',
			25 => 'nb_a_pupr_pkp_lain',
			26 => 'nb_apbn_kl_lain',
			27 => 'nb_apbd_prop',
			28 => 'nb_apbd_kota',
			29 => 'nb_dak',
			30 => 'nb_hibah',
			31 => 'nb_non_gov',
			32 => 'nb_masyarakat',
			33 => 'nb_lainya',
			34 => 'tpm_q_jiwa',
			35 => 'tpm_q_jiwa_w',
			36 => 'tpm_q_mbr',
			37 => 'tpm_q_kk',
			38 => 'tpm_q_kk_miskin',
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
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kmw, e.nama nama_faskel 
			from bkt_01030208_usulan_keg_kt a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010110_kmw d, 
				bkt_01010113_faskel e 
			where b.kode=a.kode_kota and c.kode=a.kode_korkot and d.kode=a.kode_kmw and e.kode=a.kode_faskel ';
			
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
				$nestedData['jenis_kegiatan'] = $post->jenis_kegiatan;
				$nestedData['no_propopsal'] = $post->no_propopsal;
				$nestedData['tgl_proposal'] = $post->tgl_proposal;
				$nestedData['thn_anggaran'] = $post->thn_anggaran;
				$nestedData['kategori_penanganan'] = $post->kategori_penanganan;
				$nestedData['jenis_komponen_keg'] = $post->jenis_komponen_keg;
				$nestedData['id_subkomponen'] = $post->id_subkomponen;
				$nestedData['id_dtl_subkomponen'] = $post->id_dtl_subkomponen;
				$nestedData['dk_vol_kegiatan'] = $post->dk_vol_kegiatan;
				$nestedData['dk_satuan'] = $post->dk_satuan;
				$nestedData['dk_lok_kegiatan'] = $post->dk_lok_kegiatan;
				$nestedData['dk_tgl_verivikasi'] = $post->kode_kaw_prior;
				$nestedData['nb_a_pupr_bdi_kolab'] = $post->nb_a_pupr_bdi_kolab;
				$nestedData['nb_a_pupr_bdi_plbk'] = $post->nb_a_pupr_bdi_plbk;
				$nestedData['nb_a_pupr_bdi_lain'] = $post->nb_a_pupr_bdi_lain;
				$nestedData['nb_a_pupr_nsup2'] = $post->nb_a_pupr_nsup2;
				$nestedData['nb_a_pupr_dir_pkp'] = $post->nb_a_pupr_dir_pkp;
				$nestedData['nb_a_pupr_dir_pkp_lain'] = $post->nb_a_pupr_dir_pkp_lain;
				$nestedData['nb_apbn_kl_lain'] = $post->nb_apbn_kl_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_dak'] = $post->nb_dak;
				$nestedData['nb_hibah'] = $post->nb_hibah;
				$nestedData['nb_non_gov'] = $post->nb_non_gov;
				$nestedData['nb_masyarakat'] = $post->nb_masyarakat;
				$nestedData['nb_lainya'] = $post->nb_lainya;
				$nestedData['tpm_q_jiwa'] = $post->tpm_q_jiwa;
				$nestedData['tpm_q_jiwa_w'] = $post->tpm_q_jiwa_w;
				$nestedData['tpm_q_mbr'] = $post->tpm_q_mbr;
				$nestedData['tpm_q_kk'] = $post->tpm_q_kk;
				$nestedData['tpm_q_kk_miskin'] = $post->$tpm_q_kk_miskin;
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
						if($item->kode_menu==94)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['299'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['300'])){
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
				if($item->kode_menu==94)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
			$data['kode_prop_list'] = $kode_prop;

			$id_kawasan = DB::select('select id, nama from bkt_01010123_kawasan');
			$data['id_kawasan_list'] = $id_kawasan;

			if($data['kode']!=null  && !empty($data['detil']['299'])){
				$rowData = DB::select('select * from bkt_01030208_usulan_keg_kt where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['no_propopsal'] = $rowData[0]->no_propopsal;
				$data['tgl_proposal'] = $rowData[0]->tgl_proposal;
				$data['thn_anggaran'] = $rowData[0]->thn_anggaran;
				$data['kategori_penanganan'] = $rowData[0]->kategori_penanganan;
				$data['jenis_komponen_keg'] = $rowData[0]->jenis_komponen_keg;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['dk_lok_kegiatan'] = $rowData[0]->dk_lok_kegiatan;
				$data['dk_tgl_verivikasi'] = $rowData[0]->dk_tgl_verivikasi;
				$data['nb_a_pupr_bdi_kolab'] = $rowData[0]->nb_a_pupr_bdi_kolab;
				$data['nb_a_pupr_bdi_plbk'] = $rowData[0]->nb_a_pupr_bdi_plbk;
				$data['nb_a_pupr_bdi_lain'] = $rowData[0]->nb_a_pupr_bdi_lain;
				$data['nb_a_pupr_nsup2'] = $rowData[0]->nb_a_pupr_nsup2;
				$data['nb_a_pupr_pkp'] = $rowData[0]->nb_a_pupr_pkp;
				$data['nb_a_pupr_pkp_lain'] = $rowData[0]->nb_a_pupr_pkp_lain;
				$data['nb_apbn_kl_lain'] = $rowData[0]->nb_apbn_kl_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_dak'] = $rowData[0]->nb_dak;
				$data['nb_hibah'] = $rowData[0]->nb_hibah;
				$data['nb_non_gov'] = $rowData[0]->nb_non_gov;
				$data['nb_masyarakat'] = $rowData[0]->nb_masyarakat;
				$data['nb_lainya'] = $rowData[0]->nb_lainya;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010311/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['298'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = null;
				$data['no_propopsal'] = null;
				$data['tgl_proposal'] = null;
				$data['thn_anggaran'] = null;
				$data['kategori_penanganan'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['dk_lok_kegiatan'] = null;
				$data['dk_tgl_verivikasi'] = null;
				$data['nb_a_pupr_bdi_kolab'] = null;
				$data['nb_a_pupr_bdi_plbk'] = null;
				$data['nb_a_pupr_bdi_lain'] = null;
				$data['nb_a_pupr_nsup2'] = null;
				$data['nb_a_pupr_pkp'] = null;
				$data['nb_a_pupr_pkp_lain'] = null;
				$data['nb_apbn_kl_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_dak'] = null;
				$data['nb_hibah'] = null;
				$data['nb_non_gov'] = null;
				$data['nb_masyarakat'] = null;
				$data['nb_lainya'] = null;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010311/create',$data);
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
			DB::table('bkt_01030208_usulan_keg_kt')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('jenis_kegiatan-input'),
				'no_propopsal' => $request->input('no_propopsal-input'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal-input')),
				'thn_anggaran' => $request->input('thn_anggaran-input'),
				'kategori_penanganan' => $request->input('kategori_penanganan-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan-input'),
				'dk_tgl_verivikasi' => $this->date_conversion($request->input('dk_tgl_verivikasi-input')),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_pkp' => $request->input('nb_a_pupr_pkp-input'),
				'nb_a_pupr_pkp_lain' => $request->input('nb_a_pupr_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainya' => $request->input('nb_lainya-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
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

			$this->log_aktivitas('Update', 299);

		}else{
			DB::table('bkt_01030208_usulan_keg_kt')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('jenis_kegiatan-input'),
				'no_propopsal' => $request->input('no_propopsal-input'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal-input')),
				'thn_anggaran' => $request->input('thn_anggaran-input'),
				'kategori_penanganan' => $request->input('kategori_penanganan-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan-input'),
				'dk_tgl_verivikasi' => $this->date_conversion($request->input('dk_tgl_verivikasi-input')),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_pkp' => $request->input('nb_a_pupr_pkp-input'),
				'nb_a_pupr_pkp_lain' => $request->input('nb_a_pupr_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainya' => $request->input('nb_lainya-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
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

			$this->log_aktivitas('Create', 298);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030208_usulan_keg_kt')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 300);
        return Redirect::to('/main/perencanaan/rencana_kegiatan');
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
