<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{                               // Este user es el perfil que estamos visitando
    public function sotre(User $user)
    {
        // dd($user->username);
        // Relacion con la misma tabla
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user)
    {
        // dd($user->username);
        // Relacion con la misma tabla
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
