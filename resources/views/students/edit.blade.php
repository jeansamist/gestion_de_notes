@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Student</h1>
        
        <div class="card">
            <div class="card-header">
                Update Student Information
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $student->user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $student->user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="male" {{ (old('gender', $student->gender) == 'male') ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ (old('gender', $student->gender) == 'female') ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ (old('gender', $student->gender) == 'other') ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ old('class', $student->class) }}" required>
                        @error('class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        @if($student->profile_photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $student->profile_photo) }}" alt="{{ $student->user->name }}" class="img-thumbnail" style="max-width:150px;">
                                <p class="text-muted small">Current photo</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo">
                        <div class="form-text">Leave empty to keep the current photo.</div>
                        @error('profile_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update Student</button>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
