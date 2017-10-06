<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010114Controller extends Controller
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
				if($item->kode_menu==31)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 56);
				return view('MAIN/bk010114/index',$data);
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
		return view('/main/kel_faskel',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_kmp_slum_prog',
			1 =>'kode_faskel',
			2 =>'kode_kel',
			3 =>'blm',
			4 =>'jenis_project',
			5 =>'tahun_glossary',
			6 =>'tahun_project',
			7 =>'awal_project',
			8 =>'kode_ms',
			9 =>'kode_kec',
			10 =>'kode_kota',
			11 =>'kode_prop',
			12 =>'lokasi_blm',
			13 =>'Lokasi_kumuh',
			14 =>'flag_kumuh',
			15 =>'flag_lokasi_ppmk',
			16 =>'created_time',
			17 =>'created_by',
			18 =>'update_time',
			19 =>'update_by'
		);
		$query='select a.*, b.nama nama_faskel, c.nama nama_kel, d.nama nama_kec from bkt_01010114_kel_faskel a, bkt_01010113_faskel b, bkt_01010104_kel c, bkt_01010103_kec d where a.kode_faskel=b.kode and a.kode_kel=c.kode and a.kode_kec=d.kode';
		$totalData = DB::select('select count(1) cnt from bkt_01010114_kel_faskel ');
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
				$url_edit=url('/')."/main/kel_faskel/create?kode=".$show;
				$url_delete=url('/')."/main/kel_faskel/delete?kode=".$delete;
				$nestedData['kode_kmp_slum_prog'] = $post->kode_kmp_slum_prog;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['blm'] = $post->blm;
				$nestedData['jenis_project'] = $post->jenis_project;
				$nestedData['tahun_glossary'] = $post->tahun_glossary;
				$nestedData['tahun_project'] = $post->tahun_project;
				$nestedData['awal_project'] = $post->awal_project;
				$nestedData['kode_ms'] = $post->kode_ms;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['kode_prop'] = $post->kode_prop;
				$nestedData['lokasi_blm'] = $post->lokasi_blm;
				$nestedData['Lokasi_Kumuh'] = $post->Lokasi_Kumuh;
				$nestedData['flag_kumuh'] = $post->flag_kumuh;
				$nestedData['flag_lokasi_ppmk'] = $post->flag_lokasi_ppmk;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==31)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['58'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['59'])){
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
			$kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prov'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kota'))){
			$kota = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kec'))){
			$kota = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec'));
			echo json_encode($kota);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==31)
					$data['detil'][$item->kode_menu_detil]='a';
			}

			$data['username'] = '';
			$data['test']=true;
			$data['kode']=$request->input('kode');

			//get dropdown list from Database
			$kode_kmp_slum_program = DB::select('select kode from bkt_01010107_slum_program');
			$data['kode_kmp_slum_program_list'] = $kode_kmp_slum_program;

			$kode_faskel = DB::select('select kode, nama from bkt_01010113_faskel');
			$data['kode_faskel_list'] = $kode_faskel;

			/*$kode_kel = DB::select('select kode, nama from bkt_01010104_kel');
			$data['kode_kel_list'] = $kode_kel;

			$kode_kec = DB::select('select kode, nama from bkt_01010103_kec');
			$data['kode_kec_list'] = $kode_kec;

			$kode_kota = DB::select('select kode, nama from bkt_01010102_kota');
			$data['kode_kota_list'] = $kode_kota;*/

			$kode_prop = DB::select('select kode, nama from bkt_01010101_prop');
			$data['kode_prop_list'] = $kode_prop;

			if($data['kode']!=null && !empty($data['detil']['58'])){
				$rowData = DB::select('select * from bkt_01010114_kel_faskel where kode='.$data['kode']);
				$data['kode_kmp_slum_prog'] = $rowData[0]->kode_kmp_slum_prog;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['blm'] = $rowData[0]->blm;
				$data['jenis_project'] = $rowData[0]->jenis_project;
				$data['tahun_glossary'] = $rowData[0]->tahun_glossary;
				$data['tahun_project'] = $rowData[0]->tahun_project;
				$data['awal_project'] = $rowData[0]->awal_project;
				$data['kode_ms'] = $rowData[0]->kode_ms;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['lokasi_blm'] = $rowData[0]->lokasi_blm;
				$data['Lokasi_Kumuh'] = $rowData[0]->Lokasi_Kumuh;
				$data['flag_kumuh'] = $rowData[0]->flag_kumuh;
				$data['flag_lokasi_ppmk'] = $rowData[0]->flag_lokasi_ppmk;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('MAIN/bk010114/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['57'])){
				$data['kode_kmp_slum_prog'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kel'] = null;
				$data['blm'] = null;
				$data['jenis_project'] = null;
				$data['tahun_glossary'] = null;
				$data['tahun_project'] = null;
				$data['awal_project'] = null;
				$data['kode_ms'] = null;
				$data['kode_kec'] = null;
				$data['kode_kota'] = null;
				$data['kode_prop'] = null;
				$data['lokasi_blm'] = null;
				$data['Lokasi_Kumuh'] = null;
				$data['flag_kumuh'] = null;
				$data['flag_lokasi_ppmk'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;

				return view('MAIN/bk010114/create',$data);
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
			DB::table('bkt_01010114_kel_faskel')->where('kode', $request->input('example-id-input'))
			->update(['kode_kmp_slum_prog' => $request->input('example-kode_kmp_slum_prog-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'blm' => $request->input('example-select-blm'),
				'jenis_project' => $request->input('example-select-jenis_project'),
				'tahun_glossary' => $request->input('example-tahun_glossary-input'),
				'tahun_project' => $request->input('example-tahun_project-input'),
				'awal_project' => $request->input('example-awal_project-input'),
				'kode_ms' => $request->input('example-select-kode_ms'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_prop' => $request->input('example-kode_prop-input'),
				'lokasi_blm' => $request->input('example-select-lokasi_blm'),
				'Lokasi_kumuh' => $request->input('example-select-Lokasi_kumuh'),
				'flag_kumuh' => $request->input('example-select-flag_kumuh'),
				'flag_lokasi_ppmk' => $request->input('example-select-flag_lokasi_ppmk'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 58);

		}else{
			DB::table('bkt_01010114_kel_faskel')->insert(
       			['kode_kmp_slum_prog' => $request->input('example-kode_kmp_slum_prog-input'),
				'kode_faskel' => $request->input('example-kode_faskel-input'),
				'kode_kel' => $request->input('example-kode_kel-input'),
				'blm' => $request->input('example-select-blm'),
				'jenis_project' => $request->input('example-select-jenis_project'),
				'tahun_glossary' => $request->input('example-tahun_glossary-input'),
				'tahun_project' => $request->input('example-tahun_project-input'),
				'awal_project' => $request->input('example-awal_project-input'),
				'kode_ms' => $request->input('example-select-kode_ms'),
				'kode_kec' => $request->input('example-kode_kec-input'),
				'kode_kota' => $request->input('example-kode_kota-input'),
				'kode_prop' => $request->input('example-kode_prop-input'),
				'lokasi_blm' => $request->input('example-select-lokasi_blm'),
				'Lokasi_kumuh' => $request->input('example-select-Lokasi_kumuh'),
				'flag_kumuh' => $request->input('example-select-flag_kumuh'),
				'flag_lokasi_ppmk' => $request->input('example-select-flag_lokasi_ppmk'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 57);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010114_kel_faskel')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 59);
        return Redirect::to('/main/kel_faskel');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2,
				'kode_menu' => 31,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
