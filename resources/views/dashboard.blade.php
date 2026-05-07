<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Move it</title>
        <link rel="stylesheet" href="{{ asset('CSS/work.css') }}">
    </head>
    <body>
        <header class="worker-header">
            @if(Auth::guard('worker')->check())
                <h1>Bienvenido/a, {{ Auth::guard('worker')->user()->nombre }}</h1>
                
                <div class="role-specific-content">
                    {{-- Lógica para detectar el tipo de trabajador --}}
                    @if(Auth::guard('worker')->user()->rol === 'peon')
                        <p>Hola peon</p>

                    @elseif(Auth::guard('worker')->user()->rol === 'conductor')

                        <div class="card" style="margin-top: 20px; padding: 20px;">
                        <h2 style="color: var(--azul-oscuro);">🚚 Mis Mudanzas Asignadas</h2>
                        
                        @if($mudanzas->isEmpty())
                            <p>No tienes mudanzas asignadas en este momento.</p>
                        @else
                            <table class="work-table" style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: var(--azul-oscuro); color: white;">
                                        <th style="padding: 10px;">ID</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mudanzas as $mudanza)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 10px; text-align: center;">{{ $mudanza->id }}</td>
                                            <td>{{ $mudanza->origen }}</td>
                                            <td>{{ $mudanza->destino }}</td>
                                            <td>{{ $mudanza->fecha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    @elseif(Auth::guard('worker')->user()->rol === 'admin')
                        <div class="dashboard-card">
                            <h2>Panel de Administración</h2>
                            <div class="admin-actions">
                                <button class="btn-admin" onclick="openModal('modalGestion')">🚚 Gestionar Mudanzas</button>
                                <button class="btn-admin" onclick="openModal('modalTrabajador')">👤 Crear Trabajador</button>
                            </div>
                        </div>

                        <div id="modalGestion" class="modal-overlay">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Gestionar Mudanzas</h3>
                                    <button class="close-modal" onclick="closeModal('modalGestion')">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Hola</p>
                                    {{-- Aquí podrías meter la tabla de mudanzas que tenías antes --}}
                                </div>
                            </div>
                        </div>

                        <div id="modalTrabajador" class="modal-overlay">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Crear Nuevo Trabajador</h3>
                                    <button class="close-modal" onclick="closeModal('modalTrabajador')">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Hola</p>
                                    {{-- Aquí irá tu formulario de creación más adelante --}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <hr>

                <div>
                    <p><strong>DNI:</strong> {{ Auth::guard('worker')->user()->dni }}</p>
                    <p><strong>Rol:</strong> <span class="badge">{{ ucfirst(Auth::guard('worker')->user()->rol) }}</span></p>
                </div>

                <hr>

                {{-- Formulario de Logout --}}
                <form action="{{ route('logout.trabajador') }}" method="POST">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            @else
                <h1>No has iniciado sesión</h1>
                <a href="{{ route('trabajador') }}">Ir al Login</a>
            @endif
        </header>
    </body>
</html>