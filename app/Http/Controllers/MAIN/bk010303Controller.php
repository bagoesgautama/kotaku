<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010303Controller extends Controller
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
				if($item->kode_menu==84)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 261);
				return view('MAIN/bk010303/index',$data);
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
			1 =>'kode_kota',
			2 =>'kode_kec',
			3 =>'kode_kmw',
			4 =>'kode_korkot',
			5 =>'jenis_kegiatan',
			6 =>'tgl_kegiatan',
			7 =>'lok_kegiatan'
		);
		$query='select a.kode, a.tahun, b.nama as kode_kota, c.nama as kode_kec, d.nama as kode_kmw, e.nama as kode_korkot, a.jenis_kegiatan, a.tgl_kegiatan, a.lok_kegiatan from bkt_01030201_plan_pmkm_kt a, bkt_01010102_kota b, bkt_01010103_kec c, bkt_01010110_kmw d, bkt_01010111_korkot e where a.kode_kota = b.kode and a.kode_kec = c.kode and a.kode_kmw = d.kode and a.kode_korkot = e.kode and a.jenis_kegiatan = "3.3.1"';
		$totalData = DB::select('select count(1) cnt from bkt_01030201_plan_pmkm_kt ');
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
			$posts=DB::select($query. ' or a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.lok_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' or a.tahun like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.lok_kegiatan like "%'.$search.'%") a');
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

				if($post->jenis_kegiatan == '3.1.1'){
					$jenis_kegiatan = 'Pembangunan Visi';
				}elseif($post->jenis_kegiatan == '3.1.2'){
					$jenis_kegiatan = 'Pelaksanaan RPK';
				}elseif($post->jenis_kegiatan == '3.3.1'){
					$jenis_kegiatan = 'Lokakarya Perencanaan';
				}elseif($post->jenis_kegiatan == '3.4'){
					$jenis_kegiatan = 'Konsultasi Perencanaan';
				}

				$url_edit=url('/')."/main/perencanaan/penanganan/lokakarya_perencanaan/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/penanganan/lokakarya_perencanaan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['kode_kec'] = $post->kode_kec;
				$nestedData['kode_kmw'] = $post->kode_kmw;
				$nestedData['kode_korkot'] = $post->kode_korkot;
				$nestedData['jenis_kegiatan'] = $jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==84)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['263'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['264'])){
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
				if($item->kode_menu==84)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['263'])){
				$rowData = DB::select('select * from bkt_01030201_plan_pmkm_kt where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
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
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010303/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['262'])){
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['jenis_kegiatan'] = '3.3.1';
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_peserta_mbr'] = null;
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
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010303/create',$data);
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
			DB::table('bkt_01030201_plan_pmkm_kt')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
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
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/lokakarya_perencanaan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/lokakarya_perencanaan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 263);

		}else{
			DB::table('bkt_01030201_plan_pmkm_kt')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
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
				$file_dokumen->move(public_path('/uploads/perencanaan/penanganan/lokakarya_perencanaan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/penanganan/lokakarya_perencanaan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 262);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030201_plan_pmkm_kt')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 264);
        return Redirect::to('/main/perencanaan/penanganan/lokakarya_perencanaan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 84,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
