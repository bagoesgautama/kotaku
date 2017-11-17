<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020204Controller extends Controller
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
				if($item->kode_menu==229)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 725);
				return view('HRM/bk020204/index',$data);
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
			0 =>'kode',
			1 =>'nama_depan',
			2 =>'nama_belakang',
			3 =>'perubahan',
			4 =>'role_lama',
			5 =>'role_baru',
			6 =>'divalidasi_oleh'
		);
		if($user->kode_role==35){
			$query='select a.kode,a.kode_user,e.nama_depan,e.nama_belakang,d.nama perubahan,b.nama role_lama,c.nama role_baru,f.user_name divalidasi_oleh
			from bkt_02030204_perubahan_status a left join bkt_02010111_user f on a.divalidasi_oleh=f.id,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=1
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and a.kode_user!='.$user->id;
			$totalData = DB::select('select count(1) cnt from bkt_02030204_perubahan_status a left join bkt_02010111_user f on a.divalidasi_oleh=f.id,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=1
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and a.kode_user!='.$user->id);
		}else{
			$query='select a.kode, a.kode_user,e.nama_depan,e.nama_belakang,d.nama perubahan,b.nama role_lama,c.nama role_baru,f.user_name divalidasi_oleh
			from bkt_02030204_perubahan_status a left join bkt_02010111_user f on a.divalidasi_oleh=f.id,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=1
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and (a.kode_user = "'.$user->id.'" or a.kode_user
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
				)))';
		$totalData = DB::select('select count(1) cnt from bkt_02030204_perubahan_status a left join bkt_02010111_user f on a.divalidasi_oleh=f.id,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=1
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and (a.kode_user = "'.$user->id.'" or a.kode_user
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
				)))');
		}

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
			$posts=DB::select($query. ' and (e.nama_depan like "%'.$search.'%" or e.nama_belakang like "%'.$search.'%" or d.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (e.nama_depan like "%'.$search.'%" or e.nama_belakang like "%'.$search.'%" or d.nama like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/management_diri/promosi/create?kode=".$edit;
				$url_delete="/hrm/management_diri/promosi/delete?kode=".$edit;
				$url_approve="/hrm/management_diri/promosi/approve?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_depan'] = $post->nama_depan;
				$nestedData['nama_belakang'] = $post->nama_belakang;
				$nestedData['perubahan'] = $post->perubahan;
				$nestedData['role_lama'] = $post->role_lama;
				$nestedData['role_baru'] = $post->role_baru;
				$nestedData['divalidasi_oleh'] = $post->divalidasi_oleh;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==229)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['727'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['728']) && empty($nestedData['divalidasi_oleh']) && $user->id==$post->kode_user){
					//$option .= "&emsp;<a href='{$url_edit}' title='Approve' ><span class='fa fa-fw fa-edit'></span></a>";
					$option .= "&emsp;<a href='#' title='Delete' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
				if($item->kode_menu==229)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['id'] = $user->id;
			$data['role_login'] = $user->kode_role;
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['perubahan']=DB::select('select kode,nama from bkt_02010112_jns_perubahan where status=1');
			$data['role']=DB::select('select kode,nama from bkt_02010102_role where status=1');
			$data['prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			$data['kota_lama_list']=[];
			$data['kel_lama_list']=[];
			$data['kota_baru_list']=[];
			$data['kel_baru_list']=[];
			if($data['kode']!=null && !empty($data['detil']['727'])){
				$rowData = DB::select('select * from bkt_02030204_perubahan_status where kode_jns_perubahan=1 and kode='.$data['kode']);
				$role_upper = DB::select('select b.kode_role_upper from bkt_02010111_user a, bkt_02010102_role b where a.kode_role=b.kode and a.id='.$rowData[0]->kode_user);
				$data['role_upper'] = $role_upper[0]->kode_role_upper;
				$data['kode_user'] = $rowData[0]->kode_user;
				$data['kode_role_lama'] = $rowData[0]->kode_role_lama;
				$data['kode_role_baru'] = $rowData[0]->kode_role_baru;
				$data['tgl_efektif_role_baru'] = $rowData[0]->tgl_efektif_role_baru;
				$data['catatan'] = $rowData[0]->catatan;
				$data['catatan_validasi'] = $rowData[0]->catatan_validasi;
				$data['uri_img_sk1'] = $rowData[0]->uri_img_sk1;
				$data['uri_img_sk2'] = $rowData[0]->uri_img_sk2;
				$data['uri_img_sk3'] = $rowData[0]->uri_img_sk3;
				$data['divalidasi_oleh'] = $rowData[0]->divalidasi_oleh;
				$data['validasi_dt'] = $rowData[0]->validasi_dt;
				$data['catatan_validasi'] = $rowData[0]->catatan_validasi;
				$data['kode_prop_lama'] = $rowData[0]->kode_prop_lama;
				$data['kode_prop_baru'] = $rowData[0]->kode_prop_baru;
				$data['kode_kota_lama'] = $rowData[0]->kode_kota_lama;
				$data['kode_kota_baru'] = $rowData[0]->kode_kota_baru;
				$data['kode_kel_lama'] = $rowData[0]->kode_kel_lama;
				$data['kode_kel_baru'] = $rowData[0]->kode_kel_baru;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				if(!empty($rowData[0]->kode_kota_lama)){
					$data['kota_lama_list']=DB::select('select kode, nama  from bkt_01010102_kota where status=1 and kode_prop='.$rowData[0]->kode_prop_lama);
					$data['kel_lama_list']=DB::select('select a.kode, a.nama  from bkt_01010104_kel a,bkt_01010103_kec b where a.status=1 and a.kode_kec=b.kode and b.kode_kota='.$rowData[0]->kode_kota_lama);
				}
				if(!empty($rowData[0]->kode_kota_baru)){
					$data['kota_baru_list']=DB::select('select kode, nama  from bkt_01010102_kota where status=1 and kode_prop='.$rowData[0]->kode_prop_baru);
					$data['kel_baru_list']=DB::select('select a.kode, a.nama  from bkt_01010104_kel a,bkt_01010103_kec b where a.status=1 and a.kode_kec=b.kode and b.kode_kota='.$rowData[0]->kode_kota_baru);
				}
				return view('HRM/bk020204/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['726'])){
				$data['role_upper'] = null;
				$data['kode_user'] = null;
				$data['kode_role_lama'] = $user->kode_role;
				$data['kode_role_baru'] = null;
				$data['tgl_efektif_role_baru'] = null;
				$data['catatan'] = null;
				$data['uri_img_sk1'] = null;
				$data['uri_img_sk2'] = null;
				$data['uri_img_sk3'] = null;
				$data['divalidasi_oleh'] = null;
				$data['validasi_dt'] = null;
				$data['catatan_validasi'] = null;
				$data['kode_prop_lama'] = $user->wk_kd_prop;
				$data['kode_prop_baru'] = null;
				$data['kode_kota_lama'] = $user->wk_kd_kota;
				$data['kode_kota_baru'] = null;
				$data['kode_kel_lama'] = $user->wk_kd_kel;
				$data['kode_kel_baru'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				if(!empty($user->wk_kd_kota)){
					$data['kota_lama_list']=DB::select('select kode, nama  from bkt_01010102_kota where status=1 and kode_prop='.$user->wk_kd_prop);
				}
				if(!empty($user->wk_kd_kel)){
					$data['kel_lama_list']=DB::select('select a.kode, a.nama  from bkt_01010104_kel a,bkt_01010103_kec b where a.status=1 and a.kode_kec=b.kode and b.kode_kota='.$user->wk_kd_kota);
				}
				return view('HRM/bk020204/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();
		$file = $request->file('uri_img_sk1-input');
		$url = null;
		$upload = false;
		if($request->input('uri_img_sk1-file') != null && $file == null){
			$url = $request->input('uri_img_sk1-file');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_sk2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_sk2-file') != null && $file2 == null){
			$url2 = $request->input('uri_img_sk2-file');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('uri_img_sk2-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_sk2-file') != null && $file3 == null){
			$url3 = $request->input('uri_img_sk2-file');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030204_perubahan_status')->where('kode', $request->input('kode'))
			->update(['kode_jns_perubahan' => 1,
				'kode_role_lama' => $request->input('kode_role_lama'),
				'kode_role_baru' => $request->input('kode_role_baru-input'),
				'tgl_efektif_role_baru' => $request->input('tgl_efektif_role_baru-input'),
				'catatan' => $request->input('catatan-input'),
				'uri_img_sk1' => $url,
				'uri_img_sk2' => $url2,
				'uri_img_sk3' => $url3,
				'status_validasi' => 0,
				'kode_prop_lama' => $request->input('kode_prop_lama'),
				'kode_prop_baru' => $request->input('kode_prop_baru-input'),
				'kode_kota_lama' => $request->input('kode_kota_lama'),
				'kode_kota_baru' => $request->input('kode_kota_baru-input'),
				'kode_kel_lama' => $request->input('kode_kel_lama'),
				'kode_kel_baru' => $request->input('kode_kel_baru-input'),
				'kode_user' => $user->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/promosi'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/promosi'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/promosi'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 727);

		}else{
			DB::table('bkt_02030204_perubahan_status')->insert(
       			['kode_jns_perubahan' => 1,
				'kode_role_lama' => $request->input('kode_role_lama'),
				'kode_role_baru' => $request->input('kode_role_baru-input'),
				'tgl_efektif_role_baru' => $request->input('tgl_efektif_role_baru-input'),
				'catatan' => $request->input('catatan-input'),
				'uri_img_sk1' => $url,
				'uri_img_sk2' => $url2,
				'uri_img_sk3' => $url3,
				'status_validasi' => 0,
				'kode_prop_lama' => $request->input('kode_prop_lama'),
				'kode_prop_baru' => $request->input('kode_prop_baru-input'),
				'kode_kota_lama' => $request->input('kode_kota_lama'),
				'kode_kota_baru' => $request->input('kode_kota_baru-input'),
				'kode_kel_lama' => $request->input('kode_kel_lama'),
				'kode_kel_baru' => $request->input('kode_kel_baru-input'),
				'kode_user' => $user->id,
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/promosi'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/promosi'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/promosi'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 726);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030204_perubahan_status')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 728);
        return Redirect::to('/hrm/management_diri/promosi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 13,
			'kode_menu' => 229,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
