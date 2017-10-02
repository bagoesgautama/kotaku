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

		return view('GIS/bk040105/index',$data);
	}

	public function create(Request $request)
	{
		//$users = DB::select('select * from users ');
		//echo json_encode($users);
		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		if($data['kode']!=null){
			$rowData = DB::select('select * from bkt_01010104_kel where kode='.$data['kode']);
			$data['nama'] = $rowData[0]->nama;
			$data['keterangan'] = $rowData[0]->keterangan;
			$data['kode_bps'] = $rowData[0]->kode_bps;
			$data['stat_kode_bps'] = $rowData[0]->stat_kode_bps;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['status'] = $rowData[0]->status;
			$data['file'] = $rowData[0]->url_border_area;
			$data['latitude'] = $rowData[0]->latitude;
			$data['longitude'] = $rowData[0]->longitude;
		}else{
			$data['nama'] = null;
			$data['keterangan'] = null;
			$data['kode_bps'] = null;
			$data['stat_kode_bps'] = null;
			$data['kode_kec'] = null;
			$data['status'] = null;
			$data['file'] = null;
			$data['latitude'] = null;
			$data['longitude'] = null;
		}
		if (Auth::check()) {
			$user = Auth::user();
			$data['username'] = Auth::user()->name;
		}
		$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
		return view('GIS/bk040105/create',$data);
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
			$file = public_path('/uploads/kelurahan/'.$url);
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['KELURAHAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}elseif($upload == true){
			$string = file_get_contents($file);
			$json_file = json_decode($string, true);
			$json_file['properties']['KELURAHAN'] = $request->input('nama-input');
			$new_String = json_encode($json_file);
			file_put_contents($file, $new_String);
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01010104_kel')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'), 'keterangan' => $request->input('keterangan-input'), 'kode_bps' => $request->input('kode-bps-input'), 'stat_kode_bps' => $request->input('stat-kode-bps-input'), 'kode_kec' => $request->input('kode-kec-input'), 'url_border_area' => $url, 'status' => $request->input('status-input'), 'latitude' => $request->input('latitude-input'), 'longitude' => $request->input('longitude-input'), 'updated_by' => Auth::user()->id, 'updated_time' => date('Y-m-d H:i:s')]);

			if($upload == true){
				$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
			}

		}else{
			DB::table('bkt_01010104_kel')->insert(
       			['nama' => $request->input('nama-input'), 'keterangan' => $request->input('keterangan-input'), 'kode_bps' => $request->input('kode-bps-input'), 'stat_kode_bps' => $request->input('stat-kode-bps-input'), 'kode_kec' => $request->input('kode-kec-input'), 'url_border_area' => $url, 'status' => $request->input('status-input'), 'latitude' => $request->input('latitude-input'), 'longitude' => $request->input('longitude-input'), 'created_by' => Auth::user()->id]);
			$file->move(public_path('/uploads/kelurahan'), $file->getClientOriginalName());
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
			1 =>'keterangan',
			2 =>'kode_bps',
			3 =>'stat_kode_bps',
			4 =>'kode_kec',
			5 =>'status'
		);
		$query='select bkt_01010104_kel.kode, bkt_01010104_kel.nama, bkt_01010104_kel.keterangan, bkt_01010104_kel.kode_bps, bkt_01010104_kel.stat_kode_bps, bkt_01010103_kec.nama as kode_kec, bkt_01010104_kel.status, bkt_01010104_kel.created_time from bkt_01010104_kel inner join bkt_01010103_kec on bkt_01010104_kel.kode_kec = bkt_01010103_kec.kode where bkt_01010104_kel.status = 0 or bkt_01010104_kel.status = 1';
		$totalData = DB::select('select count(1) cnt from bkt_01010104_kel where bkt_01010104_kel.status = 0 or bkt_01010104_kel.status = 1');
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
			$posts=DB::select($query.' and bkt_01010104_kel.nama like "%'.$search.'%" or bkt_01010104_kel.keterangan like "%'.$search.'%" or bkt_01010104_kel.kode_bps like "%'.$search.'%" or bkt_01010104_kel.stat_kode_bps like "%'.$search.'%" or bkt_01010103_kec.nama like "%'.$search.'%" or bkt_01010104_kel.status like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query.' and bkt_01010104_kel.nama like "%'.$search.'%" or bkt_01010104_kel.keterangan like "%'.$search.'%" or bkt_01010104_kel.kode_bps like "%'.$search.'%" or bkt_01010104_kel.stat_kode_bps like "%'.$search.'%" or bkt_01010103_kec.nama like "%'.$search.'%" or bkt_01010104_kel.status like "%'.$search.'%") a');
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
				$url_edit=url('/')."/gis/kelurahan/create?kode=".$show;
				$url_delete=url('/')."/gis/kelurahan/delete?kode=".$delete;
				$nestedData['nama'] = $post->nama;
				$nestedData['keterangan'] = $post->keterangan;
				$nestedData['kode_bps'] = $post->kode_bps;
				$nestedData['stat_kode_bps'] = $post->stat_kode_bps;
				$nestedData['kode_kec'] = $post->kode_kec;
				$nestedData['status'] = $status;
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
		DB::table('bkt_01010104_kel')->where('kode', $request->input('kode'))->update(['status' => 2]);;
        return Redirect::to('/gis/kelurahan');
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
