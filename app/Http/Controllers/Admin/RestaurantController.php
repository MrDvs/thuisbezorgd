<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Consumable;
use App\Restaurant;
use Image;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::simplePaginate(10);
        return view('admin.restaurant.index', ['restaurants' => $restaurants]);
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
        $restaurant = Restaurant::find($id);
        return view('admin.restaurant.edit', ['restaurant' => $restaurant]);
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
            'title' => ['required', 'string', 'max:191', Rule::unique('restaurants')->ignore($restaurant->id)],
            'kvk' => ['required', 'max:11', 'digits_between:8,12'],
            'address' => ['required', 'string', 'max:191'],
            'zipcode' => ['required', 'string', 'max:7'],
            'city' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'numeric', 'digits_between:8,12', Rule::unique('restaurants')->ignore($restaurant->id)],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('restaurants')->ignore($restaurant->id)],
        ];
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
        return redirect()->route('admin.restaurants.index')->with('status', 'Restaurant gegevens van '.$restaurant->title.' succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();

        $consumables = Consumable::where('restaurant_id', $restaurant->id)->get();
        foreach ($consumables as $consumable) {
            $consumable->delete();
        }
        return redirect()->route('admin.restaurants.index')->with('status', 'Restaurant '.$restaurant->title.' succesvol verwijderd');
    }
}
