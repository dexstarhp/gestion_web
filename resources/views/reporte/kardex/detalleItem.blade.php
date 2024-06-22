@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kardex Detalle de item'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Detalle Kardex {{ $item->nombre }}</p>
                            <a href="{{ route('kardex.detalle.pdf', [$item->id]) }}" target="_blank" class="btn btn-primary btn-sm ms-auto" role="button" aria-pressed="true">Imprimir</a>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">Método de evaluación CPP</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
