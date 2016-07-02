<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPZen\LaravelRbac\Traits\Rbac;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class User extends Authenticatable
{
    use Rbac;
    use SoftDeletes;

    const S_PENDING = '303';
    const S_ACTIVE = '200';
    const S_BANED = '666';

    const DIRUT = 'D';
    const OPERATOR = 'O';
    const PETUGAS = 'P';

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users'
        ]);
    }

    public function pegawai()
    {
        return $this->hasOne('App\Models\Pegawai', 'id_users');
    }

    public static function getLabelStatus($index)
    {
        $status = [User::S_ACTIVE=>'Active', User::S_BANED=>'Baned', User::S_PENDING=>'Pending'];
        return $status[$index];
    }
}
