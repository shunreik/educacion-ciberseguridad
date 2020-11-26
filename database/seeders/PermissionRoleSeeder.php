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
            'name' => 'admin',
        ]);
        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);
        $studentRole = Role::create([
            'name' => 'student',
        ]);


        /**
         * PERMISOS
         * Registro de los permisos por módulo
         */
        //  Módulo: Profesor
        $listTeachers = Permission::create([
            'name' => 'list teachers',
        ]);

        // Módulo: Contenido
        $listContent = Permission::create([
            'name' => 'list content',
        ]);
        $createContent = Permission::create([
            'name' => 'create content'
        ]);

        /**
         * ASIGNACIÓN
         * Se asignan los permisos registrados a los roles por defecto
         */
        $adminRole->syncPermissions([
            $listTeachers,
        ]);
        $teacherRole->syncPermissions([
            $createContent,
        ]);
        $studentRole->syncPermissions([
            $listContent,
        ]);
    }
}
