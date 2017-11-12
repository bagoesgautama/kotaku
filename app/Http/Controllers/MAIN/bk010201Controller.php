<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010201Controller extends Controller
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
				if($item->kode_menu==47)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 60);
				return view('MAIN/bk010201/index',$data);
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
			1 =>'tahun',
			2 =>'tgl_kegiatan',
			3 =>'status_pokja',
			4 =>'q_anggota_p',
			5 =>'q_anggota_w'
		);
		$query='
			select * from (select
				kode,
				q_anggota_p,
				q_anggota_w,
				kode kode_pokja,
				tahun tahun_pokja,
				tgl_kegiatan tgl_kegiatan_pokja,
				case when status_pokja=0 then "Pokja Lama" when status_pokja=1 then "Pokja Baru" end status_pokja_convert,
				case when jenis_kegiatan="2.1" then "Tingkat Nasional" when jenis_kegiatan="2.2" then "Tingkat Propinsi" end jenis_kegiatan_convert
			from bkt_01020202_pokja
			where jenis_kegiatan = 2.1) b';
		$totalData = DB::select('select count(1) cnt from bkt_01020202_pokja
			where jenis_kegiatan = 2.1');
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
				b.kode_pokja like "%'.$search.'%" or
				b.status_pokja_convert like "%'.$search.'%" or
				b.tgl_kegiatan_pokja like "%'.$search.'%" or
				b.tahun_pokja like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_pokja like "%'.$search.'%" or
				b.status_pokja_convert like "%'.$search.'%" or
				b.tgl_kegiatan_pokja like "%'.$search.'%" or
				b.tahun_pokja like "%'.$search.'%")) a');
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
				$url_show=url('/')."/main/persiapan/nasional/pokja/pembentukan/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/nasional/pokja/pembentukan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/nasional/pokja/pembentukan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_pokja;
				$nestedData['tahun'] = $post->tahun_pokja;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan_pokja;
				$nestedData['status_pokja'] = $post->status_pokja_convert;
				$nestedData['q_anggota_p'] = $post->q_anggota_p;
				$nestedData['q_anggota_w'] = $post->q_anggota_w;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==47)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				//show
				if(!empty($detil['60'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['62'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['63'])){
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
		if(!empty($request->input('prov'))){
			$kmw = DB::select('select kode, nama from bkt_01010110_kmw where kode_prop='.$request->input('prov'));
			echo json_encode($kmw);
		}
		if(!empty($request->input('kmw'))){
			$faskel = DB::select('select kode, nama from bkt_01010113_faskel where kode_kmw='.$request->input('kmw'));
			echo json_encode($faskel);
		}
	}

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==47)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');

			if($data['kode']!=null  && !empty($data['detil']['60'])){
				$rowData = DB::select('select * from bkt_01020202_pokja where kode='.$data['kode']);
				//show
				$data['detil_menu']='60';
				$data['tahun'] = $rowData[0]->tahun;
				// $data['kode_prop'] = $rowData[0]->kode_prop;
				// $data['kode_kmw'] = $rowData[0]->kode_kmw;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['status_pokja'] = $rowData[0]->status_pokja;
				$data['ds_hkm'] = $rowData[0]->ds_hkm;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['upp_kl'] = $rowData[0]->upp_kl;
				$data['upp_dinas'] = $rowData[0]->upp_dinas;
				$data['upp_dpr'] = $rowData[0]->upp_dpr;
				$data['upn_lsm'] = $rowData[0]->upn_lsm;
				$data['unp_bu'] = $rowData[0]->unp_bu;
				$data['upn_praktisi'] = $rowData[0]->upn_praktisi;
				$data['nilai_dana_ops'] = $rowData[0]->nilai_dana_ops;
				$data['flag_sekretariat'] = $rowData[0]->flag_sekretariat;
				$data['url_rencana_kerja'] = $rowData[0]->url_rencana_kerja;
				$data['ket_rencana_kerja'] = $rowData[0]->ket_rencana_kerja;
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
				$data['flag_sekretariat'] = $rowData[0]->flag_sekretariat;
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010201/create',$data);
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
				if($item->kode_menu==47)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null  && !empty($data['detil']['62'])){
				$rowData = DB::select('select * from bkt_01020202_pokja where kode='.$data['kode']);
				$data['detil_menu']='62';
				$data['tahun'] = $rowData[0]->tahun;
				// $data['kode_prop'] = $rowData[0]->kode_prop;
				// $data['kode_kmw'] = $rowData[0]->kode_kmw;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['status_pokja'] = $rowData[0]->status_pokja;
				$data['ds_hkm'] = $rowData[0]->ds_hkm;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['upp_kl'] = $rowData[0]->upp_kl;
				$data['upp_dinas'] = $rowData[0]->upp_dinas;
				$data['upp_dpr'] = $rowData[0]->upp_dpr;
				$data['upn_lsm'] = $rowData[0]->upn_lsm;
				$data['unp_bu'] = $rowData[0]->unp_bu;
				$data['upn_praktisi'] = $rowData[0]->upn_praktisi;
				$data['nilai_dana_ops'] = $rowData[0]->nilai_dana_ops;
				$data['flag_sekretariat'] = $rowData[0]->flag_sekretariat;
				$data['url_rencana_kerja'] = $rowData[0]->url_rencana_kerja;
				$data['ket_rencana_kerja'] = $rowData[0]->ket_rencana_kerja;
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
				$data['flag_sekretariat'] = $rowData[0]->flag_sekretariat;
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010201/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['61'])){
				$data['detil_menu']='61';
				$data['tahun'] = null;
				// $data['kode_prop'] = null;
				// $data['kode_kmw'] = null;
				// $data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = '2.1';
				$data['tgl_kegiatan'] = null;
				$data['status_pokja'] = null;
				$data['ds_hkm'] = null;
				$data['q_anggota_p'] = 0;
				$data['q_anggota_w'] = 0;
				$data['upp_kl'] = 0;
				$data['upp_dinas'] = 0;
				$data['upp_dpr'] = 0;
				$data['upn_lsm'] = 0;
				$data['unp_bu'] = 0;
				$data['upn_praktisi'] = 0;
				$data['nilai_dana_ops'] = 0;
				$data['flag_sekretariat'] = null;
				$data['url_rencana_kerja'] = null;
				$data['ket_rencana_kerja'] = null;
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
				$data['flag_sekretariat'] = null;
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010201/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$find = DB::select('select count(kode) as cnt from bkt_01020202_pokja where tahun='.$request->input('tahun-input').' and status_pokja='.$request->input('status-pokja-input'));
		if($find[0]->cnt > 0){
			header("HTTP/1.0 500 Tahun POKJA ".$request->input('tahun-input')." Tidak boleh memiliki status yang sama.");
 			exit();
		}else{
			$file_rnckerja = $request->file('rencana-kerja-input');
			$url_rnckerja = null;
			$upload_rnckerja = false;
			if($request->input('uploaded-file-rnckerja') != null && $file_rnckerja == null){
				$url_rnckerja = $request->input('uploaded-file-rnckerja');
				$upload_rnckerja = false;
			}elseif($request->input('uploaded-file-rnckerja') != null && $file_rnckerja != null){
				$url_rnckerja = $file_rnckerja->getClientOriginalName();
				$upload_rnckerja = true;
			}elseif($request->input('uploaded-file-rnckerja') == null && $file_rnckerja != null){
				$url_rnckerja = $file_rnckerja->getClientOriginalName();
				$upload_rnckerja = true;
			}

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

<<<<<<< HEAD
			if ($request->input('kode')!=null){
				date_default_timezone_set('Asia/Jakarta');
				DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))
				->update([
					'tahun' => $request->input('tahun-input'), 
					// 'kode_prop' => ($request->input('kode-prop-input')=='undefined' ? null:$request->input('kode-prop-input')), 
					// 'kode_kmw' => ($request->input('kode-kmw-input')=='undefined' ? null:$request->input('kode-kmw-input')), 
					// 'kode_faskel' => ($request->input('kode-faskel-input')=='undefined' ? null:$request->input('kode-faskel-input')), 
					'jenis_kegiatan' => '2.1', 
					'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
					'status_pokja' => $request->input('status-pokja-input'), 
					'ds_hkm' => $request->input('dsr-pembentukan-input'),
					'q_anggota_p' => $request->input('q-laki-input'),
					'q_anggota_w' => $request->input('q-perempuan-input'),
					'upp_kl' => $request->input('upp-kementrian-input'),
					'upp_dinas' => $request->input('upp-dinas-input'),
					'upp_dpr' => $request->input('upp-dpr-input'),
					'upn_lsm' => $request->input('upnp-lsm-input'),
					'unp_bu' => $request->input('upnp-swasta-input'),
					'upn_praktisi' => $request->input('upnp-praktisi-input'),
					'nilai_dana_ops' => $request->input('dana-ops-input'),
					'flag_sekretariat' => intval($request->input('flag_sekretariat')),
					'url_rencana_kerja' => $url_rnckerja,
					'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
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
=======
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				// 'kode_prop' => ($request->input('kode-prop-input')=='undefined' ? null:$request->input('kode-prop-input')),
				// 'kode_kmw' => ($request->input('kode-kmw-input')=='undefined' ? null:$request->input('kode-kmw-input')),
				// 'kode_faskel' => ($request->input('kode-faskel-input')=='undefined' ? null:$request->input('kode-faskel-input')),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'status_pokja' => $request->input('status-pokja-input'),
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_kl' => $request->input('upp-kementrian-input'),
				'upp_dinas' => $request->input('upp-dinas-input'),
				'upp_dpr' => $request->input('upp-dpr-input'),
				'upn_lsm' => $request->input('upnp-lsm-input'),
				'unp_bu' => $request->input('upnp-swasta-input'),
				'upn_praktisi' => $request->input('upnp-praktisi-input'),
				'nilai_dana_ops' => $request->input('dana-ops-input'),
				'url_rencana_kerja' => $url_rnckerja,
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'flag_sekretariat' => (int)$request->input('flag_sekretariat-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
>>>>>>> 508fe13305da513c5e839094295cea2212432b3c

				if($upload_dokumen == true){
					$file_dokumen->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_dokumen->getClientOriginalName());
				}

				if($upload_absensi == true){
					$file_absensi->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_absensi->getClientOriginalName());
				}

				if($upload_rnckerja == true){
					$file_rnckerja->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_rnckerja->getClientOriginalName());
				}

				$this->log_aktivitas('Update', 62);

<<<<<<< HEAD
			}else{
				DB::table('bkt_01020202_pokja')->insert([
					'tahun' => $request->input('tahun-input'), 
					// 'kode_prop' => ($request->input('kode-prop-input')=='undefined' ? null:$request->input('kode-prop-input')), 
					// 'kode_kmw' => ($request->input('kode-kmw-input')=='undefined' ? null:$request->input('kode-kmw-input')), 
					// 'kode_faskel' => ($request->input('kode-faskel-input')=='undefined' ? null:$request->input('kode-faskel-input')), 
					'jenis_kegiatan' => '2.1', 
					'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
					'status_pokja' => $request->input('status-pokja-input'), 
					'ds_hkm' => $request->input('dsr-pembentukan-input'),
					'q_anggota_p' => $request->input('q-laki-input'),
					'q_anggota_w' => $request->input('q-perempuan-input'),
					'upp_kl' => $request->input('upp-kementrian-input'),
					'upp_dinas' => $request->input('upp-dinas-input'),
					'upp_dpr' => $request->input('upp-dpr-input'),
					'upn_lsm' => $request->input('upnp-lsm-input'),
					'unp_bu' => $request->input('upnp-swasta-input'),
					'upn_praktisi' => $request->input('upnp-praktisi-input'),
					'nilai_dana_ops' => $request->input('dana-ops-input'),
					'flag_sekretariat' => intval($request->input('flag_sekretariat')),
					'url_rencana_kerja' => $url_rnckerja,
					'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
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
=======
		}else{
			DB::table('bkt_01020202_pokja')->insert([
				'tahun' => $request->input('tahun-input'),
				// 'kode_prop' => ($request->input('kode-prop-input')=='undefined' ? null:$request->input('kode-prop-input')),
				// 'kode_kmw' => ($request->input('kode-kmw-input')=='undefined' ? null:$request->input('kode-kmw-input')),
				// 'kode_faskel' => ($request->input('kode-faskel-input')=='undefined' ? null:$request->input('kode-faskel-input')),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'status_pokja' => $request->input('status-pokja-input'),
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_kl' => $request->input('upp-kementrian-input'),
				'upp_dinas' => $request->input('upp-dinas-input'),
				'upp_dpr' => $request->input('upp-dpr-input'),
				'upn_lsm' => $request->input('upnp-lsm-input'),
				'unp_bu' => $request->input('upnp-swasta-input'),
				'upn_praktisi' => $request->input('upnp-praktisi-input'),
				'nilai_dana_ops' => $request->input('dana-ops-input'),
				'url_rencana_kerja' => $url_rnckerja,
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'flag_sekretariat' => (int)$request->input('flag_sekretariat-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);
>>>>>>> 508fe13305da513c5e839094295cea2212432b3c

				if($upload_dokumen == true){
					$file_dokumen->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_dokumen->getClientOriginalName());
				}

				if($upload_absensi == true){
					$file_absensi->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_absensi->getClientOriginalName());
				}

				if($upload_rnckerja == true){
					$file_rnckerja->move(public_path('/uploads/persiapan/nasional/pokja/pembentukan'), $file_rnckerja->getClientOriginalName());
				}

				$this->log_aktivitas('Create', 61);
			}
		}

		
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 63);
        return Redirect::to('/main/persiapan/nasional/pokja/pembentukan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 47,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
