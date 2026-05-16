<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    //

    public function store(Request $request) {

        $manager = ImageManager::usingDriver(Driver::class);
        
        $nombreImagen = Str::uuid() . '.' . $request->file('file')->getClientOriginalExtension();

        $imagen = $manager->decode($request->file('file'));
        
        $imagen->resize(1000, 1000);

        $imagen->save(public_path('uploads/' . $nombreImagen));

        return response()->json(['imagen' => $nombreImagen]);
    }
}
