<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }

    public function consumables()
    {
    	return $this->hasMany('App\Consumable');
    }

    public function owner()
    {
    	return $this->belongsTo('App\User');
    }
}
