@extends('layout')
@section('content')
    <h1>Customer List</h1>
    <hr>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
        </div>
        <div class="form-group">      
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
         <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </form>
        @endsection