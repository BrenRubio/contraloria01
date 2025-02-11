<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Quejas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h3 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"], textarea {
            width: calc(100% - 16px);
            padding: 8px;
            border: 2px solid #ffa500;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        input[type="submit"] {
            background-color: #ffa500;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
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
            text-align: center;
            width: 92%;
        }
        .back-button:hover {
            background-color: #ff8c00;
        }
    </style>
</head>
<body>
    <form action="{{ route('buzon-quejas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Formulario de Quejas</h3>

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
</body>
</html>