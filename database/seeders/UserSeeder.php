<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Administrador
         */
        $adminUser = User::create([
            'name' => 'Michelle Estefanía',
            'surname' => 'Arias López',
            'nickname' => 'Skr',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin0403'),
        ]);
        // Se asigna el rol de administrador al usuario registrado anteriormente
        $adminUser->assignRole('administrador');

        /**
         * Profesores
         */
        $teachers = User::factory(15)
            ->create()
            ->each(function (User $teacherUser) {
                $teacherUser->assignRole('profesor');
            });

        /**
         * Estudiantes
         */
        $students = User::factory(15)
            ->create()
            ->each(function (User $studentUser) {
                $studentUser->assignRole('estudiante');
            });
    }
}
