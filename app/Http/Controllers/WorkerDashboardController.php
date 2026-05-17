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

        $user = Auth::guard('worker')->user();
        $data = [];

        // ADMIN
        if (auth()->$user->hasRole('Admin')) {
            $data['total_empleados'] = Trabajador::count();
            $data['empleados'] = Trabajador::all();
        }

        // GESTOR
        if (auth()->$user->hasRole('Gestor')) {
            $data['mudanzas_pendientes'] = Mudanza::whereNull('trabajador_id')->get();
            $data['trabajadores_disponibles'] = Trabajador::role('Trabajador')->get();
        }

        // TRABAJADOR
        if (auth()->$user->hasRole('Trabajador')) {
            $data['mis_mudanzas'] = Mudanza::where('trabajador_id', $user->trabajador_id)->get();
        }

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
            \Log::error("Error al borrar trabajador: " . "DNI: {$dni} - " . $e->getMessage());

            return redirect()->back()->with('error', 'No se pudo procesar la baja debido a un problema técnico interno.');
        }
    }
}
