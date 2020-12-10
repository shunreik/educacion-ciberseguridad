<?php

namespace App\Http\Livewire\Question;

use App\Models\Answer;
use App\Models\Option;
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
    //Mode - Question
    public $createQuestionMode = false, $editQuestionMode = false;
    //Answer
    public $answerId, $answerContent;
    //Mode - Answer
    public $createAnswerMode = false, $editAnswerMode = false;
    //Options
    public $optionId, $optionContent;
    //Mode - Answer
    public $createOptionMode = false, $editOptionMode = false;
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

    public function createAnswer($id)
    {
        $this->resetErrorBag('answerContent');

        $question = Question::find($id);
        $this->questionId = $question->id;
        $this->questionContent = $question->content;
        $this->view = 'answer.create';
        $this->createAnswerMode = true;
        $this->answerContent = '';
    }

    public function storeAnswer()
    {
        $this->validate([
            'answerContent' => ['required', 'string', 'max:255'],
        ]);

        $answer = new Answer();
        $answer->content = $this->answerContent;

        $question = Question::find($this->questionId);
        $question->answer()->save($answer);

        $this->createAnswerMode = false;
        $this->answerContent = '';
    }

    public function editAnswer($id)
    {
        $this->resetErrorBag('answerContent');

        $question = Question::find($id);
        $this->questionId = $question->id;
        $this->questionContent = $question->content;
        $this->answerContent = $question->answer->content;
        $this->answerId = $question->answer->id;
        $this->view = 'answer.edit';
        $this->editAnswerMode = true;
    }

    public function updateAnswer()
    {
        $this->validate([
            'answerContent' => ['required', 'string', 'max:255'],
        ]);

        $answer = Answer::find($this->answerId);
        $answer->content = $this->answerContent;
        $answer->save();

        $this->editAnswerMode = false;
        $this->answerContent = '';
    }

    public function createOption($id)
    {
        $this->resetErrorBag('optionContent');

        $question = Question::find($id);
        $this->questionId = $question->id;
        $this->questionContent = $question->content;
        $this->view = 'option.create';
        $this->createOptionMode = true;
        $this->optionContent = '';
    }

    public function storeOption()
    {
        $this->validate([
            'optionContent' => ['required', 'string', 'max:255'],
        ]);

        $option = new Option();
        $option->content = $this->optionContent;

        $question = Question::find($this->questionId);
        $question->options()->save($option);

        $this->createOptionMode = false;
        $this->optionContent = '';
    }

    public function editOption($id)
    {
        $this->resetErrorBag('optionContent');

        $option = Option::find($id);
        $this->optionId = $option->id;
        $this->optionContent = $option->content;
        $this->questionContent = $option->question->content;

        $this->view = 'option.edit';
        $this->editOptionMode = true;
    }

    public function updateOption()
    {
        $this->validate([
            'optionContent' => ['required', 'string', 'max:255'],
        ]);

        $option = Option::find($this->optionId);
        $option->content = $this->optionContent;
        $option->save();

        $this->editOptionMode = false;
        $this->optionContent = '';
    }
}
