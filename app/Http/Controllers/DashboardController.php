<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the administrator's dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse|View
     */
    public function showDashboard()
    {
        // Check if the user is authenticated; if not, redirect to the home page.
        if (!Auth::check()) {
            return redirect()->intended('/');
        }

        // Retrieve basic statistics.
        $studentCount = Student::count();
        $subjectCount = Subject::count();
        $gradeCount   = Grade::count();

        // Calculate the average grade (using 'grade' as the column name).
        $averageGrade = Grade::avg('grade');

        // Retrieve the 5 most recent grade entries.
        $recentGrades = Grade::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Retrieve the top 5 students based on a 'gpa' attribute.
        // Retrieve the top 5 students based on the average of their grades.
        $topStudents = Student::with('grades')
            ->get()
            ->sortByDesc(function ($student) {
                return $student->grades->avg('grade');
            })
            ->take(5);

        // Pass the data to the dashboard view.
        return view('dashboard', compact(
            'studentCount',
            'subjectCount',
            'gradeCount',
            'averageGrade',
            'recentGrades',
            'topStudents'
        ));
    }
}
