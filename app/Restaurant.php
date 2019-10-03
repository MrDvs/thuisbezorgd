<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'title', 'kvk', 'address', 'zipcode', 'city', 'phone', 'email', 'photo', 'user_id' ,
    ];

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
