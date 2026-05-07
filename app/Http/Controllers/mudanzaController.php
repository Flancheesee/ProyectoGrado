<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Vivienda;
use App\Models\Vehiculo;
use App\Models\Mudanza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MudanzaController extends Controller
{
    public function store(Request $request) 
    {
        // 1. Validación
        $validator = Validator::make($request->all(), [
            'direccion_origen' => 'required|string',
            'direccion_destino' => 'required|string',
            'tipo_origen' => 'required',
            'tipo_destino' => 'required',
            'fecha_mudanza' => 'required|date|after:today',
            'cantidad_empleados' => 'required|integer|min:1',
            'vehiculo' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'mudanza')->withInput();
        }

        $data = $validator->validated();

        try {
            DB::beginTransaction();

            // 2. BUSCAR EL VEHÍCULO
            $numeroVehiculo = str_replace('camion', '', $data['vehiculo']); 
            $vehiculo = Vehiculo::where('nombre', 'Vehiculo ' . $numeroVehiculo)->first();

            if (!$vehiculo) {
                return redirect()->back()->with('error', 'El vehículo seleccionado no existe en nuestra base de datos.');
            }

            // 3. Crear Vivienda Origen

            $viviendaOrigen = Vivienda::create([
                'user_id'   => Auth::id(),
                'nombre'    => 'Origen: ' . Auth::user()->mote,
                'tipo'      => $data['tipo_origen'],
                'direccion' => $data['direccion_origen'],
            ]);


            // 4. Crear la Mudanza
            Mudanza::create([
                'user_id'                => Auth::id(),
                'vivienda_origen_id'     => $viviendaOrigen->vivienda_id,
                'direccion_destinatario' => $data['direccion_destino'], 
                'cantidad_empleados'     => $data['cantidad_empleados'],
                'matricula_vehiculo'     => $vehiculo->matricula,
                'estado'                 => 'pendiente'
            ]);

            DB::commit();
            return redirect()->back()->with('success', '¡Mudanza solicitada correctamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar la mudanza: ' . $e->getMessage());
        }
    }

    public function asignarTrabajador(Request $request)
    {
        $request->validate([
            'mudanza_id' => 'required|exists:mudanzas,mudanza_id',
            'trabajador_id' => 'required|exists:trabajadores,dni',
        ]);

        $mudanza = Mudanza::find($request->mudanza_id);
        $mudanza->trabajador_id = $request->trabajador_id;
        $mudanza->estado = 'en_curso'; // Opcional: cambiar estado al asignar
        $mudanza->save();

        return redirect()->back()->with('success', 'Conductor asignado correctamente a la mudanza #' . $request->mudanza_id);
    }
}
