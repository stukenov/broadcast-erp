@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Inventory Item</h1>
    
    <form action="{{ route('inventories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="0">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection