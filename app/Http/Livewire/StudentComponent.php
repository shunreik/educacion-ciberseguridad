<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class StudentComponent extends Component
{
    use WithPagination;

    public $view = "show";
    public $confirmingDisable, $confirmingActive, $showMode = false;
    public $userId, $nickname, $photo, $name, $surname, $email, $verifiedMail, $dateRegistration, $dateVerified;
    //opciones de filtrado de usuario
    public $all = true;
    public $actived = false, $disabled = false;

    /**
     * Método que renderiza la vista principal
     */
    public function render()
    {
        $students = $this->filterUsers();

        return view('livewire.student.component', [
            'students' => $students,
        ]);
    }

    /**
     * Método que muestra información de un determinado estudiante
     */
    public function show($id){
        $this->view = 'show';//Se cambia a la vista de ver
        $this->showMode = true; //Se presenta el modal con la información del usuario
        $student = User::find($id);
        if($student->hasRole('estudiante')){
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
    }

    /**
     * Método que muestra el modal para confirmar la desactivación del estudiante
     */
    public function confirmDisable($id){
        $student = User::find($id);
        if($student->hasRole('estudiante')){
            $this->view = 'disable';
            $this->userId = $student->id;
            $this->nickname = $student->nickname;
            $this->confirmingDisable = true;
        }
    }

    /**
     * Método que cambia el estado del rol asignado al estudiante a desactivado (false)
     */
    public function disable()
    {
        $student = User::find($this->userId);
        $this->updateRoleStatus($student, 'estudiante', false);
        $this->confirmingDisable = false;
    }

    /**
     * Método que muestra el modal para confirmar activación del estudiante
     */
    public function confirmActive($id){
        $student = User::find($id);
        if($student->hasRole('estudiante')){
            $this->view = 'active';
            $this->userId = $student->id;
            $this->nickname = $student->nickname;
            $this->confirmingActive = true;
        }
    }

    /**
     * Método que cambia el estado del rol asignado al estudiante a activado (true)
     */
    public function active(){
        $student = User::find($this->userId);
        $this->updateRoleStatus($student, 'estudiante', true);
        $this->confirmingActive = false;
    }

    /**
     * Método que actualiza el estado del rol asigando al estudiante
     */
    public function updateRoleStatus($user, $roleToUpdate, $status){
        $userRoles = $user->roles;
        foreach ($userRoles as $role) {
            if($role->name === $roleToUpdate){
                $user->roles()->updateExistingPivot($role->id, ['status' => $status]);
            }
        }
    }

    /**
     * Método que permite listar a todos los estudiantes
     */
    public function allUsers(){
        $this->all = true;
        $this->actived = false;
        $this->disabled = false;
    }

    /**
     * Método que permite el filtrado de estudiantes activos
     */
    public function activatedUsers(){
        $this->actived = true;
        $this->disabled = false;
        $this->all = false;
    }

    /**
     * Método que permitr el filtrado de estudiantes desactivados
     */
    public function disabledUsers(){
        $this->disabled = true;
        $this->actived = false;
        $this->all = false;
    }

        /**
     * Método que filtra a los estudiantes el módo de filtrado,
     * esta función recibe las opciones de filtrado de usuario
     */
    public function filterUsers(){
        $role = Role::where('name', 'estudiante')->first();
        $students = $role->users();

        if($this->all){
            $students = $students;
        }
        if($this->actived){
            $students = $students->wherePivot('status', true);
        }
        if($this->disabled){
            $students = $students->wherePivot('status', false);
        }

        return $students->orderBy('surname', 'asc')->paginate(10);
    }
}
