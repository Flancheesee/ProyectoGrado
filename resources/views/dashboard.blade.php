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

                @if(session('success'))
                    <div id="alerta-exito" class="alerta-exito">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <h1>Bienvenido/a, {{ Auth::guard('worker')->user()->nombre }}</h1>
                
                <div class="role-specific-content">
                    {{-- Lógica para detectar el tipo de trabajador --}}
                    @if(Auth::guard('worker')->user()->rol === 'peon')
                        <p>Hola peon</p>

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
                            </div>
                        </div>

                        <div id="modalGestion" class="modal-overlay">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Gestionar Mudanzas</h3>
                                    <button class="close-modal" onclick="closeModal('modalGestion')">&times;</button>
                                </div>
                                <div class="modal-body">
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
                                                                    <td class="text-center">#{{ $mudanza->id }}</td>
                                                                    <td>{{ $mudanza->origen }}</td>
                                                                    <td>{{ $mudanza->destino }}</td>
                                                                    <td>{{ $mudanza->fecha ? (\Carbon\Carbon::parse($mudanza->fecha)->format('d/m/Y')) : 'Sin fecha' }}</td>
                                                                    <td class="text-center">
                                                                        <button class="btn-admin" style="padding: 5px 12px; font-size: 0.8rem; margin: 0;">
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
                                    </form>
                                </div>
                            </div>
                        </div>
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
        <script src="{{ asset('js/dashboard.js') }}"></script>
    </body>
</html>