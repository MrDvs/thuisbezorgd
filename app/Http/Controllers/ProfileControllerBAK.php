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
        $validateArray = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:7'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits_between:8,12'],
        ];
        if ($request->email != $user->email)
        {
            $validateArray += ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']];
        }
        // If the password is not null, add it to the validation- and updatearray
        if ($request->password != null)
        {
            $validateArray += ['password' => ['required', 'string', 'min:6', 'confirmed']];
        }
        // Validate everything is the validate array
        request()->validate($validateArray);
        $requestData = $request->all();
        if($request->password != null)
        {
            $requestData['password'] = Hash::make($request->password);
        }
        // Update everything that is present in the update array
        $user->update($requestData);
        return redirect()->route('profile');
    }
}
