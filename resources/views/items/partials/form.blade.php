<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text"
                class="form-control
                @error('nombre') is-invalid @enderror"
                id="nombre"
                name="nombre"
                placeholder="Nombre item"
                value="{{ isset($item) ? $item->nombre : old('nombre') }}">
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input
                class="form-control
                @error('descripcion') is-invalid @enderror"
                placeholder="Descripción"
                id="descripcion"
                name="descripcion"
                type="text"
                value="{{ isset($item) ? $item->descripcion : old('descripcion') }}">
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
