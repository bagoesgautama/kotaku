<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010108Controller extends Controller
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
		return view('MAIN/bk010108/index',$data);
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
		return view('kmp',$data);
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'nama',
			1 =>'alamat',
			2 =>'kodepos',
			3 =>'contact_person',
			4 =>'no_phone',
			5 =>'no_hp1',
			6 =>'no_hp2',
			7 =>'email1',
			8 =>'email2',
			9 =>'pms_nama',
			10 => 'pms_alamat',
			11 =>'created_time',
			12 =>'created_by',
			13 =>'updated_time',
			14 =>'updated_by'
		);
		$query='select * from bkt_01010108_kmp ';
		$totalData = DB::select('select count(1) cnt from bkt_01010108_kmp ');
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
			$totalFiltered=DB::select('select count(1) from ('.$query. 'where nama like "%'.$search.'%" or email1 like "%'.$search.'%" or no_hp1 like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$url_edit=url('/')."/main/kmp/create?kode=".$show;
				$url_delete=url('/')."/main/kmp/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['kodepos'] = $post->kodepos;
				$nestedData['contact_person'] = $post->contact_person;
				$nestedData['no_phone'] = $post->no_phone;
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
			$rowData = DB::select('select * from bkt_01010108_kmp where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['alamat'] = $rowData[0]->alamat;
			$data['kodepos'] = $rowData[0]->kodepos;
			$data['contact_person'] = $rowData[0]->contact_person;
			$data['no_phone'] = $rowData[0]->no_phone;
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
			$data['nama'] = null;
			$data['alamat'] = null;
			$data['kodepos'] = null;
			$data['contact_person'] = null;
			$data['no_phone'] = null;
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
		return view('MAIN/bk010108/create',$data);
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_01010108_kmp')->where('kode', $request->input('example-id-input'))
			->update(
				['nama' => $request->input('example-nama-input'), 
				'alamat' => $request->input('example-alamat-input'), 
				'kodepos' => $request->input('example-kodepos-input'), 
				'contact_person' => $request->input('example-contact_person-input'), 
				'no_phone' => $request->input('example-no_phone-input'), 
				'no_hp1' => $request->input('example-no_hp1-input'), 
				'no_hp2' => $request->input('example-no_hp2-input'), 
				'email1' => $request->input('example-email1'), 
				'email2' => $request->input('example-email2'), 
				'pms_nama' => $request->input('example-pms_nama-input'), 
				'pms_alamat' => $request->input('example-pms_alamat-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

		}else{
			DB::table('bkt_01010108_kmp')->insert(
       			['nama' => $request->input('example-nama-input'), 
				'alamat' => $request->input('example-alamat-input'), 
				'kodepos' => $request->input('example-kodepos-input'), 
				'contact_person' => $request->input('example-contact_person-input'), 
				'no_phone' => $request->input('example-no_phone-input'), 
				'no_hp1' => $request->input('example-no_hp1-input'), 
				'no_hp2' => $request->input('example-no_hp2-input'), 
				'email1' => $request->input('example-email1'), 
				'email2' => $request->input('example-email2'), 
				'pms_nama' => $request->input('example-pms_nama-input'), 
				'pms_alamat' => $request->input('example-pms_alamat-input'), 
       			'created_by' => Auth::user()->id
       			]);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010108_kmp')->where('kode', $request->input('kode'))->delete();
        return Redirect::to('main/kmp');
    }
}
