<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Reading;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class ReadingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reading::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $teacherRole = Role::where('name', 'profesor')->first();
        $teachers = $teacherRole->users;//se obtiene solo a los usuarios profesores
        $topics = Topic::all();//se obtiene las temáticas registradas
        $levels = Level::all();//se obtienen los niveles registrados
        
        return [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'user_id'=>$teachers->random(),//se obtiene un profesor al azar
            'topic_id'=>$topics->random(),//se obtiene una temática al azar
            'level_id'=>$levels->random(),//se obtiene un nivel al azar
        ];
    }
}
