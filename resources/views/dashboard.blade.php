@extends('layouts.app')


@section('titulo')
    Perfil: {{ $user->username}}
@endsection

@section('contenido')
    <div class=" flex justify-center">
        <div class=" w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class=" rounded-full" src="{{$user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen De Usuario"></img>
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start md:py-10">

                <div class="flex items-center gap-4">
                    <p class="text-gary-700 text-2xl">{{ $user->username }}</p>
                     
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a 
                                class="cursor-pointer" 
                                href="{{ route('perfil.index') }}"
                            >


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>  

                            </a>
                        @endif    
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal"> Seguidores</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Seguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>

                @auth
                    @if($user->id !== auth()->user()->id )
                        @if( !$user->siguiendo( auth()->user() ) )
                            <form
                                action="{{ route('users.follow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                        @else
                            <form
                                action="{{ route('users.unfollow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE') 
                                <input
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir"
                                />
                            </form>
                        @endif
                    @endif
                @endauth

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
                        <img class="p-5 md:p-0 rounded-lg" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del posts {{ $post->titulo }}">
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

