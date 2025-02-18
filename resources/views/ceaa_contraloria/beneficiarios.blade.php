<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Beneficiarios</title>
    
</head>
<body>
@extends('layouts.app')

@section('content')
    <h1 class="titulo">{{ isset($beneficiario) ? 'Editar Beneficiario' : 'Agregar beneficiario' }}</h1>
    <div class="linea-separadora"></div>
    <form action="{{ isset($beneficiario) ? route('beneficiarios.update', $beneficiario->id) : route('beneficiarios.store') }}" method="POST">
        @csrf
        @if(isset($beneficiario))
            @method('PUT')
        @endif

        <!-- Datos Generales en forma horizontal -->
            <div class="card p-3 mb-4">
            <h4 class="form-title">Datos Generales</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre_comite" class="form-label">Nombre del Comité:</label>
                    <input type="text" class="form-control" id="nombre_comite" name="nombre_comite" value="{{ $beneficiario->nombre_comite ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="clave" class="form-label">Clave del Comité:</label>
                    <input type="text" class="form-control" id="clave" name="clave_comite" value="{{ $beneficiario->clave_comite ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="tipo" class="form-label">Tipo de obra:</label>
                    <select id="tipo" name="tipo_obra" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="PROAGUA" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'PROAGUA' ? 'selected' : '' }}>PROAGUA</option>
                        <option value="ESTATALES" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'ESTATALES' ? 'selected' : '' }}>ESTATALES</option>
                        <option value="EXTRAORDINARIO" {{ isset($beneficiario) && $beneficiario->tipo_obra == 'EXTRAORDINARIO' ? 'selected' : '' }}>EXTRAORDINARIO</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="apartado" class="form-label">Apartado:</label>
                    <select id="apartado" name="apartado" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="RURAL" {{ isset($beneficiario) && $beneficiario->apartado == 'RURAL' ? 'selected' : '' }}>RURAL</option>
                        <option value="URBANO" {{ isset($beneficiario) && $beneficiario->apartado == 'URBANO' ? 'selected' : '' }}>URBANO</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha de constitución:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha_constitucion" value="{{ $beneficiario->fecha_constitucion ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Domicilio del Comité en forma horizontal -->
        <div class="card p-3 mb-4">
        <h4 class="form-title">Domicilio del Comité</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="entidad_federativa_comite" class="form-label">Entidad federativa:</label>
                <input type="text" class="form-control" id="entidad_federativa_comite" name="entidad_federativa_comite" value="{{ $beneficiario->entidad_federativa_comite ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="municipio_comite" class="form-label">Municipio:</label>
                <input type="text" class="form-control" id="municipio_comite" name="municipio_comite" value="{{ $beneficiario->municipio_comite ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="localidad_comite" class="form-label">Localidad:</label>
                <input type="text" class="form-control" id="localidad_comite" name="localidad_comite" value="{{ $beneficiario->localidad_comite ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="calle" class="form-label">Calle:</label>
                <input type="text" class="form-control" id="calle" name="calle" value="{{ $beneficiario->calle ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="numero" class="form-label">Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ $beneficiario->numero ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="colonia" class="form-label">Colonia:</label>
                <input type="text" class="form-control" id="colonia" name="colonia" value="{{ $beneficiario->colonia ?? '' }}">
            </div>
            <div class="col-md-6">
                <label for="codigo_postal" class="form-label">Código Postal:</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ $beneficiario->codigo_postal ?? '' }}">
            </div>
        </div>
    </div>


        <!-- Datos del Beneficio en forma horizontal -->
       
        <div class="card p-3 mb-4">
            <h4 class="form-title">Datos del Beneficio</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre_beneficio" class="form-label">Nombre del beneficio:</label>
                    <input type="text" class="form-control" id="nombre_beneficio" name="nombre_beneficio" value="{{ $beneficiario->nombre_beneficio ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="tipo_beneficio" class="form-label">Tipo de beneficio:</label>
                    <select id="tipo_beneficio" name="tipo_beneficio" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Apoyo" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Apoyo' ? 'selected' : '' }}>Apoyo</option>
                        <option value="Obra" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Obra' ? 'selected' : '' }}>Obra</option>
                        <option value="Servicio" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Servicio' ? 'selected' : '' }}>Servicio</option>
                        <option value="Otro" {{ isset($beneficiario) && $beneficiario->tipo_beneficio == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="entidad_federativa_beneficiario" class="form-label">Entidad federativa del beneficiario:</label>
                    <input type="text" class="form-control" id="entidad_federativa_beneficiario" name="entidad_federativa_beneficiario" readonly>
                </div>
                <div class="col-md-6">
                    <label for="municipio_beneficiario" class="form-label">Municipio del beneficiario:</label>
                    <input type="text" class="form-control" id="municipio_beneficiario" name="municipio_beneficiario" readonly>
                </div>
                <div class="col-md-6">
                    <label for="localidad_beneficiario" class="form-label">Localidad del beneficiario:</label>
                    <input type="text" class="form-control" id="localidad_beneficiario" name="localidad_beneficiario" readonly>
                </div>
                <div class="col-md-6">
                    <label for="numero_hombres" class="form-label">Número de beneficiarios hombres:</label>
                    <input type="number" class="form-control" id="numero_hombres" name="numero_hombres" value="{{ $beneficiario->numero_hombres ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="numero_mujeres" class="form-label">Número de beneficiarias mujeres:</label>
                    <input type="number" class="form-control" id="numero_mujeres" name="numero_mujeres" value="{{ $beneficiario->numero_mujeres ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="presupuesto" class="form-label">Presupuesto Asignado:</label>
                    <input type="text" class="form-control" id="presupuesto" name="presupuesto" value="{{ $beneficiario->presupuesto ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="fecha_inicial" class="form-label">Fecha Inicial del Beneficio:</label>
                    <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ $beneficiario->fecha_inicial ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="fecha_terminacion" class="form-label">Fecha de Terminación del Beneficio:</label>
                    <input type="date" class="form-control" id="fecha_terminacion" name="fecha_terminacion" value="{{ $beneficiario->fecha_terminacion ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="nombre_empresa" class="form-label">Nombre de la Empresa:</label>
                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="{{ $beneficiario->nombre_empresa ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="nombre_supervisor" class="form-label">Nombre del Supervisor o Residente:</label>
                    <input type="text" class="form-control" id="nombre_supervisor" name="nombre_supervisor" value="{{ $beneficiario->nombre_supervisor ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="nombre_promotor" class="form-label">Nombre del Promotor:</label>
                    <input type="text" class="form-control" id="nombre_promotor" name="nombre_promotor" value="{{ $beneficiario->nombre_promotor ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label for="comentarios" class="form-label">Comentarios:</label>
                    <textarea class="form-control" id="comentarios" name="comentarios">{{ $beneficiario->comentarios ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($beneficiario) ? 'Actualizar' : 'Guardar' }}</button>
        </div>

    </form>

    <a href="{{ url('/') }}" class="back-button">Regresar a la pantalla principal</a>
    @endsection

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