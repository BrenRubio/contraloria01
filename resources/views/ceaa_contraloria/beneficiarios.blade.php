<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Beneficiarios</title>
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
            display: flex;
            align-items: center;
        }
        .form-horizontal {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-horizontal .form-group {
            width: 48%;
        }
        label {
            font-size: 14px;
            margin-right: 10px;
            font-weight: bold;
            width: 200px;
        }
        input[type="text"], input[type="date"], select {
            width: calc(100% - 220px);
            padding: 8px;
            border: 2px solid #ffa500;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="text"][readonly] {
            background-color: #e0e0e0;
            color: #6c757d;
        }
        input[type="submit"] {
            background-color: #ffa500;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 17%;
        }
        input[type="submit"]:hover {
            background-color: #ff8c00;
        }
        .section {
            margin-bottom: 30px;
        }
        .separator {
            border-top: 2px solid #8B0000;
            margin: 20px 0;
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
    <h1>{{ isset($beneficiario) ? 'Editar Beneficiario' : 'Agregar Beneficiario' }}</h1>
    <form action="{{ isset($beneficiario) ? route('beneficiarios.update', $beneficiario->id) : route('beneficiarios.store') }}" method="POST">
        @csrf
        @if(isset($beneficiario))
            @method('PUT')
        @endif

        <!-- Datos Generales en forma horizontal -->
        <div class="section">
            <h3>DATOS GENERALES</h3>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="nombre_comite">Nombre del Comité:</label>
                    <input type="text" id="nombre_comite" name="nombre_comite" value="{{ $beneficiario->nombre_comite ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="clave">Clave del Comité:</label>
                    <input type="text" id="clave" name="clave_comite" value="{{ $beneficiario->clave_comite ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de obra:</label>
                    <select id="tipo" name="tipo_obra">
                        <option value="">Seleccionar</option>
                        <option value="PROAGUA" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'PROAGUA' ? 'selected' : '' }}>PROAGUA</option>
                        <option value="ESTATALES" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'ESTATALES' ? 'selected' : '' }}>ESTATALES</option>
                        <option value="EXTRAORDINARIO" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'EXTRAORDINARIO' ? 'selected' : '' }}>EXTRAORDINARIO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="apartado">Apartado:</label>
                    <select id="apartado" name="apartado">
                        <option value="">Seleccionar</option>
                        <option value="RURAL" {{ isset($beneficiario) && $beneficiario->apartado == 'RURAL' ? 'selected' : '' }}>RURAL</option>
                        <option value="URBANO" {{ isset($beneficiario) && $beneficiario->apartado == 'URBANO' ? 'selected' : '' }}>URBANO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de constitución:</label>
                    <input type="date" id="fecha" name="fecha_constitucion" value="{{ $beneficiario->fecha_constitucion ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Separador -->
        <div class="separator"></div>

        <!-- Domicilio del Comité en forma horizontal -->
        <div class="section">
            <h3>Domicilio del Comité</h3>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="entidad_federativa_comite">Entidad federativa:</label>
                    <input type="text" id="entidad_federativa_comite" name="entidad_federativa_comite">
                </div>
                <div class="form-group">
                    <label for="municipio_comite">Municipio:</label>
                    <input type="text" id="municipio_comite" name="municipio_comite">
                </div>
                <div class="form-group">
                    <label for="localidad_comite">Localidad:</label>
                    <input type="text" id="localidad_comite" name="localidad_comite">
                </div>
                <div class="form-group">
                    <label for="calle">Calle:</label>
                    <input type="text" id="calle" name="calle" value="{{ $beneficiario->calle ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" value="{{ $beneficiario->numero ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="colonia">Colonia:</label>
                    <input type="text" id="colonia" name="colonia" value="{{ $beneficiario->colonia ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="codigo_postal">Código Postal:</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" value="{{ $beneficiario->codigo_postal ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Separador -->
        <div class="separator"></div>

        <!-- Datos del Beneficio en forma horizontal -->
        <div class="section">
            <h3>Datos del Beneficio</h3>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="nombre_beneficio">Nombre del beneficio:</label>
                    <input type="text" id="nombre_beneficio" name="nombre_beneficio" value="{{ $beneficiario->nombre_beneficio ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="tipo_beneficio">Tipo de beneficio:</label>
                    <select id="tipo_beneficio" name="tipo_beneficio">
                        <option value="">Seleccionar</option>
                        <option value="Apoyo" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Apoyo' ? 'selected' : '' }}>Apoyo</option>
                        <option value="Obra" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Obra' ? 'selected' : '' }}>Obra</option>
                        <option value="Servicio" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Servicio' ? 'selected' : '' }}>Servicio</option>
                        <option value="Otro" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entidad_federativa_beneficiario">Entidad federativa del beneficiario:</label>
                    <input type="text" id="entidad_federativa_beneficiario" name="entidad_federativa_beneficiario" readonly>
                </div>
                <div class="form-group">
                    <label for="municipio_beneficiario">Municipio del beneficiario:</label>
                    <input type="text" id="municipio_beneficiario" name="municipio_beneficiario" readonly>
                </div>
                <div class="form-group">
                    <label for="localidad_beneficiario">Localidad del beneficiario:</label>
                    <input type="text" id="localidad_beneficiario" name="localidad_beneficiario" readonly>
                </div>
                <div class="form-group">
                    <label for="numero_hombres">Número de beneficiarios hombres:</label>
                    <input type="text" id="numero_hombres" name="numero_hombres" value="{{ $beneficiario->numero_hombres ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="numero_mujeres">Número de beneficiarias mujeres:</label>
                    <input type="text" id="numero_mujeres" name="numero_mujeres" value="{{ $beneficiario->numero_mujeres ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <input type="text" id="comentarios" name="comentarios" value="{{ $beneficiario->comentarios ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="presupuesto">Presupuesto Asignado:</label>
                    <input type="text" id="presupuesto" name="presupuesto" value="{{ $beneficiario->presupuesto ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha Inicial del Beneficio:</label>
                    <input type="date" id="fecha_inicial" name="fecha_inicial" value="{{ $beneficiario->fecha_inicial ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de Terminación del Beneficio:</label>
                    <input type="date" id="fecha_terminacion" name="fecha_terminacion" value="{{ $beneficiario->fecha_terminacion ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="nombre_empresa">Nombre de la Empresa:</label>
                    <input type="text" id="nombre_empresa" name="nombre_empresa" value="{{ $beneficiario->nombre_empresa ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="nombre_supervisor">Nombre del Supervisor o Residente:</label>
                    <input type="text" id="nombre_supervisor" name="nombre_supervisor" value="{{ $beneficiario->nombre_supervisor ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="nombre_promotor">Nombre del Promotor:</label>
                    <input type="text" id="nombre_promotor" name="nombre_promotor" value="{{ $beneficiario->nombre_promotor ?? '' }}">
                </div>
            </div>
        </div>

        <input type="submit" value="{{ isset($beneficiario) ? 'Actualizar' : 'Guardar' }}">
    </form>

    <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>

    <script>
        function copiarDatos() {
            // Obtener los valores de los campos de Domicilio del Comité
            const entidadFederativa = document.getElementById('entidad_federativa_comite').value;
            const municipio = document.getElementById('municipio_comite').value;
            const localidad = document.getElementById('localidad_comite').value;

            // Copiar los valores a los campos de Datos del Beneficio
            document.getElementById('entidad_federativa_beneficiario').value = entidadFederativa;
            document.getElementById('municipio_beneficiario').value = municipio;
            document.getElementById('localidad_beneficiario').value = localidad;
        }

        // Llama a la función cuando se cambie el valor de los campos de Domicilio del Comité
        document.getElementById('entidad_federativa_comite').addEventListener('input', copiarDatos);
        document.getElementById('municipio_comite').addEventListener('input', copiarDatos);
        document.getElementById('localidad_comite').addEventListener('input', copiarDatos);
    </script>
</body>
</html>