<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010221Controller extends Controller
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
				if($item->kode_menu==71)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				
				$this->log_aktivitas('View', 202);
				return view('MAIN/bk010221/index',$data);
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
			0 =>'kode_forum',
			1 =>'kode_kegiatan',
			2 =>'lok_kegiatan',
			3 =>'tgl_kegiatan',
			4 =>'q_peserta_p',
			5 =>'q_peserta_w',
			6 =>'created_time',
			7 =>'created_by',
			8 =>'updated_time',
			9 =>'updated_by'
		);
		$query='select * from (
					select a.*, 
						c.nama nama_kota, 
						d.nama nama_kel, 
						case 
							when a.kode_kegiatan = "2.6.1.2.3" then "Pertemuan Rutin"
							when a.kode_kegiatan = "2.6.1.2.4" then "Kegiatan Monitoring"
						end jenis_kegiatan
					from  bkt_01020213_f_forum_kel a 
						left join bkt_01020212_forum_kel b on a.kode_forum=b.kode
						left join bkt_01010102_kota c on b.kode_kota=c.kode
						left join bkt_01010104_kel d on b.kode_kel=d.kode) x ';
		$totalData = DB::select('select count(1) cnt
								from  bkt_01020213_f_forum_kel a 
									left join bkt_01020212_forum_kel b on a.kode_forum=b.kode
									left join bkt_01010102_kota c on b.kode_kota=c.kode
									left join bkt_01010104_kel d on b.kode_kel=d.kode ');
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
					x.kode like "%'.$search.'%" or 
					x.kode_forum like "%'.$search.'%" or 
					x.jenis_kegiatan like "%'.$search.'%" or
					x.nama_kota like "%'.$search.'%" or 
					x.nama_kel like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					x.kode like "%'.$search.'%" or 
					x.kode_forum like "%'.$search.'%" or 
					x.jenis_kegiatan like "%'.$search.'%" or
					x.nama_kota like "%'.$search.'%" or 
					x.nama_kel like "%'.$search.'%"
					)) a');
			$totalFiltered=$totalFiltered[0]->cnt;
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
				$url_show=url('/')."/main/persiapan/kelurahan/forum/keberfungsian/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/forum/keberfungsian/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kelurahan/forum/keberfungsian/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['jenis_forum'] = $post->kode_forum.'-'.$post->nama_kota.'-'.$post->nama_kel;
				$nestedData['kode_kegiatan'] = $post->jenis_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['jumlah_peserta'] = $post->q_peserta_p + $post->q_peserta_w;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==71)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['202'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['204'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['205'])){
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
				if($item->kode_menu==71)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['202'])){
				$rowData = DB::select('select * from bkt_01020213_f_forum_kel where kode='.$data['kode']);
				$data['detil_menu']='202';
				$data['kode_forum'] = $rowData[0]->kode_forum;
				$data['kode_forum_list'] = DB::select('select b.kode kode_forum, 
																c.nama nama_kota, c.kode, 
																d.nama nama_kel, d.kode 
														from bkt_01020213_f_forum_kel a 
															left join bkt_01020212_forum_kel b on a.kode_forum=b.kode
															left join bkt_01010102_kota c on b.kode_kota=c.kode 
															left join bkt_01010104_kel d on b.kode_kel=d.kode
														where a.kode='.$rowData[0]->kode);
				$data['kode_kegiatan'] = $rowData[0]->kode_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diser_tgl;
				$data['diket_oleh'] = $rowData[0]->diser_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh			;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010221/create',$data);
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
				if($item->kode_menu==71)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');

		if($data['kode']!=null && !empty($data['detil']['204'])){
			$rowData = DB::select('select * from bkt_01020213_f_forum_kel where kode='.$data['kode']);
			$data['detil_menu']='204';
			$data['kode_forum'] = $rowData[0]->kode_forum;
			$data['kode_forum_list'] = DB::select('select a.kode kode_forum, 
															b.nama nama_kota, b.kode, 
															c.nama nama_kel, c.kode 
													from bkt_01020212_forum_kel a, bkt_01010102_kota b, 
														bkt_01010104_kel c, 
														bkt_01020213_f_forum_kel d
													where a.kode_kota=b.kode and a.kode_kel=c.kode and d.kode='.$rowData[0]->kode);
			$data['kode_kegiatan'] = $rowData[0]->kode_kegiatan;
			$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
			$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
			$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
			$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
			$data['uri_img_document'] = $rowData[0]->uri_img_document;
			$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
			$data['diser_tgl'] = $rowData[0]->diser_tgl;
			$data['diser_oleh'] = $rowData[0]->diser_oleh;
			$data['diket_tgl'] = $rowData[0]->diser_tgl;
			$data['diket_oleh'] = $rowData[0]->diser_oleh;
			$data['diver_tgl'] = $rowData[0]->diver_tgl;
			$data['diver_oleh'] = $rowData[0]->diver_oleh			;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
			return view('MAIN/bk010221/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['203'])){
			$data['detil_menu']='203';
			$data['kode_forum'] = null;
			$data['kode_forum_list'] = DB::select('select a.kode kode_forum, 
															b.nama nama_kota, b.kode, 
															c.nama nama_kel, c.kode 
										from bkt_01020212_forum_kel a, 
												bkt_01010102_kota b, 
												bkt_01010104_kel c
										where a.kode_kota=b.kode and a.kode_kel=c.kode');
			$data['kode_kegiatan'] = null;
			$data['tgl_kegiatan'] = null;
			$data['lok_kegiatan'] = null;
			$data['q_peserta_p'] = null;
			$data['q_peserta_w'] = null;
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
			return view('MAIN/bk010221/create',$data);
			}else {
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

		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_01020213_f_forum_kel')->where('kode', $request->input('kode'))
			->update(['kode_forum' => $request->input('select-kode_forum-input'), 
				'kode_kegiatan' => $request->input('select-kode_kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keberfungsian'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keberfungsian'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 204);

		}else{
			DB::table('bkt_01020213_f_forum_kel')->insert(
       			['kode_forum' => $request->input('select-kode_forum-input'), 
				'kode_kegiatan' => $request->input('select-kode_kegiatan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl_kegiatan-input')),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'q_peserta_p' => $request->input('q_peserta_p-input'),
				'q_peserta_w' => $request->input('q_peserta_w-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keberfungsian'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/forumkolaborasi/keberfungsian'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 203);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020213_f_forum_kel')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 205);
        return Redirect::to('/main/persiapan/kelurahan/forum/keberfungsian');
    }

    public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 71,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
