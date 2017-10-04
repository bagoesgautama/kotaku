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
				$data['totalData'] = DB::select('select b.kode modul_id,b.nama modul,c.kode apps_id,c.nama apps
					from bkt_02010104_modul b,bkt_02010103_apps c
					where b.kode_apps=c.kode');
				$data['role'] = DB::select('select * from bkt_02010102_role where status=1');

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
			0 =>'jns_forum',
			1 =>'kode_bkm',
			2 =>'kode_kolab',
			3 =>'kode_kegiatan',
			4 =>'tgl_kegiatan',
			5 =>'lok_kegiatan'
		);
		$query='select * from bkt_01020209_f_forum_kota';
		$totalData = DB::select('select count(1) cnt from bkt_01020209_f_forum_kota ');
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
			$posts=DB::select($query. ' where jns_forum like "%'.$search.'%" or kode_bkm like "%'.$search.'%" or kode_kolab like "%'.$search.'%" or kode_kegiatan like "%'.$search.'%" or tgl_kegiatan like "%'.$search.'%" or lok_kegiatan like "%'.$search.'%" order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) from ('.$query. ' where jns_forum like "%'.$search.'%" or kode_bkm like "%'.$search.'%" or kode_kolab like "%'.$search.'%" or kode_kegiatan like "%'.$search.'%" or tgl_kegiatan like "%'.$search.'%" or lok_kegiatan like "%'.$search.'%") a');
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$show =  $post->kode;
				$edit =  $post->kode;
				$delete = $post->kode;
				$kode_kegiatan = null;
				$jns_kegiatan = null;

				if($post->kode_kegiatan == '0'){
					$kode_kegiatan = 'Rapat Internal';
				}elseif($post->kode_kegiatan == '1'){
					$kode_kegiatan = 'Rapat Dengan Pemda';
				}

				if($post->jns_kegiatan == '1'){
					$jns_kegiatan = 'BKM/LKM Tingkat Kota';
				}elseif($post->jns_kegiatan == '2'){
					$jns_kegiatan = 'Kolaborasi Tingkat Kota';
				}

				$url_edit=url('/')."/main/persiapan/kota/forum/f_forum/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kota/forum/f_forum/delete?kode=".$delete;
				$nestedData['jns_kegiatan'] = $jenis_kegiatan;
				$nestedData['kode_bkm'] = $post->kode_bkm;
				$nestedData['kode_kolab'] = $post->kode_kolab;
				$nestedData['kode_kegiatan'] = $kode_kegiatan;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan;
				
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==56)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
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
				$data['kode_bkm_list'] = DB::select('select * from bkt_01020207_bkm_kota where tk_forum=1');
				$data['kode_kolab_list'] = DB::select('select * from bkt_01020208_kolab_kota where tk_forum=1');
				return view('MAIN/bk010211/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['160'])){
				$data['jns_forum'] = null;
				$data['kode_bkm'] = null;
				$data['kode_kolab'] = null;
				$data['kode_kegiatan'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['q_peserta_p'] = null;
				$data['q_peserta_w'] = null;
				$data['q_peserta_pemda'] = null;
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
				$data['kode_bkm_list'] = DB::select('select * from bkt_01020207_bkm_kota where tk_forum=1');
				$data['kode_kolab_list'] = DB::select('select * from bkt_01020208_kolab_kota where tk_forum=1');
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
		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020209_f_forum_kota')->where('kode', $request->input('kode'))
			->update([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input'), 
				'kode_kegiatan' => $request->input('kode-keg-input'),    
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 161);

		}else{
			DB::table('bkt_01020209_f_forum_kota')->insert([
				'jns_forum' => $request->input('jns-forum-input'),
				'kode_bkm' => $request->input('kode-bkm-input'),
				'kode_kolab' => $request->input('kode-kolab-input'), 
				'kode_kegiatan' => $request->input('kode-keg-input'),    
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')), 
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'q_peserta_p' => $request->input('q-laki-input'),
				'q_peserta_w' => $request->input('q-perempuan-input'),
				'q_peserta_pemda' => $request->input('q-pemda-input'),
				'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				'diser_oleh' => $request->input('diser-oleh-input'),
				'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				'diket_oleh' => $request->input('diket-oleh-input'),
				'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

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
