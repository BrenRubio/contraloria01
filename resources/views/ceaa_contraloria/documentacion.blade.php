<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Documentación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="titulo">Información de documentación</h1>
        <div class="linea-separadora"></div>

        {{-- Formulario para añadir un nuevo documento --}}
        <div class="card mb-4 shadow">
            <div class="card-body">
                <form action="{{ route('documentacion.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="beneficiario_id" class="form-label">Nombre del Comité:</label>
                    <select id="beneficiario_id" name="beneficiario_id" class="form-select" required>
                        <option value="">Seleccionar</option>
                        @foreach($beneficiarios as $beneficiario)
                            <option value="{{ $beneficiario->id }}">{{ $beneficiario->nombre_comite }}</option>
                        @endforeach
                    </select>
                        @error('beneficiario_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="3" class="form-control">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Archivo:</label>
                        <select id="tipo" name="tipo" class="form-select" required>
                            <option value="">Seleccionar</option>
                            <option value="Plano" {{ old('tipo') == 'Plano' ? 'selected' : '' }}>Plano</option>
                            <option value="Catálogo" {{ old('tipo') == 'Catálogo' ? 'selected' : '' }}>Catálogo</option>
                            <option value="Programa de Obra" {{ old('tipo') == 'Programa de Obra' ? 'selected' : '' }}>Programa de Obra</option>
                        </select>
                        @error('tipo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="archivo" class="form-label">Archivo:</label>
                        <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.docx,.xlsx,.jpg,.png" required>
                        @error('archivo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabla para listar los documentos --}}
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Documentos Registrados</h5>
                @if ($documentos->isEmpty())
                    <p class="text-center text-muted">No hay documentos registrados.</p>
                @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del Comité</th> {{-- Cambiado de "Título" a "Nombre del Comité" --}}
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Archivo</th>
                            <th>Fecha de Subida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documentos as $documento)
                            @php
                                // Buscar el beneficiario relacionado en la tabla de beneficiarios
                                $beneficiario = \App\Models\Beneficiarios::where('id', $documento->beneficiario_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $beneficiario ? $beneficiario->nombre_comite : 'Sin comité' }}</td> {{-- Mostrar Nombre del Comité --}}
                                <td>{{ $documento->descripcion }}</td>
                                <td>{{ $documento->tipo }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $documento->archivo) }}" target="_blank" class="btn btn-sm btn-primary">Ver</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('documentacion.destroy', $documento->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Regresar a la pantalla principal</a>
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>