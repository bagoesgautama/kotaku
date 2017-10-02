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
        //$this->middleware('auth');
        // parent::__construct();
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['username'] = '';
	    if (Auth::check()) {
            $user = Auth::user();
            $data['username'] = Auth::user()->name;
        }
		return view('MAIN/bk010107/index',$data);
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

	public function Post(Request $request)
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
			13 => 'pms_nama',
			14 => 'pms_alamat',
			15 => 'tgl_akhir',
			16 => 'thn_apbd1',
			17 => 'thn_apbd2',
			18 => 'status',
			19 => 'project',
			20 => 'kode_departemen',
			21 => 'glosary_caption',
			22 => 'jenis_siklus',
			23 => 'created_time',
			24 => 'created_by',
			25 => 'update_time',
			26 => 'update_by'
		);
		$query='select * from bkt_01010107_slum_program ';
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
			$posts=DB::select($query. 'where name like "%'.$search.'%" or email like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. 'where name like "%'.$search.'%" or email like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/hrm/role_level/create?kode=".$show;
				$url_delete=url('/')."/hrm/role_level/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['deskripsi'] = $post->deskripsi;
				$nestedData['status'] = $post->status;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['update_time'] = $post->update_time;
				$nestedData['update_by'] = $post->update_by;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>
				                          &emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_02010101_role_level where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['deskripsi'] = $rowData[0]->deskripsi;
			$data['status'] = $rowData[0]->status;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['update_time'] = $rowData[0]->update_time;
			$data['update_by'] = $rowData[0]->update_by;
		}else{
			$data['nama'] = null;
			$data['deskripsi'] = null;
			$data['status'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['update_time'] = null;
			$data['update_by'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('HRM/main/role_level_create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_02010101_role_level')->where('kode', $request->input('example-id-input'))
			->update(['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
				]);

		}else{
			DB::table('bkt_02010101_role_level')->insert(
       			['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010101_role_level')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/hrm/role_level');
    }
}
