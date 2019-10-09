<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Order;
use App\Consumable;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required', 'string', 'max:191', 'unique:restaurants'],
            'kvk' => ['required', 'max:11', 'digits_between:8,12'],
            'address' => ['required', 'string', 'max:191'],
            'zipcode' => ['required', 'string', 'max:7'],
            'city' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'numeric', 'digits_between:8,12', 'unique:restaurants'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:restaurants'],
            'photo' => ['required', 'image'],
        ]);

        $originalImage = $request->file('photo');
        $cropped = Image::make($originalImage)
            ->fit(200, 200)
            ->encode('jpg', 80);
        $img_id = uniqid().'.jpg';
        $cropped->save('../storage/app/public/'.$img_id);

        $restaurant = new Restaurant();
        $restaurant->title = $request->title;
        $restaurant->kvk = $request->kvk;
        $restaurant->address = $request->address;
        $restaurant->zipcode = $request->zipcode;
        $restaurant->city = $request->city;
        $restaurant->phone = $request->phone;
        $restaurant->email = $request->email;
        $restaurant->photo = $img_id;
        $restaurant->user_id = Auth::id();
        $restaurant->save();

        return redirect()->route('restaurant.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::where('id', $id)->with('consumables')->get();
        $food = [];
        $drinks = [];
        $sides = [];
        foreach ($restaurant[0]->consumables as $key => $consumable) {
            switch ($consumable->category) {
                case 1:
                    array_push($food, $restaurant[0]->consumables[$key]);
                    break;
                case 2:
                    array_push($drinks, $restaurant[0]->consumables[$key]);
                    break;
                case 3:
                    array_push($sides, $restaurant[0]->consumables[$key]);
                    break;
            }
        }
        return view('restaurant.show', [
            'restaurant' => $restaurant[0],
            'foods' => $food,
            'drinks' => $drinks,
            'sides' => $sides,
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
        $restaurant = Restaurant::find($id);
        return view('restaurant.edit', ['restaurant' => $restaurant]);
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
        $restaurant = restaurant::find($id);
        $requestData = $request->all();
        $validateArray = [
            'kvk' => ['required', 'max:11', 'digits_between:8,12'],
            'address' => ['required', 'string', 'max:191'],
            'zipcode' => ['required', 'string', 'max:7'],
            'city' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'numeric', 'digits_between:8,12', 'unique:restaurants'],
        ];
        if ($request->title != $restaurant->title) {
            $validateArray += ['title' => ['required', 'string', 'max:191', 'unique:restaurants']];
        }
        if ($request->email != $restaurant->email) {
            $validateArray += ['email' => ['required', 'string', 'email', 'max:191', 'unique:restaurants']];
        }
        if ($request->title != $restaurant->title) {
            $validateArray += ['title' => ['required', 'string', 'max:191', 'unique:restaurants']];
        }
        if ($request->photo != null) {
            $validateArray += ['photo' => ['required', 'image']];
        }
        request()->validate($validateArray);
        if ($request->file('photo') != null) {
            $originalImage = $request->file('photo');
            $cropped = Image::make($originalImage)
                ->fit(200, 200)
                ->encode('jpg', 80);
            $img_id = uniqid().'.jpg';
            $cropped->save('../storage/app/public/'.$img_id);
            $requestData['photo'] = $img_id;
        }
        $restaurant->update($requestData);
        return redirect()->route('profile.index');
        dd($request);

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

    public function checkout($restaurant_id)
    {
        $items = session()->get('consumables');
        $cart = [];
        foreach ($items as $key => $item) {
            array_push($cart, Consumable::where('id', $item)->get()[0]);
        }
        $total = 0;
        foreach ($cart as $cartItem) {
            $total += $cartItem['price'];
        }
        $total = number_format($total, 2);
        return view('restaurant.pay', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function pay($restaurant_id)
    {
        $items = session()->get('consumables');

        $order = new Order();
        $order->user_id = Auth::id();
        $order->restaurant_id = $restaurant_id;
        $order->save();

        foreach ($items as $item) {
            $order->consumables()->attach($item, ['quantity' => 1, 'price' => 1]);
        }
        
        return redirect()->route('profile.index')->with('status', 'Betaling geslaagd!');
    }

    public function search(Request $request)
    {
        $query = $request['query'];
        $results = Restaurant::where('title', 'like', '%'.$query.'%')->get();
        return view('restaurant.search', [
            'results' => $results, 
            'query' => $query
        ]);
    }
}
