<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010407Controller extends Controller
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
				if($item->kode_menu==119)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 370);
				return view('MAIN/bk010407/index',$data);
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
			1 => 'kode_kmw',
			2 => 'kode_kota',
			3 => 'kode_korkot',
			4 => 'kode_kec',
			5 => 'kode_kel',
			6 => 'kode_faskel',
			7 => 'tgl_transaksi',
			8 => 'termin',
			9 => 'jns_program',
			10 => 'jenis_kegiatan',
			11 => 'nilai_dana',
			12 => 'nsl_apbn_nsup',
			13 => 'nsl_apbn_nsup2',
			14 => 'nsl_apbn_dir_pkp',
			15 => 'nsl_apbn_dir_lain',
			16 => 'nsl_apbn_kl_lain',
			17 => 'nsl_apbd_prop',
			18 => 'nsl_apbd_kota',
			19 => 'nsl_dak',
			20 => 'nsl_hibah',
			21 => 'nsl_non_gov',
			22 => 'nsl_masyarakat',
			23 => 'nsl_lain',
			24 => 'keterangan',
			25 => 'diser_tgl',
			26 => 'diser_oleh',
			27 => 'diket_tgl',
			28 => 'diket_oleh',
			29 => 'diver_tgl',
			30 => 'diver_oleh',
			31 => 'created_time',
			32 => 'created_by',
			33 => 'updated_time',
			34 => 'updated_by'
		);
		$query='select * from (select 
					a.*, 
					b.nama nama_kota, 
					c.nama nama_korkot, 
					d.nama nama_kec, 
					e.nama nama_kmw, 
					f.nama nama_kel, 
					g.nama nama_faskel 
				from bkt_01040204_cair_rp_bkm a 
					left join bkt_01010110_kmw b on b.kode=a.kode_kmw
					left join bkt_01010102_kota c on c.kode=a.kode_kota
					left join bkt_01010111_korkot d on d.kode=a.kode_korkot
					left join bkt_01010103_kec e on e.kode=a.kode_kec 
					left join bkt_01010104_kel f on f.kode=kode_kel
					left join bkt_01010113_faskel g on g.kode=kode_faskel
				) b ';
			 
		$totalData = DB::select('select count(1) cnt from bkt_01040204_cair_rp_bkm a 
									left join bkt_01010110_kmw b on b.kode=a.kode_kmw
									left join bkt_01010102_kota c on c.kode=a.kode_kota
									left join bkt_01010111_korkot d on d.kode=a.kode_korkot
									left join bkt_01010103_kec e on e.kode=a.kode_kec 
									left join bkt_01010104_kel f on f.kode=kode_kel
									left join bkt_01010113_faskel g on g.kode=kode_faskel
								');
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
					b.tgl_mulai_ktrk_real like "%'.$search.'%" or
					b.tgl_selesai_ktrk_real like "%'.$search.'%" or 
					b.lok_kegiatan_real like "%'.$search.'%" or
					b.nama_kmw like "%'.$search.'%" or
					b.nama_kota like "%'.$search.'%" or
					b.nama_kec like "%'.$search.'%" or
					b.nama_kel like "%'.$search.'%" or
					b.nama_faskel like "%'.$search.'%" or
					b.nama_subkomponen like "%'.$search.'%" or
					b.nama_dtl_subkomponen like "%'.$search.'%" or
					b.nama_skala_kegiatan like "%'.$search.'%" or
					b.nama_tipe_penanganan like "%'.$search.'%" or
					b.nama_jenis_komponen_keg like "%'.$search.'%" )
					order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.tahun_real like "%'.$search.'%" or 
					b.tgl_mulai_ktrk_real like "%'.$search.'%" or
					b.tgl_selesai_ktrk_real like "%'.$search.'%" or 
					b.lok_kegiatan_real like "%'.$search.'%" or
					b.nama_kmw like "%'.$search.'%" or
					b.nama_kota like "%'.$search.'%" or
					b.nama_kec like "%'.$search.'%" or
					b.nama_kel like "%'.$search.'%" or
					b.nama_faskel like "%'.$search.'%" or
					b.nama_subkomponen like "%'.$search.'%" or
					b.nama_dtl_subkomponen like "%'.$search.'%" or
					b.nama_skala_kegiatan like "%'.$search.'%" or
					b.nama_tipe_penanganan like "%'.$search.'%" or
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

				$url_edit=url('/')."/main/pelaksanaan/kelurahan/pagu_pencairan/create?kode=".$show;
				$url_delete=url('/')."/main/pelaksanaan/kelurahan/pagu_pencairan/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['tgl_transaksi'] = $post->tgl_transaksi;
				$nestedData['termin'] = $post->termin;
				$nestedData['jns_program'] = $post->jns_program;
				$nestedData['jenis_kegiatan'] = $post->jenis_kegiatan;
				$nestedData['nilai_dana'] = $post->nilai_dana;
				$nestedData['nsl_apbn_nsup'] = $post->nsl_apbn_nsup;
				$nestedData['nsl_apbn_nsup2'] = $post->nsl_apbn_nsup2;
				$nestedData['nsl_apbn_dir_pkp'] = $post->nsl_apbn_dir_pkp;
				$nestedData['nsl_apbn_dir_lain'] = $post->nsl_apbn_dir_lain;
				$nestedData['nsl_apbn_kl_lain'] = $post->nsl_apbn_kl_lain;
				$nestedData['nsl_apbd_prop'] = $post->nsl_apbd_prop;
				$nestedData['nsl_apbd_kota'] = $post->nsl_apbd_kota;
				$nestedData['nsl_dak'] = $post->nsl_dak;
				$nestedData['nsl_hibah'] = $post->nsl_hibah;
				$nestedData['nsl_non_gov'] = $post->nsl_non_gov;
				$nestedData['nsl_masyarakat'] = $post->nsl_masyarakat;
				$nestedData['nsl_lain'] = $post->nsl_lain;
				$nestedData['keterangan'] = $post->keterangan;
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
						if($item->kode_menu==119)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['372'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['373'])){
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
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==119)
					$data['detil'][$item->kode_menu_detil]='a';
			}

			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');

			$kode_kmw = DB::select('select kode, nama from bkt_01010110_kmw');
			$data['kode_kmw_list'] = $kode_kmw;

			if($data['kode']!=null && !empty($data['detil']['372'])){
				$rowData = DB::select('select * from bkt_01040204_cair_rp_bkm where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['tgl_transaksi'] = $rowData[0]->tgl_transaksi;
				$data['termin'] = $rowData[0]->termin;
				$data['jns_program'] = $rowData[0]->jns_program;
				$data['jenis_kegiatan'] = $rowData[0]->jenis_kegiatan;
				$data['nilai_dana'] = $rowData[0]->nilai_dana;
				$data['nsl_apbn_nsup'] = $rowData[0]->nsl_apbn_nsup;
				$data['nsl_apbn_nsup2'] = $rowData[0]->nsl_apbn_nsup2;
				$data['nsl_apbn_dir_pkp'] = $rowData[0]->nsl_apbn_dir_pkp;
				$data['nsl_apbn_dir_lain'] = $rowData[0]->nsl_apbn_dir_lain;
				$data['nsl_apbn_kl_lain'] = $rowData[0]->nsl_apbn_kl_lain;
				$data['nsl_apbd_prop'] = $rowData[0]->nsl_apbd_prop;
				$data['nsl_apbd_kota'] = $rowData[0]->nsl_apbd_kota;
				$data['nsl_dak'] = $rowData[0]->nsl_dak;
				$data['nsl_hibah'] = $rowData[0]->nsl_hibah;
				$data['nsl_non_gov'] = $rowData[0]->nsl_non_gov;
				$data['nsl_masyarakat'] = $rowData[0]->nsl_masyarakat;
				$data['nsl_lain'] = $rowData[0]->nsl_lain;
				$data['keterangan'] = $rowData[0]->keterangan;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010407/create',$data);
			}else if ($data['kode']==null && !empty($data['detil']['371'])){
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['tgl_transaksi'] = null;
				$data['termin'] = null;
				$data['jns_program'] = null;
				$data['jenis_kegiatan'] = null;
				$data['nilai_dana'] = null;
				$data['nsl_apbn_nsup'] = null;
				$data['nsl_apbn_nsup2'] = null;
				$data['nsl_apbn_dir_pkp'] = null;
				$data['nsl_apbn_dir_lain'] = null;
				$data['nsl_apbn_kl_lain'] = null;
				$data['nsl_apbd_prop'] = null;
				$data['nsl_apbd_kota'] = null;
				$data['nsl_dak'] = null;
				$data['nsl_hibah'] = null;
				$data['nsl_non_gov'] = null;
				$data['nsl_masyarakat'] = null;
				$data['nsl_lain'] = null;
				$data['keterangan'] = null;
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
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010407/create',$data);
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
			DB::table('bkt_01040204_cair_rp_bkm')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'tgl_transaksi' => $this->date_conversion($request->input('tgl_transaksi-input')),
				'termin' => $request->input('select-termin-input'),
				'jns_program' => $request->input('select-jns_program-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'nsl_apbn_nsup' => $request->input('nsl_apbn_nsup-input'),
				'nsl_apbn_nsup2' => $request->input('nsl_apbn_nsup2-input'),
				'nsl_apbn_dir_pkp' => $request->input('nsl_apbn_dir_pkp-input'),
				'nsl_apbn_dir_lain' => $request->input('nsl_apbn_dir_lain-input'),
				'nsl_apbn_kl_lain' => $request->input('nsl_apbn_kl_lain-input'),
				'nsl_apbd_prop' => $request->input('nsl_apbd_prop-input'),
				'nsl_apbd_kota' => $request->input('nsl_apbd_kota-input'),
				'nsl_dak' => $request->input('nsl_dak-input'),
				'nsl_hibah' => $request->input('nsl_hibah-input'),
				'nsl_non_gov' => $request->input('nsl_non_gov-input'),
				'nsl_masyarakat' => $request->input('nsl_masyarakat-input'),
				'nsl_lain' => $request->input('nsl_lain-input'),
				'keterangan' => $request->input('keterangan-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);

			$this->log_aktivitas('Update', 372);

		}else{
			DB::table('bkt_01040204_cair_rp_bkm')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'tgl_transaksi' => $this->date_conversion($request->input('tgl_transaksi-input')),
				'termin' => $request->input('select-termin-input'),
				'jns_program' => $request->input('select-jns_program-input'),
				'jenis_kegiatan' => $request->input('select-jenis_kegiatan-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'nsl_apbn_nsup' => $request->input('nsl_apbn_nsup-input'),
				'nsl_apbn_nsup2' => $request->input('nsl_apbn_nsup2-input'),
				'nsl_apbn_dir_pkp' => $request->input('nsl_apbn_dir_pkp-input'),
				'nsl_apbn_dir_lain' => $request->input('nsl_apbn_dir_lain-input'),
				'nsl_apbn_kl_lain' => $request->input('nsl_apbn_kl_lain-input'),
				'nsl_apbd_prop' => $request->input('nsl_apbd_prop-input'),
				'nsl_apbd_kota' => $request->input('nsl_apbd_kota-input'),
				'nsl_dak' => $request->input('nsl_dak-input'),
				'nsl_hibah' => $request->input('nsl_hibah-input'),
				'nsl_non_gov' => $request->input('nsl_non_gov-input'),
				'nsl_masyarakat' => $request->input('nsl_masyarakat-input'),
				'nsl_lain' => $request->input('nsl_lain-input'),
				'keterangan' => $request->input('keterangan-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('diser_tgl-input')),
				'diser_oleh' => $request->input('diser_oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('diket_tgl-input')),
				'diket_oleh' => $request->input('diket_oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('diver-tgl-input')),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 371);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01040204_cair_rp_bkm')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 373);
        return Redirect::to('/main/pelaksanaan/kelurahan/pagu_pencairan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 7,
				'kode_menu' => 119,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
