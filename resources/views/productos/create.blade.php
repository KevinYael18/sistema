<x-app-layout>

    <x-slot name="header">
        <h2>Crear Producto</h2>
    </x-slot>

    <div style="padding:20px;">

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>

            <div>
                <label>Precio</label>
                <input type="number" name="precio" required>
            </div>

            <div>
                <label>Stock</label>
                <input type="number" name="stock" required>
            </div>

            <div>
                <label>Descripción</label>
                <textarea name="descripcion"></textarea>
            </div>

            <div>
                <label>Categoría</label>

                <select name="categoria_id" required>
                    <option value="">Seleccione una categoría</option>

                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Imagen</label>
                <input type="file" name="imagen">
            </div>

            <br>

            <button type="submit">Guardar Producto</button>

            <a href="{{ route('productos.index') }}">
                Volver
            </a>

        </form>

    </div>

</x-app-layout>