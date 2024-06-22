<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Kardex</title>
      <style>
          body {
              font-size: 12px;
          }
          .table th, .table td {
              border: 1px solid black !important;
              padding: 4px !important;
          }
      </style>
  </head>
  <body>
  <div class="row">
      <div class="col-12 text-center">
          <h2>KARDEX DETALLADO</h2>
      </div>
  </div>
  <div class="row">
      <div class="col-6">
          <p>Empresa: Funeraria la Redención</p>
      </div>
  </div>
  <div class="row">
      <div class="col-6">
          <p>Articulo: {{ $item->nombre }}</p>
      </div>
      <div class="col-6">
          <p>Método de Valuación: Costo Promedio Ponderado (CPP)</p>
      </div>
  </div>
  <table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="2">
                Fecha
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" rowspan="2">
                Descripción
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="3">
                Entradas
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="3">
                Salidas
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center" colspan="3">
                Existencias
            </th>
        </tr>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Unidades
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Costo unit
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Valor total
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Unidades
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Costo unit
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Valor total
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Unidades
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Costo unit
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                Valor total
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $cantidadAcumulada = 0;
            $costoUnitario=0;
            $costoTotal=0;
        @endphp
        @foreach ($entradaSalidaList as $entradaSalida)
            <tr>
                <td>
                    {{ $entradaSalida->entradaSalida->fecha->format('d/m/Y') }}
                </td>
                <td>
                    {{ $entradaSalida->entradaSalida->tipo }}
                </td>
                <td>
                    @if($entradaSalida->entradaSalida->tipo == "entrada")
                        {{ $entradaSalida->cantidad }}
                    @endif
                </td>
                <td >
                    @if($entradaSalida->entradaSalida->tipo == 'entrada')
                        {{ $entradaSalida->precio_unitario }}
                    @endif
                </td>
                <td >
                    @if($entradaSalida->entradaSalida->tipo == 'entrada')
                        {{ $entradaSalida->entradaSalida->total }}
                    @endif
                </td>
                <td>
                    @if($entradaSalida->entradaSalida->tipo == "salida")
                        {{ $entradaSalida->cantidad }}
                    @endif
                </td>
                <td >
                    @if($entradaSalida->entradaSalida->tipo == 'salida')
                        {{ $entradaSalida->precio_unitario }}
                    @endif
                </td>
                <td >
                    @if($entradaSalida->entradaSalida->tipo == 'salida')
                        {{ $entradaSalida->entradaSalida->total }}
                    @endif
                </td>

                <td>
                    @if($entradaSalida->entradaSalida->tipo == 'entrada')
                        {{ $entradaSalida->cantidad + $cantidadAcumulada }}
                        @php
                            $cantidadAcumulada = $entradaSalida->cantidad + $cantidadAcumulada;
                        @endphp
                    @else
                        {{ $cantidadAcumulada - $entradaSalida->cantidad }}
                        @php
                            $cantidadAcumulada = $cantidadAcumulada - $entradaSalida->cantidad;
                        @endphp
                    @endif
                </td>
                <td>
                    @php
                        if($entradaSalida->entradaSalida->tipo == 'entrada')
                        {
                            $costoUnitario = $entradaSalida->entradaSalida->total/$cantidadAcumulada;
                        }
                    @endphp
                    {{ $costoUnitario }}
                </td>
                <td>
                    @php
                        $costoTotal = $costoUnitario * $cantidadAcumulada;
                    @endphp
                    {{ $costoTotal }}
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>

  </body>
</html>
