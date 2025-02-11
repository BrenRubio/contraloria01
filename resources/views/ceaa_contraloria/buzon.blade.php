<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzón de Quejas y Sugerencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Buzón de Quejas y Sugerencias</h1>

        {{-- Tabla para listar las quejas registradas --}}
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Quejas Registradas</h5>
                @if ($quejas->isEmpty())
                    <p class="text-center text-muted">No hay quejas registradas.</p>
                @else
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Asunto</th>
                                <th>Nombre del Reportado</th>
                                <th>Nombre del Reportante</th>
                                <th>Nombre del Comité</th>  {{-- 🔥 Nueva columna --}}
                                <th>Clave del Comité</th>   {{-- 🔥 Nueva columna --}}
                                <th>Evidencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quejas as $queja)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($queja->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ $queja->asunto }}</td>
                                    <td>{{ $queja->nombre_reportado }}</td>
                                    <td>{{ $queja->nombre_opcional ?? 'Anónimo' }}</td>
                                    <td>{{ $queja->nombre_comite }}</td>  {{-- 🔥 Mostrar Nombre del Comité --}}
                                    <td>{{ $queja->clave_comite }}</td>   {{-- 🔥 Mostrar Clave del Comité --}}
                                    <td>
                                        @if ($queja->evidencia)
                                            @php
                                                $evidencias = json_decode($queja->evidencia);
                                            @endphp
                                            @foreach ($evidencias as $evidencia)
                                                <a href="{{ asset('storage/' . $evidencia) }}" target="_blank">📄 {{ basename($evidencia) }}</a><br>
                                            @endforeach
                                        @else
                                            No hay evidencia adjunta.
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detalleQuejaModal" 
                                            onclick="mostrarDetalles('{{ $queja->asunto }}', '{{ $queja->nombre_opcional ?? 'Anónimo' }}', '{{ $queja->nombre_reportado }}', '{{ $queja->motivo }}', '{{ $queja->evidencia }}', '{{ $queja->nombre_comite }}', '{{ $queja->clave_comite }}')">
                                            Ver Detalles
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('buzon-quejas.create') }}" class="btn btn-success">Quiero Hacer una Queja</a>
            <a href="{{ route('welcome') }}" class="btn btn-secondary">Regresar a la pantalla principal</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detalleQuejaModal" tabindex="-1" aria-labelledby="detalleQuejaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleQuejaModalLabel">Detalles de la Queja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Asunto:</strong> <span id="modalAsunto"></span></p>
                    <p><strong>Nombre del Reportante:</strong> <span id="modalNombreReportante"></span></p>
                    <p><strong>Nombre del Reportado:</strong> <span id="modalNombreReportado"></span></p>
                    <p><strong>Nombre del Comité:</strong> <span id="modalNombreComite"></span></p>  {{-- 🔥 Nueva línea --}}
                    <p><strong>Clave del Comité:</strong> <span id="modalClaveComite"></span></p>   {{-- 🔥 Nueva línea --}}
                    <p><strong>Motivo:</strong> <span id="modalMotivo"></span></p>
                    <p><strong>Evidencia:</strong></p>
                    <div id="modalEvidencia" class="d-flex flex-wrap"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarDetalles(asunto, nombreReportante, nombreReportado, motivo, evidencia, nombreComite, claveComite) {
            document.getElementById('modalAsunto').innerText = asunto;
            document.getElementById('modalNombreReportante').innerText = nombreReportante;
            document.getElementById('modalNombreReportado').innerText = nombreReportado;
            document.getElementById('modalNombreComite').innerText = nombreComite;  // 🔥 Agregado
            document.getElementById('modalClaveComite').innerText = claveComite;    // 🔥 Agregado
            document.getElementById('modalMotivo').innerText = motivo;

            const evidenciaDiv = document.getElementById('modalEvidencia');
            evidenciaDiv.innerHTML = ''; // Limpiar contenido previo

            if (evidencia && evidencia !== 'null') {
                const evidencias = JSON.parse(evidencia);
                evidencias.forEach(function(img) {
                    const imgElement = document.createElement('img');
                    imgElement.src = img;
                    imgElement.style.maxWidth = '100px';
                    imgElement.style.margin = '5px';
                    evidenciaDiv.appendChild(imgElement);
                });
            } else {
                evidenciaDiv.innerHTML = "<p>No hay evidencia adjunta.</p>";
            }
        }
    </script>
</body>
</html>