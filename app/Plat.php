<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    protected $fillable = [
        'name', 'price', 'url'
    ];
}
