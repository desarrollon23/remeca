<div class="pt-1">
  <div class="card-header"><h3 class="card-title" {{-- style="color: #ffc107;" --}}>ALMACEN -> Recepción de Material</h3></div>
  {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
  <div x-data="main()" class="content">
    <div class="container-fluid">
      <div class="row aling: center" >
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-warning" style="background: #336699;">
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | # de Almacen: {{$recepcionmaterial_id}}</h3></div>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
              <div style="width: 49%; margin-right: 2px;"><label for="cedula">Cédula o Rif
                <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedula" wire:keyup="busproc" style="width: 100%" id="cedula" type="text" name="cedula" placeholder="INGRESE EDULA O RIF">
                @error('cedula')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
              </label></div>
              <div style="width: 49%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre
                <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" type="text" name="nombre" placeholder="Ingrese el Nombre">
              @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 49%; margin-right: 2px;"><label for="idlugar" style="width: 100%; margin-right: 2px;">Lugar
                <select x-bind:disabled="!{{ $mostrar }}" name="idlugar" wire:model="idlugar" id="idlugar" style="text-transform: uppercase; width: 100%;">
                  <option value="NULL" selected>(SELECCIONE LUGAR)</option>
                  @foreach ($lugares as $lugar)
                   <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                  @endforeach
                </select>@error('idlugar')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 49%; margin-right: 2px;"><label for="pesofull" style="width: 100%; margin-right: 2px;">Peso FULL
                <input x-bind:disabled="!{{ $mostrar }}" wire:model="pesofull" wire:keyup="calpeso" style="width: 100%" id="pesofull" type="number" name="pesofull" placeholder="INGRESE PESO FULL">@error('pesofull')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 49%; margin-right: 2px;"><label for="pesovacio" style="width: 100%; margin-right: 2px;">Peso VACIO
                <input x-bind:disabled="!{{ $mostrar }}" wire:model="pesovacio" wire:keyup="calpeso" style="width: 100%" id="pesovacio" type="number" name="pesovacio" placeholder="INGRESE PESO VACIO">@error('pesovacio')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 49%; margin-right: 2px;"><label for="pesoneto" style="width: 100%; margin-right: 2px;">Peso NETO
                <input disabled wire:model="pesoneto" style="width: 100%" id="pesoneto" type="text" name="pesoneto" placeholder="INGRESE PESO NETO">@error('pesoneto')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 100%; margin-right: 2px;"><label for="observaciones">Observaciones
                <textarea x-bind:disabled="!{{ $mostrar }}" wire:model="observaciones" rows="1" id="observaciones" name="observaciones" placeholder="Ingrese las Observaciones" cols="55" style="text-transform: uppercase;"></textarea>@error('observaciones')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div><br>
              {{-- <div class="d-flex justify-content-center mb-1"> --}}{{-- BOTONES --}}
              <div style="width: 80%; display: flex; flex-wrap: wrap;">
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
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-warning">
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Lista de Materiales a Recibir</h3></div>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                {{-- <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}"> --}}
                  <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div x-show="{{ $mostrarm }}" style="width: 24%; margin-right: 2px;">
                      <label for="producto_id" style="width: 100%; margin-right: 2px;">Material
                      <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="state.producto_id" wire:model.defer="state.producto_id" id="state.producto_id" class="form-control">
                        <option value="NULL" selected>(SELECCIONE)</option>
                        @foreach ($productos as $producto)
                          <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                        @endforeach
                       </select>@error('state.producto_id')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 24%; margin-right: 2px;">
                      {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
                      <label for="cantidadprorecmat" style="width: 100%; margin-right: 2px;">Peso{{-- {{ $close }} --}}
                      <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" x-on:input="cambio(event)" type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --}} class="form-control" id="state.cantidadprorecmat" name="state.cantidadprorecmat" aria-describedby="state.cantidadprorecmat" placeholder="Ingrese la cantidad" wire:keyup="verificarpeso">@error('state.cantidadprorecmat')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small></label>
                    </div>
                    {{-- <div x-show="{{ $mostrarm }}" style="width: 24%; margin-right: 2px;">
                      <label style="width: 100%; margin-right: 2px;">Operación
                      <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="state.operacion" wire:model.defer="state.operacion" id="state.operacion" placeholder="SELECCIONE LA OPERACION" class="form-control">
                        <option value="SELECCIONE" selected>(SELECCIONE)</option>
                        <option value="SUMA" selected>SUMA</option><option value="RESTA">RESTA</option>
                      </select>
                      @error('state.operacion')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                    </div> --}}
                    <div x-show="{{ $mostrarm }}" style="width: 24%; margin-right: 2px;"{{-- x-show="!v peso" --} } class="modal-footer" --}}>
                      <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                        <button x-show="{{ $mostrar }}" {{-- x-bind:disabled="{{ $vpeso }}"  --}}wire:click="storem" class="btn btn-primary mt-4"><i class="fa fa-save mr-1"></i>Agregar</button>
                        {{-- <button x-show="{{ $mostrar }}" x-bind:disabled="{{ $vpeso }}" wire:click="storem" class="btn btn-primary mt-4"><i class="fa fa-save mr-1"></i>Agregar</button> --}}
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

<script>
  $(document).ready(function(){
    window.addEventListener('no-existe', event => {
      Swal.fire({
        /* icon:info, */
        title: event.detail.message,
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      });
    })
  });
</script>
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