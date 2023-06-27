@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Entradas'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Lista de entradas</p>
                            <a href="{{ route('entrada.create') }}" class="btn btn-primary btn-sm ms-auto" role="button" aria-pressed="true">Nueva Entrada</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nro</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Total</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tipo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Usuario</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entradas as $entrada)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $entrada->nro }}</p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                {{ $entrada->fecha }}</span>
                                            </td>
                                            <td class="align-middle text-sm">
                                                {{ $entrada->total }}</span>
                                            </td>
                                            <td class="align-middle text-sm">
                                                {{ $entrada->tipo }}</span>
                                            </td>
                                            <td class="align-middle text-sm">
                                                {{ $entrada->user->username }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('entrada.edit',$entrada) }}" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Editar Entrada">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <button class="btn btn-link text-secondary mb-0" onclick="ver({{ $entrada->id }})">
                                                    <i class="fas fa-solid fa-eye text-secondary"></i>
                                                </button>
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
        <div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="detalleLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="detalleLabel">Detalle entrada</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@section('script')
@parent
    <script>
        function ver(id){

            $.ajax({
                url: route('entrada.show',id),
                method: 'get',
                beforeSend: function (e) {
                    console.log('carga');
                }
            }).done(function (response) {
                $('#content').html('');
                $('#content').append(response.content);
                var myModal = new bootstrap.Modal(document.getElementById('detalle'), {
                    keyboard: false
                    });
                myModal.show()

            }).fail(function (response) {
                console.log('error');
            });

        }
    </script>
@endsection



