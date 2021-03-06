<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020104Controller extends Controller
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
		return view('HRM/main/modul',$data);
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
		return view('modul',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'nama',
			1 =>'deskripsi',
			2 =>'status',
			3 =>'kode_apps',
			4 =>'created_time',
			5 =>'created_by',
			6 =>'update_time',
			7 =>'update_by'
		);
		$query='select * from bkt_02010104_modul ';
		$totalData = DB::select('select count(1) cnt from bkt_02010104_modul ');
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
				$url_edit=url('/')."/hrm/modul/create?kode=".$show;
				$url_delete=url('/')."/hrm/modul/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['deskripsi'] = $post->deskripsi;
				$nestedData['status'] = $post->status;
				$nestedData['kode_apps'] = $post->kode_apps;
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
			$rowData = DB::select('select * from bkt_02010104_modul where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['deskripsi'] = $rowData[0]->deskripsi;
			$data['status'] = $rowData[0]->status;
		}else{
			$data['nama'] = null;
			$data['deskripsi'] = null;
			$data['status'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('HRM/main/modul_create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_02010104_modul')->where('kode', $request->input('example-id-input'))
			->update(['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
				]);

		}else{
			DB::table('bkt_02010104_modul')->insert(
       			['nama' => $request->input('example-text-input'), 'deskripsi' => $request->input('example-textarea-input'), 'status' => $request->input('example-select')
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010104_modul')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('hrm/modul');
    }
}
