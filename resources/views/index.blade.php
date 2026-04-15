<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT</title>
        <link rel="stylesheet" href="{{ asset('CSS/index.css') }}">
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
                        <a href="https://facebook.com" target="_blank" rel="noopener"><img src="{{ asset('img/facebook_logo.png') }}"></a>
                        <span>move_it</span>
                    </p>
                    <p id="instagram">
                        <a href="https://instagram.com" target="_blank" rel="noopener"><img src="{{ asset('img/instagram_logo.png') }}"></a>
                        <span>@moveit_España</span>
                    </p>
                    <p id="twitter">
                        <a href="https://x.com" target="_blank" rel="noopener"><img src="{{ asset('img/twitter_logo.png') }}"></a>
                        <span>@moveit_España</span>
                    </p>
                </div>
            </div>

            <div id="usuario" onclick="toggleLogin()" style="cursor: pointer; display: flex; align-items: center; gap: 10px;">
                @auth
                    @if(Auth::user()->foto_perfil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" 
                            alt="Perfil" 
                            style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid black;">
                    @else
                        <img src="{{ asset('img/default_user.png') }}" alt="Por defecto" style="width: 30px;">
                    @endif
                    
                    <p id="nickname" style="margin: 0; font-weight: bold;">{{ Auth::user()->mote }}</p>
                    
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 12px; color: red;">(Salir)</button>
                    </form>

                @else
                    <img src="{{ asset('img/default_user.png') }}" alt="" style="width: 30px;">
                    <p id="nickname" style="margin: 0;">Inicia sesión</p>
                @endauth
            </div>
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
                    
                    <a href="{{ route('about_us')}}">
                        <button id="sobre_nosotros">👥 Sobre Nosotros</button>
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

            <article id="infoPrincipal">
    
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque similique rem minima, nihil dolorem inventore veritatis accusamus. Pariatur accusamus quia deserunt veritatis perspiciatis! Dolorum error dolores laboriosam, quod iusto consequatur ad libero sit porro pariatur, exercitationem aspernatur dolor. Quia dolor officia, est odit ipsum consectetur odio libero pariatur earum facilis, asperiores beatae porro quod totam labore sunt veniam modi. Tempora esse quaerat dolorum fugit soluta. Tempora corporis alias tenetur, natus dolores voluptatem dolorem voluptates quo exercitationem consequatur, delectus reiciendis doloribus! Suscipit sit repellendus magnam nostrum, deserunt, culpa nulla atque, doloremque veritatis voluptas ipsum nihil dolorum aliquam repudiandae sint pariatur quis placeat alias laudantium cum. Provident doloribus quidem assumenda ad ipsum. Dignissimos ipsum voluptas itaque similique unde temporibus perspiciatis eius, dolores aperiam possimus minima vero omnis, sit excepturi? Blanditiis eaque labore laboriosam quibusdam beatae fugit, quisquam unde, error, ducimus enim rerum nesciunt. Exercitationem error aliquam beatae ullam, vel tempora, molestiae placeat facere dolor vitae expedita aut enim optio at sed suscipit? Quam iste voluptas quo natus tempore atque aut porro, a nobis deserunt necessitatibus magni laborum culpa, commodi deleniti sed, consectetur est vitae beatae. Recusandae tempora suscipit dolore amet rem aut odit illum perferendis nemo hic temporibus esse, quisquam maiores quidem.</p>
            </article>
        </section>

        <footer>
            <h1>FOOTER</h1>
        </footer>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>
</html>