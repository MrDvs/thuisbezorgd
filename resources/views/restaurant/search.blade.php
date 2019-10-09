@extends('layouts.app')

@section('content')
<h5 style="font-weight: bold;">Je hebt gezocht op "{{$query}}"</h5>
@if(count($results))
	<h4>Alle restaurants met "{{$query}}" in de naam</h4>
	<div class="restaurants">
	    @foreach($results as $result)
	        <a href="{{route('restaurant.show', ['restaurant' => $result->id])}}" style="text-decoration: none; color: #000;">
	            <div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
	                <div class="logo" style="float: left; margin-right: 20px">
	                    <img src="{{asset('storage/'.$result->photo)}}" style="height: 180px; width: 180px;">
	                </div>
	                <div class="detailswrapper">
	                    <h2 class="restaurantname" style="font-weight: bold;">{{$result->title}}</h2>
	                    <h4 class="restaurantaddress">{{$result->address}}, {{$result->city}}</h4>
	                </div>
	            </div>
	        </a>
	    @endforeach
	</div>
@else
	<h4>There where no results found for "{{$query}}"</h4>
@endif
@endsection