<?php

namespace App\Http\Livewire\Questionnarie;

use Livewire\Component;
use Illuminate\Http\Request;

class QuestionnarieComponent extends Component
{
    public function render(Request $request)
    {
        $user = $request->user(); //se obtiene al usuario que está realizando la petición
        $readings = $user->readings()->latest()->paginate(10);

        return view('livewire.questionnarie.component', [
            'readings' => $readings,
        ]);
    }
}
