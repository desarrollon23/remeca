<div class="col-lg-4 col-md-6 col-xs-6 mt-2">
  <div class="card">
    <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{$recepcionmaterial_id}}</h3></div></div>
    <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
      <div style="width: 39%; margin-right: 2px;"><label for="cedulan">Cédula o Rif
        <input x-bind:disabled="!open" wire:model="cedulan" wire:keyup="busproc" style="width: 100%" id="cedulan" class="form-control" type="text" name="cedulan" placeholder="INGRESE EDULA O RIF">
          @error('cedulan')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
      </label></div>
      <div style="width: 59%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre
        <input x-bind:disabled="!open" wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese el Nombre">
      @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
      <div style="width: 49%; margin-right: 2px;"><label for="idtipopagon" style="width: 100%; margin-right: 2px;">Tipo de Pago
        <select x-bind:disabled="!open" name="idtipopagon" wire:model="idtipopagon" id="idtipopagon" class="form-control" style="text-transform: uppercase;">
          <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
           <option value="1">Contado</option>
           <option value="2">Crédito</option>
           <option value="3">Abono</option>
        </select></label></div>
        <div style="width: 49%; margin-right: 2px;"><label for="idtipopagon" style="width: 100%; margin-right: 2px;">Tipo de Abono
          <select x-bind:disabled="!open" name="idtipopagon" wire:model="idtipopagon" id="idtipopagon" class="form-control" style="text-transform: uppercase;">
            <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
             <option value="1">Efectivo</option>
             <option value="2">Transferencia</option>
          </select></label></div>
      <div style="width: 100%; margin-right: 2px;"><label for="observaciones">Observaciones
        <textarea x-bind:disabled="!open" wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones" placeholder="Ingrese las Observaciones" cols="55" style="text-transform: uppercase;"></textarea></label></div><br>
      <div class="d-flex justify-content-center">
        <button x-show="open" x-on:click="{ open = !open }" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button>
        <button x-show="open" x-on:click="{ open = !open }" wire:click="update({{ $recepcionmaterial_id }})" class="btn btn-primary"><i class="fa fa-save mr-1"></i> GUARDAR</button>
        {{-- x-show="{{ !$vpeso }}" --}} 
        <button x-show="!open" x-on:click="{ open = !open }" wire:click="generar" class="btn btn-primary"><i class="fa fa-save mr-1"></i> GENERAR</button>
      </div>                
    </div>
  </div>
</div>{{-- Lista de Materiales a Recibir #336699 --}}
<div class="col-lg-8 col-md-6 col-xs-6 mt-2">
  <div class="card">
    <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff;">Lista de Materiales</h3></div></div>
    <div class="card-body">
      <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
        {{-- <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}"> --}}
          <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
            <div style="width: 120px; margin-right: 2px;">
              <label for="producto_id">Material
              <select x-bind:disabled="!open" name="producto_id" wire:model.defer="state.producto_id" id="producto_id" class="form-control">
                <option value="NULL" selected>(SELECCIONE)</option>
                @foreach ($productos as $producto)
                  <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                @endforeach
               </select></label>
            </div>
            
            <div style="width: 120px; margin-right: 2px;">
              {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
              <label for="cantidadprorecmat">Peso{{-- {{ $close }} --}}
              <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --}} class="form-control" id="cantidadprorecmat" aria-describedby="cantidadprorecmat" placeholder="INGRESE" wire:keyup="verificarpeso">
              @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
              <small id="emailHelp" class="form-text text-muted"></small></label>
            </div>

            <div style="width: 120px; margin-right: 2px;">
              {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
              <label for="precioproneg">Precio{{-- {{ $close }} --}}
              <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.precioproneg" {{-- wire:keyup="verificarpeso" --}} class="form-control" id="precioproneg" aria-describedby="precioproneg" placeholder="INGRESE" wire:keyup="verificarpeso">
              @error('precioproneg') <div class="invalid-feedback">{{ $message }}</div>@enderror
              <small id="emailHelp" class="form-text text-muted"></small></label>
            </div>

            <div style="width: 120px; margin-right: 2px;">
              {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
              <label for="totalproneg">Monto{{-- {{ $close }} --}}
              <input {{-- x-bind:disabled="!open" x-on:input="cambio(event)" --}} type="number" wire:model.defer="state.totalproneg" {{-- wire:keyup="verificarpeso" --}} class="form-control" id="totalproneg" aria-describedby="totalproneg" wire:keyup="verificarpeso" disabled>
              @error('totalproneg') <div class="invalid-feedback">{{ $message }}</div>@enderror
              <small id="emailHelp" class="form-text text-muted"></small></label>
            </div>
            <div {{-- x-show="!v peso" --}} class="modal-footer">
                <button x-show="open" x-bind:disabled="{{ $vpeso }}" wire:click="storem" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Agregar</button>
            </div>
          <div {{-- x-show="{{ $vpeso }}" --}} style="color: red" id="pesoi" value="{{ $vpeso }}">{{ $pesoi }}</div>
        {{-- </form> --}}
      </div>
    </div>
    <table class="table table-striped"><thead><tr> 
        <th scope="col">#</th>
        <th scope="col">MATERIAL</th>
        <th scope="col">KG</th>
        <th scope="col">PRECIO</th>
        <th scope="col">MONTO</th>
        <th scope="col"></th>
      </tr></thead><tbody>
      @foreach ($productosrecepcion as $productorecepcion)
      <tr><th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $this->traedesmaterial($productorecepcion->producto_id) }}</td>
        <td>{{ $productorecepcion->cantidadprorecmat }}</td>
        <td>
        {{-- @php
        if ($productorecepcion->operacion=="RESTA") {
            echo '<a><i class="fas fa-minus text-danger"></i></a>';
            }if ($productorecepcion->operacion=="SUMA") {
                echo '<a><i class="color danger fas fa-plus text-success"></i></a>';
         }@endphp --}}
        </td>
        <td>
          <a href="" wire:click.prevent="destroy({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
        </td>
      </tr>@endforeach</tbody>
      <tfoot><tr><td colspan="2"><label>PESO TOTAL</label></td>
        <td><h1 style="font-weight:900; color:red">{{ (double)session('pt') }}
        </h1></td><td></td></tr>
        <tr><td colspan="2"><label>MONTO TOTAL</label></td><td></td>
        <td></td><td><h1 style="font-weight:900; color:red">{{ (double)session('pf') }}
      </h1></td></tr>
      </tfoot>
    </table>
  </div>
</div>
</div>