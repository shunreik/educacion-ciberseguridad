<?php

use App\Http\Livewire\Reading\ReadingComponent;
use App\Http\Livewire\StudentComponent;
use App\Http\Livewire\TeacherComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('students', StudentComponent::class)->name('student')->middleware('can:manage.students');
    Route::get('teachers', TeacherComponent::class)->name('teacher')->middleware('can:manage.teachers');
    Route::get('readings', ReadingComponent::class)->name('reading');
});

Route::get('logout', function () {
    return abort(404);
});