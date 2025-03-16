<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get("/dashboard", [DashboardController::class, "showDashboard"])->middleware("auth")->name("dashboard");
Route::resource('students', StudentController::class)->middleware('auth');

Route::resource('teachers', TeacherController::class)->middleware('auth');
Route::get('/subjects', [SubjectController::class, 'create'])->middleware('auth')->name('subjects.create');
Route::post('/subjects', [SubjectController::class, 'store'])->middleware('auth')->name('subjects.store');
Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
