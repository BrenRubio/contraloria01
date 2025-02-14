<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Obra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .section-title {
            background-color: #d4af89;
            padding: 8px 15px;
            font-weight: bold;
            color: #7d1c1c;
            border-radius: 5px;
        }
        .card-container {
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .icon-actions i {
            cursor: pointer;
            margin-left: 8px;
        }
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
        <h3 class="text-center text-uppercase fw-bold text-secondary">Seguimiento de la Obra por la CEAA</h3>
        <hr>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">TR09SDCDEW4</h5>
            <input type="text" class="form-control w-25" placeholder="Buscar obra">
        </div>

        <div class="card-container p-3">
            <div class="section-title">Contraloría Social</div>
            <ul class="list-unstyled mt-2">
                <li><i class="bi bi-check-circle text-success"></i> Constitución del comité</li>
                <li><i class="bi bi-check-circle text-success"></i> Evento de capacitación</li>
                <li><i class="bi bi-check-circle text-success"></i> <span class="text-danger">Entrega de constancia (Registro SICS)</span></li>
                <li>Visitas de seguimiento:
                    <ul>
                        <li><i class="bi bi-check-circle text-success"></i> Visita 1</li>
                        <li><i class="bi bi-check-circle text-success"></i> Visita 2</li>
                        <li><i class="bi bi-circle text-warning"></i> Visita 3</li>
                    </ul>
                </li>
                <li><i class="bi bi-circle text-warning"></i> Informe final del comité</li>
            </ul>
            <div class="icon-actions d-flex justify-content-end">
                <i class="bi bi-pencil-square text-primary"></i>
                <i class="bi bi-download text-secondary"></i>
            </div>
        </div>

        <div class="mt-3 p-3 section-title">Seguimiento de Atención Social</div>
    </div>
    <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>
</body>
</html>