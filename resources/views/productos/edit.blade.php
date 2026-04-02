<h2>Editar Producto</h2>

<form method="POST" action="{{ route('productos.update',$producto->id) }}">

@csrf
@method('PUT')

<input type="text" name="nombre" value="{{ $producto->nombre }}">

<input type="text" name="descripcion" value="{{ $producto->descripcion }}">

<input type="number" name="precio" value="{{ $producto->precio }}">

<input type="number" name="stock" value="{{ $producto->stock }}">

<select name="categoria_id" required>
    @foreach($categorias as $cat)
        <option value="{{ $cat->id }}"
            {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
            {{ $cat->nombre }}
        </option>
    @endforeach
</select>

<button type="submit">Actualizar</button>


</form>