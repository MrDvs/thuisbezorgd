@extends('layouts.app')

@section('content')
<div class="restaurant-container">
	<img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 180px; width: 180px; display: block; margin: auto;">
	<h2 style="text-align: center;">{{$restaurant->title}}</h2>
	<h3>Gerechten</h3>
	<hr>
	@auth
		@if(Auth::id() == $restaurant->user_id)
			<a href="{{route('consumable.create', ['restaurant_id' => $restaurant->id])}}" class="btn btn-primary">Versnapering toevoegen</a>
		@endif
	@endauth
	@foreach($restaurant->consumables as $consumable)
		<div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
            <div class="logo" style="float: left; margin-right: 20px">
                <img src="{{asset('storage/'.$consumable->photo)}}" style="height: 180px; width: 180px;">
            </div>
            <div class="detailswrapper">
                <h2 class="restaurantname" style="font-weight: bold;">{{$consumable->title}}</h2>
                <h4 class="restaurantaddress">€{{$consumable->price}}, {{$consumable->category}}</h4>
                <button style="float: right;"><i class="fas fa-cart-plus"></i>Toevoegen</button>
            </div>
        </div>
	@endforeach
	
	@foreach($food as $eat)
		Drinkies: {{($food)}}
	@endforeach
	food: {{$food}}
	sides: {{$sides}}

</div>
@endsection
