<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurant.show', ['restaurant' => $restaurant]);
    }

    public function edit(Restaurant $restaurant)
    {
        //
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }
}
