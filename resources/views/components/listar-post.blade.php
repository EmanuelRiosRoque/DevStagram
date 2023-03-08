<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        {{-- Mostrar informacion de nuestro posts en la vista --}}
        @foreach ($posts as $post)


            <div class="px-5 pt-3 pb-12 bg-white shadow-2xl rounded-lg border border-slate-200">
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user] ) }}">
                    {{-- Buscamos ruta y concatenamos el nombre de la imagen --}}
                        <img class="rounded-lg" src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del posts {{ $post->titulo }}">

                        <div class=" flex justify-between items-center">
                            {{--Funcion de dar likes --}}
                            <div class=" flex items-center gap-3 mt-2">
                                @auth

                                @if ( $post->checkLike(auth()->user() ))
                                    <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <div class="">
                                            <button type="submit" class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                        @csrf
                                        <div class="">
                                            <button type="submit" class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                @endauth

                                <p class="font-bold">{{ $post->likes->count() }}
                                    <span class="font-normal">Likes</span>
                                </p>
                            </div>

                        </div>
                        <p class="font-bold"><span class=" font-light">De:</span> {{$post->user->username}} </p>
                        <p class="text-sm text-gray-500"> {{$post->created_at->diffForHumans()}} </p>
                </a>
            </div>
        @endforeach
    </div>
    @else
        <h1 class=" text-center">No hay publicaciones</h1>
    @endif
</div>
