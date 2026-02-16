@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchases</h1>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">Record New Purchase</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('purchases.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <h3>Total Purchases: ${{ number_format($total_purchases, 2) }}</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $purchase->user->name }}</td>
                    <td>{{ $purchase->inventory->name }}</td>
                    <td>{{ $purchase->quantity }}</td>
                    <td>${{ number_format($purchase->total_price, 2) }}</td>
                    <td>
                        <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection