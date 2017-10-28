<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010406Controller extends Controller
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
				if($item->kode_menu==118)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 366);
				return view('MAIN/bk010406/index',$data);
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
		if(!empty($request->input('kode_parent'))){
			$data = DB::select('select 
				a.*, b.nama nama_kota,
				c.nama nama_korkot,
				d.nama nama_kmw,
				e.kode_kawasan kode_kawasan,
				e.nama nama_kawasan,
				f.nama nama_ksm,
				g.nama nama_kpp,
				h.nama nama_subkomponen,
				i.nama nama_dtl_subkomponen
			from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
				left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
			where a.kode='.$request->input('kode_parent'));
			echo json_encode($data);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode_parent',
			1 =>'jns_sumber_dana',
			2 =>'hasil_sertifikasi',
			3 =>'kode_kota',
			4 =>'kode_kawasan',
			5 =>'tahun',
			6 =>'tgl_realisasi',
			7 =>'vol_realisasi',
			8 =>'satuan',
			9 =>'created_time'
		);
		$query='
			select a.*, b.nama nama_kota, 
				c.nama nama_korkot, 
				d.nama nama_kmw, 
				e.nama nama_kawasan, 
				f.nama nama_ksm,
				g.nama nama_kpp,
				h.nama nama_subkomponen,
				i.nama nama_dtl_subkomponen
			from bkt_01040201_real_keg a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp
				left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
				left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
			where
				a.jns_sumber_dana=2 and
				a.kode_parent is null and
				a.hasil_sertifikasi is not null';
		$totalData = DB::select('select count(1) cnt from bkt_01040201_real_keg a 
				left join bkt_01010102_kota b on b.kode=a.kode_kota 
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp
				left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
				left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
			where
				a.jns_sumber_dana=2 and
				a.kode_parent is null and
				a.hasil_sertifikasi is not null');
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
			$posts=DB::select($query. ' and (
				a.jenis_komponen_keg like "%'.$search.'%" or 
				h.nama like "%'.$search.'%" or 
				i.nama like "%'.$search.'%" or 
				a.hasil_sertifikasi like "%'.$search.'%" or 
				b.nama like "%'.$search.'%" or 
				e.nama like "%'.$search.'%" or  
				a.tahun like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (
				a.jenis_komponen_keg like "%'.$search.'%" or 
				h.nama like "%'.$search.'%" or 
				i.nama like "%'.$search.'%" or 
				a.hasil_sertifikasi like "%'.$search.'%" or 
				b.nama like "%'.$search.'%" or 
				e.nama like "%'.$search.'%" or  
				a.tahun like "%'.$search.'%")) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$jns_sumber_dana = null;

				if($post->jns_sumber_dana == '1'){
					$jns_sumber_dana = 'BDI / Non BDI';
				}elseif($post->jns_sumber_dana == '2'){
					$jns_sumber_dana = 'Non BDI Kolaborasi';
				}

				if($post->hasil_sertifikasi == 'KB'){
					$hasil_sertifikasi = 'Kualitas Baik';
				}elseif($post->hasil_sertifikasi == 'KC'){
					$hasil_sertifikasi = 'Kualitas Cukup';
				}elseif($post->hasil_sertifikasi == 'KK'){
					$hasil_sertifikasi = 'Kualitas Kurang';
				}

				$url_edit=url('/')."/main/pelaksanaan/kota_non/sertifikasi_infra/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kota_non/sertifikasi_infra/delete?kode=".$delete;
				$nestedData['kode_parent'] = $post->jenis_komponen_keg.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['hasil_sertifikasi'] = $hasil_sertifikasi;
				// $nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				// $nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				// $nestedData['id_ksm'] = $post->nama_ksm;
				// $nestedData['id_kpp'] = $post->nama_kpp;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi;
				$nestedData['vol_realisasi'] = $post->vol_realisasi;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==118)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['368'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['369'])){
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
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==118)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['368'])){
				$rowData = DB::select('select 
					a.*, b.nama nama_kota, 
					c.nama nama_korkot, 
					d.nama nama_kmw, 
					e.nama nama_kawasan, 
					f.nama nama_ksm,
					g.nama nama_kpp
				from bkt_01040201_real_keg a 
					left join bkt_01010102_kota b on b.kode=a.kode_kota 
					left join bkt_01010111_korkot c on c.kode=a.kode_korkot 
					left join bkt_01010110_kmw d on d.kode=a.kode_kmw
					left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
					left join bkt_01010128_ksm f on f.id=a.id_ksm
					left join bkt_01010129_kpp g on g.id=a.id_kpp
				where a.kode='.$data['kode']);
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['kode_kota'] = $rowData[0]->nama_kota;
				$data['kode_korkot'] = $rowData[0]->nama_korkot;
				// $data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->nama_kmw;
				// $data['kode_kel'] = $rowData[0]->kode_kel;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = $rowData[0]->nama_kawasan;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
				$data['hasil_sertifikasi'] = $rowData[0]->hasil_sertifikasi;
				$data['flag_sudah_sertias'] = $rowData[0]->flag_sudah_sertias;
				$data['tgl_sertias'] = $rowData[0]->tgl_sertias;
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
				$data['kode_parent_list'] = DB::select('
					select 
						a.*,
						c.nama nama_subkomponen,
						d.nama nama_dtl_subkomponen
					from bkt_01040201_real_keg a
						left join bkt_01010120_subkomponen c on c.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen d on d.id=a.id_dtl_subkomponen 
					where
						a.kode='.$request->input('kode'));
				
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010406/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['367'])){
				$data['jns_sumber_dana'] = 2;
				$data['kode_parent'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				// $data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = null;
				// $data['kode_kel'] = $rowData[0]->kode_kel;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = null;
				$data['tahun'] = null;
				$data['tgl_realisasi'] = null;
				$data['vol_realisasi'] = null;
				$data['satuan'] = null;
				$data['hasil_sertifikasi'] = null;
				$data['flag_sudah_sertias'] = null;
				$data['tgl_sertias'] = null;
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
				$data['kode_parent_list'] = DB::select('
					select 
						a.*,
						c.nama nama_subkomponen,
						d.nama nama_dtl_subkomponen
					from bkt_01040201_real_keg a
						left join bkt_01010120_subkomponen c on c.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen d on d.id=a.id_dtl_subkomponen 
					where
						a.jns_sumber_dana=2 and
						a.kode_parent is null and
						a.hasil_sertifikasi is null');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010406/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create (Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode-parent-input'))
		->update([
			'hasil_sertifikasi' => $request->input('hasil_sertifikasi'),
			// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
			// 'diser_oleh' => $request->input('diser-oleh-input'),
			// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
			// 'diket_oleh' => $request->input('diket-oleh-input'),
			// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
			// 'diver_oleh' => $request->input('diver-oleh-input'),
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')
			]);

		$this->log_aktivitas('Update', 368);
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))
		->update([
			'hasil_sertifikasi' => null,
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')
			]);
		$this->log_aktivitas('Delete', 369);
        return Redirect::to('/main/pelaksanaan/kota_non/sertifikasi_infra');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 7,
				'kode_menu' => 118,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
