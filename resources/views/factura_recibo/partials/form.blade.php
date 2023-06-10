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
                value="{{ isset($proveedor) ? $proveedor->nombre_razon_social : old('nombre_razon_social') }}">
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
                value="{{ isset($proveedor) ? $proveedor->nit_ci : old('nit_ci') }}">
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
            value="{{ isset($proveedor) ? $proveedor->tel_cel : old('tel_cel') }}">
            @error('tel_cel')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
