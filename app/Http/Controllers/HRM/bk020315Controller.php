<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020315Controller extends Controller
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
				if($item->kode_menu==227)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 717);
				return view('HRM/bk020315/index',$data);
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
			2 =>'hasil_sdg',
			3 =>'tgl_sidang',
			4 =>'sanksi'
		);
		if($user->kode_role==35){
			$query='select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030209_hsl_sidang_ke a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id';
			$totalData = DB::select('select count(1) cnt from bkt_02030209_hsl_sidang_ke a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id');
		}else{
			$query='select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030209_hsl_sidang_ke a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id and (a.kode_personil in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.')) or a.kode_personil='.$user->id.') ';
			$totalData = DB::select('select count(1) cnt from bkt_02030209_hsl_sidang_ke a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id and (a.kode_personil in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.'))or a.kode_personil='.$user->id.')');
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
			$posts=DB::select($query. ' and (b.user_name like "%'.$search.'%" or c.user_name like "%'.$search.'%" ) order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (b.user_name like "%'.$search.'%" or c.user_name like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				if($post->hasil_sdg==0)
					$nestedData['hasil_sdg'] = 'Tidak Terbukti';
				else
					$nestedData['hasil_sdg'] = 'Terbukti';
				if($post->sanksi==0)
					$nestedData['sanksi'] = 'Pemberhentian';
				else if($post->sanksi==1)
					$nestedData['sanksi'] = 'Peringatan';
				else
					$nestedData['sanksi'] = 'Blacklist';
				$edit =  $post->kode;
				$url_edit="/hrm/management_personil/sidang/create?kode=".$edit;
				$url_delete="/hrm/management_personil/sidang/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['user'] = $post->user;
				$nestedData['tgl_sidang'] = $post->tgl_sidang;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==227)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['719'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['720']) && empty($nestedData['verifikator']) && $user->id !=$post->kode_personil){
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
				if($item->kode_menu==227)
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
			if($data['kode']!=null && !empty($data['detil']['719'])){
				$rowData = DB::select('select * from bkt_02030209_hsl_sidang_ke where kode='.$data['kode']);
				$data['kode_personil'] = $rowData[0]->kode_personil;
				$data['tgl_sidang'] = $rowData[0]->tgl_sidang;
				$data['summary_sdg'] = $rowData[0]->summary_sdg;
				$data['hasil_sdg'] = $rowData[0]->hasil_sdg;
				$data['sanksi'] = $rowData[0]->sanksi;
				$data['uri_img_dok1'] = $rowData[0]->uri_img_dok1;
				$data['uri_img_dok2'] = $rowData[0]->uri_img_dok2;
				$data['uri_img_dok3'] = $rowData[0]->uri_img_dok3;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				return view('HRM/bk020315/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['718'])){
				$data['kode_personil'] = null;
				$data['tgl_sidang'] = null;
				$data['summary_sdg'] = null;
				$data['hasil_sdg'] = null;
				$data['sanksi'] = null;
				$data['uri_img_dok1'] = null;
				$data['uri_img_dok2'] = null;
				$data['uri_img_dok3'] = null;
				$data['diver_tgl'] = null;
				$data['diver_oleh'] = null;
				return view('HRM/bk020315/create',$data);
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
		$file = $request->file('uri_img_dok1-input');
		$url = null;
		$upload = false;
		if($request->input('uri_img_dok1-file') != null && $file == null){
			$url = $request->input('uri_img_dok1-file');
			$upload = false;
		}else if($file != null){
			$url = $user->id."_".$file->getClientOriginalName();
			$upload = true;
		}
		$file2 = $request->file('uri_img_dok2-input');
		$url2 = null;
		$upload2 = false;
		if($request->input('uri_img_dok2-file') != null && $file2 == null){
			$url2 = $request->input('uri_img_dok2-file');
			$upload2 = false;
		}else if($file2 != null){
			$url2 = $user->id."_".$file2->getClientOriginalName();
			$upload2 = true;
		}
		$file3 = $request->file('uri_img_dok3-input');
		$url3 = null;
		$upload3 = false;
		if($request->input('uri_img_dok3-file') != null && $file3 == null){
			$url3 = $request->input('uri_img_dok3-file');
			$upload3 = false;
		}else if($file3 != null){
			$url3 = $user->id."_".$file3->getClientOriginalName();
			$upload3 = true;
		}
		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030209_hsl_sidang_ke')->where('kode', $request->input('kode'))
			->update(['kode_personil' => $request->input('kode_personil-input'),
				'tgl_sidang' => $request->input('tgl_sidang-input'),
				'summary_sdg' => $request->input('summary_sdg-input'),
				'uri_img_dok1' => $url,
				'uri_img_dok2' => $url2,
				'uri_img_dok3' => $url3,
				'hasil_sdg' => $request->input('hasil_sdg-input'),
				'sanksi' => $request->input('sanksi-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			if($upload == true){
				$file->move(public_path('/uploads/sidang'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/sidang'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/sidang'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 719);

		}else{
			DB::table('bkt_02030209_hsl_sidang_ke')->insert(
       			['kode_personil' => $request->input('kode_personil-input'),
				'tgl_sidang' => $request->input('tgl_sidang-input'),
				'summary_sdg' => $request->input('summary_sdg-input'),
				'uri_img_dok1' => $url,
				'uri_img_dok2' => $url2,
				'uri_img_dok3' => $url3,
				'hasil_sdg' => $request->input('hasil_sdg-input'),
				'sanksi' => $request->input('sanksi-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);
			if($upload == true){
				$file->move(public_path('/uploads/sidang'), $user->id."_".$file->getClientOriginalName());
			}
			if($upload2 == true){
				$file2->move(public_path('/uploads/sidang'), $user->id."_".$file2->getClientOriginalName());
			}
			if($upload3 == true){
				$file3->move(public_path('/uploads/sidang'), $user->id."_".$file3->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 718);
		}
		DB::table('bkt_02030205_pesan')->insert(
			['kode_user' => $request->input('kode_personil-input'),
			'kode_user_pengirim' => $user->id,
			'text_pesan' => 'Anda menerima sidang kode etik ',
			'status' => 0
		]);

	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030209_hsl_sidang_ke')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 720);
        return Redirect::to('/hrm/management_personil/sidang');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 227,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
