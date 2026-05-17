@extends('layouts.app')

@section('title')
    {{ $post->titulo }}
@endsection 

@section('contenido')
    <div class="container mx-auto md:flex gap-6">
        <div class="md:w-1/2">
            <img src="{{asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            @auth

                <livewire:like-post :post="$post" />
                
            @endauth

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5"> {{ $post->descripcion }}</p>
            </div>

            @auth
                @if($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit"
                            value="Eliminar Publicación"
                            class="bg-red-500 hover:bg-red-600 transition-colors p-2 rounded-lg text-white mt-4 cursor-pointer"
                        />
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2">
            <div class="shadow bg-white p-5 mb-5 mt-5 md:mt-0 rounded-lg">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf

                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un comentario</label>
                        <textarea
                            id="comentario"
                            name="comentario"
                            placeholder="Escribe tu comentario"
                            class="p-3 w-full rounded-lg border border-gray-300 @error('comentario') border-red-500 @enderror"
                        ></textarea>

                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-center p-2 text-sm">{{ $message }}</p>
                        @enderror

                        <input type="submit" value="Comentar" 
                        class="bg-sky-600 hover:bg-sky-700 transition-colors
                        cursor-pointer uppercase font-bold w-full p-3 mt-3 text-white rounded-lg">

                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10 rounded-lg">

                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach                        
                    @else

                    <p class="text-center p-10">No hay comentarios aún.</p>

                    @endif  

                </div>

            </div>
        </div>
    </div>
@endsection