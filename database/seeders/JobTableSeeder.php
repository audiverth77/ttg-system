<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'tittle' => 'Desarrollador Laravel Senior',
                'description' => 'Responsable de desarrollar aplicaciones web complejas utilizando Laravel.',
                'state' => true,
                'employer_id' => '2',
                'location' => 'Remoto',
                'salary' => 55000,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            
            [
                'tittle' => 'Desarrollador Ract',
                'description' => 'Responsable de desarrollar aplicaciones web complejas utilizando React.',
                'state' => true,
                'employer_id' => '2',
                'location' => 'Remoto',
                'salary' => 4500,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'tittle' => 'Desarrollador ASP.NET',
                'description' => 'Responsable de desarrollar aplicaciones web complejas utilizando ASP.NET',
                'state' => true,
                'employer_id' => '2',
                'location' => 'Presencial',
                'salary' => 7500,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
