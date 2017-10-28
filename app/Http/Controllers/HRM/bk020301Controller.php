<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020301Controller extends Controller
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==162)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 545);
				return view('HRM/bk020301/index',$data);
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
		$user = Auth::user();
		$columns = array(
			0 =>'kode',
			1 =>'pengirim',
			2 =>'text_pesan',
			3 =>'tgl_pesan_masuk'
		);
		$query='select a.*,b.user_name pengirim from bkt_02030205_pesan a left join bkt_02010111_user b on a.kode_user_pengirim=b.id where kode_user='.$user->id.' and a.status!=3';
		$totalData = DB::select('select count(1) cnt from bkt_02030205_pesan where kode_user='.$user->id.' and status!=3');
		$totalFiltered = $totalData[0]->cnt;
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		if(empty($request->input('search.value'))){
			$posts=DB::select($query .' order by '.$order.' '.$dir.' limit '.$start.','.$limit);
		}else {
			$search = $request->input('search.value');
			$posts=DB::select($query. ' and (b.user_name like "%'.$search.'%" or text_pesan like "%'.$search.'%") order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (b.user_name like "%'.$search.'%" or text_pesan like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				$edit =  $post->kode;
				$url_edit="/hrm/profil/pesan/baca?kode=".$edit;
				$url_delete="/hrm/profil/pesan/delete?kode=".$edit;
				if($post->status==0){
					$nestedData['kode'] = '<b>'.$post->kode.'</b>';
					$nestedData['pengirim'] = '<b>'.$post->pengirim.'</b>';
					$nestedData['text_pesan'] = '<b>'.$post->text_pesan.'</b>';
					$nestedData['tgl_pesan_masuk'] = '<b>'.$post->tgl_pesan_masuk.'</b>';
				}else{
					$nestedData['kode'] = $post->kode;
					$nestedData['pengirim'] = $post->pengirim;
					$nestedData['text_pesan'] = $post->text_pesan;
					$nestedData['tgl_pesan_masuk'] = $post->tgl_pesan_masuk;
				}
				//$nestedData['status'] = $post->status;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==162)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				//if(!empty($detil['535'])){
					$option .= "&emsp;<a href='{$url_edit}' title='Tandai' ><span class='fa fa-fw fa-edit'></span></a>";
				//}
				//if(!empty($detil['536'])){
					$option .= "&emsp;<a href='#' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
				//}
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

	public function baca(Request $request)
	{
		DB::table('bkt_02030205_pesan')->where('kode', $request->input('kode'))->update(['status' => 1,'tgl_pesan_dibaca' =>date('Y-m-d H:i:s')]);
		return Redirect::to('/hrm/profil/pesan');
	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030205_pesan')->where('kode', $request->input('kode'))->update(['status' => 3,'tgl_pesan_dihapus' =>date('Y-m-d H:i:s')]);
        $this->log_aktivitas('Delete', 545);
        return Redirect::to('/hrm/profil/pesan');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 162,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
