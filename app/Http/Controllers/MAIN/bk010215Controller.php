<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010215Controller extends Controller
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
				if($item->kode_menu==66)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 176);
				return view('MAIN/bk010215/index',$data);
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
		if(!empty($request->input('prop'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
			echo json_encode($kmw);
		}
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
		if(!empty($request->input('kec_kel'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec_kel'));
			echo json_encode($kel);
		}
		if(!empty($request->input('kel_faskel'))){
			$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('kel_faskel'));
			echo json_encode($faskel);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==66)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['178'])){
				$rowData = DB::select('select * from bkt_01020201_info_kel where kode='.$data['kode']);
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['cw_q_prop'] = $rowData[0]->cw_q_prop;
				$data['cw_q_kota'] = $rowData[0]->cw_q_kota;
				$data['ca_q_kec'] = $rowData[0]->ca_q_kec;
				$data['ca_q_kel'] = $rowData[0]->ca_q_kel;
				$data['ca_q_dusun'] = $rowData[0]->ca_q_dusun;
				$data['ca_q_rw'] = $rowData[0]->ca_q_rw;
				$data['ca_q_rt'] = $rowData[0]->ca_q_rt;
				$data['lw_l_wil_adm'] = $rowData[0]->lw_l_wil_adm;
				$data['lw_l_wil_adm_kota'] = $rowData[0]->lw_l_wil_adm_kota;
				$data['lw_l_wil_adm_kel'] = $rowData[0]->lw_l_wil_adm_kel;
				$data['lw_l_pmkm'] = $rowData[0]->lw_l_pmkm;
				$data['lw_l_pmkm_kota'] = $rowData[0]->lw_l_pmkm_kota;
				$data['lw_l_pmkm_kel'] = $rowData[0]->lw_l_pmkm_kel;
				$data['cp_q_pdk'] = $rowData[0]->cp_q_pdk;
				$data['cp_q_pdk_w'] = $rowData[0]->cp_q_pdk_w;
				$data['cp_q_kk'] = $rowData[0]->cp_q_kk;
				$data['cp_q_kk_mbr'] = $rowData[0]->cp_q_kk_mbr;
				$data['cp_q_kk_miskin'] = $rowData[0]->cp_q_kk_miskin;
				$data['cp_r_pdt_kpdk'] = $rowData[0]->cp_r_pdt_kpdk;
				$data['cp_t_pdk_thn'] = $rowData[0]->cp_t_pdk_thn;
				$data['km_ds_hkm'] = $rowData[0]->km_ds_hkm;
				$data['km_q_kw_kmh'] = $rowData[0]->km_q_kw_kmh;
				$data['km_q_kec_kmh'] = $rowData[0]->km_q_kec_kmh;
				$data['km_q_kel_kmh'] = $rowData[0]->km_q_kel_kmh;
				$data['km_q_rt_kmh'] = $rowData[0]->km_q_rt_kmh;
				$data['km_q_rt_non_kmh'] = $rowData[0]->km_q_rt_non_kmh;
				$data['lk_l_kw_kmh'] = $rowData[0]->lk_l_kw_kmh;
				$data['lk_l_rt_kmh'] = $rowData[0]->lk_l_rt_kmh;
				$data['cpk_q_pdk'] = $rowData[0]->cpk_q_pdk;
				$data['cpk_q_pdk_w'] = $rowData[0]->cpk_q_pdk_w;
				$data['cpk_q_kk'] = $rowData[0]->cpk_q_kk;
				$data['cpk_q_kk_mbr'] = $rowData[0]->cpk_q_kk_mbr;
				$data['cpk_q_kk_miskin'] = $rowData[0]->cpk_q_kk_miskin;
				$data['cpk_r_pdt_kpdk'] = $rowData[0]->cpk_r_pdt_kpdk;
				$data['cpk_t_pdk_thn'] = $rowData[0]->cpk_t_pdk_thn;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010215/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['177'])){
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['cw_q_prop'] = null;
				$data['cw_q_kota'] = null;
				$data['ca_q_kec'] = null;
				$data['ca_q_kel'] = null;
				$data['ca_q_dusun'] = null;
				$data['ca_q_rw'] = null;
				$data['ca_q_rt'] = null;
				$data['lw_l_wil_adm'] = null;
				$data['lw_l_wil_adm_kota'] = null;
				$data['lw_l_wil_adm_kel'] = null;
				$data['lw_l_pmkm'] = null;
				$data['lw_l_pmkm_kota'] = null;
				$data['lw_l_pmkm_kel'] = null;
				$data['cp_q_pdk'] = null;
				$data['cp_q_pdk_w'] = null;
				$data['cp_q_kk'] = null;
				$data['cp_q_kk_mbr'] = null;
				$data['cp_q_kk_miskin'] = null;
				$data['cp_r_pdt_kpdk'] = null;
				$data['cp_t_pdk_thn'] = null;
				$data['km_ds_hkm'] = null;
				$data['km_q_kw_kmh'] = null;
				$data['km_q_kec_kmh'] = null;
				$data['km_q_kel_kmh'] = null;
				$data['km_q_rt_kmh'] = null;
				$data['km_q_rt_non_kmh'] = null;
				$data['lk_l_kw_kmh'] = null;
				$data['lk_l_rt_kmh'] = null;
				$data['cpk_q_pdk'] = null;
				$data['cpk_q_pdk_w'] = null;
				$data['cpk_q_kk'] = null;
				$data['cpk_q_kk_mbr'] = null;
				$data['cpk_q_kk_miskin'] = null;
				$data['cpk_r_pdt_kpdk'] = null;
				$data['cpk_t_pdk_thn'] = null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kota_list'] = null;
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = null;
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010215/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_dokumen = $request->file('file-dokumen-input');
		$url_dokumen = null;
		$upload_dokumen = false;
		if($request->input('uploaded-file-dokumen') != null && $file_dokumen == null){
			$url_dokumen = $request->input('uploaded-file-dokumen');
			$upload_dokumen = false;
		}elseif($request->input('uploaded-file-dokumen') != null && $file_dokumen != null){
			$url_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}elseif($request->input('uploaded-file-dokumen') == null && $file_dokumen != null){
			$url_dokumen = $file_dokumen->getClientOriginalName();
			$upload_dokumen = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$url_absensi = null;
		$upload_absensi = false;
		if($request->input('uploaded-file-absensi') != null && $file_absensi == null){
			$url_absensi = $request->input('uploaded-file-absensi');
			$upload_absensi = false;
		}elseif($request->input('uploaded-file-absensi') != null && $file_absensi != null){
			$url_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uploaded-file-absensi') == null && $file_absensi != null){
			$url_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020201_info_kel')->where('kode', $request->input('kode'))
			->update([
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'cw_q_prop' => $request->input('cw-q-prop'),
				'cw_q_kota' => $request->input('cw-q-kota'),
				'ca_q_kec' => $request->input('ca-q-kec'),
				'ca_q_kel' => $request->input('ca-q-kel'),
				'ca_q_dusun' => $request->input('ca-q-dusun'), 
				'ca_q_rw' => $request->input('ca-q-rw'),
				'ca_q_rt' => $request->input('ca-q-rt'),
				'lw_l_wil_adm' => $request->input('lw-l-wil-adm'),
				'lw_l_wil_adm_kota' => $request->input('lw-l-wil-adm-kota'),
				'lw_l_wil_adm_kel' => $request->input('lw-l-wil-adm-kel'),
				'lw_l_pmkm' => $request->input('lw-l-pmkm'),
				'lw_l_pmkm_kota' => $request->input('lw-l-pmkm-kota'),
				'lw_l_pmkm_kel' => $request->input('lw-l-pmkm-kel'),
				'cp_q_pdk' => $request->input('cp-q-pdk'),
				'cp_q_pdk_w' => $request->input('cp-q-pdk-w'),
				'cp_q_kk' => $request->input('cp-q-kk'),
				'cp_q_kk_mbr' => $request->input('cp-q-kk-mbr'),
				'cp_q_kk_miskin' => $request->input('cp-q-kk-miskin'),
				'cp_r_pdt_kpdk' => $request->input('cp-r-pdt-kpdk'),
				'cp_t_pdk_thn' => $request->input('cp-t-pdk-thn'),
				'km_ds_hkm' => $request->input('km-ds-hkm'),
				'km_q_kw_kmh' => $request->input('km-q-kw-kmh'),
				'km_q_kec_kmh' => $request->input('km-q-kec-kmh'),
				'km_q_kel_kmh' => $request->input('km-q-kel-kmh'),
				'km_q_rt_kmh' => $request->input('km-q-rt-kmh'),
				'km_q_rt_non_kmh' => $request->input('km-q-rt-non-kmh'),
				'lk_l_kw_kmh' => $request->input('lk-l-kw-kmh'),
				'lk_l_rt_kmh' => $request->input('lk-l-rt-kmh'),
				'cpk_q_pdk' => $request->input('cpk-q-pdk'),
				'cpk_q_pdk_w' => $request->input('cpk-q-pdk-w'),
				'cpk_q_kk' => $request->input('cpk-q-kk'),
				'cpk_q_kk_mbr' => $request->input('cpk-q-kk-mbr'),
				'cpk_q_kk_miskin' => $request->input('cpk-q-kk-miskin'),
				'cpk_r_pdt_kpdk' => $request->input('cpk-r-pdt-kpdk'),
				'cpk_t_pdk_thn' => $request->input('cpk-t-pdk-thn'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 178);

		}else{
			DB::table('bkt_01020201_info_kel')->insert([
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'cw_q_prop' => $request->input('cw-q-prop'),
				'cw_q_kota' => $request->input('cw-q-kota'),
				'ca_q_kec' => $request->input('ca-q-kec'),
				'ca_q_kel' => $request->input('ca-q-kel'),
				'ca_q_dusun' => $request->input('ca-q-dusun'), 
				'ca_q_rw' => $request->input('ca-q-rw'),
				'ca_q_rt' => $request->input('ca-q-rt'),
				'lw_l_wil_adm' => $request->input('lw-l-wil-adm'),
				'lw_l_wil_adm_kota' => $request->input('lw-l-wil-adm-kota'),
				'lw_l_wil_adm_kel' => $request->input('lw-l-wil-adm-kel'),
				'lw_l_pmkm' => $request->input('lw-l-pmkm'),
				'lw_l_pmkm_kota' => $request->input('lw-l-pmkm-kota'),
				'lw_l_pmkm_kel' => $request->input('lw-l-pmkm-kel'),
				'cp_q_pdk' => $request->input('cp-q-pdk'),
				'cp_q_pdk_w' => $request->input('cp-q-pdk-w'),
				'cp_q_kk' => $request->input('cp-q-kk'),
				'cp_q_kk_mbr' => $request->input('cp-q-kk-mbr'),
				'cp_q_kk_miskin' => $request->input('cp-q-kk-miskin'),
				'cp_r_pdt_kpdk' => $request->input('cp-r-pdt-kpdk'),
				'cp_t_pdk_thn' => $request->input('cp-t-pdk-thn'),
				'km_ds_hkm' => $request->input('km-ds-hkm'),
				'km_q_kw_kmh' => $request->input('km-q-kw-kmh'),
				'km_q_kec_kmh' => $request->input('km-q-kec-kmh'),
				'km_q_kel_kmh' => $request->input('km-q-kel-kmh'),
				'km_q_rt_kmh' => $request->input('km-q-rt-kmh'),
				'km_q_rt_non_kmh' => $request->input('km-q-rt-non-kmh'),
				'lk_l_kw_kmh' => $request->input('lk-l-kw-kmh'),
				'lk_l_rt_kmh' => $request->input('lk-l-rt-kmh'),
				'cpk_q_pdk' => $request->input('cpk-q-pdk'),
				'cpk_q_pdk_w' => $request->input('cpk-q-pdk-w'),
				'cpk_q_kk' => $request->input('cpk-q-kk'),
				'cpk_q_kk_mbr' => $request->input('cpk-q-kk-mbr'),
				'cpk_q_kk_miskin' => $request->input('cpk-q-kk-miskin'),
				'cpk_r_pdt_kpdk' => $request->input('cpk-r-pdt-kpdk'),
				'cpk_t_pdk_thn' => $request->input('cpk-t-pdk-thn'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/informasi'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 177);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==66)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'kode_prop',
					2 =>'kode_kota',
					3 =>'kode_kec',
					4 =>'kode_kel',
					5 =>'created_time'
				);
				$query='
					select * from (select 
						a.*,
						a.kode kode_info, 
						b.nama nama_prop, 
						c.nama nama_kota, 
						d.nama nama_kec, 
						e.nama nama_kel, 
						f.nama nama_korkot, 
						g.nama nama_faskel,
						h.nama nama_kmw
					from bkt_01020201_info_kel a
					 	left join bkt_01010101_prop b on a.kode_prop = b.kode
					 	left join bkt_01010102_kota c on a.kode_kota = c.kode
					 	left join bkt_01010103_kec d on a.kode_kec = d.kode
					 	left join bkt_01010104_kel e on a.kode_kel = e.kode
					 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
					 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode) b';
				$totalData = DB::select('select count(1) cnt from bkt_01020201_info_kel a
					 	left join bkt_01010101_prop b on a.kode_prop = b.kode
					 	left join bkt_01010102_kota c on a.kode_kota = c.kode
					 	left join bkt_01010103_kec d on a.kode_kec = d.kode
					 	left join bkt_01010104_kel e on a.kode_kel = e.kode
					 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
					 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode');
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
						b.kode_info like "%'.$search.'%" or 
						b.nama_prop like "%'.$search.'%" or 
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or 
						b.nama_kel like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
						b.kode_info like "%'.$search.'%" or 
						b.nama_prop like "%'.$search.'%" or 
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
						$url_edit="/main/persiapan/kelurahan/info/create?kode=".$show;
						$url_delete="/main/persiapan/kelurahan/info/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode_info;
						$nestedData['kode_prop'] = $post->nama_prop;
						$nestedData['kode_kota'] = $post->nama_kota;
						$nestedData['kode_kec'] = $post->nama_kec;
						$nestedData['kode_kel'] = $post->nama_kel;
						$nestedData['kode_kmw'] = $post->nama_kmw;
						$nestedData['kode_korkot'] = $post->nama_korkot;
						$nestedData['kode_faskel'] = $post->nama_faskel;
						$nestedData['created_time'] = $post->created_time;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['178']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['179']))
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
		DB::table('bkt_01020201_info_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 179);
        return Redirect::to('/main/persiapan/kelurahan/info');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 66,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
