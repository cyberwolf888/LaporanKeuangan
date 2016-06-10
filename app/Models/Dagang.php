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

    const STS_APROVED = "AP";
    const STS_PENDING = "PD";
    const STS_DELETED = "DL";
    const JN_PN = "PN";
    const JN_KS = "KS";

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nama_dagang' => 'required|max:100'
        ]);
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
}
