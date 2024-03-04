<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que la tabla está vacía antes de sembrar
        //User::truncate();
        User::query()->delete();

        $empleadorRole = Role::where('name', 'empleador')->first();
        $candidatoRole = Role::where('name', 'candidato')->first();

        $user = User::create([
            'name_company' => 'TTG RH',
            'address' => 'medellín',
            'name' => 'Anderson',
            'last_name' => 'Audiverth',
            'email' => 'ttg@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '43456565',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user->assignRole($empleadorRole);

        // Crea tres candidatos
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'address' => "medellín",
                'name' => "Candidato$i",
                'last_name' => "apellido$i",
                'email' => "candidato$i@example.com",
                'password' => bcrypt('password'),
                'phone' => "43456565$i",
                'cv' => "cadidato$i.pdf",
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $user->assignRole($candidatoRole);
        }
    }
}
