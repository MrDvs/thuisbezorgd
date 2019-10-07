@extends('layouts.app')

@section('content')
<div class="restaurant-container">
	<img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 180px; width: 180px; display: block; margin: auto;">
	<h2 style="text-align: center;">{{$restaurant->title}}</h2>
	<h3>Gerechten</h3>
	<hr>
	@auth
		@if(Auth::id() == $restaurant->user_id)
			<a href="{{route('consumable.create', ['restaurant_id' => $restaurant->id])}}" class="btn btn-primary" style="margin-bottom: 10px">Versnapering toevoegen</a>
		@endif
	@endauth
	<h4>Eten</h4>
	@if(count($foods))
		@foreach($foods as $food)
			<div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
	            <div class="logo" style="float: left; margin-right: 20px">
	                <img src="{{asset('storage/'.$food->photo)}}" style="height: 180px; width: 180px;">
	            </div>
	            <div class="detailswrapper">
	                <h2 class="restaurantname" style="font-weight: bold;">{{$food->title}}</h2>
	                <h4 class="restaurantaddress">€{{$food->price}}, {{$food->category}}</h4>
	                <button style="float: right;"><i class="fas fa-cart-plus"></i>Toevoegen</button>
	            </div>
	        </div>
		@endforeach
	@else
		<h4>{{$restaurant->title}} heeft op dit moment geen eten te koop.</h4>
	@endif
	<hr>
	<h4>Drinken</h4>
	@if(count($drinks))
		@foreach($drinks as $drink)
			<div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
	            <div class="logo" style="float: left; margin-right: 20px">
	                <img src="{{asset('storage/'.$drink->photo)}}" style="height: 180px; width: 180px;">
	            </div>
	            <div class="detailswrapper">
	                <h2 class="restaurantname" style="font-weight: bold;">{{$drink->title}}</h2>
	                <h4 class="restaurantaddress">€{{$drink->price}}, {{$drink->category}}</h4>
	                <button style="float: right;"><i class="fas fa-cart-plus"></i>Toevoegen</button>
	            </div>
	        </div>
		@endforeach
	@else
		<h4>{{$restaurant->title}} heeft op dit moment geen drinken te koop.</h4>
	@endif
	<hr>
	<h4>Bijgerechten</h4>
	@if(count($sides))
		@foreach($sides as $side)
			<div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
	            <div class="logo" style="float: left; margin-right: 20px">
	                <img src="{{asset('storage/'.$side->photo)}}" style="height: 180px; width: 180px;">
	            </div>
	            <div class="detailswrapper">
	                <h2 class="restaurantname" style="font-weight: bold;">{{$side->title}}</h2>
	                <h4 class="restaurantaddress">€{{$side->price}}, {{$side->category}}</h4>
	                <button style="float: right;"><i class="fas fa-cart-plus"></i>Toevoegen</button>
	            </div>
	        </div>
		@endforeach
	@else
		<h4>{{$restaurant->title}} heeft op dit moment geen bijgerechten te koop.</h4>
	@endif
	<hr>
</div>
@endsection
