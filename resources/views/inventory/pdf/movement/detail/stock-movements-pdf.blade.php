<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Movimientos del Producto</title>
    <style>
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
        }

        .header-info {
            margin-bottom: 15px;
        }

        .header-info td {
            border: none;
            text-align: left;
        }

        .signature {
            margin-top: 40px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<h2>MODELO DE TARJETA KARDEX</h2>

<table class="header-info">
    <tr>
        <td><strong>EMPRESA:</strong> Mi Empresa S.R.L.</td>
        <td><strong>MÉTODO DE VALUACIÓN:</strong> Costo Promedio Ponderado</td>
    </tr>
    <tr>
        <td><strong>ARTÍCULO:</strong> {{ $product->name }}</td>
        <td></td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th rowspan="2">
            Fecha
        </th>
        <th rowspan="2">
            Descripción
        </th>
        <th colspan="3">
            Entradas
        </th>
        <th colspan="3">
            Salidas
        </th>
        <th colspan="3">
            Existencias
        </th>
    </tr>
    <tr>
        <th>
            Unidades
        </th>
        <th>
            Costo unit
        </th>
        <th>
            Valor total
        </th>
        <th>
            Unidades
        </th>
        <th>
            Costo unit
        </th>
        <th>
            Valor total
        </th>
        <th>
            Unidades
        </th>
        <th>
            Costo unit
        </th>
        <th>
            Valor total
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($stockMovements as $record)
        <tr>
            {{-- Fecha --}}
            <td>{{ \Carbon\Carbon::parse($record['record']->date)->format('d/m/Y H:i') }}</td>

            {{-- Descripción / Tipo de Movimiento --}}
            <td>
                @switch($record['record']->movement_type)
                    @case('PURCHASE') COMPRA @break
                    @case('SALE') VENTA @break
                    @case('ADJUSTMENT') AJUSTE @break
                    @default {{ $record['record']->movement_type }}
                @endswitch
            </td>

            {{-- Entradas --}}
            <td>
                {{ $record['record']->movement_type === 'PURCHASE' ? $record['record']->quantity : '' }}
            </td>
            <td>
                {{ $record['record']->movement_type === 'PURCHASE' ? number_format($record['record']->unit_cost, 2) : '' }}
            </td>
            <td>
                {{ $record['record']->movement_type === 'PURCHASE' ? number_format($record['record']->quantity * $record['record']->unit_cost, 2) : '' }}
            </td>

            {{-- Salidas --}}
            <td>
                {{ $record['record']->movement_type === 'SALE' ? $record['record']->quantity : '' }}
            </td>
            <td>
                {{ $record['record']->movement_type === 'SALE' ? number_format($record['record']->unit_cost, 2) : '' }}
            </td>
            <td>
                {{ $record['record']->movement_type === 'SALE' ? number_format($record['record']->quantity * $record['record']->unit_cost, 2) : '' }}
            </td>

            {{-- Existencias (usando utilidad) --}}
            @php
                $average = \App\Utils\AverageCostUtility::calculateAverageCost($product->id, $record['record']->date);
            @endphp
            <td>{{ $average?->total_quantity ?? 0 }}</td>
            <td>{{ $average && $average->total_quantity > 0 ? number_format($average->total_cost / $average->total_quantity, 2) : 0 }}</td>
            <td>{{ $average?->total_cost ?? 0 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="signature">
    <br><br>
    <p>NOMBRE Y CÉDULA:</p>
    <p>__________________________________</p>
</div>
</body>
</html>
