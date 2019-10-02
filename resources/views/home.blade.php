@extends('layouts.app')

@section('content')
<style>
    .restaurant:hover{
        background-color: #000000 !important;
    }
</style>
{{-- Search bar --}}
<div class="input-group mb-4" style="width: 50%; margin: auto;">
    <input type="search" placeholder="Zoek op restaurantnaam" aria-describedby="button-addon5" class="form-control" name="query">
    <div class="input-group-append">
        <button type="submit" id="button-addon5" type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </div>
</div>
{{-- Restaurant --}}
<div class="restaurants">
    @foreach($restaurants as $restaurant)
        <a href="#" style="text-decoration: none; color: #000;">
            <div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
                <div class="logo" style="float: left; margin-right: 20px">
                    <img src="{{asset('img/'.$restaurant->photo)}}" style="height: 20vh; width: auto;">
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
