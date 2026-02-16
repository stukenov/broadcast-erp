@extends('layouts.app')

@section('content')
    <h1>Add New Schedule</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="program_id">Program</label>
            <select class="form-control" id="program_id" name="program_id" required>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Schedule</button>
    </form>
@endsection