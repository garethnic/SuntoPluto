<?php

namespace Flisk;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'new_member',
        'board_identifier'
    ];
}
