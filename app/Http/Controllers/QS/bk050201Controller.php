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
				if($item->kode_menu==151)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 483);
				return view('QS/bk050201/index',$data);
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
			0 =>'id',
			1 =>'agenda',
			2 =>'parent',
			3 =>'kode_keg_kel',
			4 =>'no_urut',
			5 =>'nama_kegiatan',
			6 =>'tgl_mulai',
			7 =>'tgl_selesai',
			8 =>'nama_order'
		);
		$query='select a.id,a.kode_keg_kel,a.no_urut,a.tgl_mulai,a.tgl_selesai,case when a.status=1 then "aktif" else "tidak aktif" end status,b.nama agenda,c.nama_kegiatan parent ,
			case when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND ISNULL(d.nama_kegiatan)  AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when  ISNULL(e.nama_kegiatan) AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						when  f.nama_kegiatan is not null AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat("&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;","&nbsp;&nbsp;&nbsp;",a.nama_kegiatan)
						else a.nama_kegiatan end nama_kegiatan,
			case when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND ISNULL(d.nama_kegiatan)  AND c.nama_kegiatan is not null then concat(c.nama_kegiatan,"->",a.nama_kegiatan)
						when ISNULL(f.nama_kegiatan) AND ISNULL(e.nama_kegiatan) AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						when  ISNULL(e.nama_kegiatan) AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(e.nama_kegiatan,"->",d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						when  f.nama_kegiatan is not null AND e.nama_kegiatan is not null AND d.nama_kegiatan is not null AND c.nama_kegiatan is not null then concat(f.nama_kegiatan,"->",e.nama_kegiatan,"->",d.nama_kegiatan,"->",c.nama_kegiatan,"->",a.nama_kegiatan)
						else a.nama_kegiatan end nama_order
			from bkt_05010102_kegiatan_kel a left join bkt_05010102_kegiatan_kel c on a.id_parent=c.id left join bkt_05010102_kegiatan_kel d on c.id_parent=d.id
			left join bkt_05010102_kegiatan_kel e on d.id_parent=e.id left join bkt_05010102_kegiatan_kel f on e.id_parent=f.id
			,bkt_05010101_agenda b where a.id_agenda=b.id and a.status !=2 ';
		$totalData = DB::select('select count(1) cnt from bkt_05010102_kegiatan_kel a ,bkt_05010101_agenda b where a.id_agenda=b.id and a.status !=2');
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
			$posts=DB::select($query. ' and a.nama_kegiatan like "%'.$search.'%"  order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and a.nama_kegiatan like "%'.$search.'%" ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->id;
				$url_edit="/qs/master/kegiatan_kelurahan/create?id=".$edit;
				$url_delete="/qs/master/kegiatan_kelurahan/delete?id=".$edit;
				$nestedData['id'] = $post->id;
				$nestedData['parent'] = $post->parent;
				$nestedData['kode_keg_kel'] = $post->kode_keg_kel;
				$nestedData['no_urut'] = $post->no_urut;
				$nestedData['nama_kegiatan'] = $post->nama_kegiatan;
				$nestedData['tgl_mulai'] = $post->tgl_mulai;
				$nestedData['tgl_selesai'] = $post->tgl_selesai;
				$nestedData['agenda'] = $post->agenda;
				$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 5)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==151)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['485'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['486'])){
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

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 5,
			'kode_modul' => 10,
			'kode_menu' => 151,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
