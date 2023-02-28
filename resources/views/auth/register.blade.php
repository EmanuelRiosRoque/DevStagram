@extends('layouts.app')

@section('titulo')
    Registrate En DevStagrma
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img class="mb-4" src="{{asset('img/registrar.jpg')}}" alt="Imagen regustro de usuarios">
        </div>

        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="name">
                        {{__('Name')}}
                    </label>
                    <input 
                        id="name" 
                        name="name"     
                        type="text" 
                        placeholder="Tu nombre" 
                        autocomplete="name"
                        autofocus
                        class="border p-3 w-full rounded-lg @error('name') border-red-500   @enderror"
                        @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}"
                        />
                        {{-- VALIDACION DE ERRORES --}}
                        @error('name')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="usuario">
                        {{__('Usernamer')}}
                    </label>
                    <input 
                        id="username" 
                        name="username"     
                        type="text" 
                        placeholder="Tu nombre de Usuario" 
                        class="border p-3 w-full rounded-lg"
                        @error('username') is-invalid @enderror" 
                        value="{{ old('username') }}"
                        
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
                        type="email" 
                        placeholder="Tu Email de Registro" 
                        class="border p-3 w-full rounded-lg"
                        @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}"
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
                        autocomplete="new-password"
                        @error('password') is-invalid @enderror" 
                        
                        >
                        

                        {{-- VALIDACION DE ERRORES --}}
                        @error('password')
                            <p class=" bg-red-500 text-white my-3 rounded-lg text-sm p-3 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                </div>

                <div class="mb-5">
                    <label class="mb-2 inline text-center uppercase text-gray-500 font-bold" for="password_confirm">
                        {{__('Confirm Password')}}
                    </label>
                    <input 
                        id="password_confirm" 
                        name="password_confirmation"     
                        type="password" 
                        placeholder="Repite contraseña de Registro" 
                        autocomplete="new-password"
                        class="border p-3 w-full rounded-lg">
                </div>

                <button type="submit" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    {{__('Register')}}
                </button>
            </form>
        </div>
    </div>
@endsection