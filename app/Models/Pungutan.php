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

    public function validator(array $data)
    {
        return Validator::make($data, [
            'id_dagang' => 'required'
        ]);
    }
}
