<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
    <div class="card-header"><h3 class="card-title"><strong>ENTREGA DE MATERIAL</strong></h3></div>
    <div x-data="{ open: false, vpeso: false }" class="content">
      <div class="container-fluid">
        <div class="row aling: center" >
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
            <div class="card">
              <div class="card-header bg-warning" @php echo $fondoo; @endphp>
                <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h1 class="card-title" style="color: black;"><label>Entregar: </label></h1>

    {{-- @php dd($despachos->where('id', 1)->pluck('id') ); @endphp --}}
                  <select name="iddespacho" wire:model="iddespacho" id="iddespacho" style="width: 25%;">
                    <option value="NULL" selected>(SELECCIONE)</option>
                    @if ($despachos->count())
                      @foreach ($despachos as $despacho)
                        <option value="{{$despacho->id}}">
                          @php echo $despacho->id." (FECHA: ".$despacho->fechaventad.")"; @endphp
                        </option>
                      @endforeach
                    @endif
                  </select>
                {{-- <input wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 200px; border-radius: 5px; background-color: white; border: 0px solid #dc3545; color: #dc3545; margin-right: 2px; padding-top: 0;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror --}}
                <h1 class="card-title" style="color: black;"><label>Fecha de Entrega: {{ date('d-m-Y') }}</label></h1></div>
              </div>
              <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                {{-- <div class="form-group"> --}}
                  <div style="width: 24%; margin-right: 2px;"><label for="cedulav" style="width: 100%; margin-right: 2px;">Cédula o Rif</label>
                    <input disabled id="cedulav" type="text" name="cedulav" style="width: 100%; text-transform: uppercase;" 
                    @if (is_null($this->iddespacho)!='true')
                    value="{{ $despachar->where('despacho', $iddespacho)->pluck('cedula')[0] }}"
                    @endif >
                  </div>
                  <div style="width: 24%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre</label>
                    <input disabled id="nombre" type="text" name="nombre" style="width: 100%; text-transform: uppercase;" 
                    @if (is_null($this->iddespacho)!='true')
                    value="{{ $despachar->where('despacho', $iddespacho)->pluck('nombre')[0] }}"
                    @endif >
                  </div>
                    <div style="width: 24%; margin-right: 2px;"><label for="observacionesv" style="width: 100%; margin-right: 2px;">Observaciones</label>
                    <textarea disabled rows="1" id="observacionesv" cols="30" name="observacionesv" style="width: 100%; text-transform: uppercase;" 
                    @if (is_null($this->iddespacho)!='true')
                    value="{{ $despachar->where('despacho', $iddespacho)->pluck('observaciones')[0] }}"
                    @endif
                    ></textarea></div>
                    <div style="width: 24%; margin-right: 2px; padding-top: 4px;">
                      
                      <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline"></label>
                      <button x-show="!{{ $mostrar }}" id="btn-generar" wire:click="update({{ $iddespacho }})" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i> ACEPTAR</button>
                    </div>
                  {{-- </div> --}}
              </div>
            </div>
          </div>{{-- Lista de Materiales a Pagar --}}
          <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
            <div class="card">
              <div class="card-header bg-warning" @php echo $fondoo; @endphp><h3 class="card-title" style="color: black;"><label>Lista de Materiales</label></h3></div>
              <div class="card-body">
                {{-- <div class="d-flex justify-content-end mb-2">
                    <button x-bind:disabled="!open" wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Material a la lista</button>
                </div> --}}
    {{-- @php dd(is_null($this->iddespacho)); @endphp --}}
    
                <table class="table table-striped"><thead><tr> 
                      <th scope="col">#</th>
                      <th scope="col">MATERIAL</th>
                      <th scope="col">KG</th>
                    </tr></thead><tbody>
                @if (is_null($this->iddespacho)!='true')
                    @foreach ($despachar as $productoabono)
                    <tr><th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $productoabono->material }}</td>
                      <td>{{ $productoabono->cantidad }}</tr>
                    @endforeach
                @endif</tbody>
                    <tfoot><tr><td colspan="2"></td></tfoot>
                </table>
              </div>
            </div>
          </div>{{-- Datos del pago --}}
          {{-- <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
            <div class="card">
              <div class="card-header bg-warning" @php echo $fondoo; @endphp>
                <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;"><label class="d-flex justify-content-center">Fecha de Pago: {{ date('d-m-Y') }} | Número de Pago {{ $compra }}
                </label></h3>
              </div>
              <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                <div style="width: 49%; margin-right: 2px;">
                <label for="idestatuspago" style="width: 100%">Estatus de Pago
                <select x-bind:disabled="!{{ $mostrar }}" id="state.idestatuspago" name="state.idestatuspago" wire:model.defer="state.idestatuspago" style="width: 100%" placeholder="SELECCIONE" required>
                  <option value="SELECCIONE" selected>(SELECCIONE)</option>idestatuspago
                  <option value="1">Pagado</option><option value="2">Por Pagar</option>
                </select>@error('state.idestatuspago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                <div style="width: 49%; margin-right: 2px;">
                <label for="idtipopago">Tipo de Pago
                <select x-bind:disabled="!{{ $mostrar }}" id="state.idtipopago" name="state.idtipopago" wire:model.defer="state.idtipopago" style="width: 100%;" placeholder="SELECCIONE" required>
                    <option value="SELECCIONE" selected>(SELECCIONE)</option>
                    <option value="1">Contado</option><option value="2">Crédito</option><option value="3">Abono</option>
                  </select>@error('state.idtipopago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
                <div style="width: 100%; margin-right: 2px;">
                <label for="observacionesc">Observaciones
                <textarea x-bind:disabled="!{{ $mostrar }}" id="state.observacionesc" name="state.observacionesc" wire:model.defer="state.observacionesc" rows="1" style="width: 100%; margin-right: 2px;" required>Ninguna</textarea>@error('state.observacionesc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div>
              <div style="width: 80%; display: flex; flex-wrap: wrap;">
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="{{ $mostrar }}" wire:click="default({{ $compra }})" class="btn btn-secondary ml-2 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="{{ $mostrar }}" id="btn-guardar" wire:click="update({{ $compra.','.$productosrecepcion.','.$totalcalculado }})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="!{{ $mostrar }}" id="btn-generar" wire:click="generar" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GENERAR</button></label>
                </div>
              </div>
            </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @endsection