@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">
  <div class="card-header"><h1 class="card-title text-danger">
  <strong>ADMINISTRACION -> Venta</strong>
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
                {{-- <div class="card-header bg-secondary"><div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Venta #</h3>
                  <input { {-- x-bind:disabled="!open" --} } wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 50px; border-radius: 5px; background-color: white; border: 1px solid #fff; color: #fff; margin-right: 2px;" id="recepcionmaterial_id" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                  
                  <h3 class="card-title"  style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ $fecha }}</h3>
                  
                  {{ $fecha }}</h3>
                
                </div></div> --}}
                <div class="card-header bg-secondary">
                  <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | 
                    @if($mostrarabono!='true')
                      Venta #: {{$recepcionmaterial_id}}
                    @else
                      Abono
                    @endif
                  
                  </h3></div></div>
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                  <div style="width: 39%; margin-right: 2px;"><label>Cédula o Rif</label>
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedulav" wire:keyup="busproc" style="width: 100%" id="cedulav" type="text" name="cedulav" placeholder="INGRESE CEDULA O RIF">
                      @error('cedulav')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                  </div>
                  <div style="width: 59%; margin-right: 2px;"><label for="nombre" style="width: 100%; margin-right: 2px;">Nombre</label>
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombre" wire:keyup="buspron" style="width: 100%; text-transform: uppercase;" id="nombre" type="text" name="nombre" placeholder="Ingrese el Nombre">
                  @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                  @if($mostrarabono!='true')
                  <div style="width: 49%; margin-right: 2px;"><label for="idlugarv" style="width: 100%; margin-right: 2px;">Lugar</label>
                    <select x-bind:disabled="!{{ $mostrar }}" name="idlugarv" wire:model="idlugarv" id="idlugarv" style="width: 100%; text-transform: uppercase;">
                      <option value="null" style="width: 100%;" >(SELECCIONE)</option>
                      @foreach ($lugares as $lugar)
                      <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                     @endforeach
                    </select>@error('idlugarv')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                  <div style="width: 49%; margin-right: 2px;"><label for="placav" style="width: 100%; margin-right: 2px;">Placa Camión</label>
                      <input x-bind:disabled="!{{ $mostrar }}" wire:model="placav" wire:keyup="busproc" style="width: 100%;" id="placav" type="text" name="placav" placeholder="INGRESE PLACA">
                          @error('placav')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      </div>
                  @endif
                  <div style="width: 49%; margin-right: 2px;"><label for="idtipopagov" style="width: 100%; margin-right: 2px;">
                    @if($mostrarabono!='true') Tipo de Venta @else Tipo de Abono @endif
                  </label>
                    <select x-bind:disabled="!{{ $mostrar }}" name="idtipopagov" wire:model="idtipopagov" id="idtipopagov" style="width: 100%; text-transform: uppercase;">
                      <option value="null" style="width: 100%;" selected>(SELECCIONE)</option>
                      @if($mostrarabono!='true')
                       <option value="1">Contado</option>
                       <option value="2">Crédito</option>
                      @endif
                      @if($mostrarabono=='true')
                       <option value="3">Abono de Material</option>
                       <option value="4">Abono a Crédito</option>
                      @endif
                    </select>@error('idtipopagov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    @php if($idtipopagov==3){ $negociaciones=$this->busnegc($cedulav); } @endphp
                    @if($idtipopagov==3)
                      <div style="width: 49%; margin-right: 2px;"><label for="negociacion_id" style="width: 100%; margin-right: 2px;">Negociación</label>
                        <select name="negociacion_id" wire:model="negociacion_id" id="negociacion_id" style="width: 100%; text-transform: uppercase;">
                          <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                          {{-- @php dd($negociaciones); @endphp --}}
                          @foreach ($negociaciones as $negociacion)
                            <option value="{{$negociacion->id}}" style="width: 100%;">{{$negociacion->id." (FECHA: ".$negociacion->fechan}})</option>
                          @endforeach  $restaven
                        </select>@error('negociacion_id')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    @endif

                    @php 
                      /* dd($negociacionescredito=$this->busnegccredito('V22222222')); */
                      if($idtipopagov==4){ $negociacionescredito=$this->busnegccredito($cedulav); } 
                    @endphp
                    @if($idtipopagov==4)
                      <div style="width: 49%; margin-right: 2px;"><label for="negociacion_id" style="width: 100%; margin-right: 2px;">Crédito</label>
                        <select name="negociacion_id" wire:model="negociacion_id" id="negociacion_id" style="width: 100%; text-transform: uppercase;" wire:onchange="cambioidcpc({{$this->negociacion_id}})">
                          <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                          @foreach ($negociacionescredito as $negociacion) 
                            @if($negociacion->idnegociacionventa!=0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">N: {{$negociacion->idnegociacionventa." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                          @foreach ($negociacionescredito as $negociacion) 
                            @if($negociacion->idnegociacionventa==0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">V: {{$negociacion->idventa." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                        </select>@error('negociacion_id')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    @endif
                  
                  <div style="width: 100%; margin-right: 2px;"><label for="observacionesv" style="width: 100%;">Observaciones</label>
                    <textarea x-bind:disabled="!{{ $mostrar }}" wire:model="observacionesv" rows="1" id="observacionesv" name="observacionesv" placeholder="Ingrese las Observaciones" cols="55" style="width: 100%; text-transform: uppercase;"></textarea>@error('observacionesv')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div><br>
                    <div style="width: 100%; display: flex; flex-wrap: wrap;">
                      @if($mostrarabono!='true')
                      <div style="width: 49%; margin-right: 2px;">
                        <button x-show="{{ $mostrar }}" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                        @if($ocultarbotonven=='true')
                          <button x-show="{{ $mostrar }}" wire:click="update({{ $recepcionmaterial_id.','.$acumulado }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                        @endif </div>
                      @endif
                      <div style="width: 49%; margin-right: 2px;">
                        <button x-show="!{{ $mostrar }}" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> VENDER</button></div>
                      <div style="width: 49%; margin-right: 2px;">
                        <button x-show="!{{ $mostrar }}" wire:click="nuevoabono" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> ABONAR</button></div>
                      @if($mostrarabono=='true')
                      <div style="width: 49%; margin-right: 2px;">
                        <button x-show="{{ $mostrar }}" wire:click="defaultabono" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>

                        @if($idtipopagov==3)
                          <div style="width: 49%; margin-right: 2px;">
                            <button x-show="{{ $mostrar }}" wire:click="generardespacho" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                        @endif
                      @endif
                    </div>
                </div>
              </div>
            </div>{{-- Lista de Materiales a Recibir #336699 --}}
  {{-- VENTA DE CONTADO Y A CREDITO --}}
  @if ($vendedores[0]->where('cedulac', $cedulav)->count())

  @if($idtipopagov!=3)
      @if($mostrarabono!='true')
            <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
              <div class="card">
                <div class="card-header bg-secondary">
                <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title"  style="color: white; text-shadow: 2px 2px 2px black;">Lista de Materiales</h3></div></div>
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                  <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="idproductov" style="width: 100%; margin-right: 2px;">Material</label>
                      <select x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" name="idproductov" wire:model="idproductov" id="idproductov" style="width: 100%;">
                        <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                        @foreach ($productos as $producto)
                          <option value="{{$producto->id}}" style="width: 100%">{{$producto->descripcion." (".$producto->cantidad." KG)"}}</option>
                        @endforeach
                       </select>@error('idproductov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="cantidadprov" style="width: 100%; margin-right: 2px;">Peso</label>
                      <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="cantidadprov" id="cantidadprov" name="cantidadprov" aria-describedby="cantidadprov" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%;">@error('cantidadprov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="precioprov" style="width: 100%; margin-right: 2px;">Precio</label>
                      <input x-show="{{ $mostrar }}" x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="precioprov" id="precioprov" name="precioprov" aria-describedby="precioprov" placeholder="Ingrese la cantidad" wire:keyup="calpeso" size="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%;">@error('precioprov')<p class="text-x text-red-500 italic" style="pt-2">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="totalprov" style="width: 100%; margin-right: 2px;">Total</label>
                      <input x-show="{{ $mostrar }}" type="number" id="totalprov" name="totalprov" wire:model="totalprov" placeholder="TOTAL" disabled style="width: 100%;">
                      <p class="text-x text-red-500 italic" style="pt-2"></p>
                      @error('totalprov')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;">
                      <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline"></label>
                        <button x-show="{{ $mostrar }}" wire:click="storem" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Agregar</button>
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
                          <select x-bind:disabled="!open" name="producto_id" wire:model.defer="state.producto_id" id="producto_id">
                            <option value="NULL" selected>(SELECCIONE)</option>
                            @foreach ($productos as $producto)
                              <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                            @endforeach
                           </select>
                        </div>
                        
                        <div style="width: 120px; margin-right: 2px;">
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="cantidadprorecmat">Peso{{-- {{ $close }} --} }
                          <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --} } id="cantidadprorecmat" aria-describedby="cantidadprorecmat" placeholder="INGRESE" wire:keyup="verificarpeso">
                          @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
            
                        <div style="width: 120px; margin-right: 2px;">
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="precioproneg">Precio{{-- {{ $close } } --} }
                          <input x-bind:disabled="!open" x-on:input="cambio(event)" type="number" wire:model.defer="state.precioproneg" {{-- wire:keyup="verificarpeso" --} } id="precioproneg" aria-describedby="precioproneg" placeholder="INGRESE" wire:keyup="verificarpeso">
                          @error('precioproneg') <div class="invalid-feedback">{{ $message } }</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
            
                        <div style="width: 120px; margin-right: 2px;">
                          {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--} }
                          <label for="totalproneg">Monto{{-- {{ $close } } --} }
                          <input {{-- x-bind:disabled="!open" x-on:input="cambio(event)" --} } type="number" wire:model.defer="state.totalproneg" {{-- wire:keyup="verificarpeso" --} } id="totalproneg" aria-describedby="totalproneg" wire:keyup="verificarpeso" disabled>
                          @error('totalproneg') <div class="invalid-feedback">{{ $message } }</div>@enderror
                          <small id="emailHelp" class="form-text text-muted"></small>
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
                    <td scope="col"></td>
                    <th scope="col">PRECIO</th>
                    <td scope="col"></td>
                    <th scope="col">TOTAL</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($productosrecepcion as $productorecepcion)
                  <tr><th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $this->traedesmaterial($productorecepcion->idproductov) }}</td>
                    <td>{{ $productorecepcion->cantidadprov }}</td>
                    <td><a><i class="color danger fas fa-plus text-asterisk text-success"></i></a></td>
                      <td>{{ $productorecepcion->precioprov }}</td>
                      <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                      <td>{{ $productorecepcion->totalprov }}</td>
                    <td>
                      <a href="" wire:click.prevent="destroy({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
                      </td>@php 
                        $acumulado=$acumulado+$productorecepcion->totalprov;
                        session(['totalacumulado' => $acumulado]);
                       @endphp
                    </tr>@endforeach</tbody>
                    <tfoot><tr><td colspan="2"><label>TOTAL</label></td>
                      <td></td><td></td><td colspan="2"></td>
                      <td><h1 style="font-weight:900; color:red">{{ (double)$acumulado }}
                      </h1></td><td>{{-- {{ (double)session('pfn') }} --}}</td></tr>
                      <tr><td></td></tr>
                
                      @if($mostrarpagoventa=='true')
                      <tr><td><label>FACTURACION</label></td>
                        <td><label for="idtipopagov" style="width: 100%; margin-right: 2px;">{{-- Tipo --}}</label></td>

                        <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Efectivo</label></td><td></td>
                        <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Transferencia</label></td><td></td><td></td>
                      </tr>

                      <tr><td><label></label></td>
                        <td></td>

                        <td>
                          <input x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="pagoefectivoven" id="pagoefectivoven" name="pagoefectivoven" aria-describedby="pagoefectivoven" placeholder="Efectivo" wire:keyup="calrestaven({{$acumulado}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;">
                        </td>
                        <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                        <td>{{-- session(['totalacumulado' => $acumulado]); --}}
                          <input x-bind:disabled="!{{ $mostrar }}" type="number" wire:model="pagotransfven" id="pagotransfven" name="pagotransfven" aria-describedby="pagotransfven" placeholder="Transferencia" wire:keyup="calrestaven({{$acumulado}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;">
                        </td>
                        <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                        <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagoven,2), ''), PHP_EOL }}</h1></td>
                      </tr>

                      <tr><td></td>
                        <td colspan=3><h1 style="font-weight:900; color:red">{{ $validamontotv }}</h1></td>
                        <td><label>Resta</label></td>
                        <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagoven, ''), PHP_EOL }}</h1></td>
                      </tr>
                    @endif


                    </tfoot>
                </table>



              </div>
            </div>
      @endif
  @endif
            {{-- @elseif($idtipopagov==3) --}}

  {{-- ABONO DE MATERIALES --}}
  @if($idtipopagov==3)
            <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
              <div class="card">
                <div class="card-header bg-secondary">
                <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title"  style="color: white; text-shadow: 2px 2px 2px black;">Abono de Materiales</h3></div></div>
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
                  <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 19%; margin-right: 2px;">

        @if (is_null($this->negociacion_id)!='false')

                        {{-- @php dd($productosabonar->where('negociacion_id',1)); @endphp --}}
                        <label for="idproductov" style="width: 100%; margin-right: 2px;">Material</label>
        {{-- @php dd($productosabonar->where('negociacion_id',$this->negociacion_id)); @endphp --}}
                        <select name="idproductov" wire:model="idproductov" id="idproductov" style="width: 100%;">
                        <option value="NULL" selected>(SELECCIONE)</option>

                        @if ($productosabonar->where('negociacion_id',$this->negociacion_id)->count())

                        @foreach ($productosabonar->where('negociacion_id',$this->negociacion_id) as $producto)
                          
                          <option value="{{$producto->id}}">
                            @php echo $producto->descripcion." (".$formatter->formatCurrency($producto->cantidadprorecmatn, ''), PHP_EOL ." KG Negociados. Debe ".$formatter->formatCurrency($producto->cantidadprorecmatndebe, ''), PHP_EOL ." KG)"; @endphp
                          </option>
                          @php session(['cantidadprorecmatndebe'.$producto->id => $producto->cantidadprorecmatndebe]); @endphp
                        @endforeach

                        @endif

                       </select>
                    </div>
                    <div style="width: 19%; margin-right: 2px;">
                      <label for="cantidadprov" style="width: 100%; margin-right: 2px;">Peso</label>
                      <input type="number" wire:model="cantidadprov" id="cantidadprov" name="cantidadprov" aria-describedby="cantidadprov" placeholder="Ingrese la cantidad" wire:keyup="verificarpeso({{$idproductov}})" size="9" maxlength="9" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeypress="mascara(this,cpf)" onpaste="return false" style="width: 100%;">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div style="width: 19%; margin-right: 2px;">
                      <label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline"></label>
                        <button x-show="{{$mabonar}}" wire:click="abonar({{$this->negociacion_id}})" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Abonar</button>
                    </div>
                  </div>
                  <div><p class="text-x text-red-500 italic">{{ $pesoabonarv }}</p></div>
                </div>

                {{-- @php if(is_null($this->negociacion_id)=='true'){ $this->negociacion_id=0; }
                //dd($this->negociacion_id.' - '.$productosabonados->where('negociacion_id',$this->negociacion_id)->count()); 
                @endphp --}}
              {{-- @if (is_null($this->negociacion_id)!='false') --}}
                {{-- @php dd($this->negociacion_id); @endphp --}}
            {{-- @php dd($productosabonados); @endphp --}}
            @if ($productosabonados->where('negociacion',$negociacion_id)->count())
              
                <table class="table table-striped"><thead><tr>
                    {{-- <th scope="col">FACTURA</th> --}}
                    <th scope="col">FECHA</th>
                    <th scope="col">MATERIAL</th>
                    {{-- <th scope="col">CANTIDAD</th><th scope="col"></th> --}}
                    <th scope="col">ABONO</th>{{-- <th scope="col"></th>
                    <th scope="col">RESTA</th> --}}
                    {{-- <th scope="col"></th> --}}
                  </tr></thead><tbody>
                    @php //dd($productosabonados->where('negociacion_id',$this->negociacion_id));
                    $productosabonados=$productosabonados->where('negociacion',$negociacion_id);
                    @endphp
                  @foreach ($productosabonados as $productoabonado)
                    <tr>{{-- <td scope="row">{{ $productoabonado->factura }}</td> --}}
                      <td scope="row">
                        @php
                          $dia = substr($productoabonado->fecha, 8, 2);
                          $mes = substr($productoabonado->fecha, 5, 2);
                          $ano = substr($productoabonado->fecha, 0, 4);
                          $hor = substr($productoabonado->fecha, 11, 8);
                          echo $dia."-".$mes."-".$ano." ".$hor;
                        @endphp                        
                        {{-- {{ $productoabonado->fecha }} --}}
                      </td>
                      <td>{{ $productoabonado->material }}</td>
                      {{-- <td>{{ $productoabonado->cantidad }}</td>
                      <td><a><i class="color danger fas fa-equals text-success"></i></a></td> --}}
                      <td>{{ $formatter->formatCurrency($productoabonado->abono, ''), PHP_EOL }}</td>
                      {{-- <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                      <td>{{ $productoabonado->cantidad-$productoabonado->cantidadprov }}</td> --}}

                      {{-- EL BOTON DE ABAJO ESTÁ BUENO NO BORRA --}}

                      {{-- <td><a href="" wire:click.prevent="destroyabonomaterial({{ $productoabonado->id }})"><i class="fa fa-trash text-danger"></i></a></td> --}}
                    </tr>
                  @endforeach</tbody>
                    <tfoot><tr><td></td></tr>
                    </tfoot>
                </table>
            @else <h1 style="font-weight:900;">{{ 'No tiene Abonos'}}</h1><br></div>
            @endif
        @endif
  @endif

  {{-- AMORTIZACIONES DE PAGOS --}}
  @if($idtipopagov==4)
              {{-- Lista de Materiales #336699 --}}
              <div class="col-lg-8 col-md-8 col-xs-12 mt-2">
                <div class="card">
                  <div class="card-header bg-secondary">
                    <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Amortizaciones a Créditos</h3></div>
                  </div>
                  <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
                    <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                          {{-- <div x-show="{{ $mostrarm }}" style="width: 19%; margin-right: 2px;"> --}}
                @if (is_null($this->negociacion_id)!='false')
                {{-- @if($negociacion_id!=0) --}}
                
                  @if($amortizacionesdepago->where('id',$negociacion_id)->pluck('totalresta')[0]!=0)
                    @php 
                      if($negociacion_id!=session('valoridcpc')){
                          $ocultarboton="false"; $this->pagoefectivoneg=''; $this->pagotransfneg='';
                          $this->validamontotn=""; $this->totalpagoneg=0; $this->restapagoneg=0;
                          session(['valoridcpc' => $negociacion_id]);
                      } 
                    @endphp
                          <table class="table table-striped"><thead><tr>
                            <tr><td><label>DEBE</label></td>
                              <td><label for="idtipopagov" style="width: 100%; margin-right: 2px;">{{-- Tipo --}}</label></td><td></td>
                              <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Efectivo</label></td><td></td>
                              <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Transferencia</label></td><td></td><td><label>Total</label></td><td></td>
                              <td></td>
                              <td><label>Resta</label></td>
                            </tr><tr>
                              <td><h1 style="font-weight:900; color:red">
                                {{ $formatter->formatCurrency($amortizacionesdepago->where('id',$negociacion_id)->pluck('totalresta')[0], ''), PHP_EOL }}</h1></td>
                                <td><a><i class="color danger fas fa-minus text-success"></i></a></td>
                                <td><h1 style="color: #28A745;"><strong>(</strong></h1></td>
                              <td>
                                <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagoefectivoneg" id="pagoefectivoneg" name="pagoefectivoneg" aria-describedby="pagoefectivoneg" placeholder="Ingresar" wire:keyup="calrestaneg({{$amortizacionesdepago->where('id',$negociacion_id)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%; border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                              </td>
                              <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                              <td>
                                <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagotransfneg" id="pagotransfneg" name="pagotransfneg" aria-describedby="pagotransfneg" placeholder="Ingresar" wire:keyup="calrestaneg({{$amortizacionesdepago->where('id',$negociacion_id)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                              </td>
                              <td><h1 style="color: #28A745;"><strong>)</strong></h1></td>
                              {{-- <td><a><i class="color danger fas fa-equals text-success"></i></a></td> --}}
                              <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagoneg,2), ''), PHP_EOL }}</h1></td>
                              <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                              <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagoneg, ''), PHP_EOL }}</h1></td>
                            </tr>

                            <tr><td></td>
                              <td colspan=8><h1 style="font-weight:900; color:red">{{ $validamontotn }}</h1></td>
                              <td colspan=2><label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                                <button x-show="{{ $ocultarboton }}" wire:click="guardaramortizacion" class="btn btn-primary mt-4">Agregar</button>
                              </label></td>
                              {{-- <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagoneg, ''), PHP_EOL }}</h1></td> --}}
                            </tr>
                          </table>
                      @endif
                        {{-- </div> --}}
                        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                        {{-- @php dd($amortizacionesdepago->where('id',$negociacion_id)); @endphp --}}
                        {{-- $negociacionescredito=$this->busnegccredito($cedulav); --}}

                    @if ($amortizacionesdepago->where('id',$negociacion_id)->count())
                            <label style="text-align: center; color: #17a2b8; width: 100%;">AMORTIZACIONES DE PAGO</label><label style="text-align: right;font-weight:900; color:red; width: 95%;">CREDITO POR:
                                {{ $formatter->formatCurrency($amortizacionesdepago->where('id',$negociacion_id)->pluck('monto')[0], ''), PHP_EOL }}</label>
                            <table class="table table-striped"><thead><tr>
                              <th scope="col" colspan="2">FECHA - HORA</th>
                              <th scope="col">EFECTIVO</th>
                              <th scope="col">TRANSFERENCIA</th>
                              <th scope="col">PAGADO</th>
                              <th scope="col">DEBE</th>
                              </tr></thead><tbody>
                              @foreach ($amortizacionesdepago->where('id',$negociacion_id) as $amortizaciondepago)
                                {{-- <tr><td scope="row">{{ $loop->iteration }}</td> --}}
                                  <td colspan="2">{{ $amortizaciondepago->fecha }} - {{ $amortizaciondepago->hora }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->efectivo, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->transferencia, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->pago, ''), PHP_EOL }}</td>
                                  <td>{{ $formatter->formatCurrency($amortizaciondepago->resta, ''), PHP_EOL }}</td>
                                </tr>
                              @endforeach</tbody>
                            </table>
                    @else <h1 style="font-weight:900;">{{ 'No tiene Amortizaciones de Pago'}}</h1>
                    @endif
                @endif
  @endif

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