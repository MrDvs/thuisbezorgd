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
		@if(count($orders))
			<div class="orders">
			    @foreach($orders as $key => $order)
			    	<div class="card" style="width: 18rem; float: left;">
					  <div class="card-body">
					    <h5 class="card-title">Order {{$key + 1}}</h5>
					    <h6 class="card-subtitle mb-2 text-muted">{{$order->created_at}}</h6>
					    <p class="card-text"></p>
					    <button type="button" class="card-link" data-toggle="modal" data-target="#orderModal{{$order->id}}">Order bekijken</button>
					  </div>
					</div>
		            <div class="modal fade" id="orderModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Order {{$key + 1}}</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
				        	<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Product</th>
							      <th scope="col">Prijs</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach($order->consumables as $consumable)
									<tr>
									  <td>{{$consumable->title}}</td>
									  <td>€{{$consumable->price}}</td>
									</tr>
							    @endforeach
							  </tbody>
							</table>
							<h5 style="font-weight: bold;">Total: €{{$order->total}}</h5>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
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
		                    <img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 180px; width: 180px;">
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
