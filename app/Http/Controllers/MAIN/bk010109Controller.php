<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010109Controller extends Controller
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
		return view('MAIN/bk010109/index',$data);
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
		return view('main/kmp_slum_program',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_kmp',
			1 =>'kode_slum_prog',
			2 =>'status',
			3 =>'created_time',
			4 =>'created_by',
			5 =>'updated_time',
			6 =>'updated_by'
		);
		$query='select * from bkt_01010109_kmp_slum_prog ';
		$totalData = DB::select('select count(1) cnt from bkt_01010109_kmp_slum_prog ');
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
			$posts=DB::select($query. 'where kode_kmp like "%'.$search.'%" or kode_slum_prog like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. 'where nama like "%'.$search.'%" a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/kmp_slum_program/create?kode=".$show;
				$url_delete=url('/')."/main/kmp_slum_program/delete?kode=".$delete;
				$nestedData['kode_kmp'] = $post->kode_kmp;
				$nestedData['kode_slum_prog'] = $post->kode_slum_prog;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->update_time;
				$nestedData['updated_by'] = $post->update_by;
				$nestedData['option'] = "&emsp;<a href='{$url_edit}' title='SHOW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>
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
			$rowData = DB::select('select * from bkt_01010109_kmp_slum_prog where kode='.$data['kode']);
			$data['kode_kmp'] = $rowData[0]->kode_kmp;
			$data['kode_slum_prog'] = $rowData[0]->kode_slum_prog;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
		}else{
			$data['kode_kmp'] = null;
			$data['kode_slum_prog'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
		}

		//get dropdown list from Database
		$kode_kmp = DB::select('select kode, nama from bkt_01010108_kmp');
		$data['kode_kmp_list'] = $kode_kmp;

		$kode_slum_prog = DB::select('select kode, nama from bkt_01010107_slum_program');
		$data['kode_slum_prog_list'] = $kode_slum_prog;

		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('MAIN/bk010109/create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01010109_kmp_slum_prog')->where('kode', $request->input('example-id-input'))
			->update(['kode_kmp' => $request->input('example-kode_kmp-input'), 
				'kode_slum_prog' => $request->input('example-kode_slum_prog-input')
				]);

		}else{
			DB::table('bkt_01010109_kmp_slum_prog')->insert(
				['kode_kmp' => $request->input('example-kode_kmp-input'), 
				'kode_slum_prog' => $request->input('example-kode_slum_prog-input')
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010109_kmp_slum_prog')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('/main/kmp_slum_program');
    }
}