<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010111Controller extends Controller
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
				if($item->kode_menu==28)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 44);
				return view('MAIN/bk010111/index',$data);
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
		return view('main/korkot',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'a.kode',
			1 =>'kode_kmw',
			2 =>'nama',
			3 =>'kodepos',
			4 =>'contact_person',
			5 =>'no_phone',
			6 =>'no_fax',
			7 =>'n0_hp1',
			8 =>'email1',
			9 =>'nama_pms'
		);
		$query='select a.*, b.nama nama_kmw, c.nama nama_pms
					from bkt_01010111_korkot a
					left join bkt_01010110_kmw b on a.kode_kmw=b.kode
					left join bkt_01010115_pms c on a.kode_pms=c.kode ';
		$totalData = DB::select('select count(1) cnt from bkt_01010111_korkot a
									left join bkt_01010110_kmw b on a.kode_kmw=b.kode
									left join bkt_01010115_pms c on a.kode_pms=c.kode ');
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
					a.nama like "%'.$search.'%" or 
					b.nama like "%'.$search.'%" or
					a.alamat like "%'.$search.'%" or 
					a.kodepos like "%'.$search.'%" or
					a.contact_person like "%'.$search.'%" or
					a.no_phone like "%'.$search.'%" or
					a.no_hp1 like "%'.$search.'%" or
					a.no_hp2 like "%'.$search.'%" or
					a.email1 like "%'.$search.'%" or
					a.email2 like "%'.$search.'%" or
					c.nama like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					a.nama like "%'.$search.'%" or 
					b.nama like "%'.$search.'%" or
					a.alamat like "%'.$search.'%" or 
					a.kodepos like "%'.$search.'%" or
					a.contact_person like "%'.$search.'%" or
					a.no_phone like "%'.$search.'%" or
					a.no_hp1 like "%'.$search.'%" or
					a.no_hp2 like "%'.$search.'%" or
					a.email1 like "%'.$search.'%" or
					a.email2 like "%'.$search.'%" or
					c.nama like "%'.$search.'%"
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
				$url_edit=url('/')."/main/korkot/create?kode=".$show;
				$url_delete=url('/')."/main/korkot/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama'] = $post->nama;
				$nestedData['kodepos'] = $post->kodepos;
				$nestedData['contact_person'] = $post->contact_person;
				$nestedData['no_phone'] = $post->no_phone;
				$nestedData['no_fax'] = $post->no_fax;
				$nestedData['no_hp1'] = $post->no_hp1;
				$nestedData['email1'] = $post->email1;
				$nestedData['nama_pms'] = $post->nama_pms;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==28)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['46'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['47'])){
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
				if($item->kode_menu==28)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kode_kmw_list = DB::select('select kode from bkt_01010110_kmw');
		$data['kode_kmw_list'] = $kode_kmw_list;

		$kode_pms_list = DB::select('select kode, nama from bkt_01010115_pms where status=1');
		$data['kode_pms_list'] = $kode_pms_list;

		if($data['kode']!=null && !empty($data['detil']['46'])){
			$rowData = DB::select('select * from bkt_01010111_korkot where kode='.$data['kode']);
			$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$data['nama'] = $rowData[0]->nama;
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
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010111/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['45'])){
			$data['kode_kmw'] = null;
			$data['nama'] = null;
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
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

		return view('MAIN/bk010111/create',$data);
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
			DB::table('bkt_01010111_korkot')->where('kode', $request->input('example-id-input'))
			->update(
				['kode_kmw' => $request->input('select-kode_kmw-input'),
				'nama' => $request->input('nama-input'),
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
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 46);

		}else{
			DB::table('bkt_01010111_korkot')->insert(
       			['kode_kmw' => $request->input('select-kode_kmw-input'),
				'nama' => $request->input('nama-input'),
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
       			'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 45);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010111_korkot')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 47);
        return Redirect::to('/main/korkot');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2,
				'kode_menu' => 28,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
