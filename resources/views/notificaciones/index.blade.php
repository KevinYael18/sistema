@extends('layouts.app')

@section('content')

<h2>Notificaciones</h2>

@foreach($notificaciones as $n)
    <div style="{{ $n->read_at ? '' : 'font-weight:bold;' }}">
        {{ $n->data['mensaje'] }}

        <br>
        <small>{{ $n->created_at->diffForHumans() }}</small>

        @if(!$n->read_at)
            <span style="color:red;"> NUEVA </span>
        @endif
    </div>
@endforeach

{{ $notificaciones->links() }}

@endsection