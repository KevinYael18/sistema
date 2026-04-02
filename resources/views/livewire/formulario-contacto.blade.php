<div>

    @if($enviado)
        <p style="color:green;">Mensaje enviado correctamente</p>
    @endif

    <input type="text" wire:model.live="nombre" placeholder="Nombre">
    @error('nombre') <span style="color:red;">{{ $message }}</span> @enderror

    <br>

    <input type="email" wire:model.live="email" placeholder="Email">
    @error('email') <span style="color:red;">{{ $message }}</span> @enderror

    <br>

    <textarea wire:model.live="mensaje" placeholder="Mensaje"></textarea>
    @error('mensaje') <span style="color:red;">{{ $message }}</span> @enderror

    <br>

    <button wire:click="enviar">Enviar</button>

</div>