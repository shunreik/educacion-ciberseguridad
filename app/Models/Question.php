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
        //
    ];


    /**
     * Relaciones entre modelos
     */
    //Una pregunta le pertenece a un solo questionario
    public function questionnarie()
    {
        return $this->belongsTo(Questionnarie::class);
    }
}
