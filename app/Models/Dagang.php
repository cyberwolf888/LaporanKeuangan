<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Dagang extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dagang';
    protected $dates = ['deleted_at'];

    public $incrementing = false;

    const STS_APROVED = "AP";
    const STS_PENDING = "PD";
    const STS_DELETED = "DL";
    const JN_PN = "PN";
    const JN_KS = "KS";

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama_dagang' => 'required|max:100',
            'lokasi' => 'required|max:100'
        ]);
    }

    public function createId()
    {
        $lastRecord = $this->withTrashed()->orderBy('created_at', 'DESC')->first();
        if($lastRecord){
            $date = date('ym');
            $lastId = substr($lastRecord->id,6)+1;
            $newId = "DG".$date.substr("000000".$lastId,-6);
        }else{
            $newId = "DG1606000001";
        }
        return $newId;
    }

    public static function getLabelStatus($index)
    {
        $status = [Dagang::STS_APROVED=>"Approved",Dagang::STS_PENDING=>"Pending",Dagang::STS_DELETED=>"Deleted"];

        return $status[$index];
    }

    public static function getLabelJenis($index)
    {
        $jenis = [Dagang::JN_PN=>"Penataran",Dagang::JN_KS=>"Kios"];

        return $jenis[$index];
    }

    public function pasar()
    {
        return $this->hasOne('App\Models\Pasar', 'id_pasar');
    }

    public function komoditas()
    {
        return $this->hasOne('App\Models\Komoditas', 'id_komoditas');
    }
}
