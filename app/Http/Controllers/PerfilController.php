<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // Subir imagen de perfil
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request, )
    {

        // Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20' ],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60'],
        ]);

        // Leer o no en caso de que no se suba una imagen
        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } 


        // Guardar cambios Nombre de usuario
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;


        // Guardar cambios Imagen del usuario
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ??  null;

        // Guardar cambios Email del usuario        
        $usuario = User::find(auth()->user()->id);
        $usuario->email = $request->email ?? auth()->user()->email;

        $usuario->save();


            
        if($request->oldpassword || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
 
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
                $usuario->save();
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }
        

    
    

        return redirect()->route('posts.index', $usuario->username);

    }
    
}
