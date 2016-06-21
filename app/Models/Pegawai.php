<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected  $table = 'pegawai';

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }
}
