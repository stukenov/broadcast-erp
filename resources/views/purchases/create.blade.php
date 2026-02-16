@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Record New Purchase</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="inventory_id">Item</label>
            <select class="form-control" id="inventory_id" name="inventory_id" required>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
        </div>
        <div class="form-group">
            <label for="price">Price per Unit</label>
            <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Record Purchase</button>
    </form>
</div>
@endsection