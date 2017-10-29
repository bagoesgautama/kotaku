<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010410Controller extends Controller
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
				if($item->kode_menu==122)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 382);
				return view('MAIN/bk010410/index',$data);
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
			0 => 'kode_parent',
			1 => 'jns_sumber_dana',
			3 => 'kode_kota',
			4 => 'kode_korkot',
			1 => 'Kode_kec',
			3 => 'kode_kel',
			4 => 'kode_faskel',
			5 => 'kode_kawasan',
			6 => 'id_kpp',
			7 => 'tahun',
			8 => 'tgl_realisasi',
			9 => 'vol_realisasi',
			10 => 'satuan',
			11 => 'created_time'
		);
		$query='
			select 
				a.*, b.nama nama_kota,
				c.nama nama_korkot,
				d.nama nama_kmw,
				e.nama nama_kawasan,
				f.nama nama_ksm,
				g.nama nama_kpp,
				h.jenis_komponen_keg,
				i.nama nama_subkomponen,
				j.nama nama_dtl_subkomponen,
				k.nama nama_kec,
				l.nama nama_kel,
				m.nama nama_faskel
			from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent
				left join bkt_01010120_subkomponen i on i.id=h.id_subkomponen
				left join bkt_01010121_dtl_subkomponen j on j.id=h.id_dtl_subkomponen 
				left join bkt_01010103_kec k on k.kode=a.kode_kec
				left join bkt_01010104_kel l on l.kode=a.kode_kel
				left join bkt_01010113_faskel m on m.kode=a.kode_faskel
			where
				a.jns_sumber_dana=1 and a.skala_kegiatan=2';
		$totalData = DB::select('select count(1) cnt from bkt_01040201_real_keg a
				left join bkt_01010102_kota b on b.kode=a.kode_kota
				left join bkt_01010111_korkot c on c.kode=a.kode_korkot
				left join bkt_01010110_kmw d on d.kode=a.kode_kmw
				left join bkt_01010123_kawasan e on e.id=a.kode_kawasan
				left join bkt_01010128_ksm f on f.id=a.id_ksm
				left join bkt_01010129_kpp g on g.id=a.id_kpp 
				left join bkt_01030208_usulan_keg_kt h on h.kode=a.kode_parent
				left join bkt_01010120_subkomponen i on i.id=h.id_subkomponen
				left join bkt_01010121_dtl_subkomponen j on j.id=h.id_dtl_subkomponen 
				left join bkt_01010103_kec k on k.kode=a.kode_kec
				left join bkt_01010104_kel l on l.kode=a.kode_kel
				left join bkt_01010113_faskel m on m.kode=a.kode_faskel
			where
				a.jns_sumber_dana=1 and a.skala_kegiatan=2');
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
			$posts=DB::select($query. ' and (h.jenis_komponen_keg like "%'.$search.'%" or i.nama like "%'.$search.'%" or j.nama like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (h.jenis_komponen_keg like "%'.$search.'%" or i.nama like "%'.$search.'%" or j.nama like "%'.$search.'%" or a.jns_sumber_dana like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or a.tahun like "%'.$search.'%" or a.tgl_realisasi like "%'.$search.'%" or a.vol_realisasi like "%'.$search.'%" or a.satuan like "%'.$search.'%")) a');
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

				$url_edit=url('/')."/main/pelaksanaan/kelurahan/realisasi_kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kelurahan/realisasi_kegiatan/delete?kode=".$delete;
				$nestedData['kode_parent'] = $post->jenis_komponen_keg.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['jns_sumber_dana'] = $jns_sumber_dana;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['kode_faskel'] = $post->nama_faskel;
				$nestedData['kode_kawasan'] = $post->nama_kawasan;
				$nestedData['id_kpp'] = $post->nama_kpp;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['tgl_realisasi'] = $post->tgl_realisasi;
				$nestedData['vol_realisasi'] = $post->vol_realisasi;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==122)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['384'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['385'])){
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

	public function Post_pemanfaat(Request $request)
	{
		if($request->input('kode')!=null)
		{
			$columns = array(
				0 =>'nik',
				1 =>'nama',
				2 =>'alamat',
				3 =>'a.kode_jenis_kelamin',
				4 =>'b.created_time'
			);
			$query='select a.*, b.kode as kode_real_keg_pmft, b.created_time as created_time_real_keg_pmft
				from bkt_01040206_real_keg_pmft b, 
					bkt_01010131_pemanfaat a
				where a.kode=b.kode_pemanfaat and b.kode_real_keg='.$request->input('kode');
			$totalData = DB::select('select count(1) cnt from bkt_01040206_real_keg_pmft b, 
					bkt_01010131_pemanfaat a
				where a.kode=b.kode_pemanfaat and b.kode_real_keg='.$request->input('kode'));
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
				$posts=DB::select($query. ' and (a.nik like "%'.$search.'%" or a.nama like "%'.$search.'%" or a.alamat like "%'.$search.'%" or a.kode_jenis_kelamin like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
				$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.nik like "%'.$search.'%" or a.nama like "%'.$search.'%" or a.alamat like "%'.$search.'%" or a.kode_jenis_kelamin like "%'.$search.'%")) a');
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$show =  $post->kode;
					$edit =  $post->kode;
					$delete = $post->kode_real_keg_pmft;

					$url_delete=url('/')."/main/pelaksanaan/kelurahan/realisasi_kegiatan/pemanfaat/delete?kode=".$delete."&kode_real_keg=".$request->input('kode');
					$nestedData['nik'] = $post->nik;
					$nestedData['nama'] = $post->nama;
					$nestedData['alamat'] = $post->alamat;
					$nestedData['kode_jenis_kelamin'] = $post->kode_jenis_kelamin;
					$nestedData['created_time'] = $post->created_time_real_keg_pmft;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==122)
								$detil[$item->kode_menu_detil]='a';
						}
					}

					$option = '';
					if(!empty($detil['385'])){
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
		elseif($request->input('kode_real_keg')!=null)
		{
			$columns = array(
				0 =>'nik',
				1 =>'nama',
				2 =>'alamat',
				3 =>'kode_jenis_kelamin',
				4 =>'created_time'
			);

			if($request->input('where')!=null){
				$query='select * from bkt_01010131_pemanfaat where '.$request->input('where');
				$totalData = DB::select('select count(1) cnt from bkt_01010131_pemanfaat where '.$request->input('where'));
			}else{
				$query='select * from bkt_01010131_pemanfaat';
				$totalData = DB::select('select count(1) cnt from bkt_01010131_pemanfaat');
			}
			
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
				$posts=DB::select($query. ' and (nik like "%'.$search.'%" or nama like "%'.$search.'%" or alamat like "%'.$search.'%" or kode_jenis_kelamin like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
				$totalFiltered=DB::select('select count(1) from ('.$query. ' and (nik like "%'.$search.'%" or nama like "%'.$search.'%" or alamat like "%'.$search.'%" or kode_jenis_kelamin like "%'.$search.'%")) a');
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$show =  $post->kode;
					$nestedData['nik'] = $post->nik;
					$nestedData['nama'] = $post->nama;
					$nestedData['alamat'] = $post->alamat;
					$nestedData['kode_jenis_kelamin'] = $post->kode_jenis_kelamin;
					$nestedData['created_time'] = $post->created_time;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==122)
								$detil[$item->kode_menu_detil]='a';
						}
					}

					$option = '';
					if(!empty($detil['385'])){
						$option .= "<input type='checkbox' name='check[]' id='check[]' value='$show'>";
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
		
	}

	public function select(Request $request)
	{
		if(!empty($request->input('data_kegiatan'))){
			$data_kegiatan = 
			DB::select('select a.*,
							b.nama nama_kmw,
							c.nama nama_kota,
							d.nama nama_korkot,
							e.nama nama_kec,
							f.nama nama_kel,
							g.nama nama_faskel,
							h.nama nama_subkomponen,
							i.nama nama_dtl_subkomponen,
							case
								when jenis_komponen_keg = "L" then "Lingkungan"
								when jenis_komponen_keg = "S" then "Sosial"
								when jenis_komponen_keg = "E" then "Ekonomi"
							end nama_komponen,
							case
								when skala_kegiatan = "1" then "Kota/Kabupaten"
								when skala_kegiatan = "2" then "Desa/Kelurahan"
							end skala	 
						from bkt_01030208_usulan_keg_kt a
							left join bkt_01010110_kmw b on a.kode_kmw=b.kode
							left join bkt_01010102_kota c on a.kode_kota=c.kode 
							left join bkt_01010111_korkot d on a.kode_korkot=d.kode
							left join bkt_01010103_kec e on a.kode_kec=e.kode
							left join bkt_01010104_kel f on a.kode_kel=f.kode
							left join bkt_01010113_faskel g on a.kode_faskel=g.kode
							left join bkt_01010120_subkomponen h on a.id_subkomponen=h.id
							left join bkt_01010121_dtl_subkomponen i on a.id_dtl_subkomponen=i.id

						where a.kode='.$request->input('data_kegiatan'));
			echo json_encode($data_kegiatan);
		}

		if(!empty($request->input('kode_parent_kawasan'))){
			$kawasan = DB::select('select b.id, b.kode_kawasan, b.nama from bkt_01030208_usulan_keg_kt a, bkt_01010123_kawasan b where a.kode_kota=b.kode_kota and a.kode='.$request->input('kode_parent_kawasan'));
			echo json_encode($kawasan);
		}
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==122)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['384'])){
				$rowData = DB::select('select * from bkt_01040201_real_keg where kode='.$data['kode']);
				$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_kawasan'] = $rowData[0]->kode_kawasan;
				$data['id_ksm'] = $rowData[0]->id_ksm;
				$data['tahun'] = $rowData[0]->tahun;
				$data['jenis_komponen_keg'] = $rowData[0]->jenis_komponen_keg;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['tgl_realisasi'] = $rowData[0]->tgl_realisasi;
				$data['vol_realisasi'] = $rowData[0]->vol_realisasi;
				$data['satuan'] = $rowData[0]->satuan;
				$data['nb_a_pupr_bdi_kolab'] = $rowData[0]->nb_a_pupr_bdi_kolab;
				$data['nb_a_pupr_bdi_plbk'] = $rowData[0]->nb_a_pupr_bdi_plbk;
				$data['nb_a_pupr_bdi_lain'] = $rowData[0]->nb_a_pupr_bdi_lain;
				$data['nb_a_pupr_nsup2'] = $rowData[0]->nb_a_pupr_nsup2;
				$data['nb_a_pupr_dir_pkp'] = $rowData[0]->nb_a_pupr_dir_pkp;
				$data['nb_a_pupr_dir_pkp_lain'] = $rowData[0]->nb_a_pupr_dir_pkp_lain;
				$data['nb_apbn_kl_lain'] = $rowData[0]->nb_apbn_kl_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_dak'] = $rowData[0]->nb_dak;
				$data['nb_hibah'] = $rowData[0]->nb_hibah;
				$data['nb_non_gov'] = $rowData[0]->nb_non_gov;
				$data['nb_masyarakat'] = $rowData[0]->nb_masyarakat;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['progress_keuangan'] = $rowData[0]->progress_keuangan;
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
				$data['tk_q_pekerja'] = $rowData[0]->tk_q_pekerja;
				$data['tk_q_pekerja_w'] = $rowData[0]->tk_q_pekerja_w;
				$data['tk_q_hok'] = $rowData[0]->tk_q_hok;
				$data['tk_val_hok'] = $rowData[0]->tk_val_hok;
				$data['id_kpp'] = $rowData[0]->id_kpp;
				$data['kpp_flag_bgn_msh_ada'] = $rowData[0]->kpp_flag_bgn_msh_ada;
				$data['kpp_flag_bgn_msh_baik'] = $rowData[0]->kpp_flag_bgn_msh_baik;
				$data['kpp_flag_bgn_msh_fungsi'] = $rowData[0]->kpp_flag_bgn_msh_fungsi;
				$data['kpp_flag_bgn_msh_man'] = $rowData[0]->kpp_flag_bgn_msh_man;
				$data['kpp_flag_bgn_msh_dev'] = $rowData[0]->kpp_flag_bgn_msh_dev;
				$data['hasil_sertifikasi'] = $rowData[0]->hasil_sertifikasi;
				$data['longitude'] = $rowData[0]->longitude;
				$data['latitude'] = $rowData[0]->latitude;
				$data['flag_foto_prcn0'] = $rowData[0]->flag_foto_prcn0;
				$data['url_img_prcn0'] = $rowData[0]->url_img_prcn0;
				$data['flag_foto_prcn50'] = $rowData[0]->flag_foto_prcn50;
				$data['url_img_prcn50'] = $rowData[0]->url_img_prcn50;
				$data['flag_foto_prcn100'] = $rowData[0]->flag_foto_prcn100;
				$data['url_img_prcn100'] = $rowData[0]->url_img_prcn100;
				$data['pencairan_dana1'] = $rowData[0]->pencairan_dana1;
				$data['pencairan_dana2'] = $rowData[0]->pencairan_dana2;
				$data['pencairan_dana3'] = $rowData[0]->pencairan_dana3;
				$data['pemanfaatan_dana'] = $rowData[0]->pemanfaatan_dana;
				$data['pemanfaatan_data_prcn'] = $rowData[0]->pemanfaatan_data_prcn;
				$data['progres_fisik'] = $rowData[0]->progres_fisik;
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
						b.nama nama_subkomponen,
						c.nama nama_dtl_subkomponen
					from bkt_01030208_usulan_keg_kt a
						left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen c on c.id=a.id_dtl_subkomponen 
					where
						a.kode='.$rowData[0]->kode_parent);
				if(!empty($rowData[0]->kode_parent))
					$data['kode_kawasan_list']=DB::select('select b.id, b.kode_kawasan, b.nama from bkt_01030208_usulan_keg_kt a, bkt_01010123_kawasan b where a.kode_kota=b.kode_kota and a.kode='.$rowData[0]->kode_parent);
				$data['kode_kpp_list'] = DB::select('select * from bkt_01010129_kpp where id='.$rowData[0]->id_kpp);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010410/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['383'])){
				$data['jns_sumber_dana'] = 1;
				$data['skala_kegiatan'] = null;
				$data['kode_parent'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_kawasan'] = null;
				$data['id_ksm'] = null;
				$data['tahun'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['tgl_realisasi'] = null;
				$data['vol_realisasi'] = null;
				$data['satuan'] = null;
				$data['nb_a_pupr_bdi_kolab'] = null;
				$data['nb_a_pupr_bdi_plbk'] = null;
				$data['nb_a_pupr_bdi_lain'] = null;
				$data['nb_a_pupr_nsup2'] = null;
				$data['nb_a_pupr_dir_pkp'] = null;
				$data['nb_a_pupr_dir_pkp_lain'] = null;
				$data['nb_apbn_kl_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_dak'] = null;
				$data['nb_hibah'] = null;
				$data['nb_non_gov'] = null;
				$data['nb_masyarakat'] = null;
				$data['nb_lainnya'] = null;
				$data['progress_keuangan'] = null;
				$data['tpm_q_jiwa'] = null;
				$data['tpm_q_jiwa_w'] = null;
				$data['tpm_q_mbr'] = null;
				$data['tpm_q_kk'] = null;
				$data['tpm_q_kk_miskin'] = null;
				$data['tk_q_pekerja'] = null;
				$data['tk_q_pekerja_w'] = null;
				$data['tk_q_hok'] = null;
				$data['tk_val_hok'] = null;
				$data['id_kpp'] = null;
				$data['kpp_flag_bgn_msh_ada'] = null;
				$data['kpp_flag_bgn_msh_baik'] = null;
				$data['kpp_flag_bgn_msh_fungsi'] = null;
				$data['kpp_flag_bgn_msh_man'] = null;
				$data['kpp_flag_bgn_msh_dev'] = null;
				$data['hasil_sertifikasi'] = null;
				$data['longitude'] = null;
				$data['latitude'] = null;
				$data['flag_foto_prcn0'] = null;
				$data['url_img_prcn0'] = null;
				$data['flag_foto_prcn50'] = null;
				$data['url_img_prcn50'] = null;
				$data['flag_foto_prcn100'] = null;
				$data['url_img_prcn100'] = null;
				$data['pencairan_dana1'] = null;
				$data['pencairan_dana2'] = null;
				$data['pencairan_dana3'] = null;
				$data['pemanfaatan_dana'] = null;
				$data['pemanfaatan_data_prcn'] = null;
				$data['progres_fisik'] =null;
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
						b.nama nama_subkomponen,
						c.nama nama_dtl_subkomponen
					from bkt_01030208_usulan_keg_kt a
						left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen c on c.id=a.id_dtl_subkomponen 
					where
						a.skala_kegiatan=2');
				$data['kode_kawasan_list'] = DB::select('select * from bkt_01010123_kawasan');
				$data['kode_ksm_list'] = DB::select('select * from bkt_01010128_ksm where status=1');
				$data['kode_kpp_list'] = DB::select('select * from bkt_01010129_kpp where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010410/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function pemanfaat_create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==122)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode_real_keg']=$request->input('kode_real_keg');
			if($data['kode_real_keg']!=null  && !empty($data['detil']['384'])){
				$rowData=DB::select('select kode_pemanfaat from bkt_01040206_real_keg_pmft where kode_real_keg='.$request->input('kode_real_keg'));
				$where='';
				$count=0;
				foreach ($rowData as $value) {
					$count++;
					if($count==1){
						$where.=' kode !='.$value->kode_pemanfaat;
					}else{
						$where.=' and kode !='.$value->kode_pemanfaat;
					}
				}
				$data['where'] = $where; 
				return view('MAIN/bk010410/pemanfaat',$data);
			}
		}
	}

	public function post_pemanfaat_create(Request $request)
	{
		if($request->input('kode_real_keg')!=null){
			$checked = $request->input('check');

			DB::beginTransaction();
			foreach ($checked as $value) {
				DB::table('bkt_01040206_real_keg_pmft')->insert([
					'kode_real_keg' => $request->input('kode_real_keg'),
					'kode_pemanfaat' => $value
				]);
			}
			DB::commit();

			$total_pemanfaat_p=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="P" and a.kode_real_keg='.$request->input('kode_real_keg'));
			$total_pemanfaat_w=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="W" and a.kode_real_keg='.$request->input('kode_real_keg'));

			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode_real_keg'))
			->update([
				'tpm_q_jiwa' => $total_pemanfaat_p[0]->cnt,
				'tpm_q_jiwa_w' => $total_pemanfaat_w[0]->cnt,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
		}
	}

	public function post_create(Request $request)
	{
		$file_prcn0 = $request->file('url_img_prcn0');
		$url_prcn0 = null;
		$upload_prcn0 = false;
		if($request->input('uploaded-url_img_prcn0') != null && $file_prcn0 == null){
			$url_prcn0 = $request->input('uploaded-url_img_prcn0');
			$upload_prcn0 = false;
		}elseif($request->input('uploaded-url_img_prcn0') != null && $file_prcn0 != null){
			$url_prcn0 = $file_prcn0->getClientOriginalName();
			$upload_prcn0 = true;
		}elseif($request->input('uploaded-url_img_prcn0') == null && $file_prcn0 != null){
			$url_prcn0 = $file_prcn0->getClientOriginalName();
			$upload_prcn0 = true;
		}

		$file_prcn50 = $request->file('url_img_prcn50');
		$url_prcn50 = null;
		$upload_prcn50 = false;
		if($request->input('uploaded-url_img_prcn50') != null && $file_prcn50 == null){
			$url_prcn50 = $request->input('uploaded-url_img_prcn50');
			$upload_prcn50 = false;
		}elseif($request->input('uploaded-url_img_prcn50') != null && $file_prcn50 != null){
			$url_prcn50 = $file_prcn50->getClientOriginalName();
			$upload_prcn50 = true;
		}elseif($request->input('uploaded-url_img_prcn50') == null && $file_prcn50 != null){
			$url_prcn50 = $file_prcn50->getClientOriginalName();
			$upload_prcn50 = true;
		}

		$file_prcn100 = $request->file('url_img_prcn100');
		$url_prcn100 = null;
		$upload_prcn100 = false;
		if($request->input('uploaded-url_img_prcn100') != null && $file_prcn100 == null){
			$url_prcn100 = $request->input('uploaded-url_img_prcn100');
			$upload_prcn100 = false;
		}elseif($request->input('uploaded-url_img_prcn100') != null && $file_prcn100 != null){
			$url_prcn100 = $file_prcn100->getClientOriginalName();
			$upload_prcn100 = true;
		}elseif($request->input('uploaded-url_img_prcn100') == null && $file_prcn100 != null){
			$url_prcn100 = $file_prcn100->getClientOriginalName();
			$upload_prcn100 = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))
			->update([
				'kode_parent' => $request->input('select-kode_parent-input'),
				'skala_kegiatan' => $request->input('skala_kegiatan-input'),
				'jns_sumber_dana' => $request->input('select-jns_sumber_dana-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_kota' => $request->input('kode_kota-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_kec' => $request->input('kode_kec-input'),
				'kode_kel' => $request->input('kode_kel-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'tahun' => $request->input('tahun-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'tgl_realisasi' => $request->input('tgl_realisasi-input'),
				'vol_realisasi' => $request->input('vol_realisasi-input'),
				'satuan' => $request->input('select-satuan-input'),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp-input'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'progress_keuangan' => $request->input('progress_keuangan-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'tk_q_pekerja' => $request->input('tk_q_pekerja-input'),
				'tk_q_pekerja_w' => $request->input('tk_q_pekerja_w-input'),
				'tk_q_hok' => $request->input('tk_q_hok-input'),
				'tk_val_hok' => $request->input('tk_val_hok-input'),
				'id_kpp' => $request->input('select-id_kpp-input'),
				'kpp_flag_bgn_msh_ada' => intval($request->input('kpp_flag_bgn_msh_ada-input')),
				'kpp_flag_bgn_msh_baik' => intval($request->input('kpp_flag_bgn_msh_baik-input')),
				'kpp_flag_bgn_msh_fungsi' => intval($request->input('kpp_flag_bgn_msh_fungsi-input')),
				'kpp_flag_bgn_msh_man' => intval($request->input('kpp_flag_bgn_msh_man-input')),
				'kpp_flag_bgn_msh_dev' => intval($request->input('kpp_flag_bgn_msh_dev-input')),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'flag_foto_prcn0' => intval($request->input('flag_foto_prcn0')),
				'url_img_prcn0' => $url_prcn0,
				'flag_foto_prcn50' => intval($request->input('flag_foto_prcn50')),
				'url_img_prcn50' => $url_prcn50,
				'flag_foto_prcn100' => intval($request->input('flag_foto_prcn100')),
				'url_img_prcn100' => $url_prcn100,
				'pencairan_dana1' => $request->input('pencairan_dana1-input'),
				'pencairan_dana2' => $request->input('pencairan_dana2-input'),
				'pencairan_dana3' => $request->input('pencairan_dana3-input'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana-input'),
				'pemanfaatan_data_prcn' => $request->input('pemanfaatan_data_prcn-input'),
				'progres_fisik' => $request->input('progres_fisik-input'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias-input'),
				'tgl_sertias' => $request->input('tgl_sertias-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_prcn0 == true){
				$file_prcn0->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn0->getClientOriginalName());
			}

			if($upload_prcn50 == true){
				$file_prcn50->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn50->getClientOriginalName());
			}

			if($upload_prcn100 == true){
				$file_prcn100->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn100->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 384);

		}else{
			DB::table('bkt_01040201_real_keg')->insert([
				'kode_parent' => $request->input('select-kode_parent-input'),
				'skala_kegiatan' => $request->input('skala_kegiatan-input'),
				'jns_sumber_dana' => $request->input('select-jns_sumber_dana-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),
				'kode_kota' => $request->input('kode_kota-input'),
				'kode_korkot' => $request->input('kode_korkot-input'),
				'kode_kec' => $request->input('kode_kec-input'),
				'kode_kel' => $request->input('kode_kel-input'),
				'kode_faskel' => $request->input('kode_faskel-input'),
				'kode_kawasan' => $request->input('select-kode_kawasan-input'),
				'tahun' => $request->input('tahun-input'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('id_dtl_subkomponen-input'),
				'tgl_realisasi' => $request->input('tgl_realisasi-input'),
				'vol_realisasi' => $request->input('vol_realisasi-input'),
				'satuan' => $request->input('select-satuan-input'),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab-input'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk-input'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain-input'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2-input'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp-input'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain-input'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain-input'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop-input'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota-input'),
				'nb_dak' => $request->input('nb_dak-input'),
				'nb_hibah' => $request->input('nb_hibah-input'),
				'nb_non_gov' => $request->input('nb_non_gov-input'),
				'nb_masyarakat' => $request->input('nb_masyarakat-input'),
				'nb_lainnya' => $request->input('nb_lainnya-input'),
				'progress_keuangan' => $request->input('progress_keuangan-input'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'tk_q_pekerja' => $request->input('tk_q_pekerja-input'),
				'tk_q_pekerja_w' => $request->input('tk_q_pekerja_w-input'),
				'tk_q_hok' => $request->input('tk_q_hok-input'),
				'tk_val_hok' => $request->input('tk_val_hok-input'),
				'id_kpp' => $request->input('select-id_kpp-input'),
				'kpp_flag_bgn_msh_ada' => intval($request->input('kpp_flag_bgn_msh_ada-input')),
				'kpp_flag_bgn_msh_baik' => intval($request->input('kpp_flag_bgn_msh_baik-input')),
				'kpp_flag_bgn_msh_fungsi' => intval($request->input('kpp_flag_bgn_msh_fungsi-input')),
				'kpp_flag_bgn_msh_man' => intval($request->input('kpp_flag_bgn_msh_man-input')),
				'kpp_flag_bgn_msh_dev' => intval($request->input('kpp_flag_bgn_msh_dev-input')),
				'longitude' => $request->input('longitude-input'),
				'latitude' => $request->input('latitude-input'),
				'flag_foto_prcn0' => intval($request->input('flag_foto_prcn0')),
				'url_img_prcn0' => $url_prcn0,
				'flag_foto_prcn50' => intval($request->input('flag_foto_prcn50')),
				'url_img_prcn50' => $url_prcn50,
				'flag_foto_prcn100' => intval($request->input('flag_foto_prcn100')),
				'url_img_prcn100' => $url_prcn100,
				'pencairan_dana1' => $request->input('pencairan_dana1-input'),
				'pencairan_dana2' => $request->input('pencairan_dana2-input'),
				'pencairan_dana3' => $request->input('pencairan_dana3-input'),
				'pemanfaatan_dana' => $request->input('pemanfaatan_dana-input'),
				'pemanfaatan_data_prcn' => $request->input('pemanfaatan_data_prcn-input'),
				'progres_fisik' => $request->input('progres_fisik-input'),
				'flag_sudah_sertias' => $request->input('flag_sudah_sertias-input'),
				'tgl_sertias' => $request->input('tgl_sertias-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_prcn0 == true){
				$file_prcn0->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn0->getClientOriginalName());
			}

			if($upload_prcn50 == true){
				$file_prcn50->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn50->getClientOriginalName());
			}

			if($upload_prcn100 == true){
				$file_prcn100->move(public_path('/uploads/pelaksanaan/Realisasi_kegiatan_skala_keluarahan_BDI_non_BDI/realisasi_kegiatan_skala_keluarahan'), $file_prcn100->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 383);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::beginTransaction();
		DB::table('bkt_01040206_real_keg_pmft')->where('kode_real_keg', $request->input('kode'))->delete();
		DB::commit();

		DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 385);
        return Redirect::to('/main/pelaksanaan/kelurahan/realisasi_kegiatan');
    }

    public function delete_pemanfaat(Request $request)
	{
		DB::beginTransaction();
		DB::table('bkt_01040206_real_keg_pmft')->where('kode', $request->input('kode'))->delete();
		DB::commit();

		$total_pemanfaat_p=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="P" and a.kode_real_keg='.$request->input('kode_real_keg'));
		$total_pemanfaat_w=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="W" and a.kode_real_keg='.$request->input('kode_real_keg'));
		if($request->input('kode_real_keg')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode_real_keg'))
			->update([
				'tpm_q_jiwa' => $total_pemanfaat_p[0]->cnt,
				'tpm_q_jiwa_w' => $total_pemanfaat_w[0]->cnt,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
		}
        return Redirect::to('/main/pelaksanaan/kelurahan/realisasi_kegiatan/create?kode='.$request->input('kode_real_keg'));
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 7,
				'kode_menu' => 122,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
