@extends('layouts.app')


@section('titulo')
    Perfil: {{ $user->username}}
@endsection

@section('contenido')
    <div class=" flex justify-center">
        <div class=" w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen De Usuario"></img>
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start md:py-10">
                <p class="text-gary-700 text-2xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal"> Seguidores</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Seguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Posts</span>
                </p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10"> Publicaciones </h2>

        {{-- Iteramos arreglo para mostrar la informacion de nuestro posts --}}
        {{-- {{dd($posts)}} --}}


        {{-- Si Mostrar informacion de nuestro posts en la vista --}}
        @if($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {{-- Mostrar informacion de nuestro posts en la vista --}}
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('post.show', ['post' => $post, 'user' => $user] ) }}">
                        {{-- Buscamos ruta y concatenamos el nombre de la imagen --}}
                        <img class="p-5 md:p-0" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del posts {{ $post->titulo }}">
                    </a>
    
    
    
                </div>

               
            @endforeach
        </div>
        
        {{-- Paginas Publicaciones --}}
        <div class="my-10">
            {{-- No se muestra estilos de tailwindcss ya que necesita de añadirlo --}}
            {{$posts->links('pagination::tailwind')}}
        </div>

        {{-- Mostrar letrero si no existen publicaiciones --}}
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay Publicaciones</p>

        @endif
    </section>

@endsection

