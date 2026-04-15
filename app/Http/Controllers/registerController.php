<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mote' => 'required|unique:users,mote',
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required',
            'password' => 'required|min:6',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Máximo 2MB
        ]);

        // Gestionar la subida de la foto de perfil
        $nombreImagen = null;
        if ($request->hasFile('imagen')) {
            // Guarda la imagen en storage/app/public/perfiles
            // La función store devuelve la ruta (ej: perfiles/nombre_aleatorio.png)
            $rutaImagen = $request->file('imagen')->store('perfiles', 'public');
            // Guardamos solo el nombre o la ruta para la base de datos
            $nombreImagen = $rutaImagen;
        }

        // Crear el usuario
        $user = User::create([
            'mote'      => $request->mote,
            'name'      => $request->name,
            'apellidos' => $request->apellidos,
            'email'     => $request->email,
            'telefono'  => $request->telefono,
            'password'  => Hash::make($request->password), // Encriptación obligatoria
            'foto_perfil' => $nombreImagen, // Guardamos la ruta en la DB
        ]);

        return redirect()->route('home')->with('status', '¡Registro completado con éxito!');
    }
}