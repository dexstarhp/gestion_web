@csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text"
                class="form-control
                @error('nombre') is-invalid @enderror"
                id="nombre"
                name="nombre"
                placeholder="Nombre cliente"
                value="{{ isset($cliente) ? $cliente->nombre : old('nombre') }}">
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="ci">NIT / CI</label>
            <input
                class="form-control
                @error('ci') is-invalid @enderror"
                placeholder="nit o ci"
                id="ci"
                name="ci"
                type="text"
                value="{{ isset($cliente) ? $cliente->ci : old('ci') }}">
            @error('ci')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="telefono">Telefono/cel</label>
            <input class="form-control
            @error('telefono') is-invalid @enderror"
            placeholder="telefono"
            id="telefono"
            name="telefono"
            type="text"
            value="{{ isset($cliente) ? $cliente->telefono : old('telefono') }}">
            @error('telefono')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
