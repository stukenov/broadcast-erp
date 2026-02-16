@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User Role</h1>
    
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection