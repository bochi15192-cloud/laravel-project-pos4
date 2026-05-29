@extends('layout')
@section('content')
    <h1>Customer List</h1>
    <hr>
    <form action="{{ route('customers.store') }}" method="POST">
        
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">      
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Customer</button>
             <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </form>
        @endsection