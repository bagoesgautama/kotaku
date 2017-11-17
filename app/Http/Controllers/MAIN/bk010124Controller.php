<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010124Controller extends Controller
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
				if($item->kode_menu==142)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$this->log_aktivitas('View', 453);
				return view('MAIN/bk010124/index',$data);
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
			1 =>'kode_bkm',
			2 =>'nama',
			3 =>'jml_anggt',
			4 =>'jml_anggt_w',
			5 =>'jml_anggt_mbr',
			6 =>'status'
		);
		$query='select * from bkt_01010125_bkm where status!=2';
		$totalData = DB::select('select count(1) cnt from bkt_01010125_bkm where status!=2');
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
			$posts=DB::select($query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%")) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->id;
				$delete = $post->id;
				if($post->status == 0){
					$nestedData['status']  = 'Tidak Aktif';
				}elseif($post->status == 1){
					$nestedData['status']  = 'Aktif';
				}
				$url_edit="/main/data_master/bkm/create?id=".$show;
				$url_delete="/main/data_master/bkm/delete?id=".$delete;
				$nestedData['id'] = $post->id;
				$nestedData['kode_bkm'] = $post->kode_bkm;
				$nestedData['nama'] = $post->nama;
				$nestedData['jml_anggt'] = $post->jml_anggt;
				$nestedData['jml_anggt_w'] = $post->jml_anggt_w;
				$nestedData['jml_anggt_mbr'] = $post->jml_anggt_mbr;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==142)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['455'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['456'])){
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

	public function Anggota_post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'kode_bkm',
			2 =>'nama',
			3 =>'jenis_kelamin',
			4 =>'status_sosial',
			5 =>'nama_pendidikan',
			6 =>'nama_pekerjaan',
			7 =>'jml_dukungan'
		);
		$query='
			select * from(select 
				a.*, 
				a.nama nama_anggota,
				case when a.status_sosial="0" then "Miskin dan Rentan" when status_sosial="1" then "Non Miskin" end status_sosial_convert,
				b.nama nama_pendidikan,
				c.nama nama_pekerjaan
			from bkt_01010133_anggt_bkm a
				left join bkt_01010135_tkt_pendidikan b on b.kode=a.kode_pendidikan
				left join bkt_01010134_pekerjaan c on c.kode=a.kode_pekerjaan
			where 
				kode_bkm='.$request->input('kode_bkm').') b';
		$totalData = DB::select('select count(1) cnt from bkt_01010133_anggt_bkm a
				left join bkt_01010135_tkt_pendidikan b on b.kode=a.kode_pendidikan
				left join bkt_01010134_pekerjaan c on c.kode=a.kode_pekerjaan
			where 
				kode_bkm='.$request->input('kode_bkm'));
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
			$posts=DB::select($query. ' where (b.nama_anggota like "%'.$search.'%" or b.status_sosial_convert like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (b.nama_anggota like "%'.$search.'%" or b.status_sosial_convert like "%'.$search.'%")) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$delete = $post->kode;
				$url_edit="/main/data_master/bkm/anggota/create?id=".$show;
				$url_delete="/main/data_master/bkm/anggota/delete?id=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['kode_bkm'] = $post->kode_bkm;
				$nestedData['nama'] = $post->nama_anggota;
				$nestedData['jenis_kelamin'] = $post->jenis_kelamin;
				$nestedData['status_sosial'] = $post->status_sosial_convert;
				$nestedData['nama_pendidikan'] = $post->nama_pendidikan;
				$nestedData['nama_pekerjaan'] = $post->nama_pekerjaan;
				$nestedData['jml_dukungan'] = $post->jml_dukungan;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==142)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['455'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['455'])){
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
		echo 'a';
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==142)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			$data['kode_kota_list'] =[];
			$data['kode_kec_list'] =[];
			$data['kode_kel_list'] =[];
			$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			if($data['id']!=null && !empty($data['detil']['455'])){
				$data['detil_menu']='455';
				$rowData = DB::select('select a.*,b.kode_prop from bkt_01010125_bkm a,bkt_01010102_kota b where a.kode_kota=b.kode and a.id='.$data['id']);
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['nama'] = $rowData[0]->nama;
				$data['nama_koordinator'] = $rowData[0]->nama_koordinator;
				$data['alamat'] = $rowData[0]->alamat;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['tgl_pembentukan'] = $rowData[0]->tgl_pembentukan;
				$data['no_telp'] = $rowData[0]->no_telp;
				$data['tgl_pengesahan_notaris'] = $rowData[0]->tgl_pengesahan_notaris;
				$data['nama_notaris'] = $rowData[0]->nama_notaris;
				$data['nama_bank'] = $rowData[0]->nama_bank;
				$data['no_rek_bank'] = $rowData[0]->no_rek_bank;
				$data['status'] = $rowData[0]->status;
				$data['kode_prop']=$rowData[0]->kode_prop;
				$data['kode_kota_list'] =DB::select('select kode, nama from bkt_01010102_kota where status=1 and kode_prop='.$data['kode_prop']);
				$data['kode_kec_list'] =DB::select('select kode, nama from bkt_01010103_kec where status=1 and kode_kota='.$data['kode_kota']);
				$data['kode_kel_list'] =DB::select('select kode, nama from bkt_01010104_kel where status=1 and kode_kec='.$data['kode_kec']);
				return view('MAIN/bk010124/create',$data);
			}else if($data['id']==null && !empty($data['detil']['454'])){
				$data['detil_menu']='454';
				$data['kode_kota'] = null;
				$data['kode_prop'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_bkm'] = null;
				$data['nama'] = null;
				$data['nama_koordinator'] = null;
				$data['alamat'] = null;
				$data['keterangan'] = null;
				$data['tgl_pembentukan'] = null;
				$data['no_telp'] = null;
				$data['tgl_pengesahan_notaris'] = null;
				$data['nama_notaris'] = null;
				$data['nama_bank'] = null;
				$data['no_rek_bank'] = null;
				$data['status'] = null;
				return view('MAIN/bk010124/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function anggota_create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==142)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id']=$request->input('id');
			$data['kode_kota_list'] =[];
			$data['kode_kec_list'] =[];
			$data['kode_kel_list'] =[];
			$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
			if($data['id']!=null && !empty($data['detil']['455'])){
				$data['detil_menu']='455';
				$rowData = DB::select('select a.*,b.kode_prop from bkt_01010125_bkm a,bkt_01010102_kota b where a.kode_kota=b.kode and a.id='.$data['id']);
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['nama'] = $rowData[0]->nama;
				$data['nama_koordinator'] = $rowData[0]->nama_koordinator;
				$data['alamat'] = $rowData[0]->alamat;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['tgl_pembentukan'] = $rowData[0]->tgl_pembentukan;
				$data['no_telp'] = $rowData[0]->no_telp;
				$data['tgl_pengesahan_notaris'] = $rowData[0]->tgl_pengesahan_notaris;
				$data['nama_notaris'] = $rowData[0]->nama_notaris;
				$data['nama_bank'] = $rowData[0]->nama_bank;
				$data['no_rek_bank'] = $rowData[0]->no_rek_bank;
				$data['status'] = $rowData[0]->status;
				$data['kode_prop']=$rowData[0]->kode_prop;
				$data['kode_kota_list'] =DB::select('select kode, nama from bkt_01010102_kota where status=1 and kode_prop='.$data['kode_prop']);
				$data['kode_kec_list'] =DB::select('select kode, nama from bkt_01010103_kec where status=1 and kode_kota='.$data['kode_kota']);
				$data['kode_kel_list'] =DB::select('select kode, nama from bkt_01010104_kel where status=1 and kode_kec='.$data['kode_kec']);
				return view('MAIN/bk010124/create',$data);
			}else if($data['id']==null && !empty($data['detil']['454'])){
				$data['detil_menu']='454';
				$data['kode_kota'] = null;
				$data['kode_prop'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_bkm'] = null;
				$data['nama'] = null;
				$data['nama_koordinator'] = null;
				$data['alamat'] = null;
				$data['keterangan'] = null;
				$data['tgl_pembentukan'] = null;
				$data['no_telp'] = null;
				$data['tgl_pengesahan_notaris'] = null;
				$data['nama_notaris'] = null;
				$data['nama_bank'] = null;
				$data['no_rek_bank'] = null;
				$data['status'] = null;
				return view('MAIN/bk010124/create',$data);
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
		if ($request->input('id-input')!=null){
			DB::table('bkt_01010125_bkm')->where('id', $request->input('id'))
			->update(['kode_bkm' => $request->input('kode_bkm-input'),
				'kode_kota' => $request->input('kode_kota-input'),
				'kode_kec' => $request->input('kode_kec-input'),
				'kode_kel' => $request->input('kode_kel-input'),
				'kode_bkm' => $request->input('kode_bkm-blm'),
				'nama' => $request->input('nama-input'),
				'nama_koordinator' => $request->input('nama_koordinator-input'),
				'alamat' => $request->input('alamat-input'),
				'keterangan' => $request->input('keterangan-input'),
				'tgl_pembentukan' => $this->date_conversion($request->input('tgl_pembentukan-input')),
				'no_telp' => $request->input('no_telp-input'),
				'tgl_pengesahan_notaris' => $this->date_conversion($request->input('tgl_pengesahan_notaris-input')),
				'nama_notaris' => $request->input('nama_notaris-input'),
				'nama_bank' => $request->input('nama_bank-input'),
				'no_rek_bank' => $request->input('no_rek_bank-input'),
				'status' => $request->input('status-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 455);

		}else{
			DB::table('bkt_01010125_bkm')->insert(
       			['kode_bkm' => $request->input('kode_bkm-input'),
       			'kode_kota' => $request->input('kode_kota-input'),
				'kode_kec' => $request->input('kode_kec-input'),
				'kode_kel' => $request->input('kode_kel-input'),
				'kode_bkm' => $request->input('kode_bkm-blm'),
				'nama' => $request->input('nama-input'),
				'nama_koordinator' => $request->input('nama_koordinator-input'),
				'alamat' => $request->input('alamat-input'),
				'keterangan' => $request->input('keterangan-input'),
				'tgl_pembentukan' => $this->date_conversion($request->input('tgl_pembentukan-input')),
				'no_telp' => $request->input('no_telp-input'),
				'tgl_pengesahan_notaris' => $this->date_conversion($request->input('tgl_pengesahan_notaris-input')),
				'nama_notaris' => $request->input('nama_notaris-input'),
				'nama_bank' => $request->input('nama_bank-input'),
				'no_rek_bank' => $request->input('no_rek_bank-input'),
				'status' => $request->input('status-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 454);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01010125_bkm')->where('id', $request->input('id'))->update(['status' => 2]);
        $this->log_aktivitas('Delete', 456);
        return Redirect::to('/main/data_master/bkm');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 1,
			'kode_modul' => 2,
			'kode_menu' => 142,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
