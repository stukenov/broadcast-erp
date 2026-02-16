@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Management</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a>
    </div>

    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by name or email" name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit Role</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->appends(request()->query())->links() }}
</div>
@endsection