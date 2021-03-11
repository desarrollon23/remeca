<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Recepcion de Materiales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
              </ol> --}}
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
       <!-- Main content -->
    <div class="content"><div class="container-fluid">
          <div class="row"><div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Usuario</button>
                </div>
              <div class="card">
                <div class="card-body">

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

                </div>
              </div>
              </div>
          </div>
          </div>
    </div>
</div>
