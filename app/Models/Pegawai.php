<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected  $table = 'pegawai';
    public $incrementing = false;

    const LAKI_LAKI = 'L';
    const PEREMPUAN = 'P';

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }

    public function pasar()
    {
        return $this->belongsTo('App\Models\Pasar', 'id_pasar');
    }

    public static function getLabelJenisKelamin($index)
    {
        $jenisKelamin = [Pegawai::LAKI_LAKI=>'Laki-laki', Pegawai::PEREMPUAN=>'Perempuan'];
        return $jenisKelamin[$index];
    }
}
