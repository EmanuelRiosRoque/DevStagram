@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-6">
            <img class=" md:p-2 lg:p-0 " src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">

            <div class="p-3">
                <p>0 likes</p>
            </div>

            {{-- Agrupar informacion de este post --}}
            <div>
                <p class="font-bold"> {{$post->user->username}} </p>
                <p class="text-sm text-gray-500"> {{$post->created_at->diffForHumans()}} </p>
                <p class="mt-5">{{$post->descripcion}}</p>
            </div>


            {{-- Formulario para eliminar post --}}
            @auth
                {{--- No mistrar este formulario a no autentificados --}}
                @if ($post->user_id === auth()->user()->id)
                    {{-- Si el post creado con el id tal es igual al id del usurario autentificado mostrar btn delete --}}
                    <form action="{{ route('post.destroy', $post) }}" method="POST">
                        @method('DELETE') {{--Metdo spoofing: el navegador unicamente soporta post este metodo te permite agrgar otro tipo de peticiones--}}
                        @csrf
                        
                        <input 
                            type="submit"
                            value="Eliminar publicacion"
                            class="bg-red-500 hover:bg-red-700 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        >
                    </form>
                @endif
            @endauth
        </div>
    
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth

                <p class="text-xl font-bold text-center mb-4">Agregar un nuevo comentario</p>
                
                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif


                {{-- POST lo que decimos aqui es que cuando enviamos nuestro formulario redirigue la ruta a comentarios.store --}}
                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    {{-- AGREGAMOS DIRECTIVA DE SEGURIDAD @csrf --}}
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                               Comentar
                        </label>
                        <textarea 
                            id="comentario"
                            name="comentario"
                            placeholder="Agrega un Comentario"
                            class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                        ></textarea>
        
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                        @enderror
                    </div>
                    
                    <input
                        type="submit"
                        value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
                </form>

                @endauth

                <div class="gb-white shadow mt-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                
                                {{-- Saber quein escribio el comentario --}}
                                <a class="font-bold" href="{{ route('posts.index', $comentario->user) }}"> {{--Redirigir al usuario que hizo el comentario--}}
                                    {{$comentario->user->username}}
                                </a>

                                {{-- Traer el comentario que se hizo --}}
                                <p>{{ $comentario->comentario }}</p>
                                
                                {{-- Traer la fecha del comentario creado --}}
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                           
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aun</p>
                    @endif 
                </div>
            </div>
        </div>
    </div>
@endsection
