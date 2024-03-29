<?php

namespace Flisk;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The table that used
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'gender',
        'password',
        'timezone',
        'token',
        'confirmed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_user', 'user_id', 'board_id')->withTimestamps();
    }
}
