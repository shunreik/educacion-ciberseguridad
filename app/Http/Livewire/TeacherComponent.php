<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TeacherComponent extends Component
{
    use WithPagination;
    
    public $view = 'show';
    public $showMode = false,
        $createMode = false;
    public $name, $surname, $email;
    // public $alert = false;

    public function render()
    {
        $roleTeacher = Role::where('name', 'profesor')->first();
        $teachers = $roleTeacher->users()->paginate(10);

        return view('livewire.teacher.component', [
            'teachers' => $teachers,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        $this->createMode = true;
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $password = Str::random(8);
        $teacher = User::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'nickname' => $this->getFullName($this->name,  $this->surname),
            'email' => $this->email,
            'password' => Hash::make($password),
        ]);
        $teacher->assignRole('profesor');
        $this->default();
        session()->flash('success', 'Profesor registrado correctamente');
        // $this->alert = true;
    }

    public function getFullName($name, $surname){
        $first_name = explode(' ', $name);
        $last_name = explode(' ', $surname);
        return "$first_name[0] $last_name[0]";
    }

    public function default()
    {
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->createMode = false;
    }
}
