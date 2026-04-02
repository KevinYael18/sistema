<x-app-layout>

<x-slot name="header">
    <h2 style="font-weight:bold;">Carrito de Compras</h2>
</x-slot>

@php
$total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito ?? []));
@endphp

<div style="padding:20px;">

<table border="1" cellpadding="10" width="100%">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @forelse($carrito ?? [] as $id => $item)
        <tr>
            <td>{{ $item['nombre'] }}</td>
            <td>${{ number_format($item['precio'], 2) }}</td>
            <td>
                <form method="POST" action="{{ route('carrito.actualizar', $id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1">
                    <button>Actualizar</button>
                </form>
            </td>
            <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
            <td>
                <form method="POST" action="{{ route('carrito.eliminar', $id) }}">
                    @csrf
                    @method('DELETE')
                    <button>Quitar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">El carrito está vacío.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h3>Total: ${{ number_format($total, 2) }}</h3>

<form method="POST" action="{{ route('carrito.vaciar') }}">
    @csrf
    @method('DELETE')
    <button>Vaciar carrito</button>
</form>

</div>

</x-app-layout>