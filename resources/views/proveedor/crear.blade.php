@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Registro de proveedor'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Nuevo Proveedor</p>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form role="form" method="POST" action={{ route('proveedores.store') }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_razon_social">Nombre / Razon social</label>
                                        <input type="text"
                                            class="form-control
                                            @error('nombre_razon_social') is-invalid @enderror"
                                            id="nombre_razon_social"
                                            name="nombre_razon_social"
                                            placeholder="Nombre proveedor"
                                            value="{{ old('nombre_razon_social') }}">
                                        @error('nombre_razon_social')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nit_ci">NIT / CI</label>
                                        <input
                                            class="form-control
                                            @error('nit_ci') is-invalid @enderror"
                                            placeholder="nit o ci"
                                            id="nit_ci"
                                            name="nit_ci"
                                            type="text"
                                            value="{{ old('nit_ci') }}">
                                        @error('nit_ci')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tel_cel">Telefono/cel</label>
                                        <input class="form-control
                                        @error('tel_cel') is-invalid @enderror"
                                        placeholder="telefono"
                                        id="tel_cel"
                                        name="tel_cel"
                                        type="text"
                                        value="{{ old('tel_cel') }}">
                                        @error('tel_cel')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
