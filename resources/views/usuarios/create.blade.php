@extends('layouts.app')

@section('content')


<h1>Nuevo Usuario</h1>


<form action="{{ route('usuarios.store') }}" method="POST">

@csrf

<div class="mb-3">

<label class="form-label">Nombre</label>

<input type="text" name="nombre" class="form-control" required>

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input type="email" name="email" class="form-control" required>

</div>

<button type="submit" class="btn btn-primary">Guardar</button>

<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>

</form>

@endsection