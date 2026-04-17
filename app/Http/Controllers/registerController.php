<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validar (Seguridad: no dejamos pasar datos basura)
        $request->validate([
            'mote' => 'required|unique:users,mote',
            'nombre' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // 'confirmed' chequea 'password_confirmation'
            'imagen' => 'nullable|image|max:2048'
        ]);

        // Gestionar la imagen
        $path = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('perfiles', 'public');
        }

        // Crear el usuario en la BD
        User::create([
            'mote' => $request->mote,
            'name' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->tlfn,
            'password' => Hash::make($request->password), // ENCRIPTADO SEGURO
            'foto_perfil' => $path,
        ]);

        return redirect()->route('home')->with('success', 'Usuario registrado con éxito.');
    }
}