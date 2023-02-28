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
}
