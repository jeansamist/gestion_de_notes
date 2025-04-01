<!-- resources/views/login.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <!-- Students Card -->
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Students</div>
            <div class="card-body">
                <h2 class="card-title">{{ $studentCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Subjects Card -->
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Subjects</div>
            <div class="card-body">
                <h2 class="card-title">{{ $subjectCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Grades Card -->
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">Grades</div>
            <div class="card-body">
                <h2 class="card-title">{{ $gradeCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Average Grade Card -->
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Average Grade</div>
            <div class="card-body">
                <h2 class="card-title">{{ number_format($averageGrade, 2) }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Recent Grades Table -->
<h3 class="mt-5">Recent Grades</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>Grade</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recentGrades as $grade)
        <tr>
            <td>{{ $grade->student->name ?? 'N/A' }}</td>
            <td>{{ $grade->subject->name ?? 'N/A' }}</td>
            <td>{{ $grade->grade }}</td>
            <td>{{ $grade->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
