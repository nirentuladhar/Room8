<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'house_id'
    ];

    protected $hidden = [
        'pivot'
    ];

    /**
     * Relationships
     */

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function payables()
    {
        $this->hasMany('App\Payable');
    }


}
