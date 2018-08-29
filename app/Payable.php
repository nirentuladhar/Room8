<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{


    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function group()
    {
        $this->belongsTo('App\Group');
    }
}
