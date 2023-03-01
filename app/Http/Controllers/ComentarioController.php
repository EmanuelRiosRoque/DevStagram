<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // DEFINIENDO STORE(Request $request)
    public function store(Request $request, User $user, Post $post)
    {
        // dd('Comentario...');

        // VALIDAR VALENTARIO
        $this->validate($request,[
            'comentario' => 'required|max:255'
        ]);

        // ALMACENAR COMENATARIO
        Comentario::create([
            // Para lamacenar requerimos:
            // Para obtener el id del usuario y el id del post
            'user_id' => auth()->user()->id, // del usuario autenticado traeme su id
            'post_id' => $post->id, // Del post traeme el id
            'comentario' => $request->comentario
        ]);

        // IMPRIMIR MENSAJE
        return back()->with('mensaje', 'Comentario Realizado Correctamente'); // REGEASA A LA PAGUINA ANTERIOR CON ESTOS DATOS
        //Estos ->whit() se imprimen con una sesion 
    }
}
