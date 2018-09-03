<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{

    /**
     * Query Scopes
     */

    public function scopePaid($query)
    {
        return $query->where('is_paid', '1');
    }

    public function scopeNotPaid($query)
    {
        return $query->where('is_paid', '0');
    }


    /**
     * Relationships
     */

    public function payer()
    {
        return $this->belongsTo('App\User', 'payer_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
