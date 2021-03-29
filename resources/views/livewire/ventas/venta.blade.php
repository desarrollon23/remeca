<div class="pt-1">
  <div class="card-header"><h1 class="card-title text-danger">
    ADMINISTRACION -> Venta</a>
    <a href="{{ route('livewire.ventas.negociacion') }}" class="btn btn-primary" style="color: #fff; text-shadow: 2px 2px 2px black;">Negociación</a>
  </h1></div>
  {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
  <div x-data="main()" class="content">
    <div class="container-fluid mt-2">
      <div class="row aling: center">
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="row aling: center" >
            <div class="col-lg-4 col-md-6 col-xs-6 mt-2">
              <div class="card">
                {{-- <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Venta #</h3>
                  <input { {-- x-bind:disabled="!open" --} } wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 50px; border-radius: 5px; background-color: white; border: 1px solid #fff; color: #fff; margin-right: 2px;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                  
                  <h3 class="card-title"  style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ $fecha }}</h3>
                  
                  {{ $fecha }}</h3>
                
                </div></div> --}}
                <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{$recepcionmaterial_id}}</h3></div></div>
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                  <div style="width: 39%; margin-right: 2px;"><label for="cedulav">Cédula o Rif
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedulav" wire:keyup="busproc" style="width: 100%" id="cedulav" class="form-control" type="text" name="cedulav" placeholder="INGRESE CEDULA O RIF">
                      @error('cedulav')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                  </label></div>
                  <div style="width: 59%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese el Nombre">
                  @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                  <div style="width: 49%; margin-right: 2px;"><label for="idlugarv" style="width: 100%; margin-right: 2px;">Lugar
                    <select x-bind:disabled="!{{ $mostrar }}" name="idlugarv" wire:model="idlugarv" id="idlugarv" class="form-control" style="text-transform: uppercase;">
                      <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                      @foreach ($lugares as $lugar)
                      <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                     @endforeach
                    </select>@error('idlugarv')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                  <div style="width: 49%; margin-right: 2px;"><label for="idestatuspagov" style="width: 100%; margin-right: 2px;">Estatus
                    <select x-bind:disabled="!{{ $mostrar }}" name="idestatuspagov" wire:model="idestatuspagov" id="idestatuspagov" class="form-control" style="text-transform: uppercase;">
                      <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                       <option value="1">Pagada</option>
                       <option value="2">Por Pagar</option>
                    </select>@error('idestatuspagov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                  <div style="width: 49%; margin-right: 2px;"><label for="idtipopagov" style="width: 100%; margin-right: 2px;">Tipo de Venta
                    <select x-bind:disabled="!{{ $mostrar }}" name="idtipopagov" wire:model="idtipopagov" id="idtipopagov" class="form-control" style="text-transform: uppercase;">
                      <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                       <option value="1">Contado</option>
                       <option value="2">Crédito</option>
                       <option value="2">Abono</option>
                    </select>@error('idtipopagov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                  <div style="width: 49%; margin-right: 2px;"><label for="placav">Placa Camión
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="placav" wire:keyup="busproc" style="width: 100%" id="placav" class="form-control" type="text" name="placav" placeholder="INGRESE PLACA">
                        @error('placav')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </label></div>
                  <div style="width: 100%; margin-right: 2px;"><label for="observacionesv">Observaciones
                    <textarea x-bind:disabled="!{{ $mostrar }}" wire:model="observacionesv" rows="1" id="observacionesv" class="form-control" name="observacionesv" placeholder="Ingrese las Observaciones" cols="55" style="text-transform: uppercase;"></textarea>@error('observacionesv')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div><br>
                    <div style="width: 100%; display: flex; flex-wrap: wrap;">
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" wire:click="update({{ $recepcionmaterial_id }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="!{{ $mostrar }}" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button></div>
                    </div>                
                </div>
              </div>
            </div>{{-- Lista de Materiales a Recibir #336699 --}}
            <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
              <div class="card">
                <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title"  style="color: white; text-shadow: 2px 2px 2px black;">Lista de Materiales</h3></div></div>
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                  <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="idproductov" style="width: 100%; margin-right: 2px;">Material
                      <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="idproductov" wire:model="idproductov" id="idproductov" class="form-control">
                        <option value="NULL" selected>(SELECCIONE)</option>
                        @foreach ($productos as $producto)
                          <option value="{{$producto->id}}">{{$producto->descripcion." (".$producto->cantidad." KG)"}}</option>
                        @endforeach
                       </select>@error('idproductov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="cantidadprov" style="width: 100%; margin-right: 2px;">Peso
                      <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="cantidadprov" class="form-control" id="cantidadprov" name="cantidadprov" aria-describedby="cantidadprov" placeholder="Ingrese la cantidad" wire:keyup="calpeso">@error('cantidadprov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small></label>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="precioprov" style="width: 100%; margin-right: 2px;">Precio
                      <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="precioprov" class="form-control" id="precioprov" name="precioprov" aria-describedby="precioprov" placeholder="Ingrese la cantidad" wire:keyup="calpeso">@error('precioprov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small></label>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="totalprov" style="width: 100%; margin-right: 2px;">Total
                      <input x-show="{{ $mostrar }}" type="number" id="totalprov" name="totalprov" wire:model="totalprov" class="form-control" placeholder="TOTAL" disabled>
                      <p class="text-x text-red-500 italic" style="pt-2"></p>
                      @error('totalprov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small></label>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                        <button x-show="{{ $mostrar }}" wire:click="storem" class="btn btn-primary mt-4"><i class="fa fa-save mr-1"></i>Agregar</button>
                      </label>
                    </div>
                  </div>
                  <div value="{{ $vpeso }}"><p class="text-x text-red-500 italic">{{ $pesoi }}</p></div>
                {{-- </form> --}}
              {{-- </div> --}}
            </div>
                {{-- <div class="card-body">
                  <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                    { {-- <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}"> --} }
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
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="cantidadprorecmat">Peso{{-- {{ $close }} --} }
                          <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --} } class="form-control" id="cantidadprorecmat" aria-describedby="cantidadprorecmat" placeholder="INGRESE" wire:keyup="verificarpeso">
                          @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small></label>
                        </div>
            
                        <div style="width: 120px; margin-right: 2px;">
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="precioproneg">Precio{{-- {{ $close } } --} }
                          <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.precioproneg" {{-- wire:keyup="verificarpeso" --} } class="form-control" id="precioproneg" aria-describedby="precioproneg" placeholder="INGRESE" wire:keyup="verificarpeso">
                          @error('precioproneg') <div class="invalid-feedback">{{ $message } }</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small></label>
                        </div>
            
                        <div style="width: 120px; margin-right: 2px;">
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="totalproneg">Monto{{-- {{ $close } } --} }
                          <input {{-- x-bind:disabled="!open" x-on:input="cambio(event)" --} } type="number" wire:model.defer="state.totalproneg" {{-- wire:keyup="verificarpeso" --} } class="form-control" id="totalproneg" aria-describedby="totalproneg" wire:keyup="verificarpeso" disabled>
                          @error('totalproneg') <div class="invalid-feedback">{{ $message } }</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small></label>
                        </div>
                        <div {{-- x-show="!v peso" --} } class="modal-footer">
                            <button x-show="open" x-bind:disabled="{{ $vpeso } }" wire:click="storem" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Agregar</button>
                        </div>
                        <div { {-- x-show="{ { $vpeso } }" --} } style="color: red" id="pesoi" value="{{ $vpeso } }">{ { $pesoi } }</div>
                        { {-- </form> --} }
                  </div>
                  </div>
                </div> --}}
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function main(){
  return { open: false, vpeso: false
    /* cambio: function (event) {
      //open: false, vpeso: false
      this.close = false;
      if(close == true){ 
        this.close = false;
      }
    } */
  }
}
</script>
</div>

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$('.formulario-eliminar').submit(function(e){
  e.preventDefault();
  Swal.fire({
  title: 'Atención',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '¿Realmente quiere eliminar el producto?'
  }).then((result) => {
    if (result.value) {
    /* if (result.isConfirmed) { */
      /* Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      ) */
      this.submit();
    }
  })
});
</script>
@endsection