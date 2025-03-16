<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Total number of students.
        $totalStudents = Student::count();

        // Retrieve all students with the related user data.
        $students = Student::with('user')->orderBy('id', 'asc')->get();
        // Calculate the average GPA (if the 'gpa' column exists).
        $averageGpa = Grade::avg('grade');

        // Count students by gender.
        $maleCount   = Student::where('gender', 'male')->count();
        $femaleCount = Student::where('gender', 'female')->count();
        $otherCount  = Student::where('gender', 'other')->count();


        return view('students.index', compact(
            'totalStudents',
            'averageGpa',
            'maleCount',
            'femaleCount',
            'otherCount',
            'students'
        ));
    }
    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data.
        $validatedData = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'birth_date'     => 'required|date',
            'gender'         => 'required|in:male,female,other',
            'class'          => 'required|string|max:255',
            'profile_photo'  => 'nullable|image|max:2048',
        ]);

        // Create a new user record for the student.
        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => bcrypt('password'), // Default password
            'role'     => 'student',
        ]);

        // Handle file upload if provided.
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        } else {
            $profilePhotoPath = null;
        }

        // Create the student record associated with the user.
        Student::create([
            'user_id'       => $user->id,
            'matricule'     => uniqid(),
            'birth_date'    => $validatedData['birth_date'],
            'gender'        => $validatedData['gender'],
            'class'         => $validatedData['class'],
            'profile_photo' => $profilePhotoPath,
        ]);

        // Redirect to a student list page (adjust the route as needed) with a success message.
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
    /**
     * Display the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the student along with the related user data.
        $student = Student::with(['user', 'grades.subject'])->findOrFail($id);
        return view('students.show', compact('student'));
    }
}
