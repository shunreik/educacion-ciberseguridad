<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se registran los roles por defecto de la app web
        //El método create() recibe una matríz, crea un modelo y lo inserta en la BDD
        //se diferencia del método save() debido a que acepta una instancia del modelo eloquent 
        //mientras que create acepta una matriz PHP simple
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'teacher',
        ]);
        Role::create([
            'name' => 'student',
        ]);
    }
}
