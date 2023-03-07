@extends('layouts.app')


@section('titulo')
    Pagina Princial
@endsection

@section('contenido')
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        {{-- Mostrar informacion de nuestro posts en la vista --}}
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user] ) }}">
                    {{-- Buscamos ruta y concatenamos el nombre de la imagen --}}
                    <img class="p-5 md:p-0 rounded-lg" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del posts {{ $post->titulo }}">
                </a>
            </div>
        @endforeach
    </div>
    @else
        <h1>No hay publicaciones</h1>
    @endif
@endsection
