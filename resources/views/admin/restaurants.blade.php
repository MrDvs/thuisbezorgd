@extends('layouts.app')

@section('content')
<a href="{{route('admin.users')}}" class="btn btn-primary">Alle gebruikers</a>
<a href="{{route('admin.restaurants')}}" class="btn btn-primary">Alle restaurants</a>
<a href="{{route('admin.consumables')}}" class="btn btn-primary">Alle Alle versnaperingen</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Naam</th>
      <th scope="col">email</th>
      <th scope="col">Bewerken</th>
      <th scope="col">Verwijderen</th>
      <th scope="col">Bekijken</th>
    </tr>
  </thead>
  <tbody>
	@foreach($restaurants as $restaurant)
		<tr>
	      <th scope="row">{{$restaurant->id}}</th>
	      <td>{{$restaurant->title}}</td>
	      <td>{{$restaurant->email}}</td>
	      <td><a href="#" class="btn btn-primary">Bewerken</a></td>
	      <td><a href="#" class="btn btn-danger">Verwijderen</a></td>
	      <td><a href="#" class="btn btn-warning">Bekijken</a></td>
	    </tr>
	@endforeach
  </tbody>
</table>
@endsection
