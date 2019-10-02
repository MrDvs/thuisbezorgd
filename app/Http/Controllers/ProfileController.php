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

    public function edit() {
    	$user = User::find(Auth::id());
    	return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // Find the requested user by id
        $user = User::find(Auth::id());
        // Create an array with things to validate if the form gets submitted
        $validateArray = [];
        // Create an array with things to update in the database
        $updateArray = [];
        if ($request->name != $user->name)
        {
            $validateArray += ['name' => ['required', 'string', 'max:255']];
            $updateArray += ['name' => $request->name];
        }
        if ($request->address != $user->address)
        {
            $validateArray += ['address' => ['required', 'string', 'max:255']];
            $updateArray += ['address' => $request->address];
        }
        if ($request->zipcode != $user->zipcode)
        {
            $validateArray += ['zipcode' => ['required', 'string', 'max:7']];
            $updateArray += ['zipcode' => $request->zipcode];
        }
        if ($request->city != $user->city)
        {
            $validateArray += ['city' => ['required', 'string', 'max:255']];
            $updateArray += ['city' => $request->city];
        }
        if ($request->phone != $user->phone)
        {
            $validateArray += ['phone' => ['required', 'numeric', 'digits_between:8,12']];
            $updateArray += ['phone' => $request->phone];
        }
        if ($request->email != $user->email)
        {
            $validateArray += ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']];
            $updateArray += ['email' => $request->email];
        }
        // If the password is not null, add it to the validation- and updatearray
        if ($request->password != null)
        {
            $validateArray += ['password' => ['required', 'string', 'min:6', 'confirmed']];
            $updateArray += ['password' => Hash::make($request->password)];
        }
        // Validate everything is the validate array
        request()->validate($validateArray);

        // Update everything that is present in the update array
        $user->update($updateArray);
        return redirect()->route('profile');
    }
}
