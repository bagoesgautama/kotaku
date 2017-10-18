<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010122Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==140)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 445);
				return view('MAIN/bk010122/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama',
			2 =>'alamat',
			3 =>'status'
		);
		$query='select kode,alamat,nama,case when status=1 then "aktif" else "tidak aktif" end status from bkt_01010126_kontraktor where status !=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010126_kontraktor where status !=2');
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
			$posts=DB::select($query. ' and (nama like "%'.$search.'%" or alamat like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (nama like "%'.$search.'%" or alamat like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit=url('/')."/main/data_master/kontraktor/create?kode=".$edit;
				$url_delete=url('/')."/main/data_master/kontraktor/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['alamat'] = $post->alamat;
				$nestedData['nama'] = $post->nama;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==140)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['447'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['448'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				}
				$nestedData['option'] = $option;
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
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==140)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['447'])){
				$rowData = DB::select('select * from bkt_01010126_kontraktor where kode='.$data['kode']);
				$data['nama'] = $rowData[0]->nama;
				$data['alamat'] = $rowData[0]->alamat;
				$data['no_phone'] = $rowData[0]->no_phone;
				$data['no_hp'] = $rowData[0]->no_hp;
				$data['no_fax'] = $rowData[0]->no_fax;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('MAIN/bk010122/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['446'])){
				$data['nama'] = null;
				$data['alamat'] = null;
				$data['no_phone'] = null;
				$data['no_hp'] = null;
				$data['no_fax'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('MAIN/bk010122/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_01010126_kontraktor')->where('kode', $request->input('kode'))
			->update(['nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_hp' => $request->input('no_hp-input'),
				'no_fax' => $request->input('no_fax-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 447);

		}else{
			DB::table('bkt_01010126_kontraktor')->insert(
       			['nama' => $request->input('nama-input'),
				'alamat' => $request->input('alamat-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_hp' => $request->input('no_hp-input'),
				'no_fax' => $request->input('no_fax-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 446);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010126_kontraktor')->where('kode', $request->input('kode'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 448);
        return Redirect::to('/main/data_master/kontraktor');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 140,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
