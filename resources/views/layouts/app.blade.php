<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEAA</title>
    <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}" type="image/ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--c3_fondo);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Encabezado fijo */
        .header {
            width: 100%;
            height: 80px;
            background-color: var(--c1_primario);
            display: flex;
            align-items: center;
            justify-content: left;
            position: fixed;
            top: 0;
            left: 10;
            z-index: 1000;
            padding: 10px 20px;
        }

        .header img {
            height: 38px;
        }

        .main-content {
            margin-top: 100px; /* Ajusta según la altura del header */
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centra horizontalmente */
            justify-content: flex-start; /* Alinea el contenido arriba */
            min-height: calc(100vh - 100px); /* Resta la altura del header */
            text-align: center;
            width: 100%;
        }

        /* Botón de menú alineado a la derecha */
        .toggle-btn {
            position: fixed;
            top: 18px;
            right: 20px;
            background-color: var(--c1_primario);
            color: var(--c2_secundario);
            border: none;
            padding: 10px 15px;
            font-size: 22px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1100;
        }


        /* Menú lateral alineado a la derecha (Escritorio) */
        .sidebar {
            height: 110vh;
            background-color: var(--c2_primario);
            color: white;
            padding: 0.2rem;
            width: 310px;
            position: fixed;
            right: 0;
            top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 -10px rgba(0, 0, 0, 0.2);
        }

        /* Clase para mostrar el menú */
        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar .profile {
            text-align: center;
            margin-bottom: 0px;
            padding: 10px;
            width: 100%;
        }

        .sidebar .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 0px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 18px;
            padding: 15px;
            width: 100%;
        }

        .sidebar a:hover {
            background-color: var(--c2_secundario);
        }

        .separator {
            width: 90%; /* Hace que la línea no ocupe todo el ancho, pero casi */
            height: 1px; /* Ajusta el grosor de la línea */
            background-color: #ffffff; /* Color más sutil */
            margin: 1px auto; /* Centra y da un poco de espacio */
            
        }

        /* Diseño en móviles (ocupa toda la pantalla) */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 100vh;
                top: 80px;
                right: 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ asset('storage/img/Logotipo1.png') }}" alt="LogoCEAA">
    </div>

    <button id="toggle-menu" class="toggle-btn">
        <i class="fas fa-bars"></i>
    </button>

    @yield('content')

    <div class="sidebar" id="sidebar">
        <div class="profile">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="Usuario">
            <h3>Usuario_2025</h3>
        </div>

        <a href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a>
        <div class="separator"></div>
        <a href="{{ route('registro') }}"><i class="fas fa-users"></i> Registro del comité</a>
        <a href="{{ route('documentacion.index') }}"><i class="fas fa-info-circle"></i> Información de obra</a>
        <a href="{{ route('seguimiento-Obra') }}"><i class="fas fa-tasks"></i> Seguimiento de la CEAA</a>
        <a href="{{ route('segComite.index') }}"><i class="fas fa-user-check"></i> Seguimiento del comité</a>
        <a href="{{ route('progresoObra') }}"><i class="fas fa-chart-line"></i> Progreso de obra</a>
        <a href="{{ route('buzon-quejas.index') }}"><i class="fas fa-comment-dots"></i> Buzón de quejas y sugerencias</a>
        <div class="separator"></div>
        <a href="#cerrar-sesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    </div>

    <script>
        document.getElementById('toggle-menu').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
