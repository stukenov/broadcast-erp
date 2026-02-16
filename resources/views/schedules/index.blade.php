@extends('layouts.app')

@section('content')
    <h1>TV Schedule</h1>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">Add New Schedule</a>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Program</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->program->title }}</td>
                    <td>{{ $schedule->start_time->format('Y-m-d H:i') }}</td>
                    <td>{{ $schedule->end_time->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">Edit</a>
                        <!-- Add delete button and other actions as needed -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection