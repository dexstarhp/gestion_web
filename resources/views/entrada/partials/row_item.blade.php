<tr>
    <td>
        <div class="d-flex px-2">
            <select class="form-control" name="item_id[]">
                <option>seleccione una opcion</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <input class="form-control precio_unitario" type="number" name="precio_unitario[]" id="" onkeyup="calcular(this)">
    </td>
    <td>
        <input class="form-control cantidad" type="number" name="cantidad[]" id="" onkeyup="calcular(this)">
    </td>
    <td class="align-middle text-center">
        <div class="d-flex align-items-center justify-content-center">
            <input class="form-control sub_total" type="number" name="sub_total[]" id=""  readonly=true>
        </div>
    </td>
    <td class="align-middle">
        <button class="btn btn-link text-secondary mb-0" onclick="eliminar(this)">
            <i class="far fa-trash-alt me-2"></i>
            eliminar
        </button>
    </td>
</tr>
