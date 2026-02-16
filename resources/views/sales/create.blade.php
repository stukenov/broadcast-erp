@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Record New Sale</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="inventory_id">Item</label>
            <select class="form-control" id="inventory_id" name="inventory_id" required>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->id }}">{{ $inventory->name }} (In stock: {{ $inventory->quantity }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Record Sale</button>
    </form>
</div>
@endsection