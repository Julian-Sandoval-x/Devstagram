<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PerfilController extends Controller
{
    public function index() {
        return view('perfil.index');
    }

    public function store(Request $request) {

        // Validacion
        $request->request->add(['username' => Str::slug($request->username)]);
        $request->validate([
            'username' => [
                'required',
                'unique:users,username,' . auth()->user()->id,
                'min:3',
                'max:20', 
                'not_in:editar-perfil,admin,login,logout,registro,posts,imagenes,comentarios,likes,perfil'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id],
            'passsword' => ['nullable'],
            'password_nuevo' => ['nullable', 'min:8']
        ]);

        // Verificar password
        if($request->password && !auth()->attempt(['email' => auth()->user()->email, 'password' => $request->password])) {
            return back()->with('mensaje', 'Password incorrecto');
        }

        // Si el usuario sube una imagen
        if($request->imagen) {
            $manager = ImageManager::usingDriver(Driver::class);
        
            $nombreImagen = Str::uuid() . '.' . $request->file('imagen')->getClientOriginalExtension();

            $imagen = $manager->decode($request->file('imagen'));
            
            $imagen->resize(1000, 1000);

            $imagen->save(public_path('perfiles/' . $nombreImagen));
        }


        // Guardar cambios
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
