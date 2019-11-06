@extends('layouts.app')

@section('content')
<h3>Orders</h3>
<hr>
	@if(count($orders))
		<div class="orders">
		    @foreach($orders as $key => $order)
		    	<div class="card" style="width: 18rem; float: left;">
				  <div class="card-body">
				    <h5 class="card-title">Order {{$key + 1}}</h5>
				    <h6 class="card-subtitle mb-2 text-muted">{{$order->created_at}}</h6>
				    <p class="card-text"></p>
				    <button type="button" class="card-link" data-toggle="modal" data-target="#orderModal{{$order->id}}">Order bekijken</button>
				  </div>
				</div>
	            <div class="modal fade" id="orderModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Order {{$key + 1}}</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
			        	<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">Product</th>
						      <th scope="col">Prijs</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach($order->consumables as $consumable)
								<tr>
								  <td>{{$consumable->title}}</td>
								  <td>€{{$consumable->price}}</td>
								</tr>
						    @endforeach
						  </tbody>
						</table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
		    @endforeach
		</div>
	@else
		<h5>Je hebt geen orders.</h5>
	@endif
	</div>
</div>
@endsection
