<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010107Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==24)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 28);
				return view('MAIN/bk010107/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
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
		return view('slum_program',$data);
	}

	public function post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==24)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'nourut',
					1 =>'nama',
					2 =>'keterangan',
					3 =>'nama_kota',
					4 =>'contact_person',
					5 => 'no_phone',
					6 => 'no_fax',
					7 => 'no_hp1',
					8 => 'no_hp2',
					9 => 'email1',
					10 => 'email2',
					11 => 'kode_pms',
					12 => 'tgl_akhir',
					13 => 'tahun',
					14 => 'status',
					15 => 'kode_departemen',
					16 => 'glosary_caption',
					17 => 'created_time',
					18 => 'created_by',
					19 => 'updated_time',
					20 => 'updated_by'
				);

				$query='select a.*, b.nama nama_kota, c.nama nama_pms 	
							from bkt_01010107_slum_program a
							left join bkt_01010102_kota b on a.kode_kota=b.kode and a.status!=2 
							left join bkt_01010115_pms c on a.kode_pms=c.kode ';

				$totalData = DB::select('select count(1) cnt from bkt_01010107_slum_program a
											left join bkt_01010102_kota b on a.kode_kota=b.kode and a.status!=2 
											left join bkt_01010115_pms c on a.kode_pms=c.kode');
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
							a.nourut like "%'.$search.'%" or
							a.nama like "%'.$search.'%" or 
							b.nama like "%'.$search.'%" or
							a.contact_person like "%'.$search.'%" or
							a.no_phone like "%'.$search.'%" or
							a.no_hp1 like "%'.$search.'%" or
							a.no_hp2 like "%'.$search.'%" or
							a.email1 like "%'.$search.'%" or
							a.email2 like "%'.$search.'%" or
							c.nama like "%'.$search.'%" or
							a.tahun like "%'.$search.'%" or
							a.status like "%'.$search.'%" or
							a.kode_departemen like "%'.$search.'%" )
							order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
							a.nourut like "%'.$search.'%" or
							a.nama like "%'.$search.'%" or 
							b.nama like "%'.$search.'%" or
							a.contact_person like "%'.$search.'%" or
							a.no_phone like "%'.$search.'%" or
							a.no_hp1 like "%'.$search.'%" or
							a.no_hp2 like "%'.$search.'%" or
							a.email1 like "%'.$search.'%" or
							a.email2 like "%'.$search.'%" or
							c.nama like "%'.$search.'%" or
							a.tahun like "%'.$search.'%" or
							a.status like "%'.$search.'%" or
							a.kode_departemen like "%'.$search.'%"
							)) a');
					$totalFiltered=$totalFiltered[0]->cnt;
				}

				$data = array();
				if(!empty($posts))
				{
					foreach ($posts as $post)
					{
						if($post->status == 0){
							$status = 'Tidak Aktif';
						}elseif($post->status == 1){
							$status = 'Aktif';
						}elseif($post->status == 2){
							$status = 'Dihapus';
						}
						$show =  $post->kode;
						$delete = $post->kode;
						$url_edit="/main/slum_program/create?kode=".$show;
						$url_delete="/main/slum_program/delete?kode=".$delete;
						$nestedData['nourut'] = $post->nourut;
						$nestedData['nama'] = $post->nama;
						$nestedData['keterangan'] = $post->keterangan;
						$nestedData['nama_kota'] = $post->nama_kota;
						$nestedData['contact_person'] = $post->contact_person;
						$nestedData['no_phone'] = $post->no_phone;
						$nestedData['no_fax'] = $post->no_fax;
						$nestedData['no_hp1'] = $post->no_hp1;
						$nestedData['no_hp2'] = $post->no_hp2;
						$nestedData['email1'] = $post->email1;
						$nestedData['email2'] = $post->email2;
						$nestedData['nama_pms'] = $post->nama_pms;
						$nestedData['tgl_akhir'] = $post->tgl_akhir;
						$nestedData['tahun'] = $post->tahun;
						$nestedData['status'] = $post->status;
						$nestedData['kode_departemen'] = $post->kode_departemen;
						$nestedData['glosary_caption'] = $post->glosary_caption;
						$nestedData['created_time'] = $post->created_time;
						$nestedData['created_by'] = $post->created_by;
						$nestedData['updated_time'] = $post->updated_time;
						$nestedData['updated_by'] = $post->updated_by;

						$option = '';
						if(!empty($data2['detil']['30'])){
							$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						}
						if(!empty($data2['detil']['31'])){
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
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==24)
					$data['detil'][$item->kode_menu_detil]='a';
		}

		$data['username'] = $user->name;
		$data['test']=true;
		$data['kode']=$request->input('kode');

		//get dropdown list from Database
		$kode_kota = DB::select('select kode, nama from bkt_01010102_kota where status=1');
		$data['kode_kota_list'] = $kode_kota;

		$kode_pms = DB::select('select kode, nama from bkt_01010115_pms where status=1');
		$data['kode_pms_list'] = $kode_pms;
		$data['tahun_list'] = DB::select('select * from list_tahun');

		if($data['kode']!=null && !empty($data['detil']['30'])){
			$rowData = DB::select('select * from bkt_01010107_slum_program where kode='.$data['kode']);
			$data['nourut'] = $rowData[0]->nourut;
			$data['nama'] = $rowData[0]->nama;
			$data['keterangan'] = $rowData[0]->keterangan;
			$data['kode_kota'] = $rowData[0]->kode_kota;
			$data['alamat'] = $rowData[0]->alamat;
			$data['kodepos'] = $rowData[0]->kodepos;
			$data['contact_person'] = $rowData[0]->contact_person;
			$data['no_phone'] = $rowData[0]->no_phone;
			$data['no_fax'] = $rowData[0]->no_fax;
			$data['no_hp1'] = $rowData[0]->no_hp1;
			$data['no_hp2'] = $rowData[0]->no_hp2;
			$data['email1'] = $rowData[0]->email1;
			$data['email2'] = $rowData[0]->email2;
			$data['kode_pms'] = $rowData[0]->kode_pms;
			$data['tgl_akhir'] = $rowData[0]->tgl_akhir;
			$data['tahun'] = $rowData[0]->tahun;
			$data['status'] = $rowData[0]->status;
			$data['kode_departemen'] = $rowData[0]->kode_departemen;
			$data['glosary_caption'] = $rowData[0]->glosary_caption;
			$data['created_time'] = $rowData[0]->created_time;
			$data['created_by'] = $rowData[0]->created_by;
			$data['updated_time'] = $rowData[0]->updated_time;
			$data['updated_by'] = $rowData[0]->updated_by;
			return view('MAIN/bk010107/create',$data);
		}else if($data['kode']==null && !empty($data['detil']['29'])){
			$data['nourut'] = null;
			$data['nama'] = null;
			$data['keterangan'] = null;
			$data['kode_kota'] = null;
			$data['alamat'] = null;
			$data['kodepos'] = null;
			$data['contact_person'] = null;
			$data['no_phone'] = null;
			$data['no_fax'] = null;
			$data['no_hp1'] = null;
			$data['no_hp2'] = null;
			$data['email1'] = null;
			$data['email2'] = null;
			$data['kode_pms'] = null;
			$data['tgl_akhir'] = null;
			$data['tahun'] = null;
			$data['status'] = null;
			$data['kode_departemen'] = null;
			$data['glosary_caption'] = null;
			$data['created_time'] = null;
			$data['created_by'] = null;
			$data['updated_time'] = null;
			$data['updated_by'] = null;

			return view('MAIN/bk010107/create',$data);
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
			$date = strtotime($request->input('tgl_akhir-input'));
        	$date_convert = date('Y-m-d', $date);
			DB::table('bkt_01010107_slum_program')->where('kode', $request->input('kode'))
			->update(
				['nourut' => $request->input('no_urut-input'),
				'nama' => $request->input('nama-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'alamat' => $request->input('alamat-input'),
				'kodepos' => $request->input('kodepos-input'),
				'contact_person' => $request->input('contact_person-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_fax' => $request->input('no_fax-input'),
				'no_hp1' => $request->input('no_hp1-input'),
				'no_hp2' => $request->input('no_hp2-input'),
				'email1' => $request->input('email1-input'),
				'email2' => $request->input('email2-input'),
				'kode_pms' => $request->input('select-kode_pms-input'),
				'tgl_akhir' => $date_convert,
				'tahun' => $request->input('tahun-input'),
				'status' => $request->input('select-status-input'),
				'kode_departemen' => $request->input('kode_departemen-input'),
				'glosary_caption' => $request->input('glosary_caption-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 30);
		}else{
			$date = strtotime($request->input('tgl_akhir-input'));
        	$date_convert = date('Y-m-d', $date);
			DB::table('bkt_01010107_slum_program')->insert(
       			['nourut' => $request->input('no_urut-input'),
				'nama' => $request->input('nama-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'alamat' => $request->input('alamat-input'),
				'kodepos' => $request->input('kodepos-input'),
				'contact_person' => $request->input('contact_person-input'),
				'no_phone' => $request->input('no_phone-input'),
				'no_fax' => $request->input('no_fax-input'),
				'no_hp1' => $request->input('no_hp1-input'),
				'no_hp2' => $request->input('no_hp2-input'),
				'email1' => $request->input('email1-input'),
				'email2' => $request->input('email2-input'),
				'kode_pms' => $request->input('select-kode_pms-input'),
				'tgl_akhir' => $date_convert,
				'tahun' => $request->input('tahun-input'),
				'status' => $request->input('select-status-input'),
				'kode_departemen' => $request->input('kode_departemen-input'),
				'glosary_caption' => $request->input('glosary_caption-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 29);
		}
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010107_slum_program')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 31);
        return Redirect::to('main/slum_program');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 2,
				'kode_menu' => 24,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
