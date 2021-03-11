<div class="pt-3">
    <div class="card-header"><h3 class="card-title">RECEPCION DE MATERIAL</h3></div>
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-3xl mx-auto p-4 mb-6">
      <div class="mb-3">
        <label for="cedula">FECHA: {{ date('d-m-Y') }}</label>
        <label for="cedula"> # DE CIERRE 
        @if ($recepcion!=0))
            {{$recepcion->id+1}}
            <input type="hidden" id="recepcionmaterial_id" value="{{$recepcion->id+1}}"/>
            <input type="hidden" id="pesocalculado" value="{{$recepcion->pesocalculado}}"/>
        @else
            {{ 1 }}
            <input type="hidden" id="recepcionmaterial_id" value="1"/>
        @endif
        
        </label>
        <label for="cedula">Cédula</label>
        <input wire:model="cedula" id="cedula" placeholder="Ingrese la Cédula"/>
        @error('cedula')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
        <label for="nombre">Nombre</label>
        <input wire:model="nombre" id="nombre" placeholder="Ingrese el Nombre" disabled />
        @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
        <label for="idlugar">Lugar</label>
        <select name="idlugar" wire:model="idlugar" id="idlugar" placeholder="Ingrese el Nombre">
          <option value="NULL" selected>(SELECCIONE UN LUGAR)</option>
          @foreach ($lugares as $lugar)
            <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
          @endforeach
        </select>
        <label for="pesofull">Peso FULL</label>
        <input wire:model="pesofull" id="pesofull" placeholder="Ingrese la Peso FULL"/>
        <label for="pesovacio">Peso VACIO</label>
        <input wire:model="pesovacio" id="pesovacio" placeholder="Ingrese la Peso VACIO"/>
        <label for="pesoneto">Peso NETO</label>
        <input wire:model="pesoneto" id="pesoneto" placeholder="Ingrese la Peso NETO"/>
        <label for="producto_id">Material</label>
        <select name="producto_id" wire:model="producto_id" id="producto_id" placeholder="Ingrese el Nombre">
        <option value="NULL" selected>(SELECCIONE UN MATERIAL)</option>
          @foreach ($productos as $producto)
            <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
          @endforeach
        </select>
        @error('producto_id')
          <p class="text-x text-red-500 italic">{{$message}}</p>
        @enderror
        <label for="cantidadpro">Cantidad KG</label>
        <input wire:model="cantidadprorecmat" id="cantidadprorecmat" placeholder="Ingrese la Cantidad"/>
        @error('cantidadprorecmat')
          <p class="text-x text-red-500 italic">{{$message}}</p>
        @enderror
        <button wire:click="suma"  class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Agregar Material a la lista</button>
        <table class="border:1">
        @foreach ($materiales as $material)
        <tr><td>{{$material}}</td><td><button class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">{{-- {{$material}} --}}</button></td></tr>
        @endforeach
        </table>
        <label for="Observaciones">Observaciones</label>
        <textarea rows="2" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese las Observaciones"></textarea>
        <h2>{{$accion}}</h2><h2>{{$pesocalculado}}</h2><h2>{{$acumulado}}</h2>
  
  {{--       @if ($accion == "store") --}}
          <button wire:click="store" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">GUARDAR</button>
          <button wire:click="default" class="bg-red-400 hover:bg-red-700 mb-2 text-white font-bold px-4 py-2 rounded">CANCELAR</button>
  {{--       @else
          <button wire:click="update" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Modificar</button>
          <button wire:click="default" class="bg-red-400 hover:bg-red-700 mb-2 text-white font-bold px-4 py-2 rounded">Cancelar</button>
        @endif --}}
      </div>
    </div>
      
  <section class="content aling=center max-w-4xl mx-auto">
    <div class="container-fluid mx-auto"><div class="row"><div class="col-12"><div class="card">
      <div class="card-header"><h3 class="card-title">Lista de Materiales a Recibir</h3></div>
      <div class="card-body">
        <table id="example2" class="table table-bordered table-striped"><thead><tr>
            <th>NÚMERO</th>
            <th>DESCRIPCION</th>
            <th>KG</th>
            <th>OPCIONES</th>
          </tr></thead>
          <tbody>
            @foreach ($productosrecepcion as $productor)

            {{-- { {-- @for ($i = 0; $i < $count($productosr); $i++) --} }
            <tr class="hover:bg-green-200">
              <td class="px-1 py-1">{{-- { {$productosr['producto_id'][$i]}} --} }</td>
              <td class="px-1 py-1">{{-- { {$productor->descripcion}} --} }</td>
              <td class="px-1 py-1">{{$productor['cantidadprorecmat']}}</td>
              { {-- <td class="px-1 py-1">
                <button wire:click="edit({{$productosr}})" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded w-full">Editar</button>
                <button wire:click="destroy({{$productosr}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-1 py-1 rounded w-full">Eliminar</button>
              </td> --} }
            </tr>
            { {-- @endfor --} } --}}
            <tr class="hover:bg-green-200">
              <td class="px-1 py-1">{{$productor->producto_id}}</td>
              <td class="px-1 py-1">{{$productor->descripcion}}</td>
              <td class="px-1 py-1">{{$productor->cantidadprorecmat}}</td>
              <td class="px-1 py-1">
                <button wire:click="edit({{$productor}})" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded w-full">Editar</button>
                <button wire:click="destroy({{$productor}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-1 py-1 rounded w-full">Eliminar</button>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot><tr colspan="4"><td>
            <label>TOTAL</label><label>TOTAL {{-- {{ $recepcion->pesocalculado }} --}}</label></td></tr>
          </tfoot>
        </table>
      </div>
      </div></div></div></div>
    </section>
  </div>
  