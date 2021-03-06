@extends('layouts.app')

@section('content')
{{-- Search bar --}}
<form action="{{route('search')}}" method="POST">
    @csrf
    <div class="input-group mb-4" style="width: 50%; margin: auto;">
        <input type="search" placeholder="Zoek op restaurantnaam" aria-describedby="button-addon5" class="form-control" name="query">
        <div class="input-group-append">
            <button type="submit" id="button-addon5" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
{{-- Restaurant --}}
<div class="restaurants">
    @foreach($restaurants as $restaurant)
        <a href="{{route('restaurant.show', ['restaurant' => $restaurant->id])}}" style="text-decoration: none; color: #000;">
            <div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
                <div class="logo" style="float: left; margin-right: 20px">
                    <img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 180px; width: 180px;">
                </div>
                <div class="detailswrapper">
                    <h2 class="restaurantname" style="font-weight: bold;">{{$restaurant->title}}</h2>
                    <h4 class="restaurantaddress">{{$restaurant->address}}, {{$restaurant->city}}</h4>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
