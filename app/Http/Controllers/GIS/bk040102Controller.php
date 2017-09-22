<?php

namespace App\Http\Controllers\GIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk040102Controller extends Controller
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
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}

		return view('GIS/bk040102/index',$data);
	}

	public function create(Request $request)
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_01010101_prop where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['nama_pendek'] = $rowData[0]->nama_pendek;
			$data['wilayah'] = $rowData[0]->wilayah;
			$data['status'] = $rowData[0]->status;
		}else{
			$data['nama'] = null;
			$data['nama_pendek'] = null;
			$data['wilayah'] = null;
			$data['status'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('GIS/bk040102/create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			DB::table('bkt_01010101_prop')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'wilayah' => $request->input('wilayah-input'), 'status' => $request->input('status-input')]);

		}else{
			DB::table('bkt_01010101_prop')->insert(
       			['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'wilayah' => $request->input('wilayah-input')]);
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
		return view('simple',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'nama',
			1 =>'nama_pendek',
			2 =>'wilayah',
			3 =>'status',
			4 =>'created_time'
		);
		$query='select * from bkt_01010101_prop ';
		$totalData = DB::select('select count(1) cnt from bkt_01010101_prop ');
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
			$posts=DB::select($query. 'where nama like "%'.$search.'%" or nama_pendek like "%'.$search.'%" or wilayah like "%'.$search.'%" or status like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. 'where nama like "%'.$search.'%" or nama_pendek like "%'.$search.'%" or wilayah like "%'.$search.'%" or status like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/gis/provinsi/create?kode=".$show;
				$url_delete=url('/')."/gis/provinsi/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['nama_pendek'] = $post->nama_pendek;
				$nestedData['wilayah'] = $post->wilayah;
				$nestedData['status'] = $post->status;
				$nestedData['created_time'] = $post->created_time;
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

	public function delete(Request $request)
	{
		DB::table('bkt_01010101_prop')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/gis/provinsi');
    }

    public function logout()
    {
        Auth::logout();
    }

	public function test()
    {
        Auth::logout();
    }
}
