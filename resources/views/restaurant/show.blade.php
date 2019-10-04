@extends('layouts.app')

@section('content')
<div class="restaurant-container">
	<img src="{{asset('storage/'.$restaurant->photo)}}" style="height: 20vh; width: auto; display: block; margin: auto;">
	<h2 style="text-align: center;">{{$restaurant->title}}</h2>
	<h3>Gerechten</h3>
	<hr>
	@auth
		@if(Auth::id() == $restaurant->user_id)
			<a href="{{route('consumable.create', ['restaurant_id' => $restaurant->id])}}" class="btn btn-primary">Versnapering toevoegen</a>
		@endif
	@endauth

</div>
@endsection
