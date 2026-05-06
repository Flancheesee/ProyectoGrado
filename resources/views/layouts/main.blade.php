<header id="menu" class="menu"> 
    <div id="logo">
        <img src="{{ asset('IMG/place_logo.png') }}" alt="logo">
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
                <img src="{{ asset('IMG/default_user.png') }}" alt="Por defecto" class="user-avatar">
            @endif
                        
            <p id="nickname">{{ Auth::user()->mote }}</p>
                        
            <form action="{{ route('logoutCliente') }}" method="POST" class="logout-form" onclick="event.stopPropagation()">
                @csrf
                <button type="submit" class="btn-logout">Salir</button>
            </form>
        </div>
    @else
        <div id="usuario" onclick="toggleLogin()">
            <img src="{{ asset('IMG/default_user.png') }}" alt="Invitado" class="user-avatar">
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

        <img id="icono_flecha" src="{{ asset('IMG/menu_arrow.png') }}" alt="Abrir menú">
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

    @yield('contenido')

</section>

<footer>
    <h1>FOOTER</h1>
</footer>
<script src="{{ asset('JS/index.js') }}"></script>
    @if($errors->any())
<script>
    // Si hay algún error en el formulario (login o registro), salta esta alerta
    alert("Los datos introducidos son incorrectos. Por favor, inténtalo de nuevo.");
                
    toggleLogin(); 
</script>
@endif

@if(session('success'))
    <script>
        // Si te has registrado correctamente y el controlador envía un mensaje de éxito
        alert("{{ session('success') }}");
    </script>
@endif
