<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PostController extends Controller
{
    // verificar que el usuario se encuentre logiado si se ingresa al "/muro" 
    // Desde otro navegador ya no manda en ERRROS# carpeta 
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        //Intancia del usurio
        // dd($user->id);
        // Nuestros posts tienen asociados el USER_ID
        // Por lo tanto podemos consultar la tabla de posts y filtar por el usuarios que estamos visitando por la url

        /**1 Primera forma de fritarlo los posts por su id */
        $posts = Post::where('user_id', $user->id)->paginate(20); // Paginate() -> hace que de los resultado solamente tome una cierta cantidad de ellos

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts   
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:50',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);
        
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        // Otra forma de ingresar datos
        // $post = new Post;
        // $post->titulo = $request -> titulo;
        // $post->descripcion = $request -> descripcion;
        // $post->imagen = $request -> imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Almacenar el query con una relacion
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,            
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
    
    public function show(User $user, Post $post)
    {

        return view('post.show', [
            'post' =>  $post,
            'user' => $user
        ]);
    }

    //Elimina un post existente 
    public function destroy(Post $post)
    {
        // dd('Eliminando', $post->id); // Ver que publicacion se va eliminar 
        // Validacion En PostPolicy
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index', auth()->user()->username);

    }
}
