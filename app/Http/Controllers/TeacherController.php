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
    
    /**
     * Display the specified teacher.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $teacher = Teacher::with(['user', 'subject'])->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }
    
    /**
     * Show the form for editing the specified teacher.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }
    
    /**
     * Update the specified teacher in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        
        // Validate the request data
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $teacher->user->id,
            'subject_id' => 'required|exists:subjects,id',
            'specialty'  => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);
        
        // Update user record
        $teacher->user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);
        
        // Update teacher record
        $teacher->update([
            'subject_id' => $validated['subject_id'],
            'specialty'  => $validated['specialty'] ?? null,
            'department' => $validated['department'] ?? null,
        ]);
        
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }
    
    /**
     * Remove the specified teacher from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $userId = $teacher->user_id;
        
        // First delete the teacher record
        $teacher->delete();
        
        // Then delete the associated user record
        User::destroy($userId);
        
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
