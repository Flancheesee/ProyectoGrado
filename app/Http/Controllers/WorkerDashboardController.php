<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mudanza; 
use App\Models\Trabajador;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class WorkerDashboardController extends Controller
{

    use HasRoles;

    public function index()
    {
        // 1. Pillamos al usuario (Trabajador) logueado con el guard de workers
        $user = Auth::guard('worker')->user();
        
        // Si no hay usuario logueado, evitamos errores devolviendo al login
        if (!$user) {
            return redirect()->route('login');
        }

        $data = [];

        //VISTA DE GESTOR
        if ($user->rol === 'Gestor') {
            $data['mudanzas'] = Mudanza::where('estado', 'pendiente')->get();
            $data['trabajadores_disponibles'] = Trabajador::all();
            $data['peones'] = Trabajador::where('rol', 'peon')->get();
        }

        //VISTA DE CONDUCTOR
        if ($user->rol === 'Conductor') {
            $data['mudanzas'] = Mudanza::where('matricula_vehiculo', $user->matricula_vehiculo)->get();
        }

        //VISTA DE PEON 
        if ($user->rol === 'Peon') {

            $data['mudanzas'] = $user->mudanzas; 
        }

        // Enviamos los datos unificados a la plantilla
        return view('worker.dashboard', $data);
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'mudanza_id' => 'required|exists:mudanzas,mudanza_id',
            'trabajador_id' => 'required|exists:trabajadores,trabajador_id',
        ]);

        $mudanza = Mudanza::findOrFail($request->mudanza_id);

        $mudanza->update([
            'trabajador_id' => $request->trabajador_id,
            'estado' => 'asignada'
        ]);

        return back()->with('success', 'Mudanza asignada correctamente.');
    }

    public function asignarPeon(Request $request)
    {
        // 1.- Validamos que nos manden los datos correctos y que existan en la BD
        $validated = $request->validate([
            'mudanza_id' => 'required|exists:mudanzas,mudanza_id',
            'dni'        => 'required|exists:trabajadores,dni',
        ], [
            'mudanza_id.exists' => 'La mudanza seleccionada no existe.',
            'dni.exists'        => 'El DNI introducido no pertenece a ningún trabajador.',
        ]);

        // 2.- Buscamos la mudanza en cuestión
        $mudanza = Mudanza::findOrFail($validated['mudanza_id']);

        // 3.- METEMOS EL REGISTRO EN LA TABLA PEONES_MUDANZA
        // El método attach() busca la relación 'peones' en tu modelo Mudanza 
        // e inserta el dni y el mudanza_id en la tabla pivote de golpe.
        $mudanza->peones()->attach($validated['dni']);

        // 4.- Redirigimos de vuelta con mensaje de éxito
        return redirect()->back()->with('success', 'Peón asignado correctamente a la mudanza.');
    }

    public function delete(Request $request)
    {
        $dni = strtoupper(trim($request->input('dni')));

        $trabajador = Trabajador::where('dni', $dni)->first();

        if (!$trabajador) {
            return redirect()->back()->with('error', 'El DNI introducido no pertenece a ningún trabajador activo.');
        }

        $listaGestores = Trabajador::where('rol', 'admin')->get();
        foreach($listaGestores as $gestor){
            if($dni === $gestor->dni){
                return redirect()->back()->with('error', '¡Operación cancelada! No puedes eliminar tu propia ficha de administrador desde el panel.');
            }
        }

        DB::beginTransaction();
        try {
            $trabajador->delete();
            DB::commit();

            return redirect()->back()->with('success', 'Trabajador eliminado con éxito de Move It.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'No se pudo procesar la baja debido a un problema técnico interno.');
        }
    }
}
