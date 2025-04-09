@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Subject</h1>
        
        <div class="card">
            <div class="card-header">
                Update Subject
            </div>
            <div class="card-body">
                <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update Subject</button>
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
