<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020316Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==182)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 570);
				return view('HRM/bk020316/index',$data);
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
			0 => 'user_name',
			1 => 'nama_depan',
			2 => 'nama_belakang',
			3 => 'kode_jenis_kelamin',
			4 => 'jenis_registrasi',
			5 => 'status_registrasi',
			6 => 'created_time',
		);
		$query='
			select * from (select 
				*,
				user_name user_name_real,
				nama_depan nama_depan_real,
				nama_belakang nama_belakang_real, 
				case
					when kode_jenis_kelamin = "P" then "Pria"
					when kode_jenis_kelamin = "W" then "Wanita"
				end jenis_kel,
				case
					when jenis_registrasi = "0" then "Mandiri"
					when jenis_registrasi = "1" then "Manual"
				end jenis_reg,
				case
					when status_registrasi = "0" then "Belum Diverivikasi"
				end status_reg
			from bkt_02020201_registrasi
			where status_registrasi=0
			) b ';
		$totalData = DB::select('select count(1) cnt from bkt_02020201_registrasi
									where status_registrasi=0 ');
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
			$posts=DB::select($query. ' where (b.user_name_real like "%'.$search.'%" or 
												b.nama_depan_real like "%'.$search.'%" or
												b.nama_belakang_real like "%'.$search.'%" or
												b.jenis_kel like "%'.$search.'%" or
												b.jenis_reg like "%'.$search.'%" or 
												b.status_reg like "%'.$search.'%") 
										order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (b.user_name_real like "%'.$search.'%" or 
												b.nama_depan_real like "%'.$search.'%" or
												b.nama_belakang_real like "%'.$search.'%" or
												b.jenis_kel like "%'.$search.'%" or
												b.jenis_reg like "%'.$search.'%" or 
												b.status_reg like "%'.$search.'%")
										) a');
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

				$url_edit=url('/')."/hrm/management/persetujuan/create?kode=".$edit;
				$url_delete=url('/')."/hrm/management/persetujuan/delete?kode=".$delete;
				$nestedData['user_name'] = $post->user_name;
				$nestedData['nama_depan'] = $post->nama_depan;
				$nestedData['nama_belakang'] = $post->nama_belakang;
				$nestedData['jenis_kel'] = $post->jenis_kel;
				$nestedData['jenis_reg'] = $post->jenis_reg;
				$nestedData['status_reg'] = $post->status_reg;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==182)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil[571])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==182)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$rowData = DB::select('select * from bkt_02020201_registrasi where kode='.$data['kode']);
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
			$data['data_kegiatan_list'] = DB::select('select 
						a.*,
						b.nama nama_kmw,
						c.nama nama_kota,
						d.nama nama_korkot,
						e.nama nama_kec,
						f.nama nama_kel,
						g.nama nama_faskel,
						h.nama nama_kpp,
						i.nama nama_kawasan,
						j.nama nama_ksm,
						k.nama nama_kpp
					from bkt_01040201_real_keg a
						left join bkt_01010110_kmw b on a.kode_kmw=b.kode
						left join bkt_01010102_kota c on a.kode_kota=c.kode 
						left join bkt_01010111_korkot d on a.kode_korkot=d.kode
						left join bkt_01010103_kec e on a.kode_kec=e.kode
						left join bkt_01010104_kel f on a.kode_kel=f.kode
						left join bkt_01010113_faskel g on a.kode_faskel=g.kode
						left join bkt_01010129_kpp h on a.id_kpp=h.id 
						left join bkt_01010123_kawasan i on a.kode_kawasan=i.id
						left join bkt_01010128_ksm j on a.id_ksm=j.id
						left join bkt_01010129_kpp k on a.id_kpp=k.id
					where a.kode='.$rowData[0]->kode);
			$data['jns_sumber_dana'] = $rowData[0]->jns_sumber_dana;
			$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
			$data['kode_parent'] = $rowData[0]->kode_parent;
			$data['kode_kmw'] = $data['data_kegiatan_list'][0]->nama_kmw;
			$data['kode_kota'] = $data['data_kegiatan_list'][0]->nama_kota;
			$data['kode_korkot'] = $data['data_kegiatan_list'][0]->nama_korkot;
			$data['kode_kec'] = $data['data_kegiatan_list'][0]->nama_kec;
			$data['kode_kel'] = $data['data_kegiatan_list'][0]->nama_kel;
			$data['kode_faskel'] = $data['data_kegiatan_list'][0]->nama_faskel;
			$data['kode_kawasan'] = $data['data_kegiatan_list'][0]->nama_kawasan;
			$data['id_ksm'] = $data['data_kegiatan_list'][0]->nama_ksm;
			$data['id_kpp'] = $data['data_kegiatan_list'][0]->nama_kpp;
			$data['komponen'] = DB::select('
				select
				case
					when jenis_komponen_keg = "L" then "Lingkungan"
					when jenis_komponen_keg = "S" then "Sosial"
					when jenis_komponen_keg = "E" then "Ekonomi"
				end komponen
				from bkt_01030208_usulan_keg_kt
				where
					kode='.$rowData[0]->kode_parent);
			$data['jenis_komponen_keg'] = $data['komponen'][0]->komponen;
			$data['subkomponen'] = DB::select('
				select  
					b.nama nama_subkomponen
				from bkt_01030208_usulan_keg_kt a
					left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
				where
					a.kode='.$rowData[0]->kode_parent);
			$data['id_subkomponen'] = $data['subkomponen'][0]->nama_subkomponen;
			$data['dtl_subkomponen'] = DB::select('
				select 
					b.nama nama_dtl_subkomponen
				from bkt_01030208_usulan_keg_kt a
					left join bkt_01010121_dtl_subkomponen b on b.id=a.id_dtl_subkomponen 
				where
					a.kode='.$rowData[0]->kode_parent);
			$data['id_dtl_subkomponen'] = $data['dtl_subkomponen'][0]->nama_dtl_subkomponen;
			$data['tahun'] = $rowData[0]->tahun;
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
			
			$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
			return view('HRM/bk020316/create',$data);
		}
	}

	public function post_create(Request $request)
	{
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01040201_real_keg')->where('kode', $request->input('kode'))
			->update([
				'hasil_sertifikasi' => $request->input('select-hasil_sertifikasi-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
			$this->log_aktivitas('Update', 571);
		
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 2,
				'kode_modul' => 14,
				'kode_menu' => 182,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
