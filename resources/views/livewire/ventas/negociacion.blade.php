@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">
    <div class="card-header"><h1 class="card-title text-danger">
      <strong>ADMINISTRACION -> Negociación</strong></a>
      <a href="{{ route('livewire.ventas.venta') }}" class="btn btn-primary" style="color: #fff; text-shadow: 2px 2px 2px black;">Venta</a>
    </h1></div>
    {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
    <div x-data="main()" class="content">
      <div class="container-fluid mt-2 padding-2">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
            <div class="row aling: center" >
              <div class="col-lg-4 col-md-5 col-xs-4 mt-2">
                <div class="card">
                  <div class="card-header bg-secondary"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{$recepcionmaterial_id}}</h3></div></div>
                  <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 39%; margin-right: 2px;"><label>Cédula o Rif</label>
                      <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedulan" wire:keyup="busproc" style="width: 100%" id="cedulan" type="text" name="cedulan" placeholder="INGRESE CEDULA O RIF">
                      @error('cedulan')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </div>
                    <div style="width: 59%; margin-right: 2px;"><label style="width: 100%; margin-right: 2px;">Nombre</label>
                      <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombren" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombren" type="text" name="nombren" placeholder="Ingrese el Nombre">
                    @error('nombren')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    {{-- <div style="width: 49%; margin-right: 2px;"><label for="idtipopagon" style="width: 100%; margin-right: 2px;">Tipo de Pago
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
                     --}}
                     <div style="width: 100%; margin-right: 2px;"><label for="observaciones">Observaciones
                      <textarea x-bind:disabled="!{{ $mostrar }}" wire:model="observaciones" rows="1" id="observaciones" name="observaciones" placeholder="Ingrese las Observaciones" cols="55" style="width: 100%; text-transform: uppercase;"></textarea>@error('observaciones')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div><br>
                    <div style="width: 100%; display: flex; flex-wrap: wrap;">
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" wire:click="update({{ $recepcionmaterial_id.','.$pesotn }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="!{{ $mostrar }}" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button></div>
                    </div>
                  </div>
                </div>
              </div>{{-- Lista de Materiales #336699 --}}
              <div class="col-lg-8 col-md-7 col-xs-6 mt-2">
                <div class="card">
                  <div class="card-header bg-secondary">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Materiales a Negociar</h3></div>
                  </div>
                  <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="producto_idn" style="width: 80%; margin-right: 2px;">Material</label>
                            <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="producto_idn" wire:model="producto_idn" id="producto_idn" style="width: 100%;">
                              <option value="" selected>(SELECCIONE)</option>
                              @foreach ($productos as $producto)
                                <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                              @endforeach
                             </select><p x-show="{{ $mostraremid }}" class="text-x text-red-500 italic">SELECCIONE</p>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="cantidadprorecmatn" style="width: 100%; margin-right: 2px;">Peso</label>
                            <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="cantidadprorecmatn" id="cantidadprorecmatn" name="cantidadprorecmatn" aria-describedby="cantidadprorecmatn" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%;"><p x-show="{{ $mostraremc }}" class="text-x text-red-500 italic">INGRESE</p>
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="precionegn" style="width: 100%; margin-right: 2px;">Precio</label>
                            <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="precionegn" id="precionegn" name="precionegn" aria-describedby="precionegn" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%;"><p x-show="{{ $mostraremp }}" class="text-x text-red-500 italic">INGRESE</p>
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                            <label for="totalpronegn" style="width: 100%; margin-right: 2px;">Total</label>
                            <input x-show="{{ $mostrar }}" type="number" id="totalpronegn" name="totalpronegn" wire:model="totalpronegn" placeholder="TOTAL" style="width: 100%;" disabled>
                            <p class="text-x text-red-500 italic" style="pt-2"></p>
                            @error('totalpronegn')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                            <small id="emailHelp" class="form-text text-muted"></small>
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
                  <table class="table table-striped" {{-- style="background-color: #9FA5AA;" --}}><thead><tr> 
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
                      <td>{{ $formatter->formatCurrency($productorecepcion->cantidadprorecmatn, ''), PHP_EOL }}</td>
                      @php $pesotn=$pesotn+$productorecepcion->cantidadprorecmatn; @endphp
                      <td><a><i class="color danger fas fa-asterisk text-success"></i></a></td>
                      <td>{{ $formatter->formatCurrency($productorecepcion->precionegn, ''), PHP_EOL }}</td>
                      <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                      <td>{{ $formatter->formatCurrency($productorecepcion->totalpronegn, ''), PHP_EOL }}</td>
                      @php $montotn=$montotn+$productorecepcion->totalpronegn; 
                        session('montotng',$montotn);
                      @endphp
                      <td>
                        <a href="" wire:click.prevent="destroy({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
                      </td>@php $acumulado=$acumulado+$productorecepcion->totalpronegn @endphp
                    </tr>@endforeach</tbody>
                    <tfoot><tr><td colspan="3"><label>TOTAL A PAGAR</label></td>
                      <td>{{-- <h1 style="font-weight:900; color:red">{{ (double)$pesotn }}</h1> --}}
                      </td><td></td><td></td>
                      <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($montotn, ''), PHP_EOL }}
                      </h1>
                      {{-- @php $restapagoneg = $montotn; @endphp --}}
                      </td><td></td></tr>
                      <tr><td></td></tr>

                      @if($mostrarpagoneg=='true')
                      <tr><td><label>FACTURACION</label></td>
                        <td><label for="idtipopagov" style="width: 100%; margin-right: 2px;">{{-- Tipo --}}</label></td>

                        <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Efectivo</label></td><td></td>
                        <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Transferencia</label></td><td></td><td></td>
                      </tr>

                      <tr><td><label></label></td>
                        <td></td>

                        <td>
                          <input x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="pagoefectivoneg" id="pagoefectivoneg" name="pagoefectivoneg" aria-describedby="pagoefectivoneg" placeholder="Efectivo" wire:keyup="calrestaneg({{$montotn}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;">
                        </td>
                        <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                        <td>
                          <input x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="pagotransfneg" id="pagotransfneg" name="pagotransfneg" aria-describedby="pagotransfneg" placeholder="Transferencia" wire:keyup="calrestaneg({{$montotn}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;">
                        </td>
                        <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                        <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagoneg,2), ''), PHP_EOL }}</h1></td>
                      </tr>

                      <tr><td></td>
                        <td colspan=3><h1 style="font-weight:900; color:red">{{ $validamontotn }}</h1></td>
                        <td><label>Resta</label></td>
                        <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagoneg, ''), PHP_EOL }}</h1></td>
                      </tr>
                    @endif
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