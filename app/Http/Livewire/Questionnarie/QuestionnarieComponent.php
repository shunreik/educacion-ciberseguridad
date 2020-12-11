<?php

namespace App\Http\Livewire\Questionnarie;

use App\Models\Questionnarie;
use Livewire\Component;
use Illuminate\Http\Request;

class QuestionnarieComponent extends Component
{
    public $readingId, $questionnarieId;
    public $confirmEditModal = false;
    public $view = 'confirmEdit';

    public function render(Request $request)
    {
        $user = $request->user(); //se obtiene al usuario que está realizando la petición
        $readings = $user->readings()->latest()->paginate(10);

        return view('livewire.questionnarie.component', [
            'readings' => $readings,
        ]);
    }

    public function questionnarie($id)
    {
        return redirect()->route('questions', $id);
    }

    public function confirmEdit($readingId, $questionnarieId)
    {
        $this->readingId = $readingId;
        $this->questionnarieId = $questionnarieId;
        $this->confirmEditModal = true;
    }

    public function privateQuestionnarie()
    {
        $questionnarie = Questionnarie::find($this->questionnarieId);
        $questionnarie->status = false;
        $questionnarie->save();

        return redirect()->route('questions', $this->readingId);
    }
}
