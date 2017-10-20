<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010314Controller extends Controller
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
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 301);
				return view('MAIN/bk010314/index',$data);
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
			1 => 'kode_kota',
			2 => 'kode_korkot',
			3 => 'kode_kec',
			4 => 'kode_kmw',
			5 => 'kode_kel',
			6 => 'kode_faskel',
			7 => 'kode_pkt_krj',
			8 => 'tgl_lelang_mulai',
			9 => 'tgl_lelang_selesai',
			10 => 'nomor_kontrak',
			11 => 'sd_apbn_nsup',
			12 => 'sd_apbn_lain',
			13 => 'sd_apbd_prop',
			14 => 'sd_apbd_kota',
			15 => 'sd_swasta',
			16 => 'keterangan',
			17 => 'uri_img_document',
			18 => 'uri_img_absensi',
			19 => 'diser_tgl',
			20 => 'diser_oleh',
			21 => 'diket_tgl',
			22 => 'diket_oleh',
			23 => 'diver_tgl',
			24 => 'diver_oleh',
			25 => 'created_time',
			26 => 'created_by',
			27 => 'updated_time',
			28 => 'updated_by',
			29 => 'nama_paket'
		);
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel 
			from bkt_01030209_pkt_krj_kontraktor a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010110_kec d, 
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

				$url_edit=url('/')."/main/perencanaan/pengadaan_lelang/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/pengadaan_lelang/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->kode_kec;
				$nestedData['nama_kmw'] = $post->kode_kmw;
				$nestedData['kode_kel'] = $post->kode_kel;
				$nestedData['kode_faskel'] = $post->kode_faskel;
				$nestedData['kode_pkt_krj'] = $post->kode_pkt_krj;
				$nestedData['tgl_lelang_mulai'] = $post->tgl_lelang_mulai;
				$nestedData['tgl_lelang_selesai'] = $post->tgl_lelang_selesai;
				$nestedData['nomor_kontrak'] = $post->nomor_kontrak;
				$nestedData['sd_apbn_nsup'] = $post->sd_apbn_nsup;
				$nestedData['sd_apbn_lain'] = $post->sd_apbn_lain;
				$nestedData['sd_apbd_prop'] = $post->sd_apbd_prop;
				$nestedData['sd_apbd_kota'] = $post->sd_apbd_kota;
				$nestedData['sd_swasta'] = $post->sd_swasta;
				$nestedData['keterangan'] = $post->keterangan;
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
				$nestedData['nama_paket'] = $post->nama_paket;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==106)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['303'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['305'])){
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
		// if(!empty($request->input('prop'))){
		// 	$kota = DB::select('select kode, nama from bkt_01010102_kota where kode_prop='.$request->input('prop'));
		// 	echo json_encode($kota);
		// }
		// else if(!empty($request->input('kota'))){
		// 	$kota = DB::select('select b.* from bkt_01010112_kota_korkot a,bkt_01010111_korkot b where a.kode_korkot=b.kode and kode_kota='.$request->input('kota'));
		// 	echo json_encode($kota);
		// }
		// else if(!empty($request->input('korkot'))){
		// 	$kota = DB::select('select a.* from bkt_01010103_kec a where a.kode_kota='.$request->input('korkot'));
		// 	echo json_encode($kota);
		// }
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			if($data['kode']!=null  && !empty($data['detil']['303'])){
				$rowData = DB::select('select * from bkt_01030209_pkt_krj_kontraktor where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_pkt_krj'] = $rowData[0]->kode_pkt_krj;
				$data['tgl_lelang_mulai'] = $rowData[0]->tgl_lelang_mulai;
				$data['tgl_lelang_selesai'] = $rowData[0]->tgl_lelang_selesai;
				$data['nomor_kontrak'] = $rowData[0]->nomor_kontrak;
				$data['sd_apbn_nsup'] = $rowData[0]->sd_apbn_nsup;
				$data['sd_apbn_lain'] = $rowData[0]->sd_apbn_lain;
				$data['sd_apbd_prop'] = $rowData[0]->sd_apbd_prop;
				$data['sd_apbd_kota'] = $rowData[0]->sd_apbd_kota;
				$data['sd_swasta'] = $rowData[0]->sd_swasta;
				$data['keterangan'] = $rowData[0]->keterangan;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				$data['nama_paket'] = $rowData[0]->nama_paket;
				return view('MAIN/bk010314/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['302'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_pkt_krj'] = null;
				$data['tgl_lelang_mulai'] = null;
				$data['tgl_lelang_selesai'] = null;
				$data['nomor_kontrak'] = null;
				$data['sd_apbn_nsup'] = null;
				$data['sd_apbn_lain'] = null;
				$data['sd_apbd_prop'] = null;
				$data['sd_apbd_kota'] = null;
				$data['sd_swasta'] = null;
				$data['keterangan'] = null;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				$data['nama_paket'] = null;
				return view('MAIN/bk010314/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01030209_pkt_krj_kontraktor')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_pkt_krj' => $request->input('kode_pkt_krj-input'),
				'tgl_lelang_mulai' => $this->date_conversion($request->input('tgl_lelang_mulai-input')),
				'tgl_lelang_selesai' => $this->date_conversion($request->input('tgl_lelang_selesai-input')),
				'nomor_kontrak' => $request->input('nomor_kontrak-input'),
				'sd_apbn_nsup' => $request->input('sd_apbn_nsup-input'),
				'sd_apbn_lain' => $request->input('sd_apbn_lain-input'),
				'sd_apbd_prop' => $request->input('sd_apbd_prop-input'),
				'sd_apbd_kota' => $request->input('sd_apbd_kota-input'),
				'sd_swasta' => $request->input('sd_swasta-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'nama_paket' => $request->input('nama_paket-input'),
				]);

			$this->log_aktivitas('Update', 303);

		}else{
			DB::table('bkt_01030209_pkt_krj_kontraktor')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_pkt_krj' => $request->input('kode_pkt_krj-input'),
				'tgl_lelang_mulai' => $this->date_conversion($request->input('tgl_lelang_mulai-input')),
				'tgl_lelang_selesai' => $this->date_conversion($request->input('tgl_lelang_selesai-input')),
				'nomor_kontrak' => $request->input('nomor_kontrak-input'),
				'sd_apbn_nsup' => $request->input('sd_apbn_nsup-input'),
				'sd_apbn_lain' => $request->input('sd_apbn_lain-input'),
				'sd_apbd_prop' => $request->input('sd_apbd_prop-input'),
				'sd_apbd_kota' => $request->input('sd_apbd_kota-input'),
				'sd_swasta' => $request->input('sd_swasta-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id,
				'nama_paket' => $request->input('nama_paket-input')
       			]);

			$this->log_aktivitas('Create', 302);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030209_pkt_krj_kontraktor')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 304);
        return Redirect::to('/main/perencanaan/infra/penyiapan_paket');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 100,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
