@extends('layout')
@section('content')
    <h1>Products List</h1>
    <hr>
    <a href="{{ route('products.create')}}"class="btn btn-primary mb-3">create Product</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('status') }}
            @endif
        </div> 
    <table class="table table-striped text-center" >
        <thead>
            <tr>
                <th>sku</th>
                <th>Name</th>
                <th>Price</th>
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
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection