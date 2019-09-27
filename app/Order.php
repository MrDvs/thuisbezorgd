<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function consumables()
    {
        return $this->belongsToMany('App\Consumable', 'consumable_order', 'order_id', 'consumable_id');
    }
}
