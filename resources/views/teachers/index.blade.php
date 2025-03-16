@extends('layouts.app')

@section('content')
    <h1>Teachers</h1>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">Add Teacher</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($teachers->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Specialty</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->user->name }}</td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->subject ? $teacher->subject->name : 'N/A' }}</td>
                        <td>{{ $teacher->specialty ?? 'N/A' }}</td>
                        <td>{{ $teacher->department ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No teachers found.</p>
    @endif

@endsection
