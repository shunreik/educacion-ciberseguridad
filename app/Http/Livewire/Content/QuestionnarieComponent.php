<?php

namespace App\Http\Livewire\Content;

use App\Models\Questionnarie;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class QuestionnarieComponent extends Component
{
    public $questionnarieId;
    public $questionForm;

    public $pregunta;

    public function mount($questionnarie)
    {
        $this->questionnarieId = $questionnarie;
        $this->questionForm = $this->createForm();
    }

    public function render()
    {
        // $questionnarie = Questionnarie::findOrFail($this->questionnarieId);
        // $questions = $questionnarie->questions;
        // $this->createForm();
        // $this->questionForm = $this->createForm();

        return view('livewire.content.questionnarie', [
            // 'questions' => $questions,
        ]);
    }

    public function createForm()
    {

        //Procedo a obtener las preguntas del cuestionarios
        $questionnarie = Questionnarie::findOrFail($this->questionnarieId);
        $questions = $questionnarie->questions;

        $questionForm = [];

        $index = 1;

        foreach ($questions as $question) {

            $options = $question->options;
            $answer = collect($question->answer()->get()); //para que se almacene el objeto de clase Answer

            $concat = $options->concat($answer); //Se concatena las dos collecionres
            $concat = $concat->shuffle(); // se mezclan randónicamente las opciones y respuesta

            $questionForm['pregunta_' . $index] = [
                'question' => $question,
                'options' => $concat->all(),
            ];

            $index++;
        }

        // dd($questionForm);
        return $questionForm;
    }

    public function submit()
    {
        $this->validate([
            // 'pregunta' => 'required|array|max:3',
            'pregunta.*' => 'required',
        ]);

        // dd($validatedData);
        dd($this->pregunta);
    }
}
