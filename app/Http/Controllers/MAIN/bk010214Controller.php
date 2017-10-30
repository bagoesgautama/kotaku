<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010214Controller extends Controller
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
				if($item->kode_menu==59)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 119);
				return view('MAIN/bk010214/index',$data);
			}
			else {
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
				if($item->kode_menu==59)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null && !empty($data['detil']['173'])){
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
					where tk_forum=2');
				$data['kode_kolab_list'] = DB::select('select 
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020208_kolab_kota a 
						left join bkt_01010102_kota b on a.kode_kota=b.kode 
						left join bkt_01010103_kec c on a.kode_kec=c.kode 
					where tk_forum=2');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010214/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['172'])){
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
					where tk_forum=2');
				$data['kode_kolab_list'] = DB::select('select 
						a.*,
						b.nama nama_kota,
						c.nama nama_kec
					from bkt_01020208_kolab_kota a 
						left join bkt_01010102_kota b on a.kode_kota=b.kode 
						left join bkt_01010103_kec c on a.kode_kec=c.kode 
					where tk_forum=2');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010214/create',$data);
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
			DB::table('bkt_01020209_f_forum_kota')->where('kode', $request->input('kode'))
			->update([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input')=='null'?null:$request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input')=='null'?null:$request->input('kode-kolab-input'),  
				'kode_kegiatan' => $request->input('kode-keg-input'),    
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kecamatan/forum/keberfungsian'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kecamatan/forum/keberfungsian'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Update', 173);

		}else{
			DB::table('bkt_01020209_f_forum_kota')->insert([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input')=='null'?null:$request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input')=='null'?null:$request->input('kode-kolab-input'), 
				'kode_kegiatan' => $request->input('kode-keg-input'),    
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'uri_img_document' => $url_dokumen,
				'uri_img_absensi' => $url_absensi,
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			if($upload_dokumen == true){
				$file_dokumen->move(public_path('/uploads/persiapan/kecamatan/forum/keberfungsian'), $file_dokumen->getClientOriginalName());
			}

			if($upload_absensi == true){
				$file_absensi->move(public_path('/uploads/persiapan/kecamatan/forum/keberfungsian'), $file_absensi->getClientOriginalName());
			}

			$this->log_aktivitas('Create', 172);
		}
	}

	public function Post(Request $request)
	{
		$akses= Auth::user()->menu()->where('kode_apps', 1)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data2['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==59)
					$data2['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data2['detil'])){
				$columns = array(
					0 =>'kode',
					1 =>'jns_forum',
					2 =>'kode_bkm',
					3 =>'kode_kolab',
					4 =>'kode_kegiatan',
					5 =>'tgl_kegiatan',
					6 =>'lok_kegiatan',
					7 =>'created_time'
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
						g.nama nama_kmw
					from bkt_01020209_f_forum_kota a
						left join bkt_01020207_bkm_kota b on a.kode_bkm = b.kode
						left join bkt_01020208_kolab_kota c on a.kode_kolab = c.kode
						left join bkt_01010102_kota d on (b.kode_kota = d.kode or c.kode_kota = d.kode)
						left join bkt_01010111_korkot e on (b.kode_korkot = e.kode or c.kode_korkot = e.kode)
						left join bkt_01010103_kec f on (b.kode_kec = f.kode or c.kode_kec = f.kode)
						left join bkt_01010110_kmw g on (b.kode_kmw = g.kode or c.kode_kmw = g.kode)
					where 
						b.tk_forum = 2 or c.tk_forum = 2) b';
				$totalData = DB::select('select count(1) cnt from bkt_01020209_f_forum_kota a
						left join bkt_01020207_bkm_kota b on a.kode_bkm = b.kode
						left join bkt_01020208_kolab_kota c on a.kode_kolab = c.kode
						left join bkt_01010102_kota d on (b.kode_kota = d.kode or c.kode_kota = d.kode)
						left join bkt_01010111_korkot e on (b.kode_korkot = e.kode or c.kode_korkot = e.kode)
						left join bkt_01010103_kec f on (b.kode_kec = f.kode or c.kode_kec = f.kode)
						left join bkt_01010110_kmw g on (b.kode_kmw = g.kode or c.kode_kmw = g.kode)
					where 
						b.tk_forum = 2 or c.tk_forum = 2');
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
						b.kode_f like "%'.$search.'%" or 
						b.tahun_bkm like "%'.$search.'%" or 
						b.tahun_kolab like "%'.$search.'%" or 
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or 
						b.kode_kegiatan_convert like "%'.$search.'%" or
						b.tgl_kegiatan_f like "%'.$search.'%" or
						b.lok_kegiatan_f like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
					$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
						b.kode_f like "%'.$search.'%" or 
						b.tahun_bkm like "%'.$search.'%" or 
						b.tahun_kolab like "%'.$search.'%" or 
						b.nama_kota like "%'.$search.'%" or
						b.nama_kec like "%'.$search.'%" or 
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

						$url_edit=url('/')."/main/persiapan/kecamatan/keberfungsian/create?kode=".$edit;
						$url_delete=url('/')."/main/persiapan/kecamatan/keberfungsian/delete?kode=".$delete;
						$nestedData['kode'] = $post->kode_f;
						$nestedData['jns_forum'] = $post->jns_forum_convert;
						$nestedData['kode_bkm'] = $post->tahun_bkm!=null?$post->nama_kec!=null?$post->tahun_bkm.'-'.$post->nama_kota.'-'.$post->nama_kec:$post->tahun_bkm.'-'.$post->nama_kota:'-';
						$nestedData['kode_kolab'] = $post->tahun_kolab!=null?$post->nama_kec!=null?$post->tahun_kolab.'-'.$post->nama_kota.'-'.$post->nama_kec:$post->tahun_kolab.'-'.$post->nama_kota:'-';
						$nestedData['kode_kegiatan'] = $post->kode_kegiatan_convert;
						$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan_f;
						$nestedData['lok_kegiatan'] = $post->lok_kegiatan_f;
						$nestedData['created_time'] = $post->created_time;
						$nestedData['option'] = "";

						if(!empty($data2['detil']['173']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
						if(!empty($data2['detil']['174']))
							$nestedData['option'] =$nestedData['option']."&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020209_f_forum_kota')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 174);
        return Redirect::to('/main/persiapan/kecamatan/keberfungsian');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 59,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
