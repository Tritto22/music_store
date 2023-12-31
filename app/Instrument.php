<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany("App\Tag");
    }
}
