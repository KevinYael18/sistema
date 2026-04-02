<x-app-layout>

    <x-slot name="header">
        <h2 style="font-weight:bold;">Productos</h2>
    </x-slot>

    <style>
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table thead {
            background: #2d3748;
            color: white;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #eee;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-create { background: #3490dc; }
        .btn-edit { background: #f6ad55; }
        .btn-delete { background: #e3342f; }

        .img-producto {
            border-radius: 6px;
            object-fit: cover;
        }

        .top-actions {
            display:flex;
            gap:10px;
            margin-bottom:15px;
        }
    </style>

    <div style="padding:20px;">

        @if(session('success'))
            <div style="background:#c6f6d5;padding:10px;border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="top-actions">

            <a href="{{ route('productos.create') }}" class="btn btn-create">
                + Nuevo Producto
            </a>

            <a href="{{ route('carrito.index') }}" class="btn" style="background:#6c757d;">
                Ver carrito
            </a>

        </div>

        <!-- 🔍 LIVEWIRE BUSCADOR -->
        <h3>Buscador</h3>
        @livewire('buscador-productos')

        <hr>

        <!-- ❤️ FAVORITOS -->
        <h3>Favoritos</h3>
        @livewire('contador-favoritos')

        <hr>

        <!-- 📦 TABLA -->
        <div class="table-container">

            @if(isset($productos) && $productos->count())

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($productos as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nombre }}</td>
                            <td>${{ $p->precio }}</td>
                            <td>{{ $p->stock }}</td>

                            <td>
                                {{ optional($p->categoria)->nombre ?? 'Sin categoría' }}
                            </td>

                            <td>
                                @if($p->imagen)
                                    <img src="{{ asset('storage/'.$p->imagen) }}" width="60">
                                @else
                                    Sin imagen
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('productos.edit', $p->id) }}" class="btn btn-edit">
                                    Editar
                                </a>

                                <form action="{{ route('productos.destroy', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-delete">Eliminar</button>
                                </form>

                                <form action="{{ route('carrito.agregar', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn" style="background:#38c172;">
                                        🛒
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>

            @else
                <p>No hay productos</p>
            @endif

        </div>

        <hr>

        <!-- 📩 FORMULARIO -->
        <h3>Contacto</h3>
        @livewire('formulario-contacto')

    </div>

</x-app-layout>