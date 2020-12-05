<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'readings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * Relaciones entre modelos
     */
    //Una lectura le pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Una lectura le pertenece a una temática
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //Una lectura le pertenece a un nivel
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /***
     * Relaciones polimórficas
     * Get all of the post's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
