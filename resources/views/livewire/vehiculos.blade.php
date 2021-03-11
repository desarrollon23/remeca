<div>
    <h1>Lista de Vehículos</h1>

    {{-- <form action="" wire:submit.prevent="agregar">
        <input type="text" placeholder="Nombre del Vehículo" wire:model='vehiculo'>

        <button>Enviar</button> --}}
        <input type="text" placeholder="Nombre del Vehículo" wire:model='vehiculo' wire:keydown.enter="agregar">

        <button wire:click="agregar">Enviar</button>
    {{-- </form> --}}

    <ul>
        @foreach ($vehiculos as $vehiculo)
            <li>{{$vehiculo}}</li>
        @endforeach
    </ul>

</div>
