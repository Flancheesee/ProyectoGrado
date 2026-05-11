<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Mudanza;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Storage;

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
        $conductores = collect();

        if ($trabajador->rol === 'conductor'){
            $mudanzas = Mudanza::where('trabajador_id', $trabajador->dni)->get();
        }
        elseif($trabajador->rol === 'admin'){
            $mudanzas = Mudanza::whereNull('trabajador_id')->get();
            $conductores = Trabajador::where('rol', 'conductor')->get();
        }
        elseif($trabajador->rol === 'peon'){
            $mudanzas = Mudanza::get();
        }

        // 3. Enviamos todo a la vista
        return view('dashboard', compact('trabajador', 'mudanzas', 'conductores'));
    }

    public function editProfile()
    {
        return view('editar');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validamos los datos
        $request->validate([
            'mote'      => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'telefono'  => 'nullable|string|max:20',
            'password'  => 'nullable|min:6|confirmed', // 'confirmed' requiere un input llamado password_confirmation
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 2. Actualizamos los datos (según los nombres de tu tabla en la captura)
        $user->mote = $request->mote;
        $user->name = $request->name; 
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->telefono = $request->telefono;

        // Actualizar contraseña solo si el usuario escribió algo
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Gestión de la foto (tu columna es foto_perfil)
        if ($request->hasFile('foto')) {
            if ($user->foto_perfil) {
                Storage::disk('public')->delete($user->foto_perfil);
            }
            // Guardamos la nueva
            $ruta = $request->file('foto')->store('perfiles', 'public');
            $user->foto_perfil = $ruta;
        }

        $user->save();

        return redirect()->route('cuenta')->with('success', 'Perfil actualizado correctamente.');
    }
}