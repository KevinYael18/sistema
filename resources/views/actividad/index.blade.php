@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Historial de Actividad</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Acción</th>
                <th>Descripción</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->accion }}</td>
                <td>{{ $log->descripcion }}</td>
                <td>{{ $log->user->name ?? 'Sistema' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection