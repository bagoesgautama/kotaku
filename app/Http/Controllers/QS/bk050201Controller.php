<?php

namespace App\Http\Controllers\QS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk050201Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				//$this->log_aktivitas('View', 491);
				$data['agenda'] = DB::select('select kode_slum_prog,nama from bkt_05010101_agenda where status =1');
				return view('QS/bk050201/prov',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function post_prov(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama'
		);

		$query='select kode,nama from bkt_01010101_prop where status=1';
		$totalData = DB::select('select count(1) cnt from bkt_01010101_prop a where a.status =1');
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
			$posts=DB::select($query. ' and nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$url_kota="/qs/monitoring/kelurahan/kota?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_peningkatan="/qs/monitoring/kelurahan/prov/peningkatan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_pencegahan="/qs/monitoring/kelurahan/prov/pencegahan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_ppmk="/qs/monitoring/kelurahan/prov/ppmk?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_bdi="/qs/monitoring/kelurahan/prov/bdi?kode=".$post->kode."&agenda=".$request->input('agenda');
				$nestedData['kode'] = $post->kode;
				$nestedData['nama'] = "<a href='{$url_kota}' title='VIEW/EDIT' >{$post->nama}</a>";
				$nestedData['peningkatan'] = "<a href='{$url_peningkatan}' title='VIEW/EDIT' >Peningkatan</a>";
				$nestedData['pencegahan'] = "<a href='{$url_pencegahan}' title='VIEW/EDIT' >Pencegahan</a>";
				$nestedData['ppmk'] = "<a href='{$url_ppmk}' title='VIEW/EDIT' >PPMK</a>";
				$nestedData['bdi'] = "<a href='{$url_bdi}' title='VIEW/EDIT' >BDI</a>";
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==153)
							$detil[$item->kode_menu_detil]='a';
					}
				}
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

	public function kota(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$data['kota'] = DB::select('select nama from bkt_01010101_prop where kode='.$data['kode']);
				$data['kota']=$data['kota'][0]->nama;
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/kota',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function post_kota(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama'
		);

		$query='select kode,nama from bkt_01010102_kota where status=1 and kode_prop='.$request->input('kode');
		$totalData = DB::select('select count(1) cnt from bkt_01010102_kota a where a.status =1 and kode_prop='.$request->input('kode'));
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
			$posts=DB::select($query. ' and nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$url_kota="/qs/monitoring/kelurahan/kelurahan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_peningkatan="/qs/monitoring/kelurahan/kota/peningkatan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_pencegahan="/qs/monitoring/kelurahan/kota/pencegahan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_ppmk="/qs/monitoring/kelurahan/kota/ppmk?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_bdi="/qs/monitoring/kelurahan/kota/bdi?kode=".$post->kode."&agenda=".$request->input('agenda');
				$nestedData['kode'] = $post->kode;
				$nestedData['nama'] = "<a href='{$url_kota}' title='VIEW/EDIT' >{$post->nama}</a>";
				$nestedData['peningkatan'] = "<a href='{$url_peningkatan}' title='VIEW/EDIT' >Peningkatan</a>";
				$nestedData['pencegahan'] = "<a href='{$url_pencegahan}' title='VIEW/EDIT' >Pencegahan</a>";
				$nestedData['ppmk'] = "<a href='{$url_ppmk}' title='VIEW/EDIT' >PPMK</a>";
				$nestedData['bdi'] = "<a href='{$url_bdi}' title='VIEW/EDIT' >BDI</a>";
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==153)
							$detil[$item->kode_menu_detil]='a';
					}
				}
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

	public function kelurahan(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['kota'] = DB::select('select nama from bkt_01010102_kota where kode='.$data['kode']);
				$data['kota']=$data['kota'][0]->nama;
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/kelurahan',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function post_kelurahan(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'nama'
		);

		$query='select kode,nama from bkt_01010104_kel where status=1 and kode_kec=(select kode from bkt_01010103_kec where kode_kota='.$request->input('kode').')';
		$totalData = DB::select('select count(1) cnt from bkt_01010104_kel a where a.status =1 and kode_kec=(select kode from bkt_01010103_kec where kode_kota='.$request->input('kode').')');
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
			$posts=DB::select($query. ' and nama like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and nama like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$url_peningkatan="/qs/monitoring/kelurahan/kelurahan/peningkatan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_pencegahan="/qs/monitoring/kelurahan/kelurahan/pencegahan?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_ppmk="/qs/monitoring/kelurahan/kelurahan/ppmk?kode=".$post->kode."&agenda=".$request->input('agenda');
				$url_bdi="/qs/monitoring/kelurahan/kelurahan/bdi?kode=".$post->kode."&agenda=".$request->input('agenda');
				$nestedData['kode'] = $post->kode;
				$nestedData['nama'] = $post->nama;
				$nestedData['peningkatan'] = "<a href='{$url_peningkatan}' title='VIEW/EDIT' >Peningkatan</a>";
				$nestedData['pencegahan'] = "<a href='{$url_pencegahan}' title='VIEW/EDIT' >Pencegahan</a>";
				$nestedData['ppmk'] = "<a href='{$url_ppmk}' title='VIEW/EDIT' >PPMK</a>";
				$nestedData['bdi'] = "<a href='{$url_bdi}' title='VIEW/EDIT' >BDI</a>";
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==153)
							$detil[$item->kode_menu_detil]='a';
					}
				}
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

	public function peningkatan(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$kota = DB::select('select kode,nama from bkt_01010102_kota where kode=(select kode_kota from bkt_01010103_kec where kode=(select kode_kec from bkt_01010104_kel where kode='.$data['kode'].'))');
				$data['kota']=$kota[0]->nama;
				$data['kode_kota']=$kota[0]->kode;
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode_kota'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select m.kode_kel, m.nama_kel,
				       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
				       sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 1 then 1 else 0 end) q0_peningkatan,
				       sum(case when n.status = 1 and m.flag_kumuh = 1 then 1 else 0 end) q1_peningkatan,
				       sum(case when n.status = 2 and m.flag_kumuh = 1 then 1 else 0 end) q2_peningkatan
				  from (
						select a.kode kode_kel, a.nama nama_kel, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
							and a.kode ='.$data['kode'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				  group by m.kode_kel, m.nama_kel,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/peningkatan',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function peningkatan_kota(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select p.kode kode_kota, p.nama nama_kota,
				       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
				       sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 1 then 1 else 0 end) q0_peningkatan,
				       sum(case when n.status = 1 and m.flag_kumuh = 1 then 1 else 0 end) q1_peningkatan,
				       sum(case when n.status = 2 and m.flag_kumuh = 1 then 1 else 0 end) q2_peningkatan
				  from (
						select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				   left join bkt_01010103_kec o on o.kode = m.kode_kec
				   left join bkt_01010102_kota p on p.kode = o.kode_kota
				   where p.kode='.$data['kode'].'
				  group by p.kode, p.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan;');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/peningkatan_kota',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function peningkatan_prov(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$data['data']=DB::select('select q.kode kode_prop, q.nama nama_prop,
			       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
			       sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 1 then 1 else 0 end) q0_peningkatan,
			       sum(case when n.status = 1 and m.flag_kumuh = 1 then 1 else 0 end) q1_peningkatan,
			       sum(case when n.status = 2 and m.flag_kumuh = 1 then 1 else 0 end) q2_peningkatan
			  from (
					select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
					  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
						   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
								   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
							  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
							 where x.id = y.id_agenda
							   and x.kode_slum_prog = '.$data['agenda'].') h
					  where a.kode = b.kode_kel
						and b.kode_kmp_slum_prog = c.kode
						and c.kode_slum_prog = d.kode
						and d.kode = '.$data['agenda'].'
					) m
			   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
			   left join bkt_01010103_kec o on o.kode = m.kode_kec
			   left join bkt_01010102_kota p on p.kode = o.kode_kota
			   left join bkt_01010101_prop q on q.kode = p.kode_prop
			   where q.kode='.$data['kode'].'
			  group by q.kode, q.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/peningkatan_prov',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function pencegahan(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$kota = DB::select('select kode,nama from bkt_01010102_kota where kode=(select kode_kota from bkt_01010103_kec where kode=(select kode_kec from bkt_01010104_kel where kode='.$data['kode'].'))');
				$data['kota']=$kota[0]->nama;
				$data['kode_kota']=$kota[0]->kode;
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode_kota'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select m.kode_kel, m.nama_kel,
				       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 0 then 1 else 0 end) q0_pencegahan,
						sum(case when n.status = 1 and m.flag_kumuh = 0 then 1 else 0 end) q1_pencegahan,
						sum(case when n.status = 2 and m.flag_kumuh = 0 then 1 else 0 end) q2_pencegahan
				  from (
						select a.kode kode_kel, a.nama nama_kel, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
							and a.kode ='.$data['kode'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				  group by m.kode_kel, m.nama_kel,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/pencegahan',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function pencegahan_kota(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select p.kode kode_kota, p.nama nama_kota,
				       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 0 then 1 else 0 end) q0_pencegahan,
						sum(case when n.status = 1 and m.flag_kumuh = 0 then 1 else 0 end) q1_pencegahan,
						sum(case when n.status = 2 and m.flag_kumuh = 0 then 1 else 0 end) q2_pencegahan
				  from (
						select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				   left join bkt_01010103_kec o on o.kode = m.kode_kec
				   left join bkt_01010102_kota p on p.kode = o.kode_kota
				   where p.kode='.$data['kode'].'
				  group by p.kode, p.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan;');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/pencegahan_kota',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function pencegahan_prov(Request $request)
    {
        $user = Auth::user();
        $akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$data['data']=DB::select('select q.kode kode_prop, q.nama nama_prop,
			       m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
				   sum(case when ifnull(n.status,0) = 0 and m.flag_kumuh = 0 then 1 else 0 end) q0_pencegahan,
					sum(case when n.status = 1 and m.flag_kumuh = 0 then 1 else 0 end) q1_pencegahan,
					sum(case when n.status = 2 and m.flag_kumuh = 0 then 1 else 0 end) q2_pencegahan
			  from (
					select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
					  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
						   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
								   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
							  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
							 where x.id = y.id_agenda
							   and x.kode_slum_prog = '.$data['agenda'].') h
					  where a.kode = b.kode_kel
						and b.kode_kmp_slum_prog = c.kode
						and c.kode_slum_prog = d.kode
						and d.kode = '.$data['agenda'].'
					) m
			   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
			   left join bkt_01010103_kec o on o.kode = m.kode_kec
			   left join bkt_01010102_kota p on p.kode = o.kode_kota
			   left join bkt_01010101_prop q on q.kode = p.kode_prop
			   where q.kode='.$data['kode'].'
			  group by q.kode, q.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/pencegahan_prov',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
    }

	public function ppmk(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$kota = DB::select('select kode,nama from bkt_01010102_kota where kode=(select kode_kota from bkt_01010103_kec where kode=(select kode_kec from bkt_01010104_kel where kode='.$data['kode'].'))');
				$data['kota']=$kota[0]->nama;
				$data['kode_kota']=$kota[0]->kode;
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode_kota'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select m.kode_kel, m.nama_kel,
					   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q0_ppmk_baru,
						sum(case when n.status = 1 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q1_ppmk_baru,
						sum(case when n.status = 2 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q2_ppmk_baru
				  from (
						select a.kode kode_kel, a.nama nama_kel, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
							and a.kode ='.$data['kode'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				  group by m.kode_kel, m.nama_kel,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/ppmk',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function ppmk_kota(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select p.kode kode_kota, p.nama nama_kota,
					   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q0_ppmk_baru,
						sum(case when n.status = 1 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q1_ppmk_baru,
						sum(case when n.status = 2 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q2_ppmk_baru
				  from (
						select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				   left join bkt_01010103_kec o on o.kode = m.kode_kec
				   left join bkt_01010102_kota p on p.kode = o.kode_kota
				   where p.kode='.$data['kode'].'
				  group by p.kode, p.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan;');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/ppmk_kota',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function ppmk_prov(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$data['data']=DB::select('select q.kode kode_prop, q.nama nama_prop,
				   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
				   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q0_ppmk_baru,
					sum(case when n.status = 1 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q1_ppmk_baru,
					sum(case when n.status = 2 and m.flag_lokasi_ppmk = 1 then 1 else 0 end) q2_ppmk_baru
			  from (
					select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
					  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
						   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
								   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
							  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
							 where x.id = y.id_agenda
							   and x.kode_slum_prog = '.$data['agenda'].') h
					  where a.kode = b.kode_kel
						and b.kode_kmp_slum_prog = c.kode
						and c.kode_slum_prog = d.kode
						and d.kode = '.$data['agenda'].'
					) m
			   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
			   left join bkt_01010103_kec o on o.kode = m.kode_kec
			   left join bkt_01010102_kota p on p.kode = o.kode_kota
			   left join bkt_01010101_prop q on q.kode = p.kode_prop
			   where q.kode='.$data['kode'].'
			  group by q.kode, q.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/ppmk_prov',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function bdi(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$kota = DB::select('select kode,nama from bkt_01010102_kota where kode=(select kode_kota from bkt_01010103_kec where kode=(select kode_kec from bkt_01010104_kel where kode='.$data['kode'].'))');
				$data['kota']=$kota[0]->nama;
				$data['kode_kota']=$kota[0]->kode;
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode_kota'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select m.kode_kel, m.nama_kel,
					   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q0_bdi_plbk,
				       sum(case when n.status = 1 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q1_bdi_plbk,
				       sum(case when n.status = 2 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q2_bdi_plbk
				  from (
						select a.kode kode_kel, a.nama nama_kel, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
							and a.kode ='.$data['kode'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				  group by m.kode_kel, m.nama_kel,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/bdi',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function bdi_kota(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$prov = DB::select('select nama,kode from bkt_01010101_prop where kode=(select kode_prop from bkt_01010102_kota where kode='.$data['kode'].')');
				$data['prov']=$prov[0]->nama;
				$data['kode_prov']=$prov[0]->kode;
				$data['data']=DB::select('select p.kode kode_kota, p.nama nama_kota,
					   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
					   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q0_bdi_plbk,
				       sum(case when n.status = 1 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q1_bdi_plbk,
				       sum(case when n.status = 2 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q2_bdi_plbk
				  from (
						select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
						  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
							   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
									   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
								  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
								 where x.id = y.id_agenda
								   and x.kode_slum_prog = '.$data['agenda'].') h
						  where a.kode = b.kode_kel
							and b.kode_kmp_slum_prog = c.kode
							and c.kode_slum_prog = d.kode
							and d.kode = '.$data['agenda'].'
						) m
				   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
				   left join bkt_01010103_kec o on o.kode = m.kode_kec
				   left join bkt_01010102_kota p on p.kode = o.kode_kota
				   where p.kode='.$data['kode'].'
				  group by p.kode, p.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan;');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/bdi_kota',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function bdi_prov(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 5)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==153)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
				$data['username'] = $user->name;
				$data['agenda'] = $request->input('agenda');
				$data['kode'] = $request->input('kode');
				$data['data']=DB::select('select q.kode kode_prop, q.nama nama_prop,
				   m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan,
				   sum(case when ifnull(n.status,0) = 0 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q0_bdi_plbk,
				   sum(case when n.status = 1 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q1_bdi_plbk,
				   sum(case when n.status = 2 and m.flag_lokasi_ppmk = 0 then 1 else 0 end) q2_bdi_plbk
			  from (
					select a.kode kode_kel, a.nama nama_kel, a.kode_kec, b.flag_kumuh, b.flag_lokasi_ppmk, h.*
					  from bkt_01010104_kel a, bkt_01010114_kel_faskel b, bkt_01010109_kmp_slum_prog c, bkt_01010107_slum_program d,
						   (select y.id id_keg, y.id_parent, y.kode_keg_kel, y.nama_kegiatan, y.tgl_mulai, y.tgl_selesai, y.kode_glossary,
								   y.flag_lok_peningkatan, y.flag_lok_pencegahan, y.flag_lok_ppmk_baru, y.flag_lok_bdi_plbk
							  from bkt_05010101_agenda x, bkt_05010102_kegiatan_kel y
							 where x.id = y.id_agenda
							   and x.kode_slum_prog = '.$data['agenda'].') h
					  where a.kode = b.kode_kel
						and b.kode_kmp_slum_prog = c.kode
						and c.kode_slum_prog = d.kode
						and d.kode = '.$data['agenda'].'
					) m
			   left join bkt_05020201_mnt_keg_kel n on m.kode_kel = n.kode_kel and m.id_keg = n.id_keg_kel
			   left join bkt_01010103_kec o on o.kode = m.kode_kec
			   left join bkt_01010102_kota p on p.kode = o.kode_kota
			   left join bkt_01010101_prop q on q.kode = p.kode_prop
			   where q.kode='.$data['kode'].'
			  group by q.kode, q.nama,m.id_keg, m.id_parent, m.kode_keg_kel, m.nama_kegiatan');
				//$this->log_aktivitas('View', 491);
				return view('QS/bk050201/bdi_prov',$data);
			}
			else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 5,
			'kode_modul' => 10,
			'kode_menu' => 153,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
