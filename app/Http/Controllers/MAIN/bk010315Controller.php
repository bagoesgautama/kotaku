<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010315Controller extends Controller
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
				if($item->kode_menu==102)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 309);
				return view('MAIN/bk010315/index',$data);
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
			0 =>'tahun',
			1 => 'skala_kegiatan',
			2 => 'kode_kota',
			3 => 'kode_korkot',
			4 => 'kode_kec',
			5 => 'kode_kmw',
			6 => 'kode_kel',
			7 => 'kode_faskel',
			8 => 'kode_kontraktor',
			9 => 'tgl_mulai_ktrk',
			10 => 'tgl_selesai_ktrk',
			11 => 'jenis_komponen_keg',
			12 => 'id_subkomponen',
			13 => 'id_dtl_subkomponen',
			14 => 'lok_kegiatan',
			15 => 'dk_vol_kegiatan',
			16 => 'dk_satuan',
			17 => 'dk_tipe_penanganan',
			18 => 'nb_apbn_nsup',
			19 => 'nb_apbn_lain',
			20 => 'nb_apbd_prop',
			21 => 'nb_apbd_kota',
			22 => 'nb_lainnya',
			23 => 'uri_img_document',
			24 => 'uri_img_absensi',
			25 => 'diser_tgl',
			26 => 'diser_oleh',
			27 => 'diket_tgl',
			28 => 'diket_oleh',
			29 => 'diver_tgl',
			30 => 'diver_oleh',
			31 => 'created_time',
			32 => 'created_by',
			33 => 'updated_time',
			34	 => 'updated_by'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel 
			from bkt_01030213_ktrk_pkt_krj_kontraktor a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010103_kec d, 
				bkt_01010110_kmw e,
				bkt_01010104_kel f,
				bkt_01010113_faskel g 
			where b.kode=a.kode_kota and c.kode=a.kode_korkot and d.kode=a.kode_kec and e.kode=a.kode_kmw and f.kode=kode_kel and g.kode=kode_faskel ';
			
		$totalData = DB::select('select count(1) cnt from bkt_01030208_usulan_keg_kt ');
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
			$posts=DB::select($query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/perencanaan/kontrak_paket/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kontrak_paket/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['skala_kegiatan'] = $post->skala_kegiatan;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->kode_kec;
				$nestedData['nama_kmw'] = $post->kode_kmw;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['kode_kontraktor'] = $post->kode_kontraktor;
				$nestedData['tgl_mulai_ktrk'] = $post->tgl_mulai_ktrk;
				$nestedData['tgl_selesai_ktrk'] = $post->tgl_selesai_ktrk;
				$nestedData['jenis_komponen_keg'] = $post->jenis_komponen_keg;
				$nestedData['id_subkomponen'] = $post->id_subkomponen;
				$nestedData['id_dtl_subkomponen'] = $post->id_dtl_subkomponen;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				$nestedData['dk_vol_kegiatan'] = $post->dk_vol_kegiatan;
				$nestedData['dk_satuan'] = $post->dk_satuan;
				$nestedData['dk_tipe_penanganan'] = $post->dk_tipe_penanganan;
				$nestedData['nb_apbn_nsup'] = $post->nb_apbn_nsup;
				$nestedData['nb_apbn_lain'] = $post->nb_apbn_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_lainnya'] = $post->nb_lainnya;
				$nestedData['uri_img_document'] = $post->uri_img_document;
				$nestedData['uri_img_absensi'] = $post->uri_img_absensi;
				$nestedData['diser_tgl'] = $post->diser_tgl;
				$nestedData['diser_oleh'] = $post->diser_oleh;
				$nestedData['diket_tgl'] = $post->diket_tgl;
				$nestedData['diket_oleh'] = $post->diket_oleh;
				$nestedData['diver_tgl'] = $post->diver_tgl;
				$nestedData['diver_oleh'] = $post->diver_oleh;
				$nestedData['created_time'] = $post->created_time;
				$nestedData['created_by'] = $post->created_by;
				$nestedData['updated_time'] = $post->updated_time;
				$nestedData['updated_by'] = $post->updated_by;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==102)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['311'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['312'])){
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

	public function select(Request $request)
	{
		if(!empty($request->input('kmw'))){
			$kota = DB::select('select * from bkt_01010110_kmw a,bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$request->input('kmw'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('kota'))){
			$kota = DB::select('select b.* from bkt_01010112_kota_korkot a,bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
			echo json_encode($kota);
		}
		else if(!empty($request->input('korkot'))){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('korkot'));
			echo json_encode($kec);
		}
		if(!empty($request->input('kec'))){
			$kel = DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$request->input('kec'));
			echo json_encode($kel);
		}
		if(!empty($request->input('faskel'))){
			$faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$request->input('faskel'));
			echo json_encode($faskel);
		}
		else if(!empty($request->input('subkomponen'))){
			$kota = DB::select('select b.id, b.nama from bkt_01010120_subkomponen a, bkt_01010121_dtl_subkomponen b where b.id_subkomponen='.$request->input('subkomponen'));
			echo json_encode($kota);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==102)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			if($data['kode']!=null  && !empty($data['detil']['311'])){
				$rowData = DB::select('select * from bkt_01030213_ktrk_pkt_krj_kontraktor where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kontraktor'] = $rowData[0]->kode_kontraktor;
				$data['tgl_mulai_ktrk'] = $rowData[0]->tgl_mulai_ktrk;
				$data['tgl_selesai_ktrk'] = $rowData[0]->tgl_selesai_ktrk;
				$data['jenis_komponen_keg'] = $rowData[0]->jenis_komponen_keg;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['dk_tipe_penanganan'] = $rowData[0]->dk_tipe_penanganan;
				$data['nb_apbn_nsup'] = $rowData[0]->nb_apbn_nsup;
				$data['nb_apbn_lain'] = $rowData[0]->nb_apbn_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;	
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
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
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_kmw))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010110_kmw a, bkt_01010102_kota b where a.kode_prop=b.kode_prop and a.kode='.$rowData[0]->kode_kmw);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				$data['kode_id_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_id_dtl_subkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_kontraktor_list'] = DB::select('select * from bkt_01010126_kontraktor where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010315/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['310'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kontraktor'] = null;
				$data['tgl_mulai_ktrk'] = null;
				$data['tgl_selesai_ktrk'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['lok_kegiatan'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['dk_tipe_penanganan'] = null;
				$data['nb_apbn_nsup'] = null;
				$data['nb_apbn_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_lainnya'] = null;
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
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
				$data['kode_kel_list'] = DB::select('select * from bkt_01010104_kel where status=1');
				$data['kode_id_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				$data['kode_id_dtl_subkomponen_list'] = DB::select('select * from bkt_01010121_dtl_subkomponen where status=1');
				$data['kode_kontraktor_list'] = DB::select('select * from bkt_01010126_kontraktor where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010315/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$file_document = $request->file('file-document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uploaded-file-document') != null && $file_document == null){
			$uri_document = $request->input('uploaded-file-document');
			$upload_document = false;
		}elseif($request->input('uploaded-file-document') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uploaded-file-document') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('file-absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uploaded-file-absensi') != null && $file_absensi == null){
			$uri_absensi = $request->input('uploaded-file-absensi');
			$upload_absensi = false;
		}elseif($request->input('uploaded-file-absensi') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uploaded-file-absensi') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030213_ktrk_pkt_krj_kontraktor')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_kontraktor' => $request->input('select-kode_kontraktor-input'),
				'tgl_mulai_ktrk' => $request->input('tgl_mulai_ktrk-input'),
				'tgl_selesai_ktrk' => $request->input('tgl_selesai_ktrk-input'),
				'jenis_komponen_keg' => $request->input('select-jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_tipe_penanganan' => $request->input('select-dk_tipe_penanganan-input'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup-input'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 311);

		}else{
			DB::table('bkt_01030213_ktrk_pkt_krj_kontraktor')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_kontraktor' => $request->input('select-kode_kontraktor-input'),
				'tgl_mulai_ktrk' => $request->input('tgl_mulai_ktrk-input'),
				'tgl_selesai_ktrk' => $request->input('tgl_selesai_ktrk-input'),
				'jenis_komponen_keg' => $request->input('select-jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'lok_kegiatan' => $request->input('lok_kegiatan-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_tipe_penanganan' => $request->input('select-dk_tipe_penanganan-input'),
				'nb_apbn_nsup' => $request->input('nb_apbn_nsup-input'),
				'nb_apbn_lain' => $request->input('nb_apbn_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 310);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030213_ktrk_pkt_krj_kontraktor')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 312);
        return Redirect::to('/main/perencanaan/kontrak_paket');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 102,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
