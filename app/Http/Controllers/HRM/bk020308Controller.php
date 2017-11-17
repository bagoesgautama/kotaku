<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020308Controller extends Controller
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
				if($item->kode_menu==226)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 713);
				return view('HRM/bk020308/index',$data);
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
		$user = Auth::user();
		$columns = array(
			0 =>'id',
			1 =>'user_name',
			2 =>'nama_depan',
			3 =>'nama_belakang',
			4 => 'role',
			5 => 'level',
			6 => 'flag_blacklist'
		);
		if($user->kode_role==35){
			$query='select a.*,b.nama role,c.nama level from bkt_02010111_user a,bkt_02010102_role b,bkt_02010101_role_level c
				where a.kode_role=b.kode
				and a.kode_level=c.kode
				and a.id!='.$user->id;
			$totalData = DB::select('select count(1) cnt from bkt_02010111_user a,bkt_02010102_role b,bkt_02010101_role_level c
				where a.kode_role=b.kode
				and a.kode_level=c.kode
				and a.id!='.$user->id);
		}else{
			$query='
			select a.*,b.nama role,c.nama level from bkt_02010111_user a,bkt_02010102_role b,bkt_02010101_role_level c
				where a.kode_role=b.kode
				and a.kode_level=c.kode
				and a.id
			in
			(select u.id
		    from bkt_02010111_user u,
		       (select kode_level from bkt_02010111_user where id = "'.$user->id.'") r
		    where (u.kode_role,
				case when r.kode_level = 0 then "x" else u.kode_kmp end,
				case when r.kode_level in (0,1) then "x" else u.kode_kmw end,
				case when r.kode_level in (0,1) then "x" else u.wk_kd_prop end,
				case when r.kode_level in (0,1,2) then "x" else u.wk_kd_kota end,
				case when r.kode_level in (0,1,2,3) then "x" else u.wk_kd_kel end
				)
		    in (
				select
				x.kode_role_lower,
				   case when x.kode_level = 0 then "x" else x.kode_kmp end kode_kmp,
				   case when x.kode_level in (0,1) then "x" else x.kode_kmw end kode_kmw,
				   case when x.kode_level in (0,1) then "x" else x.kode_prop end wk_kd_prop,
				   case when x.kode_level in (0,1,2) then "x" else x.kode_kota end wk_kd_kota,
				   case when x.kode_level in (0,1,2,3) then "x" else x.kode_kel end wk_kd_kel
			  	from (
					select b.kode_level, a.kode_role, e.kode kode_role_lower, a.kode_kmp, a.kode_kmw,
						   a.kode_korkot, a.kode_faskel, d.kode kode_prop, ifnull(a.wk_kd_kota, h.kode_kota) kode_kota,
						   ifnull(a.wk_kd_kel, i.kode_kel) kode_kel, e.kode_level kode_level_lower
					  from bkt_02010111_user a
					  join bkt_02010102_role b on a.kode_role = b.kode
					  join bkt_02010101_role_level c on b.kode_level = c.kode
					  left join bkt_01010101_prop d on a.wk_kd_prop = d.kode
					  left join bkt_02010102_role e on e.kode_role_upper = b.kode
					  left join bkt_01010111_korkot f on f.kode = a.kode_korkot
					  left join bkt_01010113_faskel g on g.kode = a.kode_faskel
					  left join bkt_01010112_kota_korkot h on h.kode_korkot = f.kode
					  left join bkt_01010114_kel_faskel i on i.kode_faskel = g.kode
					 where a.id = "'.$user->id.'"
				   ) x
				))';
			$totalData = DB::select('select count(1) cnt from bkt_02010111_user a,bkt_02010102_role b,bkt_02010101_role_level c
				where a.kode_role=b.kode
				and a.kode_level=c.kode
				and a.id
			in
			(select u.id
		    from bkt_02010111_user u,
		       (select kode_level from bkt_02010111_user where id = "'.$user->id.'") r
		    where (u.kode_role,
				case when r.kode_level = 0 then "x" else u.kode_kmp end,
				case when r.kode_level in (0,1) then "x" else u.kode_kmw end,
				case when r.kode_level in (0,1) then "x" else u.wk_kd_prop end,
				case when r.kode_level in (0,1,2) then "x" else u.wk_kd_kota end,
				case when r.kode_level in (0,1,2,3) then "x" else u.wk_kd_kel end
				)
		    in (
				select
				x.kode_role_lower,
				   case when x.kode_level = 0 then "x" else x.kode_kmp end kode_kmp,
				   case when x.kode_level in (0,1) then "x" else x.kode_kmw end kode_kmw,
				   case when x.kode_level in (0,1) then "x" else x.kode_prop end wk_kd_prop,
				   case when x.kode_level in (0,1,2) then "x" else x.kode_kota end wk_kd_kota,
				   case when x.kode_level in (0,1,2,3) then "x" else x.kode_kel end wk_kd_kel
			  	from (
					select b.kode_level, a.kode_role, e.kode kode_role_lower, a.kode_kmp, a.kode_kmw,
						   a.kode_korkot, a.kode_faskel, d.kode kode_prop, ifnull(a.wk_kd_kota, h.kode_kota) kode_kota,
						   ifnull(a.wk_kd_kel, i.kode_kel) kode_kel, e.kode_level kode_level_lower
					  from bkt_02010111_user a
					  join bkt_02010102_role b on a.kode_role = b.kode
					  join bkt_02010101_role_level c on b.kode_level = c.kode
					  left join bkt_01010101_prop d on a.wk_kd_prop = d.kode
					  left join bkt_02010102_role e on e.kode_role_upper = b.kode
					  left join bkt_01010111_korkot f on f.kode = a.kode_korkot
					  left join bkt_01010113_faskel g on g.kode = a.kode_faskel
					  left join bkt_01010112_kota_korkot h on h.kode_korkot = f.kode
					  left join bkt_01010114_kel_faskel i on i.kode_faskel = g.kode
					 where a.id = "'.$user->id.'"
				   ) x
				))');
		}

		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value'))){
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and (a.id like "%'.$search.'%" or a.user_name like "%'.$search.'%" or a.nama_belakang like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (a.id like "%'.$search.'%" or a.user_name like "%'.$search.'%" or a.nama_belakang like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit="/hrm/management_personil/blacklist/create?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['user_name'] = $post->user_name;
				$nestedData['nama_depan'] = $post->nama_depan;
				$nestedData['nama_belakang'] = $post->nama_belakang;
				$nestedData['role'] = $post->role;
				$nestedData['level'] = $post->level;
				$nestedData['flag_blacklist'] = $post->flag_blacklist==1?"Ya":"Tidak";

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==226)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['715'])){
					$option .= "&emsp;<a href='{$url_edit}' title='Blacklist' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				//if(!empty($detil['536'])){
					//$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				//}
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
				if($item->kode_menu==226)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			if($data['id']!=null && !empty($data['detil']['715'])){
				$rowData = DB::select('select * from bkt_02010111_user where id='.$data['id']);
				$data['user_name'] = $rowData[0]->user_name;
				$data['nama_depan'] = $rowData[0]->nama_depan;
				$data['nama_belakang'] = $rowData[0]->nama_belakang;
				$data['flag_blacklist'] = $rowData[0]->flag_blacklist;
				$data['blacklist_dt'] = $rowData[0]->blacklist_dt;
				$data['blacklist_by'] = $rowData[0]->blacklist_by;
				$data['blacklist_notes'] = $rowData[0]->blacklist_notes;
				return view('HRM/bk020308/create',$data);
			}else {
				//return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();
		date_default_timezone_set('Asia/Jakarta');
		echo $request->input('id');
		if ($request->input('id')!=null){
			if($request->input('flag_blacklist-input')=="1"){
				DB::table('bkt_02010111_user')->where('id', $request->input('id'))
				->update([
					'flag_blacklist' => (int)$request->input('flag_blacklist-input'),
					'blacklist_notes' => $request->input('blacklist_notes-input'),
					'blacklist_dt' => date('Y-m-d H:i:s'),
					'blacklist_by' => Auth::user()->id
					]);
			}else{
				DB::table('bkt_02010111_user')->where('id', $request->input('id'))
				->update([
					'flag_blacklist' => (int)$request->input('flag_blacklist-input'),
					'blacklist_notes' => $request->input('blacklist_notes-input'),
					'blacklist_dt' => null,
					'blacklist_by' => null
					]);
			}
			$this->log_aktivitas('Update', 715);
		}
	}

	public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 226,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
