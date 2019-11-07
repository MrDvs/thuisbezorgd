<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Consumable;
use Image;

class ConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumables = Consumable::with('restaurant')->simplePaginate(10);
        return view('admin.consumable.index', ['consumables' => $consumables]);
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
        $consumable = Consumable::find($id);
        return view('admin.consumable.edit', ['consumable' => $consumable]);
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
        $consumable = Consumable::find($id);
        $requestData = $request->all();
        $validateArray = [
            'title' => ['required', 'string', 'max:191'],
            'category' => ['required', 'numeric'],
            'price' => ['required', 'numeric', 'between:0,99.99'],
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
        $consumable->update($requestData);
        return redirect()->route('admin.consumables.index')->with('status', 'Versnapering '.$consumable->title.' succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumable = Consumable::find($id);
        $consumable->delete();
        return view('admin.consumables')->with('status', 'Versnapering succesvol verwijderd');
    }
}
