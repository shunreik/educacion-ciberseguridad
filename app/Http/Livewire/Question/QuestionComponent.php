<?php

namespace App\Http\Livewire\Question;

use App\Models\Reading;
use Livewire\Component;

class QuestionComponent extends Component
{
    public $readingId, $title; //Se obtiene el id de la lectura sobre el cual se va a trabajar
    public $questionnarie;//Se obtiene el cuestionario de la lectura

    //Route Model Binding
    // En los componentes de Livewire, usa en mount()lugar de un constructor de clase __construct()como puede estar acostumbrado.
    public function mount(Reading $reading)
    {
        $this->readingId = $reading->id;
        $this->title = $reading->title;
        $this->questionnarie = $reading->questionnarie;
        
    }

    public function render(Reading $reading)
    {
        return view('livewire.question.component');
    }
}
