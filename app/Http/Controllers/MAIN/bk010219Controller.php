<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010219Controller extends Controller
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
				if($item->kode_menu==65)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 246);
				return view('MAIN/bk010219/index',$data);
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
			$kota = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
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
				if($item->kode_menu==65)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			    $data['username'] = $user->name;
				$data['kode']=$request->input('kode');
				if($data['kode']!=null && !empty($data['detil']['248'])){
					$rowData = DB::select('select * from bkt_01020211_pelmas_kel where kode='.$data['kode']);
					$data['kode_prop'] = $rowData[0]->kode_prop;
					$data['kode_kota'] = $rowData[0]->kode_kota;
					$data['kode_kec'] = $rowData[0]->kode_kec;
					$data['kode_kel'] = $rowData[0]->kode_kel;
					$data['kode_korkot'] = $rowData[0]->kode_korkot;
					$data['kode_faskel'] = $rowData[0]->kode_faskel;
					$data['id_pelatihan'] = $rowData[0]->id_pelatihan;
					$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
					$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
					$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
					$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
					$data['q_peserta_mbr'] = $rowData[0]->q_peserta_mbr;
					$data['rp_dana_bdi'] = $rowData[0]->rp_dana_bdi;
					$data['rp_dana_swadaya'] = $rowData[0]->rp_dana_swadaya;
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
					$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
					if(!empty($rowData[0]->kode_kec))
						$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
					if(!empty($rowData[0]->kode_prop))
						$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and b.kode_prop='.$rowData[0]->kode_prop);
					if(!empty($rowData[0]->kode_kota))
						$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					if(!empty($rowData[0]->kode_kota))
						$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
					if(!empty($rowData[0]->kode_kel))
						$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
					$data['kode_pelatihan_list'] = DB::select('select * from bkt_01010117_pelatihan_kel where status=1');
					$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
					return view('MAIN/bk010219/create',$data);
				}else if($data['kode']==null && !empty($data['detil']['247'])){
					$data['kode_prop'] = null;
					$data['kode_kota'] = null;
					$data['kode_kec'] = null;
					$data['kode_kel'] = null;
					$data['kode_korkot'] = null;
					$data['kode_faskel'] = null;
					$data['id_pelatihan'] = null;
					$data['tgl_kegiatan'] = null;
					$data['lok_kegiatan'] = null;
					$data['q_peserta_p'] = null;
					$data['q_peserta_w'] = null;
					$data['q_peserta_mbr'] = null;
					$data['rp_dana_bdi'] = null;
					$data['rp_dana_swadaya'] = null;
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
					$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
					$data['kode_kel_list'] = DB::select('select * from bkt_01010104_kel where status=1');
					$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
					$data['kode_kec_list'] = DB::select('select * from bkt_01010103_kec where status=1');
					$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
					$data['kode_faskel_list'] = DB::select('select * from bkt_01010113_faskel');
					$data['kode_pelatihan_list'] = DB::select('select * from bkt_01010117_pelatihan_kel where status=1');
					$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
					return view('MAIN/bk010219/create',$data);
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
			DB::table('bkt_01020211_pelmas_kel')->where('kode', $request->input('kode'))
			->update([
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_faskel' => $request->input('kode-faskel-input'),   
				'id_pelatihan' => $request->input('id-pelatihan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'rp_dana_bdi' => $request->input('rp-bdi-input'),
				'rp_dana_swadaya' => $request->input('rp-swadaya-input'),
				'keterangan' => $request->input('keterangan-input'),
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
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 248);

		}else{
			DB::table('bkt_01020211_pelmas_kel')->insert([
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_korkot' => $request->input('kode-korkot-input'), 
				'kode_faskel' => $request->input('kode-faskel-input'),   
				'id_pelatihan' => $request->input('id-pelatihan-input'), 
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_mbr' => $request->input('q-mbr-input'),
				'rp_dana_bdi' => $request->input('rp-bdi-input'),
				'rp_dana_swadaya' => $request->input('rp-swadaya-input'),
				'keterangan' => $request->input('keterangan-input'),
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
				$file_dokumen->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kelurahan/pelatihan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 247);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==65)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode_prop',
					1 =>'kode_kota',
					2 =>'kode_korkot',
					3 =>'kode_kec',
					4 =>'kode_kel',
					5 =>'kode_faskel',
					6 =>'id_pelatihan',
					7 =>'tgl_kegiatan',
					8 =>'lok_kegiatan',
					9 =>'created_time'
				);
				$query='select a.kode as kode, b.nama as kode_prop, c.nama as kode_kota, d.nama as kode_kec, e.nama as kode_kel, f.nama as kode_korkot, g.nama as kode_faskel, h.nama as id_pelatihan, a.tgl_kegiatan, a.lok_kegiatan, a.created_time from bkt_01020211_pelmas_kel a, bkt_01010101_prop b, bkt_01010102_kota c, bkt_01010103_kec d, bkt_01010104_kel e, bkt_01010111_korkot f, bkt_01010113_faskel g, bkt_01010117_pelatihan_kel h where a.kode_prop = b.kode and a.kode_kota = c.kode and a.kode_kec = d.kode and a.kode_kel = e.kode and a.kode_korkot = f.kode and a.kode_faskel = g.kode and a.id_pelatihan = h.id';
				$totalData = DB::select('select count(1) cnt from bkt_01020211_pelmas_kel a, bkt_01010101_prop b, bkt_01010102_kota c, bkt_01010103_kec d, bkt_01010104_kel e, bkt_01010111_korkot f, bkt_01010113_faskel g, bkt_01010117_pelatihan_kel h where a.kode_prop = b.kode and a.kode_kota = c.kode and a.kode_kec = d.kode and a.kode_kel = e.kode and a.kode_korkot = f.kode and a.kode_faskel = g.kode and a.id_pelatihan = h.id');
				$totalFiltered = $totalData[0]->cnt;
				$limit = $request->input('length');
				$start = $request->input('start');
				$order = $columns[$request->input('order.0.column')];
				$dir = $request->input('order.0.dir');
				if(empty($request->input('search.value')))
				{
					$posts=DB::select($query .' order by a.'.$order.' '.$dir.' limit '.$start.','.$limit);
				}
				else {
					$search = $request->input('search.value');
					$posts=DB::select($query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or h.kode_pelatihan like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.lok_kegiatan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) from ('.$query. ' and (b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or h.kode_pelatihan like "%'.$search.'%" or a.tgl_kegiatan like "%'.$search.'%" or a.lok_kegiatan like "%'.$search.'%")) a');
				}

				$data = array();
				if(!empty($posts))
				{
					foreach ($posts as $post)
					{
						$show =  $post->kode;
						$edit =  $post->kode;
						$delete = $post->kode;

						$url_edit="/main/persiapan/kelurahan/pelatihan/create?kode=".$show;
						$url_delete="/main/persiapan/kelurahan/pelatihan/delete?kode=".$delete;
						$nestedData['kode_prop'] = $post->kode_prop;
						$nestedData['kode_kota'] = $post->kode_kota;
						$nestedData['kode_kec'] = $post->kode_kec;
						$nestedData['kode_kel'] = $post->kode_kel;
						$nestedData['kode_korkot'] = $post->kode_korkot;
						$nestedData['kode_faskel'] = $post->kode_faskel;
						$nestedData['id_pelatihan'] = $post->id_pelatihan;
						$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
						$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
						$nestedData['created_time'] = $post->created_time;
						$nestedData['option'] = "";
						if(!empty($data2['detil']['248']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['249']))
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
		DB::table('bkt_01020211_pelmas_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 249);
        return Redirect::to('/main/persiapan/kelurahan/pelatihan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 65,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
