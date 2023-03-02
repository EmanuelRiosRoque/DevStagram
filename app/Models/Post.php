<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user() 
    {
        // Un posts pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        // Un posts tiene multiples comentarios 
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        // Un post va a tener muchos likes
        return $this->hasMany(Like::class);
    }

    //Revisar si un usuario ya dio like
    public function checkLike(User $user)
    {
        // Ir automaticamente a la relacion 
        return $this->likes->contains('user_id', $user->id);
    }
}
