<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnarie;
use App\Models\Score;
use App\Models\StudentResponse;
use App\Rules\OptionExists;
use Illuminate\Http\Request;

class QuestionnarieController extends Controller
{
    //

    public function show(Questionnarie $questionnarie)
    {

        $questions = $questionnarie->questions;
        $questionnarieForm = [];
        $index = 0;

        foreach ($questions as $question) {
            $options = $question->options;

            $answer = collect($question->answer()->get()); //para que se almacene el objeto de clase Answer
            $concat = $options->concat($answer); //Se concatena las dos colleciones
            $concat = $concat->shuffle(); // se mezclan randónicamente las opciones y respuesta

            $questionnarieForm[$index] = [
                'question' => $question,
                'options' => $concat->all(),
            ];

            $index++;
        }

        return view('livewire.content.questionnarie', [
            'questionnarieForm' => $questionnarieForm,
            'questionnarie' => $questionnarie
        ]);
    }

    public function store(Questionnarie $questionnarie, Request $request)
    {
        $questions = $questionnarie->questions;

        //Se debe generar un regla de validación acorde la cantidad de preguntas en el cuestionario
        $rules = [];
        $attributes = [];
        $messages = [];
        $index = 1;

        foreach ($questions as $question) {
            $rules += [
                "$question->id" => ['required', new OptionExists($question->answer, $question->options)],
            ];
            $messages += [
                "$question->id.required" => "La :attribute es obligatoria"
            ];
            $attributes += [
                "$question->id" => "pregunta $index",
            ];
            $index++;
        }

        $validated = $request->validate($rules, $messages, $attributes);

        // dd($validated);
        //Proceso de la calificación o nota
        $numberOfQuestions = count($questions);
        $correctAnswers = 0;

        //Se crear una instancia de la clase de score
        $score = new Score();
        $score->user_id = $request->user()->id;
        $score->questionnarie_id = $questionnarie->id;
        $score->qualification = $correctAnswers;
        $score->save();

        foreach ($validated as $questionId => $answerId) {
            $question = Question::find($questionId);

            if ($question->answer->id === $answerId) {
                $correctAnswers++;
            }

            $studentResponse = new StudentResponse();
            $studentResponse->uuid_question = $question->id;
            $studentResponse->uuid_response = $answerId;
            $score->studentResponses()->save($studentResponse);
            // var_dump("Pregunta: $question", "Respuesta: $answer");
        }

        $qualification = round($correctAnswers * (10 / $numberOfQuestions), 1); //Se redondea a dos décimales
        $score->qualification = $qualification;//Se actualiza la nota del registro
        $score->save();
        dd("Tu calificación es: $qualification", $validated);
        //Se debe redirigir a la vista de calificaciones
    }
}
