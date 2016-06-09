<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dagang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dagang';

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama_dagang' => 'required|max:100'
        ]);
    }
}
