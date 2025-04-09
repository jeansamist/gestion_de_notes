@extends('layouts.app')

@section('title', 'Edit Grade')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Grade</h1>
        
        <div class="card">
            <div class="card-header">
                <h5>Edit Grade for {{ $student->user->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                            <option value="">Select a subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id', $grade->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="grade" class="form-label">Grade Value</label>
                        <input type="number" step="0.01" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" value="{{ old('grade', $grade->grade) }}" required>
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                            <option value="First Semester" {{ old('semester', $grade->semester) == 'First Semester' ? 'selected' : '' }}>First Semester</option>
                            <option value="Second Semester" {{ old('semester', $grade->semester) == 'Second Semester' ? 'selected' : '' }}>Second Semester</option>
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="school_year" class="form-label">School Year</label>
                        <input type="text" class="form-control @error('school_year') is-invalid @enderror" id="school_year" name="school_year" value="{{ old('school_year', $grade->school_year) }}" placeholder="e.g., 2024-2025" required>
                        @error('school_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update Grade</button>
                        <a href="{{ route('students.show', $grade->student_id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
