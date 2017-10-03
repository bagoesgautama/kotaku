<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuName extends Model
{
    protected $table = 'bkt_02010104_modul';

    public function menu()
    {
        $this->belongsTo('App\Menu', 'kode', 'kode_modul');
    }
}
