<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020309Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==175)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 514);
				return view('HRM/bk020309/index',$data);
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
			1 =>'kmp',
			2 =>'slum_program',
			3 =>'quota_personil',
			4 => 'role'
		);
		$query='select a.kode,a.quota_personil,d.nama kmp,e.nama slum_program,c.nama role
			from bkt_02010105_kuota_kmp a left join bkt_01010109_kmp_slum_prog b on a.kode_kmp_slum_prog=b.kode
			,bkt_02010102_role c,bkt_01010108_kmp d,bkt_01010107_slum_program e
			where a.kode_role=c.kode
			and b.kode_kmp=d.kode
			and b.kode_slum_prog=e.kode';
		$totalData = DB::select('select count(1) cnt from bkt_02010105_kuota_kmp ');
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
			$posts=DB::select($query. ' and d.nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and d.nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/management/kuota/kmp/create?kode=".$edit;
				$url_delete="/hrm/management/kuota/kmp/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['quota_personil'] = $post->quota_personil;
				$nestedData['kmp'] = $post->kmp;
				$nestedData['role'] = $post->role;
				$nestedData['slum_program'] = $post->slum_program;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==175)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['516'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['517'])){
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==175)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['kmp_slum_list'] = DB::select('select a.kode,concat(b.nama,"/",c.nama)nama from bkt_01010109_kmp_slum_prog a,bkt_01010108_kmp b,bkt_01010107_slum_program c
				where a.kode_slum_prog=c.kode
				and a.kode_kmp=b.kode');
			$data['role_list'] = DB::select('select kode,nama from bkt_02010102_role where status=1');
			if($data['kode']!=null && !empty($data['detil']['516'])){
				$rowData = DB::select('select * from bkt_02010105_kuota_kmp where kode='.$data['kode']);
				$data['quota_personil'] = $rowData[0]->quota_personil;
				$data['kode_role'] = $rowData[0]->kode_role;
				$data['kode_kmp_slum_prog'] = $rowData[0]->kode_kmp_slum_prog;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				return view('HRM/bk020309/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['515'])){
				$data['quota_personil'] = null;
				$data['kode_role'] = null;
				$data['kode_kmp_slum_prog'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				return view('HRM/bk020309/create',$data);
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
			DB::table('bkt_02010105_kuota_kmp')->where('kode', $request->input('kode'))
			->update(['quota_personil' => $request->input('quota_personil-input'),
				'kode_role' => $request->input('kode_role-input'),
				'kode_kmp_slum_prog' => $request->input('kode_kmp_slum_prog-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 516);

		}else{
			DB::table('bkt_02010105_kuota_kmp')->insert(
       			['quota_personil' => $request->input('quota_personil-input'),
				'kode_role' => $request->input('kode_role-input'),
				'kode_kmp_slum_prog' => $request->input('kode_kmp_slum_prog-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 515);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010105_kuota_kmp')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 517);
        return Redirect::to('/hrm/management/kuota/kmp');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 175,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
