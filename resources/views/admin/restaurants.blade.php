@extends('layouts.app')

@section('content')
<a href="{{route('admin.users')}}" class="btn btn-primary">Alle gebruikers</a>
<a href="{{route('admin.restaurants')}}" class="btn btn-primary">Alle restaurants</a>
<a href="{{route('admin.consumables')}}" class="btn btn-primary">Alle Alle versnaperingen</a>
@foreach($restaurants as $restaurant)
	{{$restaurant->title}} <br>
@endforeach
@endsection
