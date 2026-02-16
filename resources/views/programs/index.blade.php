@extends('layouts.app')

@section('content')
    <h1>TV Programs</h1>
    <a href="{{ route('programs.create') }}" class="btn btn-primary">Add New Program</a>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->title }}</td>
                    <td>{{ $program->duration }} minutes</td>
                    <td>{{ $program->genre }}</td>
                    <td>
                        <a href="{{ route('programs.edit', $program) }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- Add delete button and other actions as needed -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection