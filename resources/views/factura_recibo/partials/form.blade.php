@csrf
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="nro">Nro documento</label>
            <input type="text"
                class="form-control
                @error('nro') is-invalid @enderror"
                id="nro"
                name="nro"
                placeholder="Nro documento"
                value="{{ isset($factura_recibo) ? $factura_recibo->nro : old('nro') }}">
            @error('nro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="fecha">fecha documento</label>
            <input
                class="form-control
                @error('fecha') is-invalid @enderror"
                placeholder="Fecha documento"
                id="fecha"
                name="fecha"
                type="date"
                value="{{ isset($factura_recibo) ? $factura_recibo->fecha : old('fecha') }}">
            @error('fecha')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="total">Total</label>
            <input
                class="form-control
                @error('total') is-invalid @enderror"
                placeholder="total"
                id="total"
                name="total"
                type="number"
                value="{{ isset($factura_recibo) ? $factura_recibo->total : old('total') }}"
                readonly=true>
            @error('total')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tel_cel">Proveedor</label>
            <select class="form-control" name="proveedor_id">
                <option>seleccione una opcion</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_razon_social }}</option>
                @endforeach
            </select>
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
                    <p class="mb-0">Detalle compra</p>
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
                                    Precio unitario
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
