<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010216Controller extends Controller
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
				if($item->kode_menu==62)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 186);
				return view('MAIN/bk010216/index',$data);
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
		// if(!empty($request->input('prop'))){
		// 	$kmw = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
		// 	echo json_encode($kmw);
		// }
		// if(!empty($request->input('kmw'))){
		// 	$kota = DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
		// 	echo json_encode($kota);
		// }
		// if(!empty($request->input('kota_korkot'))){
		// 	$korkot = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$request->input('kota_korkot'));
		// 	echo json_encode($korkot);
		// }
		if(!empty($request->input('kota_kec'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kota_kec'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kec_kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec_kel'));
			echo json_encode($kel);
		}
		// if(!empty($request->input('kel_faskel'))){
		// 	$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('kel_faskel'));
		// 	echo json_encode($faskel);
		// }
	}

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==62)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['186'])){
				$rowData = DB::select('select * from bkt_01020210_sos_rel_kel where kode='.$data['kode']);
				$data['detil_menu']='186';
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
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
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010216/create',$data);
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
				if($item->kode_menu==62)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['188'])){
				$data['detil_menu']='188';
				$rowData = DB::select('select * from bkt_01020210_sos_rel_kel where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
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
					//level kecamatan
				}else if($user->kode_level==4){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
					//level kelurahan
				}else if($user->kode_level==5){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				// if(!empty($rowData[0]->kode_prop))
				// 	$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				// if(!empty($rowData[0]->kode_kota))
				// 	$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				// if(!empty($rowData[0]->kode_kel))
				// 	$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				// $data['kode_unsur_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010216/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['187'])){
				$data['detil_menu']='187';
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['tahun'] = null;
				$data['jenis_kegiatan'] = '2.5.1';
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_peserta_mbr'] = null;
				$data['id_bhn_sosialisasi'] = null;
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
					//level kecamatan
				}else if($user->kode_level==4){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
					//level kelurahan
				}else if($user->kode_level==5){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = null;
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010216/create',$data);
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

		//kalau tidak punya korkot && punya wk_kd_kota
		if($user->wk_kd_kota != null){
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$user->wk_kd_kota);
		}else{
			$kota_korkot = DB::select('select kode from bkt_01010112_kota_korkot where kode_kota='.$request->input('select-kode_kota-input'));
		}

		//kalau tidak punya kmw && punya wk_kd_prop
		if($user->wk_kd_kota != null){
			$prop_kmw = DB::select('select kode from bkt_01010110_kmw where kode_prop='.$user->wk_kd_prop);
		}

		//kalau tidak punya faskel && punya wk_kd_kel
		if($user->wk_kd_kel != null){
			$kel_faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$user->wk_kd_kel);
		}else{
			$kel_faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$request->input('select-kode_kel-input'));
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020210_sos_rel_kel')->where('kode', $request->input('kode'))
			->update([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,  
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode, 
				'kode_faskel' => $user->kode_faskel!=null?$user->kode_faskel:$kel_faskel[0]->kode_faskel,   
				'tahun' => $request->input('tahun-input'),
				'jenis_kegiatan' => $request->input('jenis_kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/sosialisasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/sosialisasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 188);

		}else{
			DB::table('bkt_01020210_sos_rel_kel')->insert([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_kmw' => $user->kode_kmw!=null?$user->kode_kmw:$prop_kmw[0]->kode,  
				'kode_korkot' => $user->kode_korkot!=null?$user->kode_korkot:$kota_korkot[0]->kode, 
				'kode_faskel' => $user->kode_faskel!=null?$user->kode_faskel:$kel_faskel[0]->kode_faskel,   
				'tahun' => $request->input('tahun-input'),
				'jenis_kegiatan' => $request->input('jenis_kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kelurahan/sosialisasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/sosialisasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 187);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==62)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'kode_kota',
					2 =>'kode_kec',
					3 =>'kode_kel',
					4 =>'jenis_kegiatan_convert',
					5 =>'tgl_kegiatan',
					6 =>'q_peserta_p',
					7 =>'q_peserta_w',
					8 =>'q_peserta_mbr'
				);
				$query='
					select * from (select
						a.*,
						a.kode as kode_sos, 
						b.nama as nama_kota, 
						c.nama as nama_kec, 
						d.nama as nama_kel, 
						e.nama as nama_kmw, 
						f.nama as nama_korkot, 
						g.nama as nama_faskel, 
						case when a.jenis_kegiatan="2.5.1" then "Sosialisasi" when a.jenis_kegiatan="2.5.1.4" then "Relawan" when a.jenis_kegiatan="2.5.1.5" then "Agen Sosialisasi" when a.jenis_kegiatan="2.5.3" then "Pelatihan Masyarakat" end jenis_kegiatan_convert, 
						a.tgl_kegiatan tgl_kegiatan_sos, 
						a.lok_kegiatan lok_kegiatan_sos
					from bkt_01020210_sos_rel_kel a
						left join bkt_01010102_kota b on a.kode_kota = b.kode
						left join bkt_01010103_kec c on a.kode_kec = c.kode
						left join bkt_01010104_kel d on a.kode_kel = d.kode
						left join bkt_01010110_kmw e on a.kode_kmw = e.kode
						left join bkt_01010111_korkot f on a.kode_korkot = f.kode
						left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					where
					a.jenis_kegiatan = "2.5.1") b ';
				$totalData = DB::select('select count(1) cnt from bkt_01020210_sos_rel_kel a
						left join bkt_01010102_kota b on a.kode_kota = b.kode
						left join bkt_01010103_kec c on a.kode_kec = c.kode
						left join bkt_01010104_kel d on a.kode_kel = d.kode
						left join bkt_01010110_kmw e on a.kode_kmw = e.kode
						left join bkt_01010111_korkot f on a.kode_korkot = f.kode
						left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					where
					a.jenis_kegiatan = "2.5.1"');
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
						b.kode_sos like "%'.$search.'%" or 
						b.tgl_kegiatan_sos like "%'.$search.'%" or
						b.jenis_kegiatan_convert like "%'.$search.'%" or
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or 
						b.nama_kel like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
						b.kode_sos like "%'.$search.'%" or 
						b.tgl_kegiatan_sos like "%'.$search.'%" or
						b.jenis_kegiatan_convert like "%'.$search.'%" or
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or 
						b.nama_kel like "%'.$search.'%")) a');
					$totalFiltered = $totalFiltered[0]->cnt;
				}

				$data = array();
				if(!empty($posts))
				{
					foreach ($posts as $post)
					{
						$show =  $post->kode;
						$edit =  $post->kode;
						$delete = $post->kode;
						$url_show="/main/persiapan/kelurahan/sosialisasi/show?kode=".$edit;
						$url_edit="/main/persiapan/kelurahan/sosialisasi/create?kode=".$show;
						$url_delete="/main/persiapan/kelurahan/sosialisasi/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode_sos;
						$nestedData['kode_kota'] = $post->nama_kota;
						$nestedData['kode_kec'] = $post->nama_kec;
						$nestedData['kode_kel'] = $post->nama_kel;
						$nestedData['jenis_kegiatan_convert'] = $post->jenis_kegiatan_convert;
						$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
						$nestedData['q_peserta_p'] = $post->q_peserta_p;
						$nestedData['q_peserta_w'] = $post->q_peserta_w;
						$nestedData['q_peserta_mbr'] = $post->q_peserta_mbr;
						$nestedData['option'] = "";

						if(!empty($data2['detil']['186'])){
							$nestedData['option'] =$nestedData['option']."<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
						}
						if(!empty($data2['detil']['188']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['189']))
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

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		
		DB::table('bkt_01020210_sos_rel_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 189);
        return Redirect::to('/main/persiapan/kelurahan/sosialisasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 62,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
