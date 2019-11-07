@extends('layouts.app')

@section('content')
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<form enctype="multipart/form-data" style="margin-top: 2vh" method="POST" action="{{ route('admin.consumables.update', ['consumable' => $consumable->id]) }}">
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
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{$consumable->title}}">
            </div>
            <div class="form-group">
                <label for="priceInput">Prijs</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="priceInput" name="price" value="{{$consumable->price}}">
            </div>
            <div class="form-group">
                <label for="categoryInput">Categorie</label>
                <select name="category" id="categoryInput" class="form-control">
                    <option value="1" @if($consumable->category == 1) selected="selected" @endif>Eten</option>
                    <option value="2" @if($consumable->category == 2) selected="selected" @endif>Drinken</option>
                    <option value="3" @if($consumable->category == 3) selected="selected" @endif>Bijgerecht</option>
                </select>
            </div>
            <div class="form-group">
                <label for="photoInput">Afbeelding</label>
                <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photoInput" name="photo">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Bijwerken</button>
    </div>
</form>
@endsection
