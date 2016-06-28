<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class PungutanHarian extends Model
{
    use SoftDeletes;

    protected $table = 'pungutan_harian';

    public function validator(array $data)
    {
        return Validator::make($data, [
            'tempat_berjualan' => 'required|numeric',
            'listrik' => 'required|numeric',
            'air' => 'required|numeric'
        ]);
    }

    public function pungutan()
    {
        return $this->belongsTo('App\Models\Pungutan', 'id_pungutan');
    }
}
