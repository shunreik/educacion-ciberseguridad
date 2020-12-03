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
        Reading::factory(20)->create();
    }
}
