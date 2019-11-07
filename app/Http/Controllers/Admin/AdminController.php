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
}
