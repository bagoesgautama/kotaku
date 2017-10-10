<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010207Controller extends Controller
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
				if($item->kode_menu==52)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 80);
				return view('MAIN/bk010207/index',$data);
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
			0 =>'kode_pokja_kota',
			1 =>'jenis_subkegiatan',
			2 =>'tgl_kegiatan',
			3 =>'lok_kegiatan'
		);
		$query='select bkt_01020205_f_pokja_kota.kode, bkt_01020205_f_pokja_kota.kode_pokja_kota, bkt_01020205_f_pokja_kota.jenis_subkegiatan, bkt_01020205_f_pokja_kota.tgl_kegiatan, bkt_01020205_f_pokja_kota.lok_kegiatan from bkt_01020205_f_pokja_kota inner join bkt_01020204_pokja_kota on bkt_01020205_f_pokja_kota.kode_pokja_kota = bkt_01020204_pokja_kota.kode';
		$totalData = DB::select('select count(1) cnt from bkt_01020205_f_pokja_kota ');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkt_01020205_f_pokja_kota.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and bkt_01020205_f_pokja_kota.kode_pokja_kota like "%'.$search.'%" or bkt_01020205_f_pokja_kota.jenis_subkegiatan like "%'.$search.'%" or bkt_01020205_f_pokja_kota.tgl_kegiatan like "%'.$search.'%" or bkt_01020205_f_pokja_kota.lok_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and bkt_01020205_f_pokja_kota.kode_pokja_kota like "%'.$search.'%" or bkt_01020205_f_pokja_kota.jenis_subkegiatan like "%'.$search.'%" or bkt_01020205_f_pokja_kota.tgl_kegiatan like "%'.$search.'%" or bkt_01020205_f_pokja_kota.lok_kegiatan like "%'.$search.'%") a');
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

				if($post->jenis_subkegiatan == '2.2.3.3'){
					$jenis_kegiatan = 'Pertemuan Rutin';
				}elseif($post->jenis_subkegiatan == '2.2.3.4'){
					$jenis_kegiatan = 'Monitoring';
				}

				$url_edit=url('/')."/main/persiapan/kota/pokja/kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kota/pokja/kegiatan/delete?kode=".$delete;
				$nestedData['kode_pokja_kota'] = $post->kode_pokja_kota;
				$nestedData['jenis_subkegiatan'] = $jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==52)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['82'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['83'])){
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
				if($item->kode_menu==52)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['82'])){
				$rowData = DB::select('select * from bkt_01020205_f_pokja_kota where kode='.$data['kode']);
				$data['kode_pokja_kota'] = $rowData[0]->kode_pokja_kota;
				$data['jenis_subkegiatan'] = $rowData[0]->jenis_subkegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_opd'] = $rowData[0]->q_opd;
				$data['q_opd_w'] = $rowData[0]->q_opd_w;
				$data['q_pokja_prop'] = $rowData[0]->q_pokja_prop;
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
				$data['kode_pokja_kota_list'] = DB::select('select * from bkt_01020204_pokja_kota');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010207/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['81'])){
				$data['kode_pokja_kota'] = null;
				$data['jenis_subkegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_opd'] = null;
				$data['q_opd_w'] = null;
				$data['q_pokja_prop'] = null;
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
				$data['kode_pokja_kota_list'] = DB::select('select * from bkt_01020204_pokja_kota');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010207/create',$data);
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
			DB::table('bkt_01020205_f_pokja_kota')->where('kode', $request->input('kode'))
			->update([
				'kode_pokja_kota' => $request->input('kode-pokja-kota-input'), 
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_opd' => $request->input('q-opd-input'),
				'q_opd_w' => $request->input('q-opd-w-input'),
				'q_pokja_prop' => $request->input('q-pokja-prop-input'),
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
				$file_dokumen->move(public_path('/uploads/persiapan/kota/pokja/monitoring'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/pokja/monitoring'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 82);

		}else{
			DB::table('bkt_01020205_f_pokja_kota')->insert([
				'kode_pokja_kota' => $request->input('kode-pokja-kota-input'), 
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_opd' => $request->input('q-opd-input'),
				'q_opd_w' => $request->input('q-opd-w-input'),
				'q_pokja_prop' => $request->input('q-pokja-prop-input'),
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
				$file_dokumen->move(public_path('/uploads/persiapan/kota/pokja/monitoring'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/pokja/monitoring'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 81);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020205_f_pokja_kota')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 83);
        return Redirect::to('/main/persiapan/kota/pokja/kegiatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 52,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
