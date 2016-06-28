<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class PungutanBulanan extends Model
{
    use SoftDeletes;

    protected $table = 'pungutan_bulanan';

    public function validator(array $data)
    {
        return Validator::make($data, [
            'sewa_tempat' => 'required|numeric'
        ]);
    }

    public function pungutan()
    {
        return $this->belongsTo('App\Models\Pungutan', 'id_pungutan');
    }
}
