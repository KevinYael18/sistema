<div>
    <input wire:model.live="busqueda" type="text" placeholder="Buscar..." class="input-search">

    @foreach($productos ?? [] as $p)
        <div>
            {{ $p->nombre }} — ${{ $p->precio }}
        </div>
    @endforeach

    @if(!$productos->count() && $busqueda)
        <p>Sin resultados para {{ $busqueda }}</p>
    @endif
</div>