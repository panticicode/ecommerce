@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">
	<table class="table table-hover">
		<thead>
			<th>Image</th>
			<th>Name</th>
			<th>Price</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
       	<tbody>
		@foreach($products as $product)
		<tr>
			<td>
				<img style="width: 70px; height: 70px" src="{{ asset($product->image) }}" alt="">
			</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->price }}</td>
			<td>
				<a class="btn btn-info" href="{{ route('products.edit', ['id' => $product->id]) }}">
					<i class="fas fa-edit"></i>
				</a>
			</td>
			<td>
				<form method="POST" action="{{ route('products.destroy', ['id' => $product->id]) }}">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}
				<button class="btn btn-danger" href="">
					<i class="fas fa-trash-alt"></i>
				</button>	
				</form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
	</div>
</div>
@endsection


