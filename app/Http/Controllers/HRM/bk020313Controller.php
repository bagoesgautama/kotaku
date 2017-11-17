<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020313Controller extends Controller
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
				if($item->kode_menu==225)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 713);
				return view('HRM/bk020313/index',$data);
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
			1 =>'user',
			2 =>'counter_peringatan',
			3 =>'tgl_peringatan',
			4 =>'diverifikasi_oleh',
			5 =>'tgl_verifikasi'
		);
		if($user->kode_role==35){
			$query='select * from (select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030206_peringatan a left join bkt_02010111_user b on a.diverifikasi_oleh=b.id,bkt_02010111_user c
				where a.kode_user=c.id) user';
			$totalData = DB::select('select count(1) cnt from bkt_02030206_peringatan a left join bkt_02010111_user b on a.diverifikasi_oleh=b.id,bkt_02010111_user c
				where a.kode_user=c.id');
		}else{
			$query='select * from (select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030206_peringatan a left join bkt_02010111_user b on a.diverifikasi_oleh=b.id,bkt_02010111_user c
				where a.kode_user=c.id and a.kode_user='.$user->id.'
				union
				select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030206_peringatan a left join bkt_02010111_user b on a.diverifikasi_oleh=b.id,bkt_02010111_user c
				where a.kode_user=c.id and a.kode_user in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.'))) user';
			$totalData = DB::select('select count(1) cnt from bkt_02030206_peringatan a left join bkt_02010111_user b on a.diverifikasi_oleh=b.id,bkt_02010111_user c
				where a.kode_user=c.id and (a.kode_user in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.')) or a.kode_user='.$user->id.')');
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
			$posts=DB::select($query. ' where (verifikator like "%'.$search.'%" or user like "%'.$search.'%" ) order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (user like "%'.$search.'%" or verifikator like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/management_personil/peringatan/create?kode=".$edit;
				$url_delete="/hrm/management_personil/peringatan/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['user'] = $post->user;
				$nestedData['counter_peringatan'] = $post->counter_peringatan;
				$nestedData['tgl_peringatan'] = $post->tgl_peringatan;
				$nestedData['verifikator'] = $post->verifikator;
				$nestedData['tgl_verifikasi'] = $post->tgl_verifikasi;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==225)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['715'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['716']) && empty($nestedData['verifikator']) && $user->id !=$post->kode_user){
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
				if($item->kode_menu==225)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id'] = $user->id;
			$data['kode']=$request->input('kode');
			if($user->kode_role==35){
				$data['user_list']=DB::select('select id,user_name from bkt_02010111_user where status_personil=2');
			}else{
				$data['user_list']=DB::select('select id,user_name from bkt_02010111_user where status_personil=2 and
				id in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.'))');
			}
			if($data['kode']!=null && !empty($data['detil']['715'])){
				$rowData = DB::select('select * from bkt_02030206_peringatan where kode='.$data['kode']);
				$data['kode_user'] = $rowData[0]->kode_user;
				$data['counter_peringatan'] = $rowData[0]->counter_peringatan;
				$data['catatan_peringatan'] = $rowData[0]->catatan_peringatan;
				$data['uri_img_sp1'] = $rowData[0]->uri_img_sp1;
				$data['uri_img_sp2'] = $rowData[0]->uri_img_sp2;
				$data['uri_img_sp3'] = $rowData[0]->uri_img_sp3;
				$data['tgl_peringatan'] = $rowData[0]->tgl_peringatan;
				$data['diverifikasi_oleh'] = $rowData[0]->diverifikasi_oleh;
				$data['tgl_verifikasi'] = $rowData[0]->tgl_verifikasi;
				$data['catatan_verifikasi'] = $rowData[0]->catatan_verifikasi;
				return view('HRM/bk020313/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['714'])){
				$data['kode_user'] = null;
				$data['counter_peringatan'] = null;
				$data['catatan_peringatan'] = null;
				$data['uri_img_sp1'] = null;
				$data['uri_img_sp2'] = null;
				$data['uri_img_sp3'] = null;
				$data['tgl_peringatan'] = null;
				$data['diverifikasi_oleh'] = null;
				$data['tgl_verifikasi'] = null;
				$data['catatan_verifikasi'] = null;
				return view('HRM/bk020313/create',$data);
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
		$file = $request->file('uri_img_sp1-input');
		$url = null;
		$upload = false;
		if($request->input('uri_img_sp1-file') != null && $file == null){
			$url = $request->input('uri_img_sp1-file');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_sp2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_sp2-file') != null && $file2 == null){
			$url2 = $request->input('uri_img_sp2-file');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('uri_img_sp3-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_sp3-file') != null && $file3 == null){
			$url3 = $request->input('uri_img_sp3-file');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030206_peringatan')->where('kode', $request->input('kode'))
			->update(['kode_user' => $request->input('kode_user-input'),
				'counter_peringatan' => $request->input('counter_peringatan-input'),
				'catatan_peringatan' => $request->input('catatan_peringatan-input'),
				'uri_img_sp1' => $url,
				'uri_img_sp2' => $url2,
				'uri_img_sp3' => $url3,
				'tgl_peringatan' => $request->input('tgl_peringatan-input'),
				'diverifikasi_oleh' => $request->input('diverifikasi_oleh-input'),
				'tgl_verifikasi' => $request->input('tgl_verifikasi-input'),
				'catatan_verifikasi' => $request->input('catatan_verifikasi-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/peringatan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/peringatan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/peringatan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 715);

		}else{
			DB::table('bkt_02030206_peringatan')->insert(
       			['kode_user' => $request->input('kode_user-input'),
				'counter_peringatan' => $request->input('counter_peringatan-input'),
				'catatan_peringatan' => $request->input('catatan_peringatan-input'),
				'uri_img_sp1' => $url,
				'uri_img_sp2' => $url2,
				'uri_img_sp3' => $url3,
				'tgl_peringatan' => $request->input('tgl_peringatan-input'),
				'diverifikasi_oleh' => $request->input('diverifikasi_oleh-input'),
				'tgl_verifikasi' => $request->input('tgl_verifikasi-input'),
				'catatan_verifikasi' => $request->input('catatan_verifikasi-input'),
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/peringatan'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/peringatan'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/peringatan'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 714);
		}
		DB::table('bkt_02030205_pesan')->insert(
			['kode_user' => $request->input('kode_user-input'),
			'kode_user_pengirim' => $user->id,
			'text_pesan' => 'Anda menerima peringatan SP ',
			'status' => 0
		]);

	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030206_peringatan')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 716);
        return Redirect::to('/hrm/management_personil/peringatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 225,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
