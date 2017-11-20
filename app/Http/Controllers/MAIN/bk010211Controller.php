<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010211Controller extends Controller
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
				$data['menu'][$item->kode_menu] = 'a';
				if($item->kode_menu==56)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 116);
				return view('MAIN/bk010211/index',$data);
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
			1 =>'jns_forum_convert',
			2 =>'nama_kota',
			3 =>'kode_kegiatan_convert',
			4 =>'tgl_kegiatan',
			5 =>'lok_kegiatan',
			6 =>'q_peserta_p',
			7 =>'q_peserta_w',
			8 =>'q_peserta_pemda',
			9 =>'total'
		);
		$query='
			select * from (select
				a.*,
				a.kode kode_f,
				case when a.jns_forum=1 then "Forum BKM/LKM Tk Kota" when a.jns_forum=2 then "Forum Kolaborasi Tk Kota" end jns_forum_convert,
				case when a.kode_kegiatan=0 then "Rapat Internal" when a.kode_kegiatan=1 then "Rapat Dengan Pemda" end kode_kegiatan_convert,
				case when a.tgl_kegiatan is null then "-" else a.tgl_kegiatan end tgl_kegiatan_f,
				case when a.lok_kegiatan is null then "-" else a.lok_kegiatan end lok_kegiatan_f,
				b.tahun tahun_bkm,
				c.tahun tahun_kolab,
				d.nama nama_kota,
				e.nama nama_korkot,
				f.nama nama_kec,
				g.nama nama_kmw,
				(a.q_peserta_p+a.q_peserta_w)total
			from bkt_01020209_f_forum_kota a
				left join bkt_01020207_bkm_kota b on a.kode_bkm = b.kode
				left join bkt_01020208_kolab_kota c on a.kode_kolab = c.kode
				left join bkt_01010102_kota d on (b.kode_kota = d.kode or c.kode_kota = d.kode)
				left join bkt_01010111_korkot e on (b.kode_korkot = e.kode or c.kode_korkot = e.kode)
				left join bkt_01010103_kec f on (b.kode_kec = f.kode or c.kode_kec = f.kode)
				left join bkt_01010110_kmw g on (b.kode_kmw = g.kode or c.kode_kmw = g.kode)
			where
				b.tk_forum = 1 or c.tk_forum = 1) b';
		$totalData = DB::select('select count(1) cnt from bkt_01020209_f_forum_kota a
				left join bkt_01020207_bkm_kota b on a.kode_bkm = b.kode
				left join bkt_01020208_kolab_kota c on a.kode_kolab = c.kode
				left join bkt_01010102_kota d on (b.kode_kota = d.kode or c.kode_kota = d.kode)
				left join bkt_01010111_korkot e on (b.kode_korkot = e.kode or c.kode_korkot = e.kode)
				left join bkt_01010103_kec f on (b.kode_kec = f.kode or c.kode_kec = f.kode)
				left join bkt_01010110_kmw g on (b.kode_kmw = g.kode or c.kode_kmw = g.kode)
			where
				b.tk_forum = 1 or c.tk_forum = 1');
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
				b.jns_forum_convert like "%'.$search.'%" or
				b.nama_kota like "%'.$search.'%" or
				b.kode_kegiatan_convert like "%'.$search.'%" or
				b.tgl_kegiatan_f like "%'.$search.'%" or
				b.lok_kegiatan_f like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.jns_forum_convert like "%'.$search.'%" or
				b.nama_kota like "%'.$search.'%" or
				b.kode_kegiatan_convert like "%'.$search.'%" or
				b.tgl_kegiatan_f like "%'.$search.'%" or
				b.lok_kegiatan_f like "%'.$search.'%")) a');
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
				$url_show="/main/persiapan/kota/forum/f_forum/show?kode=".$edit;
				$url_edit="/main/persiapan/kota/forum/f_forum/create?kode=".$edit;
				$url_delete="/main/persiapan/kota/forum/f_forum/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['nama_kota'] = $post->nama_kota;
				$nestedData['jns_forum_convert'] = $post->jns_forum_convert;
				$nestedData['kode_kegiatan_convert'] = $post->kode_kegiatan_convert;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan_f;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan_f;
				$nestedData['q_peserta_p'] = $post->q_peserta_p;
				$nestedData['q_peserta_w'] = $post->q_peserta_w;
				$nestedData['q_peserta_pemda'] = $post->q_peserta_pemda;
				$nestedData['total'] = $post->total;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==56)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['116'])){
					$option .= "<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['161'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['162'])){
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

	public function show(Request $request)
	{
		$user = Auth::user();
		$akses= $user->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==56)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['116'])){
				$data['detil_menu']='116';
				$rowData = DB::select('select * from bkt_01020209_f_forum_kota where kode='.$data['kode']);
				$data['jns_forum'] = $rowData[0]->jns_forum;
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['kode_kolab'] = $rowData[0]->kode_kolab;
				$data['kode_kegiatan'] = $rowData[0]->kode_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_pemda'] = $rowData[0]->q_peserta_pemda;
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
				$data['kode_bkm_list'] = DB::select('
					select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020207_bkm_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_kolab_list'] = DB::select('select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020208_kolab_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010211/create',$data);
			}else{
				return Redirect::to('/');
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
				if($item->kode_menu==56)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['161'])){
				$data['detil_menu']='161';
				$rowData = DB::select('select * from bkt_01020209_f_forum_kota where kode='.$data['kode']);
				$data['jns_forum'] = $rowData[0]->jns_forum;
				$data['kode_bkm'] = $rowData[0]->kode_bkm;
				$data['kode_kolab'] = $rowData[0]->kode_kolab;
				$data['kode_kegiatan'] = $rowData[0]->kode_kegiatan;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['q_peserta_p'] = $rowData[0]->q_peserta_p;
				$data['q_peserta_w'] = $rowData[0]->q_peserta_w;
				$data['q_peserta_pemda'] = $rowData[0]->q_peserta_pemda;
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
				$data['kode_bkm_list'] = DB::select('
					select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020207_bkm_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_kolab_list'] = DB::select('select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020208_kolab_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010211/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['160'])){
				$data['detil_menu']='160';
				$data['jns_forum'] = null;
				$data['kode_bkm'] = null;
				$data['kode_kolab'] = null;
				$data['kode_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_peserta_pemda'] = null;
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
				$data['kode_bkm_list'] = DB::select('
					select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020207_bkm_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_kolab_list'] = DB::select('select
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020208_kolab_kota a
						left join bkt_01010102_kota b on a.kode_kota=b.kode
						left join bkt_01010103_kec c on a.kode_kec=c.kode
					where tk_forum=1');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010211/create',$data);
			}else{
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
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
			DB::table('bkt_01020209_f_forum_kota')->where('kode', $request->input('kode'))
			->update([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input')=='null'?null:$request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input')=='null'?null:$request->input('kode-kolab-input'),
				'kode_kegiatan' => $request->input('kode-keg-input'),
				'tgl_kegiatan' => $request->input('tgl-kegiatan-input')==null?null:$this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kota/forum/keberfungsian'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/forum/keberfungsian'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Update', 161);

		}else{
			DB::table('bkt_01020209_f_forum_kota')->insert([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input')=='null'?null:$request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input')=='null'?null:$request->input('kode-kolab-input'),
				'kode_kegiatan' => $request->input('kode-keg-input'),
				'tgl_kegiatan' => $request->input('tgl-kegiatan-input')==null?null:$this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'uri_img_document' => $uri_document,
				'uri_img_absensi' => $uri_absensi,
				'created_by' => Auth::user()->id
       			]);

			if($upload_document == true){
				$file_document->move(public_path('/uploads/persiapan/kota/forum/keberfungsian'), $file_document->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kota/forum/keberfungsian'), $file_absensi->getClientOriginalName());
			}
			$this->log_aktivitas('Create', 160);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020209_f_forum_kota')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 162);
        return Redirect::to('/main/persiapan/kota/forum/f_forum');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5,
				'kode_menu' => 56,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
