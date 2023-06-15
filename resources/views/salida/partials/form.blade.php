@csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="fecha">fecha salida</label>
            <input
                class="form-control
                @error('fecha') is-invalid @enderror"
                placeholder="Fecha salida"
                id="fecha"
                name="fecha"
                type="date"
                value="{{ isset($salida) ? $salida->fecha : old('fecha') }}">
            @error('fecha')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="total">Total</label>
            <input
                class="form-control
                @error('total') is-invalid @enderror"
                placeholder="total"
                id="total"
                name="total"
                type="number"
                value="{{ isset($salida) ? $salida->total : old('total') }}"
                readonly=true>
            @error('total')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Detalle salida</p>
                    <button class="btn btn-primary btn-sm ms-auto" id='addItem'>Añadir item</button>
                </div>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_item-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
