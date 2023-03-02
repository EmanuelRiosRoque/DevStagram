<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Guardar y actualizar los likes  
    public function store(Request $request, Post $post)
    {
        // dd($request->user()->id);
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    // Eliminar like
    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
