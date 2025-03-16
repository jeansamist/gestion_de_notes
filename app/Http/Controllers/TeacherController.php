<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index()
    {
        // Eager load the related user and subject data.
        $teachers = Teacher::with(['user', 'subject'])->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        // Get all subjects to populate the dropdown.
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'subject_id' => 'required|exists:subjects,id',
            'specialty'  => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        // Create a new user with role "teacher".
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt('password'), // Set a default password
            'role'     => 'teacher',
        ]);

        // Create the teacher record linked to the user.
        Teacher::create([
            'user_id'    => $user->id,
            'subject_id' => $validated['subject_id'],
            'specialty'  => $validated['specialty'] ?? null,
            'department' => $validated['department'] ?? null,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }
}
