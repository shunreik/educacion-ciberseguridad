<?php

namespace App\Http\Livewire\Content;

use App\Models\Questionnarie;
use Livewire\Component;

class QuestionnarieComponent extends Component
{
    public $questionnarieId;

    public function mount($questionnarie)
    {
        $this->questionnarieId = $questionnarie;
    }

    public function render()
    {
        $questionnarie = Questionnarie::findOrFail($this->questionnarieId);
        $questions = $questionnarie->questions;

        return view('livewire.content.questionnarie', [
            'questions' => $questions,
        ]);
    }
}
