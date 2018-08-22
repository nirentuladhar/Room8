<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'phone', 'display_picture'
    ];


    /**
     * Relationships
     */

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }
}
