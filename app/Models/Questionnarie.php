<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnarie extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questionnaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Relaciones entre modelos
     */
    //Un questionario le pertenece a una lectura
    public function reading()
    {
        return $this->belongsTo(Reading::class);
    }
    
    //Un cuestionario puede tener más de una pregunta
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    //Un cuestionario puede tener más de una calificaión por parte del estudiante
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
