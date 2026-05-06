<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mudanza;

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
            
            return redirect()->intended('/work/dashboard');
        }

        // Si falla, volvemos atrás con error
        return back()->withErrors([
            'dni' => 'El DNI o la contraseña no coinciden con nuestros registros de empleados.',
        ])->onlyInput('dni');
    }

    public function logout(Request $request, $guard = 'web')
    {
        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function logoutCliente(Request $request)
    {
        $this->logout($request, 'web');
        
        return redirect()->intended(url()->previous());
    }

    public function logoutTrabajador(Request $request)
    {
        $this->logout($request, 'worker');
        
        return redirect('/work');
    }

    public function showDashboard()
    {
        // 1. Obtenemos al trabajador autenticado
        $trabajador = Auth::guard('worker')->user();

        // 2. Cargamos las mudanzas
        $mudanzas = collect(); // Colección vacía por defecto para evitar errores en la vista
        
        dd(Mudanza::whereNull('trabajador_id')->get());

        if ($trabajador->rol === 'conductor'){
            $mudanzas = Mudanza::where('trabajador_id', $trabajador->dni)->get();
        }
        elseif($trabajador->rol === 'admin'){
            $mudanzas = Mudanza::whereNull('trabajador_id')->get();
        }
        elseif($trabajador->rol === 'peon'){
            $mudanzas = Mudanza::get();
        }

        // 3. Enviamos todo a la vista
        return view('dashboard', compact('trabajador', 'mudanzas'));
    }
}