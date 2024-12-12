@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Items'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Lista de items</p>
                            <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm ms-auto" role="button" aria-pressed="true">Nuevo Item</a>
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
                                            Descripción
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Imagen
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            QR
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Descripción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->nombre }}</p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <span>{{ $item->descripcion }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @if(isset($item) && $item->imagen_url)
                                                    <img src="{{ asset('storage/' . $item->imagen_url) }}" alt="Imagen del Item" style="max-width: 100px">
                                                @else
                                                    <span>No hay imagen</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{ QrCode::size(100)->generate(route('items.show', $item)) }}
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('items.edit',$item) }}" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Proveedor">
                                                Editar
                                                </a>
                                                <a href="{{ route('items.getQr', $item) }}" target="_blank" class="btn btn-primary btn-sm ms-auto" role="button" aria-pressed="true">Generar QR</a>
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
