<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Metodo redireccion
    // Para usuarios no autenticados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // dd('Home'); Validacion de funcionamiento



        //Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
