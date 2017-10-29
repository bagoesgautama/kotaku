<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020306Controller extends Controller
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
				if($item->kode_menu==172)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 548);
				return view('HRM/bk020306/index',$data);
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
		$query='select a.kode,e.nama_depan,e.nama_belakang,d.nama perubahan,b.nama role_lama,c.nama role_baru,f.user_name divalidasi_oleh
			from bkt_02030204_perubahan_status a left join bkt_02010111_user f on a.divalidasi_oleh=f.id,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and a.kode_user='.$user->id;
		$totalData = DB::select('select count(1) cnt from bkt_02030204_perubahan_status a,bkt_02010102_role b,bkt_02010102_role c,bkt_02010112_jns_perubahan d,bkt_02010111_user e
			where a.kode_user=e.id
			and a.kode_jns_perubahan=d.kode
			and a.kode_role_lama=b.kode
			and a.kode_role_baru=c.kode and a.kode_user='.$user->id);
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
				$url_edit="/hrm/profil/user/perubahan/create?kode=".$edit;
				$url_delete="/hrm/profil/user/perubahan/delete?kode=".$edit;
				$url_approve="/hrm/profil/user/perubahan/approve?kode=".$edit;
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
						if($item->kode_menu==172)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['550'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['551']) && empty($nestedData['divalidasi_oleh'])){
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
				if($item->kode_menu==172)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['perubahan']=DB::select('select kode,nama from bkt_02010112_jns_perubahan where status=1');
			$data['role']=DB::select('select kode,nama from bkt_02010102_role where status=1');
			$data['prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			$data['kota_lama_list']=[];
			$data['kel_lama_list']=[];
			$data['kota_baru_list']=[];
			$data['kel_baru_list']=[];
			if($data['kode']!=null && !empty($data['detil']['550'])){
				$rowData = DB::select('select * from bkt_02030204_perubahan_status where kode='.$data['kode']);
				$data['kode_jns_perubahan'] = $rowData[0]->kode_jns_perubahan;
				$data['kode_role_lama'] = $rowData[0]->kode_role_lama;
				$data['kode_role_baru'] = $rowData[0]->kode_role_baru;
				$data['tgl_efektif_role_baru'] = $rowData[0]->tgl_efektif_role_baru;
				$data['catatan'] = $rowData[0]->catatan;
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
				return view('HRM/bk020306/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['549'])){
				$data['kode_jns_perubahan'] = null;
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
				return view('HRM/bk020306/create',$data);
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
			->update(['kode_jns_perubahan' => $request->input('kode_jns_perubahan-input'),
				'kode_role_lama' => $request->input('kode_role_lama'),
				'kode_role_baru' => $request->input('kode_role_baru-input'),
				'tgl_efektif_role_baru' => $request->input('tgl_efektif_role_baru-input'),
				'catatan' => $request->input('catatan-input'),
				'uri_img_sk1' => $url,
				'uri_img_sk2' => $url2,
				'uri_img_sk3' => $url3,
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
				$file->move(public_path('/uploads/perubahan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/perubahan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/perubahan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 550);

		}else{
			DB::table('bkt_02030204_perubahan_status')->insert(
       			['kode_jns_perubahan' => $request->input('kode_jns_perubahan-input'),
				'kode_role_lama' => $request->input('kode_role_lama'),
				'kode_role_baru' => $request->input('kode_role_baru-input'),
				'tgl_efektif_role_baru' => $request->input('tgl_efektif_role_baru-input'),
				'catatan' => $request->input('catatan-input'),
				'uri_img_sk1' => $url,
				'uri_img_sk2' => $url2,
				'uri_img_sk3' => $url3,
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
				$file->move(public_path('/uploads/perubahan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/perubahan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/perubahan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 549);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030204_perubahan_status')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 551);
        return Redirect::to('/hrm/profil/user/perubahan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 172,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
