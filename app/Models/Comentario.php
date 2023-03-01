<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    // Saber quien escribio el comentario

    public function user()
    {
        // Relacion inversa este comentario pertenece a 1 usuario 
        return  $this->belongsTo(User::class);
    }
}
