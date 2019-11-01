<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Order;
use App\Restaurant;
use App\Consumable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }

    public function users()
    {
    	$users = User::all();
    	return view('admin.users', ['users' => $users]);
    }

    public function restaurants()
    {
    	$restaurants = Restaurant::all();
    	return view('admin.restaurants', ['restaurants' => $restaurants]);
    }

    public function consumables()
    {
    	$consumables = Consumable::all();
    	return view('admin.consumables', ['consumables' => $consumables]);
    }
}
