<div class="pt-3">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    {{-- <h1>{{$titulo}}</h1>
    <p>{{$descripcion}}</p>
    <button wire:click="incrementar">Aumentar</button>
    <h2>{{$contar}}</h2> --}}
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-3xl mx-auto p-4 mb-6">
 
            <div class="mb-3">
                {{-- <label for="descripcion" class="form-label">Descripción</label>
                <input id="descripcion" placeholder="Ingrese la Descripción" class="form-control"> // DESPUES DE COMPILAR con npm run watch se activa esttos --}}
                <label for="descripcion" class="uppercase text-gray-700 text-xs font-bold mb-2">Descripción</label>
                <input wire:model="descripcion" id="descripcion" placeholder="Ingrese la Descripción" class="block w-full bg-gray-200 px-4 py-3 rounded text-gray-700 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-200" />
                @error('descripcion')
                    <p class="text-x text-red-500 italic">{{$message}}</p>
                @enderror
            </div><div class="mb-3">
                <label for="direccion" class="uppercase text-gray-700 text-xs font-bold mb-2">Direccion</label>
                <textarea wire:model="direccion" id="direccion" row="4"
                class="block w-full bg-gray-200 px-4 py-3 rounded text-gray-700 focus:bg-white focus:outline-none border border-gray-200 focus:border-gray-200 mb-2" placeholder="Ingrese la Direccion"></textarea>
                @error('direccion')
                    <p class="text-x text-red-500 italic">{{$message}}</p>
                @enderror
            @if ($accion == "store")
                <button wire:click="store" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Crear</button>
            @else
                <button wire:click="update" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Modificar</button>
                <button wire:click="default" class="bg-red-400 hover:bg-red-700 mb-2 text-white font-bold px-4 py-2 rounded">Cancelar</button>
            @endif
            </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-3xl mx-auto mb-8">
        <table>
            <thead class="bg-blue-300 border-b border-blue-800"><tr class="text-xs text-medium uppercase text-lef">
                <th>ID</th>
                <th>DESCRIPCIÓN</th>
                <th>DIRECCIÓN</th>
                <th></th>
            </tr></thead>
            <tbody class="divide-y divide-gray-500">
                @foreach ($sucursales as $sucursal)
                    <tr class="text-sm text-black-500 hover:bg-green-200">
                        <td class="px-6 py-4">{{$sucursal->id}}</td>
                        <td class="px-6 py-4">{{$sucursal->descripcion}}</td>
                        <td class="px-6 py-4">{{$sucursal->direccion}}</td>
                        <td class="px-6 py-4">
                            <button wire:click="edit({{$sucursal}})" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded w-full">Editar</button>
                            <button wire:click="destroy({{$sucursal}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-4 py-2 rounded w-full">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
        {{$sucursales->links()}}</div>
    </div>
</div>