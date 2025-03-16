<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display the form for creating a new grade.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Retrieve the student id from the query parameter.
        $studentId = $request->get('student_id');
        $student = Student::with('user')->findOrFail($studentId);

        // Get all subjects to populate the dropdown.
        $subjects = Subject::all();

        return view('grades.create', compact('student', 'subjects'));
    }

    /**
     * Store a newly created grade in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request.
        $validatedData = $request->validate([
            'student_id'  => 'required|exists:students,id',
            'subject_id'  => 'required|exists:subjects,id',
            'grade'       => 'required|numeric',
            'semester'    => 'required|string',
            'school_year' => 'required|string'
        ]);

        // Create the new grade.
        Grade::create($validatedData);

        // Redirect back to the student's detail page with a success message.
        return redirect()->route('students.show', $validatedData['student_id'])
            ->with('success', 'Grade added successfully.');
    }
}
