<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];


    /**
     * Relaciones entre modelos
     */
    //Una pregunta le pertenece a un solo questionario
    public function questionnarie()
    {
        return $this->belongsTo(Questionnarie::class);
    }
    //Una pregunta solo tiene una respuesta
    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
    //Una pregunta puede tener varias opciones
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
