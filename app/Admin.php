<?php

namespace Flisk;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use SoftDeletes;

    /**
     * The table used
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'timezone',
        'token'
    ];
}
