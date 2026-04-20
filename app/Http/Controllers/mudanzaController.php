<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vivienda;
use App\Models\Mudanza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MudanzaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'direccion_origen' => 'required|string',
            'direccion_destino' => 'required|string',
            'fecha_mudanza' => 'required|date|after:today',
        ]);

        try {
            DB::beginTransaction();

            // 1. Crear Vivienda Origen
            $origen = Vivienda::create([
                'Direccion' => $request->direccion_origen,
                'Nombre' => 'Origen',
                'Tipo' => $request->tipo_origen ?? 'piso'
            ]);

            // 2. Crear Vivienda Destino
            $destino = Vivienda::create([
                'Direccion' => $request->direccion_destino,
                'Nombre' => 'Destino',
                'Tipo' => $request->tipo_destino ?? 'piso'
            ]);

            // 3. Crear Mudanza con tu estructura exacta
            Mudanza::create([
                'num_empleados' => 0, // Se asignarán después
                'num_vehiculos' => 0, // Se asignarán después
                'Vivienda_origen' => $origen->id, 
                'Vivienda_destino' => $destino->id,
                'mote_usuario' => Auth::user()->user_id // Tu FK a USUARIO
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Mudanza solicitada. Calculando ruta...');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
