@extends('layouts.app')

@section('content')
    <h1>Add New Program</h1>
    
    <form action="{{ route('programs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="duration">Duration (minutes)</label>
            <input type="number" class="form-control" id="duration" name="duration" required min="1">
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Program</button>
    </form>
@endsection