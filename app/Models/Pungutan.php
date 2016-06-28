<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Pungutan extends Model
{
    use SoftDeletes;

    protected $table = 'pungutan';

    const T_PUNGUTAN = 'PG';
    const T_TUNGGAKAN = 'TG';

    const D_HARIAN = 'HR';
    const D_BULANAN = 'BL';

    public function validator(array $data)
    {
        return Validator::make($data, [
            'id_dagang' => 'required'
        ]);
    }

    public static function getLabelType($index)
    {
        $type = [Pungutan::T_PUNGUTAN=>'Pungutan', Pungutan::T_TUNGGAKAN=>'Tunggakan'];
        return $type[$index];
    }

    public function harian()
    {
        return $this->hasOne('App\Models\PungutanHarian', 'id_pungutan');
    }

    public function bulanan()
    {
        return $this->hasOne('App\Models\PungutanBulanan', 'id_pungutan');
    }

    public function pasar()
    {
        return $this->belongsTo('App\Models\Pasar', 'id_pasar');
    }

    public function dagang()
    {
        return $this->belongsTo('App\Models\Dagang', 'id_dagang');
    }
}
