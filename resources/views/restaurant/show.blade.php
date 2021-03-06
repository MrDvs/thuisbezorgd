@extends('layouts.app')

@section('content')
{{session()->put('consumables', [])}}
<div class="row">
	<div class="col-md-9">
		<div class="restaurant-container">
			<img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 180px; width: 180px; display: block; margin: auto;">
			<h2 class="text-center">{{$restaurant->title}}</h2>
			<h4 class="text-center">{{$restaurant->address}}</h4>
			<h4 class="text-center">{{$restaurant->zipcode}}, {{$restaurant->city}}</h4>
			@if(!$isOpen)
			<h4 class="text-center">{{$restaurant->title}} opent om {{$restaurant->openingtimes->open}}. Je kunt nu niks bestellen.</h4>
			@endif
			<h3>Gerechten</h3>
			<hr>
			<h4>Eten</h4>
			@if(count($foods))
				@foreach($foods as $food)
					<div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
			            <div class="logo" style="float: left; margin-right: 20px">
			                <img src="{{asset('storage/'.$food->photo)}}" style="height: 180px; width: 180px;">
			            </div>
			            <div class="detailswrapper">
			                <h2 class="restaurantname" style="font-weight: bold;">{{$food->title}}</h2>
			                <h4 class="restaurantaddress">€{{$food->price}}</h4>
			                @auth
			                @if($isOpen)
			                <a class="add-to-cart" id="{{$food->category}}-{{$food->id}}" style="float: right;" href="{{route('cart.add', ['id' => $food->id])}}"><i class="fas fa-cart-plus"></i>Toevoegen</a>
			                @endif
			                @endauth
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
			                <h4 class="restaurantaddress">€{{$drink->price}}</h4>
			                @auth
			                @if($isOpen)
			                <a class="add-to-cart" id="{{$drink->category}}-{{$drink->id}}" style="float: right;" href="{{route('cart.add', ['id' => $drink->id])}}"><i class="fas fa-cart-plus"></i>Toevoegen</a>
			                @endif
			                @endauth
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
			                <h4 class="restaurantaddress">€{{$side->price}}</h4>
			                @auth
			                @if($isOpen)
			                <a class="add-to-cart" id="{{$side->category}}-{{$side->id}}" style="float: right;" href="{{route('cart.add', ['id' => $side->id])}}"><i class="fas fa-cart-plus"></i>Toevoegen</a>
			                @endif
			                @endauth
			            </div>
			        </div>
				@endforeach
			@else
				<h4>{{$restaurant->title}} heeft op dit moment geen bijgerechten te koop.</h4>
			@endif
			<hr>
		</div>
	</div>
	@auth
	@if($isOpen)
	<div class="col-md-3">
		<div class="cart" style="position: fixed; border: 1px solid black; width: 400px">
			<h5 class="text-center">Winkelwagen</h5>
			<hr>
			<ul class="list-group" id="cart" style="list-style: none;">
			</ul>
			<a href="{{route('checkout', ['id' => $restaurant->id])}}" class="btn btn-secondary">Afrekenen</a>
		</div>
	</div>
	@endif
	@endauth
</div>

<script type="application/javascript">
	$('.add-to-cart').click(function(event) {
	    event.preventDefault();
	    id = $(this).prop('id')
	    $.ajax({
	    	url: $(this).prop('href'),
	    	type: "GET",
		}).done(function(data) {
			console.log(data);
			$('#cart').append('<li class="list-group-item">'+data+'</li>')
		});
	});
</script>
@endsection
