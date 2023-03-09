<div>

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

        <div class="gb-white shadow max-h-96 overflow-y-scroll mt-10">
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
