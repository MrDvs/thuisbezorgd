@extends('layouts.admin')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Naam</th>
      <th scope="col">Type</th>
      <th scope="col">Restaurant</th>
      <th scope="col">Bewerken</th>
      <th scope="col">Verwijderen</th>
    </tr>
  </thead>
  <tbody>
	@foreach($consumables as $consumable)
		<tr>
	      <th scope="row">{{$consumable->id}}</th>
	      <td>{{$consumable->title}}</td>
	      <td>{{$consumable->category}}</td>
	      <td>{{$consumable['restaurant']->title}}</td>
	      <td><a href="{{route('admin.consumables.edit', ['consumable' => $consumable->id])}}" class="btn btn-primary">Bewerken</a></td>
	      <td><a href="#" class="btn btn-danger">Verwijderen</a></td>
	    </tr>
	@endforeach
  </tbody>
</table>
@endsection
