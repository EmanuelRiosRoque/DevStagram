@extends('layouts.app')

@section('titulo')
    Inicia Sesión En DevStagrma
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img class="mb-4" src="{{asset('img/login.jpg')}}" alt="Imagen login de usuarios">
        </div>

        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="email">
                        {{__('E-Mail Address')}}
                    </label>
                    <input 
                        id="email" 
                        name="email"     
                        type="email" 
                        placeholder="Tu Email de Registro" 
                        @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" 
                        class="border p-3 w-full rounded-lg"
                        autofocus
                        autocomplete="email"
                        />

                        {{-- VALIDACION DE ERRORES --}}
                        @error('email')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="password">
                        {{__('Password')}}
                    </label>
                    <input 
                        id="password" 
                        name="password"     
                        type="password" 
                        placeholder="Contraseña de Registro" 
                        class="border p-3 w-full rounded-lg"
                        @error('password') is-invalid @enderror" 
                        autocomplete="current-password"
                        >

                        {{-- VALIDACION DE ERRORES --}}
                        @error('password')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>


                <label class="text-gray-500"> 
                    <input type="checkbox" name="remember"> Mantén mi sesión abierta por favor
                </label>

                <div class="">
                    <div class="flex flex-col gap-5">
                        <button type="submit" class=" bg-cyan-500 hover:bg-cyan-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                            {{ __('Iniciar Sesion') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection