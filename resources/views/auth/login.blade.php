<!-- resources/views/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login Page')

@section('content')


    <div class="row justify-content-center">
            <div class="col-md-4">
                    <p>Bienvenue dans notre plateforme de gestion des notes. Connecter vous pour consulter vos resultats</p>
                <div class="card shadow-sm">
                    <div class="card-header text-center fw-bold">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                       value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
@endsection
