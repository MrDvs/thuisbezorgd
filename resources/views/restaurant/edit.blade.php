@extends('layouts.app')

@section('content')
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<form enctype="multipart/form-data" style="margin-top: 2vh" method="POST" action="{{ route('restaurant.update', ['restaurant' => $restaurant->id]) }}">
    @method('PATCH')
    @csrf
    <h3>Restaurant</h3>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Gegevens</h4>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="titleInput">Naam</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{$restaurant->title}}">
            </div>
            <div class="form-group">
                <label for="kvkInput">KVK nummer</label>
                <input type="number" class="form-control @error('kvk') is-invalid @enderror" id="kvkInput" name="kvk" value="{{$restaurant->kvk}}">
            </div>
            <div class="form-group">
                <label for="addressInput">Adres</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="addressInput" name="address" value="{{$restaurant->address}}">
            </div>
            <div class="form-group">
                <label for="zipcodeInput">Postcode</label>
                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcodeInput" name="zipcode" value="{{$restaurant->zipcode}}">
            </div>
            <div class="form-group">
                <label for="cityInput">Plaats</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="cityInput" name="city" value="{{$restaurant->city}}">
            </div>
            <div class="form-group">
                <label for="phoneInput">Telefoon nummer</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phoneInput" name="phone" value="{{$restaurant->phone}}">
            </div>
            <div class="form-group">
                <label for="emailInput">Email adres</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{$restaurant->email}}">
            </div>
            <div class="form-group">
                <label for="photoInput">Logo</label>
                <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photoInput" name="photo">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Bijwerken</button>
    </div>
</form>
<hr>
<div class="row">
    <div class="col-md-3">
        <h4>Vernsaperingen</h4>
    </div>
    <div class="col-md-9">
        <a href="{{route('consumable.create', ['restaurant_id' => $restaurant->id])}}" class="btn btn-primary" style="margin-bottom: 10px">Versnapering toevoegen</a>
        @foreach($restaurant->consumables as $consumable)
            <div class="restaurant clearfix" style="padding: 5px; background-color: #f5f5f5; margin: 15px 0; border-radius: 5px;">
                <div class="logo" style="float: left; margin-right: 20px">
                    <img src="{{asset('storage/'.$consumable->photo)}}" style="height: 180px; width: 180px;">
                </div>
                <div class="detailswrapper">
                    <h2 class="restaurantname" style="font-weight: bold;">{{$consumable->title}}</h2>
                    <h4 class="restaurantaddress">€{{$consumable->price}}</h4>

                    <form action="{{route('consumable.destroy', ['consumable' => $consumable])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Verwijderen</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
