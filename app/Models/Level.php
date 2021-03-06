<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'levels';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    //weighing -.ponderación del nivel
   protected $fillable = ['name', 'weighing'];

   /**
    * Relaciones entre modelos
    */
    //Un nivel puede tener varias lecturas
    public function readings()
    {
        return $this->hasMany(Reading::class);
    }
}
