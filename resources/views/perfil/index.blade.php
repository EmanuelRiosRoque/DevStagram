@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            @if (session('mensaje'))
                <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                    {{ session('mensaje') }}
                </p>
            @elseif (session('mensaje-exito'))
                <p class=" bg-green-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                    {{ session('mensaje-exito') }}
                </p>
            @endif


            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf


                <a class="font-bold uppercase text-gray-600 text-sm mr-3"
                    href="{{ route('posts.index', auth()->user()->username )}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </a>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="username">
                        {{__('Username')}}
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        autocomplete="username"
                        autofocus
                        class="border p-3 w-full rounded-lg @error('username') border-red-500   @enderror"
                        @error('username') is-invalid @enderror"
                        value="{{ auth()->user()->username }}"
                        />
                        {{-- VALIDACION DE ERRORES --}}
                        @error('username')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="email">
                        {{__('E-Mail Address')}}
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        autocomplete="email"
                        autofocus
                        class="border p-3 w-full rounded-lg @error('email') border-red-500   @enderror"
                        @error('email') is-invalid @enderror"
                        value="{{ auth()->user()->email }}"
                        />
                        {{-- VALIDACION DE ERRORES --}}
                        @error('email')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="imagen">
                        {{__('Imagen Perfil')}}
                    </label>
                    <input
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg,.jpeg.png"
                        />
                </div>



                <div class="flex gap-2">
                    <input type="submit"
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                    <button class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" type="button" onclick="toggleModal('modal-id')">
                        Cambiar contraseña
                      </button>

                    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
                        <div class="relative w-auto my-6 mx-auto max-w-lg">
                          <!--content-->
                          <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                <!--body-->
                                <div class="modal-wrapper bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="modal-wrapper-flex sm:flex sm:items-start">
                                        <div class="modal-icon mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-700">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                            </svg>
                                        </div>
                                        <div class="modal-content text-center mt-3 sm:mt-0 sm:ml-6 sm:text-left">
                                            <h3 class="text-lg font-medium text-gray-900">Hacer Cambios</h3>
                                            <div class="modal-text mt-2">
                                                <p class="text-gray-800 text-base font-medium">¿Estas seguro de hacer cambios?</p>
                                                <p class="text-gray-600 text-sm mt-3"> <span class="font-bold">Nota: </span>Para hacer cambios debes insertar tu contraseña anterior</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5 mt-5">
                                        <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">Antiguo Password</label>
                                        <input id="oldpassword" name="oldpassword" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror">
                                        @error('oldpassword')
                                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-5">
                                        <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                                        <input id="password" name="password" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                                        @error('password')
                                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-5">
                                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Nueva Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg">
                                    </div>
                                </div>

                                <!--Bottons-->
                                <div class="items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b sm:flex">
                                    <button class="w-full inline-flex justify-center mt-0 rounded-md border border-gray-200 px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-3 focus:ring-offset-2 focus:ring-blue-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" type="button" onclick="toggleModal('modal-id')">
                                        Cerrar
                                    </button>

                                    <button class="w-full mt-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-sky-700 font-medium text-white hover:bg-sky-600 focus:outline-none focus:ring-3 focus:ring-offset-2 focus:ring-sky-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" type="submit" onclick="toggleModal('modal-id')">
                                        Confirmar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-50 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>

                </div>
            </form>
        </div>
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
