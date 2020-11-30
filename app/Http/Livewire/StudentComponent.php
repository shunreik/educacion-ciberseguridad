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
    public $confirmingDisable, $confirmingActive, $showMode = false;

    public $userId, $nickname, $photo, $name, $surname, $email, $verifiedMail, $dateRegistration, $dateVerified;

    public function render()
    {
        //Se obtienen a los registros de estudiantes
        $students = User::role('estudiante')->orderBy('surname', 'asc')->paginate(10);
        return view('livewire.student.component', [
            'students' => $students,
        ]);
    }

    public function show($id){
        $this->view = 'show';//Se cambia a la vista de ver
        $this->showMode = true; //Se presenta el modal con la información del usuario
        $student = User::find($id);
        $this->nickname = $student->nickname;
        $this->photo = $student->profile_photo_url;
        $this->name = $student->name;
        $this->surname = $student->surname;
        $this->email = $student->email;
        $this->verifiedMail = $student->hasVerifiedEmail();
        $this->dateRegistration = $student->created_at->format('d M Y - H:i:s');
        if($this->verifiedMail){
            $this->dateVerified = $student->email_verified_at->format('d M Y - H:i:s');
        }
    }

    public function confirmDisable($id){
        $this->view = 'disable';
        $student = User::find($id);
        $this->userId = $student->id;
        $this->nickname = $student->nickname;
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
        $this->nickname = $student->nickname;
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
