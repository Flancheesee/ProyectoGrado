<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT</title>
        <link rel="stylesheet" href="{{ asset('CSS/home.css') }}">
    </head>


    <body>
        
        @extends('layouts.main')

        @section('contenido')

            <article id="infoPrincipal">
                <div id="tituloHome">
                    <h1>BIENVENIDO A MOVE IT</h1>
                </div>

                <p class="texto-bienvenida">
                    Bienvenido a <b>MOVE IT</b> la empresa número 1 en mudanzas en toda la peninsula. Si tienes que mudarte y no sabes como ¡solo llamanos!
                </p>

                <div id="introduccion" class="home">
                    <div id="inicio" class="seccion-flex">
                        <div class="texto">
                            <h2>INICIOS</h2>
                            <p><b>MOVE IT</b> fue fundada en 2026 por Francisco Martin Jeronimo. La idea detras de esta aplicación surgio tras ver como ninguna empresa de mudanzas tenia buena reputación. Si nos eliges a nosotros nos encargaremos de que tu servicio sea el <b>mejor</b> posible.</p>
                        </div>
                        <img class="presentacion" src="{{ asset('IMG/inicios.avif') }}" alt="Inicios">
                    </div>

                    <div id="nosotros" class="seccion-flex">
                        <div class="texto">
                            <h3>¿Porque elegirnos a nosotros?</h3>
                            <p>Si no nos conoces, seguramente no seamos tu unica opción, pero nuestros clientes siempre nos recomiendan a sus conocidos. Ofrecemos un servicio de seguridad el cual garantiza que el 100% de tus articulos llegara en el mismo estado en el que se embalaron.</p>
                        </div>
                        <img class="presentacion" src="{{ asset('IMG/home_trabajo.jpg') }}" alt="Nosotros">
                    </div>

                    <div id="enlace_mudanza">
                        <h3>Unete a nuestros clientes y haz tu mudanza con nosotros</h3>
                        <a class="btn-directo" href="{{ route('envios')}}">Ir a mudanzas</a>
                    </div>
                </div>
            </article>

        @endsection()

    </body>
</html>