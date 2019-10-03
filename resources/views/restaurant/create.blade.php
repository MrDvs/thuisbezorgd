@extends('layouts.app')

@section('content')
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<form enctype="multipart/form-data" style="margin-top: 2vh" method="POST" action="{{ route('restaurant.store') }}">
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
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="kvkInput">KVK nummer</label>
                <input type="number" class="form-control @error('kvk') is-invalid @enderror" id="kvkInput" name="kvk" value="{{old('kvk')}}">
            </div>
            <div class="form-group">
                <label for="addressInput">Adres</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="addressInput" name="address" value="{{old('address')}}">
            </div>
            <div class="form-group">
                <label for="zipcodeInput">Postcode</label>
                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcodeInput" name="zipcode" value="{{old('zipcode')}}">
            </div>
            <div class="form-group">
                <label for="cityInput">Plaats</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="cityInput" name="city" value="{{old('city')}}">
            </div>
            <div class="form-group">
                <label for="phoneInput">Telefoon nummer</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phoneInput" name="phone" value="{{old('phone')}}">
            </div>
            <div class="form-group">
                <label for="emailInput">Email adres</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="photoInput">Logo</label>
                <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photoInput" name="photo">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Aanmaken</button>
    </div>
</form>
@endsection