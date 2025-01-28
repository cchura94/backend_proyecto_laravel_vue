<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px; /* Tamaño de fuente más pequeño */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px 6px; /* Reducción del padding para mayor densidad */
            text-align: left;
            font-size: 9px; /* Fuente más pequeña en las celdas */
        }
        th {
            background-color: #f2f2f2;
            font-size: 10px; /* Tamaño de fuente ligeramente mayor en los encabezados */
        }
        h1 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px; /* Tamaño de fuente del título */
        }
        .fecha {
            text-align: center;
        }
        .estado {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Reporte de Proyectos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
                <th>Porcentaje de Avance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td>{{ $proyecto['descripcion'] }}</td>
                    <td class="fecha">{{ \Carbon\Carbon::parse($proyecto['fecha_inicio'])->format('d/m/Y') }}</td>
                    <td class="fecha">{{ \Carbon\Carbon::parse($proyecto['fecha_fin'])->format('d/m/Y') }}</td>
                    <td class="estado">{{ ucfirst($proyecto['estado']) }}</td>
                    <td>{{ $proyecto['porcentaje_avance'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
