<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exercise extends Model
{
    public $timestamps = false;

    public function querie()
    {
        return $this->hasMany('App\querie');
    }
}
