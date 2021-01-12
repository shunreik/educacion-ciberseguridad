<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Registro de los temas por defecto del sistema
         */
        Topic::create([
            'title' => 'Ataques informáticos',
            'description' => 'Un ataque informático consiste en aprovechar cualquier vulnerabilidad en el software, hardware, e incluso, en las personas que forman parte de un ambiente informático, con la finalidad de obtener información.'
        ]);
        Topic::create([
            'title' => 'Criptografía',
            'description' => 'La criptografía se ha definido, tradicionalmente, como las técnicas de cifrado para alterar las representaciones lingüísticas de ciertos mensajes con el fin de hacerlos ilegibles a receptores no autorizados.'
        ]);
        Topic::create([
            'title' => 'Esteganografía',
            'description' => 'La esteganografía trata el estudio y aplicación de técnicas que permiten ocultar mensajes u objetos, dentro de otros, llamados portadores, de modo que no se perciba su existencia.'
        ]);
    }
}
