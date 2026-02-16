<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|max:255',
        ]);

        Program::create($validatedData);

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    // Other CRUD methods (show, edit, update, destroy) can be added here
}