<div class="pt-1">
  <div class="card-header"><h3 class="card-title">COMPRAS</h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
<div class="pt-3">
  <h1>COMPRAS</h1>
  <div class="bg-white rounded-lg shadow overflow-hidden max-w-3xl mx-auto p-4 mb-6">
    <div class="mb-3">
      <label for="cedula">FECHA: {{ date('d-m-Y') }}</label><label for="cedula"> # DE CIERRE {{-- {{ aquí va el número de cierre }} --}}</label>
      <label for="cedula">Cédula</label>
      <input wire:model="cedula" id="cedula" placeholder="Ingrese la Cédula"/>
      @error('cedula')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
      <label for="nombre">Nombre</label>
      <input wire:model="nombre" id="nombre" placeholder="Ingrese el Nombre"/>
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
      <label for="idproducto">Material</label>
      <select name="idproducto" wire:model="idproducto" id="idproducto" placeholder="Ingrese el Nombre">
      <option value="NULL" selected>(SELECCIONE UN MATERIAL)</option>
        @foreach ($productos as $producto)
          <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
        @endforeach
      </select>
      @error('idproducto')
        <p class="text-x text-red-500 italic">{{$message}}</p>
      @enderror
      <label for="cantidadpro">Cantidad KG</label>
      <input wire:model="cantidadpro" id="cantidadpro" placeholder="Ingrese la Cantidad"/>
      @error('cantidadpro')
        <p class="text-x text-red-500 italic">{{$message}}</p>
      @enderror
      <button wire:click="store" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Agregar Material a la lista</button>
      <label for="cantidadpro">Observaciones</label>
      <textarea rows="2" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese las Observaciones"></textarea>

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
          @foreach ($compradores as $comprador)
          <tr class="hover:bg-green-200">
            <td class="px-1 py-1">{{$comprador->id}}</td>
            <td class="px-1 py-1">{{$comprador->cedula}}</td>
            <td class="px-1 py-1">{{$comprador->idlugar}}</td>
            <td class="px-1 py-1">
              <button wire:click="edit({{$comprador}})" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded w-full">Editar</button>
              <button wire:click="destroy({{$comprador}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-1 py-1 rounded w-full">Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot><tr aria-colspan="4"><td><label>TOTAL</label><label>TOTAL {{-- {{ TOTAL CALCULADO }} --}}</label></td></tr>
        </tfoot>
      </table>
    </div>
    </div></div></div></div>
  </section>
</div>
