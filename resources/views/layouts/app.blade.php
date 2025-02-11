<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Comisión Estatal del Agua')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #800000;
            color: white;
            padding: 1rem;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 1rem 0;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .sidebar-header {
            font-weight: bold;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }

        .content {
            margin-left: 260px;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">Usuario 456</div>
        <a href="{{ url('/') }}">Inicio</a>
        <a href="{{ route('registro') }}">Registro del comité</a>
        <a href="{{ route('documentacion.index') }}">Información de obra</a>
        <a href="{{ route('seguimiento-Obra') }}">Seguimiento de la CEAA</a>
        <a href="{{ route('segComite.index') }}">Seguimiento del comité</a>
        <a href="{{ route('progreso-obra') }}">Progreso de obra</a>
        <a href="{{ route('buzon-quejas.index') }}">Buzón de quejas y sugerencias</a>
        <a href="#cerrar-sesion">Cerrar sesión</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>