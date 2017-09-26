<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //

    public function runner(){

        return $this->belongsTo('App\Contact');

    }
}
