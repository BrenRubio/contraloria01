<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrantes de Comité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }
        h3 {
            color: #8B0000;
            border-bottom: 2px solid #8B0000;
            padding-bottom: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .table {
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
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
        .hidden {
            display: none;
        }
        .separator {
            border-top: 2px solid #8B0000;
            margin: 20px 0;
        }
        .section {
            margin-bottom: 30px;
        }
    </style>
    <script>
        function toggleFields() {
            const cargo = document.getElementById('cargo_usuario').value;
            const userFields = document.getElementById('user-fields');
            const otherField = document.getElementById('other-field');

            if (cargo === 'presidente') {
                userFields.classList.remove('hidden');
                otherField.classList.add('hidden');
            } else if (cargo === 'otro') {
                otherField.classList.remove('hidden');
                userFields.classList.add('hidden');
            } else {
                userFields.classList.add('hidden');
                otherField.classList.add('hidden');
            }
        }
    </script>
</head>
<body>
@extends('layouts.app')

@section('content')
    <form action="{{ route('comites.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="titulo">Registro de Integrantes de Comité</h1>
        <div class="linea-separadora"></div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="nombre_usuario">Nombre completo:</label>
                <input type="text" id="nombre_usuario" name="nombre" class="form-control" required>
                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="clave_comite">Clave del Comité:</label>
                <select id="clave_comite" name="clave_comite" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($beneficiarios as $beneficiario)
                        <option value="{{ $beneficiario->clave_comite }}">{{ $beneficiario->clave_comite }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="sexo_usuario">Sexo:</label>
                <select id="sexo_usuario" name="sexo" class="form-control" required>
                    <option value="">Seleccionar</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
                @error('sexo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="edad_usuario">Edad:</label>
                <input type="text" id="edad_usuario" name="edad" class="form-control" required>
                @error('edad')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="cargo_usuario">Cargo del integrante:</label>
                <select id="cargo_usuario" name="cargo" class="form-control" required onchange="toggleFields()">
                    <option value="">Seleccionar</option>
                    <option value="presidente">Presidente(a)</option>
                    <option value="secretario">Secretario(a)</option>
                    <option value="tesorero">Tesorero(a)</option>
                    <option value="vocal">Vocal</option>
                    <option value="otro">Otro</option>
                </select>
                @error('cargo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="correo_usuario">Correo electrónico:</label>
                <input type="text" id="correo_usuario" name="correo" class="form-control" required>
                @error('correo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="telefono_usuario">Teléfono:</label>
                <input type="text" id="telefono_usuario" name="telefono" class="form-control" required>
                @error('telefono')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 form-group">
                <label for="firma_usuario">Fotografía:</label>
                <input type="file" id="firma_usuario" name="firma" class="form-control" accept="image/*" required>
                @error('firma')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div id="other-field" class="form-group hidden">
            <label for="otro_cargo">Especificar otro cargo:</label>
            <input type="text" id="otro_cargo" name="otro_cargo">
        </div>
        <div id="user-fields" class="hidden">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" class="form-control">
                    @error('usuario')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="contrasena_usuario">Contraseña:</label>
                    <input type="password" id="contrasena_usuario" name="contrasena" class="form-control">
                    @error('contrasena')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <input type="submit" value="Registrar Usuario" class="btn btn-primary">
        <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>
    </form>
    
    <div class="separator"></div>
    <center><h4><div class="section">Integrantes Disponibles</div></h4></center>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Nombre del Integrante</th>
            <th>Clave del Comité</th>
            <th>Nombre del Comité</th>
            <th>Sexo</th>
            <th>Cargo</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Acciones</th> <!-- Cambiamos "Fotografía" por "Acciones" -->
        </tr>
    </thead>
    <tbody>
        @foreach($comites as $comite)
            <tr>
                <td>{{ $comite->nombre }}</td>
                <td>{{ $comite->clave_comite }}</td>
                <td>
                    @if($comite->beneficiario)
                        {{ $comite->beneficiario->nombre_comite }}
                    @else
                        No asignado
                    @endif
                </td>
                <td>{{ ucfirst($comite->sexo) }}</td>
                <td>{{ $comite->cargo }}</td>
                <td>{{ $comite->correo }}</td>
                <td>{{ $comite->telefono }}</td>
                <td>
                    @if($comite->firma)
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $comite->id }}">
                            Ver Fotografía
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalFoto{{ $comite->id }}" tabindex="-1" aria-labelledby="modalFotoLabel{{ $comite->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFotoLabel{{ $comite->id }}">Fotografía de {{ $comite->nombre }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset('storage/' . $comite->firma) }}" alt="Fotografía de {{ $comite->nombre }}" class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <span>Sin imagen</span>
                    @endif

                    <!-- Botón de eliminar con confirmación -->
                    <form action="{{ route('comites.destroy', $comite->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este integrante?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
</body>
</html>
