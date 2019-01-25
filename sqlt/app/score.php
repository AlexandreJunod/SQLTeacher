<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    public $timestamps = false;

    public function People()
    {
        return $this->belongsTo('App\People');
    }
    public function querie()
    {
        return $this->belongsTo('App\querie');
    }
}
