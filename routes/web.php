<?php

use App\Http\Livewire\StudentComponent;
use App\Http\Livewire\TeacherComponent;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

Route::get('students', StudentComponent::class)->name('student')->middleware('auth', 'verified');
Route::get('teachers', TeacherComponent::class)->name('teacher')->middleware('auth', 'verified');