<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020111Controller extends Controller
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
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==180)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 566);
				return view('HRM/bk020111/index',$data);
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
			1 =>'user_name',
			2 =>'email',
			3 =>'nama_depan',
			4 =>'status_personil',
			5 =>'status_aktif',
			6 =>'flag_blacklist',
			7 =>'created_time'
		);
		$query='
			select * from (select 
				a.*,
				a.id as id_u,
				a.user_name as user_name_u,
				a.email email_u,
				a.nama_depan nama_depan_u,
				case when a.status_personil=0 then "Belum Diverifikasi" when a.status_personil=1 then "Registrasi Berhasil" when a.status_personil=2 then "Registrasi Ditolak" end status_personil_convert,
				case when a.status_aktif=0 then "Belum Reaktivasi" when a.status_aktif=1 then " Aktif Kontrak" end status_aktif_convert,
				case when a.flag_blacklist=0 then "Tidak" when a.flag_blacklist=1 then "Ya" end blacklist_convert
			from bkt_02010111_user a
			where 
				a.jenis_registrasi=1) b';
		$totalData = DB::select('select count(1) cnt from bkt_02010111_user a
			where 
				a.jenis_registrasi=1');
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
			$posts=DB::select($query. ' where (
				b.id_u like "%'.$search.'%" or 
				b.user_name_u like "%'.$search.'%" or
				b.email_u like "%'.$search.'%" or
				b.nama_depan_u like "%'.$search.'%" or
				b.status_personil_convert like "%'.$search.'%" or
				b.status_aktif_convert like "%'.$search.'%" or
				b.blacklist_convert like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.id_u like "%'.$search.'%" or 
				b.user_name_u like "%'.$search.'%" or
				b.email_u like "%'.$search.'%" or
				b.nama_depan_u like "%'.$search.'%" or
				b.status_personil_convert like "%'.$search.'%" or
				b.status_aktif_convert like "%'.$search.'%" or
				b.blacklist_convert like "%'.$search.'%")) a');
			$totalFiltered = $totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->id;
				$edit =  $post->id;
				$delete = $post->id;
				$url_edit=url('/')."/hrm/admin/registrasi_manual/create?kode=".$show;
				$url_delete=url('/')."/hrm/admin/registrasi_manual/delete?kode=".$delete;
				$nestedData['id'] = $post->id;
				$nestedData['user_name'] = $post->user_name;
				$nestedData['email'] = $post->email;
				$nestedData['nama_depan'] = $post->nama_depan;
				$nestedData['status_personil'] = $post->status_personil_convert;
				$nestedData['status_aktif'] = $post->status_aktif_convert;
				$nestedData['flag_blacklist'] = $post->blacklist_convert;
				$nestedData['created_time'] = $post->created_time;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==180)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['568'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['569'])){
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
				if($item->kode_menu==180)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = '';
		$data['test']=true;
		$data['kode']=$request->input('kode');
		
		if($data['kode']!=null && !empty($data['detil']['568'])){
			$rowData = DB::select('select * from bkt_02010111_user where kode='.$data['kode']);
			$data['user_name'] = $rowData[0]->user_name;
			$data['password'] = $rowData[0]->password;
			$data['nama_depan'] = $rowData[0]->nama_depan;
			$data['nama_belakang'] = $rowData[0]->nama_belakang;
			$data['kode_level'] = $rowData[0]->kode_level;
			$data['kode_role'] = $rowData[0]->kode_role;
			$data['wk_kd_prop'] = $rowData[0]->wk_kd_prop;
			$data['wk_kd_kota'] = $rowData[0]->wk_kd_kota;
			$data['wk_kd_kel'] = $rowData[0]->wk_kd_kel;
			$data['kode_kmp'] = $rowData[0]->kode_kmp;
			$data['kode_kmw'] = $rowData[0]->kode_kmw;
			$data['kode_korkot'] = $rowData[0]->kode_korkot;
			$data['kode_faskel'] = $rowData[0]->kode_faskel;
			$data['alamat'] = $rowData[0]->alamat;
			$data['kode_jenis_kelamin'] = $rowData[0]->kode_jenis_kelamin;
			$data['kode_kota_lahir'] = $rowData[0]->kode_kota_lahir;
			$data['tgl_lahir'] = $rowData[0]->tgl_lahir;
			$data['kode_prop'] = $rowData[0]->kode_prop;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['kode_kec'] = $rowData[0]->kode_kec;
			$data['kode_kel'] = $rowData[0]->kode_kel;
			$data['kodepos'] = $rowData[0]->kodepos;
			$data['email'] = $rowData[0]->email;
			$data['no_hp'] = $rowData[0]->no_hp;
			$data['jenis_registrasi'] = $rowData[0]->jenis_registrasi;
			$data['status_registrasi'] = $rowData[0]->status_registrasi;
			$data['validated_by'] = $rowData[0]->validated_by;
			$data['validated_time'] = $rowData[0]->validated_time;
			$data['validation_note'] = $rowData[0]->validation_note;
			$data['status_personil'] = $rowData[0]->status_personil;
			$data['no_kontrak_personil'] = $rowData[0]->no_kontrak_personil;
			$data['tgl_akhir_kontrak'] = $rowData[0]->tgl_akhir_kontrak;
			$data['status_aktif'] = $rowData[0]->status_aktif;
			$data['tgl_aktivasi'] = $rowData[0]->tgl_aktivasi;
			$data['flag_blacklist'] = $rowData[0]->flag_blacklist;
			$data['blacklist_dt'] = $rowData[0]->blacklist_dt;
			$data['blacklist_by'] = $rowData[0]->blacklist_by;
			$data['blacklist_notes'] = $rowData[0]->blacklist_notes;
			$data['uri_img_profile'] = $rowData[0]->uri_img_profile;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			$data['kode_level_list'] = DB::select('select kode, nama from bkt_02010101_role_level where status=1');
			if(!empty($rowData[0]->kode_level)){
				$data['kode_role_list'] = DB::select('select kode, nama, flag_koordinator from bkt_02010102_role where kode_level='.$rowData[0]->kode_level);
			$data['prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			}

			return view('HRM/bk020111/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['567'])){
			$data['user_name'] = null;
			$data['password'] = null;
			$data['nama_depan'] = null;
			$data['nama_belakang'] = null;
			$data['kode_level'] = null;
			$data['kode_role'] = null;
			$data['wk_kd_prop'] = null;
			$data['wk_kd_kota'] = null;
			$data['wk_kd_kel'] = null;
			$data['kode_kmp'] = null;
			$data['kode_kmw'] = null;
			$data['kode_korkot'] = null;
			$data['kode_faskel'] = null;
			$data['alamat'] = null;
			$data['kode_jenis_kelamin'] = null;
			$data['kode_kota_lahir'] = null;
			$data['tgl_lahir'] = null;
			$data['kode_prop'] = null;
			$data['kode_kota'] = null;
			$data['kode_kec'] = null;
			$data['kode_kel'] = null;
			$data['kodepos'] = null;
			$data['email'] = null;
			$data['no_hp'] = null;
			$data['jenis_registrasi'] = null;
			$data['status_registrasi'] = null;
			$data['validated_by'] = null;
			$data['validated_time'] = null;
			$data['validation_note'] = null;
			$data['status_personil'] = null;
			$data['no_kontrak_personil'] = null;
			$data['tgl_akhir_kontrak'] = null;
			$data['status_aktif'] = null;
			$data['tgl_aktivasi'] = null;
			$data['flag_blacklist'] = null;
			$data['blacklist_dt'] = null;
			$data['blacklist_by'] = null;
			$data['blacklist_notes'] = null;
			$data['uri_img_profile'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;
			$data['kode_level_list'] = DB::select('select kode, nama from bkt_02010101_role_level where status=1');
			$data['kode_level_list'] = null;
			$data['prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			$data['kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');

		return view('HRM/bk020111/create',$data);
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
		if ($request->input('example-id-input')!=null){
			DB::table('bkt_02010102_role')->where('kode', $request->input('example-id-input'))
			->update(['nama' => $request->input('example-text-input'),
				'deskripsi' => $request->input('example-textarea-input'),
				'status' => $request->input('example-select'),
				'kode_level' => $request->input('example-select-level'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
		$this->log_aktivitas('Update', 17);
		}else{
			DB::table('bkt_02010102_role')->insert(
       			['nama' => $request->input('example-text-input'),
       			'deskripsi' => $request->input('example-textarea-input'),
       			'status' => $request->input('example-select'),
       			'kode_level' => $request->input('example-select-level'),
       			'created_by' => Auth::user()->id
       			]);
		$this->log_aktivitas('Create', 16);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02010102_role')->where('kode', $request->input('kode'))
			->update(['status' => '2',
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
        $this->log_aktivitas('Delete', 18);
        return Redirect::to('/hrm/admin/role');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 2,
				'kode_modul' => 4,
				'kode_menu' => 180,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
