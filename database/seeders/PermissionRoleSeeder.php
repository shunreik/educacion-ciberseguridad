<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ROLES
         * Registro de los roles por defecto
         */
        $adminRole = Role::create([
            'name' => 'administrador',
        ]);
        $teacherRole = Role::create([
            'name' => 'profesor',
        ]);
        $studentRole = Role::create([
            'name' => 'estudiante',
        ]);


        /**
         * PERMISOS
         * Registro de los permisos por módulo
         */
        //  Módulo: Profesor
        $manageTeachers = Permission::create([
            'name' => 'manage.teachers',
        ]);
        //  Módulo: estudiante
        $manageStudents = Permission::create([
            'name' => 'manage.students',
        ]);
        // Módulo: lectura
        $manageReading = Permission::create([
            'name' => 'manage.readings'
        ]);

        // Módulo: Cuestionario
        $manageQuestionnarie = Permission::create([
            'name' => 'manage.questionnaries'
        ]);

        $createContent = Permission::create([
            'name' => 'create.content'
        ]);

        /**
         * ASIGNACIÓN
         * Se asignan los permisos registrados a los roles por defecto
         */
        $adminRole->syncPermissions([
            $manageTeachers,
            $manageStudents,
        ]);
        $teacherRole->syncPermissions([
            $manageReading,
            $manageQuestionnarie,
        ]);
        $studentRole->syncPermissions([
            $createContent,
        ]);
    }
}
