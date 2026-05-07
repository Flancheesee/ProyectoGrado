<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validar 
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

    public function storeEmpleado(Request $request)
    {
        // 1. Validar
        $validated = $request->validate([
            'dni'       => 'required|string|unique:trabajadores,dni',
            'nombre'    => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono'  => 'required|numeric',
            'sueldo'    => 'required|numeric',
            'rol'       => 'required|in:admin,conductor,peon',
            'password'  => 'required|min:6|confirmed',
        ]);

        // 2. Crear el trabajador en la BD
        Trabajador::create([
            'dni'       => $validated['dni'],
            'nombre'    => $validated['nombre'],
            'apellidos' => $validated['apellidos'],
            'telefono'  => $validated['telefono'],
            'sueldo'    => $validated['sueldo'],
            'rol'       => $validated['rol'],
            // Encriptamos la contraseña antes de guardarla
            'password'  => Hash::make($validated['password']),
        ]);

        // 3. Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Trabajador registrado con éxito.');
    }
}