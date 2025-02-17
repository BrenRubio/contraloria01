<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEAA</title>
    <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}" type="image/ico">

    <!-- Bootstrap y FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app_1.css') }}">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--c3_fondo);
            padding-top: 60px; /* Evita que el contenido quede oculto bajo el navbar */
        }

        .navbar {
            width: 100%;
            background-color: var(--c1_primario);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1030;
        }

        .responsive-icon {
            font-size: 1.3rem;
            transition: font-size 0.3s ease;
            color: white;
        }

        @media (max-width: 768px) {
            .responsive-icon {
                font-size: 1rem;
            }
        }

        .custom-offcanvas {
            background-color: var(--c2_primario);
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            overflow: hidden;
            width: 370px !important;
            color: white;
            padding-left: 20px;
        }

        .btn-close-custom {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .btn-close-custom i {
            color: #ffffff;
            font-size: 1rem;
        }

        .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: rotate(90deg);
        }

        .menu1 li a {
            color: white !important;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 55px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .menu1 li a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .menu1 i {
            color: white !important;
        }

        /* Ajuste de contenido para no quedar debajo del navbar */
        main {
            padding-top: 80px;
            min-height: 100vh;
        }

        .btn{
            padding-top: 80px;
            min-height: 10vh;
        }
    </style>
</head>
<body>

    <!-- Encabezado fijo -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark w-100" style="background-color: var(--c1_primario); position: fixed; top: 0; left: 0; z-index: 1030;">
            <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/img/Logotipo1.png') }}" alt="Logo CEAA" height="40px" class="me-3">
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn p-0 border-0 bg-transparent">
                        <i class="fas fa-user me-3 text-white"></i>
                    </button>
                    <button class="btn p-0 border-0 bg-transparent me-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                        <i class="fas fa-bars text-white"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido de la página -->
    <main class="container-fluid" style="padding-top: 80px;">
        @yield('content')
    </main>

    <!-- Menú lateral -->
    <div class="offcanvas offcanvas-end custom-offcanvas" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header">
            <div class="d-flex align-items-center py-2">
                <i class="fas fa-user-circle" style="font-size: 5rem; color: #ffffff; margin-right: 18px;"></i>
                <h5 class="mb-0" style="color: #ffffff; font-weight: 600;">Usuario</h5>
            </div>
            <button type="button" class="btn-close-custom" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="list-unstyled menu1">
                <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> <span>Inicio</span></a></li>
                <hr class="m-0 py-2 text-light" style="width: 90%; margin: auto;" />
                <li><a href="{{ route('registro') }}"><i class="fas fa-users"></i> <span>Registro del comité</span></a></li>
                <li><a href="{{ route('documentacion.index') }}"><i class="fas fa-info-circle"></i> <span>Información de la obra</span></a></li>
                <li><a href="{{ route('seguimiento-Obra') }}"><i class="fas fa-tasks"></i> <span>Seguimiento de la CEAA</span></a></li>
                <li><a href="{{ route('segComite.index') }}"><i class="fas fa-list"></i> <span>Seguimiento del Comité</span></a></li>
                <li><a href="{{ route('progreso-obra') }}"><i class="fas fa-percentage"></i> <span>Porcentaje de avance de obra</span></a></li>
                <li><a href="{{ route('buzon-quejas.index') }}"><i class="fas fa-comment-dots"></i> <span>Buzón de quejas y sugerencias</span></a></li>
                <hr class="m-0 py-2 text-light" style="width: 90%; margin: auto;" />
                <li><a href="#cerrar-sesion"><i class="fas fa-sign-out-alt"></i> <span>Cerrar Sesión</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
