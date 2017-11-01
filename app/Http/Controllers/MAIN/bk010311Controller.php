<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010311Controller extends Controller
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
				if($item->kode_menu==94)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 297);
				return view('MAIN/bk010311/index',$data);
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
			8 => 'jenis_kegiatan',
			9 => 'no_proposal',
			10 => 'tgl_proposal',
			11 => 'thn_anggaran',
			12 => 'kategori_penanganan',
			13 => 'jenis_komponen_keg',
			14 => 'id_subkomponen',
			15 => 'id_dtl_subkomponen',
			16 => 'dk_vol_kegiatan',
			17 => 'dk_satuan',
			18 => 'dk_lok_kegiatan',
			19 => 'dk_tgl_verifikasi',
			20 => 'nb_a_pupr_bdi_kolab',
			21 => 'nb_a_pupr_bdi_plbk',
			22 => 'nb_a_pupr_bdi_lain',
			23 => 'nb_a_pupr_nsup2',
			24 => 'nb_a_pupr_dir_pkp',
			25 => 'nb_a_pupr_dir_pkp_lain',
			26 => 'nb_apbn_kl_lain',
			27 => 'nb_apbd_prop',
			28 => 'nb_apbd_kota',
			29 => 'nb_dak',
			30 => 'nb_hibah',
			31 => 'nb_non_gov',
			32 => 'nb_masyarakat',
			33 => 'nb_lainnya',
			34 => 'tpm_q_jiwa',
			35 => 'tpm_q_jiwa_w',
			36 => 'tpm_q_mbr',
			37 => 'tpm_q_kk',
			38 => 'tpm_q_kk_miskin',
			39 => 'uri_img_document',
			40 => 'uri_img_absensi',
			41 => 'diser_tgl',
			42 => 'diser_oleh',
			43 => 'diket_tgl',
			44 => 'diket_oleh',
			45 => 'diver_tgl',
			46 => 'diver_oleh',
			47 => 'created_time',
			48 => 'created_by',
			49 => 'updated_time',
			50 => 'updated_by'
		);
		$query='select * from (select 
					a.*,
					a.tahun tahun_real,
					a.no_proposal no_proposal_real,
					a.tgl_proposal tgl_proposal_real,
					a.thn_anggaran thn_anggaran_real,
					a.dk_tgl_verifikasi dk_tgl_verifikasi_real,
					a.dk_lok_kegiatan dk_lok_kegiatan_real,
					b.nama nama_kota, 
					c.nama nama_korkot, 
					d.nama nama_kec, 
					e.nama nama_kmw, 
					f.nama nama_kel, 
					g.nama nama_faskel,
					h.nama nama_subkomponen,
					i.nama nama_dtl_subkomponen,
					case 
						when a.skala_kegiatan = "1" then "Kota/Kabupaten"
						when a.skala_kegiatan = "2" then "Desa/Kelurahan" 
					end nama_skala_kegiatan,
					case 
						when a.jenis_kegiatan = "0" then "Non Bergulir"
						when a.jenis_kegiatan = "1" then "Bergulir"
					end nama_jenis_kegiatan,
					case
						when a.kategori_penanganan = "0" then "Rehab"
						when a.kategori_penanganan = "1" then "Baru"
					end nama_kategori_penanganan,
					case 
						when a.jenis_komponen_keg = "L" then "Lingkungan"
						when a.jenis_komponen_keg = "S" then "Sosial"
						when a.jenis_komponen_keg = "E" then "EKonomi"
					end nama_jenis_komponen_keg
				from bkt_01030208_usulan_keg_kt a 
					left join bkt_01010102_kota b on b.kode=a.kode_kota
					left join bkt_01010111_korkot c on c.kode=a.kode_korkot
					left join bkt_01010103_kec d on d.kode=a.kode_kec 
					left join bkt_01010110_kmw e on e.kode=a.kode_kmw
					left join bkt_01010104_kel f on f.kode=a.kode_kel
					left join bkt_01010113_faskel g on g.kode=a.kode_faskel
					left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
					left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
				where a.skala_kegiatan=1) b ';
			
		$totalData = DB::select('select count(1) cnt from bkt_01030208_usulan_keg_kt a 
									left join bkt_01010102_kota b on b.kode=a.kode_kota
									left join bkt_01010111_korkot c on c.kode=a.kode_korkot
									left join bkt_01010103_kec d on d.kode=a.kode_kec 
									left join bkt_01010110_kmw e on e.kode=a.kode_kmw
									left join bkt_01010104_kel f on f.kode=a.kode_kel
									left join bkt_01010113_faskel g on g.kode=a.kode_faskel
									left join bkt_01010120_subkomponen h on h.id=a.id_subkomponen
									left join bkt_01010121_dtl_subkomponen i on i.id=a.id_dtl_subkomponen
								where a.skala_kegiatan=1 ');
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
					b.tahun_real like "%'.$search.'%" or 
					b.no_proposal_real like "%'.$search.'%" or
					b.tgl_proposal_real like "%'.$search.'%" or 
					b.thn_anggaran_real like "%'.$search.'%" or
					b.dk_tgl_verifikasi_real like "%'.$search.'%" or
					b.dk_lok_kegiatan_real like "%'.$search.'%" or 
					b.nama_kmw like "%'.$search.'%" or
					b.nama_kota like "%'.$search.'%" or
					b.nama_kec like "%'.$search.'%" or
					b.nama_kel like "%'.$search.'%" or
					b.nama_faskel like "%'.$search.'%" or
					b.nama_subkomponen like "%'.$search.'%" or
					b.nama_dtl_subkomponen like "%'.$search.'%" or
					b.nama_skala_kegiatan like "%'.$search.'%" or
					b.nama_jenis_kegiatan like "%'.$search.'%" or
					b.nama_kategori_penanganan like "%'.$search.'%" or
					b.nama_jenis_komponen_keg like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.tahun_real like "%'.$search.'%" or 
					b.no_proposal_real like "%'.$search.'%" or
					b.tgl_proposal_real like "%'.$search.'%" or 
					b.thn_anggaran_real like "%'.$search.'%" or
					b.dk_tgl_verifikasi_real like "%'.$search.'%" or
					b.dk_lok_kegiatan_real like "%'.$search.'%" or 
					b.nama_kmw like "%'.$search.'%" or
					b.nama_kota like "%'.$search.'%" or
					b.nama_kec like "%'.$search.'%" or
					b.nama_kel like "%'.$search.'%" or
					b.nama_faskel like "%'.$search.'%" or
					b.nama_subkomponen like "%'.$search.'%" or
					b.nama_dtl_subkomponen like "%'.$search.'%" or
					b.nama_skala_kegiatan like "%'.$search.'%" or
					b.nama_jenis_kegiatan like "%'.$search.'%" or
					b.nama_kategori_penanganan like "%'.$search.'%" or
					b.nama_jenis_komponen_keg like "%'.$search.'%"
					)) a');
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

				$url_edit=url('/')."/main/perencanaan/rencana_kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/rencana_kegiatan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_skala_kegiatan'] = $post->nama_skala_kegiatan;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['nama_jenis_kegiatan'] = $post->nama_jenis_kegiatan;
				$nestedData['no_proposal'] = $post->no_proposal;
				$nestedData['tgl_proposal'] = $post->tgl_proposal;
				$nestedData['thn_anggaran'] = $post->thn_anggaran;
				$nestedData['nama_kategori_penanganan'] = $post->nama_kategori_penanganan;
				$nestedData['nama_jenis_komponen_keg'] = $post->nama_jenis_komponen_keg;
				$nestedData['nama_subkomponen'] = $post->nama_subkomponen;
				$nestedData['nama_dtl_subkomponen'] = $post->nama_dtl_subkomponen;
				$nestedData['dk_vol_kegiatan'] = $post->dk_vol_kegiatan;
				$nestedData['dk_satuan'] = $post->dk_satuan;
				$nestedData['dk_lok_kegiatan'] = $post->dk_lok_kegiatan;
				$nestedData['dk_tgl_verifikasi'] = $post->dk_tgl_verifikasi;
				$nestedData['nb_a_pupr_bdi_kolab'] = $post->nb_a_pupr_bdi_kolab;
				$nestedData['nb_a_pupr_bdi_plbk'] = $post->nb_a_pupr_bdi_plbk;
				$nestedData['nb_a_pupr_bdi_lain'] = $post->nb_a_pupr_bdi_lain;
				$nestedData['nb_a_pupr_nsup2'] = $post->nb_a_pupr_nsup2;
				$nestedData['nb_a_pupr_dir_pkp'] = $post->nb_a_pupr_dir_pkp;
				$nestedData['nb_a_pupr_dir_pkp_lain'] = $post->nb_a_pupr_dir_pkp_lain;
				$nestedData['nb_apbn_kl_lain'] = $post->nb_apbn_kl_lain;
				$nestedData['nb_apbd_prop'] = $post->nb_apbd_prop;
				$nestedData['nb_apbd_kota'] = $post->nb_apbd_kota;
				$nestedData['nb_dak'] = $post->nb_dak;
				$nestedData['nb_hibah'] = $post->nb_hibah;
				$nestedData['nb_non_gov'] = $post->nb_non_gov;
				$nestedData['nb_masyarakat'] = $post->nb_masyarakat;
				$nestedData['nb_lainnya'] = $post->nb_lainnya;
				$nestedData['tpm_q_jiwa'] = $post->tpm_q_jiwa;
				$nestedData['tpm_q_jiwa_w'] = $post->tpm_q_jiwa_w;
				$nestedData['tpm_q_mbr'] = $post->tpm_q_mbr;
				$nestedData['tpm_q_kk'] = $post->tpm_q_kk;
				$nestedData['tpm_q_kk_miskin'] = $post->tpm_q_kk_miskin;
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
						if($item->kode_menu==94)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['299'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['300'])){
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
				if($item->kode_menu==94)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			$id_subkomponen = DB::select('select id, nama from bkt_01010120_subkomponen');
			$data['id_subkomponen_list'] = $id_subkomponen;

			if($data['kode']!=null  && !empty($data['detil']['299'])){
				$rowData = DB::select('select * from bkt_01030208_usulan_keg_kt where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['no_proposal'] = $rowData[0]->no_proposal;
				$data['tgl_proposal'] = $rowData[0]->tgl_proposal;
				$data['thn_anggaran'] = $rowData[0]->thn_anggaran;
				$data['kategori_penanganan'] = $rowData[0]->kategori_penanganan;
				$data['jenis_komponen_keg'] = $rowData[0]->jenis_komponen_keg;
				$data['id_subkomponen'] = $rowData[0]->id_subkomponen;
				$data['id_dtl_subkomponen'] = $rowData[0]->id_dtl_subkomponen;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['dk_lok_kegiatan'] = $rowData[0]->dk_lok_kegiatan;
				$data['dk_tgl_verifikasi'] = $rowData[0]->dk_tgl_verifikasi;
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
				$data['tpm_q_jiwa'] = $rowData[0]->tpm_q_jiwa;
				$data['tpm_q_jiwa_w'] = $rowData[0]->tpm_q_jiwa_w;
				$data['tpm_q_mbr'] = $rowData[0]->tpm_q_mbr;
				$data['tpm_q_kk'] = $rowData[0]->tpm_q_kk;
				$data['tpm_q_kk_miskin'] = $rowData[0]->tpm_q_kk_miskin;
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
				$data['id_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['id_dtl_subkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010311/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['298'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['jenis_kegiatan'] = null;
				$data['no_proposal'] = null;
				$data['tgl_proposal'] = null;
				$data['thn_anggaran'] = null;
				$data['kategori_penanganan'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['dk_lok_kegiatan'] = null;
				$data['dk_tgl_verifikasi'] = null;
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
				$data['tpm_q_jiwa'] = null;
				$data['tpm_q_jiwa_w'] = null;
				$data['tpm_q_mbr'] = null;
				$data['tpm_q_kk'] = null;
				$data['tpm_q_kk_miskin'] = null;
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
				$data['id_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				$data['id_dtl_subkomponen_list'] = DB::select('select * from bkt_01010121_dtl_subkomponen where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010311/create',$data);
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
			DB::table('bkt_01030208_usulan_keg_kt')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'no_proposal' => $request->input('no_proposal-input'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal-input')),
				'thn_anggaran' => $request->input('thn_anggaran-input'),
				'kategori_penanganan' => $request->input('select-kategori_penanganan-input'),
				'jenis_komponen_keg' => $request->input('select-jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan-input'),
				'dk_tgl_verifikasi' => $this->date_conversion($request->input('dk_tgl_verifikasi-input')),
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
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/kegiatan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/kegiatan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 299);

		}else{
			DB::table('bkt_01030208_usulan_keg_kt')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('select-skala_kegiatan-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'no_proposal' => $request->input('no_proposal-input'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal-input')),
				'thn_anggaran' => $request->input('thn_anggaran-input'),
				'kategori_penanganan' => $request->input('select-kategori_penanganan-input'),
				'jenis_komponen_keg' => $request->input('select-jenis_komponen_keg-input'),
				'id_subkomponen' => $request->input('select-id_subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('select-id_dtl_subkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan-input'),
				'dk_satuan' => $request->input('dk_satuan-input'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan-input'),
				'dk_tgl_verifikasi' => $this->date_conversion($request->input('dk_tgl_verifikasi-input')),
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
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa-input'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w-input'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr-input'),
				'tpm_q_kk' => $request->input('tpm_q_kk-input'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/perencanaan/kegiatan'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/kegiatan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 298);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030208_usulan_keg_kt')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 300);
        return Redirect::to('/main/perencanaan/rencana_kegiatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 98,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
