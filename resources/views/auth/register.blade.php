@extends('layouts/app')

@section('content')

@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<form enctype="multipart/form-data" style="margin-top: 2vh" method="POST" action="{{ route('register') }}">
    @csrf
    <h3>Registreren</h3>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Account</h4>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="emailInput">Email adres</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{old('email')}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password">
                </div>
                <div class="form-group col-md-6">
                    <label for="repeatpasswordInput">Repeat password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="repeatpasswordInput" name="password_confirmation">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>Personal information</h4>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="nameInput">Naam</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="addresstInput">Adres</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="addressInput" name="address" value="{{old('address')}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cityInput">Plaats</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="cityInput" name="city" value="{{old('city')}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcodeInput">Postcode</label>
                    <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcodeInput" name="zipcode" value="{{old('zipcode')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="phoneInput">Telefoon nummer</label>
                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phoneInput" name="phone" value="{{old('phone')}}">
            </div>
            
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Registreren</button>
</form>

@endsection