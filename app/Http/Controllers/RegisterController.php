<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {

        // Modificar el request para generar el username a partir del nombre
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validar los datos
        $request->validate( [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Autenticar al usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        // Otra manera de autenticar al usuario
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index');
    }
}
