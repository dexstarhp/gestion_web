@csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <label for="nombre">{{ $item->nombre }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Descripción</label>
            <label for="nombre">{{ $item->descripcion }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Costo promedio ponderado (CPP)</label>
            <label for="nombre">{{ number_format($item->cpp, 2) }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Cantidad Total</label>
            <label for="nombre">{{ $item->cantidad_total }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nombre">Costo Total</label>
            <label for="nombre">{{ $item->importe_total }}</label>
        </div>
    </div>
</div>
