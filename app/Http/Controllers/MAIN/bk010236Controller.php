<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010236Controller extends Controller
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
				if($item->kode_menu==192)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 595);
				return view('MAIN/bk010236/index',$data);
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
		if(!empty($request->input('prop'))){
			$kmw = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010110_kmw b where b.kode_prop=a.kode and b.kode_prop='.$request->input('prop'));
			echo json_encode($kmw);
		}
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
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama_kegiatan_sos',
			2 =>'tgl_kegiatan_sos',
			3 =>'lok_kegiatan_sos',
			4 =>'peserta',
			5 =>'narasumber',
			6 =>'materi',
			7 =>'media',
			8 =>'hasil_kesepakatan',
			9 =>'sumber_pembiayaan'
		);
		$query='
			select * from (select
				a.*,
				a.kode kode_sos,
				a.nama_kegiatan nama_kegiatan_sos,
				a.tgl_kegiatan tgl_kegiatan_sos,
				a.lok_kegiatan lok_kegiatan_sos,
				a.materi_narsum materi_narsum_sos,
				a.hasil_kesepakatan hasil_kesepakatan_sos,
				case when a.sumber_pembiayaan="1" then "APBN" when a.sumber_pembiayaan="2" then "APBD" when a.sumber_pembiayaan="3" then "CSR" end sumber_pembiayaan_sos,
				a.media media_sos,
				b.nama nama_prop,
				c.nama nama_kota,
				d.nama nama_kec,
				e.nama nama_kel,
				f.nama nama_korkot,
				g.nama nama_faskel,
				h.nama nama_kmw
			from bkt_01020216_sosialisasi a
			 	left join bkt_01010101_prop b on a.kode_prop = b.kode
			 	left join bkt_01010102_kota c on a.kode_kota = c.kode
			 	left join bkt_01010103_kec d on a.kode_kec = d.kode
			 	left join bkt_01010104_kel e on a.kode_kel = e.kode
			 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
			 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
			 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode
			where
			a.skala_kegiatan=2) b';
		$totalData = DB::select('select count(1) cnt from bkt_01020216_sosialisasi a
			 	left join bkt_01010101_prop b on a.kode_prop = b.kode
			 	left join bkt_01010102_kota c on a.kode_kota = c.kode
			 	left join bkt_01010103_kec d on a.kode_kec = d.kode
			 	left join bkt_01010104_kel e on a.kode_kel = e.kode
			 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
			 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
			 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode
			where
			a.skala_kegiatan=2');
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
				b.kode_sos like "%'.$search.'%" or
				b.nama_kegiatan_sos like "%'.$search.'%" or
				b.lok_kegiatan_sos like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_sos like "%'.$search.'%" or
				b.nama_kegiatan_sos like "%'.$search.'%" or
				b.lok_kegiatan_sos like "%'.$search.'%")) a');
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
				$url_show="/main/persiapan/propinsi/sosialisasi/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/propinsi/sosialisasi/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/propinsi/sosialisasi/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_sos;
				$nestedData['tgl_kegiatan_sos'] = $post->tgl_kegiatan_sos;
				$nestedData['nama_kegiatan_sos'] = $post->nama_kegiatan_sos;
				$unsur_peserta = '';
				$count=0;
				$unsur = DB::select('
					select 
						b.nama, 
						a.jml_peserta 
					from bkt_01020217_pst_sos a 
						left join bkt_01010130_unsur b on b.id=a.kode_unsur
					where
						a.kode_sosialisasi='.$post->kode_sos);
				$jml_peserta_sum = DB::select('
					select  
						sum(a.jml_peserta) sum
					from bkt_01020217_pst_sos a 
						left join bkt_01010130_unsur b on b.id=a.kode_unsur
					where
						a.kode_sosialisasi='.$post->kode_sos);
				foreach($unsur as $value){
					$count++;
					if($count==1){
						$unsur_peserta.='Kegiatan ini diikuti oleh '.$value->jml_peserta.' '.$value->nama;
					}else{
						$unsur_peserta.=', '.$value->jml_peserta.' '.$value->nama;
					}

					if($count==count($unsur)){
						$unsur_peserta.=' sehingga total peserta '.$jml_peserta_sum[0]->sum.' orang.';
					}
				}
				$nestedData['peserta'] = $unsur_peserta;

				$unsur_narsum = '';
				$materi_narsum = '';
				$count=0;
				$narsum = DB::select('
					select 
						b.nama, 
						a.nama_narsum,
						a.materi_narsum 
					from bkt_01020218_narsum_sos a 
						left join bkt_01010130_unsur b on b.id=a.kode_unsur
					where
						a.kode_sosialisasi='.$post->kode_sos);
				foreach($narsum as $value){
					$count++;
					if($count==1){
						$unsur_narsum.=$value->nama_narsum.', '.$value->nama;
						$materi_narsum.=$value->materi_narsum;
					}else{
						$unsur_narsum.='; '.$value->nama_narsum.', '.$value->nama;
						$materi_narsum.='; '.$value->materi_narsum;
					}
				}
				$nestedData['narasumber'] = $unsur_narsum;
				$nestedData['materi'] = $materi_narsum;
				$nestedData['media'] = $post->media_sos;
				$nestedData['hasil_kesepakatan'] = $post->hasil_kesepakatan_sos;
				$nestedData['sumber_pembiayaan'] = $post->sumber_pembiayaan_sos;
				$nestedData['lok_kegiatan_sos'] = $post->lok_kegiatan_sos;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==192)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['595'])){
					$option .= "<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['597'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['598'])){
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

	public function Post_unsur(Request $request)
	{
		if($request->input('kode')!=null && $request->input('detil_menu')!=null){
			$columns = array(
				0 =>'kode',
				1 =>'nama_unsur',
				2 =>'jml_peserta'
			);
			$query= '
				select * from (select
					a.*,
					a.kode_sosialisasi kode_sos,
					a.kode kode_peserta_sos,
					a.jml_peserta jml_peserta_sos,
					c.nama nama_unsur
				from bkt_01020217_pst_sos a
					left join bkt_01020216_sosialisasi b on a.kode_sosialisasi=b.kode
					left join bkt_01010130_unsur c on a.kode_unsur=c.id
				where
					a.kode_sosialisasi='.$request->input('kode').') b';
			$totalData = DB::select('select count(1) cnt from bkt_01020217_pst_sos a
					left join bkt_01020216_sosialisasi b on a.kode_sosialisasi=b.kode
					left join bkt_01010130_unsur c on a.kode_unsur=c.id
				where
					a.kode_sosialisasi='.$request->input('kode'));
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
					b.nama_unsur like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
				$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.nama_unsur like "%'.$search.'%")) a');
				$totalFiltered = $totalFiltered[0]->cnt;
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$show =  $post->kode_peserta_sos;
					$edit =  $post->kode_peserta_sos;
					$delete = $post->kode_peserta_sos;
					$url_delete=url('/')."/main/persiapan/propinsi/sosialisasi/unsur/delete?kode=".$delete."&kode_sosialisasi=".$post->kode_sos;
					$nestedData['kode'] = $post->kode_peserta_sos;
					$nestedData['nama_unsur'] = $post->nama_unsur;
					$nestedData['jml_peserta'] = $post->jml_peserta_sos;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==192)
								$detil[$item->kode_menu_detil]='a';
						}
					}

					$option = '';
					if(!empty($detil['597']) && $request->input('detil_menu') == '597'){
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
	}

	public function Post_narsum(Request $request)
	{
		if($request->input('kode')!=null && $request->input('detil_menu')!=null){
			$columns = array(
				0 =>'kode',
				1 =>'nama_unsur',
				2 =>'nama_narsum',
				3 =>'materi_narsum'
			);
			$query= '
				select * from (select
					a.*,
					a.kode_sosialisasi kode_sos,
					a.kode kode_narsum_sos,
					a.nama_narsum nama_narsum_sos,
					a.materi_narsum materi_narsum_sos,
					c.nama nama_unsur
				from bkt_01020218_narsum_sos a
					left join bkt_01020216_sosialisasi b on a.kode_sosialisasi=b.kode
					left join bkt_01010130_unsur c on a.kode_unsur=c.id
				where
					a.kode_sosialisasi='.$request->input('kode').') b';
			$totalData = DB::select('select count(1) cnt from bkt_01020218_narsum_sos a
					left join bkt_01020216_sosialisasi b on a.kode_sosialisasi=b.kode
					left join bkt_01010130_unsur c on a.kode_unsur=c.id
				where
					a.kode_sosialisasi='.$request->input('kode'));
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
					b.nama_unsur like "%'.$search.'%" or
					b.nama_narsum_sos like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
				$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
					b.nama_unsur like "%'.$search.'%" or
					b.nama_narsum_sos like "%'.$search.'%")) a');
				$totalFiltered = $totalFiltered[0]->cnt;
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					$show =  $post->kode_narsum_sos;
					$edit =  $post->kode_narsum_sos;
					$delete = $post->kode_narsum_sos;
					// $url_edit=url('/')."/main/persiapan/kota/kegiatan/sosialisasi/unsur/create?kode=".$edit;
					$url_delete=url('/')."/main/persiapan/propinsi/sosialisasi/narsum/delete?kode=".$delete."&kode_sosialisasi=".$post->kode_sos;
					$nestedData['kode'] = $post->kode_narsum_sos;
					$nestedData['nama_unsur'] = $post->nama_unsur;
					$nestedData['nama_narsum'] = $post->nama_narsum_sos;
					$nestedData['materi_narsum'] = $post->materi_narsum_sos;

					$user = Auth::user();
			        $akses= $user->menu()->where('kode_apps', 1)->get();
					if(count($akses) > 0){
						foreach ($akses as $item) {
							if($item->kode_menu==192)
								$detil[$item->kode_menu_detil]='a';
						}
					}

					$option = '';
					if(!empty($detil['597']) && $request->input('detil_menu') == '597'){
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
	}

	public function show(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==192)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['595'])){
				$data['detil_menu']='595';
				$rowData = DB::select('
					select
						a.*,
						a.kode kode_sos,
						a.nama_kegiatan nama_kegiatan_sos,
						a.tgl_kegiatan tgl_kegiatan_sos,
						a.lok_kegiatan lok_kegiatan_sos,
						a.materi_narsum materi_narsum_sos,
						b.nama nama_prop,
						c.nama nama_kota,
						d.nama nama_kec,
						e.nama nama_kel,
						f.nama nama_korkot,
						g.nama nama_faskel,
						h.nama nama_kmw,
						k.nama nama_unsur,
						i.nama_narsum nama_narsum_sos,
						i.kode_unsur kode_unsur_narsum_sos,
						j.kode_unsur kode_unsur_pst_sos,
						j.jml_peserta jml_peserta_sos
					from bkt_01020216_sosialisasi a
					 	left join bkt_01010101_prop b on a.kode_prop = b.kode
					 	left join bkt_01010102_kota c on a.kode_kota = c.kode
					 	left join bkt_01010103_kec d on a.kode_kec = d.kode
					 	left join bkt_01010104_kel e on a.kode_kel = e.kode
					 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
					 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode
					 	left join bkt_01020218_narsum_sos i on i.kode_sosialisasi = a.kode
					 	left join bkt_01020217_pst_sos j on j.kode_sosialisasi = a.kode
					 	left join bkt_01010130_unsur k on (i.kode_unsur = k.id or j.kode_unsur = k.id)
					where
					a.kode='.$data['kode']);
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['nama_kegiatan'] = $rowData[0]->nama_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['materi_narsum'] = $rowData[0]->materi_narsum;
				$data['media'] = $rowData[0]->media;
				$data['hasil_kesepakatan'] = $rowData[0]->hasil_kesepakatan;
				$data['sumber_pembiayaan'] = $rowData[0]->sumber_pembiayaan;
				$data['nama_narsum'] = $rowData[0]->nama_narsum_sos;
				$data['kode_unsur'] = $rowData[0]->kode_unsur_narsum_sos==$rowData[0]->kode_unsur_pst_sos?$rowData[0]->kode_unsur_narsum_sos:null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				$rowData2=DB::select('select kode_unsur from bkt_01020217_pst_sos where kode_sosialisasi='.$request->input('kode'));
				$where='';
				$count=0;
				foreach ($rowData2 as $value) {
					$count++;
					if($count==1){
						$where.=' id !='.$value->kode_unsur;
					}else{
						$where.=' and id !='.$value->kode_unsur;
					}
				}
				if($where!=null){
					$data['kode_unsur_list']=DB::select('select * from bkt_01010130_unsur where '.$where.' and status=1');
				}else{
					$data['kode_unsur_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				}
				$data['kode_unsur_n_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010236/create',$data);
			}
		}else{
			return Redirect::to('/');
		}

	}

	public function create(Request $request)
	{
		$user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==192)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['597'])){
				$data['detil_menu']='597';
				$rowData = DB::select('
					select
						a.*,
						a.kode kode_sos,
						a.nama_kegiatan nama_kegiatan_sos,
						a.tgl_kegiatan tgl_kegiatan_sos,
						a.lok_kegiatan lok_kegiatan_sos,
						a.materi_narsum materi_narsum_sos,
						b.nama nama_prop,
						c.nama nama_kota,
						d.nama nama_kec,
						e.nama nama_kel,
						f.nama nama_korkot,
						g.nama nama_faskel,
						h.nama nama_kmw,
						k.nama nama_unsur,
						i.nama_narsum nama_narsum_sos,
						i.kode_unsur kode_unsur_narsum_sos,
						j.kode_unsur kode_unsur_pst_sos,
						j.jml_peserta jml_peserta_sos
					from bkt_01020216_sosialisasi a
					 	left join bkt_01010101_prop b on a.kode_prop = b.kode
					 	left join bkt_01010102_kota c on a.kode_kota = c.kode
					 	left join bkt_01010103_kec d on a.kode_kec = d.kode
					 	left join bkt_01010104_kel e on a.kode_kel = e.kode
					 	left join bkt_01010111_korkot f on a.kode_korkot = f.kode
					 	left join bkt_01010113_faskel g on a.kode_faskel = g.kode
					 	left join bkt_01010110_kmw h on a.kode_faskel = h.kode
					 	left join bkt_01020218_narsum_sos i on i.kode_sosialisasi = a.kode
					 	left join bkt_01020217_pst_sos j on j.kode_sosialisasi = a.kode
					 	left join bkt_01010130_unsur k on (i.kode_unsur = k.id or j.kode_unsur = k.id)
					where
					a.kode='.$data['kode']);
				$data['kode_prop'] = $rowData[0]->kode_prop;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['skala_kegiatan'] = $rowData[0]->skala_kegiatan;
				$data['nama_kegiatan'] = $rowData[0]->nama_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['materi_narsum'] = $rowData[0]->materi_narsum;
				$data['media'] = $rowData[0]->media;
				$data['hasil_kesepakatan'] = $rowData[0]->hasil_kesepakatan;
				$data['sumber_pembiayaan'] = $rowData[0]->sumber_pembiayaan;
				$data['nama_narsum'] = $rowData[0]->nama_narsum_sos;
				// $data['jml_peserta'] = $rowData[0]->jml_peserta_sos;
				$data['kode_unsur'] = $rowData[0]->kode_unsur_narsum_sos==$rowData[0]->kode_unsur_pst_sos?$rowData[0]->kode_unsur_narsum_sos:null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				if(!empty($rowData[0]->kode_kota))
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_prop))
					$data['kode_kmw_list']=DB::select('select a.kode, a.nama from bkt_01010101_prop b, bkt_01010110_kmw a where a.kode_prop=b.kode and a.kode_prop='.$rowData[0]->kode_prop);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);

				$rowData2=DB::select('select kode_unsur from bkt_01020217_pst_sos where kode_sosialisasi='.$request->input('kode'));
				$where='';
				$count=0;
				foreach ($rowData2 as $value) {
					$count++;
					if($count==1){
						$where.=' id !='.$value->kode_unsur;
					}else{
						$where.=' and id !='.$value->kode_unsur;
					}
				}
				if($where!=null){
					$data['kode_unsur_list']=DB::select('select * from bkt_01010130_unsur where '.$where.' and status=1');
				}else{
					$data['kode_unsur_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				}

				$data['kode_unsur_n_list'] =DB::select('select * from bkt_01010130_unsur where status=1');

				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010236/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['596'])){
				$data['detil_menu']='596';
				$data['kode_prop'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['skala_kegiatan'] = 2;
				$data['nama_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['materi_narsum'] = null;
				$data['media'] = null;
				$data['hasil_kesepakatan'] = null;
				$data['sumber_pembiayaan'] = null;
				$data['nama_narsum'] = null;
				$data['jml_peserta'] = null;
				$data['kode_unsur'] = null;
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
				$data['kode_prop_list'] = DB::select('select * from bkt_01010101_prop where status=1');
				//level propinsi
				if($user->kode_level==2 || $user->kode_level==0){
					if($user->kode_faskel!=null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select distinct b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_faskel='.$user->kode_faskel);
					}else if($user->kode_faskel==null && $user->kode_korkot!=null){
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010102_kota b where b.kode=a.kode_kota and a.kode_korkot='.$user->kode_korkot);
					}else{
						$data['kode_kota_list'] = DB::select('select b.kode, b.nama from bkt_01010101_prop a, bkt_01010102_kota b where b.kode_prop=a.kode and a.kode='.$user->wk_kd_prop);
					}
					
					//level kota
				}else if($user->kode_level==3){
					$data['kode_kota_list'] = DB::select('select kode, nama from bkt_01010102_kota where kode='.$user->wk_kd_kota);
				}
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = null;
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_unsur_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				$data['kode_unsur_n_list'] =DB::select('select * from bkt_01010130_unsur where status=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010236/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}

	}

	public function post_unsur_create(Request $request)
	{
		if($request->input('kode')!=null){
			DB::table('bkt_01020217_pst_sos')->insert([
				'kode_sosialisasi' => $request->input('kode'),
				'kode_unsur' => $request->input('kode-unsur-input'),
				'jml_peserta' => $request->input('jml_peserta')
       			]);

			$this->log_aktivitas('Update Peserta/Unsur', 597);
			return Redirect::to('/main/persiapan/propinsi/sosialisasi/create?kode='.$request->input('kode'));
		}
	}

	public function post_narsum_create(Request $request)
	{
		if($request->input('kode')!=null){
			DB::table('bkt_01020218_narsum_sos')->insert([
				'kode_sosialisasi' => $request->input('kode'),
				'kode_unsur' => $request->input('kode-unsur-n-input'),
				'nama_narsum' => $request->input('nama_narsum'),
				'materi_narsum' => $request->input('materi_narsum')
       			]);

			$this->log_aktivitas('Update Narasumber/Unsur', 597);
			return Redirect::to('/main/persiapan/propinsi/sosialisasi/create?kode='.$request->input('kode'));
		}
	}

	public function post_create(Request $request)
	{
    	$user = Auth::user();
		$file_document = $request->file('uri_img_document-input');
		$uri_document = null;
		$upload_document = false;
		if($request->input('uri_img_document-file') != null && $file_document == null){
			$uri_document = $request->input('uri_img_document-file');
			$upload_document = false;
		}elseif($request->input('uri_img_document-file') != null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}elseif($request->input('uri_img_document-file') == null && $file_document != null){
			$uri_document = $file_document->getClientOriginalName();
			$upload_document = true;
		}

		$file_absensi = $request->file('uri_img_absensi-input');
		$uri_absensi = null;
		$upload_absensi = false;
		if($request->input('uri_img_absensi-file') != null && $file_absensi == null){
			$uri_absensi = $request->input('uri_img_absensi-file');
			$upload_absensi = false;
		}elseif($request->input('uri_img_absensi-file') != null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}elseif($request->input('uri_img_absensi-file') == null && $file_absensi != null){
			$uri_absensi = $file_absensi->getClientOriginalName();
			$upload_absensi = true;
		}

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020216_sosialisasi')->where('kode', $request->input('kode'))
			->update([
				'kode_prop' => $user->wk_kd_prop,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $user->kode_kmw,
				'kode_korkot' => $user->kode_korkot,
				'kode_faskel' => $request->input('kode-faskel-input'),
				'skala_kegiatan' => 2,
				'nama_kegiatan' => $request->input('nama_kegiatan'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'materi_narsum' => $request->input('materi_narsum'),
				'media' => $request->input('media'),
				'hasil_kesepakatan' => $request->input('hasil_kesepakatan'),
				'sumber_pembiayaan' => $request->input('sumber_pembiayaan'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kota/kegiatan/sosialisasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/kegiatan/sosialisasi'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 597);

		}else{
			$lastInsertId=DB::table('bkt_01020216_sosialisasi')->insertGetId([
				'kode_prop' => $user->wk_kd_prop,
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
        		'kode_kmw' => $user->kode_kmw,
				'kode_korkot' => $user->kode_korkot,
				'kode_faskel' => $request->input('kode-faskel-input'),
				'skala_kegiatan' => 2,
				'nama_kegiatan' => $request->input('nama_kegiatan'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'materi_narsum' => $request->input('materi_narsum'),
				'media' => $request->input('media'),
				'hasil_kesepakatan' => $request->input('hasil_kesepakatan'),
				'sumber_pembiayaan' => $request->input('sumber_pembiayaan'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kota/kegiatan/sosialisasi'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/kegiatan/sosialisasi'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 596);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020218_narsum_sos')->where('kode_sosialisasi', $request->input('kode'))->delete();
		DB::table('bkt_01020217_pst_sos')->where('kode_sosialisasi', $request->input('kode'))->delete();
		DB::table('bkt_01020216_sosialisasi')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 598);
        return Redirect::to('/main/persiapan/propinsi/sosialisasi');
    }

    public function unsur_delete(Request $request)
	{
		DB::table('bkt_01020217_pst_sos')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Update Peserta/Unsur', 597);
        return Redirect::to('/main/persiapan/propinsi/sosialisasi/create?kode='.$request->input('kode_sosialisasi'));
    }

    public function narsum_delete(Request $request)
	{
		DB::table('bkt_01020218_narsum_sos')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Update Narasumber/Unsur', 597);
        return Redirect::to('/main/persiapan/propinsi/sosialisasi/create?kode='.$request->input('kode_sosialisasi'));
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 192,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
