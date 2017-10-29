<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010502Controller extends Controller
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
				if($item->kode_menu==128)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 400);
				return view('MAIN/bk010502/index',$data);
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
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_real_keg',
			3 =>'skala_kegiatan',
			4 =>'jns_sumber_dana',
			5 =>'flag_sudah_sertias',
			6 =>'tgl_sertias',
			7 =>'hasil_sertifikasi',
			8 =>'kode_kota',
			9 =>'kode_kawasan',
			10 =>'kode_kel',
			11 =>'tgl_realisasi',
			12 =>'vol_realisasi',
			13 =>'satuan',
			14 =>'created_time'
		);
		$query='
			select 
				a.*,
				b.jns_sumber_dana,
				b.skala_kegiatan,
				b.jenis_komponen_keg,
				b.id_subkomponen,
				b.id_dtl_subkomponen,
				b.flag_sudah_sertias,
				b.tgl_sertias,	
				b.tgl_realisasi,
				b.vol_realisasi,
				b.satuan,
				b.hasil_sertifikasi, 
				c.nama nama_kota,
				d.nama nama_korkot,
				e.nama nama_kmw,
				f.nama nama_kawasan,
				g.nama nama_ksm,
				h.nama nama_kpp,
				i.skala_kegiatan as usulan_skala,
				i.jenis_komponen_keg as usulan_komponen,
				j.nama nama_subkomponen,
				k.nama nama_dtl_subkomponen,
				l.nama nama_kel
			from bkt_01050201_op a 
				left join bkt_01040201_real_keg b on b.kode=a.kode_real_keg 
				left join bkt_01010102_kota c on c.kode=b.kode_kota
				left join bkt_01010111_korkot d on d.kode=b.kode_korkot
				left join bkt_01010110_kmw e on e.kode=b.kode_kmw
				left join bkt_01010123_kawasan f on f.id=b.kode_kawasan
				left join bkt_01010128_ksm g on g.id=b.id_ksm
				left join bkt_01010129_kpp h on h.id=b.id_kpp 
				left join bkt_01030208_usulan_keg_kt i on i.kode=b.kode_parent 
				left join bkt_01010120_subkomponen j 
					on (j.id=i.id_subkomponen or j.id=b.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen k 
					on (k.id=i.id_dtl_subkomponen or k.id=b.id_dtl_subkomponen)
				left join bkt_01010104_kel l on l.kode=b.kode_kel
			where 
				b.flag_sudah_sertias=1 and
				b.hasil_sertifikasi is not null and
				(i.skala_kegiatan=1 or
				b.skala_kegiatan=1)';
		$totalData = DB::select('select count(1) cnt from bkt_01050201_op a 
				left join bkt_01040201_real_keg b on b.kode=a.kode_real_keg 
				left join bkt_01010102_kota c on c.kode=b.kode_kota
				left join bkt_01010111_korkot d on d.kode=b.kode_korkot
				left join bkt_01010110_kmw e on e.kode=b.kode_kmw
				left join bkt_01010123_kawasan f on f.id=b.kode_kawasan
				left join bkt_01010128_ksm g on g.id=b.id_ksm
				left join bkt_01010129_kpp h on h.id=b.id_kpp 
				left join bkt_01030208_usulan_keg_kt i on i.kode=b.kode_parent 
				left join bkt_01010120_subkomponen j 
					on (j.id=i.id_subkomponen or j.id=b.id_subkomponen)
				left join bkt_01010121_dtl_subkomponen k 
					on (k.id=i.id_dtl_subkomponen or k.id=b.id_dtl_subkomponen)
				left join bkt_01010104_kel l on l.kode=b.kode_kota
			where 
				b.flag_sudah_sertias=1 and
				b.hasil_sertifikasi is not null and
				(i.skala_kegiatan=1 or
				b.skala_kegiatan=1)');
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
				a.kode like "%'.$search.'%" or 
				b.jenis_komponen_keg like "%'.$search.'%" or 
				i.jenis_komponen_keg like "%'.$search.'%" or 
				j.nama like "%'.$search.'%" or 
				k.nama like "%'.$search.'%" or 
				c.nama like "%'.$search.'%" or 
				f.nama like "%'.$search.'%" or 
				l.nama like "%'.$search.'%" or 
				b.skala_kegiatan like "%'.$search.'%" or 
				i.skala_kegiatan like "%'.$search.'%" or 
				a.tahun like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (
				a.kode like "%'.$search.'%" or 
				b.jenis_komponen_keg like "%'.$search.'%" or 
				i.jenis_komponen_keg like "%'.$search.'%" or 
				j.nama like "%'.$search.'%" or 
				k.nama like "%'.$search.'%" or 
				c.nama like "%'.$search.'%" or 
				f.nama like "%'.$search.'%" or 
				l.nama like "%'.$search.'%" or 
				b.skala_kegiatan like "%'.$search.'%" or 
				i.skala_kegiatan like "%'.$search.'%" or 
				a.tahun like "%'.$search.'%")) a');
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
				$jns_sumber_dana = null;
				$flag_sudah_sertias = null;
				$skala_kegiatan = null;
				$hasil_sertifikasi = null;

				if($post->jns_sumber_dana == '1'){
					$jns_sumber_dana = 'BDI / Non BDI';
				}elseif($post->jns_sumber_dana == '2'){
					$jns_sumber_dana = 'Non BDI Kolaborasi';
				}

				if($post->flag_sudah_sertias == '0'){
					$flag_sudah_sertias = 'Tidak';
				}elseif($post->flag_sudah_sertias == '1'){
					$flag_sudah_sertias = 'Ya';
				}

				if($post->skala_kegiatan == '1' || $post->usulan_skala == '1'){
					$skala_kegiatan = 'Kota/Kabupaten';
				}elseif($post->skala_kegiatan == '2' || $post->usulan_skala == '2'){
					$skala_kegiatan = 'Desa/Kelurahan';
				}

				if($post->hasil_sertifikasi == 'KB'){
					$hasil_sertifikasi = 'Kualitas Baik';
				}elseif($post->hasil_sertifikasi == 'KC'){
					$hasil_sertifikasi = 'Kualitas Cukup';
				}elseif($post->hasil_sertifikasi == 'KK'){
					$hasil_sertifikasi = 'Kualitas Kurang';
				}

				$url_edit=url('/')."/main/keberlanjutan/kota/operasional/create?kode=".$edit;
				$url_delete=url('/')."/main/keberlanjutan/kota/operasional/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['kode_real_keg'] = $post->jenis_komponen_keg.$post->usulan_komponen.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['skala_kegiatan'] = $skala_kegiatan;
				$nestedData['flag_sudah_sertias'] = $flag_sudah_sertias;
				$nestedData['tgl_sertias'] = $post->tgl_sertias;
				$nestedData['hasil_sertifikasi'] = $post->hasil_sertifikasi;
				// $nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				// $nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['kode_kel'] = $post->nama_kel;
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
						if($item->kode_menu==128)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['402'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['403'])){
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
				left join bkt_01010104_kel k on k.kode=a.kode_kel
			where a.kode='.$request->input('kode_parent'));
			echo json_encode($data);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==128)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['402'])){
				$rowData = DB::select('
				select 
					a.*,
					b.jns_sumber_dana,
					b.skala_kegiatan,
					b.jenis_komponen_keg,
					b.id_subkomponen,
					b.id_dtl_subkomponen,
					b.flag_sudah_sertias,
					b.tgl_sertias,
					b.tgl_realisasi,
					b.vol_realisasi,
					b.satuan,
					b.tahun tahun_keg,
					b.hasil_sertifikasi, 
					c.nama nama_kota,
					d.nama nama_korkot,
					e.nama nama_kmw,
					f.kode_kawasan kode_kawasan,
					f.nama nama_kawasan,
					g.kode_ksm kode_ksm,
					g.nama nama_ksm,
					h.nama nama_kpp,
					i.skala_kegiatan as usulan_skala,
					i.jenis_komponen_keg as usulan_komponen,
					j.nama nama_subkomponen,
					k.nama nama_dtl_subkomponen,
					l.nama nama_kel
				from bkt_01050201_op a 
					left join bkt_01040201_real_keg b on b.kode=a.kode_real_keg 
					left join bkt_01010102_kota c on c.kode=b.kode_kota
					left join bkt_01010111_korkot d on d.kode=b.kode_korkot
					left join bkt_01010110_kmw e on e.kode=b.kode_kmw
					left join bkt_01010123_kawasan f on f.id=b.kode_kawasan
					left join bkt_01010128_ksm g on g.id=b.id_ksm
					left join bkt_01010129_kpp h on h.id=b.id_kpp 
					left join bkt_01030208_usulan_keg_kt i on i.kode=b.kode_parent 
					left join bkt_01010120_subkomponen j 
						on (j.id=i.id_subkomponen or j.id=b.id_subkomponen)
					left join bkt_01010121_dtl_subkomponen k 
						on (k.id=i.id_dtl_subkomponen or k.id=b.id_dtl_subkomponen)
					left join bkt_01010104_kel l on l.kode=b.kode_kota
				where
					a.kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['tahun_keg'] = $rowData[0]->tahun_keg;
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['kode_real_keg'] = $rowData[0]->kode_real_keg;
				$data['kode_kota'] = $rowData[0]->nama_kota;
				$data['kode_korkot'] = $rowData[0]->nama_korkot;
				// $data['kode_kec'] = $rowData[0]->nama_kec;
				$data['kode_kmw'] = $rowData[0]->nama_kmw;
				$data['kode_kel'] = $rowData[0]->nama_kel;
				// $data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan.' '.$rowData[0]->nama_kawasan;
				$data['id_ksm'] = $rowData[0]->kode_ksm.' '.$rowData[0]->nama_ksm;
				$data['tahun'] = $rowData[0]->tahun;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan.$rowData[0]->usulan_skala;
				$data['hasil_sertifikasi'] = $rowData[0]->hasil_sertifikasi;
				$data['flag_sudah_sertias'] = $rowData[0]->flag_sudah_sertias;
				$data['tgl_sertias'] = $rowData[0]->tgl_sertias;
				$data['kkp_flag_bgn_msh_ada'] = $rowData[0]->kkp_flag_bgn_msh_ada;
				$data['kkp_flag_bgn_msh_baik'] = $rowData[0]->kkp_flag_bgn_msh_baik;
				$data['kkp_flag_bgn_msh_fungsi'] = $rowData[0]->kkp_flag_bgn_msh_fungsi;
				$data['kkp_flag_bgn_msh_man'] = $rowData[0]->kkp_flag_bgn_msh_man;
				$data['kkp_flag_bgn_msh_dev'] = $rowData[0]->kkp_flag_bgn_msh_dev;
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
						a.kode='.$data['kode_real_keg']);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010502/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['401'])){
				$data['tahun'] = null;
				$data['tahun_keg'] = null;
				$data['jns_sumber_dana'] = 1;
				$data['kode_real_keg'] = null;
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
				$data['hasil_sertifikasi'] = null;
				$data['flag_sudah_sertias'] = null;
				$data['tgl_sertias'] = null;
				$data['kkp_flag_bgn_msh_ada'] = null;
				$data['kkp_flag_bgn_msh_baik'] = null;
				$data['kkp_flag_bgn_msh_fungsi'] = null;
				$data['kkp_flag_bgn_msh_man'] = null;
				$data['kkp_flag_bgn_msh_dev'] = null;
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
						a.flag_sudah_sertias is not null and
						(a.skala_kegiatan=1 or
						b.skala_kegiatan=1)');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010502/create',$data);
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
			DB::table('bkt_01050201_op')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_real_keg' => $request->input('kode-parent-input'),
				'kkp_flag_bgn_msh_ada' => intval($request->input('kkp_flag_bgn_msh_ada')),
				'kkp_flag_bgn_msh_baik' => intval($request->input('kkp_flag_bgn_msh_baik')),
				'kkp_flag_bgn_msh_fungsi' => intval($request->input('kkp_flag_bgn_msh_fungsi')),
				'kkp_flag_bgn_msh_man' => intval($request->input('kkp_flag_bgn_msh_man')),
				'kkp_flag_bgn_msh_dev' => intval($request->input('kkp_flag_bgn_msh_dev')),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 402);

		}else{
			DB::table('bkt_01050201_op')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_real_keg' => $request->input('kode-parent-input'),
				'kkp_flag_bgn_msh_ada' => intval($request->input('kkp_flag_bgn_msh_ada')),
				'kkp_flag_bgn_msh_baik' => intval($request->input('kkp_flag_bgn_msh_baik')),
				'kkp_flag_bgn_msh_fungsi' => intval($request->input('kkp_flag_bgn_msh_fungsi')),
				'kkp_flag_bgn_msh_man' => intval($request->input('kkp_flag_bgn_msh_man')),
				'kkp_flag_bgn_msh_dev' => intval($request->input('kkp_flag_bgn_msh_dev')),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 401);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01050201_op')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 403);
        return Redirect::to('/main/keberlanjutan/kota/operasional');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 8,
				'kode_menu' => 128,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
