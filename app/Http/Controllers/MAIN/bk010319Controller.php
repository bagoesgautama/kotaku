<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010319Controller extends Controller
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
				if($item->kode_menu==103)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 333);
				return view('MAIN/bk010319/index',$data);
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
		if(!empty($request->input('id_subkomponen'))){
			$dtl_subkomponen = DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$request->input('id_subkomponen').' and status=1');
			echo json_encode($dtl_subkomponen);
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
		$query='select a.*, b.nama nama_kota, c.nama nama_korkot, d.nama nama_kec, e.nama nama_kmw, f.nama nama_kel, g.nama nama_faskel, h.nama id_subkomponen, i.nama id_dtl_subkomponen 
			from bkt_01030208_usulan_keg_kt a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010103_kec d, 
				bkt_01010110_kmw e,
				bkt_01010104_kel f,
				bkt_01010113_faskel g,
				bkt_01010120_subkomponen h,
				bkt_01010121_dtl_subkomponen i
			where b.kode=a.kode_kota and 
			c.kode=a.kode_korkot and 
			d.kode=a.kode_kec and 
			e.kode=a.kode_kmw and 
			f.kode=a.kode_kel and 
			g.kode=a.kode_faskel and
			h.id=a.id_subkomponen and
			i.id=a.id_dtl_subkomponen and
			a.skala_kegiatan="2"';
		$totalData = DB::select('select count(1) cnt from 
				bkt_01030208_usulan_keg_kt a, 
				bkt_01010102_kota b, 
				bkt_01010111_korkot c, 
				bkt_01010103_kec d, 
				bkt_01010110_kmw e,
				bkt_01010104_kel f,
				bkt_01010113_faskel g,
				bkt_01010120_subkomponen h,
				bkt_01010121_dtl_subkomponen i
			where b.kode=a.kode_kota and 
			c.kode=a.kode_korkot and 
			d.kode=a.kode_kec and 
			e.kode=a.kode_kmw and 
			f.kode=a.kode_kel and 
			g.kode=a.kode_faskel and
			h.id=a.id_subkomponen and
			i.id=a.id_dtl_subkomponen and
			a.skala_kegiatan="2"');
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
			$posts=DB::select($query. ' and (a.tahun like "%'.$search.'%" or a.skala_kegiatan like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or h.nama like "%'.$search.'%" or i.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or a.no_proposal like "%'.$search.'%" or a.tgl_proposal like "%'.$search.'%" or a.thn_anggaran like "%'.$search.'%" or a.kategori_penanganan like "%'.$search.'%" or a.jenis_komponen_keg like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.tahun like "%'.$search.'%" or a.skala_kegiatan like "%'.$search.'%" or b.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or e.nama like "%'.$search.'%" or f.nama like "%'.$search.'%" or g.nama like "%'.$search.'%" or h.nama like "%'.$search.'%" or i.nama like "%'.$search.'%" or a.jenis_kegiatan like "%'.$search.'%" or a.no_proposal like "%'.$search.'%" or a.tgl_proposal like "%'.$search.'%" or a.thn_anggaran like "%'.$search.'%" or a.kategori_penanganan like "%'.$search.'%" or a.jenis_komponen_keg like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$jenis_kegiatan = null;
				$skala_kegiatan = null;
				$kategori_penanganan = null;
				$jenis_komponen_keg = null;

				if($post->jenis_kegiatan == '0'){
					$jenis_kegiatan = 'Non Bergulir';
				}elseif($post->jenis_kegiatan == '1'){
					$jenis_kegiatan = 'Bergulir';
				}

				if($post->skala_kegiatan == '1'){
					$skala_kegiatan = 'Kota/Kabupaten';
				}elseif($post->skala_kegiatan == '2'){
					$skala_kegiatan = 'Desa/kelurahan';
				}

				if($post->kategori_penanganan == '0'){
					$kategori_penanganan = 'Rehab';
				}elseif($post->kategori_penanganan == '1'){
					$kategori_penanganan = 'Baru';
				}

				if($post->jenis_komponen_keg == 'L'){
					$jenis_komponen_keg = 'Lingkungan';
				}elseif($post->jenis_komponen_keg == 'S'){
					$jenis_komponen_keg = 'Sosial';
				}elseif($post->jenis_komponen_keg == 'E'){
					$jenis_komponen_keg = 'Ekonomi';
				}

				$url_edit=url('/')."/main/perencanaan/kelurahan/kegiatan/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kelurahan/kegiatan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['skala_kegiatan'] = $skala_kegiatan;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['kode_faskel'] = $post->nama_faskel;
				$nestedData['jenis_kegiatan'] = $jenis_kegiatan;
				$nestedData['no_proposal'] = $post->no_proposal;
				$nestedData['tgl_proposal'] = $post->tgl_proposal;
				$nestedData['thn_anggaran'] = $post->thn_anggaran;
				$nestedData['kategori_penanganan'] = $kategori_penanganan;
				$nestedData['jenis_komponen_keg'] = $jenis_komponen_keg;
				$nestedData['id_subkomponen'] = $post->id_subkomponen;
				$nestedData['id_dtl_subkomponen'] = $post->id_dtl_subkomponen;
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
						if($item->kode_menu==103)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['335'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['336'])){
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
				if($item->kode_menu==103)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['335'])){
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
				$data['kode_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				if(!empty($rowData[0]->id_subkomponen))
					$data['kode_subdtlkomponen_list']=DB::select('select id, kode_dtl_subkomponen, nama from bkt_01010121_dtl_subkomponen where id_subkomponen='.$rowData[0]->id_subkomponen.' and status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010319/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['334'])){
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
				$data['kode_subkomponen_list'] = DB::select('select * from bkt_01010120_subkomponen where status=1');
				$data['kode_subdtlkomponen_list'] = DB::select('select * from bkt_01010121_dtl_subkomponen where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010319/create',$data);
			}else{
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
			DB::table('bkt_01030208_usulan_keg_kt')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('skala_kegiatan'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'no_proposal' => $request->input('no_proposal'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal')),
				'thn_anggaran' => $request->input('thn_anggaran'),
				'kategori_penanganan' => $request->input('kategori_penanganan'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg'),
				'id_subkomponen' => $request->input('kode-subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('kode-subdtlkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan'),
				'dk_satuan' => $request->input('dk_satuan'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan'),
				'dk_tgl_verifikasi' => $this->date_conversion($request->input('dk_tgl_verifikasi')),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_dak' => $request->input('nb_dak'),
				'nb_hibah' => $request->input('nb_hibah'),
				'nb_non_gov' => $request->input('nb_non_gov'),
				'nb_masyarakat' => $request->input('nb_masyarakat'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/rencana_kelurahan/kegiatan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/rencana_kelurahan/kegiatan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 335);

		}else{
			DB::table('bkt_01030208_usulan_keg_kt')->insert([
				'tahun' => $request->input('tahun-input'),
				'skala_kegiatan' => $request->input('skala_kegiatan'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'no_proposal' => $request->input('no_proposal'),
				'tgl_proposal' => $this->date_conversion($request->input('tgl_proposal')),
				'thn_anggaran' => $request->input('thn_anggaran'),
				'kategori_penanganan' => $request->input('kategori_penanganan'),
				'jenis_komponen_keg' => $request->input('jenis_komponen_keg'),
				'id_subkomponen' => $request->input('kode-subkomponen-input'),
				'id_dtl_subkomponen' => $request->input('kode-subdtlkomponen-input'),
				'dk_vol_kegiatan' => $request->input('dk_vol_kegiatan'),
				'dk_satuan' => $request->input('dk_satuan'),
				'dk_lok_kegiatan' => $request->input('dk_lok_kegiatan'),
				'dk_tgl_verifikasi' => $this->date_conversion($request->input('dk_tgl_verifikasi')),
				'nb_a_pupr_bdi_kolab' => $request->input('nb_a_pupr_bdi_kolab'),
				'nb_a_pupr_bdi_plbk' => $request->input('nb_a_pupr_bdi_plbk'),
				'nb_a_pupr_bdi_lain' => $request->input('nb_a_pupr_bdi_lain'),
				'nb_a_pupr_nsup2' => $request->input('nb_a_pupr_nsup2'),
				'nb_a_pupr_dir_pkp' => $request->input('nb_a_pupr_dir_pkp'),
				'nb_a_pupr_dir_pkp_lain' => $request->input('nb_a_pupr_dir_pkp_lain'),
				'nb_apbn_kl_lain' => $request->input('nb_apbn_kl_lain'),
				'nb_apbd_prop' => $request->input('nb_apbd_prop'),
				'nb_apbd_kota' => $request->input('nb_apbd_kota'),
				'nb_dak' => $request->input('nb_dak'),
				'nb_hibah' => $request->input('nb_hibah'),
				'nb_non_gov' => $request->input('nb_non_gov'),
				'nb_masyarakat' => $request->input('nb_masyarakat'),
				'nb_lainnya' => $request->input('nb_lainnya'),
				'tpm_q_jiwa' => $request->input('tpm_q_jiwa'),
				'tpm_q_jiwa_w' => $request->input('tpm_q_jiwa_w'),
				'tpm_q_mbr' => $request->input('tpm_q_mbr'),
				'tpm_q_kk' => $request->input('tpm_q_kk'),
				'tpm_q_kk_miskin' => $request->input('tpm_q_kk_miskin'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/perencanaan/rencana_kelurahan/kegiatan'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/perencanaan/rencana_kelurahan/kegiatan'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 334);
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
		$this->log_aktivitas('Delete', 336);
        return Redirect::to('/main/perencanaan/kelurahan/kegiatan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 103,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
