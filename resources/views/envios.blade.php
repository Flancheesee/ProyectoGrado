<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT - ENVIOS</title>
        <link rel="stylesheet" href="{{ asset('CSS/envios.css') }}">
    </head>

    <body>

        @extends('layouts.main')

        @section('contenido')

            <article id="infoPrincipal" class="hero-section">
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <h1 class="hero-title">Tu mudanza, sin estrés y al mejor precio</h1>
                <p class="hero-subtitle">Nos encargamos de todo para que disfrutes de tu nuevo hogar. Embalaje profesional, transporte seguro y montaje incluido.</p>

                <div class="hero-cta">
                    @auth
                        <button class="btn-mudanza-principal" onclick="toggleMudanza()">
                            📦 HACER UNA MUDANZA
                        </button>
                    @else
                        <button class="btn-mudanza-principal" onclick="notLogged()">
                            📦 HACER UNA MUDANZA
                        </button>
                    @endauth
                </div>
                
                <div class="hero-features">
                    <span>✅ Presupuesto Inmediato</span>
                    <span>✅ Seguro a todo riesgo</span>
                    <span>✅ Flota adaptada</span>
                </div>
            </div>
        </article>

        @endsection()


        <!-- WARNING SI NO INICIASTE SESION -->

        <div id="overlayWarning" class="modal-overlay-mudanza" onclick="cerrarWarning()">
            <div class="modal-content-mudanza warning-box" onclick="event.stopPropagation()">
                <span class="close-btn" onclick="cerrarWarning()">&times;</span>
                <h3 style="color: #7B5A37;">¡Atención!</h3>
                <p>Para solicitar una mudanza y gestionar tus datos, es necesario estar registrado en nuestro sistema.</p>
                
                <div class="botones-warning">
                    <button class="btn-enviar-mudanza" onclick="irAlLogin()">Iniciar Sesión / Registrarse</button>
                    <button class="btn-cancelar" onclick="cerrarWarning()">Volver</button>
                </div>
            </div>
        </div>


        <!-- FORMULARIO PARA MUDANZA -->

        <div id="overlayMudanza" class="modal-overlay-mudanza" onclick="toggleMudanza()">
            <div class="modal-content-mudanza" onclick="event.stopPropagation()">
                <span class="close-btn" onclick="toggleMudanza()">&times;</span>
                <h2>Solicitar Nueva Mudanza</h2>

                <p>Introduce los detalles para calcular tu presupuesto.</p> 

                <form action="{{ route('mudanzas.store') }}" method="POST">
                    @csrf

                    <!-- VIVIENDA -->
                    
                    <div class="form-group-row">
                        <div class="input-box">
                            <label>Tipo Vivienda</label>
                            <select name="tipo_origen">
                                <option value="piso">Piso</option>
                                <option value="casa">Casa/Chalet</option>
                                <option value="oficina">Oficina</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label>Dirección Origen</label>
                            <input type="text" name="direccion_origen" value="{{ old('direccion_origen') }}" required>
                            @error('direccion_origen', 'mudanza') 
                                <span style="color:red;">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="form-group-row">
                        <div class="input-box">
                            <label>Tipo Vivienda</label>
                            <select name="tipo_destino">
                                <option value="piso">Piso</option>
                                <option value="casa">Casa/Chalet</option>
                                <option value="oficina">Oficina</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label>Dirección Destino</label>
                            <input type="text" name="direccion_destino" value="{{ old('direccion_destino') }}" required>
                            @error('direccion_destino', 'mudanza') 
                                <span style="color:red;">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <!-- FECHA -->

                    <div class="input-box full">
                        <label>Fecha deseada</label>
                        <input type="date" name="fecha_mudanza" value="{{ old('fecha_mudanza') }}" required>
                        @error('fecha_mudanza', 'mudanza') 
                            <span style="color:red;">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- EMPLEADOS -->
                    <div class="input-box full">
                        <label>Cantidad de empleados</label>
                        <input type="number" name="cantidad_empleados" min="1" max="15" value="{{ old('cantidad_empleados', 1) }}" required>
                        @error('cantidad_empleados', 'mudanza') 
                            <span style="color:red;">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- VEHÍCULOS -->
                    <div class="input-box full">
                        <label>Selecciona un vehículo</label>

                        <div class="mudanza-vehiculo">
                            @for($i = 1; $i <= 4; $i++)
                                <label class="vehicle-option">
                                    <input type="radio" name="vehiculo" value="camion{{ $i }}"
                                        {{ old('vehiculo') == "camion$i" ? 'checked' : '' }} required>
                                    
                                    <div class="vehicle-card">
                                        <img src="{{ asset('IMG/Vehiculos/camion'.$i.'.png') }}" alt="Camión {{ $i }}">
                                        <span>Vehículo {{ $i }}</span>
                                    </div>
                                </label>
                            @endfor
                        </div>

                        @error('vehiculo', 'mudanza') 
                            <span style="color:red;">{{ $message }}</span> 
                        @enderror
                    </div>

                    <button type="submit" class="btn-enviar-mudanza">
                        Confirmar Solicitud
                    </button>
                </form>
            </div>
        </div>

        <!-- Filtro errores mudanza-->
         @if ($errors->hasBag('mudanza') && $errors->mudanza->any())
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let modalMudanza = document.getElementById('overlayMudanza');
                    
                    if (modalMudanza) {
                        // Forzamos a que se muestre. 
                        modalMudanza.style.display = 'flex'; 
                    }
                });
            </script>
        @endif
    </body>
</html>