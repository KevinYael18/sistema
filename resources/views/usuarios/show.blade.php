@extends('layouts.app')

@section('content')

<h1>Detalle del Usuario</h1>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $usuario->id }}</p>
        <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
    </div>
</div>

<br>

<a href="{{ route('usuarios.index') }}" class="btn btn-primary">Volver</a>

@endsection