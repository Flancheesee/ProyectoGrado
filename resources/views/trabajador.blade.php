<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plataforma de trabajadores - MOVE IT</title>
        <link rel="stylesheet" href="{{ asset('CSS/work.css') }}">

    </head>
    <body>
        @extends('layouts.work')

        @section('title', 'Login Trabajadores - Move It')

        @section('content')
        <div class="login-card">
            <h2>Acceso Empleados</h2>
            <p>Introduce tus credenciales para gestionar tus mudanzas.</p>

            <form action="{{ route('worklogin.post') }}" method="POST" class="work-form">
                @csrf

                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" name="dni" placeholder="12345678X" required value="{{ old('dni') }}">
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" required/>
                </div>

                @if($errors->any())
                    <div class="error-msg">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn-enviar">Entrar al Panel</button>
            </form>
        </div>
        @endsection
    </body>
</html>