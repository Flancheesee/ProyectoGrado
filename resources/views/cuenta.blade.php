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
                <h1 class="username">{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h1>
            </div>

            <div class="profile-body">
                <div class="info-grid">
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

                <a href="#" class="btn-edit">Editar Perfil</a>
            </div>
        </div>
    </body>
</html>