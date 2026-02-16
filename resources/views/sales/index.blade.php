@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sales</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Record New Sale</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sales.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <h3>Total Sales: ${{ number_format($total_sales, 2) }}</h3>

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
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ $sale->inventory->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>${{ number_format($sale->total_price, 2) }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display: inline-block;">
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