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

    /**
     * Show the form for editing the specified grade.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $student = Student::with('user')->findOrFail($grade->student_id);
        $subjects = Subject::all();
        
        return view('grades.edit', compact('grade', 'student', 'subjects'));
    }

    /**
     * Update the specified grade in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::findOrFail($id);
        
        // Validate incoming request.
        $validatedData = $request->validate([
            'subject_id'  => 'required|exists:subjects,id',
            'grade'       => 'required|numeric',
            'semester'    => 'required|string',
            'school_year' => 'required|string'
        ]);

        // Update the grade.
        $grade->update($validatedData);

        // Redirect back to the student's detail page with a success message.
        return redirect()->route('students.show', $grade->student_id)
            ->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $studentId = $grade->student_id;
        
        // Delete the grade
        $grade->delete();

        // Redirect back to the student's detail page with a success message.
        return redirect()->route('students.show', $studentId)
            ->with('success', 'Grade deleted successfully.');
    }
}
