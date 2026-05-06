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
                <h1>Bienvenido, {{ Auth::guard('worker')->user()->nombre }}</h1>
                
                <div>
                    <p><strong>DNI:</strong> {{ Auth::guard('worker')->user()->dni }}</p>
                    <p><strong>Rol:</strong> <span class="badge">{{ ucfirst(Auth::guard('worker')->user()->rol) }}</span></p>
                </div>

                <hr>

                {{-- Formulario de Logout (Importante para cerrar sesión) --}}
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