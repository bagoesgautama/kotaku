<?php

namespace App\Http\Controllers\MAIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk010317Controller extends Controller
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
				if($item->kode_menu==104)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;

				$this->log_aktivitas('View', 326);
				return view('MAIN/bk010317/index',$data);
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
	}

	public function Post(Request $request)
	{
		$columns = array(
			0 =>'kode',
			1 =>'tahun',
			2 =>'kode_kota',
			3 =>'kode_kec',
			4 =>'kode_kel',
			5 =>'id_keg_rplp',
			6 =>'status_dok',
			7 =>'tgl_kegiatan',
			8 =>'lok_kegiatan',
			9 =>'created_time'
		);
		$query='
			select * from (select 
				a.*,
				a.kode as kode_rplp, 
				a.tahun as tahun_rplp, 
				c.nama as nama_kota, 
				d.nama as nama_kec, 
				h.nama as nama_kel, 
				e.nama as nama_kmw, 
				f.nama as nama_korkot, 
				g.nama as nama_faskel, 
				case when a.status_dok=0 then "Proses Awal" when a.status_dok=1 then "Review" when a.status_dok=2 then "Final" when a.status_dok=3 then "Disahkan" end status_dok_convert, 
				case when a.tgl_kegiatan is null then "-" else a.tgl_kegiatan end tgl_kegiatan_rplp, 
				case when a.lok_kegiatan is null then "-" else a.lok_kegiatan end lok_kegiatan_rplp,
				case when b.nama is null then "-" else b.nama end nama_keg_rplp
			from bkt_01030215_rplp_kel a
				left join bkt_01010127_keg_rplp b on a.id_keg_rplp=b.id
				left join bkt_01010102_kota c on a.kode_kota=c.kode
				left join bkt_01010103_kec d on a.kode_kec=d.kode
				left join bkt_01010110_kmw e on a.kode_kmw=e.kode
				left join bkt_01010111_korkot f on a.kode_korkot=f.kode
				left join bkt_01010113_faskel g on a.kode_faskel=g.kode
				left join bkt_01010104_kel h on a.kode_kel=h.kode) b';
		$totalData = DB::select('select count(1) cnt from bkt_01030215_rplp_kel a
				left join bkt_01010127_keg_rplp b on a.id_keg_rplp=b.id
				left join bkt_01010102_kota c on a.kode_kota=c.kode
				left join bkt_01010103_kec d on a.kode_kec=d.kode
				left join bkt_01010110_kmw e on a.kode_kmw=e.kode
				left join bkt_01010111_korkot f on a.kode_korkot=f.kode
				left join bkt_01010113_faskel g on a.kode_faskel=g.kode
				left join bkt_01010104_kel h on a.kode_kel=h.kode');
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
				b.kode_rplp like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or
				b.nama_kel like "%'.$search.'%" or
				b.nama_keg_rplp like "%'.$search.'%" or  
				b.status_dok_convert like "%'.$search.'%" or
				b.tgl_kegiatan_rplp like "%'.$search.'%" or
				b.tahun_rplp like "%'.$search.'%" or
				b.lok_kegiatan_rplp like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' where (
				b.kode_rplp like "%'.$search.'%" or 
				b.nama_kota like "%'.$search.'%" or 
				b.nama_kec like "%'.$search.'%" or
				b.nama_kel like "%'.$search.'%" or 
				b.nama_keg_rplp like "%'.$search.'%" or  
				b.status_dok_convert like "%'.$search.'%" or
				b.tgl_kegiatan_rplp like "%'.$search.'%" or
				b.tahun_rplp like "%'.$search.'%" or
				b.lok_kegiatan_rplp like "%'.$search.'%")) a');
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

				$url_edit=url('/')."/main/perencanaan/kelurahan/penyusunan_rplp/create?kode=".$edit;
				$url_delete=url('/')."/main/perencanaan/kelurahan/penyusunan_rplp/delete?kode=".$delete;
				$nestedData['kode'] = $post->kode_rplp;
				$nestedData['tahun'] = $post->tahun_rplp;
				$nestedData['kode_kota'] = $post->nama_kota;
				$nestedData['kode_kec'] = $post->nama_kec;
				$nestedData['kode_kel'] = $post->nama_kel;
				$nestedData['kode_kmw'] = $post->nama_kmw;
				$nestedData['kode_korkot'] = $post->nama_korkot;
				$nestedData['kode_faskel'] = $post->nama_faskel;
				$nestedData['id_keg_rplp'] = $post->nama_keg_rplp;
				$nestedData['status_dok'] = $post->status_dok_convert;
				$nestedData['tgl_kegiatan'] = $post->tgl_kegiatan_rplp;
				$nestedData['lok_kegiatan'] = $post->lok_kegiatan_rplp;
				$nestedData['created_time'] = $post->created_time;

				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 1)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==104)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['327'])){
					$option .= "&emsp;<a href='{$url_edit}' title='EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['328'])){
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
				if($item->kode_menu==104)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['kode']=$request->input('kode');
			if($data['kode']!=null  && !empty($data['detil']['327'])){
				$rowData = DB::select('select * from bkt_01030215_rplp_kel where kode='.$data['kode']);
				$data['tahun'] = $rowData[0]->tahun;
				$data['kode_kota'] = $rowData[0]->kode_kota;
				$data['kode_kec'] = $rowData[0]->kode_kec;
				$data['kode_kel'] = $rowData[0]->kode_kel;
				$data['kode_kmw'] = $rowData[0]->kode_kmw;
				$data['kode_korkot'] = $rowData[0]->kode_korkot;
				$data['kode_faskel'] = $rowData[0]->kode_faskel;
				$data['id_keg_rplp'] = $rowData[0]->id_keg_rplp;
				$data['tgl_kegiatan'] = $rowData[0]->tgl_kegiatan;
				$data['lok_kegiatan'] = $rowData[0]->lok_kegiatan;
				$data['cp_q_peserta_p'] = $rowData[0]->cp_q_peserta_p;
				$data['cp_q_peserta_w'] = $rowData[0]->cp_q_peserta_w;
				$data['cp_q_peserta_mbr'] = $rowData[0]->cp_q_peserta_mbr;
				$data['status_dok'] = $rowData[0]->status_dok;
				$data['ds_hkm'] = $rowData[0]->ds_hkm;
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
					$data['kode_kec_list']=DB::select('select kode, nama from bkt_01010103_kec where kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kota))
					$data['kode_korkot_list']=DB::select('select b.kode, b.nama from bkt_01010112_kota_korkot a, bkt_01010111_korkot b where a.kode_korkot=b.kode and a.kode_kota='.$rowData[0]->kode_kota);
				if(!empty($rowData[0]->kode_kel))
					$data['kode_faskel_list']=DB::select('select b.kode, b.nama from bkt_01010114_kel_faskel a, bkt_01010113_faskel b where a.kode_faskel=b.kode and a.kode_kel='.$rowData[0]->kode_kel);
				if(!empty($rowData[0]->kode_kec))
					$data['kode_kel_list']=DB::select('select kode, nama from bkt_01010104_kel where kode_kec='.$rowData[0]->kode_kec);
				$data['kode_keg_list'] = DB::select('select * from bkt_01010127_keg_rplp where status=1'); 
				
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user');
				return view('MAIN/bk010317/create',$data);
			}else if ($data['kode']==null  && !empty($data['detil']['326'])){
				$data['tahun'] = null;
				$data['kode_kota'] = null;
				$data['kode_kec'] = null;
				$data['kode_kel'] = null;
				$data['kode_kmw'] = null;
				$data['kode_korkot'] = null;
				$data['kode_faskel'] = null;
				$data['id_keg_rplp'] = null;
				$data['tgl_kegiatan'] = null;
				$data['lok_kegiatan'] = null;
				$data['cp_q_peserta_p'] = null;
				$data['cp_q_peserta_w'] = null;
				$data['cp_q_peserta_mbr'] = null;
				$data['status_dok'] = null;
				$data['ds_hkm'] = null;
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
				$data['kode_kota_list'] = null;
				$data['kode_kec_list'] = null;
				$data['kode_kmw_list'] = DB::select('select * from bkt_01010110_kmw');
				$data['kode_korkot_list'] = null;
				$data['kode_faskel_list'] = null;
				$data['kode_kel_list'] = null;
				$data['kode_keg_list'] = DB::select('select * from bkt_01010127_keg_rplp where status=1'); 
				$data['kode_user_list'] = DB::select('select * from bkt_02010111_user'); 
				return view('MAIN/bk010317/create',$data);
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
			DB::table('bkt_01030215_rplp_kel')->where('kode', $request->input('kode'))
			->update([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'id_keg_rplp' => $request->input('kode-keg-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'cp_q_peserta_p' => $request->input('cp_q_peserta_p'),
				'cp_q_peserta_w' => $request->input('cp_q_peserta_w'),
				'cp_q_peserta_mbr' => $request->input('cp_q_peserta_mbr'),
				'status_dok' => $request->input('status_dok'),
				'ds_hkm' => $request->input('ds_hkm'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'updated_by' => Auth::user()->id,
				'updated_time' => date('Y-m-d H:i:s')
				]);

			$this->log_aktivitas('Update', 327);

		}else{
			DB::table('bkt_01030215_rplp_kel')->insert([
				'tahun' => $request->input('tahun-input'),
				'kode_kota' => $request->input('kode-kota-input'),
				'kode_kec' => $request->input('kode-kec-input'),
				'kode_kel' => $request->input('kode-kel-input'),
				'kode_kmw' => $request->input('kode-kmw-input'),
				'kode_korkot' => $request->input('kode-korkot-input'),
				'kode_faskel' => $request->input('kode-faskel-input'),
				'id_keg_rplp' => $request->input('kode-keg-input'),
				'tgl_kegiatan' => $this->date_conversion($request->input('tgl-kegiatan-input')),
				'lok_kegiatan' => $request->input('lok-kegiatan-input'),
				'cp_q_peserta_p' => $request->input('cp_q_peserta_p'),
				'cp_q_peserta_w' => $request->input('cp_q_peserta_w'),
				'cp_q_peserta_mbr' => $request->input('cp_q_peserta_mbr'),
				'status_dok' => $request->input('status_dok'),
				'ds_hkm' => $request->input('ds_hkm'),
				// 'diser_tgl' => $this->date_conversion($request->input('tgl-diser-input')),
				// 'diser_oleh' => $request->input('diser-oleh-input'),
				// 'diket_tgl' => $this->date_conversion($request->input('tgl-diket-input')),
				// 'diket_oleh' => $request->input('diket-oleh-input'),
				// 'diver_tgl' => $this->date_conversion($request->input('tgl-diver-input')),
				// 'diver_oleh' => $request->input('diver-oleh-input'),
				'created_by' => Auth::user()->id
       			]);

			$this->log_aktivitas('Create', 326);
		}
	}

	public function date_conversion($date)
	{
        $date_convert = date('Y-m-d', strtotime($date));
        return $date_convert;
	}

	public function delete(Request $request)
	{
		DB::table('bkt_01030215_rplp_kel')->where('kode', $request->input('kode'))->delete();
		$this->log_aktivitas('Delete', 328);
        return Redirect::to('/main/perencanaan/kelurahan/penyusunan_rplp');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
				'kode_user' => Auth::user()->id,
				'kode_apps' => 1,
				'kode_modul' => 6,
				'kode_menu' => 104,
				'kode_menu_detil' => $detil,
				'aktifitas' => $aktifitas,
				'deskripsi' => $aktifitas
       			]);
    }
}
