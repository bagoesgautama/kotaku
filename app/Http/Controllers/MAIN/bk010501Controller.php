<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010501Controller extends Controller
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
				if($item->kode_menu==127)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 396);
				return view('MAIN/bk010501/index',$data);
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
				case when f.kode_ksm is null then "" else f.kode_ksm end kode_ksm,
				case when f.nama is null then "" else f.nama end nama_ksm,
				g.nama nama_kpp,
				h.skala_kegiatan as usulan_skala,
				h.jenis_komponen_keg as usulan_komponen,
				i.nama nama_subkomponen,
				j.nama nama_dtl_subkomponen,
				k.nama nama_kel
			from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent 
				left join bkt_01010120_subkomponen i 
					on (i.id=h.id_subkomponen or i.id=a.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen j 
					on (j.id=h.id_dtl_subkomponen or j.id=a.id_dtl_subkomponen)
				left join bkt_01010104_kel k on k.kode=a.kode_kota
			where a.kode='.$request->input('kode_parent'));
			echo json_encode($data);
		}
	}

	public function Post(Request $request)
	{
		$columns = array(
			1 =>'kode',
			2 =>'kode_parent',
			3 =>'skala_kegiatan',
			4 =>'jns_sumber_dana',
			5 =>'flag_sudah_sertias',
			6 =>'tgl_sertias',
			7 =>'kode_kota',
			8 =>'kode_kawasan',
			9 =>'kode_kel',
			10 =>'tahun',
			11 =>'tgl_realisasi',
			12 =>'vol_realisasi',
			13 =>'satuan',
			14 =>'created_time'
		);
		$query='
			select * from (select 
				a.*,
				a.kode kode_real,
				a.tahun tahun_real,
				case when a.jns_sumber_dana=1 then "BDI / Non BDI" when a.jns_sumber_dana=2 then "Non BDI Kolaborasi" end jns_sumber_dana_convert,
				case when a.skala_kegiatan=1 or h.skala_kegiatan=1 then "Kota/Kabupaten" when a.skala_kegiatan=2 or h.skala_kegiatan=2 then "Desa/Kelurahan" end skala_kegiatan_convert,
				a.jenis_komponen_keg jenis_komponen_keg_real,
				case when a.flag_sudah_sertias=0 then "No" when a.flag_sudah_sertias=1 then "Ya" when a.flag_sudah_sertias is null then "-" end flag_sertias_convert,
				case when a.tgl_sertias is null then "-" else a.tgl_sertias end tgl_sertias_real,	
				a.tgl_realisasi tgl_realisasi_real,
				a.vol_realisasi vol_realisasi_real,
				a.satuan satuan_real,
				case when a.hasil_sertifikasi="KB" then "Kualitas Bagus" when a.hasil_sertifikasi="KC" then "Kualitas Cukup" when a.hasil_sertifikasi="KK" then "Kualitas Kurang" end hasil_sertifikasi_convert,
				b.nama nama_kota,
				c.nama nama_korkot,
				d.nama nama_kmw,
				e.nama nama_kawasan,
				f.nama nama_ksm,
				g.nama nama_kpp,
				h.jenis_komponen_keg as usulan_komponen,
				i.nama nama_subkomponen,
				j.nama nama_dtl_subkomponen,
				case when l.nama is null then "-" else l.nama end nama_kel
			from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent 
				left join bkt_01010120_subkomponen i 
					on (i.id=h.id_subkomponen or i.id=a.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen j 
					on (j.id=h.id_dtl_subkomponen or j.id=a.id_dtl_subkomponen)
				left join bkt_01010104_kel l on l.kode=a.kode_kel
			where 
				a.hasil_sertifikasi is not null) b';
		$totalData = DB::select('select count(1) cnt from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent 
				left join bkt_01010120_subkomponen i 
					on (i.id=h.id_subkomponen or i.id=a.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen j 
					on (j.id=h.id_dtl_subkomponen or j.id=a.id_dtl_subkomponen)
				left join bkt_01010104_kel l on l.kode=a.kode_kel
			where 
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
			$posts=DB::select($query. ' where (
				b.kode_real like "%'.$search.'%" or 
				b.jenis_komponen_keg_real like "%'.$search.'%" or 
				b.usulan_komponen like "%'.$search.'%" or 
				b.nama_subkomponen like "%'.$search.'%" or 
				b.nama_dtl_subkomponen like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kawasan like "%'.$search.'%" or
				b.nama_kel like "%'.$search.'%" or 
				b.skala_kegiatan_convert like "%'.$search.'%" or
				b.tahun_real like "%'.$search.'%" or 
				b.hasil_sertifikasi_convert like "%'.$search.'%" or
				b.flag_sertias_convert like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_real like "%'.$search.'%" or 
				b.jenis_komponen_keg_real like "%'.$search.'%" or 
				b.usulan_komponen like "%'.$search.'%" or 
				b.nama_subkomponen like "%'.$search.'%" or 
				b.nama_dtl_subkomponen like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kawasan like "%'.$search.'%" or 
				b.nama_kel like "%'.$search.'%" or
				b.skala_kegiatan_convert like "%'.$search.'%" or
				b.tahun_real like "%'.$search.'%" or 
				b.hasil_sertifikasi_convert like "%'.$search.'%" or
				b.flag_sertias_convert like "%'.$search.'%")) a');
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

				$url_edit=url('/')."/main/keberlanjutan/kota/serah_terima/create?kode=".$edit;
				$url_delete=url('/')."/main/keberlanjutan/kota/serah_terima/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_real;
				$nestedData['kode_parent'] = $post->jenis_komponen_keg_real.$post->usulan_komponen.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['jns_sumber_dana'] = $post->jns_sumber_dana_convert;
				$nestedData['skala_kegiatan'] = $post->skala_kegiatan_convert;
				$nestedData['flag_sudah_sertias'] = $post->flag_sertias_convert;
				$nestedData['tgl_sertias'] = $post->tgl_sertias_real;
				// $nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				// $nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['kode_kel'] = $post->nama_kel;
				// $nestedData['id_ksm'] = $post->nama_ksm;
				// $nestedData['id_kpp'] = $post->nama_kpp;
				$nestedData['tahun'] = $post->tahun_real;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi_real;
				$nestedData['vol_realisasi'] = $post->vol_realisasi_real;
				$nestedData['satuan'] = $post->satuan_real;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==127)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['398'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				// if(!empty($detil['399'])){
				// 	$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				// }
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
				if($item->kode_menu==127)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['398'])){
				$rowData = DB::select('
				select 
					a.*, b.nama nama_kota,
					c.nama nama_korkot,
					d.nama nama_kmw,
					e.kode_kawasan kode_kawasan,
					e.nama nama_kawasan,
					f.kode_ksm kode_ksm,
					f.nama nama_ksm,
					g.nama nama_kpp,
					h.skala_kegiatan as usulan_skala,
					h.jenis_komponen_keg as usulan_komponen,
					i.nama nama_subkomponen,
					j.nama nama_dtl_subkomponen,
					k.nama nama_kel
				from bkt_01040201_real_keg a
					left join bkt_01010102_kota b on b.kode=a.kode_kota
					left join bkt_01010111_korkot c on c.kode=a.kode_korkot
					left join bkt_01010110_kmw d on d.kode=a.kode_kmw
					left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
					left join bkt_01010128_ksm f on f.id=a.id_ksm
					left join bkt_01010129_kpp g on g.id=a.id_kpp 
					left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent 
					left join bkt_01010120_subkomponen i 
						on (i.id=h.id_subkomponen or i.id=a.id_subkomponen)
					left join bkt_01010121_dtl_subkomponen j 
						on (j.id=h.id_dtl_subkomponen or j.id=a.id_dtl_subkomponen)
					left join bkt_01010104_kel k on k.kode=a.kode_kel
				where a.kode='.$data['kode']);
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['kode_kota'] = $rowData[0]->nama_kota;
				$data['kode_korkot'] = $rowData[0]->nama_korkot;
				// $data['kode_kec'] = $rowData[0]->nama_kec;
				$data['kode_kmw'] = $rowData[0]->nama_kmw;
				$data['kode_kel'] = $rowData[0]->nama_kel;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan.' '.$rowData[0]->nama_kawasan;
				$data['id_ksm'] = $rowData[0]->kode_ksm.' '.$rowData[0]->nama_ksm;
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan.$rowData[0]->usulan_skala;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
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
						b.jenis_komponen_keg usulan_komponen, 
						b.skala_kegiatan usulan_skala,
						c.nama nama_subkomponen,
						d.nama nama_dtl_subkomponen
					from bkt_01040201_real_keg a
						left join bkt_01030208_usulan_keg_kt b on b.kode=a.kode_parent
						left join bkt_01010120_subkomponen c 
							on (c.id=b.id_subkomponen or c.id=a.id_subkomponen)
						left join bkt_01010121_dtl_subkomponen d 
							on (d.id=b.id_dtl_subkomponen or d.id=a.id_dtl_subkomponen)
					where
						a.kode='.$request->input('kode'));
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010501/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['397'])){
				$data['jns_sumber_dana'] = null;
				$data['kode_parent'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kawasan'] = null;
				$data['skala_kegiatan'] = null;
				$data['id_ksm'] = null;
				$data['tahun'] = null;
				$data['tgl_realisasi'] = null;
				$data['vol_realisasi'] = null;
				$data['satuan'] = null;
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
						b.jenis_komponen_keg usulan_komponen, 
						b.skala_kegiatan usulan_skala,
						c.nama nama_subkomponen,
						d.nama nama_dtl_subkomponen
					from bkt_01040201_real_keg a
						left join bkt_01030208_usulan_keg_kt b on b.kode=a.kode_parent
						left join bkt_01010120_subkomponen c 
							on (c.id=b.id_subkomponen or c.id=a.id_subkomponen)
						left join bkt_01010121_dtl_subkomponen d 
							on (d.id=b.id_dtl_subkomponen or d.id=a.id_dtl_subkomponen)
					where
						a.hasil_sertifikasi is not null and
						a.flag_sudah_sertias is null or 
						a.flag_sudah_sertias=0');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010501/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		if(intval($request->input('flag_sudah_sertias'))==0 && $request->input('tgl_sertias')!=null){
			$tgl=null;
		}else{
			$tgl=$request->input('tgl_sertias');
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))
			->update([
				'flag_sudah_sertias' => intval($request->input('flag_sudah_sertias')),
				'tgl_sertias' => $tgl,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 398);

		}else{
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode-parent-input'))
			->update([
				'flag_sudah_sertias' => intval($request->input('flag_sudah_sertias')),
				'tgl_sertias' => $tgl,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Create', 397);
		}
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
			'flag_sudah_sertias' => null,
			'tgl_sertias' => null,
			'updated_by' => Auth::user()->id,
			'updated_time' => date('Y-m-d H:i:s')
			]);
		$this->log_aktivitas('Delete', 399);
        return Redirect::to('/main/keberlanjutan/kota/serah_terima');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 8,
				'kode_menu' => 127,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
