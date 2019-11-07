<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Consumable;
use App\Order;
use App\User;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::simplePaginate(10);
        return view('admin.profile.index', ['users' => $users]);
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

    public function orders($id)
    {
        // Get the current logged in user with his restaurants and orders
        $user = User::where('id', $id)->with('restaurants', 'orders')->get()[0];
        // Create an empty orders array
        $orders = [];
        if (count($user->orders)) {
            foreach ($user->orders as $key => $order) {
                // Push the consumables of each order to the orders array
                array_push($orders, Order::where('id', $order->id)->with('consumables')->get()[0]);
            }
        }
        return view('admin.profile.orders', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.profile.edit', ['user' => $user]);
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'numeric', 'digits_between:8,12', Rule::unique('users')->ignore($user->id)],
        ];
        // If the password is not null, add it to the validateArray
        if ($request->password != null)
        {
            $validateArray += ['password' => ['required', 'string', 'min:6', 'confirmed']];
        // If it is null, remove them from the request data so that it wont get updated
        } else {
            unset($requestData['password']);
            unset($requestData['password_confirmation']);
        }
        // Validate everything is the validate array
        request()->validate($validateArray);
        // If the password has changed, encrypt it
        if($request->password != null)
        {
            $requestData['password'] = Hash::make($request->password);
        }
        if (isset($requestData['is_admin'])) {
            $requestData['is_admin'] = 1;
        } else {
            $requestData['is_admin'] = 0;
        }
        // Update everything that is present in the requestData array
        $user->update($requestData);
        return redirect()->route('admin.profiles.index')->with('status', 'Profiel van '.$user->name.' succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users')->with('status', 'Profiel van '.$user->name.' succesvol verwijderd');
    }
}
