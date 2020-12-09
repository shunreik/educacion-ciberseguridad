<?php

use App\Http\Controllers\ReadingController;
use App\Http\Livewire\Question\QuestionComponent;
use App\Http\Livewire\Questionnarie\QuestionnarieComponent;
use App\Http\Livewire\Reading\ReadingComponent;
use App\Http\Livewire\StudentComponent;
use App\Http\Livewire\TeacherComponent;
use App\Http\Livewire\Test\UploadImage;
use App\Http\Middleware\ReadingOwner;
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

Route::get('/', function(){
    return redirect()->route('dashboard');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('students', StudentComponent::class)->name('student')->middleware('can:manage.students');
    Route::get('teachers', TeacherComponent::class)->name('teacher')->middleware('can:manage.teachers');
    Route::get('readings', ReadingComponent::class)->name('reading')->middleware('can:manage.readings');
    Route::get('reading/create', [ReadingController::class, 'create'])->name('create.reading')->middleware('can:manage.readings');
    Route::get('reading/{reading}', [ReadingController::class, 'show'])->name('show.reading')->middleware('can:manage.readings');
    Route::post('reading/store', [ReadingController::class, 'store'])->name('store.reading')->middleware('can:manage.readings');
    Route::get('reading/edit/{reading}', [ReadingController::class, 'edit'])->name('edit.reading')->middleware('can:manage.readings');
    Route::put('reading/{reading}', [ReadingController::class, 'update'])->name('update.reading')->middleware('can:manage.readings');

    Route::get('questionnaries', QuestionnarieComponent::class)->name('questionnarie');
    Route::get('questionnarie/{reading}', QuestionComponent::class)->name('questions')->middleware([ReadingOwner::class]);
    
    Route::get('test', UploadImage::class);
});

Route::get('logout', function () {
    return abort(404);
});