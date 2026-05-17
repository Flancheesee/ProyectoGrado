<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tu cuenta - Move It</title>
        <link rel="stylesheet" href="{{ asset('CSS/cuenta.css') }}">
    </head>
    <body>
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-img-wrapper">
                    @if(Auth::user()->foto_perfil)
                        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil">
                    @else
                        {{-- Imagen por defecto --}}
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nombre) }}&background=D6B87A&color=fff" alt="Avatar">
                    @endif
                </div>
                <h1 class="username">{{ Auth::user()->mote }}</h1>
            </div>

            <div class="profile-body">
                <div class="info-grid">

                    <div class="info-item">
                        <span class="info-label">Nombre</span>
                        <span class="info-value">{{ Auth::user()->name }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Apellidos</span>
                        <span class="info-value">{{ Auth::user()->apellidos }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Correo Electrónico</span>
                        <span class="info-value">{{ Auth::user()->email }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value">{{ Auth::user()->telefono ?? 'No especificado' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Miembro desde</span>
                        <span class="info-value">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                <a href="{{ route('cuenta.editar')}}" class="btn-edit">Editar Perfil</a>
                <a href="{{ route('home')}}" class="btn-edit">Volver a casa</a>
            </div>
        </div>
    </body>
</html>