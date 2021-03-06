<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Notifications\VerifyTeacherEmail;
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
        $createMode = false,
        $editMode = false,
        $disableMode = false,
        $activeMode = false;
    public $userId, $nickname, $photo, $name, $surname, $email, $verifiedMail, $dateRegistration, $dateVerified;
    //opciones de filtrado de usuario
    public $all = true,
        $actived = false,
        $disabled = false;
    //Opciones para la busqueda de estudiantes
    public $typeSearch = '', $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeSearch' => ['except' => ''],
    ];

    public function render()
    {
        $teachers = $this->filterUsers();
        return view('livewire.teacher.component', [
            'teachers' => $teachers,
        ]);
    }

    public function show($id)
    {
        $this->view = "show";
        $this->showMode = true;
        $teacher = User::find($id);
        $this->nickname = $teacher->nickname;
        $this->photo = $teacher->profile_photo_url;
        $this->name = $teacher->name;
        $this->surname = $teacher->surname;
        $this->email = $teacher->email;
        $this->verifiedMail = $teacher->hasVerifiedEmail();
        $this->dateRegistration = $teacher->created_at->format('d M Y - H:i:s');
        if ($this->verifiedMail) {
            $this->dateVerified = $teacher->email_verified_at->format('d M Y - H:i:s');
        }
    }

    public function create()
    {
        $this->resetValidation();
        $this->view = 'create';
        $this->createMode = true;
        $this->default();
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
        $teacher->notify(new VerifyTeacherEmail($teacher->email, $password)); //se envía un correo al profesor registrado
        $this->default();
        session()->flash('success', 'Profesor registrado correctamente');
        $this->createMode = false;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $this->view = 'edit';
        $this->editMode = true;
        $teacher = User::find($id);
        $this->userId = $teacher->id;
        $this->name = $teacher->name;
        $this->surname = $teacher->surname;
        $this->email = $teacher->email;
    }

    public function update()
    {
        $sendMail = false;
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$this->userId"],
        ]);

        $teacher = User::find($this->userId);
        $teacher->name = $this->name;
        $teacher->surname = $this->surname;
        $teacher->nickname = $this->getFullName($this->name,  $this->surname);

        if ($teacher->email !== $this->email) {
            $password = Str::random(8); //se genera un nuevo password
            $teacher->email = $this->email;
            $teacher->email_verified_at = null;
            $teacher->password = Hash::make($password);
            $sendMail = true;
        }

        $teacher->save(); //Se actualiza el registro del profesor

        if ($sendMail) {
            //Se envía el correo electrónico
            $teacher->notify(new VerifyTeacherEmail($teacher->email, $password, 'Actualización de profesor'));
        }

        $this->default();
        session()->flash('success', 'Profesor actualizado correctamente');
        $this->editMode = false;
    }

    public function getFullName($name, $surname)
    {
        $first_name = explode(' ', $name);
        $last_name = explode(' ', $surname);
        return "$first_name[0] $last_name[0]";
    }

    public function confirmDisable($id)
    {
        $this->view = "disable";
        $this->disableMode = true;
        $teacher = User::find($id);
        $this->userId = $teacher->id;
        $this->nickname = $teacher->nickname;
    }

    public function disable()
    {
        $teacher = User::find($this->userId);
        $this->updateRoleStatus($teacher, 'profesor', false);
        $this->disableMode = false;
        $this->default();
        session()->flash('success', 'Profesor desactivado correctamente');
    }

    public function confirmActive($id)
    {
        $this->view = 'active';
        $this->activeMode = true;
        $teacher = User::find($id);
        $this->userId = $teacher->id;
        $this->nickname = $teacher->nickname;
    }

    public function active()
    {
        $teacher = User::find($this->userId);
        $this->updateRoleStatus($teacher, 'profesor', true);
        $this->activeMode = false;
        $this->default();
        session()->flash('success', 'Profesor activado correctamente');
    }

    /**
     * Método que actualiza el estado del rol asigando al profesor
     */
    public function updateRoleStatus($user, $roleToUpdate, $status)
    {
        $userRoles = $user->roles;
        foreach ($userRoles as $role) {
            if ($role->name === $roleToUpdate) {
                $user->roles()->updateExistingPivot($role->id, ['status' => $status]);
            }
        }
    }

    public function
    default()
    {
        $this->userId = '';
        $this->nickname = '';
        $this->photo = '';
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->verifiedMail = '';
        $this->dateRegistration = '';
        $this->dateVerified = '';
    }

    /**
     * Método que permite listar a todos los estudiantes
     */
    public function allUsers()
    {
        $this->all = true;
        $this->actived = false;
        $this->disabled = false;
    }

    /**
     * Método que permite el filtrado de profesores activos
     */
    public function activatedUsers()
    {
        $this->actived = true;
        $this->disabled = false;
        $this->all = false;
    }

    /**
     * Método que permitr el filtrado de profesores desactivados
     */
    public function disabledUsers()
    {
        $this->disabled = true;
        $this->actived = false;
        $this->all = false;
    }

    public function filterUsers()
    {
        $roleTeacher = Role::where('name', 'profesor')->first();
        $teachers = $roleTeacher->users();

        if(!empty($this->search)){
            if(empty($this->typeSearch)){
                $this->typeSearch = 'surname';
            }
            $teachers = $teachers->where("$this->typeSearch", 'LIKE', "$this->search%");
        }

        if ($this->all) {
            $teachers = $teachers;
        }
        if ($this->actived) {
            $teachers = $teachers->wherePivot('status', true);
        }
        if ($this->disabled) {
            $teachers = $teachers->wherePivot('status', false);
        }

        return $teachers->orderBy('surname', 'asc')->paginate(10);
    }
}
