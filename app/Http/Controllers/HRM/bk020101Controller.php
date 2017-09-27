<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020101Controller extends Controller
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
		return view('HRM/bk020101/index',$data);
    }

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'nama',
			1 =>'deskripsi',
			2 =>'status',
			3 =>'created_time',
			4 =>'created_by',
			5 =>'updated_time',
			6 =>'updated_by'
		);
		$query='select *, (case when (status = 0) then "Tidak Aktif" when (status = 1) then "Aktif" else "Dihapus" end) nama_status from bkt_02010101_role_level where status!=2 ';
		$totalData = DB::select('select count(1) cnt from bkt_02010101_role_level ');
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
			$posts=DB::select($query. ' where nama like "%'.$search.'%" or deskripsi like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' where nama like "%'.$search.'%" or deskripsi like "%'.$search.'%") a');
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
				$nestedData['status'] = $post->nama_status;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;
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
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
			$data['nama'] = null;
			$data['deskripsi'] = null;
			$data['status'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('HRM/bk020101/create',$data);
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
