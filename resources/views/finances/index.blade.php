@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Financial Records</h1>
    <a href="{{ route('finances.create') }}" class="btn btn-primary mb-3">Add New Record</a>
    <a href="{{ route('finances.report') }}" class="btn btn-info mb-3">View Financial Report</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('finances.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('finances.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="row mb-3">
        <div class="col-md-4">
            <h3>Total Income: ${{ number_format($total_income, 2) }}</h3>
        </div>
        <div class="col-md-4">
            <h3>Total Expense: ${{ number_format($total_expense, 2) }}</h3>
        </div>
        <div class="col-md-4">
            <h3>Net Profit: ${{ number_format($net_profit, 2) }}</h3>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finances as $finance)
                <tr>
                    <td>{{ $finance->date->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($finance->type) }}</td>
                    <td>${{ number_format($finance->amount, 2) }}</td>
                    <td>{{ $finance->description }}</td>
                    <td>
                        <a href="{{ route('finances.edit', $finance) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('finances.destroy', $finance) }}" method="POST" style="display: inline-block;">
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