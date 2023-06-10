@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Registro de Compra'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Nueva Compra</p>
                        </div>
                    </div>
                    <div class="card-body ">
                        <form role="form" method="POST" action={{ route('compra.store') }}>
                            @include('factura_recibo.partials.form')
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
