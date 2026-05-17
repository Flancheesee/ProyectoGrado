<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Move It - Workers')</title>
        <link rel="stylesheet" href="{{ asset('CSS/work.css') }}">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header class="main-header">
            <div class="header-container">
                <div class="logo">
                    <strong>MOVE</strong><span>IT</span> <small>| Workers</small>
                </div>
                <nav>
                    @if(!Auth::guard('worker')->check())
                        <span>Portal de Empleados</span>
                    @endif
                </nav>
            </div>
        </header>

        <main class="content-container">
            @yield('content')
        </main>

        <footer class="main-footer">
            &copy; {{ date('Y') }} Move It S.L. - Área Interna
        </footer>
    </body>
</html>