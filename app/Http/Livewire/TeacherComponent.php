<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class TeacherComponent extends Component
{
    public function render()
    {
        $roleTeacher = Role::where('name', 'profesor')->first();
        $teachers = $roleTeacher->users()->paginate(10);

        return view('livewire.teacher.component', [
            'teachers' => $teachers,
        ]);
    }
}
