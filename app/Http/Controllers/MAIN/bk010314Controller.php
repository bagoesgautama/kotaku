<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010314Controller extends Controller
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
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

				$this->log_aktivitas('View', 301);
				return view('MAIN/bk010314/index',$data);
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
			1 => 'kode_kota',
			2 => 'kode_korkot',
			3 => 'kode_kec',
			4 => 'kode_kmw',
			5 => 'kode_kel',
			6 => 'kode_faskel',
			7 => 'kode_pkt_krj',
			8 => 'tgl_lelang_mulai',
			9 => 'tgl_lelang_selesai',
			10 => 'nomor_kontrak',
			11 => 'sd_apbn_nsup',
			12 => 'sd_apbn_lain',
			13 => 'sd_apbd_prop',
			14 => 'sd_apbd_kota',
			15 => 'sd_swasta',
			16 => 'keterangan',
			17 => 'uri_img_document',
			18 => 'uri_img_absensi',
			19 => 'diser_tgl',
			20 => 'diser_oleh',
			21 => 'diket_tgl',
			22 => 'diket_oleh',
			23 => 'diver_tgl',
			24 => 'diver_oleh',
			25 => 'created_time',
			26 => 'created_by',
			27 => 'updated_time',
			28 => 'updated_by',
			29 => 'nama_paket'
		);
		$query='select 
					a.*, 
					b.nama nama_kmw,
					c.nama nama_kota,
					d.nama nama_korkot,
					e.nama nama_kec,
					f.nama nama_kel,
					g.nama nama_faskel,
					h.jenis_komponen_keg,
					i.nama nama_subkomponen,
					j.nama nama_dtl_subkomponen
				from bkt_01030211_lelang a 
					left join bkt_01010110_kmw b on b.kode=a.kode_kmw
					left join bkt_01010102_kota c on c.kode=a.kode_kota
					left join bkt_01010111_korkot d on d.kode=a.kode_korkot
					left join bkt_01010103_kec e on e.kode=a.kode_kec
					left join bkt_01010104_kel f on f.kode=a.kode_kel
					left join bkt_01010113_faskel g on g.kode=a.kode_faskel
					left join bkt_01030209_pkt_krj_kontraktor h on h.kode=a.kode_pkt_krj
					left join bkt_01010120_subkomponen i on i.id=h.id_subkomponen
					left join bkt_01010121_dtl_subkomponen j on j.id=h.id_dtl_subkomponen ';
				
		$totalData = DB::select('select count(1) cnt from bkt_01030211_lelang a 
									left join bkt_01010110_kmw b on b.kode=a.kode_kmw
									left join bkt_01010102_kota c on c.kode=a.kode_kota
									left join bkt_01010111_korkot d on d.kode=a.kode_korkot
									left join bkt_01010103_kec e on e.kode=a.kode_kec
									left join bkt_01010104_kel f on f.kode=a.kode_kel
									left join bkt_01010113_faskel g on g.kode=a.kode_faskel
									left join bkt_01030209_pkt_krj_kontraktor h on h.kode=a.kode_pkt_krj
									left join bkt_01010120_subkomponen i on i.id=h.id_subkomponen
									left join bkt_01010121_dtl_subkomponen j on j.id=h.id_dtl_subkomponen ');
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
			$posts=DB::select($query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;

				$url_edit=url('/')."/main/perencanaan/pengadaan_lelang/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/pengadaan_lelang/delete?kode=".$delete;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['nama_korkot'] = $post->nama_korkot;
				$nestedData['nama_kec'] = $post->nama_kec;
				$nestedData['nama_kmw'] = $post->nama_kmw;
				$nestedData['nama_kel'] = $post->nama_kel;
				$nestedData['nama_faskel'] = $post->nama_faskel;
				$nestedData['kode_pkt_krj'] = $post->kode_pkt_krj.' - '.$post->jenis_komponen_keg.' - '.$post->nama_subkomponen.' - '.$post->nama_dtl_subkomponen;
				$nestedData['tgl_lelang_mulai'] = $post->tgl_lelang_mulai;
				$nestedData['tgl_lelang_selesai'] = $post->tgl_lelang_selesai;
				$nestedData['nomor_kontrak'] = $post->nomor_kontrak;
				$nestedData['sd_apbn_nsup'] = $post->sd_apbn_nsup;
				$nestedData['sd_apbn_lain'] = $post->sd_apbn_lain;
				$nestedData['sd_apbd_prop'] = $post->sd_apbd_prop;
				$nestedData['sd_apbd_kota'] = $post->sd_apbd_kota;
				$nestedData['sd_swasta'] = $post->sd_swasta;
				$nestedData['keterangan'] = $post->keterangan;
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
				$nestedData['nama_paket'] = $post->nama_paket;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==100)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['303'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['304'])){
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

	public function post_peserta(Request $request)
	{
		if($request->input('kode')!=null)
		{
			$columns = array(
				0 =>'kode_lelang',
				1 => 'no_urut',
				2 => 'kode_kontraktor',
				3 => 'flag_pemenang',
				4 => 'diser_tgl',
				5 => 'diser_oleh',
				6 => 'diket_tgl',
				7 => 'diket_oleh',
				8 => 'diver_tgl',
				9 => 'diver_oleh',
				10 => 'created_time',
				11 => 'created_by',
				12 => 'updated_time',
				13 => 'updated_by',
				14 => 'nama_paket'
			);
			$query='select a.*, b.kode as kode_lelang_peserta, b.created_time as created_time_lelang_peserta
				from bkt_01030212_pst_lelang b, 
					bkt_01010126_kontraktor a
				where a.kode=b.kode_kontraktor and b.kode_lelang_peserta='.$request->input('kode');
			$totalData = DB::select('select count(1) cnt from bkt_01030212_pst_lelang b, 
										bkt_01010126_kontraktor a
									where a.kode=b.kode_kontraktor and b.kode_lelang_peserta='.$request->input('kode'));
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
				$posts=DB::select($query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
				$totalFiltered=DB::select('select count(1) from ('.$query. ' and a.tahun like "%'.$search.'%" or b.kode_prop like "%'.$search.'%" or c.kode_kota like "%'.$search.'%" or d.kode_korkot like "%'.$search.'%") a');
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$show =  $post->kode;
					$edit =  $post->kode;
					$delete = $post->kode_lelang_peserta;

					$url_delete=url('/')."/main/perencanaan/pengadaan_lelang/delete?kode=".$delete."&kode_lelang=".$request->input('kode');
					$nestedData['nama'] = $post->nama;
					$nestedData['alamat'] = $post->alamat;
					$nestedData['no_phone'] = $post->no_phone;
					$nestedData['no_hp'] = $post->no_phone;
					$nestedData['no_fax'] = $post->no_phone;
					$nestedData['created_time'] = $post->created_time_lelang_peserta;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==100)
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
		elseif($request->input('kode_lelang')!=null)
		{
			$columns = array(
				0 =>'nama',
				1 =>'alamat',
				2 =>'no_phone',
				3 =>'no_hp',
				4 =>'no_fax',
				5 =>'created_time'
			);

			if($request->input('where')!=null){
				$query='select * from bkt_01010126_kontraktor where '.$request->input('where');
				$totalData = DB::select('select count(1) cnt from bkt_01010126_kontraktor where '.$request->input('where'));
			}else{
				$query='select * from bkt_01010126_kontraktor';
				$totalData = DB::select('select count(1) cnt from bkt_01010126_kontraktor');
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
					$nestedData['nama'] = $post->nama;
					$nestedData['alamat'] = $post->alamat;
					$nestedData['no_phone'] = $post->no_phone;
					$nestedData['no_hp'] = $post->no_hp;
					$nestedData['no_fax'] = $post->no_fax;
					$nestedData['created_time'] = $post->created_time;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==100)
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
		elseif($request->input('kode_real_keg')!=null)
		{
			$columns = array(
				0 =>'nama',
				1 =>'alamat',
				2 =>'no_phone',
				3 =>'no_hp',
				4 =>'no_fax',
				5 =>'created_time'
			);

			if($request->input('where')!=null){
				$query='select * from bkt_01010126_kontraktor where '.$request->input('where');
				$totalData = DB::select('select count(1) cnt from bkt_01010126_kontraktor where '.$request->input('where'));
			}else{
				$query='select * from bkt_01010126_kontraktor';
				$totalData = DB::select('select count(1) cnt from bkt_01010126_kontraktor');
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
							if($item->kode_menu==100)
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
								when a.jenis_komponen_keg = "L" then "Lingkungan"
								when a.jenis_komponen_keg = "S" then "Sosial"
								when a.jenis_komponen_keg = "E" then "Ekonomi"
							end nama_komponen,
							case
								when a.skala_kegiatan = "P" then "Primer"
								when a.skala_kegiatan = "S" then "Sekunder"
								when a.skala_kegiatan = "T" then "Tersier"
							end skala,
							case
								when a.dk_tipe_penanganan = "0" then "Rehab"
								when a.dk_tipe_penanganan = "1" then "Baru"
							end nama_penanganan	 
						from bkt_01030209_pkt_krj_kontraktor a
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
	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['303'])){
				$rowData = DB::select('select a.*, b.* from bkt_01030211_lelang a left join bkt_01030209_pkt_krj_kontraktor b on a.kode_pkt_krj=b.kode where a.kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['kode_pkt_krj'] = $rowData[0]->kode_pkt_krj;
				$data['tgl_lelang_mulai'] = $rowData[0]->tgl_lelang_mulai;
				$data['tgl_lelang_selesai'] = $rowData[0]->tgl_lelang_selesai;
				$data['nomor_kontrak'] = $rowData[0]->nomor_kontrak;
				$data['sd_apbn_nsup'] = $rowData[0]->sd_apbn_nsup;
				$data['sd_apbn_lain'] = $rowData[0]->sd_apbn_lain;
				$data['sd_apbd_prop'] = $rowData[0]->sd_apbd_prop;
				$data['sd_apbd_kota'] = $rowData[0]->sd_apbd_kota;
				$data['sd_swasta'] = $rowData[0]->sd_swasta;
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
				$data['nama_paket'] = $rowData[0]->nama_paket;
				$data['skala'] = DB::select('
					select
					case
						when skala_kegiatan = "P" then "Primer"
						when skala_kegiatan = "S" then "Sekunder"
						when skala_kegiatan = "S" then "Tersier"
					end skala
					from bkt_01030209_pkt_krj_kontraktor
					where
						kode='.$rowData[0]->kode_pkt_krj);
				$data['skala_kegiatan'] = $data['skala'][0]->skala;
				$data['data_kegiatan_list'] = DB::select('select a.*,
							b.nama nama_kmw,
							c.nama nama_kota,
							d.nama nama_korkot,
							e.nama nama_kec,
							f.nama nama_kel,
							g.nama nama_faskel	 
						from bkt_01030209_pkt_krj_kontraktor a
							left join bkt_01010110_kmw b on a.kode_kmw=b.kode
							left join bkt_01010102_kota c on a.kode_kota=c.kode 
							left join bkt_01010111_korkot d on a.kode_korkot=d.kode
							left join bkt_01010103_kec e on a.kode_kec=e.kode
							left join bkt_01010104_kel f on a.kode_kel=f.kode
							left join bkt_01010113_faskel g on a.kode_faskel=g.kode
						where a.kode='.$rowData[0]->kode);
				$data['komponen'] = DB::select('
					select
					case
						when jenis_komponen_keg = "L" then "Lingkungan"
						when jenis_komponen_keg = "S" then "Sosial"
						when jenis_komponen_keg = "E" then "Ekonomi"
					end komponen
					from bkt_01030209_pkt_krj_kontraktor
					where
						kode='.$rowData[0]->kode_pkt_krj);
				$data['jenis_komponen_keg'] = $data['komponen'][0]->komponen;
				$data['subkomponen'] = DB::select('
					select  
						b.nama nama_subkomponen
					from bkt_01030209_pkt_krj_kontraktor a
						left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
					where
						a.kode='.$rowData[0]->kode_pkt_krj);
				$data['id_subkomponen'] = $data['subkomponen'][0]->nama_subkomponen;
				$data['dtl_subkomponen'] = DB::select('
					select 
						b.nama nama_dtl_subkomponen
					from bkt_01030209_pkt_krj_kontraktor a
						left join bkt_01010121_dtl_subkomponen b on b.id=a.id_dtl_subkomponen 
					where
						a.kode='.$rowData[0]->kode_pkt_krj);
				$data['id_dtl_subkomponen'] = $data['dtl_subkomponen'][0]->nama_dtl_subkomponen;
				$data['tipe_penanganan'] = DB::select('
					select
					case
						when dk_tipe_penanganan = "0" then "Rehab"
						when dk_tipe_penanganan = "1" then "Baru"
					end tipe_penanganan
					from bkt_01030209_pkt_krj_kontraktor
					where
						kode='.$rowData[0]->kode_pkt_krj);
				$data['dk_tipe_penanganan'] = $data['tipe_penanganan'][0]->tipe_penanganan;
				$data['kode_pkt_krj_list'] = DB::select('
					select 
						a.*, 
						b.nama nama_subkomponen,
						c.nama nama_dtl_subkomponen
					from bkt_01030209_pkt_krj_kontraktor a
						left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen c on c.id=a.id_dtl_subkomponen 
					where
						a.kode='.$rowData[0]->kode_pkt_krj);
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['dk_vol_kegiatan'] = $rowData[0]->dk_vol_kegiatan;
				$data['dk_satuan'] = $rowData[0]->dk_satuan;
				$data['nb_apbn_nsup'] = $rowData[0]->nb_apbn_nsup;
				$data['nb_apbn_lain'] = $rowData[0]->nb_apbn_lain;
				$data['nb_apbd_prop'] = $rowData[0]->nb_apbd_prop;
				$data['nb_apbd_kota'] = $rowData[0]->nb_apbd_kota;
				$data['nb_lainnya'] = $rowData[0]->nb_lainnya;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010314/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['302'])){
				$data['tahun'] = null;
				$data['skala_kegiatan'] = null;
				$data['kode_kota'] = null;
				$data['kode_korkot'] = null;
				$data['kode_kec'] = null;
				$data['kode_kmw'] = null;
				$data['kode_kel'] = null;
				$data['kode_faskel'] = null;
				$data['kode_pkt_krj'] = null;
				$data['tgl_lelang_mulai'] = null;
				$data['tgl_lelang_selesai'] = null;
				$data['nomor_kontrak'] = null;
				$data['sd_apbn_nsup'] = null;
				$data['sd_apbn_lain'] = null;
				$data['sd_apbd_prop'] = null;
				$data['sd_apbd_kota'] = null;
				$data['sd_swasta'] = null;
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
				$data['kode_pkt_krj_list'] = DB::select('
					select 
						a.*, 
						b.nama nama_subkomponen,
						c.nama nama_dtl_subkomponen
					from bkt_01030209_pkt_krj_kontraktor a
						left join bkt_01010120_subkomponen b on b.id=a.id_subkomponen
						left join bkt_01010121_dtl_subkomponen c on c.id=a.id_dtl_subkomponen');
				$data['data_kegiatan_list'] = DB::select('select a.*,
							b.nama nama_kmw,
							c.nama nama_kota,
							d.nama nama_korkot,
							e.nama nama_kec,
							f.nama nama_kel,
							g.nama nama_faskel	 
						from bkt_01030209_pkt_krj_kontraktor a
							left join bkt_01010110_kmw b on a.kode_kmw=b.kode
							left join bkt_01010102_kota c on a.kode_kota=c.kode 
							left join bkt_01010111_korkot d on a.kode_korkot=d.kode
							left join bkt_01010103_kec e on a.kode_kec=e.kode
							left join bkt_01010104_kel f on a.kode_kel=f.kode
							left join bkt_01010113_faskel g on a.kode_faskel=g.kode');
				$data['nama_paket'] = null;
				$data['lok_kegiatan'] = null;
				$data['jenis_komponen_keg'] = null;
				$data['id_subkomponen'] = null;
				$data['id_dtl_subkomponen'] = null;
				$data['dk_vol_kegiatan'] = null;
				$data['dk_satuan'] = null;
				$data['dk_tipe_penanganan'] = null;
				$data['nb_apbn_nsup'] = null;
				$data['nb_apbn_lain'] = null;
				$data['nb_apbd_prop'] = null;
				$data['nb_apbd_kota'] = null;
				$data['nb_lainnya'] = null;
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010314/create',$data);
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
			DB::table('bkt_01030211_lelang')->where('kode', $request->input('kode'))
			->update(['tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_pkt_krj' => $request->input('select-kode_pkt_krj-input'),
				'tgl_lelang_mulai' => $this->date_conversion($request->input('tgl_lelang_mulai-input')),
				'tgl_lelang_selesai' => $this->date_conversion($request->input('tgl_lelang_selesai-input')),
				'nomor_kontrak' => $request->input('nomor_kontrak-input'),
				'sd_apbn_nsup' => $request->input('sd_apbn_nsup-input'),
				'sd_apbn_lain' => $request->input('sd_apbn_lain-input'),
				'sd_apbd_prop' => $request->input('sd_apbd_prop-input'),
				'sd_apbd_kota' => $request->input('sd_apbd_kota-input'),
				'sd_swasta' => $request->input('sd_swasta-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				//'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				//'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				//'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s'),
				'nama_paket' => $request->input('nama_paket-input'),
				]);

			$this->log_aktivitas('Update', 303);

		}else{
			DB::table('bkt_01030211_lelang')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_korkot' => $request->input('select-kode_korkot-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kmw' => $request->input('select-kode_kmw-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_faskel' => $request->input('select-kode_faskel-input'),
				'kode_pkt_krj' => $request->input('select-kode_pkt_krj-input'),
				'tgl_lelang_mulai' => $this->date_conversion($request->input('tgl_lelang_mulai-input')),
				'tgl_lelang_selesai' => $this->date_conversion($request->input('tgl_lelang_selesai-input')),
				'nomor_kontrak' => $request->input('nomor_kontrak-input'),
				'sd_apbn_nsup' => $request->input('sd_apbn_nsup-input'),
				'sd_apbn_lain' => $request->input('sd_apbn_lain-input'),
				'sd_apbd_prop' => $request->input('sd_apbd_prop-input'),
				'sd_apbd_kota' => $request->input('sd_apbd_kota-input'),
				'sd_swasta' => $request->input('sd_swasta-input'),
				'keterangan' => $request->input('keterangan-input'),
				'uri_img_document' => $request->input('uri_img_document-input'),
				'uri_img_absensi' => $request->input('uri_img_absensi-input'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id,
				'nama_paket' => $request->input('nama_paket-input')
       			]);

			$this->log_aktivitas('Create', 302);
		}
	}

	public function peserta_create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode_lelang']=$request->input('kode_lelang');
			if($data['kode_lelang']!=null  && !empty($data['detil']['384'])){
				$rowData=DB::select('select kode_peserta from bkt_01030212_pst_lelang where kode_lelang='.$request->input('kode_lelang'));
				$where='';
				$count=0;
				foreach ($rowData as $value) {
					$count++;
					if($count==1){
						$where.=' kode !='.$value->kode_kontraktor;
					}else{
						$where.=' and kode !='.$value->kode_kontraktor;
					}
				}
				$data['where'] = $where; 
				return view('MAIN/bk010314/peserta',$data);
			}
		}
	}

	public function create_peserta(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==100)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode_lelang']=$request->input('kode_lelang');
			if($data['kode_lelang']!=null  && !empty($data['detil']['384'])){
				$rowData=DB::select('select kode_kontraktor from bkt_01030212_pst_lelang where kode_lelang='.$request->input('kode_lelang'));
				$where='';
				$count=0;
				foreach ($rowData as $value) {
					$count++;
					if($count==1){
						$where.=' kode !='.$value->kode_kontraktor;
					}else{
						$where.=' and kode !='.$value->kode_kontraktor;
					}
				}
				$data['where'] = $where; 
				return view('MAIN/bk010314/peserta',$data);
			}
		}
	}

	public function post_peserta_create (Request $request)
	{
		if($request->input('kode_lelang')!=null){
			$checked = $request->input('check');

			DB::beginTransaction();
			foreach ($checked as $value) {
				DB::table('bkt_01030212_pst_lelang')->insert([
					'kode_lelang' => $request->input('kode_lelang'),
					'kode_kontraktor' => $value
				]);
			}
			DB::commit();

			$total_pemanfaat_p=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="P" and a.kode_real_keg='.$request->input('kode_real_keg'));
			$total_pemanfaat_w=DB::select('select count(a.kode) as cnt from bkt_01040206_real_keg_pmft a, bkt_01010131_pemanfaat b where a.kode_pemanfaat=b.kode and b.kode_jenis_kelamin="W" and a.kode_real_keg='.$request->input('kode_real_keg'));

			DB::table('bkt_01030211_lelang')->where('kode', $request->input('kode_lelang'))
			->update([
				'tpm_q_jiwa' => $total_pemanfaat_p[0]->cnt,
				'tpm_q_jiwa_w' => $total_pemanfaat_w[0]->cnt,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);
		}
	}

	public function delete_peserta(Request $request)
	{
		DB::table('bkt_01030212_pst_lelang')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete Peserta', 304);
        return Redirect::to('/main/perencanaan/pengadaan_lelang/peserta/delete');
    }

	public function delete(Request $request)
	{
		DB::table('bkt_01030211_lelang')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 304);
        return Redirect::to('/main/perencanaan/pengadaan_lelang');
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
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 100,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }

    

}
