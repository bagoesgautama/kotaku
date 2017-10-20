<?php

namespace App\Http\Controllers\QS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk050101Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==150)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 479);
				return view('QS/bk050101/index',$data);
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
			0 =>'id',
			1 =>'slum_program',
			2 =>'kode_agenda',
			3 =>'nama',
			4 =>'tahun',
			5 =>'status'
		);
		$query='select a.id,a.kode_agenda,a.nama,a.tahun,case when a.status=1 then "aktif" else "tidak aktif" end status,b.nama slum_program from bkt_05010101_agenda a left join bkt_01010107_slum_program b on kode_slum_prog=b.kode where a.status !=2';
		$totalData = DB::select('select count(1) cnt from bkt_05010101_agenda where status !=2');
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
			$posts=DB::select($query. ' and a.nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and a.nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit="/qs/master/agenda/create?id=".$edit;
				$url_delete="/qs/master/agenda/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['nama'] = $post->nama;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['slum_program'] = $post->slum_program;
				$nestedData['kode_agenda'] = $post->kode_agenda;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==150)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['481'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['482'])){
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
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==150)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			$data['slum_list'] = DB::select('select nama,kode from bkt_01010107_slum_program where status=1');
			if($data['id']!=null && !empty($data['detil']['481'])){
				$rowData = DB::select('select * from bkt_05010101_agenda where id='.$data['id']);
				$data['nama'] = $rowData[0]->nama;
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_agenda'] = $rowData[0]->kode_agenda;
				$data['kode_slum_prog'] = $rowData[0]->kode_slum_prog;
				$data['deskripsi'] = $rowData[0]->deskripsi;
				$data['status'] = $rowData[0]->status;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('QS/bk050101/create',$data);
			}else if($data['id']==null && !empty($data['detil']['480'])){
				$data['nama'] = null;
				$data['tahun'] = null;
				$data['kode_agenda'] = null;
				$data['kode_slum_prog'] = null;
				$data['deskripsi'] = null;
				$data['status'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('QS/bk050101/create',$data);
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
		if ($request->input('id')!=null){
			DB::table('bkt_05010101_agenda')->where('id', $request->input('id'))
			->update(['nama' => $request->input('nama-input'),
				'tahun' => $request->input('tahun-input'),
				'kode_agenda' => $request->input('kode_agenda-input'),
				'kode_slum_prog' => $request->input('kode_slum_prog-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 481);

		}else{
			DB::table('bkt_05010101_agenda')->insert(
       			['nama' => $request->input('nama-input'),
				'tahun' => $request->input('tahun-input'),
				'kode_agenda' => $request->input('kode_agenda-input'),
				'kode_slum_prog' => $request->input('kode_slum_prog-input'),
				'deskripsi' => $request->input('deskripsi-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 480);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_05010101_agenda')->where('id', $request->input('id'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 482);
        return Redirect::to('/qs/master/agenda');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 5,
			'kode_modul' => 10,
			'kode_menu' => 150,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
