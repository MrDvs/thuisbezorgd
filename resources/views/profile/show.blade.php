@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success text-center">
        <h5>{{ session('status') }}</h5>
    </div>
@endif
<h3>Profiel</h3>
<hr>
<div class="row">
    <div class="col-md-3">
        <h4>Mijn gegevens</h4>
    </div>
    <div class="col-md-9">
        <h6>{{$user->email}}</h6>
        <h6>{{$user->name}}</h6>
        <h6>{{$user->phone}}</h6><br>
        <h6>{{$user->address}},</h6>
        <h6>{{$user->zipcode}} {{$user->city}}</h6>
       
        <a href="{{route('profile.edit', ['profile' => $user->id])}}">Persoonlijke gegevens bewerken ></a>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
		<h4>Mijn orders</h4>
	</div>
	<div class="col-md-9">
		@if(count($user->orders))
			<div class="orders">
			    @foreach($user->orders as $order)
		            {{$order->consumables}}
			    @endforeach
			</div>
		@else
			<h5>Je hebt geen orders.</h5>
		@endif
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
		<h4>Mijn restaurants</h4>
	</div>
	<div class="col-md-9">
		@if(count($user->restaurants))
			<div class="restaurants">
			    @foreach($user->restaurants as $restaurant)
		            <div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
		                <div class="logo" style="float: left; margin-right: 20px">
		                    <img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 20vh; width: auto;">
		                </div>
		                <div class="detailswrapper">
		                    <h3 class="restaurantname" style="font-weight: bold;">{{$restaurant->title}}</h3>
		                    <h4 class="restaurantaddress">{{$restaurant->address}}, {{$restaurant->city}}</h4>
		                </div>
		                <a href="{{route('restaurant.show', ['restaurant' => $restaurant->id])}}" class="btn btn-primary">Restaurant bekijken</a>
		                <a href="{{route('restaurant.edit', ['restaurant' => $restaurant->id])}}" class="btn btn-success">Restaurant bewerken</a>
		            </div>
			    @endforeach
			</div>
		@else
			<h5>Je hebt geen restaurants.</h5>
		@endif
		<a href="{{route('restaurant.create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Restaurant toevoegen</a>
	</div>
</div>

@endsection