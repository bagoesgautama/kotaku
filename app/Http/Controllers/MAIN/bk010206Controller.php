<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010206Controller extends Controller
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
				if($item->kode_menu==51)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 76);
				return view('MAIN/bk010206/index',$data);
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
			2 =>'kode_kmw',
			3 =>'kode_kota',
			4 =>'kode_korkot',
			5 =>'kode_faskel',
			6 =>'jenis_kegiatan',
			7 =>'tgl_kegiatan',
			8 =>'status_pokja',
			9 =>'created_time'
		);
		$query='select a.kode, a.tahun, b.nama as kode_kmw, c.nama as kode_kota, d.nama as kode_korkot, e.nama as kode_faskel, a.jenis_kegiatan, a.tgl_kegiatan, a.status_pokja, a.created_time from bkt_01020204_pokja_kota a, bkt_01010110_kmw b, bkt_01010102_kota c, bkt_01010111_korkot d, bkt_01010113_faskel e where a.kode_kmw = b.kode and a.kode_kota = c.kode and a.kode_korkot = d.kode and a.kode_faskel = e.kode and c.status = 1';
		$totalData = DB::select('select count(1) cnt from bkt_01020204_pokja_kota a, bkt_01010110_kmw b, bkt_01010102_kota c, bkt_01010111_korkot d, bkt_01010113_faskel e where a.kode_kmw = b.kode and a.kode_kota = c.kode and a.kode_korkot = d.kode and a.kode_faskel = e.kode and c.status = 1');
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
			$posts=DB::select($query. ' and (a.tahun like "%'.$search.'%" or c.nama like "%'.$search.'%" or b.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.status_pokja like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.tahun like "%'.$search.'%" or c.nama like "%'.$search.'%" or b.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or e.nama like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.status_pokja like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$status_pokja = null;
				$jenis_kegiatan = null;

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

				$url_edit=url('/')."/main/persiapan/kota/pokja/pembentukan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kota/pokja/pembentukan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['kode_kmw'] = $post->kode_kmw;
				$nestedData['kode_korkot'] = $post->kode_korkot;
				$nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['jenis_kegiatan'] = $jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['status_pokja'] = $status_pokja;
				$nestedData['created_time'] = $post->created_time;
				
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==51)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['78'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['79'])){
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
			$kmw = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kmw);
		}
		if(!empty($request->input('kota_korkot')) && !empty($request->input('kmw_korkot'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot').' and b.kode_kmw='.$request->input('kmw_korkot'));
			echo json_encode($kmw);
		}
		if(!empty($request->input('korkot_faskel')) && !empty($request->input('kmw_faskel'))){
			$kmw = DB::select('select kode, nama from bkt_01010113_faskel where kode_korkot='.$request->input('korkot_faskel').' and kode_kmw='.$request->input('kmw_faskel'));
			echo json_encode($kmw);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==51)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['78'])){
				$rowData = DB::select('select * from bkt_01020204_pokja_kota where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['status_pokja'] = $rowData[0]->status_pokja;
				$data['ds_hkm'] = $rowData[0]->ds_hkm;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['upp_opd'] = $rowData[0]->upp_opd;
				$data['upp_dprd'] = $rowData[0]->upp_dprd;
				$data['upn_bkm'] = $rowData[0]->upn_bkm;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota.' and b.kode_kmw ='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_faskel_list']=DB::select('select kode, nama from bkt_01010113_faskel where kode_kmw='.$rowData[0]->kode_kmw);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010206/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['77'])){
				$data['tahun'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['status_pokja'] = null;
				$data['ds_hkm'] = null;
				$data['q_anggota_p'] = null;
				$data['q_anggota_w'] = null;
				$data['upp_opd'] = null;
				$data['upp_dprd'] = null;
				$data['upn_bkm'] = null;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010206/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
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

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020204_pokja_kota')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kota' => $request->input('kode-kota-input'), 
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_faskel' => $request->input('kode-faskel-input'), 
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'status_pokja' => $request->input('status-pokja-input'), 
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_opd' => $request->input('upp-opd-input'),
				'upp_dprd' => $request->input('upp-dprd-input'),
				'upn_bkm' => $request->input('upnp-bkm-input'),
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

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_absensi->getClientOriginalName());
			}

			if($upload_rnckerja == true){
				$file_rnckerja->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_rnckerja->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 78);

		}else{
			DB::table('bkt_01020204_pokja_kota')->insert([
				'tahun' => $request->input('tahun-input'), 
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kota' => $request->input('kode-kota-input'), 
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_faskel' => $request->input('kode-faskel-input'), 
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'status_pokja' => $request->input('status-pokja-input'), 
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_opd' => $request->input('upp-opd-input'),
				'upp_dprd' => $request->input('upp-dprd-input'),
				'upn_bkm' => $request->input('upnp-bkm-input'),
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

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_absensi->getClientOriginalName());
			}

			if($upload_rnckerja == true){
				$file_rnckerja->move(public_path('/uploads/persiapan/kota/pokja/pembentukan'), $file_rnckerja->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 77);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020204_pokja_kota')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 79);
        return Redirect::to('/main/persiapan/kota/pokja/pembentukan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 51,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
