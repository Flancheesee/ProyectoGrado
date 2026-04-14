<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="{{ asset('CSS/register.css') }}">
    </head>
    <body>
        <header>
            <h1>MOVE IT</h1>
            <img src="{{ asset('img/place_logo.png') }}" alt="Logo">
        </header>

        <form id="registro" enctype="multipart/form-data">
            <label class="title" for="foto_perfil" style="margin-bottom: 5px; font-weight: bold;">REGISTRO</label>
            <input type="text" name="mote" placeholder="Nombre de usuario" required>
            <input type="text" name="nombre" placeholder="Nombre real" required>
            <input type="text" name="Apellidos" placeholder="Apellidos" required> <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="text" name="tlfn" placeholder="999 99 99 99" required> <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="re_password" placeholder="Repite la contraseña" required> <label for="foto_perfil" style="margin-bottom: 5px; font-weight: bold;">Foto de perfil:</label>
            <input id="foto_perfil" name="imagen" type="file" accept="image/*" onchange="previewImage(event)">
            
            <button type="submit" class="btn-enviar">Entrar</button>
        </form>
    </body>
</html>