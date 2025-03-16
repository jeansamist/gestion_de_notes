@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
    <h1 class="mb-4">Create Student</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check the form for errors.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Student creation form -->
    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter student name" value="{{ old('name') }}" required>
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" value="{{ old('email') }}" required>
        </div>

        <!-- Birth Date Field -->
        <div class="mb-3">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ old('birth_date') }}" required>
        </div>

        <!-- Gender Field -->
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select" required>
                <option value="">Select gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <!-- Class Field -->
        <div class="mb-3">
            <label for="class" class="form-label">Class</label>
            <input type="text" name="class" class="form-control" id="class" placeholder="Enter class" value="{{ old('class') }}" required>
        </div>

        <!-- Profile Photo Field -->
        <div class="mb-3">
            <label for="profile_photo" class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo" class="form-control" id="profile_photo">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Student</button>
    </form>
@endsection
