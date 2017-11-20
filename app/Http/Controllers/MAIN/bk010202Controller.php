<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010202Controller extends Controller
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
				if($item->kode_menu==48)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 64);
				return view('MAIN/bk010202/index',$data);
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
			1 =>'kode_pokja',
			2 =>'jenis_subkegiatan_convert',
			3 =>'tgl_kegiatan',
			4 =>'lok_kegiatan',
			5 =>'q_peserta_p',
			6 =>'q_peserta_w',
			7 =>'q_non_anggota_p',
			8 =>'q_non_anggota_w'
		);
		$query='
			select * from (select
				a.*,
				a.kode kode_f,
				case when a.jenis_subkegiatan="2.2.3.3" then "Pertemuan Rutin" when a.jenis_subkegiatan="2.2.3.4" then "Monitoring" end jenis_subkegiatan_convert,
				b.tahun tahun_pokja,
				b.kode kode_pokja_n,
				case when b.status_pokja=0 then "Pokja Lama" when b.status_pokja=1 then "Pokja Baru" end status_pokja_convert,
				c.nama nama_prop
			from bkt_01020203_fungsi_pokja a
				left join bkt_01020202_pokja b on a.kode_pokja = b.kode
				left join bkt_01010101_prop c on b.kode_prop = c.kode
			where
			b.jenis_kegiatan = "2.1") b';
		$totalData = DB::select('select count(1) cnt from bkt_01020203_fungsi_pokja a
				left join bkt_01020202_pokja b on a.kode_pokja = b.kode
				left join bkt_01010101_prop c on b.kode_prop = c.kode
			where
			b.jenis_kegiatan = "2.1"');
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
				b.kode_f like "%'.$search.'%" or
				b.jenis_subkegiatan_convert like "%'.$search.'%" or
				b.tgl_kegiatan_f like "%'.$search.'%" or
				b.lok_kegiatan_f like "%'.$search.'%" or
				b.tahun_pokja like "%'.$search.'%" or
				b.status_pokja_convert like "%'.$search.'%" or
				b.kode_pokja_n like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_f like "%'.$search.'%" or
				b.jenis_subkegiatan_convert like "%'.$search.'%" or
				b.tgl_kegiatan_f like "%'.$search.'%" or
				b.lok_kegiatan_f like "%'.$search.'%" or
				b.tahun_pokja like "%'.$search.'%" or
				b.status_pokja_convert like "%'.$search.'%" or
				b.kode_pokja_n like "%'.$search.'%")) a');
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

				$url_show=url('/')."/main/persiapan/nasional/pokja/kegiatan/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/nasional/pokja/kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/nasional/pokja/kegiatan/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['tahun'] = $post->tahun_pokja;
				$nestedData['jenis_subkegiatan_convert'] = $post->jenis_subkegiatan_convert;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['q_non_anggota'] = $post->q_non_anggota_p+$post->q_non_anggota_w;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==48)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['64'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['66'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['67'])){
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

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==48)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');

			if($data['kode']!=null  && !empty($data['detil']['64'])){
				$rowData = DB::select('select * from bkt_01020203_fungsi_pokja where kode='.$data['kode']);
				$data['detil_menu']='64';
				$data['kode_pokja'] = $rowData[0]->kode_pokja;
				$data['jenis_subkegiatan'] = $rowData[0]->jenis_subkegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_non_anggota_p'] = $rowData[0]->q_non_anggota_p;
				$data['q_non_anggota_w'] = $rowData[0]->q_non_anggota_w;
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
				$data['kode_pokja_list'] = DB::select('select *, case when status_pokja=0 then "Pokja Lama" when status_pokja=1 then "Pokja Baru" end status_pokja_convert from bkt_01020202_pokja where jenis_kegiatan = 2.1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010202/create',$data);
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
				if($item->kode_menu==48)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['kode_pokja_list'] = DB::select('select *, case when status_pokja=0 then "Pokja Lama" when status_pokja=1 then "Pokja Baru" end status_pokja_convert from bkt_01020202_pokja where jenis_kegiatan = 2.1');
			$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
			if($data['kode']!=null  && !empty($data['detil']['66'])){
				$rowData = DB::select('select * from bkt_01020203_fungsi_pokja where kode='.$data['kode']);
				$data['detil_menu']='66';
				$data['kode_pokja'] = $rowData[0]->kode_pokja;
				$data['jenis_subkegiatan'] = $rowData[0]->jenis_subkegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_non_anggota_p'] = $rowData[0]->q_non_anggota_p;
				$data['q_non_anggota_w'] = $rowData[0]->q_non_anggota_w;
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

				return view('MAIN/bk010202/create',$data);
			}else if($data['kode']==null  && !empty($data['detil']['65'])){
				$data['detil_menu']='65';
				$data['kode_pokja'] = null;
				$data['jenis_subkegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_non_anggota_p'] = null;
				$data['q_non_anggota_w'] = null;
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
				return view('MAIN/bk010202/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_document = $request->file('uri_img_document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uri_img_document-file') != null && $file_document == null){
			$uri_document = $request->input('uri_img_document-file');
			$upload_document = false;
		}elseif($request->input('uri_img_document-file') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uri_img_document-file') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('uri_img_absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uri_img_absensi-file') != null && $file_absensi == null){
			$uri_absensi = $request->input('uri_img_absensi-file');
			$upload_absensi = false;
		}elseif($request->input('uri_img_absensi-file') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uri_img_absensi-file') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020203_fungsi_pokja')->where('kode', $request->input('kode'))
			->update([
				'kode_pokja' => $request->input('kode-pokja-input'),
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_non_anggota_p' => $request->input('q-non-p-input'),
				'q_non_anggota_w' => $request->input('q-non-w-input'),
				'uri_img_document' => $uri_document,
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/nasional/pokja/monitoring'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/nasional/pokja/monitoring'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 66);

		}else{
			DB::table('bkt_01020203_fungsi_pokja')->insert([
				'kode_pokja' => $request->input('kode-pokja-input'),
				'jenis_subkegiatan' => $request->input('sub-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_non_anggota_p' => $request->input('q-non-p-input'),
				'q_non_anggota_w' => $request->input('q-non-w-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/nasional/pokja/monitoring'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/nasional/pokja/monitoring'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 65);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020203_fungsi_pokja')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 67);
        return Redirect::to('/main/persiapan/nasional/pokja/kegiatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 48,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
