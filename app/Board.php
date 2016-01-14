<?php

namespace Flisk;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';

    protected $fillable = [
        'name',
        'identifier'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'board_user', 'board_id', 'user_id')->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
