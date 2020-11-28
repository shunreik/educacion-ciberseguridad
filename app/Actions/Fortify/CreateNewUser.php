<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'nickname' => $this->getFullName($input['name'],  $input['surname']),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        // Al usuario registrado se le saigna el rol de estudiante
        $user->assignRole('estudiante');

        return $user;
    }

    public function getFullName($name, $surname){
        $first_name = explode(' ', $name);
        $last_name = explode(' ', $surname);
        return "$first_name[0] $last_name[0]";
    }
}
