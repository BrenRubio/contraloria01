<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progreso de Obra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .progress-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .progress-circle {
            width: 80px;
            height: 80px;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: #7d1c1c;
        }
        .progress-circle svg {
            transform: rotate(-90deg);
        }
        .filter-button {
            background-color: #c29c6d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
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
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="titulo">Progreso de Obra</h3>
        <div class="linea-separadora"></div>
        <hr>

        <div class="d-flex justify-content-end mb-3">
            <button class="filter-button">
                <i class="bi bi-funnel"></i> Filtrar
            </button>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="progress-card">
                    <div class="progress-circle">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="30" stroke="#d4af89" stroke-width="5" fill="none" />
                            <circle cx="40" cy="40" r="30" stroke="#7d1c1c" stroke-width="5" fill="none" stroke-dasharray="188" stroke-dashoffset="112" />
                        </svg>
                        <span>40%</span>
                    </div>
                    <h6 class="fw-bold">TR09SDCDEW4</h6>
                    <p>Extraordinaria</p>
                    <p>Urbana</p>
                    <p>Fitzhi, Ixmiquipan</p>
                    <p class="fw-bold">2024</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="progress-card">
                    <div class="progress-circle">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="30" stroke="#d4af89" stroke-width="5" fill="none" />
                            <circle cx="40" cy="40" r="30" stroke="#7d1c1c" stroke-width="5" fill="none" stroke-dasharray="188" stroke-dashoffset="47" />
                        </svg>
                        <span>75%</span>
                    </div>
                    <h6 class="fw-bold">TR09SDCDEW4R1</h6>
                    <p>Ordinaria</p>
                    <p>Rural</p>
                    <p>Centro, Actopan</p>
                    <p class="fw-bold">2025</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="progress-card">
                    <div class="progress-circle">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="30" stroke="#d4af89" stroke-width="5" fill="none" />
                            <circle cx="40" cy="40" r="30" stroke="#7d1c1c" stroke-width="5" fill="none" stroke-dasharray="188" stroke-dashoffset="170" />
                        </svg>
                        <span>10%</span>
                    </div>
                    <h6 class="fw-bold">TR09SDCDEW55S</h6>
                    <p>Extraordinaria</p>
                    <p>Urbana</p>
                    <p>Zimapán</p>
                    <p class="fw-bold">2025</p>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
