<?php

use App\Http\Controllers\addStudentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\studentsController;
use App\Models\classItem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/students',[studentsController::class,'index'])->middleware(['auth','verified'])->name('students');
Route::delete('/students/{id}', [studentsController::class, 'destroy'])->name('students.destroy');
Route::get('/addstudents',[addStudentsController::class,'index'])->middleware(['auth','verified'])->name('addstudents');
Route::post('/addstudents/store',[addStudentsController::class,'store'])->middleware(['auth','verified'])->name('addstudents.store');
Route::get('/addstudents/{id}/edit',[addStudentsController::class,'edit'])->middleware(['auth','verified'])->name('addstudents.edit');
Route::put('/addstudents/{id}',[addStudentsController::class,'update'])->middleware(['auth','verified'])->name('addstudents.update');
// Route::get('/addstudent',[studentsController::class,'getClassItem'])->name('classItems');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
