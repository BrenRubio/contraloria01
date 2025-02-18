<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Comités</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #800000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4a460;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions {
            text-align: center;
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
        .integrantes {
            margin-top: 20px; /* Espacio entre el título y la lista */
        }
        .integrantes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espacio entre los integrantes */
        }
        .integrante {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            width: calc(33% - 20px); /* Ajusta el ancho según sea necesario */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .info {
            display: flex;
            flex-direction: column;
        }
    </style>
    <!-- Agregar Bootstrap para el modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1 class="titulo">Registro de Comités</h1>
    <div class="linea-separadora"></div>
    <a href="{{ route('beneficiarios.create') }}" class="btn">Agregar Beneficiario</a>
    <a class="btn">Filtrar</a>
    <a class="btn">Generar reporte</a>

    <table>
        <thead>
            <tr>
                <th>Tipo de Obra</th>
                <th>Apartado</th>
                <th>Fecha de Constitución</th>
                <th>Nombre del Comité</th>
                <th>Clave del Comité</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($beneficiarios as $beneficiario)
                <tr>
                    <td>{{ $beneficiario->tipo_obra }}</td>
                    <td>{{ $beneficiario->apartado }}</td>
                    <td>{{ $beneficiario->fecha_constitucion }}</td>
                    <td>{{ $beneficiario->nombre_comite }}</td>
                    <td>{{ $beneficiario->clave_comite }}</td>
                    <td>{{ $beneficiario->entidad_federativa_comite }}, {{ $beneficiario->municipio_comite }}, {{ $beneficiario->localidad_comite }}</td>
                    <td class="actions">
                        <!--<a href="/CAASIM/48-rubros/actual/xlsx/a69_f02bCAASIM.xlsx" target="_blank" rel="noreferrer">XLSX?</a> -->
                        <button class="btn" data-toggle="modal" data-target="#modalComite{{ $beneficiario->clave_comite }}">Ver</button>
                        <a href="{{ route('beneficiarios.edit', $beneficiario->id) }}" class="btn">Editar</a>
                        <a href="{{ route('export.comites') }}" class="btn btn-success" style="margin-bottom: 15px;">Exportar a Excel</a>
                        <form action="{{ route('beneficiarios.destroy', $beneficiario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" onclick="return confirm('¿Estás seguro de que deseas eliminar este beneficiario?');">Eliminar</button>
                        </form>
                    </td>
                </tr>

<!-- Modal -->
<div class="modal fade" id="modalComite{{ $beneficiario->clave_comite }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Comité y Beneficiarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Información del Comité -->
                <h5><em>Datos Generales del Comité</em></h5>
                <p><strong>Nombre del Comité:</strong> {{ $beneficiario->nombre_comite ?? 'No disponible' }}</p>
                <p><strong>Clave del Comité:</strong> {{ $beneficiario->clave_comite ?? 'No disponible' }}</p>
                <p><strong>Tipo de Obra:</strong> {{ $beneficiario->tipo_obra ?? 'No disponible' }}</p>
                <p><strong>Apartado:</strong> {{ $beneficiario->apartado ?? 'No disponible' }}</p>
                <p><strong>Fecha de Constitución:</strong> {{ $beneficiario->fecha_constitucion ?? 'No disponible' }}</p>

                <h5><em>Domicilio del Comité</em></h5>
                <p><strong>Entidad Federativa:</strong> {{ $beneficiario->entidad_federativa_comite ?? 'No disponible' }}</p>
                <p><strong>Municipio:</strong> {{ $beneficiario->municipio_comite ?? 'No disponible' }}</p>
                <p><strong>Localidad:</strong> {{ $beneficiario->localidad_comite ?? 'No disponible' }}</p>
                <p><strong>Calle:</strong> {{ $beneficiario->calle ?? 'No disponible' }}</p>
                <p><strong>Número:</strong> {{ $beneficiario->numero ?? 'No disponible' }}</p>
                <p><strong>Colonia:</strong> {{ $beneficiario->colonia ?? 'No disponible' }}</p>
                <p><strong>Código Postal:</strong> {{ $beneficiario->codigo_postal ?? 'No disponible' }}</p>

                <!-- Información del Beneficio -->
                <h5><em>Datos del Beneficio</em></h5>
                <p><strong>Nombre del Beneficio:</strong> {{ $beneficiario->nombre_beneficio ?? 'No disponible' }}</p>
                <p><strong>Tipo de Beneficio:</strong> {{ $beneficiario->tipo_beneficio ?? 'No disponible' }}</p>
                <p><strong>Presupuesto Asignado:</strong> {{ $beneficiario->presupuesto ?? 'No disponible' }}</p>
                <p><strong>Fecha Inicial del Beneficio:</strong> {{ $beneficiario->fecha_inicial ?? 'No disponible' }}</p>
                <p><strong>Fecha de Terminación del Beneficio:</strong> {{ $beneficiario->fecha_terminacion ?? 'No disponible' }}</p>

                <!-- Ubicación del Beneficiario -->
                <h5><em>Ubicación del Beneficiario</em></h5>
                <p><strong>Entidad Federativa:</strong> {{ $beneficiario->entidad_federativa_comite ?? 'No disponible' }}</p>
                <p><strong>Municipio:</strong> {{ $beneficiario->municipio_comite ?? 'No disponible' }}</p>
                <p><strong>Localidad:</strong> {{ $beneficiario->localidad_comite ?? 'No disponible' }}</p>

                <!-- Información de Supervisión -->
                <h5><em>Supervisión</em></h5>
                <p><strong>Nombre del Supervisor o Residente:</strong> {{ $beneficiario->nombre_supervisor ?? 'No disponible' }}</p>
                <p><strong>Nombre del Promotor:</strong> {{ $beneficiario->nombre_promotor ?? 'No disponible' }}</p>
                <p><strong>Nombre de la Empresa:</strong> {{ $beneficiario->nombre_empresa ?? 'No disponible' }}</p>

                <!-- Beneficiarios -->
                <h5><em>Beneficiarios</em></h5>
                <p><strong>Número de Beneficiarias Mujeres:</strong> {{ $beneficiario->numero_mujeres ?? 'No disponible' }}</p>
                <p><strong>Número de Beneficiarios Hombres:</strong> {{ $beneficiario->numero_hombres ?? 'No disponible' }}</p>
                <p><strong>Comentarios:</strong> {{ $beneficiario->comentarios ?? 'No disponible' }}</p>

                <!-- Integrantes del Comité -->
                <div class="integrantes">
                    <h5>Integrantes del Comité</h5>
                    <div class="integrantes-list">
                        @forelse($beneficiario->comites as $comite)
                            <div class="integrante">
                                <div class="info">
                                    <p><strong>Nombre:</strong> {{ $comite->nombre ?? 'No disponible' }}</p>
                                    <p><strong>Sexo:</strong> {{ ucfirst($comite->sexo ?? 'No disponible') }}</p>
                                    <p><strong>Cargo:</strong> {{ $comite->cargo ?? 'No disponible' }}</p>
                                    <p><strong>Correo:</strong> {{ $comite->correo ?? 'No disponible' }}</p>
                                    <p><strong>Teléfono:</strong> {{ $comite->telefono ?? 'No disponible' }}</p>
                                    <p><strong>Firma/Fotografía:</strong>
                                        @if($comite->firma)
                                            <img src="{{ asset('storage/' . $comite->firma) }}" alt="Firma/Fotografía" width="80">
                                        @else
                                            Sin imagen
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p>No hay integrantes registrados.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No hay beneficiarios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ url('comites') }}" class="back-button">Registrar nuevo integrante de comité</a>
    
    @endsection
    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
