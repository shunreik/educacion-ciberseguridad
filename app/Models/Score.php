<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['qualification'];

    /**
     * Relaciones entre modelos
     */
    //Una nota/calificación le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Una nota/calificación le pertenece a un questionario
    public function questionnarie()
    {
        return $this->belongsTo(Questionnarie::class);
    }
}
