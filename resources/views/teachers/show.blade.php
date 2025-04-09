@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Teacher Details</h1>
        
        <div class="card">
            <div class="card-header">
                {{ $teacher->user->name }}
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Email:</strong> {{ $teacher->user->email }}</p>
                <p class="card-text"><strong>Subject:</strong> {{ $teacher->subject->name }}</p>
                
                @if($teacher->specialty)
                    <p class="card-text"><strong>Specialty:</strong> {{ $teacher->specialty }}</p>
                @endif
                
                @if($teacher->department)
                    <p class="card-text"><strong>Department:</strong> {{ $teacher->department }}</p>
                @endif
                
                <div class="d-flex mt-4">
                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning me-2">Edit Teacher</a>
                    
                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-2">Delete Teacher</button>
                    </form>
                    
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary">Back to Teachers List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
