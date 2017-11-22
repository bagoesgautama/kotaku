<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010237Controller extends Controller
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
				if($item->kode_menu==236)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

			    $this->log_aktivitas('View', 741);
				return view('MAIN/bk010237/index',$data);
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
			1 =>'kode_kota',
			2 =>'kode_kec',
			3 =>'kode_kel',
			4 =>'tahun',
			5 =>'kode_jns_media',
			6 =>'volume',
			7 =>'satuan',
			8 =>'informasi',
			9 =>'sasaran',
			10 =>'keterangan',
			11 =>'kode_sumber_dana',
			12 =>'nilai_dana'
		);
		$query='select * from (select 
					a.*, 
					b.nama nama_kota, 
					c.nama nama_kec, 
					d.nama nama_kel, 
					e.nama nama_media,
					case 
						when a.kode_sumber_dana="1" then "BDI"
						when a.kode_sumber_dana="2" then "Swadaya"
					end sumber_dana
				from bkt_01020222_media_sos a
					left join bkt_01010102_kota b on a.kode_kota=b.kode
					left join bkt_01010103_kec c on a.kode_kec=c.kode
					left join bkt_01010104_kel d on a.kode_kel=d.kode
					left join bkt_01010141_jns_media e on a.kode_jns_media=e.kode) b ';
		$totalData = DB::select('select count(1) cnt from bkt_01020222_media_sos a
									left join bkt_01010102_kota b on a.kode_kota=b.kode
									left join bkt_01010103_kec c on a.kode_kec=c.kode
									left join bkt_01010104_kel d on a.kode_kel=d.kode
									left join bkt_01010141_jns_media e on a.kode_jns_media=e.kode');
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
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or
				b.nama_kel like "%'.$search.'%" or 
				b.nama_media like "%'.$search.'%" or 
				b.tahun like "%'.$search.'%" or 
				b.satuan like "%'.$search.'%" or 
				b.informasi like "%'.$search.'%" or
				b.sasaran like "%'.$search.'%" or 
				b.sumber_dana like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where ( 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or
				b.nama_kel like "%'.$search.'%" or 
				b.nama_media like "%'.$search.'%" or 
				b.tahun like "%'.$search.'%" or 
				b.satuan like "%'.$search.'%" or 
				b.informasi like "%'.$search.'%" or
				b.sasaran like "%'.$search.'%" or 
				b.sumber_dana like "%'.$search.'%")) a');
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
				//show
				$url_show=url('/')."/main/persiapan/kelurahan/media_sosialisasi/show?kode=".$edit;
				$url_edit=url('/')."/main/persiapan/kelurahan/media_sosialisasi/create?kode=".$edit;
				$url_delete=url('/')."/main/persiapan/kelurahan/media_sosialisasi/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['tahun'] = $post->tahun;
				$nestedData['kode_jns_media'] = $post->nama_media;
				$nestedData['volume'] = $post->volume;
				$nestedData['satuan'] = $post->satuan;
				$nestedData['informasi'] = $post->informasi;
				$nestedData['sasaran'] = $post->sasaran;
				$nestedData['keterangan'] = $post->keterangan;
				$nestedData['kode_sumber_dana'] = $post->sumber_dana;
				$nestedData['nilai_dana'] = $post->nilai_dana;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==236)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['741'])){
					$option .= "&emsp;<a href='{$url_show}' title='SHOW' ><span class='fa fa-fw fa-search'></span></a>";
				}
				if(!empty($detil['743'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['744'])){
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
				if($item->kode_menu==236)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['741'])){
				$rowData = DB::select('select * from bkt_01020222_media_sos where kode='.$data['kode']);
				$data['detil_menu']='741';
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_jns_media'] = $rowData[0]->kode_jns_media;
				$data['volume'] = $rowData[0]->volume;
				$data['satuan'] = $rowData[0]->satuan;
				$data['informasi'] = $rowData[0]->informasi;
				$data['sasaran'] = $rowData[0]->sasaran;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['kode_sumber_dana'] = $rowData[0]->kode_sumber_dana;
				$data['nilai_dana'] = $rowData[0]->nilai_dana;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				$data['media_list'] = DB::select('select * from bkt_01010141_jns_media');
				$data['kode_kota_list']=DB::select('select kode, nama from bkt_01010102_kota where kode='.$rowData[0]->kode_kota);
				$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode='.$rowData[0]->kode_kec);
				$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode='.$rowData[0]->kode_kel);
				$data['tahun_list'] = DB::select('select tahun from list_tahun where tahun='.$rowData[0]->tahun);
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010237/create',$data);
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
				if($item->kode_menu==236)
					$data['detil'][$item->kode_menu_detil]='a';
			}
		    $data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			$data['tahun_list'] = DB::select('select * from list_tahun');
			if($data['kode']!=null && !empty($data['detil']['743'])){
				$rowData = DB::select('select * from bkt_01020222_media_sos where kode='.$data['kode']);
				$data['detil_menu']='743';
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_jns_media'] = $rowData[0]->kode_jns_media;
				$data['volume'] = $rowData[0]->volume;
				$data['satuan'] = $rowData[0]->satuan;
				$data['informasi'] = $rowData[0]->informasi;
				$data['sasaran'] = $rowData[0]->sasaran;
				$data['keterangan'] = $rowData[0]->keterangan;
				$data['kode_sumber_dana'] = $rowData[0]->kode_sumber_dana;
				$data['nilai_dana'] = $rowData[0]->nilai_dana;
				$data['created_time'] = $rowData[0]->created_time;
				$data['created_by'] = $rowData[0]->created_by;
				$data['updated_time'] = $rowData[0]->updated_time;
				$data['updated_by'] = $rowData[0]->updated_by;
				if(empty($user->kode_faskel) && empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				}elseif(!empty($user->kode_faskel) && !empty($user->kode_korkot)){
					$data['kode_kota_list']= DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
					$data['kode_kec_list']=DB::select('select distinct c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
															left join bkt_01010103_kec c on b.kode_kec=c.kode
														where a.id='.$user->id);
					$data['kode_kel_list']=DB::select('select c.kode, c.nama 
														from bkt_02010111_user a 
														left join bkt_01010114_kel_faskel b on a.kode_faskel=b.kode_faskel
														left join  bkt_01010104_kel c on b.kode_kel=c.kode
														where a.id='.$user->id);
				}
				$data['media_list'] = DB::select('select * from bkt_01010141_jns_media');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010237/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['742'])){
				$data['detil_menu']='742';
				$dataUser = DB::select('select * from bkt_02010111_user where id='.$user->id);
				$data['kode_kmw'] = $dataUser[0]->kode_kmw;
				$data['kode_korkot'] = $dataUser[0]->kode_korkot;
				$data['kode_faskel'] = $dataUser[0]->kode_faskel;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['tahun'] = null;
				$data['kode_jns_media'] = null;
				$data['volume'] = null;
				$data['satuan'] = null;
				$data['informasi'] = null;
				$data['sasaran'] = null;
				$data['keterangan'] = null;
				$data['kode_sumber_dana'] = null;
				$data['nilai_dana'] = null;
				$data['created_time'] = null;
				$data['created_by'] = null;
				$data['updated_time'] = null;
				$data['updated_by'] = null;
				if ($data['kode_korkot']!=null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010112_kota_korkot b on a.kode_korkot=b.kode_korkot
															left join bkt_01010102_kota c on b.kode_kota=c.kode
														where a.id='.$user->id);
				}elseif($data['kode_korkot']==null){
					$data['kode_kota_list']=DB::select('select c.kode, c.nama
														from bkt_02010111_user a 
															left join bkt_01010110_kmw b on a.kode_kmw=b.kode
															left join bkt_01010102_kota c on b.kode_prop=c.kode_prop
														where a.id='.$user->id);
				}
				$data['kode_kec_list'] = null;
				$data['kode_kel_list'] = null;
				$data['media_list'] = DB::select('select * from bkt_01010141_jns_media');
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010237/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function select(Request $request)
	{
		if(($request->input('kec'))!=null && ($request->input('faskel'))!=null) {
			$kec_faskel = DB::select('select distinct a.kode, a.nama
										from bkt_01010103_kec a, bkt_01010114_kel_faskel b where a.kode=b.kode_kec and b.kode_faskel='.$request->input('faskel'));
			echo json_encode($kec_faskel);
		}
		elseif(($request->input('kec'))!=null && ($request->input('faskel'))==null){
			$kec = DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$request->input('kec'));
			echo json_encode($kec);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))!=null) {
			$kel_faskel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel').' and a.kode_faskel='.$request->input('faskel'));
			echo json_encode($kel_faskel);
		}
		elseif(($request->input('kel'))!=null && ($request->input('faskel'))==null) {
			$kel = DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010104_kel b where a.kode_kel=b.kode and b.kode_kec='.$request->input('kel'));
			echo json_encode($kel);
		}
		elseif(!empty($request->input('faskel'))){
			$faskel = DB::select('select kode_faskel from bkt_01010114_kel_faskel where kode_kel='.$request->input('faskel'));
			echo json_encode($faskel);
		}
		elseif(!empty($request->input('korkot'))){
			$korkot = DB::select('select kode_korkot from bkt_01010112_kota_korkot where kode_kota='.$request->input('korkot'));
			echo json_encode($korkot);
		}
	}

	public function post_create(Request $request)
	{

		if ($request->input('kode')!=null){
			date_default_timezone_set('Asia/Jakarta');
			DB::table('bkt_01020222_media_sos')->where('kode', $request->input('kode'))
			->update([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),  
				'kode_korkot' => $request->input('kode_korkot-input'), 
				'kode_faskel' => $request->input('kode_faskel-input'),
				'tahun' => $request->input('tahun-input'),
				'kode_jns_media' => $request->input('select-kode_jns_media-input'),
				'volume' => $request->input('volume-input'), 
				'satuan' => $request->input('satuan-input'),
				'informasi' => $request->input('informasi-input'),
				'sasaran' => $request->input('sasaran-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_sumber_dana' => $request->input('select-kode_sumber_dana-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'updated_by' => Auth::user()->id, 
				'updated_time' => date('Y-m-d H:i:s')
				]);
			$this->log_aktivitas('Update', 743);
		}else{
			DB::table('bkt_01020222_media_sos')->insert([
				'kode_kota' => $request->input('select-kode_kota-input'),
				'kode_kec' => $request->input('select-kode_kec-input'),
				'kode_kel' => $request->input('select-kode_kel-input'),
				'kode_kmw' => $request->input('kode_kmw-input'),  
				'kode_korkot' => $request->input('kode_korkot-input'), 
				'kode_faskel' => $request->input('kode_faskel-input'),
				'tahun' => $request->input('tahun-input'),
				'kode_jns_media' => $request->input('select-kode_jns_media-input'),
				'volume' => $request->input('volume-input'), 
				'satuan' => $request->input('satuan-input'),
				'informasi' => $request->input('informasi-input'),
				'sasaran' => $request->input('sasaran-input'),
				'keterangan' => $request->input('keterangan-input'),
				'kode_sumber_dana' => $request->input('select-kode_sumber_dana-input'),
				'nilai_dana' => $request->input('nilai_dana-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 742);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01020222_media_sos')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 744);
        return Redirect::to('/main/persiapan/kelurahan/media_sosialisasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 5, 
				'kode_menu' => 236,   
				'kode_menu_detil' => $detil, 
				'aktifitas' => $aktifitas, 
				'deskripsi' => $aktifitas
       			]);
    }
}
