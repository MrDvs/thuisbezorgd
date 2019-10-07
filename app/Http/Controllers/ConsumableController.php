<?php

namespace App\Http\Controllers;

use Image;
use App\Consumable;
use App\Restaurant;
use Illuminate\Http\Request;

class ConsumableController extends Controller
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
    public function create($id)
    {
        return view('consumable.create', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $restaurant_id)
    {
        request()->validate([
            'title' => ['required', 'string', 'max:191'],
            'category' => ['required', 'numeric'],
            'photo' => ['required', 'image'],
            'price' => ['required', 'numeric', 'between:0,99.99'],
        ]);

        $originalImage = $request->file('photo');
        $cropped = Image::make($originalImage)
            ->fit(200, 200)
            ->encode('jpg', 80);
        $img_id = uniqid().'.jpg';
        $cropped->save('../storage/app/public/'.$img_id);
        $consumable = new Consumable();
        $consumable->title = $request->title;
        $consumable->category = $request->category;
        $consumable->price = $request->price;
        $consumable->photo = $img_id;
        $consumable->restaurant_id = $restaurant_id;
        $consumable->save();

        return redirect()->route('restaurant.show', ['restaurant' => $restaurant_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consumable  $consumable
     * @return \Illuminate\Http\Response
     */
    public function show(Consumable $consumable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consumable  $consumable
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumable $consumable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consumable  $consumable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumable $consumable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consumable  $consumable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumable $consumable)
    {
        //
    }
}
