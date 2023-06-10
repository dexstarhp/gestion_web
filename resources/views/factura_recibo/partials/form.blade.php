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
                value="{{ isset($factura_recibo) ? $factura_recibo->total : old('total') }}">
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
            <select class="form-control" id="exampleFormControlSelect1">
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
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">Detalle compra</p>
                    <button class="btn btn-primary btn-sm ms-auto" id=addItem>Añadir item</buttonf=>
                </div>
            </div>
            <div class="card-body" id="detalle">
            </div>
        </div>
    </div>
</div>
