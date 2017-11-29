<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'plat_id', 'mark', 'fat', 'user_id'
    ];
}
