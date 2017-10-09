<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010223Controller extends Controller
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
				if($item->kode_menu==72)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				
				$this->log_aktivitas('View', 206);
				return view('MAIN/bk010223/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function show()
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('/main/persiapan/kelurahan/lembaga/tapp',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'tahun',
			1 =>'kode_kota',
			2 =>'kode_korkot',
			3 =>'kode_kec',
			4 =>'kode_kmw',
			5 =>'kode_kel',
			6 =>'kode_faskel',
			7 =>'id_kegiatan',
			8 =>'id_dtl_kegiatan',
			9 =>'tgl_kegiatan',
			10 =>'lok_kegiatan',
			11 =>'q_peserta_p',
			12 =>'q_peserta_w',
			13 =>'q_peserta_miskin',
			14 =>'diser_tgl',
			15 =>'diser_oleh',
			16 =>'diket_tgl',
			17 =>'diket_oleh',
			18 =>'diver_tgl',
			19 =>'diver_oleh',
			20 =>'created_time',
			21 =>'created_by',
			22 =>'updated_time',
			23 =>'updated_by'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel, h.nama nama_kegiatan 
			from bkt_01020215_lembaga_kel a, bkt_01010102_kota b, bkt_01010111_korkot c, bkt_01010103_kec d, bkt_01010110_kmw e, bkt_01010104_kel f, bkt_01010113_faskel g, bkt_01010118_kegiatan_kel h where b.kode=a.kode_kota and c.kode=a.kode_korkot and d.kode=a.kode_kec and e.kode=a.kode_kmw and f.kode=a.kode_kel and g.kode=a.kode_faskel and h.id=a.id_kegiatan';
		$totalData = DB::select('select count(1) cnt from bkt_01020215_lembaga_kel ');
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
			$posts=DB::select($query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/persiapan/kelurahan/lembaga/tapp/create?kode=".$show;
				$url_delete=url('/')."/main/persiapan/kelurahan/lembaga/tapp/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kel'] = $post->nama_kec;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['nama_kegiatan'] = $post->nama_kegiatan;
				$nestedData['id_dtl_kegiatan'] = $post->id_dtl_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['q_peserta_miskin'] = $post->q_peserta_miskin;
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
						if($item->kode_menu==72)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['208'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['209'])){
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
				if($item->kode_menu==72)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kode_kota = DB::select('select kode, nama from bkt_01010102_kota');
		$data['kode_kota_list'] = $kode_kota;

		$kode_korkot = DB::select('select kode, nama from bkt_01010111_korkot');
		$data['kode_korkot_list'] = $kode_korkot;

		$kode_kec = DB::select('select kode, nama from bkt_01010103_kec');
		$data['kode_kec_list'] = $kode_kec;

		$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
		$data['kode_kmw_list'] = $kode_kmw;

		$kode_kel = DB::select('select kode, nama from bkt_01010104_kel');
		$data['kode_kel_list'] = $kode_kel;

		$kode_faskel = DB::select('select kode, nama from bkt_01010113_faskel');
		$data['kode_faskel_list'] = $kode_faskel;

		$kode_id_kegiatan = DB::select('select id, nama from bkt_01010118_kegiatan_kel');
		$data['kode_id_kegiatan_list'] = $kode_id_kegiatan;

		$kode_id_dtl_kegiatan = DB::select('select id, nama from bkt_01010119_dtl_keg_kel');
		$data['kode_id_dtl_kegiatan_list'] = $kode_id_dtl_kegiatan;

		if($data['kode']!=null && !empty($data['detil']['208'])){
			$rowData = DB::select('select * from bkt_01020215_lembaga_kel where kode='.$data['kode']);
			$data['tahun'] = $rowData[0]->tahun;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$data['kode_kel'] = $rowData[0]->kode_kel;
			$data['kode_faskel'] = $rowData[0]->kode_faskel;
			$data['id_kegiatan'] = $rowData[0]->id_kegiatan;
			$data['id_dtl_kegiatan'] = $rowData[0]->id_dtl_kegiatan;
			$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
			$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
			$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
			$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
			$data['q_peserta_miskin'] = $rowData[0]->q_peserta_miskin;
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
			return view('MAIN/bk010223/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['207'])){
			$data['tahun'] = null;
			$data['kode_kota'] = null;
			$data['kode_korkot'] = null;
			$data['kode_kec'] = null;
			$data['kode_kmw'] = null;
			$data['kode_kel'] = null;
			$data['kode_faskel'] = null;
			$data['id_kegiatan'] = null;
			$data['id_dtl_kegiatan'] = null;
			$data['tgl_kegiatan'] = null;
			$data['lok_kegiatan'] = null;
			$data['q_peserta_p'] = null;
			$data['q_peserta_w'] = null;
			$data['q_peserta_miskin'] = null;
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
		
		return view('MAIN/bk010223/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01020215_lembaga_kel')->where('kode', $request->input('example-id-input'))
			->update(['tahun' => $request->input('example-tahun-input'), 
				'kode_kota' => $request->input('example-kode_kota-input'), 
				'kode_korkot' => $request->input('example-kode_korkot-input'), 
				'kode_kec' => $request->input('example-kode_kec-input'), 
				'kode_kmw' => $request->input('example-kode_kmw-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'id_kegiatan' => $request->input('example-id_kegiatan-input'),
				'id_dtl_kegiatan' => $request->input('example-id_dtl_kegiatan-input'),
				'tgl_kegiatan' => $request->input('example-tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('example-lok_kegiatan-input'),
				'q_peserta_p' => $request->input('example-q_peserta_p-input'),
				'q_peserta_w' => $request->input('example-q_peserta_w-input'),
				'q_peserta_miskin' => $request->input('example-q_peserta_miskin-input'),
				'diser_tgl' => $request->input('diser_tgl'),
				'diser_oleh' => $request->input('example-diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl'),
				'diket_oleh' => $request->input('example-diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl'),
				'diver_oleh' => $request->input('example-diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 208);

		}else{
			DB::table('bkt_01020215_lembaga_kel')->insert(
       			['tahun' => $request->input('example-tahun-input'), 
				'kode_kota' => $request->input('example-kode_kota-input'), 
				'kode_korkot' => $request->input('example-kode_korkot-input'), 
				'kode_kec' => $request->input('example-kode_kec-input'), 
				'kode_kmw' => $request->input('example-kode_kmw-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'id_kegiatan' => $request->input('example-id_kegiatan-input'),
				'id_dtl_kegiatan' => $request->input('example-id_dtl_kegiatan-input'),
				'tgl_kegiatan' => $request->input('example-tgl_kegiatan-input'),
				'lok_kegiatan' => $request->input('example-lok_kegiatan-input'),
				'q_peserta_p' => $request->input('example-q_peserta_p-input'),
				'q_peserta_w' => $request->input('example-q_peserta_w-input'),
				'q_peserta_miskin' => $request->input('example-q_peserta_miskin-input'),
				'diser_tgl' => $request->input('diser_tgl'),
				'diser_oleh' => $request->input('example-diser_oleh-input'),
				'diket_tgl' => $request->input('diket_tgl'),
				'diket_oleh' => $request->input('example-diket_oleh-input'),
				'diver_tgl' => $request->input('diver_tgl'),
				'diver_oleh' => $request->input('example-diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 207);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020215_lembaga_kel')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 209);
        return Redirect::to('/main/persiapan/kelurahan/lembaga/tapp');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 72,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
