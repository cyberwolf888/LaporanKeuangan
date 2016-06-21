<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Pasar extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pasar';
    protected $dates = ['deleted_at'];

    public $incrementing = false;

    public function validator(array $data)
    {
        return Validator::make($data, [
            'id_pasar' => 'required',
            'id_komoditas' => 'required',
            'nama_pasar' => 'required|max:100',
            'jenis_dagang' => 'required',
            'lokasi' => 'required|max:100'
        ]);
    }

    public function createId()
    {
        $lastRecord = $this->orderBy('created_at', 'DESC')->first();
        if($lastRecord){
            $lastId = substr($lastRecord->id,2)+1;
            $newId = "PS".substr("0".$lastId,-2);
        }else{
            $newId = "PS01";
        }
        return $newId;
    }
}
