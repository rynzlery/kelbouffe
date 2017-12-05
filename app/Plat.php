<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    protected $fillable = [
        'name', 'price', 'url'
    ];

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
