<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010213Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==58)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 118);
				return view('MAIN/bk010213/index',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function select(Request $request)
	{
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		if(!empty($request->input('kota_korkot'))){
			$korkot = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot'));
			echo json_encode($korkot);
		}
		if(!empty($request->input('kota_kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota_kec'));
			echo json_encode($kec);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==58)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'nama_kota',
					2 =>'nama_kec',
					3 =>'tahun',
					4 =>'tgl_kegiatan',
					5 =>'q_anggota_p',
					6 =>'q_anggota_w',
					7 =>'q_anggota_bkm',
					8 =>'total'
				);
				$query='select * from (select
						a.*,
						case when a.tgl_kegiatan is null then "-" else a.tgl_kegiatan end tgl_kegiatan_kolab,
						case when a.jenis_kegiatan="2.4.5" then "Forum Kolaborasi Kota" when a.jenis_kegiatan="2.4.6" then "Forum Kolaborasi Kecamatan" end jenis_kegiatan_convert,
						b.nama nama_kota,
						c.nama nama_korkot,
						case when d.nama is null then "-" else d.nama end nama_kec,
						e.nama nama_kmw,
						(a.q_anggota_p+a.q_anggota_w)total
					from bkt_01020208_kolab_kota a
						left join bkt_01010102_kota b on a.kode_kota = b.kode
						left join bkt_01010111_korkot c on a.kode_korkot = c.kode
						left join bkt_01010103_kec d on a.kode_kec = d.kode
						left join bkt_01010110_kmw e on a.kode_kmw = e.kode
					where
						a.tk_forum = 2 and a.jenis_kegiatan="2.4.6") b';
				$totalData = DB::select('select count(1) cnt from bkt_01020208_kolab_kota a
						left join bkt_01010102_kota b on a.kode_kota = b.kode
						left join bkt_01010111_korkot c on a.kode_korkot = c.kode
						left join bkt_01010103_kec d on a.kode_kec = d.kode
						left join bkt_01010110_kmw e on a.kode_kmw = e.kode
					where
						a.tk_forum = 2 and a.jenis_kegiatan="2.4.6"');
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
						b.tahun like "%'.$search.'%" or
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or
						b.jenis_kegiatan_convert like "%'.$search.'%" or
						b.tgl_kegiatan_kolab like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
						b.tahun like "%'.$search.'%" or
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or
						b.jenis_kegiatan_convert like "%'.$search.'%" or
						b.tgl_kegiatan_kolab like "%'.$search.'%")) a');
					$totalFiltered = $totalFiltered[0]->cnt;
				}

				$data = array();
				if(!empty($posts))
				{
					foreach ($posts as $post)
					{
						$edit =  $post->kode;
						$delete = $post->kode;
						$url_show="/main/persiapan/kecamatan/kolaborasi/show?kode=".$edit;
						$url_edit="/main/persiapan/kecamatan/kolaborasi/create?kode=".$edit;
						$url_delete="/main/persiapan/kecamatan/kolaborasi/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode;
						$nestedData['tahun'] = $post->tahun;
						$nestedData['nama_kota'] = $post->nama_kota;
						$nestedData['nama_kec'] = $post->nama_kec;
						$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
						$nestedData['q_anggota_p'] = $post->q_anggota_p;
						$nestedData['q_anggota_w'] = $post->q_anggota_w;
						$nestedData['q_anggota_bkm'] = $post->q_anggota_bkm;
						$nestedData['total'] = $post->total;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['118']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
						if(!empty($data2['detil']['170']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['171']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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

	public function show(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==58)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['118'])){
				$data['detil_menu']='118';
				$rowData = DB::select('select * from bkt_01020208_kolab_kota where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['tk_forum'] = $rowData[0]->tk_forum;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['q_anggota_bkm'] = $rowData[0]->q_anggota_bkm;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diket_tgl;
				$data['diket_oleh'] = $rowData[0]->diket_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010213/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==58)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['170'])){
				$data['detil_menu']='170';
				$rowData = DB::select('select * from bkt_01020208_kolab_kota where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['tk_forum'] = $rowData[0]->tk_forum;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['q_anggota_p'] = $rowData[0]->q_anggota_p;
				$data['q_anggota_w'] = $rowData[0]->q_anggota_w;
				$data['q_anggota_bkm'] = $rowData[0]->q_anggota_bkm;
				$data['uri_img_document'] = $rowData[0]->uri_img_document;
				$data['uri_img_absensi'] = $rowData[0]->uri_img_absensi;
				$data['diser_tgl'] = $rowData[0]->diser_tgl;
				$data['diser_oleh'] = $rowData[0]->diser_oleh;
				$data['diket_tgl'] = $rowData[0]->diket_tgl;
				$data['diket_oleh'] = $rowData[0]->diket_oleh;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010213/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['169'])){
				$data['detil_menu']='169';
				$data['tahun'] = null;
				$data['tk_forum'] = 2;
				$data['kode_kota'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['jenis_kegiatan'] = '2.4.6';
				$data['tgl_kegiatan'] = null;
				$data['q_anggota_p'] = null;
				$data['q_anggota_w'] = null;
				$data['q_anggota_bkm'] = null;
				$data['uri_img_document'] = null;
				$data['uri_img_absensi'] = null;
				$data['diser_tgl'] = null;
				$data['diser_oleh'] = null;
				$data['diket_tgl'] = null;
				$data['diket_oleh'] = null;
				$data['diver_tgl'] = null;
				$data['diver_oleh'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				$data['kode_korkot_list'] = null;
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010213/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();
		$file_document = $request->file('uri_img_document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uri_img_document-file') != null && $file_document == null){
			$uri_document = $request->input('uri_img_document-file');
			$upload_document = false;
		}elseif($request->input('uri_img_document-file') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uri_img_document-file') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('uri_img_absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uri_img_absensi-file') != null && $file_absensi == null){
			$uri_absensi = $request->input('uri_img_absensi-file');
			$upload_absensi = false;
		}elseif($request->input('uri_img_absensi-file') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uri_img_absensi-file') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		//kalau tidak punya korkot && punya wk_kd_kota
		if($user->wk_kd_kota != null){
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$user->wk_kd_kota);
		}else{
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$request->input('kode-kota-input'));
		}

		//kalau tidak punya kmw && punya wk_kd_prop
		if($user->wk_kd_kota != null){
			$prop_kmw = DB::select('select kode from bkt_01010110_kmw where kode_prop='.$user->wk_kd_prop);
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020208_kolab_kota')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'tk_forum' => 2,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'kode_kec' => $request->input('kode-kec-input'),
				'jenis_kegiatan' => "2.4.6",
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'q_anggota_bkm' => $request->input('q-bkm-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kecamatan/forum/kolaborasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kecamatan/forum/kolaborasi'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 170);

		}else{
			DB::table('bkt_01020208_kolab_kota')->insert([
				'tahun' => $request->input('tahun-input'),
				'tk_forum' => 2,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode,
				'kode_kec' => $request->input('kode-kec-input'),
				'jenis_kegiatan' => "2.4.6",
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'q_anggota_bkm' => $request->input('q-bkm-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kecamatan/forum/kolaborasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kecamatan/forum/kolaborasi'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 169);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020208_kolab_kota')->where('kode', $request->input('kode'))->delete();

		$this->log_aktivitas('Delete', 171);
        return Redirect::to('/main/persiapan/kecamatan/kolaborasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 58,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
