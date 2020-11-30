<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class StudentComponent extends Component
{
    use WithPagination;

    public $view = "show";
    public $confirmingDisable, $confirmingActive = false;

    public $userId, $username;

    public function render()
    {
        //Se obtienen a los registros de estudiantes
        $students = User::role('estudiante')->orderBy('surname', 'asc')->paginate(10);
        return view('livewire.student.component', [
            'students' => $students,
        ]);
    }

    public function confirmDisable($id){
        $this->view = 'disable';
        $student = User::find($id);
        $this->userId = $student->id;
        $this->username = $student->nickname;
        $this->confirmingDisable = true;
    }

    public function disable()
    {
        $student = User::find($this->userId);
        $this->updateRoleStatus($student, 'estudiante', false);
        $this->confirmingDisable = false;
    }

    public function confirmActive($id){
        $this->view = 'active';
        $student = User::find($id);
        $this->userId = $student->id;
        $this->username = $student->nickname;
        $this->confirmingActive = true;
    }

    public function active(){
        $student = User::find($this->userId);
        $this->updateRoleStatus($student, 'estudiante', true);
        $this->confirmingActive = false;
    }

    public function updateRoleStatus($user, $roleToUpdate, $status){
        $userRoles = $user->roles;
        foreach ($userRoles as $role) {
            if($role->name === $roleToUpdate){
                $user->roles()->updateExistingPivot($role->id, ['status' => $status]);
            }
        }
    }
}
