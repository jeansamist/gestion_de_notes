@extends('layouts.app')

@section('title', 'Create Subject')

@section('content')
    <h1>Create Subject</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Subject Creation Form -->
    <form action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter subject name" required>
        </div>


        <button type="submit" class="btn btn-primary mt-4">Create Subject</button>
    </form>
@endsection
