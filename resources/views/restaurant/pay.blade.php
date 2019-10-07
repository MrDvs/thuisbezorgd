@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Prijs</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($cart as $cartItem)
		<tr>
		  <td>{{$cartItem->title}}</td>
		  <td>{{$cartItem->price}}</td>
		</tr>
    @endforeach
  </tbody>
</table>
Totaal: {{$total}}

@endsection