<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Kardex</title>
  </head>
  <body>
    <h1>KARDEX DE LOS ITEMS</h1>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Nombre</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    Costo unitario</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    Cantidad</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    Costo total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $item->nombre }}</p>
                    </td>
                    <td class="align-middle text-sm">
                        {{ number_format($item->cpp, 2) }}</span>
                    </td>
                    <td class="align-middle">
                        {{ $item->cantidad_total }}
                    </td>
                    <td class="align-middle">
                        {{ $item->importe_total }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </body>
</html>
