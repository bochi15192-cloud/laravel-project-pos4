@extends('layout')
@section('content')
    <h1>Products List</h1>
    <hr>
    <a href="{{ route('products.create')}}"class="btn btn-primary mb-3">create Product</a>
    <a href="/"class="btn btn-secondary mb-3">Back to Home page</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('status') }}
        </div>
        @endif 
        {{-- table table-bordered w-50 mx-auto text-center --}}
    <table class="table table-bordered text-center" >
        <thead>
            <tr>
                <th>sku</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                        @else
                            No Image
                        @endif
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary rounded-pill">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection