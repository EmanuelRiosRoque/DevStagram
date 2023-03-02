@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf

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
                    <label 
                    for="oldpassword" 
                    class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                    Antiguo Password
                    </label>

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

                <button type="submit" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    {{__('Guardar Cambios')}}
                </button>

                
            </form>
        </div>
    </div>
@endsection