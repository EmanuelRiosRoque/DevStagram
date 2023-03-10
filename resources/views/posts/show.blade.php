@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-6 shadow-2xl">
            <img class=" md:p-2 lg:p-0 rounded-md " src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{$post->titulo}}">


            {{--Funcion de dar likes --}}
            <div class="p-3 flex items-center gap-3">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            {{-- Agrupar informacion de este post --}}
            <div>
                <p class="font-bold"> {{$post->user->username}} </p>
                <p class="text-sm text-gray-500"> {{$post->created_at->diffForHumans()}} </p>
                <p class="mt-5">{{$post->descripcion}}</p>
            </div>


            {{-- Formulario para eliminar post --}}
            @if ($post->user_id === auth()->user()->id)
            @auth
                {{--- No mistrar este formulario a no autentificados --}}
                <button class="bg-red-500 hover:bg-red-700 p-2 rounded text-white font-bold mt-4 cursor-pointer px-6 py-3 shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                    Eliminar Publicacion
                  </button>

                <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
                    <div class="relative w-auto my-6 mx-auto max-w-sm">
                      <!--content-->
                      <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                            <!--body-->
                            <div class="modal-wrapper bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="modal-wrapper-flex sm:flex sm:items-start">
                                    <div class="modal-icon mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <div class="modal-content text-center mt-3 sm:mt-0 sm:ml-6 sm:text-left">
                                        <h3 class="text-lg font-medium text-gray-900">Eliminar elemento</h3>
                                        <div class="modal-text mt-2">
                                            <p class="text-gray-600 text-sm">??Estas seguro de eliminar tu plublicacion?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Bottons-->
                            <div class="items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b sm:flex">
                                <button class="w-full inline-flex justify-center mt-0 rounded-md border border-gray-200 px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-3 focus:ring-offset-2 focus:ring-blue-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" type="button" onclick="toggleModal('modal-id')">
                                    Cerrar
                                </button>
                                {{-- Si el post creado con el id tal es igual al id del usurario autentificado mostrar btn delete --}}
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @method('DELETE') {{--Metdo spoofing: el navegador unicamente soporta post este metodo te permite agrgar otro tipo de peticiones--}}
                                        @csrf
                                        <button class="w-full mt-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-700 font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-3 focus:ring-offset-2 focus:ring-red-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" type="submit" onclick="toggleModal('modal-id')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden opacity-50 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
            @endauth
        </div>


        {{-- Agregar comentario --}}

        <div class="md:w-1/2 p-5">
                <livewire:comment-post :post="$post" :user="$user">
        </div>
        {{-- End Agregar comentario --}}
    </div>



<script type="text/javascript">
    function toggleModal(modalID){
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>

@endsection
