<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Vivienda;
use App\Models\Mudanza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MudanzaController extends Controller
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'direccion_origen' => 'required|string',
            'direccion_destino' => 'required|string',
            'tipo_origen' => 'required',
            'tipo_destino' => 'required',
            'fecha_mudanza' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'mudanza')->withInput();
        }

        $data = $validator->validated();

        try {
            DB::beginTransaction();

            $viviendaOrigen = Vivienda::create([
                'user_id'   => Auth::id(),
                'nombre'    => 'Origen: ' . Auth::user()->mote,
                'tipo'      => $data['tipo_origen'],
                'direccion' => $data['direccion_origen'],
            ]);

            $viviendaDestino = Vivienda::create([
                'user_id'   => Auth::id(),
                'nombre'    => 'Destino: ' . Auth::user()->mote,
                'tipo'      => $data['tipo_destino'],
                'direccion' => $data['direccion_destino'],
            ]);

            Mudanza::create([
                'user_id'                => Auth::id(),
                'vivienda_origen_id'     => $viviendaOrigen->vivienda_id,
                'direccion_destinatario' => $viviendaDestino->direccion, 
                'cantidad_empleados'     => 0,
                'cantidad_vehiculos'     => 0,
                'estado'                 => 'pendiente'
            ]);

            DB::commit();
            return redirect()->back()->with('success', '¡Mudanza y viviendas registradas!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }
}
