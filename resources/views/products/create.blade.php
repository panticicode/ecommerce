@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Create a new Products</div>
    <div class="card-body">
		<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" value="{{ old('name') }}" name="name">
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="number" class="form-control" value="{{ old('price') }}" name="price">
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control" value="{{ old('image') }}" name="image">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" name="description" cols="30" rows="10">
					{{ old('description') }}
				</textarea>
			</div>
			<div class="form-group">
				<button class="form-control btn btn-success">
					Save Product
				</button>
			</div>	
		</form>															
	</div>
</div>
@endsection


