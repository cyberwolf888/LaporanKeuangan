<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use SoftDeletes;

    protected  $table = 'pegawai';
    protected $dates = ['deleted_at'];
    public $incrementing = false;

    const LAKI_LAKI = 'L';
    const PEREMPUAN = 'P';

    public function createId()
    {
        $date = date('ym');
        $lastRecord = $this->withTrashed()->where('id','like','%PG'.$date.'%')->orderBy('created_at', 'DESC')->first();
        if($lastRecord){
            $lastId = substr($lastRecord->id,6)+1;
        }else{
            $lastId = "001";
        }
        $newId = "PG".$date.substr("0000".$lastId,-3);
        return $newId;
    }

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
