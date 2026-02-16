@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventory</h1>
    <a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">Add New Item</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->name }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td>${{ number_format($inventory->price, 2) }}</td>
                    <td>
                        <a href="{{ route('inventories.show', $inventory) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('inventories.edit', $inventory) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('inventories.destroy', $inventory) }}" method="POST" style="display: inline-block;">
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