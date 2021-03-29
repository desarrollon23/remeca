<div class="pt-1">
    <div class="card-header"><h1 class="card-title text-danger">
      ADMINISTRACION -> Negociación</a>
      <a href="{{ route('livewire.venta-component') }}" class="btn btn-primary" style="color: #fff; text-shadow: 2px 2px 2px black;">Venta</a>
    </h1></div>
    {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
    <div x-data="main()" class="content">
      <div class="container-fluid mt-2">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
            <div class="row aling: center" >
              <div class="col-lg-4 col-md-6 col-xs-6 mt-2">
                <div class="card">
                  <div class="card-header bg-danger"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{$recepcionmaterial_id}}</h3></div></div>
                  <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 39%; margin-right: 2px;"><label for="cedulan">Cédula o Rif
                      <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedulan" wire:keyup="busproc" style="width: 100%" id="cedulan" class="form-control" type="text" name="cedulan" placeholder="INGRESE EDULA O RIF">
                      @error('cedulan')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </label></div>
                    <div style="width: 59%; margin-right: 2px;"><label for="nombren" style="width: 100%; margin-right: 2px;">Nombre
                      <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombren" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombren" class="form-control" type="text" name="nombren" placeholder="Ingrese el Nombre">
                    @error('nombren')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                    <div style="width: 49%; margin-right: 2px;"><label for="idtipopagon" style="width: 100%; margin-right: 2px;">Tipo de Pago
                      <select x-bind:disabled="!{{ $mostrar }}" name="idtipopagon" wire:model="idtipopagon" id="idtipopagon" class="form-control" style="text-transform: uppercase;">
                        <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                         <option value="1">Contado</option>
                         <option value="2">Crédito</option>
                         <option value="3">Abono</option>
                      </select>@error('idtipopagon')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                      <div style="width: 49%; margin-right: 2px;"><label for="idtipoabonon" style="width: 100%; margin-right: 2px;">Tipo de Abono
                        <select x-bind:disabled="!{{ $mostrar }}" name="idtipoabonon" wire:model="idtipoabonon" id="idtipoabonon" class="form-control" style="text-transform: uppercase;">
                          <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                           <option value="1">Efectivo</option>
                           <option value="2">Transferencia</option>
                        </select>@error('idtipoabonon')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                    <div style="width: 100%; margin-right: 2px;"><label for="observaciones">Observaciones
                      <textarea x-bind:disabled="!{{ $mostrar }}" wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones" placeholder="Ingrese las Observaciones" cols="55" style="text-transform: uppercase;"></textarea>@error('observaciones')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div><br>
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
                  <div class="card-header bg-danger">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Lista de Materiales a Recibir</h3></div>
                  </div>
                  <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="producto_idn" style="width: 100%; margin-right: 2px;">Material
                            <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="producto_idn" wire:model="producto_idn" id="producto_idn" class="form-control">
                              <option value="NULL" selected>(SELECCIONE)</option>
                              @foreach ($productos as $producto)
                                <option value="{{$producto->id}}">{{$producto->descripcion." (".$producto->cantidad." KG)"}}</option>
                              @endforeach
                             </select>@error('producto_idn')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="cantidadprorecmatn" style="width: 100%; margin-right: 2px;">Peso
                            <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="cantidadprorecmatn" class="form-control" id="cantidadprorecmatn" name="cantidadprorecmatn" aria-describedby="cantidadprorecmatn" placeholder="Ingrese la cantidad" wire:keyup="calpeso">@error('cantidadprorecmatn')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                            <small id="emailHelp" class="form-text text-muted"></small></label>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="precionegn" style="width: 100%; margin-right: 2px;">Precio
                            <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="precionegn" class="form-control" id="precionegn" name="precionegn" aria-describedby="precionegn" placeholder="Ingrese la cantidad" wire:keyup="calpeso">@error('precionegn')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                            <small id="emailHelp" class="form-text text-muted"></small></label>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="totalpronegn" style="width: 100%; margin-right: 2px;">Total
                            <input x-show="{{ $mostrar }}" type="number" id="totalpronegn" name="totalpronegn" wire:model="totalpronegn" class="form-control" placeholder="TOTAL" disabled>
                            <p class="text-x text-red-500 italic" style="pt-2"></p>
                            @error('totalpronegn')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
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
                  <table class="table table-striped"><thead><tr> 
                      <th scope="col">#</th>
                      <th scope="col">MATERIAL</th>
                      <th scope="col">KG</th>
                      <th scope="col"></th>
                      <th scope="col">PRECIO</th>
                      <th scope="col"></th>
                      <th scope="col">TOTAL</th>
                      <th scope="col"></th>
                    </tr></thead><tbody>
                    @foreach ($productosrecepcion as $productorecepcion)
                    <tr><th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $this->traedesmaterial($productorecepcion->producto_idn) }}</td>
                      <td>{{ $productorecepcion->cantidadprorecmatn }}</td>
                      <td><a><i class="color danger fas fa-plus text-asterisk text-success"></i></a></td>
                      <td>{{ $productorecepcion->precionegn }}</td>
                      <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                      <td>{{ $productorecepcion->totalpronegn }}</td>
                      <td>
                        <a href="" wire:click.prevent="destroy({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
                      </td>@php $acumulado=$acumulado+$productorecepcion->totalpronegn @endphp
                    </tr>@endforeach</tbody>
                    <tfoot><tr><td colspan="2"><label>TOTAL</label></td>
                      <td></td><td></td><td colspan="2"></td>
                      <td><h1 style="font-weight:900; color:red">{{ (double)$acumulado }}
                      </h1></td><td>{{-- {{ (double)session('pfn') }} --}}</td></tr>
                      <tr><td></td></tr>
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