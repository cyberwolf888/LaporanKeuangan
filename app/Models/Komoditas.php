<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Komoditas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'komoditas';

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama_komoditas' => 'required|max:100'
        ]);
    }
}
