<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT - ENVIOS</title>
        <link rel="stylesheet" href="{{ asset('CSS/envios.css') }}">
    </head>

    <body>
        <header id="menu" class="menu"> 
            <div id="logo">
                <img src="{{ asset('img/place_logo.png') }}" alt="logo">
            </div>

            <div id="infoYredes">
                <div id="informacion">
                    <p>👤 +11 111 111 111</p>
                    <p>✉ correo@empresa.com</p>
                    <p>⏰ 9:00 - 21:00</p>
                </div>

                <div id="redes">
                    <p id="facebook">
                        <a href="https://facebook.com" target="_blank" rel="noopener"><img src="{{ asset('IMG/facebook_logo.png') }}"></a>
                        <span>move_it</span>
                    </p>
                    <p id="instagram">
                        <a href="https://instagram.com" target="_blank" rel="noopener"><img src="{{ asset('IMG/instagram_logo.png') }}"></a>
                        <span>@moveit_España</span>
                    </p>
                    <p id="twitter">
                        <a href="https://x.com" target="_blank" rel="noopener"><img src="{{ asset('IMG/twitter_logo.png') }}"></a>
                        <span>@moveit_España</span>
                    </p>
                </div>
            </div>

            @auth
                <div id="usuario" 
                    data-url="{{ route('cuenta') }}" 
                    onclick="window.location.href=this.getAttribute('data-url');" 
                    style="cursor: pointer;">
                    
                    @if(Auth::user()->foto_perfil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Perfil" class="user-avatar">
                    @else
                        <img src="{{ asset('img/default_user.png') }}" alt="Por defecto" class="user-avatar">
                    @endif
                    
                    <p id="nickname">{{ Auth::user()->mote }}</p>
                    
                    <form action="{{ route('logout') }}" method="POST" class="logout-form" onclick="event.stopPropagation()">
                        @csrf
                        <button type="submit" class="btn-logout">Salir</button>
                    </form>
                </div>
            @else
                <div id="usuario" onclick="toggleLogin()">
                    <img src="{{ asset('img/default_user.png') }}" alt="Invitado" class="user-avatar">
                    <p id="nickname">Inicia sesión</p>
                </div>
            @endauth
        </header>

        <div id="loginModal" class="modal-overlay">
            <div class="modal-content">
                <span class="close-btn" onclick="toggleLogin()">&times;</span>
                <h2>Inicia Sesión</h2>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <button type="submit" class="btn-enviar">Entrar</button>
                </form>
                <p>¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate</a></p>
            </div>
        </div>
        <section>
            <article id="menu_vertical">

                <img id="icono_flecha" src="{{ asset('img/menu_arrow.png') }}" alt="Abrir menú">
                <div id="contenedor_botones">
                    <a href="{{ route('home') }}">
                    <button id="home">🏡 Home</button>
                    </a>
                    <a href="{{ route('envios') }}">
                        <button id="envios">📦 Envios</button>
                    </a>
                    <a href="{{ route('review')}}">
                        <button id="review">⭐ Reseñas</button>
                    </a>
                    <a href="{{ route('faq')}}">
                        <button id="faq">❓ Preguntas frecuentes</button>
                    </a>
                    <a href="{{ route('support')}}">
                        <button id="atencion_al_cliente">🎧 Atencion al cliente</button>
                    </a>
                </div>
            </article>

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
        </section>

        <footer>
            <h1>FOOTER</h1>
        </footer>
        <script src="{{ asset('js/index.js') }}"></script>

        <!-- Filtro de errores login -->

        @if($errors->login->any())
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    toggleLogin();
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                // Si te has registrado correctamente y el controlador envía un mensaje de éxito
                alert("{{ session('success') }}");
            </script>
        @endif

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