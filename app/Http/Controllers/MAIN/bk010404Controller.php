<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010404Controller extends Controller
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
				if($item->kode_menu==116)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 358);
				return view('MAIN/bk010404/index',$data);
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
		if(!empty($request->input('kode_parent_tahun'))){
			$tahun = DB::select('select tahun from bkt_01040202_real_ktrk_krj where kode='.$request->input('kode_parent_tahun'));
			echo json_encode($tahun);
		}
		if(!empty($request->input('kode_parent_kmw'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01040202_real_ktrk_krj a, bkt_01010110_kmw b where a.kode_kmw=b.kode and a.kode='.$request->input('kode_parent_kmw'));
			echo json_encode($kmw);
		}
		if(!empty($request->input('kode_parent_kota'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01040202_real_ktrk_krj a, bkt_01010102_kota b where a.kode_kota=b.kode and a.kode='.$request->input('kode_parent_kota'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kode_parent_korkot'))){
			$korkot = DB::select('select b.kode, b.nama from bkt_01040202_real_ktrk_krj a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode='.$request->input('kode_parent_korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('kode_parent_kawasan'))){
			$kawasan = DB::select('select b.id, b.kode_kawasan, b.nama from bkt_01040202_real_ktrk_krj a, bkt_01010123_kawasan b where a.kode_kota=b.kode_kota and a.kode='.$request->input('kode_parent_kawasan'));
			echo json_encode($kawasan);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'kode_parent',
			2 =>'jns_sumber_dana',
			3 =>'kode_kmw',
			4 =>'kode_kota',
			5 =>'kode_korkot',
			6 =>'kode_kawasan',
			7 =>'id_kpp',
			8 =>'tahun',
			9 =>'tgl_realisasi',
			10 =>'vol_realisasi',
			11 =>'satuan',
			12 =>'hasil_sertifikasi',
			13 =>'created_time'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kmw, e.nama nama_kawasan, g.nama nama_kpp
			from bkt_01040202_real_ktrk_krj a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010110_kmw d,
				bkt_01010123_kawasan e,
				bkt_01010129_kpp g
			where b.kode=a.kode_kota and 
			c.kode=a.kode_korkot and  
			d.kode=a.kode_kmw and 
			e.id=a.kode_kawasan and
			g.id=a.id_kpp and
			a.jns_sumber_dana=1';
		$totalData = DB::select('select count(1) cnt from bkt_01040202_real_ktrk_krj a, bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010110_kmw d,
				bkt_01010123_kawasan e,
				bkt_01010129_kpp g
			where b.kode=a.kode_kota and 
			c.kode=a.kode_korkot and  
			d.kode=a.kode_kmw and 
			e.id=a.kode_kawasan and
			g.id=a.id_kpp and
			a.jns_sumber_dana=1');
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
			$posts=DB::select($query. ' and (a.kode like "%'.$search.'%" or a.kode_parent like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%" or a.hasil_sertifikasi like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.kode like "%'.$search.'%" or a.kode_parent like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%" or a.hasil_sertifikasi like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$hasil_sertifikasi = null;
				$jns_sumber_dana = null;

				if($post->jns_sumber_dana == '1'){
					$jns_sumber_dana = 'BDI / Non BDI';
				}elseif($post->jns_sumber_dana == '2'){
					$jns_sumber_dana = 'Non BDI Kolaborasi';
				}

				if($post->hasil_sertifikasi == 'KB'){
					$hasil_sertifikasi = 'Kualitas Baik';
				}elseif($post->hasil_sertifikasi == 'KC'){
					$hasil_sertifikasi = 'Kualitas Cukup';
				}elseif($post->hasil_sertifikasi == 'KK'){
					$hasil_sertifikasi = 'Kualitas Kurang';
				}

				$url_edit=url('/')."/main/pelaksanaan/kota_bdi/sertifikasi_infra/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kota_bdi/sertifikasi_infra/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['kode_parent'] = $post->kode_parent;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['id_kpp'] = $post->nama_kpp;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi;
				$nestedData['vol_realisasi'] = $post->vol_realisasi;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['hasil_sertifikasi'] = $hasil_sertifikasi;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==116)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['360'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['361'])){
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
				if($item->kode_menu==116)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['360'])){
				$rowData = DB::select('select * from bkt_01040202_real_ktrk_krj where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010404/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['359'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_kmw'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = '2.1';
				$data['tgl_kegiatan'] = null;
				$data['status_pokja'] = null;
				$data['ds_hkm'] = null;
				$data['q_anggota_p'] = null;
				$data['q_anggota_w'] = null;
				$data['upp_kl'] = null;
				$data['upp_dinas'] = null;
				$data['upp_dpr'] = null;
				$data['upn_lsm'] = null;
				$data['unp_bu'] = null;
				$data['upn_praktisi'] = null;
				$data['nilai_dana_ops'] = null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010404/create',$data);
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
			DB::table('bkt_01040202_real_ktrk_krj')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
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
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 360);

		}else{
			DB::table('bkt_01040202_real_ktrk_krj')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
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
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 359);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01040202_real_ktrk_krj')->where('kode', $request->input('kode'))->update('hasil_sertifikasi', null);
		$this->log_aktivitas('Delete', 361);
        return Redirect::to('/main/pelaksanaan/kota_bdi/sertifikasi_infra');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 116,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
