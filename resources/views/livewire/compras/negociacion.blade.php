@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">
    <div class="card-header"><h1 class="card-title text-danger">
      <strong>ADMINISTRACION -> Negociación</strong></a>
      <a href="{{ route('livewire.comprador-component') }}" class="btn btn-primary" style="color: #fff; text-shadow: 2px 2px 2px black;">Compras</a>
    </h1></div>
    {{-- <div x-data="{ open: false }" class="content"> --}}{{-- <div x-data="pdisponible()"> --}}
    <div x-data="main()" class="content">
      <div class="container-fluid mt-2 padding-2">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
            <div class="row aling: center" >
              <div class="col-lg-4 col-md-5 col-xs-4 mt-2">
                <div class="card">
                  <div class="card-header bg-secondary"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Negociación #: {{-- {{$recepcionmaterial_id}} --}}{{$idnegociacioncomprac}}</h3></div></div>
                  <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 39%; margin-right: 2px;"><label>Cédula o Rif</label>
                      <input x-bind:disabled="!{{ $mostrardc }}" wire:model="cedulanc" wire:keyup="busproc" style="width: 100%" id="cedulanc" type="text" name="cedulanc" placeholder="INGRESE CEDULA O RIF">
                      @error('cedulanc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </div>
                    <div style="width: 59%; margin-right: 2px;"><label style="width: 100%; margin-right: 2px;">Nombre</label>
                      <input x-bind:disabled="!{{ $mostrardc }}" wire:model="nombrenc" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombrenc" type="text" name="nombrenc" placeholder="Ingrese el Nombre">
                    @error('nombrenc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                     <div style="width: 100%; margin-right: 2px;"><label for="observacionesc">Observaciones
                      <textarea x-bind:disabled="!{{ $mostrarc }}" wire:model="observacionesc" rows="1" id="observacionesc" name="observacionesc" placeholder="Ingrese las Observaciones" cols="55" style="width: 100%; text-transform: uppercase;"></textarea>@error('observacionesc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div><br>
                    <div style="width: 100%; display: flex; flex-wrap: wrap;">
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrarc }}" wire:click="default({{ $idnegociacioncomprac }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                      <div x-show="{{ $nopagarc }}">
                        <button x-show="{{ $mostrarc }}" wire:click="update({{ $idnegociacioncomprac.','.$pesotnc }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                      </div>
                      <div style="width: 49%; margin-right: 2px;">
                      <button x-show="!{{ $mostrarc }}" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button></div>
                    </div>
                  </div>
                </div>
              </div>{{-- Lista de Materiales #336699 --}}
        @if ($vendedoresc[0]->where('cedula', $cedulanc)->count())
          @php 
            if($cedulanc!=session('valorcedulannc')){
                $ocultarbotonc="false"; $this->cantidadprorecmatnc=''; $this->precionegnc='';
                /* $this->validamontotn=""; */ $this->totalpronegnc=0; /* $this->restapagoneg=0; */
                session(['valorcedulannc' => $cedulanc]);
            } 
          @endphp
              <div class="col-lg-8 col-md-7 col-xs-6 mt-2">
                <div class="card">
                  <div class="card-header bg-secondary">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Materiales a Negociar</h3></div>
                  </div>
                  <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                          <div x-show="{{ $mostrarmc }}" style="width: 19%; margin-right: 2px;">
                            <label for="producto_idnc" style="width: 80%; margin-right: 2px;">Material</label>
                            <select x-show="{{ $mostrarc }}" x-bind:disabled="!{{ $mostrarc }}" name="producto_idnc" wire:model="producto_idnc" id="producto_idnc" wire:change="traerprecioc" style="width: 100%;">
                              <option value="" selected>(SELECCIONE)</option>
                              @foreach ($productosc as $productoc)
                                <option value="{{$productoc->id}}">{{$productoc->descripcion}}</option>
                              @endforeach
                             </select><p x-show="{{ $mostraremidc }}" class="text-x text-red-500 italic">SELECCIONE</p>
                          </div>
                          <div x-show="{{ $mostrarmc }}" style="width: 19%; margin-right: 2px;">
                            <label for="cantidadprorecmatnc" style="width: 100%; margin-right: 2px;">Peso</label>
                            <input x-show="{{ $mostrarc }}" x-bind:disabled="!{{ $mostrarc }}" type="text" wire:model="cantidadprorecmatnc" id="cantidadprorecmatnc" name="cantidadprorecmatnc" aria-describedby="cantidadprorecmatnc" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="10" maxlength="10" min="0" max="9999999999" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%; text-align: right;">
                            <p x-show="{{ $mostraremc }}" class="text-x text-red-500 italic">INGRESE</p>
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div x-show="{{ $mostrarmc }}" style="width: 19%; margin-right: 2px;">
                            <label for="precionegnc" style="width: 100%; margin-right: 2px;">Precio</label>
                            <input x-show="{{ $mostrarc }}" type="text" wire:model="precionegnc" id="precionegnc" name="precionegnc" aria-describedby="precionegnc" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="10" maxlength="10" min="0" max="9999999999" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%; text-align: right;" disabled><p x-show="{{ $mostrarempc }}" class="text-x text-red-500 italic">INGRESE</p>
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div x-show="{{ $mostrarmc }}" style="width: 19%; margin-right: 2px;">
                            <label for="totalpronegnc" style="width: 100%; margin-right: 2px;">Total</label>
                            <input x-show="{{ $mostrarc }}" type="text" id="totalpronegnc" name="totalpronegnc" wire:model="totalpronegnc" placeholder="TOTAL" style="width: 100%; text-align: right;" disabled>
                            <p class="text-x text-red-500 italic" style="pt-2"></p>
                            @error('totalpronegnc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                            <small id="emailHelp" class="form-text text-muted"></small>
                          </div>
                          <div x-show="{{ $mostrarmc }}" style="width: 19%; margin-right: 2px;">
                            <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                              <button x-show="{{ $ocultarbotonc }}" wire:click="storem" class="btn btn-primary mt-3"><i class="fa fa-save mr-1"></i>Agregar</button>
                            </label>
                          </div>
                        </div>
                        {{-- <div value="{{ $vpesoc }}"><p class="text-x text-red-500 italic">{{ $pesoic }}</p></div> --}}
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
                    @foreach ($productosrecepcionc as $productorecepcionc)
                    <tr><th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $this->traedesmaterial($productorecepcionc->producto_idn) }}</td>
                      <td>{{ $formatter->formatCurrency($productorecepcionc->cantidadprorecmatn, ''), PHP_EOL }}</td>
                      @php $pesotnc=$pesotnc+$productorecepcionc->cantidadprorecmatn; @endphp
                      <td><a><i class="color danger fas fa-asterisk text-success"></i></a></td>
                      <td>{{ $formatter->formatCurrency($productorecepcionc->precionegn, ''), PHP_EOL }}</td>{{ $formatter->formatCurrency(round($bancodisc,2), ''), PHP_EOL }}
                      <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                      <td style="text-align: right;">{{ $formatter->formatCurrency($productorecepcionc->totalpronegn, ''), PHP_EOL }}</td>
                      @php $montotnc=$montotnc+$productorecepcionc->totalpronegnc; 
                        session('montotngc',$montotnc);
                      @endphp
                      <td>
                        <a href="" wire:click.prevent="destroy({{ $productorecepcionc->id }})"><i class="fa fa-trash text-danger"></i></a>
                      </td>{{-- @php $acumuladoc=$acumuladoc+$productorecepcionc->totalpronegnc @endphp --}}
                    </tr>@endforeach</tbody>
                    <tfoot><tr><td colspan="3"><label>TOTAL A PAGAR</label></td>
                      <td>{{-- <h1 style="font-weight:900; color:red">{{ (double)$pesotn }}</h1> --}}
                      </td><td></td><td></td>
                      <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($montotnc, ''), PHP_EOL }}
                      </h1>
                      {{-- @php $restapagoneg = $montotn; @endphp --}}
                      </td><td></td></tr>
                      <tr><td></td></tr>

                      @if($mostrarpagonegc=='true') {{-- CALCULO PAGO NEGOCIACION DE COMPRA --}}
                      <tr><td><label>PAGO</label></td>
                        
                        <td><label style="width: 100%; margin-right: 2px;">Efectivo <label style="color: red;">{{ $formatter->formatCurrency(round($efectivodisc,2), ''), PHP_EOL }}</label></label><span class="parpadea pago">{{ $validamontotnec }}</span></td><td></td>
                        <td><label style="width: 100%; margin-right: 2px;">Transferencia <label style="color: red;">{{ $formatter->formatCurrency(round($bancodisc,2), ''), PHP_EOL }}</label></label><span class="parpadea pago">{{ $validamontotntc }}</span></td><td></td><td></td>
                      </tr>

                      <tr>
                        <td></td>

                        <td>
                          <input x-bind:disabled="!{{ $mostrarc }}" type="number" wire:model="pagoefectivonegc" id="pagoefectivonegc" name="pagoefectivonegc" aria-describedby="pagoefectivonegc" placeholder="Efectivo" wire:keyup="calrestanegc({{$montotnc}})" size="10" maxlength="10" min="0" max="9999999999" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-align: right; font-weight:900; width: 100%; color: red;">
                        </td>
                        <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                        <td>
                          <input x-bind:disabled="!{{ $mostrarc }}" type="number" wire:model="pagotransfnegc" id="pagotransfnegc" name="pagotransfnegc" aria-describedby="pagotransfnegc" placeholder="Transferencia" wire:keyup="calrestanegc({{$montotnc}})" size="10" maxlength="10" min="0" max="9999999999"onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-align: right; font-weight:900; width: 100%; color: red;">
                        </td>
                        <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                        <td colspan="2" style="text-align: right;"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagonegc,2), ''), PHP_EOL }}</h1></td>
                      </tr>

                      <tr><td></td>
                        <td colspan=3><h1 style="font-weight:900; color:red">{{ $validamontotnc }}</h1></td>
                        <td><label>Resta</label></td>
                        <td colspan="2" style="text-align: right;"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagonegc, ''), PHP_EOL }}</h1></td>
                      </tr>
                    @endif
                      <tr><td></td></tr>
                    </tfoot>
                  </table>
                </div>
              </div>
        @endif
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