<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010107Controller extends Controller
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
				if($item->kode_menu==24)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');
				
				$this->log_aktivitas('View', 28);
				return view('MAIN/bk010107/index',$data);
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
		return view('slum_program',$data);
	}

	public function post(Request $request)
	{
		$columns = array(
			0 =>'nourut',
			1 =>'nama',
			2 =>'keterangan',
			3 =>'kode_kota',
			4 =>'alamat',
			5 =>'kodepos',
			6 =>'contact_person',
			7 =>'no_phone',
			8 =>'no_fax',
			9 => 'no_hp1',
			10 => 'no_hp2',
			11 => 'email1',
			12 => 'email2',
			13 => 'kode_pms',
			14 => 'tgl_akhir',
			15 => 'tahun_',
			16 => 'status',
			17 => 'project',
			18 => 'kode_departemen',
			19 => 'glosary_caption',
			20 => 'jenis_siklus',
			21 => 'created_time',
			22 => 'created_by',
			23 => 'updated_time',
			24 => 'updated_by'
		);

		$query='select a.*, b.nama nama_kota from bkt_01010107_slum_program a, bkt_01010102_kota b where a.kode_kota=b.kode and a.status!=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010107_slum_program ');
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
			$posts=DB::select($query. ' and a.nama like "%'.$search.'%" or a.email1 like "%'.$search.'%" or no_hp1 like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.nama like "%'.$search.'%" or a.email1 like "%'.$search.'%" or a.no_hp1 like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/slum_program/create?kode=".$show;
				$url_delete=url('/')."/main/slum_program/delete?kode=".$delete;
				$nestedData['nourut'] = $post->nourut;
				$nestedData['nama'] = $post->nama;
				$nestedData['keterangan'] = $post->keterangan;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['kodepos'] = $post->kodepos;
				$nestedData['contact_person'] = $post->contact_person;
				$nestedData['no_phone'] = $post->no_phone;
				$nestedData['no_fax'] = $post->no_fax;
				$nestedData['no_hp1'] = $post->no_hp1;
				$nestedData['no_hp2'] = $post->no_hp2;
				$nestedData['email1'] = $post->email1;
				$nestedData['email2'] = $post->email2;
				$nestedData['kode_pms'] = $post->kode_pms;
				$nestedData['tgl_akhir'] = $post->tgl_akhir;
				$nestedData['tahun_'] = $post->tahun;
				$nestedData['status'] = $post->status;
				$nestedData['project'] = $post->project;
				$nestedData['kode_departemen'] = $post->kode_departemen;
				$nestedData['glosary_caption'] = $post->glosary_caption;
				$nestedData['jenis_siklus'] = $post->jenis_siklus;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==24)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['30'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['31'])){
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
				if($item->kode_menu==24)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = $user->name;
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kode_kota = DB::select('select kode, nama from bkt_01010102_kota where status=1');
		$data['kode_kota_list'] = $kode_kota;

		$kode_pms = DB::select('select kode, nama from bkt_01010115_pms where status=1');
		$data['kode_pms_list'] = $kode_pms;
		
		if($data['kode']!=null && !empty($data['detil']['30'])){
			$rowData = DB::select('select * from bkt_01010107_slum_program where kode='.$data['kode']);
			$data['nourut'] = $rowData[0]->nourut;
			$data['nama'] = $rowData[0]->nama;
			$data['keterangan'] = $rowData[0]->keterangan;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['alamat'] = $rowData[0]->alamat;
			$data['kodepos'] = $rowData[0]->kodepos;
			$data['contact_person'] = $rowData[0]->contact_person;
			$data['no_phone'] = $rowData[0]->no_phone;
			$data['no_fax'] = $rowData[0]->no_fax;
			$data['no_hp1'] = $rowData[0]->no_hp1;
			$data['no_hp2'] = $rowData[0]->no_hp2;
			$data['email1'] = $rowData[0]->email1;
			$data['email2'] = $rowData[0]->email2;
			$data['kode_pms'] = $rowData[0]->kode_pms;
			$data['tgl_akhir'] = $rowData[0]->tgl_akhir;
			$data['tahun'] = $rowData[0]->tahun_apbd1;
			$data['status'] = $rowData[0]->status;
			$data['project'] = $rowData[0]->project;
			$data['kode_departemen'] = $rowData[0]->kode_departemen;
			$data['glosary_caption'] = $rowData[0]->glosary_caption;
			$data['jenis_siklus'] = $rowData[0]->jenis_siklus;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010107/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['29'])){
			$data['nourut'] = null;
			$data['nama'] = null;
			$data['keterangan'] = null;
			$data['kode_kota'] = null;
			$data['alamat'] = null;
			$data['kodepos'] = null;
			$data['contact_person'] = null;
			$data['no_phone'] = null;
			$data['no_fax'] = null;
			$data['no_hp1'] = null;
			$data['no_hp2'] = null;
			$data['email1'] = null;
			$data['email2'] = null;
			$data['kode_pms'] = null;
			$data['tgl_akhir'] = null;
			$data['tahun'] = null;
			$data['status'] = null;
			$data['project'] = null;
			$data['kode_departemen'] = null;
			$data['glosary_caption'] = null;
			$data['jenis_siklus'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

			return view('MAIN/bk010107/create',$data);
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
			$date = strtotime($request->input('tgl_akhir-input'));
        	$date_convert = date('Y-m-d', $date);
			DB::table('bkt_01010107_slum_program')->where('kode', $request->input('example-id-input'))
			->update(
				['nourut' => $request->input('no_urut-input'),
				'nama' => $request->input('nama-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'alamat' => $request->input('alamat-input'),
				'kodepos' => $request->input('kodepos-input'),
				'contact_person' => $request->input('contact_person-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_fax' => $request->input('no_fax-input'),
				'no_hp1' => $request->input('no_hp1-input'),
				'no_hp2' => $request->input('no_hp2-input'),
				'email1' => $request->input('email1-input'),
				'email2' => $request->input('email2-input'),
				'kode_pms' => $request->input('select-kode_pms-input'),
				'tgl_akhir' => $date_convert,
				'tahun' => $request->input('tahun-input'),
				'status' => $request->input('select-status-input'),
				'project' => $request->input('project-input'),
				'kode_departemen' => $request->input('select-kode_departemen-input'),
				'glosary_caption' => $request->input('glosary_caption-input'),
				'jenis_siklus' => $request->input('select-jenis_siklus-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 30);
		}else{
			$date = strtotime($request->input('tgl_akhir-input'));
        	$date_convert = date('Y-m-d', $date);
			DB::table('bkt_01010107_slum_program')->insert(
       			['nourut' => $request->input('no_urut-input'),
				'nama' => $request->input('nama-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'alamat' => $request->input('alamat-input'),
				'kodepos' => $request->input('kodepos-input'),
				'contact_person' => $request->input('contact_person-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_fax' => $request->input('no_fax-input'),
				'no_hp1' => $request->input('no_hp1-input'),
				'no_hp2' => $request->input('no_hp2-input'),
				'email1' => $request->input('email1-input'),
				'email2' => $request->input('email2-input'),
				'kode_pms' => $request->input('select-kode_pms-input'),
				'tgl_akhir' => $date_convert,
				'tahun' => $request->input('tahun-input'),
				'status' => $request->input('select-status-input'),
				'project' => $request->input('project-input'),
				'kode_departemen' => $request->input('select-kode_departemen-input'),
				'glosary_caption' => $request->input('glosary_caption-input'),
				'jenis_siklus' => $request->input('select-jenis_siklus-input'),
       			'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 29);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010107_slum_program')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 31);
        return Redirect::to('main/slum_program');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2, 
				'kode_menu' => 24,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
