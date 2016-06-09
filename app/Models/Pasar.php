<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Pasar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pasar';

    public $incrementing = false;

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama_pasar' => 'required|max:100'
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
