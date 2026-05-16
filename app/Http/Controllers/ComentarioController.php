<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        // Validar
        $request->validate([
            'comentario' => 'required|max:255'
        ]);

        // Almacenar el comentario
        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario agregado correctamente');
    }
}
