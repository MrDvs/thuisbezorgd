<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->with('restaurants')->get();
        return view('profile.show', ['user' => $user[0]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find(Auth::id());
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $requestData = $request->all();
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
        } else {
            unset($requestData['password']);
            unset($requestData['password_confirmation']);
        }
        // Validate everything is the validate array
        request()->validate($validateArray);
        if($request->password != null)
        {
            $requestData['password'] = Hash::make($request->password);
        }
        // Update everything that is present in the update array
        $user->update($requestData);
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
