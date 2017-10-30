<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class bk020314Controller extends Controller
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
				if($item->kode_menu==166)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			if(!empty($data['detil'])){
			    $data['username'] = $user->name;
				$this->log_aktivitas('View', 557);
				return view('HRM/bk020314/index',$data);
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
			1 =>'user',
			2 =>'period_akhir',
			3 =>'hasil_eval',
			4 =>'diver_oleh',
			5 =>'diver_tgl'
		);
		if($user->kode_role==35){
			$query='select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030208_eval_kerja a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id';
			$totalData = DB::select('select count(1) cnt from bkt_02030208_eval_kerja a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id');
		}else{
			$query='select a.*,b.user_name verifikator,c.user_name user
				from bkt_02030208_eval_kerja a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id and (a.kode_personil in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.')) or a.kode_personil='.$user->id.') ';
			$totalData = DB::select('select count(1) cnt from bkt_02030208_eval_kerja a left join bkt_02010111_user b on a.diver_oleh=b.id,bkt_02010111_user c
				where a.kode_personil=c.id and (a.kode_personil in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.'))or a.kode_personil='.$user->id.')');
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
			$posts=DB::select($query. ' and (b.user_name like "%'.$search.'%" or c.user_name like "%'.$search.'%" ) order by '.$order.' '.$dir.' limit '.$start.','.$limit);
			$totalFiltered=DB::select('select count(1) cnt from ('.$query. ' and (b.user_name like "%'.$search.'%" or c.user_name like "%'.$search.'%") ) a');
			$totalFiltered=$totalFiltered[0]->cnt;
		}

		$data = array();
		if(!empty($posts))
		{
			foreach ($posts as $post)
			{
				if($post->hasil_eval==5){
					$nestedData['hasil_eval']='Sangat Baik';
				}else if($post->hasil_eval==4){
					$nestedData['hasil_eval']='Baik';
				}else if($post->hasil_eval==3){
					$nestedData['hasil_eval']='Cukup';
				}else if($post->hasil_eval==2){
					$nestedData['hasil_eval']='Kurang';
				}else{
					$nestedData['hasil_eval']='Sangat Kurang';
				}

				$edit =  $post->kode;
				$url_edit="/hrm/management/evaluasi/create?kode=".$edit;
				$url_delete="/hrm/management/evaluasi/delete?kode=".$edit;
				$nestedData['kode'] = $post->kode;
				$nestedData['user'] = $post->user;
				$nestedData['period_akhir'] = $post->period_akhir;
				$nestedData['diver_oleh'] = $post->diver_oleh;
				$nestedData['diver_tgl'] = $post->diver_tgl;
				$user = Auth::user();
		        $akses= $user->menu()->where('kode_apps', 2)->get();
				if(count($akses) > 0){
					foreach ($akses as $item) {
						if($item->kode_menu==166)
							$detil[$item->kode_menu_detil]='a';
					}
				}

				$option = '';
				if(!empty($detil['559'])){
					$option .= "&emsp;<a href='{$url_edit}' title='VIEW/EDIT' ><span class='fa fa-fw fa-edit'></span></a>";
				}
				if(!empty($detil['560']) && empty($nestedData['diver_oleh']) && $user->id !=$post->kode_personil){
					$option .= "&emsp;<a href='#' title='Delete' onclick='delete_func(\"{$url_delete}\");'><span class='fa fa-fw fa-trash-o'></span></a>";
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
        $akses= $user->menu()->where('kode_apps', 2)->get();
		if(count($akses) > 0){
			foreach ($akses as $item) {
				$data['menu'][$item->kode_menu] =  'a' ;
				if($item->kode_menu==166)
					$data['detil'][$item->kode_menu_detil]='a';
			}
			$data['username'] = $user->name;
			$data['id'] = $user->id;
			$data['kode']=$request->input('kode');
			if($user->kode_role==35){
				$data['user_list']=DB::select('select id,user_name from bkt_02010111_user where status_personil=2');
			}else{
				$data['user_list']=DB::select('select id,user_name from bkt_02010111_user where status_personil=2 and
				id in (select id from bkt_02010111_user where kode_role=(select kode from bkt_02010102_role where kode_role_upper='.$user->kode_role.'))');
			}
			if($data['kode']!=null && !empty($data['detil']['559'])){
				$rowData = DB::select('select * from bkt_02030208_eval_kerja where kode='.$data['kode']);
				$data['periode_awal'] = $rowData[0]->periode_awal;
				$data['period_akhir'] = $rowData[0]->period_akhir;
				$data['kode_personil'] = $rowData[0]->kode_personil;
				$data['hasil_eval'] = $rowData[0]->hasil_eval;
				$data['catatal_eval'] = $rowData[0]->catatal_eval;
				$data['diver_tgl'] = $rowData[0]->diver_tgl;
				$data['diver_oleh'] = $rowData[0]->diver_oleh;
				return view('HRM/bk020314/create',$data);
			}else if($data['kode']==null && !empty($data['detil']['558'])){
				$data['periode_awal'] = null;
				$data['period_akhir'] = null;
				$data['kode_personil'] = null;
				$data['hasil_eval'] = null;
				$data['catatal_eval'] = null;
				$data['diver_tgl'] = null;
				$data['diver_oleh'] = null;
				return view('HRM/bk020314/create',$data);
			}else {
				return Redirect::to('/');
			}
		}else{
			return Redirect::to('/');
		}
	}

	public function post_create(Request $request)
	{
		$user = Auth::user();

		date_default_timezone_set('Asia/Jakarta');
		if ($request->input('kode')!=null){
			DB::table('bkt_02030208_eval_kerja')->where('kode', $request->input('kode'))
			->update(['kode_personil' => $request->input('kode_personil-input'),
				'periode_awal' => $request->input('periode_awal-input'),
				'period_akhir' => $request->input('period_akhir-input'),
				'hasil_eval' => $request->input('hasil_eval-input'),
				'catatal_eval' => $request->input('catatal_eval-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => Auth::user()->id
				]);
			$this->log_aktivitas('Update', 559);

		}else{
			DB::table('bkt_02030208_eval_kerja')->insert(
       			['kode_personil' => $request->input('kode_personil-input'),
				'periode_awal' => $request->input('periode_awal-input'),
				'period_akhir' => $request->input('period_akhir-input'),
				'hasil_eval' => $request->input('hasil_eval-input'),
				'catatal_eval' => $request->input('catatal_eval-input'),
				'diver_tgl' => $request->input('diver_tgl-input'),
				'diver_oleh' => $request->input('diver_oleh-input'),
				'created_by' => Auth::user()->id
       			]);
			$this->log_aktivitas('Create', 558);
		}
		DB::table('bkt_02030205_pesan')->insert(
			['kode_user' => $request->input('kode_personil-input'),
			'kode_user_pengirim' => $user->id,
			'text_pesan' => 'Anda menerima evaluasi kerja ',
			'status' => 0
		]);

	}

	public function delete(Request $request)
	{
		DB::table('bkt_02030208_eval_kerja')->where('kode', $request->input('kode'))->delete();
        $this->log_aktivitas('Delete', 560);
        return Redirect::to('/hrm/management/evaluasi');
    }

    public function log_aktivitas($aktifitas, $detil)
    {
    	DB::table('bkt_02030201_log_aktivitas')->insert([
			'kode_user' => Auth::user()->id,
			'kode_apps' => 2,
			'kode_modul' => 14,
			'kode_menu' => 166,
			'kode_menu_detil' => $detil,
			'aktifitas' => $aktifitas,
			'deskripsi' => $aktifitas
		]);
    }
}
