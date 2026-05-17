@extends('layouts.app')

@section('title')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 shadow bg-white p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Username"
                        class="p-3 w-full rounded-lg border border-gray-300 @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email"
                        class="p-3 w-full rounded-lg border border-gray-300 @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                    />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ $message }}</p>
                    @enderror
                
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="p-3 w-full rounded-lg border border-gray-300"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password Actual</label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Tu Password"
                        class="p-3 w-full rounded-lg border border-gray-300 @error('password') border-red-500 @enderror"
                    />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ $message }}</p>
                    @enderror
                
                </div>

                <div class="mb-5">
                    <label for="password_nuevo" class="mb-2 block uppercase text-gray-500 font-bold">Password Nuevo</label>
                    <input 
                        id="password_nuevo"
                        name="password_nuevo"
                        type="password"
                        placeholder="Tu Nuevo Password"
                        class="p-3 w-full rounded-lg border border-gray-300 @error('password_nuevo') border-red-500 @enderror"
                    />

                    @error('password_nuevo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ $message }}</p>
                    @enderror
                
                </div>

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ session('mensaje') }}</p>
                @endif

                <input type="submit" value="Guardar Cambios" 
                    class="bg-sky-600 hover:bg-sky-700 transition-colors
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>

    </div>
@endsection