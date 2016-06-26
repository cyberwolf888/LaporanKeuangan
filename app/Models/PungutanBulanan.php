<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Validator;

class PungutanBulanan extends Model
{
    use SoftDeletes;

    protected $table = 'pungutan_bulanan';
}
