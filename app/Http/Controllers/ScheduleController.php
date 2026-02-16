<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Program;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('program')->orderBy('start_time')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('schedules.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($this->hasConflict($validatedData['start_time'], $validatedData['end_time'])) {
            return redirect()->back()->withInput()->withErrors(['conflict' => 'The selected time slot conflicts with an existing schedule.']);
        }

        Schedule::create($validatedData);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($this->hasConflict($validatedData['start_time'], $validatedData['end_time'], $schedule->id)) {
            return redirect()->back()->withInput()->withErrors(['conflict' => 'The selected time slot conflicts with an existing schedule.']);
        }

        $schedule->update($validatedData);

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    private function hasConflict($start_time, $end_time, $exclude_id = null)
    {
        $query = Schedule::where(function ($query) use ($start_time, $end_time) {
            $query->whereBetween('start_time', [$start_time, $end_time])
                ->orWhereBetween('end_time', [$start_time, $end_time])
                ->orWhere(function ($query) use ($start_time, $end_time) {
                    $query->where('start_time', '<=', $start_time)
                        ->where('end_time', '>=', $end_time);
                });
        });

        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }

        return $query->exists();
    }

    // Other CRUD methods (show, edit, destroy) can be added here
}