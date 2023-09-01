<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function instruments()
    {
        return $this->belongsToMany("App\Instrument");
    }
}
