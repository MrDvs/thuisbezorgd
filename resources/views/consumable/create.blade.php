@extends('layouts.app')

@section('content')
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<form enctype="multipart/form-data" style="margin-top: 2vh" method="POST" action="{{ route('consumable.store', ['restaurant_id' => $id]) }}">
    @csrf
    <h3>Versnaperingen</h3>
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
                <label for="priceInput">Prijs</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="priceInput" name="price" value="{{old('price')}}">
            </div>
            <div class="form-group">
                <label for="categoryInput">Categorie</label>
                <select name="category" id="categoryInput" class="form-control">
                    <option value="Eten">Eten</option>
                    <option value="Drinken">Drinken</option>
                    <option value="Bijgerecht">Bijgerecht</option>
                </select>
            </div>
            <div class="form-group">
                <label for="photoInput">Afbeelding</label>
                <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photoInput" name="photo">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </div>
</form>
@endsection
