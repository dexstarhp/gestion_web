<!DOCTYPE html>
<html>
    <head>
        <title>Códigos QR</title>
    </head>
    <body>
    @php
        $codigoQr = QrCode::size(100)->generate(route('items.show', $item_));
    @endphp
        <h1>Item: {{ $item_->nombre }}</h1>
        <table>
            @for($i=0 ; $i < 7 ; $i++)
            <tr>
                <td style="padding: 10px"><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
                <td style="padding: 10px"><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
                <td style="padding: 10px"><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
                <td style="padding: 10px"><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
                <td style="padding: 10px"><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
                <td><img src="data:image/svg+xml;base64,{{ base64_encode($codigoQr) }}"></td>
            </tr>
            @endfor
        </table>
    </body>
</html>
