<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010402Controller extends Controller
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
				if($item->kode_menu==114)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 350);
				return view('MAIN/bk010402/index',$data);
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
			1 =>'skala_kegiatan',
			2 =>'kode_parent',
			3 =>'kode_kmw',
			4 =>'kode_kota',
			5 =>'kode_korkot',
			6 =>'kode_kontraktor',
			7 =>'rp_uang_muka',
			8 =>'rp_termin1',
			9 =>'rp_termin2',
			10 =>'rp_termin3',
			11 =>'rp_progress',
			12 =>'created_time'
		);
		$query='
			select 
				a.*, e.nama nama_kota,
				c.nama nama_korkot,
				d.nama nama_kmw,
				b.jenis_komponen_keg,
			    b.tahun,
			    b.skala_kegiatan,
			    f.nama nama_kontraktor,
				g.nama nama_subkomponen,
				h.nama nama_dtl_subkomponen
			from bkt_01040203_cair_rp_kontraktor a
				left join bkt_01030213_ktrk_pkt_krj_kontraktor b on b.kode=a.kode_parent
				left join bkt_01010111_korkot c on c.kode=b.kode_korkot
				left join bkt_01010110_kmw d on d.kode=b.kode_kmw
				left join bkt_01010102_kota e on e.kode=b.kode_kota
				left join bkt_01010126_kontraktor f on f.kode=b.kode_kontraktor
				left join bkt_01010120_subkomponen g on g.id=b.id_subkomponen
				left join bkt_01010121_dtl_subkomponen h on h.id=b.id_dtl_subkomponen';
		$totalData = DB::select('select count(1) cnt from bkt_01040203_cair_rp_kontraktor a
				left join bkt_01030213_ktrk_pkt_krj_kontraktor b on b.kode=a.kode_parent
				left join bkt_01010111_korkot c on c.kode=b.kode_korkot
				left join bkt_01010110_kmw d on d.kode=b.kode_kmw
				left join bkt_01010102_kota e on e.kode=b.kode_kota
				left join bkt_01010126_kontraktor f on f.kode=b.kode_kontraktor
				left join bkt_01010120_subkomponen g on g.id=b.id_subkomponen
				left join bkt_01010121_dtl_subkomponen h on h.id=b.id_dtl_subkomponen');
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
			$posts=DB::select($query. ' and (a.kode like "%'.$search.'%" or b.tahun like "%'.$search.'%" or b.skala_kegiatan like "%'.$search.'%" or e.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or f.nama like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and (a.kode like "%'.$search.'%" or b.tahun like "%'.$search.'%" or b.skala_kegiatan like "%'.$search.'%" or e.nama like "%'.$search.'%" or c.nama like "%'.$search.'%" or d.nama like "%'.$search.'%" or f.nama like "%'.$search.'%")) a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/pelaksanaan/kota_bdi/pencairan_kontraktor/create?kode=".$edit;
				$url_delete=url('/')."/main/pelaksanaan/kota_bdi/pencairan_kontraktor/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['skala_kegiatan'] = $post->skala_kegiatan;
				$nestedData['kode_parent'] = $post->jenis_komponen_keg.'-'.$post->nama_subkomponen.'-'.$post->nama_dtl_subkomponen;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_kontraktor'] = $post->nama_kontraktor;
				$nestedData['rp_uang_muka'] = $post->rp_uang_muka;
				$nestedData['rp_termin1'] = $post->rp_termin1;
				$nestedData['rp_termin2'] = $post->rp_termin2;
				$nestedData['rp_termin3'] = $post->rp_termin3;
				$nestedData['rp_progress'] = $post->rp_progress;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==114)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['352'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['353'])){
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
				if($item->kode_menu==114)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['352'])){
				$rowData = DB::select('select * from bkt_01020202_pokja where kode='.$data['kode']);
				$data['kode_parent'] = $rowData[0]->kode_parent;
				$data['rp_uang_muka'] = $rowData[0]->rp_uang_muka;
				$data['rp_termin1'] = $rowData[0]->rp_termin1;
				$data['rp_termin2'] = $rowData[0]->rp_termin2;
				$data['rp_termin3'] = $rowData[0]->rp_termin3;
				$data['rp_progress'] = $rowData[0]->rp_progress;
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
						e.nama nama_kota,
						c.nama nama_korkot,
						d.nama nama_kmw,
						b.jenis_komponen_keg,
					    b.tahun,
					    b.skala_kegiatan,
					    f.nama nama_kontraktor,
						g.nama nama_subkomponen,
						h.nama nama_dtl_subkomponen
					from bkt_01030213_ktrk_pkt_krj_kontraktor b 
						left join bkt_01010111_korkot c on c.kode=b.kode_korkot
						left join bkt_01010110_kmw d on d.kode=b.kode_kmw
						left join bkt_01010102_kota e on e.kode=b.kode_kota
						left join bkt_01010126_kontraktor f on f.kode=b.kode_kontraktor
						left join bkt_01010120_subkomponen g on g.id=b.id_subkomponen
						left join bkt_01010121_dtl_subkomponen h on h.id=b.id_dtl_subkomponen
					where
						a.kode='.$rowData[0]->kode_parent);
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				if(!empty($rowData[0]->kode_parent))
					$data['kode_kmw_list']=DB::select('select b.kode, b.nama from bkt_01030213_ktrk_pkt_krj_kontraktor a, bkt_01010110_kmw b where a.kode_kmw=b.kode and a.kode='.$rowData[0]->kode_parent);
				if(!empty($rowData[0]->kode_parent))
					$data['kode_kota_list']=DB::select('select b.kode, b.nama from bkt_01030213_ktrk_pkt_krj_kontraktor a, bkt_01010102_kota b where a.kode_kota=b.kode and a.kode='.$rowData[0]->kode_parent);
				if(!empty($rowData[0]->kode_parent))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01030213_ktrk_pkt_krj_kontraktor a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode='.$rowData[0]->kode_parent);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010402/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['351'])){
				$data['kode_parent'] = null;
				$data['rp_uang_muka'] = null;
				$data['rp_termin1'] = null;
				$data['rp_termin2'] = null;
				$data['rp_termin3'] = null;
				$data['rp_progress'] = null;
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
						e.nama nama_kota,
						c.nama nama_korkot,
						d.nama nama_kmw,
						b.jenis_komponen_keg,
					    b.tahun,
					    b.skala_kegiatan,
					    f.nama nama_kontraktor,
						g.nama nama_subkomponen,
						h.nama nama_dtl_subkomponen
					from bkt_01030213_ktrk_pkt_krj_kontraktor b 
						left join bkt_01010111_korkot c on c.kode=b.kode_korkot
						left join bkt_01010110_kmw d on d.kode=b.kode_kmw
						left join bkt_01010102_kota e on e.kode=b.kode_kota
						left join bkt_01010126_kontraktor f on f.kode=b.kode_kontraktor
						left join bkt_01010120_subkomponen g on g.id=b.id_subkomponen
						left join bkt_01010121_dtl_subkomponen h on h.id=b.id_dtl_subkomponen';
				$data['kode_kota_list'] = DB::select('select * from bkt_01010102_kota where status=1');
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = DB::select('select * from bkt_01010111_korkot');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010402/create',$data);
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
			DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'status_pokja' => $request->input('status-pokja-input'),
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_kl' => $request->input('upp-kementrian-input'),
				'upp_dinas' => $request->input('upp-dinas-input'),
				'upp_dpr' => $request->input('upp-dpr-input'),
				'upn_lsm' => $request->input('upnp-lsm-input'),
				'unp_bu' => $request->input('upnp-swasta-input'),
				'upn_praktisi' => $request->input('upnp-praktisi-input'),
				'nilai_dana_ops' => $request->input('dana-ops-input'),
				'url_rencana_kerja' => $url_rnckerja,
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
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

			$this->log_aktivitas('Update', 62);

		}else{
			DB::table('bkt_01020202_pokja')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_prop' => $request->input('kode-prop-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'jenis_kegiatan' => $request->input('jns-kegiatan-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'status_pokja' => $request->input('status-pokja-input'),
				'ds_hkm' => $request->input('dsr-pembentukan-input'),
				'q_anggota_p' => $request->input('q-laki-input'),
				'q_anggota_w' => $request->input('q-perempuan-input'),
				'upp_kl' => $request->input('upp-kementrian-input'),
				'upp_dinas' => $request->input('upp-dinas-input'),
				'upp_dpr' => $request->input('upp-dpr-input'),
				'upn_lsm' => $request->input('upnp-lsm-input'),
				'unp_bu' => $request->input('upnp-swasta-input'),
				'upn_praktisi' => $request->input('upnp-praktisi-input'),
				'nilai_dana_ops' => $request->input('dana-ops-input'),
				'url_rencana_kerja' => $url_rnckerja,
				'ket_rencana_kerja' => $request->input('ket-rencana-kerja-input'),
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

			$this->log_aktivitas('Create', 61);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020202_pokja')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 63);
        return Redirect::to('/main/pelaksanaan/kota_bdi/pencairan_kontraktor');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 114,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
