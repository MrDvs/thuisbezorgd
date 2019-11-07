@extends('layouts.admin')

@section('content')
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
	      <td><a href="{{route('admin.restaurants.edit', ['restaurant' => $restaurant->id])}}" class="btn btn-primary">Bewerken</a></td>
	      <td><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{$restaurant->id}}">Verwijderen</button></td>
	      <td><a href="{{route('restaurant.show', ['restaurant' => $restaurant->id])}}" class="btn btn-warning">Bekijken</a></td>
	    </tr>
	@endforeach
  </tbody>
</table>

{{ $restaurants->links() }}

@foreach($restaurants as $restaurant)
  <div class="modal fade" id="delete{{$restaurant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gegevens van {{$restaurant->title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Weet je zeker dat je {{$restaurant->title}} inclusief al hun versnaperingen wilt verwijderen?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
          <form action="{{route('admin.restaurants.destroy', ['restaurant' => $restaurant->id])}}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Ja</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
