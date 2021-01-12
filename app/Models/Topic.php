<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topics';
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
   protected $fillable = ['title', 'description'];

   /**
    * Relaciones entre modelos
    */
    //Una temática puede tener varias lecturas
    public function readings()
    {
        return $this->hasMany(Reading::class);
    }

}
