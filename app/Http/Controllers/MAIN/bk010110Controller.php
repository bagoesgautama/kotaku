<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010110Controller extends Controller
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
				if($item->kode_menu==27)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 40);
				return view('MAIN/bk010110/index',$data);
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
		return view('main/kmw',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'a.kode',
			1 =>'slum_program',
			2 =>'kode_prop',
			3 =>'nama',
			4 =>'alamat',
			5 =>'kodepos',
			6 =>'contact_person',
			7 =>'no_phone',
			8 =>'no_fax',
			9 =>'no_hp1',
			11 =>'email1',
		);

		$query='select a.*, b.nama nama_prop, c.nama nama_pms,d.nama slum_program
					from bkt_01010110_kmw a left join bkt_01010101_prop b on b.kode=a.kode_prop
					left join bkt_01010115_pms c on c.kode=a.kode_pms
					left join (select a1.kode,b1.nama from bkt_01010109_kmp_slum_prog a1,bkt_01010107_slum_program b1 where a1.kode_slum_prog=b1.kode) d on a.kode_kmp_slum_prog=d.kode ';
		$totalData = DB::select('select count(1) cnt from bkt_01010110_kmw ');
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
			$posts=DB::select($query. 'where nama like "%'.$search.'%" or email1 like "%'.$search.'%" or no_hp1 like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. 'where nama like "%'.$search.'%" or email1 like "%'.$search.'%" or no_hp1 like "%'.$search.'%") a');
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
				$url_edit=url('/')."/main/kmw/create?kode=".$show;
				$url_delete=url('/')."/main/kmw/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['slum_program'] = $post->slum_program;
				$nestedData['nama_prop'] = $post->nama_prop;
				$nestedData['nama'] = $post->nama;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['kodepos'] = $post->kodepos;
				$nestedData['contact_person'] = $post->contact_person;
				$nestedData['no_phone'] = $post->no_phone;
				$nestedData['no_fax'] = $post->no_fax;
				$nestedData['no_hp1'] = $post->no_hp1;
				$nestedData['no_hp2'] = $post->no_hp2;
				$nestedData['email1'] = $post->email1;
				$nestedData['email2'] = $post->email2;
				$nestedData['nama_pms'] = $post->nama_pms;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==27)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['42'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['43'])){
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
				if($item->kode_menu==27)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kmp_slum_prog_list = DB::select('select a1.kode,b1.nama from bkt_01010109_kmp_slum_prog a1,bkt_01010107_slum_program b1 where a1.kode_slum_prog=b1.kode');
		$data['kode_kmp_slum_prog_list'] = $kmp_slum_prog_list;

		$kode_prop_list = DB::select('select kode, nama from bkt_01010101_prop where status=1');
		$data['kode_prop_list'] = $kode_prop_list;

		$kode_pms_list = DB::select('select kode, nama from bkt_01010115_pms where status=1');
		$data['kode_pms_list'] = $kode_pms_list;

		if($data['kode']!=null && !empty($data['detil']['42'])){
			$rowData = DB::select('select * from bkt_01010110_kmw where kode='.$data['kode']);
			$data['kode_kmp_slum_prog'] = $rowData[0]->kode_kmp_slum_prog;
			$data['kode_prop'] = $rowData[0]->kode_prop;
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
			return view('MAIN/bk010110/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['41'])){
			$data['kode_kmp_slum_prog'] = null;
			$data['kode_prop'] = null;
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

		return view('MAIN/bk010110/create',$data);
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
			DB::table('bkt_01010110_kmw')->where('kode', $request->input('example-id-input'))
			->update(
				['kode_kmp_slum_prog' => $request->input('select-kode_kmp_slum_prog-input'),
				'kode_prop' => $request->input('select-kode_prop-input'),
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
			$this->log_aktivitas('Update', 42);

		}else{
			DB::table('bkt_01010110_kmw')->insert(
       			['kode_kmp_slum_prog' => $request->input('select-kode_kmp_slum_prog-input'),
				'kode_prop' => $request->input('select-kode_prop-input'),
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
			$this->log_aktivitas('Create', 41);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010110_kmw')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 43);
        return Redirect::to('main/kmw');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2,
				'kode_menu' => 27,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
