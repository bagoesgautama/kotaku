<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010312Controller extends Controller
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
				if($item->kode_menu==47)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

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
			0 =>'tahun',
			1 =>'kode_prop',
			2 =>'jenis_kegiatan',
			3 =>'tgl_kegiatan',
			4 =>'status_pokja'
		);
		$query='select bkt_01020202_pokja.kode, bkt_01020202_pokja.tahun, bkt_01010101_prop.nama as kode_prop, bkt_01020202_pokja.jenis_kegiatan, bkt_01020202_pokja.tgl_kegiatan, bkt_01020202_pokja.status_pokja from bkt_01020202_pokja inner join bkt_01010101_prop on bkt_01020202_pokja.kode_prop = bkt_01010101_prop.kode where bkt_01020202_pokja.jenis_kegiatan = 2.1';
		$totalData = DB::select('select count(1) cnt from bkt_01020202_pokja ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkt_01020202_pokja.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and bkt_01020202_pokja.tahun like "%'.$search.'%" or bkt_01020202_pokja.status_pokja like "%'.$search.'%" or bkt_01010101_prop.nama like "%'.$search.'%" or bkt_01020202_pokja.tgl_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and bkt_01020202_pokja.tahun like "%'.$search.'%" or bkt_01020202_pokja.status_pokja like "%'.$search.'%" or bkt_01010101_prop.nama like "%'.$search.'%" or bkt_01020202_pokja.tgl_kegiatan like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$jenis_kegiatan = null;
				$status_pokja = null;

				if($post->jenis_kegiatan == '2.1'){
					$jenis_kegiatan = 'Tingkat Nasional';
				}elseif($post->jenis_kegiatan == '2.2'){
					$jenis_kegiatan = 'Tingkat Propinsi';
				}

				if($post->status_pokja == 0){
					$status_pokja = 'Lama';
				}elseif($post->status_pokja == 1){
					$status_pokja = 'Baru';
				}

				$url_edit=url('/')."/main/persiapan/nasional/pokja/pembentukan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/nasional/pokja/pembentukan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_prop'] = $post->kode_prop;
				$nestedData['jenis_kegiatan'] = $jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['status_pokja'] = $status_pokja;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==47)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
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
			if($data['kode']!=null  && !empty($data['detil']['62'])){
				$rowData = DB::select('select * from bkt_01020202_pokja where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
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
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				return view('MAIN/bk010201/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['61'])){
				$data['tahun'] = null;
				$data['kode_prop'] = null;
				$data['kode_korkot'] = null;
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
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
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
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
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
				'url_rencana_kerja' => $request->input('rencana-kerja-input'),
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 62);

		}else{
			DB::table('bkt_01020202_pokja')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
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
				'url_rencana_kerja' => $request->input('rencana-kerja-input'),
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

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
