<h1>{{ $product->name }}</h1>
<p>Stock actual: {{ $product->current_stock }}</p>
<p>Precio promedio: Bs {{ number_format($product->average_cost, 2) }}</p>
<img src="{{ asset('storage/' . $product->image_url) }}" alt="Imagen del producto">
<!-- Aquí puedes añadir más info técnica -->
