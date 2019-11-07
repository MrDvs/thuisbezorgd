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
      <th scope="col">Orders</th>
    </tr>
  </thead>
  <tbody>
	@foreach($users as $user)
		<tr>
	      <th scope="row">{{$user->id}}</th>
	      <td>{{$user->name}}</td>
	      <td>{{$user->email}}</td>
	      <td><a href="{{route('admin.profiles.edit', ['profile' => $user->id])}}" class="btn btn-primary">Bewerken</a></td>
        <td><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{$user->id}}">Verwijderen</button></td>
        <td><button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal{{$user->id}}">Bekijken</button></td>
        <td><a href="{{route('admin.orders', ['id' => $user->id])}}" class="btn btn-warning">Orders</a></td>
	    </tr>
	@endforeach
  </tbody>
</table>

{{ $users->links() }}

@foreach($users as $user)
  <div class="modal fade" id="modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gegevens van {{$user->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
              <tr>
                <td>ID:</td>
                <td>{{$user->id}}</td>
              </tr>
              <tr>
                <td>Naam:</td>
                <td>{{$user->name}}</td>
              </tr>
              <tr>
                <td>Email:</td>
                <td>{{$user->email}}</td>
              </tr>
              <tr>
                <td>Adres:</td>
                <td>{{$user->address}}</td>
              </tr>
              <tr>
                <td>Postcode:</td>
                <td>{{$user->zipcode}}</td>
              </tr>
              <tr>
                <td>Stad:</td>
                <td>{{$user->city}}</td>
              </tr>
              <tr>
                <td>Tel. nummer:</td>
                <td>{{$user->phone}}</td>
              </tr>
              <tr>
                <td>Admin:</td>
                <td>{{$user->is_admin}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gegevens van {{$user->name}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Weet je zeker dat je {{$user->name}} wilt verwijderen?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
          <form action="{{route('admin.profiles.destroy', ['profile' => $user->id])}}" method="POST">
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
