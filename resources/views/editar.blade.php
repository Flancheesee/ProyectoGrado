<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tu cuenta - Move It</title>
        <link rel="stylesheet" href="{{ asset('CSS/editar.css') }}">
    </head>
    <body>
        <div class="profile-container">

            <div class="profile-body">
                <form id="registro" action="{{ route('cuenta.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <label class="title-form">EDITAR DATOS</label>
                    
                    <div class="input-group">
                        <label>Mote / Username</label>
                        <input type="text" name="mote" value="{{ Auth::user()->mote }}" required>
                    </div>

                    <div class="input-group">
                        <label>Nombre real</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="input-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" value="{{ Auth::user()->apellidos }}" required>
                    </div>

                    <div class="input-group">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>

                    <div class="input-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="{{ Auth::user()->telefono }}" placeholder="999 99 99 99" required>
                    </div>

                    <div class="input-group">
                        <label>Nueva contraseña</label>
                        <input type="password" name="password" placeholder="Dejar en blanco para no cambiar">
                    </div>

                    <div class="input-group">
                        <label>Confirmar contraseña</label>
                        <input type="password" name="password_confirmation">
                    </div>

                    <div class="input-group">
                        <label>Foto de perfil</label>
                        <div class="custom-file-upload">
                            <input id="foto_perfil" name="foto" type="file" accept="image/*" onchange="previewImage(event)">
                            <span class="file-name">Seleccionar archivo...</span>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="btn-enviar">Guardar Cambios</button>
                        <a href="{{ route('home')}}" class="btn-cancelar">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>