<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento del Comité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { margin-top: 20px; }
        .btn-custom { background-color: #d6c6a8; color: #000; }
        .btn-custom:hover { background-color: #c5b29e; }
        .list-unstyled li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .input-group { margin-bottom: 20px; }
        .documento { margin-left: 10px; font-size: 0.9em; color: #555; }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #ffa500;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #ff8c00;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #ffa500;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-button:hover {
            background-color: #ff8c00;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-danger">SEGUIMIENTO DEL COMITÉ</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <h4><strong>TR09SDCDEW4</strong></h4>
            <input type="text" class="form-control w-25" placeholder="Buscar obra">
        </div>

        <div class="card">
            <div class="card-header bg-warning text-white">
                <strong>Visitas de seguimiento</strong>
            </div>
            <div class="card-body">
                <form id="visita-form" method="POST" action="{{ route('segComite.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nombre_visita" placeholder="Nombre de la visita" required>
                        <input type="file" class="form-control" name="documento" required>
                    </div>
                    <button class="btn btn-outline-dark" type="submit">➕ Agregar visita</button>
                </form>
                
                <form id="visitas-form" method="POST" action="{{ route('segComite.destroy', 0) }}">
                    @csrf
                    @method('DELETE')
                    <ul class="list-unstyled mt-3" id="visitas-list">
                        @foreach($visitas as $visita)
                            <li>
                                <input type="checkbox" name="visitas[]" value="{{ $visita->id }}">
                                <span>{{ $visita->nombre_visita }}</span>
                                <span class="documento">
                                    <a href="{{ asset('storage/' . $visita->documento) }}" target="_blank">
                                        📄 {{ basename($visita->documento) }}
                                    </a>
                                </span>
                                <div class="float-end">
                                    <button type="button" class="btn btn-outline-warning btn-sm editar-visita" data-id="{{ $visita->id }}">✏️ Editar</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-custom mt-3" type="submit">🗑️ Eliminar visitas seleccionadas</button>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>
</body>
</html>