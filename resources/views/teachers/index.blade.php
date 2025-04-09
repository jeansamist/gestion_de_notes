@extends('layouts.app')

@section('title', 'Teachers')

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td><a href="{{ route('teachers.show', $teacher->id) }}">{{ $teacher->user->name }}</a></td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->subject ? $teacher->subject->name : 'N/A' }}</td>
                        <td>{{ $teacher->specialty ?? 'N/A' }}</td>
                        <td>{{ $teacher->department ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No teachers found.</p>
    @endif

@endsection
