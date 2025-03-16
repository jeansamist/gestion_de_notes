@extends('layouts.app')

@section('title', 'Create Subject')

@section('content')
    <h1>Add Grade for {{ $student->user->name }}</h1>
  <form action="{{ route('grades.store') }}" method="POST">
    @csrf
    <!-- Pass student id as a hidden field -->
    <input type="hidden" name="student_id" value="{{ $student->id }}">

    <div class="mb-3">
      <label for="subject_id" class="form-label">Subject</label>
      <select name="subject_id" id="subject_id" class="form-select" required>
        <option value="">Select a Subject</option>
        @foreach($subjects as $subject)
          <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="grade" class="form-label">Grade</label>
      <input type="number" step="0.01" name="grade" id="grade" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="semester" class="form-label">Semester</label>
      <input type="text" name="semester" id="semester" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="school_year" class="form-label">School Year</label>
      <input type="text" name="school_year" id="school_year" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Add Grade</button>
    <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">Cancel</a>
  </form>
@endsection
