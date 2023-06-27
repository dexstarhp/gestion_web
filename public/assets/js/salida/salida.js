let buttonAddItem = document.getElementById('addItem');
buttonAddItem.addEventListener('click', function (event) {
    event.preventDefault();
    $.ajax({
        url: route('salida.add_item'),
        method: 'get',
        beforeSend: function (e) {
            console.log('carga');
        }
    }).done(function (response) {
        $('#table_item-body').append(response.content);

    }).fail(function (response) {
        console.log('error');
    });

});


// funciones
function eliminar(event) {
    $('#form_compra').submit(function (e) {
        e.preventDefault();
    })
    $(event).parent().parent().remove();
}


function calcular(element) {
    const row = $(element).parent().parent();
    let precio_unitario = row.find('input.precio_unitario').val();
    precio_unitario = parseFloat(precio_unitario);

    let cantidad = row.find('input.cantidad').val();
    cantidad = parseFloat(cantidad);


    let sub_total = 0;
    if (cantidad && precio_unitario) {
        sub_total = cantidad * precio_unitario;

        row.find('input.sub_total').val(sub_total);
        sumTotal();
    }

}


function sumTotal() {
    let total = 0;
    $('.sub_total').each(function (index, element) {

        total += parseFloat($(element).val());
    });
    $('#total').val(total);
}
