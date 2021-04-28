<div x-data="{ open: true }">
    {{-- {{$open}} --}}
    {{-- <x-jet-danger-button wire:click="$set('open', 'true')">
        Prueba {{' '.$open.' '.$proveedor->cedula}}
    </x-jet-danger-button> --}}
        {{-- {{$proveedor->nombre}} --}}
    @php $this->{"open".$proveedor->id}="false"; @endphp
    @foreach ($precios as $precio)
        <label x-show="open{{-- {{$proveedor->id}}  --}}" style="width: 10%;">{{$precio->descripcion}}
        <input type="text" id="precio{{$precio->idprecio}}" value="{{$precio->precio}}" style="width: 100%;" x-bind:disabled="!{{ $open.$proveedor->id }}"></label>
    @endforeach
    <x-jet-danger-button wire:click="open{{-- {{$proveedor->id}} --}}=true">
        MODIFICAR {{ $this->{"open".$proveedor->id} }}
    </x-jet-danger-button>
    {{-- <a class="btn" wire:click="$set('$mostrarmodal', false)">
        <i class="fas fa-edit mr-2"></i>{{$mostrarmodal.' - '.$proveedor->nombre}}
    </a> --}}

    {{-- <x-jet-danger-button> --}}
    {{-- <x-jet-dialog-modal wire:model="open" >
        
        <x-slot name="title">
            Lista de Precios del Proveedor: {{$proveedor->nombre}}
        </x-slot>

        <x-slot name="content">
            <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
                <div>
                    <x-jet-label value="Nombre" />
                    <x-jet-input type="text" class="w-full" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            
        </x-slot>

    </x-jet-dialog-modal> --}}

</div>
