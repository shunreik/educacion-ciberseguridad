<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use App\Models\Questionnarie;
use App\Models\Reading;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionComponent extends Component
{
    use WithPagination;

    //Reading
    public $reading; //se obtiene al objeto lectura sobre el cual se va a trabajar
    public $questionnarie; //Se obtiene el cuestionario de la lectura
    //Question
    public $questionId, $questionContent;
    //Options

    //Answer

    //Modes
    public $createQuestionMode = false, $editQuestionMode = false;
    //Vista
    public $view = 'question.create';

    //Route Model Binding
    // En los componentes de Livewire, usa en mount()lugar de un constructor de clase __construct()como puede estar acostumbrado.
    public function mount(Reading $reading)
    {
        $this->reading = $reading;
        $this->questionnarie = $reading->questionnarie;
    }

    public function render()
    {
        $questions = $this->questionnarie ? $this->questionnarie->questions()->latest()->paginate(5) : null;
        return view('livewire.question.component', [
            'questions' => $questions,
        ]);
    }

    public function createQuestion()
    {
        $this->view = 'question.create';
        $this->questionContent = '';
        $this->createQuestionMode = true;
    }

    public function storeQuestion()
    {
        if (is_null($this->questionnarie)) {
            $newQuestionnarie = new Questionnarie();
            $this->questionnarie = $this->reading->questionnarie()->save($newQuestionnarie);
        }

        $this->validate([
            'questionContent' => ['required', 'string', 'max:255'],
        ]);

        $question = new Question();
        $question->content = $this->questionContent;

        $this->questionnarie->questions()->save($question);
        $this->createQuestionMode = false;
        $this->questionContent = '';
    }

    public function editQuestion($id)
    {
        $this->resetErrorBag('questionContent'); //Se limpia la validación del contenido de la pregunta

        $question = Question::find($id);
        $this->questionId = $question->id;
        $this->questionContent = $question->content;

        $this->view = 'question.edit';
        $this->editQuestionMode = true;
    }

    public function updateQuestion()
    {
        $this->validate([
            'questionContent' => ['required', 'string', 'max:255'],
        ]);

        $question = Question::find($this->questionId);
        $question->content = $this->questionContent;

        $this->questionnarie->questions()->save($question);
        $this->editQuestionMode = false;
        $this->questionContent = '';
    }
}
