<?php

namespace Database\Seeders;

use App\Models\Reading;
use Illuminate\Database\Seeder;

class ReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Registro de prueba
        Reading::create([
            'title'=>'Lectura de prueba',
            'description'=>'Descripción de prueba',
            'user_id'=>20,
            'topic_id'=>1,
            'level_id'=>1,
        ]);
    }
}
