<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MOVE IT</title>
        <link rel="stylesheet" href="{{ asset('CSS/support.css') }}">
    </head>

    <body>
        @extends('layouts.main')

        @section('contenido')

            <article id="infoPrincipal">

                <div id="tlfn_ayuda" class="ayuda">
                    <p class="ayuda_text">Si necesitas ayuda no dudes en llamarnos</p>
                    <img class="ayuda_img" src="{{ asset('IMG/ayuda_tlfn.webp') }}" alt="telefono">
                    <p class="ayuda_info">+34 673 223 897</p>
                </div>
            </article>
        @endsection()
    </body>
</html>