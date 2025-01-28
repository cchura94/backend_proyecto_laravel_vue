<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Proyecto - {{ $proyecto->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
            font-size: 9px;
        }
        .table th {
            background-color: #f2f2f2;
            font-size: 10px;
        }
        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .content {
            font-size: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Reporte del Proyecto: {{ $proyecto->nombre }}</h1>
    
    <!-- Detalles del proyecto -->
    <div class="section">
        <div class="title">Descripción:</div>
        <div class="content">{{ $proyecto->descripcion }}</div>
    </div>

    <div class="section">
        <div class="title">Fechas:</div>
        <div class="content">
            <strong>Inicio:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}<br>
            <strong>Fin:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') }}
        </div>
    </div>

    <div class="section">
        <div class="title">Estado:</div>
        <div class="content">{{ ucfirst($proyecto->estado) }}</div>
    </div>

    <!-- Jefe de Proyecto -->
    <div class="section">
        <div class="title">Jefe de Proyecto:</div>
        <div class="content">
            <strong>Nombre:</strong> {{ $proyecto->jefe_proyecto_data->name }}<br>
            <strong>Email:</strong> {{ $proyecto->jefe_proyecto_data->email }}
        </div>
    </div>

    <!-- Tareas -->
    @if($proyecto->tareas->isNotEmpty())
    <div class="section">
        <div class="title">Tareas:</div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyecto->tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->id }}</td>
                        <td>{{ $tarea->nombre }}</td>
                        <td>{{ ucfirst($tarea->estado) }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_fin)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="section">
        <div class="title">Tareas:</div>
        <div class="content">No hay tareas asociadas a este proyecto.</div>
    </div>
    @endif

    <!-- Recursos -->
    @if($proyecto->recursos->isNotEmpty())
    <div class="section">
        <div class="title">Recursos:</div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Fecha Asignación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyecto->recursos as $recurso)
                    <tr>
                        <td>{{ $recurso->id }}</td>
                        <td>{{ $recurso->nombre }}</td>
                        <td>{{ $recurso->pivot->cantidad_asignada }}</td>
                        <td>{{ \Carbon\Carbon::parse($recurso->fecha_asignacion)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="section">
        <div class="title">Recursos:</div>
        <div class="content">No hay recursos asignados a este proyecto.</div>
    </div>
    @endif

    <!-- Informes -->
    @if($proyecto->informes->isNotEmpty())
    <div class="section">
        <div class="title">Informes:</div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha de Creación</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyecto->informes as $informe)
                    <tr>
                        <td>{{ $informe->id }}</td>
                        <td>{{ $informe->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($informe->fecha_creacion)->format('d/m/Y') }}</td>
                        <td>{{ $informe->descripcion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="section">
        <div class="title">Informes:</div>
        <div class="content">No hay informes asociados a este proyecto.</div>
    </div>
    @endif
</body>
</html>
