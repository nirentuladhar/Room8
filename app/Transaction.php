<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'group_id', 'description', 'amount', 'location',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\User');
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }
}
