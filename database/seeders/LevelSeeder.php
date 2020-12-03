<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name'=>'Básico',
            'weighing' => 0,
        ]);
        Level::create([
            'name'=>'Intermedio',
            'weighing' => 50,
        ]);
        Level::create([
            'name'=>'Avanzado',
            'weighing' => 100,
        ]);
    }
}
