<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class QualificationController extends Controller
{
    use WithPagination;

    public function index()
    {
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        $scores = $user->scores()->latest()->paginate(10);
        return view('livewire.qualification.index', [
            'scores' => $scores,
        ]);
    }

    public function show(Score $score)
    {
        $questionnarie = $score->questionnarie;
        $questions = $questionnarie->questions;
        $studentResponses = $score->studentResponses;

        return view('livewire.qualification.show', [
            'score' => $score,
            'questions' => $questions,
            'studentResponses' => $studentResponses,
        ]);
    }
}
