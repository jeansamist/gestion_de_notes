@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
    <div class="container">
        <h1 class="mb-4">Subjects</h1>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">All Subjects</h5>
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add New Subject</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(isset($subjects) && count($subjects) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Subject Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->code }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?')">
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
                    <p>No subjects found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
