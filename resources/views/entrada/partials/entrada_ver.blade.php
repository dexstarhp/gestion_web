<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="fecha">Nro</label>
            <label for="">
                {{ $entrada_salida->nro }}
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fecha">fecha entrada</label>
            <label for="">
                {{ $entrada_salida->fecha }}
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="total">Total</label>
            <label>
                {{ $entrada_salida->total }}
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Item
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    costo unitario
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Cantidad
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                    Sub-total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entrada_salida->detalles as $detalle)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            {{ $detalle->item->nombre }}
                                        </div>
                                    </td>
                                    <td>
                                        {{ $detalle->precio_unitario }}
                                    </td>
                                    <td>
                                        {{ $detalle->cantidad }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ ($detalle->precio_unitario * $detalle->cantidad) }}
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
