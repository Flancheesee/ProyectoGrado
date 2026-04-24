<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validar que enviaron los datos
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Seguridad: regenera la sesión

            return redirect()->intended(url()->previous()); 
        }

        // 3. Si falla, volver atrás con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ], 'login')->onlyInput('email');
    }

    public function loginTrabajador(Request $request)
    {
        // Validamos que lleguen ambos campos
        $credentials = $request->validate([
            'dni'      => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentamos el login usando el guard 'worker' que configuramos antes
        if (Auth::guard('worker')->attempt($credentials)) {
            // Regenerar sesión por seguridad
            $request->session()->regenerate();
            
            return redirect()->intended('/worker/dashboard');
        }

        // Si falla, volvemos atrás con error
        return back()->withErrors([
            'dni' => 'El DNI o la contraseña no coinciden con nuestros registros de empleados.',
        ])->onlyInput('dni');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended(url()->previous());
    }
}