<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {
    	$user = User::where('id', Auth::id())->with('restaurants')->get();
    	return view('profile.show', ['user' => $user[0]]);
    }
}
