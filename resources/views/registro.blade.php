<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
    </head>
    <body>
        <form>
            <input type="text" name="mote" placeholder="Nombre de usuario" required>
            <input type="text" name="nombre" placeholder="Nombre real" required>
            <input type="text" name="Apellidos placeholder="Apellidos" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="telefono" name="tlfn" placeholder="999 99 99 99" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="re_password" placeholder="Repite la contraseña required">
            <input id="foto_perfil" name="imagen" type="file" accept="image/*" onchange="previewImage(event)">
            <button type="submit" class="btn-enviar">Entrar</button>
        </form>
    </body>
</html>