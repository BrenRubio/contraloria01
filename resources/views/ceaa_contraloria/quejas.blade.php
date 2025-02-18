<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Quejas</title>
    
        
</head>
<body>
@extends('layouts.app')

@section('content')
    <form action="{{ route('buzon-quejas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="titulo">Formulario de quejas</h1>
        <div class="linea-separadora"></div>

        <div class="form-group">
            <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" value="{{ old('asunto') }}" required>
            @error('asunto') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
                <label for="clave_comite">Clave del Comité:</label>
                <select id="clave_comite" name="clave_comite" required>
                    <option value="">Seleccione una clave...</option>
                    @foreach ($beneficiarios as $beneficiario)
                        <option value="{{ $beneficiario->clave_comite }}" data-nombre="{{ $beneficiario->nombre_comite }}">
                            {{ $beneficiario->clave_comite }}
                        </option>
                    @endforeach
                </select>
                @error('clave_comite') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
                <label for="nombre_comite">Nombre del Comité:</label>
                <select id="nombre_comite" name="nombre_comite" required>
                    <option value="">Seleccione un comité...</option>
                    @foreach ($beneficiarios as $beneficiario)
                        <option value="{{ $beneficiario->nombre_comite }}" data-clave="{{ $beneficiario->clave_comite }}">
                            {{ $beneficiario->nombre_comite }}
                        </option>
                    @endforeach
                </select>
                @error('nombre_comite') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="nombre_opcional">Nombre de Quien Reporta (Opcional):</label>
            <input type="text" id="nombre_opcional" name="nombre_opcional" value="{{ old('nombre_opcional') }}">
            @error('nombre_opcional') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="nombre_reportado">Nombre del reportado:</label>
            <input type="text" id="nombre_reportado" name="nombre_reportado" value="{{ old('nombre_reportado') }}" required>
            @error('nombre_reportado') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea id="motivo" name="motivo" rows="4" required>{{ old('motivo') }}</textarea>
            @error('motivo') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="evidencia">Evidencia (subir fotos o PDF):</label>
            <input type="file" id="evidencia" name="evidencia[]" multiple accept="image/*,application/pdf">
            @error('evidencia.*') <span class="error">{{ $message }}</span> @enderror
        </div>

        <input type="submit" value="Enviar">
        <a href="{{ route('buzon-quejas.index') }}" class="back-button">Ver Quejas Registradas</a>
    </form>
    <script>
        document.getElementById('clave_comite').addEventListener('change', function() {
            let claveSeleccionada = this.value;
            let nombreComiteSelect = document.getElementById('nombre_comite');

            // Resetear el select de nombre del comité
            nombreComiteSelect.innerHTML = '<option value="">Seleccione un comité...</option>';

            // Buscar el nombre del comité correspondiente
            let opciones = this.options;
            for (let i = 0; i < opciones.length; i++) {
                if (opciones[i].value === claveSeleccionada) {
                    let nombreComite = opciones[i].dataset.nombre;
                    let nuevaOpcion = document.createElement("option");
                    nuevaOpcion.value = nombreComite;
                    nuevaOpcion.textContent = nombreComite;
                    nuevaOpcion.selected = true;
                    nombreComiteSelect.appendChild(nuevaOpcion);
                }
            }
        });
    </script>
@endsection
</body>
</html>