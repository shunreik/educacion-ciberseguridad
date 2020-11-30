<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StudentComponent extends Component
{
    use WithPagination;

    public function render()
    {
        //Se obtienen a los registros de estudiantes
        $students = User::role('estudiante')->orderBy('surname', 'asc')->paginate(10);

        return view('livewire.student-component',[
            'students' => $students,
        ]);
    }
}
