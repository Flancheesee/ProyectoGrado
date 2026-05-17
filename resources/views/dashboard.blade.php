<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Move it</title>
        <link rel="stylesheet" href="{{ asset('CSS/work.css') }}">
    </head>
    <body>

        @extends('layouts.work')

        @section('title', 'Login Trabajadores - Move It')

        @section('content')
        
        <header class="worker-header">
            @if(Auth::guard('worker')->check())

                @if(session('success'))
                    <div id="alerta-exito" class="alerta-exito">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <h1>Bienvenido/a, {{ Auth::guard('worker')->user()->nombre }}</h1>
                
                <div class="role-specific-content">
                    {{-- Lógica para detectar el tipo de trabajador --}}

<!--
    /////////////////////////////////////////////////////        
        PEÓN
    /////////////////////////////////////////////////////  
-->


                    @if(Auth::guard('worker')->user()->rol === 'peon')
                        <div class="card" style="margin-top: 20px; padding: 20px;">
                            <h2 style="color: var(--azul-oscuro);">🛻 Mis Mudanzas Asignadas</h2>

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
                                            <tr style="border-bottom: 1px solid #eee; text-align: center;">
                                                <td style="padding: 10px;">{{ $mudanza->mudanza_id }}</td>

                                                <td style="padding: 10px;">
                                                    {{ $mudanza->origen?->direccion ?? 'No especificada' }}
                                                </td>

                                                <td style="padding: 10px;">
                                                    {{ $mudanza->direccion_destinatario?->direccion ?? $mudanza->direccion_destinatario ?? 'No especificada' }}
                                                </td>

                                                <td style="padding: 10px;">
                                                    {{ $mudanza->fecha_mudanza ?? 'Sin fecha' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    @elseif(Auth::guard('worker')->user()->rol === 'conductor')

<!--
    /////////////////////////////////////////////////////        
        CONDUCTOR
    /////////////////////////////////////////////////////  
-->

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
                                            <tr style="border-bottom: 1px solid #eee; text-align: center;">
                                                <td style="padding: 10px;">{{ $mudanza->mudanza_id }}</td>
                                                
                                                <td style="padding: 10px;">
                                                    {{ $mudanza->origen ?->direccion ?? 'No especificada' }}
                                                </td>
                                                                                                
                                                <td style="padding: 10px;">
                                                    {{ $mudanza->direccion_destinatario?->direccion ?? $mudanza->direccion_destinatario }}
                                                </td>
                                                
                                                <td style="padding: 10px;">{{ $mudanza->fecha_mudanza ?? 'Sin fecha' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

<!--
    /////////////////////////////////////////////////////        
        ADMINISTRADOR
    /////////////////////////////////////////////////////  
-->

                    @elseif(Auth::guard('worker')->user()->rol === 'admin')

                        @if ($errors->any())
                            <div class="error-list">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <script>
                                // Si hay errores, forzamos que el modal se mantenga abierto al recargar
                                document.addEventListener("DOMContentLoaded", function() {
                                    openModal('modalTrabajador');
                                });
                            </script>
                        @endif

                        <div class="dashboard-card">
                            <h2>Panel de Administración</h2>
                            <div class="admin-actions">
                                <button class="btn-admin" onclick="openModal('modalGestion')">🚚 Gestionar Mudanzas</button>
                                <button class="btn-admin" onclick="openModal('modalTrabajador')">👤 Crear Trabajador</button>
                                <button class="btn-admin" onclick="openModal('modalBorrar')">❌ Eliminar Trabajador</button>
                            </div>
                        </div>

                        <div id="modalGestion" class="modal-overlay">
                            <div class="modal-content" style="max-width: 800px;">
                                <div class="modal-header">
                                    <h3>🚚 Mudanzas Pendientes de Asignar</h3>
                                    <button class="close-modal" onclick="closeModal('modalGestion')">&times;</button>
                                </div>

                                <div class="modal-body">
                                    @if($mudanzas->isEmpty())
                                        <div style="text-align: center; padding: 20px;">
                                            <p>No hay mudanzas sin asignar. ¡Todo está al día! ✨</p>
                                        </div>
                                    @else
                                        <table class="work-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th>Origen</th>
                                                    <th>Destino</th>
                                                    <th>Fecha</th>
                                                    <th class="text-center">Acción</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($mudanzas as $mudanza)
                                                    <tr>
                                                        <td class="text-center">#{{ $mudanza->mudanza_id }}</td>
                                                        <td>{{ $mudanza->vivienda_origen_id }}</td>
                                                        <td>{{ $mudanza->direccion_destinatario }}</td>

                                                        <td>
                                                            {{ $mudanza->fecha_mudanza 
                                                                ? \Carbon\Carbon::parse($mudanza->fecha_mudanza)->format('d/m/Y') 
                                                                : 'Sin fecha' }}
                                                        </td>

                                                        <td class="text-center">
                                                            <button class="btn-admin"
                                                                onclick="prepararAsignacion('{{ $mudanza->mudanza_id }}')"
                                                                style="padding: 5px 12px; font-size: 0.8rem; margin: 0;">
                                                                Asignar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="modalAsignarConductor" class="modal-overlay">
                            <div class="modal-content" style="max-width: 500px;">
                                <div class="modal-header">
                                    <h3>Asignar Conductor</h3>

                                    <button class="close-modal"
                                        onclick="closeModal('modalAsignarConductor')">
                                        &times;
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('mudanzas.asignar') }}" method="POST">
                                        @csrf

                                        <input type="hidden"
                                            name="mudanza_id"
                                            id="input_mudanza_id">

                                        <div class="form-group">
                                            <label for="trabajador_id">
                                                Seleccionar Conductor
                                            </label>

                                            <select name="trabajador_id"
                                                id="trabajador_id"
                                                required
                                                class="form-control">

                                                <option value="" disabled selected>
                                                    Elige un empleado...
                                                </option>

                                                @foreach($conductores as $t)
                                                    <option value="{{ $t->dni }}">
                                                        {{ $t->nombre }} {{ $t->apellidos }}
                                                        ({{ $t->rol }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-footer" style="margin-top: 20px;">
                                            <button type="submit" class="btn-admin">
                                                Confirmar Asignación
                                            </button>
                                        </div>
                                    </form>
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
                                    <form action="{{ route('trabajador.store') }}" method="POST" class="admin-form">
                                        @csrf
                                        <div class="form-grid">
                                            <div class="form-group">
                                                <label for="dni">DNI</label>
                                                <input type="text" name="dni" id="dni" required 
                                                        pattern="[0-9]{8}[A-Za-z]" 
                                                        title="8 números y una letra" 
                                                        placeholder="12345678Z" 
                                                        maxlength="9">
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" required placeholder="Ej. Juan">
                                            </div>

                                            <div class="form-group">
                                                <label for="apellidos">Apellidos</label>
                                                <input type="text" name="apellidos" id="apellidos" required placeholder="Ej. Pérez">
                                            </div>

                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" name="telefono" id="telefono" required 
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                                    pattern="[0-9]{9}" 
                                                    minlength="9"
                                                    maxlength="9" 
                                                    title="El teléfono debe tener exactamente 9 dígitos"
                                                    placeholder="666778899">
                                            </div>

                                            <div class="form-group">
                                                <label for="sueldo">Sueldo (€)</label>
                                                <input type="number" name="sueldo" id="sueldo" required 
                                                    min="1000" max="100000" 
                                                    placeholder="1500">
                                            </div>

                                            <div class="form-group">
                                                <label for="rol">Rol del Trabajador</label>
                                                <select name="rol" id="rol" required>
                                                    <option value="" disabled selected>Selecciona un rol</option>
                                                    <option value="peon">Peón</option>
                                                    <option value="conductor">Conductor</option>
                                                    <option value="admin">Administrador</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Contraseña</label>
                                                <input type="password" name="password" id="password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password_confirmation">Confirmar Contraseña</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn-admin">Registrar Trabajador</button>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert-errors" style="background: #fee2e2; color: #991b1b; padding: 12px; margin-bottom: 15px; border-radius: 6px; border: 1px solid #fca5a5; font-size: 14px;">
                                                <b style="display: block; margin-bottom: 5px;">⚠️ Por favor, corrige los siguientes errores:</b>
                                                <ul style="margin: 0; padding-left: 20px;">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="modalBorrar" class="modal-overlay">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 style="color: #d9534f;">Eliminar Trabajador</h3>
                                    <button class="close-modal" onclick="closeModal('modalBorrar')">&times;</button>
                                </div>
                                
                                <div class="modal-body">
                                    <p style="margin-bottom: 20px; color: #666;">
                                        Introduce el DNI del trabajador para confirmar su baja definitiva del sistema.
                                    </p>

                                    <form action="{{ route('trabajadores.delete') }}" method="POST" class="admin-form">
                                        @csrf
                                        @method('DELETE')

                                        <div class="form-grid" style="display: block;"> <div class="form-group">
                                                <label for="dni_delete">DNI del Trabajador</label>
                                                <input type="text" name="dni" id="dni_delete" required 
                                                    pattern="[0-9]{8}[A-Za-z]" 
                                                    title="8 números y una letra" 
                                                    placeholder="12345678Z" 
                                                    maxlength="9">
                                            </div>
                                        </div>

                                        <div class="form-footer" style="margin-top: 25px;">
                                            <button type="submit" class="btn-admin" style="background-color: #d9534f; border-color: #b52b27;">
                                                Confirmar Eliminación
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    @endif
                </div>

                <hr>

                <div>
                    <p><span class="badge">{{ ucfirst(Auth::guard('worker')->user()->rol) }}</span></p>
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

        <script src="{{ asset('JS/dashboard.js') }}"></script>

        @endsection
    </body>
</html>