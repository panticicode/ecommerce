@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Product</div>
    <div class="card-body">
		<form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}{{ method_field('PUT') }}
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" value="{{ $product->name }}" name="name">
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="number" class="form-control" value="{{ $product->price }}" name="price">
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control" name="image">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" name="description" cols="30" rows="10">
				{{ $product->description }}
				</textarea>
			</div>
			<div class="form-group">
				<button class="form-control btn btn-success">
					Update Product
				</button>
			</div>	
		</form>															
	</div>
</div>
@endsection


