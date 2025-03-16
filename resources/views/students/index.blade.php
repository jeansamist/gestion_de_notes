@extends('layouts.app')

@section('title', 'Students Dashboard')

@section('content')
    <h1 class="mb-4">Students Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Total Students -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Students</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>
        <!-- Average GPA -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Average GPA</div>
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $averageGpa ? number_format($averageGpa, 2) : 'N/A' }}
                    </h2>
                </div>
            </div>
        </div>
        <!-- Male Students -->
        <div class="col-md-2">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Male Students</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $maleCount }}</h2>
                </div>
            </div>
        </div>
        <!-- Female Students -->
        <div class="col-md-2">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Female Students</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $femaleCount }}</h2>
                </div>
            </div>
        </div>
        <!-- Other Gender -->
        <div class="col-md-2">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Other</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $otherCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-header">
            <h3>All Students</h3>
        </div>
        <div class="card-body">
            @if($students->isEmpty())
                <p>No students found.</p>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Matricule</th>
                        <th>Birth Date</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>GPA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><a href="{{ route("students.show", $student) }}">{{ $student->user->name ?? 'N/A' }}</a></td>
                        <td>{{ $student->matricule }}</td>
                        <td>{{ $student->birth_date }}</td>
                        <td>{{ ucfirst($student->gender) }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->gpa ? number_format($student->gpa, 2) : 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <button class="btn btn-primary mt-4" onclick="window.location.href = '{{ route('students.create') }}'">Add Student</button>
@endsection
