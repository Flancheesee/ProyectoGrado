<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT</title>
        <link rel="stylesheet" href="{{ asset('CSS/miMudanza.css') }}">
    </head>

    <body>
        
        @extends('layouts.main')

        @section('contenido')

            <article id="infoPrincipal">
                <div class="contenedor-mudanzas">
                    <h2 class="titulo-seccion">Mis Mudanzas</h2>

                    @guest
                        <div class="estado-vacio">
                            <div class="icono-estado">🔒</div>
                            <p>Para gestionar tus mudanzas, primero debes identificarte.</p>
                        </div>
                    @else
                        <div class="grid-mudanzas">
                            @forelse(Auth::user()->mudanzas as $mudanza)
                                @php 
                                    $vivienda = $mudanza->Origen; 
                                @endphp
                                <div class="card-mudanza">
                                    <div class="card-mudanza">
                                        <div class="card-header">
                                            <span>📦 Orden #{{ $mudanza->mudanza_id }}</span>
                                            <span class="tag-estado">{{ $mudanza->estado }}</span>
                                        </div>

                                        <div class="card-body-layout">
                                            <div class="info-rutas">
                                                <p><strong>Origen:</strong> {{ $vivienda?->direccion ?? 'Dirección no encontrada' }}</p>
                                                <p><strong>Destino:</strong> {{ $mudanza->direccion_destinatario }}</p>
                                                <p class="fecha-mudanza">📅 {{ $mudanza->fecha_mudanza }}</p>
                                            </div>

                                            <div class="info-personal">
                                                <div class="dato-extra">
                                                    <small>Conductor</small>
                                                    <span>👤 {{ $mudanza->conductor?->nombre_completo ?? 'Sin asignar' }}</span>
                                                </div>
                                                <div class="dato-extra">
                                                    <small>Equipo</small>
                                                    <span>👥 {{ $mudanza->cantidad_empleados }} empleados</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="estado-vacio">
                                    <div class="icono-estado">🚛</div>
                                    <p>NO TIENES MUDANZAS, QUIZÁS SEA HORA DE HACER UNA</p>
                                    <a href="{{ route('envios') }}" class="btn-premium">SOLICITAR MUDANZA</a>
                                </div>
                            @endforelse
                        </div>
                    @endguest
                </div>
            </article>
        
        @endsection()

        
    </body>
</html>