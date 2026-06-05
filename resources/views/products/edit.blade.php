@extends('layout')
@section('content')
    <h1>Products List</h1>
    <hr>
    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data"> >
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}" autofocus required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">      
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">      
            <label for="image">Product Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </form>
@endsection