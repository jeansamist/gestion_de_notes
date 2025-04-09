@extends('layouts.app')

@section('title', 'Students Dashboard')

@section('content')
 <h1 class="mb-4">Student Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $student->user->name }}
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Email:</strong> {{ $student->user->email }}</p>
            <p class="card-text"><strong>Matricule:</strong> {{ $student->matricule }}</p>
            <p class="card-text"><strong>Birth Date:</strong> {{ $student->birth_date }}</p>
            <p class="card-text"><strong>Gender:</strong> {{ ucfirst($student->gender) }}</p>
            <p class="card-text"><strong>Class:</strong> {{ $student->class }}</p>

            @if($student->profile_photo)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $student->profile_photo) }}" alt="{{ $student->user->name }}" class="img-thumbnail" style="max-width:200px;">
                </div>
            @endif

            <h3>Grades</h3>
            @if($student->grades->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Semester</th>
                            <th>School Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->grades as $grade)
                            <tr>
                                <td>{{ $grade->subject->name }}</td>
                                <td>{{ $grade->grade }}</td>
                                <td>{{ $grade->semester }}</td>
                                <td>{{ $grade->school_year }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No grades available.</p>
            @endif

            @if (Auth::user()->role === 'admin' OR Auth::user()->role === 'teacher')
                <div class="d-flex mt-4">
                    <a href="{{ route('grades.create', ['student_id' => $student->id]) }}" class="btn btn-success me-2">Add Grade</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning me-2">Edit Student</a>
                    
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-2">Delete Student</button>
                    </form>
                    
                    <a href="{{ route('students.index') }}" class="btn btn-primary">Back to Student List</a>
                </div>
            @endif
    </div>
@endsection
