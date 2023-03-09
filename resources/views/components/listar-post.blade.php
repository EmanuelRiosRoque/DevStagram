<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {{-- Mostrar informacion de nuestro posts en la vista --}}
            @foreach ($posts as $post)
                <div class="px-5 pt-3 pb-12 bg-white shadow-2xl rounded-lg border border-slate-200">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        {{-- Buscamos ruta y concatenamos el nombre de la imagen --}}
                        <img class="rounded-lg" src="{{ asset('uploads') . '/' . $post->imagen }}"
                            alt="Imagen del posts {{ $post->titulo }}">

                    </a>
                    <div class=" flex justify-between items-center">
                        {{-- Funcion de dar likes --}}
                        <div class=" flex items-center gap-3 mt-2">
                            <div class=" pb-3 flex items-center gap-3">
                                @auth
                                    <livewire:like-post :post="$post" />
                                @endauth
                            </div>
                        </div>

                    </div>

                    <div class=" px-1">
                        <p class="font-bold"><span class=" font-light">De:</span> {{ $post->user->username }} </p>
                        <p class="text-sm text-gray-500"> {{ $post->created_at->diffForHumans() }} </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h1 class=" text-center">No hay publicaciones</h1>
    @endif
</div>
