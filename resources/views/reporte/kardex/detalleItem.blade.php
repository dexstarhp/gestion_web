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
                            <p class="mb-0">Kardex detalle de item</p>
                            <a href="{{ route('kardex.pdf') }}" target="_blank" class="btn btn-primary btn-sm ms-auto" role="button" aria-pressed="true">Imprimir</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Costo unitario</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Cantidad</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Costo total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entradaSalidaList as $entradaSalida)
                                        <tr>
                                            <td>
                                            </td>
                                            <td class="align-middle text-sm">
                                            </td>
                                            <td class="align-middle">
                                            </td>
                                            <td class="align-middle">
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
