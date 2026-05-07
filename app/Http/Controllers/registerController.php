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
            // DNI: 8 números y una letra (Regex para formato español)
            'dni'       => ['required', 'unique:trabajadores,dni', 'regex:/^[0-9]{8}[A-Z]$/i'],
            'nombre'    => 'required|string|min:2|max:50',
            'apellidos' => 'required|string|min:2|max:100',
            'telefono'  => 'required|digits:9',
            'sueldo'    => 'required|numeric|min:1000|max:50000',
            'rol'       => 'required|in:admin,conductor,peon',
            'password'  => 'required|min:6|confirmed',
        ], [
            // Mensajes personalizados
            'dni.regex' => 'El formato del DNI no es válido (ej: 12345678Z).',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 números.',
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