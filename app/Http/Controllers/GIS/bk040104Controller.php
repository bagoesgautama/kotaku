<?php

namespace App\Http\Controllers\GIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk040104Controller extends Controller
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
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}

		return view('GIS/bk040104/index',$data);
	}

	public function create(Request $request)
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_01010103_kec where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['nama_pendek'] = $rowData[0]->nama_pendek;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['status'] = $rowData[0]->status;
			$data['file'] = $rowData[0]->url_border_area;
		}else{
			$data['nama'] = null;
			$data['nama_pendek'] = null;
			$data['kode_kota'] = null;
			$data['status'] = null;
			$data['file'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
		return view('GIS/bk040104/create',$data);
	}

	public function post_create(Request $request)
	{
		$file = $request->file('file-input');
		$url = null;
		$upload = false;
		if($request->input('uploaded-file') != null && $file == null){
			$url = $request->input('uploaded-file');
			$upload = false;
		}elseif($request->input('uploaded-file') != null && $file != null){
			$url = $file->getClientOriginalName();
			$upload = true;
		}elseif($request->input('uploaded-file') == null && $file != null){
			$url = $file->getClientOriginalName();
			$upload = true;
		}

		if($upload == false){
			$file = public_path('/uploads/kecamatan/'.$url);
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['KECAMATAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}elseif($upload == true){
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['KECAMATAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}

		if ($request->input('kode')!=null){
			DB::table('bkt_01010103_kec')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'kode_kota' => $request->input('kode-kota-input'), 'url_border_area' => $url, 'status' => $request->input('status-input')]);
			$file->move(public_path('/uploads/kecamatan'), $file->getClientOriginalName());

		}else{
			DB::table('bkt_01010103_kec')->insert(
       			['nama' => $request->input('nama-input'), 'nama_pendek' => $request->input('nama-pndk-input'), 'kode_kota' => $request->input('kode-kota-input'), 'url_border_area' => $url]);
			$file->move(public_path('/uploads/kecamatan'), $file->getClientOriginalName());
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
			2 =>'kode_kota',
			3 =>'status',
			4 =>'created_time',
			5 =>'created_by',
			6 =>'updatede_time',
			7 =>'updated_by'
		);
		$query='select bkt_01010103_kec.kode, bkt_01010103_kec.nama, bkt_01010103_kec.nama_pendek, bkt_01010102_kota.nama as kode_kota, bkt_01010103_kec.status, bkt_01010103_kec.created_time from bkt_01010103_kec inner join bkt_01010102_kota on bkt_01010103_kec.kode_kota = bkt_01010102_kota.kode where bkt_01010103_kec.status = 0 or bkt_01010103_kec.status = 1';
		$totalData = DB::select('select count(1) cnt from bkt_01010103_kec where bkt_01010103_kec.status = 0 or bkt_01010103_kec.status = 1');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value')))
		{
			$posts=DB::select($query .' order by bkt_01010103_kec.'.$order.' '.$dir.' limit '.$start.','.$limit);
		}
		else {
			$search = $request->input('search.value');
			$posts=DB::select($query.' and bkt_01010103_kec.nama like "%'.$search.'%" or bkt_01010103_kec.nama_pendek like "%'.$search.'%" or bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01010103_kec.status like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query.' and bkt_01010103_kec.nama like "%'.$search.'%" or bkt_01010103_kec.nama_pendek like "%'.$search.'%" or bkt_01010102_kota.nama like "%'.$search.'%" or bkt_01010103_kec.status like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$status = null;
				if($post->status == 0){
					$status = 'Tidak Aktif';
				}elseif($post->status == 1){
					$status = 'Aktif';
				}elseif($post->status == 2){
					$status = 'Dihapus';
				}
				$url_edit=url('/')."/gis/kecamatan/create?kode=".$show;
				$url_delete=url('/')."/gis/kecamatan/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['nama_pendek'] = $post->nama_pendek;
				$nestedData['kode_kota'] = $post->kode_kota;
				$nestedData['status'] = $status;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = null;
				$nestedData['updated_time'] = null;
				$nestedData['updated_by'] = null;
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
		DB::table('bkt_01010103_kec')->where('kode', $request->input('kode'))->update(['status' => 2]);;
        return Redirect::to('/gis/kecamatan');
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
