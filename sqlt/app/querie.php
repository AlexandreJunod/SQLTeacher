<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class querie extends Model
{
    public $timestamps = false;

    public function score()
    {
        return $this->hasMany('App\score');
    }
}
