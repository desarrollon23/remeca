<x-app-layout>
    <div class="pt-1">
      <div class="card-header"><h1 class="card-title text-danger">
        ADMINISTRACION -> Negociación de Venta -> Abono</a>
        {{-- <a href="{{ route('livewire.ventas.negociacion') }}" class="btn btn-primary" style="color: #fff; text-shadow: 2px 2px 2px black;">Negociación</a> --}}
      </h1></div>
      {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
      <div x-data="main()" class="content">
        <div class="container-fluid mt-2">
          <div class="row aling: center">
            <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
              <div class="row aling: center" >
                <div class="col-lg-4 col-md-6 col-xs-6 mt-2">
                  <div class="card">
                    <div class="card-header bg-secondary">
                        <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                            <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{$recepcionmaterial_id}}</h3>
                        </div>
                    </div>
                    <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                        <div style="width: 39%; margin-right: 2px;"><label for="cedulav">Cédula o Rif
                            <input wire:model="cedulav" wire:keyup="busproc" style="width: 100%" id="cedulav" class="form-control" type="text" name="cedulav" value="{{ $cliente[0]->cedulac }}" placeholder="INGRESE CEDULA O RIF" disabled>
                            </label>
                        
                        </div>
                      <div style="width: 59%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre
                        <input wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" class="form-control" type="text" name="nombre" value="{{ $cliente[0]->nombrec }}" placeholder="Ingrese el Nombre" disabled></label></div>
                      <div style="width: 100%; margin-right: 2px;"><label for="placav">Placa Camión
                        <input wire:model="placav" wire:keyup="busproc" style="width: 100%;" id="placav" class="form-control" type="text" name="placav" placeholder="INGRESE PLACA">
                        </label></div>
                      <div style="width: 100%; margin-right: 2px;"><label for="observacionesv">Observaciones
                        <textarea wire:model="observacionesv" rows="1" id="observacionesv" class="form-control" name="observacionesv" placeholder="Ingrese las Observaciones" cols="55" style="text-transform: uppercase;"></textarea></label></div><br>
                        <div style="width: 100%; display: flex; flex-wrap: wrap;">
                          <div style="width: 49%; margin-right: 2px;">
                          <button wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                          <div style="width: 49%; margin-right: 2px;">
                          <button wire:click="update({{ $recepcionmaterial_id/* .','.$acumulado */ }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                        <div style="width: 49%; margin-right: 2px;">
                          <button wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button></div>
                        </div>                
                    </div>
                  </div>
                </div>{{-- Lista de Materiales a Recibir #336699 --}}
                <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
                  <div class="card">
                    <div class="card-header bg-secondary">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title"  style="color: white; text-shadow: 2px 2px 2px black;">Abono de Materiales</h3></div></div>
                    <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                      <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                        <div style="width: 19%; margin-right: 2px;">
                          <label for="idproductov" style="width: 100%; margin-right: 2px;">Material
                          <select name="idproductov" wire:model="idproductov" id="idproductov" class="form-control">
                            <option value="NULL" selected>(SELECCIONE)</option>
                            @foreach ($productos as $producto)
                              <option value="{{$producto->id}}">{{$producto->descripcion." (".$producto->cantidad." KG)"}}</option>
                            @endforeach
                           </select></label>
                        </div>
                        <div style="width: 19%; margin-right: 2px;">
                          <label for="cantidadprov" style="width: 100%; margin-right: 2px;">Peso
                          <input type="number" wire:model="cantidadprov" class="form-control" id="cantidadprov" name="cantidadprov" aria-describedby="cantidadprov" placeholder="Ingrese la cantidad" wire:keyup="calpeso">
                          <small id="emailHelp" class="form-text text-muted"></small></label>
                        </div>
                        <div style="width: 19%; margin-right: 2px;">
                          <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                            <button wire:click="abonar" class="btn btn-primary mt-4"><i class="fa fa-save mr-1"></i>Abonar</button>
                          </label>
                        </div>
                      </div>
                      <div {{-- value="{{ $vpeso }}" --}}><p class="text-x text-red-500 italic">{{-- {{ $pesoi }} --}}</p></div>
                    {{-- </form> --}}
                  {{-- </div> --}}
                    </div>
                  @if ($productosabonados->where('ventas.negociacion_id',$recepcionmaterial_id)->count())
                    <table class="table table-striped"><thead><tr>
                        <th scope="col">FACTURA</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">MATERIAL</th>
                        <th scope="col">ABONO</th><th scope="col"></th>
                        <th scope="col">RESTA</th>
                      </tr></thead><tbody>
                      @foreach ($productosabonados as $productoabonado)
                        <tr><td scope="row">{{ $productoabonado->fechaventa }}</td>
                          <td scope="row">{{ $productoabonado->fechaventa }}</td>
                          <td>{{ $productoabonado->descripcion }}</td>
                          <td>{{ $productoabonado->cantidadprov }}</td>
                          <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                          <td>{{ $cantidades[$loop->iteration]-$productoabonado->cantidadprov }}</td>
                        </tr>
                      @endforeach</tbody>
                        <tfoot><tr><td colspan="2"><label>TOTAL</label></td>
                          <td></td><td></td><td colspan="2"></td>
                          <td><h1 style="font-weight:900; color:red">{{-- {{ (double)$acumulado }} --}}
                          </h1></td><td>{{-- {{ (double)session('pfn') }} --}}</td></tr>
                          <tr><td></td></tr>
                        </tfoot>
                    </table>
                    @else <h1 style="font-weight:900;">{{ 'No tiene Abonos'}}</h1><br></div>
                    @endif
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- </x-app> --}}
    {{-- <script>
    function main(){
      return { open: false, vpeso: false
        / * cambio: function (event) {
          //open: false, vpeso: false
          this.close = false;
          if(close == true){ 
            this.close = false;
          }
        } * /
      }
    }
    </script> --}}
</div>
    
    {{-- @section('js')
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
        / * if (result.isConfirmed) { * /
          / * Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          ) * /
          this.submit();
        }
      })
    });
    </script>
    @endsection --}}
</x-app>