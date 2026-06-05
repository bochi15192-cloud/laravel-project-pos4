@extends('layout')
@section('content')
    <h1>Products List</h1>
    <hr>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" autofocus value="{{ old('sku') }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">      
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.25" value="{{ old('price', 0.00) }}" required>
        </div>
        <div class="form-group">      
            <label for="image">Product Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,">
        </div>
        <button type="submit" class="btn  btn-primary mt-2" >Add Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-2">Back</a>
        </form>

@endsection