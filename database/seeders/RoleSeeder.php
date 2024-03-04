<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        /*
            Creación de los roles empleador y candidato para la gestión de login con autenticación
            Y manejo de permisos asignados por rol para el acceso de las funcionalidades
        */
        Role::create(['name' => 'empleador']);
        Role::create(['name' => 'candidato']);
    }
}
