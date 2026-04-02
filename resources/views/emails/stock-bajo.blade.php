<h2>⚠️ Alerta de Stock Bajo</h2>

<p>Producto: {{ $producto->nombre }}</p>
<p>Stock: {{ $producto->stock }}</p>
<p>Precio: ${{ $producto->precio }}</p>

<a href="{{ url('/productos') }}">Ver productos</a>