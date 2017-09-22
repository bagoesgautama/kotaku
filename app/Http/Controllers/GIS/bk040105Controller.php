<?php

namespace App\Http\Controllers\GIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk040105Controller extends Controller
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

		return view('test/simple',$data);
	}

	public function create(Request $request)
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		$data['id']=$request->input('id');
		if($data['id']!=null){
			$rowData = DB::select('select * from users where id='.$data['id']);
			$data['name'] = $rowData[0]->name;
			$data['email'] = $rowData[0]->email;
			$data['pswd'] = $rowData[0]->password;
		}else{
			$data['name'] = null;
			$data['email'] = null;
			$data['pswd'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		return view('test/simple_create',$data);
	}

	public function post_create(Request $request)
	{
		if ($request->input('example-id-input')!=null){
			DB::table('users')->where('id', $request->input('example-id-input'))
			->update(['name' => $request->input('example-text-input'), 'email' => $request->input('example-email'), 'password' => bcrypt($request->input('example-password'))]);

		}else{
			DB::table('users')->insert(
       			['name' => $request->input('example-text-input'), 'email' => $request->input('example-email'), 'password' => bcrypt($request->input('example-password')), 'last_name' => $request->input('example-textarea-input')]);
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
			0 =>'name',
			1 =>'email',
			2 =>'password'
		);
		$query='select * from users ';
		$totalData = DB::select('select count(1) cnt from users ');
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
				$show =  $post->id;
				$edit =  $post->id;
				$delete = $post->id;
				$url_edit=url('/')."/simple/create?id=".$show;
				$url_delete=url('/')."/simple/delete?id=".$delete;
				$nestedData['name'] = $post->name;
				$nestedData['email'] = $post->email;
				$nestedData['password'] = $post->password;
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
		DB::table('users')->where('id', $request->input('id'))->delete();
        return Redirect::to('simple');
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
