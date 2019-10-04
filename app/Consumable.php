<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
	protected $fillable = [
        'title', 'category', 'photo', 'price', 'restaurant_id',
    ];

	public function restaurant()
	{
		return $this->belongsTo('App\Restaurant');
	}

    public function Orders()
    {
        return $this->belongsToMany('App\Order', 'consumable_order', 'consumable_id', 'order_id');
    }
}
