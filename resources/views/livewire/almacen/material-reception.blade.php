<div class="pt-1">
  <div class="card-header"><h3 class="card-title">RECEPCION DE MATERIAL</h3></div>
  {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
  <div x-data="main()" class="content">
    <div class="container-fluid">
      <div class="row aling: center" >
        <div class="col-lg-4 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" style="background: #336699;">
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff;">Fecha: {{ date('d-m-Y') }} | # de Almacen: {{$recepcionmaterial_id}}</h3></div>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
              <div style="width: 200px; margin-right: 2px;"><label for="cedula">Cédula o Rif
                <input x-bind:disabled="!open" wire:model="cedula" wire:keyup="busproc" style="width: 100%" id="cedula" class="form-control" type="text" name="cedula" placeholder="INGRESE EDULA O RIF">
                  @error('cedula')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
              </label></div>
              <div style="width: 200px; margin-right: 2px;"><label for="nombre" style="width: 200px; margin-right: 2px;">Nombre
                <input x-bind:disabled="!open" wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese el Nombre">
              @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 200px; margin-right: 2px;"><label for="idlugar" style="width: 200px; margin-right: 2px;">Lugar
                <select x-bind:disabled="!open" name="idlugar" wire:model="idlugar" id="idlugar" class="form-control" style="text-transform: uppercase;">
                  <option value="NULL" style="width: 100%" selected>(SELECCIONE LUGAR)</option>
                  @foreach ($lugares as $lugar)
                   <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                  @endforeach
                </select></label></div>
              <div style="width: 200px; margin-right: 2px;"><label for="pesofull" style="width: 200px; margin-right: 2px;">Peso FULL
                <input x-bind:disabled="!open" wire:model="pesofull" wire:keyup="calpeso" style="width: 100%" id="pesofull" class="form-control" type="number" name="pesofull" placeholder="INGRESE PESO FULL"></label></div>
              <div style="width: 200px; margin-right: 2px;"><label for="pesovacio" style="width: 200px; margin-right: 2px;">Peso VACIO
                <input x-bind:disabled="!open" wire:model="pesovacio" wire:keyup="calpeso" style="width: 100%" id="pesovacio" class="form-control" type="number" name="pesovacio" placeholder="INGRESE PESO VACIO"></label></div>
              <div style="width: 200px; margin-right: 2px;"><label for="pesoneto" style="width: 200px; margin-right: 2px;">Peso NETO
                <input disabled wire:model="pesoneto" style="width: 100%" id="pesoneto" class="form-control" type="text" name="pesoneto" placeholder="INGRESE PESO NETO"></label></div>
              <div style="width: 100%; margin-right: 2px;"><label for="observaciones">Observaciones
                <textarea x-bind:disabled="!open" wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones" placeholder="Ingrese las Observaciones" style="text-transform: uppercase;"></textarea></label></div><br>
              <div class="d-flex justify-content-center mb-1">
                <button x-show="open" x-on:click="{ open = !open }" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button>
                <button x-show="open" x-on:click="{ open = !open }" wire:click="update({{ $recepcionmaterial_id }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                {{-- x-show="{{ !$vpeso }}" --}} 
                <button x-show="!open" x-on:click="{ open = !open }" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button>
              </div>                
            </div>
          </div>
        </div>{{-- Lista de Materiales a Recibir #336699 --}}
        <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" style="background: #336699;"><h3 class="card-title" style="color: #fff;"><label>Lista de Materiales a Recibir</label></h3></div>
            <div class="card-body">
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                {{-- <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}"> --}}
                  <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 200px; margin-right: 2px;">
                      <label for="producto_id">Material
                      <select x-bind:disabled="!open" name="producto_id" wire:model.defer="state.producto_id" id="producto_id">
                        <option value="NULL" selected>(SELECCIONE)</option>
                        @foreach ($productos as $producto)
                          <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                        @endforeach
                       </select></label>
                    </div>
                    <div style="width: 200px; margin-right: 2px;">
                      {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
                      <label for="cantidadprorecmat">Peso{{-- {{ $close }} --}}
                      <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --}} class="form-control" id="cantidadprorecmat" aria-describedby="cantidadprorecmat" placeholder="Ingrese la cantidad" wire:keyup="verificarpeso">
                      @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small></label>
                    </div>
                    <div style="width: 200px; margin-right: 2px;">
                      <label>Operación
                      <select x-bind:disabled="!open" name="operacion" wire:model.defer="state.operacion" id="operacion" placeholder="SELECCIONE LA OPERACION">
                        <option value="SELECCIONE" selected>(SELECCIONE)</option>
                        <option value="SUMA" selected>SUMA</option><option value="RESTA">RESTA</option>
                      </select>
                      @error('operacion') <div class="invalid-feedback">{{ $message }}</div>@enderror</label>
                    </div>
                    <div {{-- x-show="!v peso" --}} class="modal-footer">
                      {{-- <template x-if="close"> --}}
                      {{-- <div> --}}

                        {{-- <button x-s how="{ { $v peso }}" { {-- x-show="cl ose" x-on:click="close = !close"  --} }type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                             <span>Guardar</span>
                         </button> --}}
                         
                         {{-- @if ($accion == "store") --}} {{-- x-show="{{ $v peso }}"  --}}
                        <button x-show="open" x-bind:disabled="{{ $vpeso }}" wire:click="storem" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Agregar</button>
                        {{-- <div x-show="!open">
                        <button x-show="{{ !$vpeso }}" x-on:click="{ open = !open }" id="btn-generar" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button>
                      </div> --}}
                         {{-- @else --}}
                           {{-- <button wire:click="updatematerial" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Modificar</button> --}}
                           {{-- <button wire:click="default" class="btn btn-secondary mt-2"><i class="fa fa-times mr-1"></i>Cancelar</button> --}}
                         {{-- @endif --}}

                      {{-- </div> --}}
                      {{-- </template> --}}
                    </div>
                  <div {{-- x-show="{{ $vpeso }}" --}} style="color: red" id="pesoi" value="{{ $vpeso }}">{{ $pesoi }}</div>
                {{-- </form> --}}
              </div>
            </div>
            <table class="table table-striped"><thead><tr> 
                <th scope="col">#</th>
                <th scope="col">MATERIAL</th>
                <th scope="col">KG</th>
                <th scope="col"> </th>
                <th scope="col">Opciones</th>
              </tr></thead><tbody>
              @foreach ($productosrecepcion as $productorecepcion)
              <tr><th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $this->traedesmaterial($productorecepcion->producto_id) }}</td>
                <td>{{ $productorecepcion->cantidadprorecmat }}</td>
                <td>
                @php
                if ($productorecepcion->operacion=="RESTA") {
                    echo '<a><i class="fas fa-minus text-danger"></i></a>';
                    }if ($productorecepcion->operacion=="SUMA") {
                        echo '<a><i class="color danger fas fa-plus text-success"></i></a>';
                 }@endphp
                </td>
                <td>
                  {{-- <a href="" wire:click.prevent="edit({{ $productorecepcion->id }})"><i class="fa fa-edit mr-2"></i></a> --}}
                  <a href="" wire:click.prevent="destroy({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
                  {{-- <form action="{{ route('almacen.material-reception.destroy', $productorecepcion) }}" class="d-inline formulario-eliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form> --}}
                  {{-- <a href="" wire:click.prevent="edit({{ $productorecepcion }})"><i class="fa fa-edit mr-2"></i></a>
                  <a href="" wire:click.prevent="confirmUserRemoval({{ $productorecepcion }})"><i class="fa fa-trash text-danger"></i></a> --}}
                 {{-- <a href="" wire:click.prevent="{ {-- confirmUserRemoval({{ $sucursal->id }}) --} }deleteUser({ { $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a> --}}
                  {{-- @php  --}}
                    {{-- /* if ($productorecepcion->operacion=="RESTA") {
                        $acumulado=$acumulado-$productorecepcion->cantidadprorecmat;
                        session(['pesocalculado' => session('pesocalculado')+$productorecepcion->cantidadprorecmat]);
                        //$pesodisponible=$pesodisponible+$productorecepcion->cantidadprorecmat;
                    }if ($productorecepcion->operacion=="SUMA") {
                        $acumulado=$acumulado+$productorecepcion->cantidadprorecmat;
                        session(['pesocalculado' => session('pesocalculado')-$productorecepcion->cantidadprorecmat]);
                        //$pesodisponible=$pesodisponible-$productorecepcion->cantidadprorecmat;
                    } */ --}}
                 {{-- /*  @endphp */ --}}
                </td>
              </tr>@endforeach</tbody>
              <tfoot><tr><td colspan="2"><label>TOTAL</label></td>
                <td><h1 style="font-weight:900; color:red">{{ (double)session('pt') }}
                </h1></td><td></td></tr>
                <tr><td colspan="2"><label>FALTA</label></td>
                <td><h1 style="font-weight:900; color:red">{{ (double)session('pf') }}
                </h1></td><td></td></tr>
              </tfoot>
            </table>
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