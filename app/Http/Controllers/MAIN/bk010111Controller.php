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
		return view('MAIN/bk010111/index',$data);
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
			0 =>'kode_kmw',
			1 =>'nama',
			2 =>'alamat',
			3 =>'kodepos',
			4 =>'contact_person',
			5 =>'no_phone',
			6 =>'no_fax',
			7 =>'n0_hp1',
			8 =>'no_hp2',
			9 =>'email1',
			10 =>'email2',
			11 =>'pms_nama',
			12 =>'pms_alamat',
			13 =>'created_time',
			14 =>'created_by',
			15 =>'updated_time',
			16 =>'updated_by'
		);
		$query='select * from bkt_01010111_korkot';
		$totalData = DB::select('select count(1) cnt from bkt_01010111_korkot');
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
				$url_edit=url('/')."/main/bk010111/create?kode=".$show;
				$url_delete=url('/')."/main/bk010111/delete?kode=".$delete;
				$nestedData['kode_kmw'] = $post->kode_kmw;
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
				$nestedData['pms_nama'] = $post->pms_nama;
				$nestedData['pms_alamat'] = $post->pms_alamat;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>
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
			$rowData = DB::select('select * from bkt_01010111_korkot where kode='.$data['kode']);
			$$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$$data['nama'] = $rowData[0]->nama;
			$data['alamat'] = $rowData[0]->alamat;
			$data['kodepos'] = $rowData[0]->kodepos;
			$data['contact_person'] = $rowData[0]->contact_person;
			$data['no_phone'] = $rowData[0]->no_phone;
			$data['no_fax'] = $rowData[0]->no_fax;
			$data['no_hp1'] = $rowData[0]->no_hp1;
			$data['no_hp2'] = $rowData[0]->no_hp2;
			$data['email1'] = $rowData[0]->email1;
			$data['email2'] = $rowData[0]->email2;
			$data['pms_nama'] = $rowData[0]->pms_nama;
			$data['pms_alamat'] = $rowData[0]->pms_alamat;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
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
			$data['pms_nama'] = null;
			$data['pms_alamat'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('MAIN/bk010111/create',$data);
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