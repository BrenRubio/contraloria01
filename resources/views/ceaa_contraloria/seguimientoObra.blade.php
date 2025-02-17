<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Obra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <h3 class="titulo">Progreso de obra</h3>
        <div class="linea-separadora"></div>

        <!-- Botón de filtro -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-sm btn-warning d-flex align-items-center">
                <i class="bi bi-funnel me-1"></i> Filtrar
            </button>
        </div>

        <!-- Contenedor de tarjetas -->
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="text-center">
                        <div class="progress-circle">
                            <span class="progress-text">40%</span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="fw-bold">[AQUÍ VA el Código de Obra]</h6>
                        <p class="mb-1">[AQUÍ VA el Tipo de Obra]</p>
                        <p class="mb-1">[AQUÍ VA la Zona]</p>
                        <p class="mb-1">[AQUÍ VA la Ubicación]</p>
                        <p class="fw-bold">[AQUÍ VA el Año]</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="text-center">
                        <div class="progress-circle">
                            <span class="progress-text">75%</span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="fw-bold">[AQUÍ VA el Código de Obra]</h6>
                        <p class="mb-1">[AQUÍ VA el Tipo de Obra]</p>
                        <p class="mb-1">[AQUÍ VA la Zona]</p>
                        <p class="mb-1">[AQUÍ VA la Ubicación]</p>
                        <p class="fw-bold">[AQUÍ VA el Año]</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="text-center">
                        <div class="progress-circle">
                            <span class="progress-text">10%</span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h6 class="fw-bold">[AQUÍ VA el Código de Obra]</h6>
                        <p class="mb-1">[AQUÍ VA el Tipo de Obra]</p>
                        <p class="mb-1">[AQUÍ VA la Zona]</p>
                        <p class="mb-1">[AQUÍ VA la Ubicación]</p>
                        <p class="fw-bold">[AQUÍ VA el Año]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>
    @endsection
</body>
</html>
