@php $formatter = new NumberFormatter('', NumberFormatter::DECIMAL); @endphp
<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h1 class="card-title text-danger">
    <strong>COMPRA DE MATERIAL</strong></h1>
  </div>
  <div x-data="{ open: false, vpeso: false }" class="content">
    <div class="container-fluid mt-2">
      <div class="row aling: center" >
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="row aling: center" >
            {{-- DATOS DEL CLIENTE Y DEL PAGO--}}
            <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
              <div class="card">
                <div class="card-header bg-secondary" @php echo $fondoo; @endphp>
                  <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha: {{ date('d-m-Y') }} | Compra #: {{ $compra }}
                  </h3>
                </div> {{-- display: flex; flex-wrap: wrap; --}}
                <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
              {{-- <div style="width: 49%; margin-right: 2px;">
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
                </select>@error('state.idtipopago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div> --}}
                {{-- <div style="width: 100%; margin-right: 2px;"> --}}{{-- @if($idtipopago==4) --}}

                  @if($mostrarabonocompra=='true')
                  <div style="width: 39%; margin-right: 2px;"><label>Cédula o Rif</label>
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="cedulacompra" wire:keyup="busproccompra" style="width: 100%" id="cedulacompra" type="text" name="cedulacompra" placeholder="INGRESE CEDULA O RIF">
                      @error('cedulacompra')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                  </div>
                  <div style="width: 59%; margin-right: 2px;"><label for="nombrecompra" style="width: 100%; margin-right: 2px;">Nombre</label>
                    <input x-bind:disabled="!{{ $mostrar }}" wire:model="nombrecompra" wire:keyup="busproncompra" style="width: 100%; text-transform: uppercase;" id="nombrecompra" type="text" name="nombrecompra" placeholder="Ingrese el Nombre">
                  @error('nombrecompra')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                  <label for="idtipopago" style="width: 100%; margin-right: 2px;">
                  {{-- Tipo de Venta @else --}} Tipo de Abono </label>
                  <select x-bind:disabled="!{{ $mostrarabonocompra }}" name="idtipopago" wire:model="idtipopago" id="idtipopago" style="width: 100%; text-transform: uppercase;">
                    <option value="null" style="width: 100%;" selected>(SELECCIONE)</option>
                    @if($mostrarabonocompra!='true')
                     <option value="1">Contado</option>
                     <option value="2">Crédito</option>
                    @endif
                    @if($mostrarabonocompra=='true')
                     <option value="3">Abono de Material</option>
                     <option value="4">Abono a Crédito</option>
                    @endif
                  @endif
                  </select>@error('idtipopago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror{{-- </div> --}}


                    @php /* dd($negociacionescredito=$this->busnegccredito('V22222222')); */
                      if($idtipopago==4){ $negociacionescreditocompra=$this->busnegccreditocompra($this->cedulacompra); } 
                    @endphp
                    @if($idtipopago==4)
                      <div style="width: 100%; margin-right: 2px;"><label for="negociacion_idcompra" style="width: 100%; margin-right: 2px;">Crédito</label>
                        <select name="negociacion_idcompra" wire:model="negociacion_idcompra" id="negociacion_idcompra" style="width: 100%; text-transform: uppercase;" wire:onchange="cambioidcpc({{$this->negociacion_idcompra}})">
                          <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                          @foreach ($negociacionescreditocompra as $negociacion) 
                            @if($negociacion->idnegociacioncompra!=0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">N: {{$negociacion->idnegociacioncompra." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                          @foreach ($negociacionescreditocompra as $negociacion) 
                            @if($negociacion->idnegociacioncompra==0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">V: {{$negociacion->idcompra." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                        </select>@error('negociacion_idcompra')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    @endif
                  
              <div style="width: 100%; margin-right: 2px;">
              <label for="observacionesc">Observaciones
              <textarea x-bind:disabled="!{{ $mostrar }}" id="observacionesc" name="observacionesc" wire:model="observacionesc" rows="1" style="width: 100%; margin-right: 2px;" required>Ninguna</textarea>@error('observacionesc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div> {{--  --}}
                {{-- <div style="width: 100%;"> --}}
              {{-- <div style="width: 100%; margin-right: 2px;"> --}}
                @if($mostrarabonocompra!='true')
                <div style="width: 49%; margin-right: 2px;">
                <button x-show="{{ $mostrar }}" wire:click="default({{ $compra }})" class="btn btn-secondary ml-2 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                <div style="width: 49%; margin-right: 2px;">
                  @if ($this->nopagarventas=="true")
                    <button x-show="{{ $mostrar }}" id="btn-guardar" wire:click="update({{ $compra.','.$productosrecepcion.','.$totalcalculado }})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                  @endif </div>
                @endif
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="!{{ $mostrar }}" id="btn-generar" wire:click="generar" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> COMPRAR</button></label></div>
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="!{{ $mostrar }}" wire:click="nuevoabonocompra" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> ABONAR</button></div>
                @if($mostrarabonocompra=='true')
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="{{ $mostrar }}" wire:click="defaultabonocompra" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                  @if($idtipopago==3)
                    <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" {{-- wire:click="generardespacho" --}} class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                  @endif
                @endif
              {{-- </div> --}}
              </div>
            </div>
          </div>
        @if($idtipopago==4) {{-- AMORTIZACIONES A CREDITOS --}}
        <div class="col-lg-8 col-md-8 col-xs-12 mt-2">
          <div class="card">
            <div class="card-header bg-secondary">
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Amortizaciones a Créditos</h3></div>
            </div>
            <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
              <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                @if (is_null($this->negociacion_idcompra)!='false')
                  @if($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0]!=0)
                  {{-- @php dd($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0]); @endphp --}}
                    @php 
                      if($negociacion_idcompra!=session('valoridcpp')){
                          $ocultarbotoncompra="false"; $this->pagoefectivonegcompra=''; $this->pagotransfnegcompra='';
                          $this->validamontotncompra=""; $this->totalpagonegcompra=0; $this->restapagonegcompra=0;
                          session(['valoridcpp' => $negociacion_idcompra]);
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
                                {{ $formatter->formatCurrency($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0], ''), PHP_EOL }}</h1></td>
                                <td><a><i class="color danger fas fa-minus text-success"></i></a></td>
                                <td><h1 style="color: #28A745;"><strong>(</strong></h1></td>
                              <td>
                                <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagoefectivonegcompra" id="pagoefectivonegcompra" name="pagoefectivonegcompra" aria-describedby="pagoefectivonegcompra" placeholder="Ingresar" wire:keyup="calrestaabocredito({{$amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%; border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                              </td>
                              <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                              <td>
                                <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagotransfnegcompra" id="pagotransfnegcompra" name="pagotransfnegcompra" aria-describedby="pagotransfnegcompra" placeholder="Ingresar" wire:keyup="calrestaabocredito({{$amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                              </td>
                              <td><h1 style="color: #28A745;"><strong>)</strong></h1></td>
                              <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagonegcompra,2), ''), PHP_EOL }}</h1></td>
                              <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                              <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagonegcompra, ''), PHP_EOL }}</h1></td>
                            </tr>
                          
                            <tr><td></td>
                              <td colspan=8><h1 style="font-weight:900; color:red">{{ $validamontotncompra }}</h1></td>
                              <td colspan=2><label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                                <button x-show="{{ $ocultarbotoncompra }}" wire:click="guardaramortizacion" class="btn btn-primary mt-4">Agregar</button>
                              </label></td>
                            </tr>
                          </table>
                  @endif
                  <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                    @if ($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->count())
                      <label style="text-align: center; color: #17a2b8; width: 100%;">AMORTIZACIONES DE PAGO</label><label style="text-align: right;font-weight:900; color:red; width: 95%;">CREDITO POR:
                          {{ $formatter->formatCurrency($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('monto')[0], ''), PHP_EOL }}</label>
                      <table class="table table-striped"><thead><tr>
                        <th scope="col" colspan="2">FECHA - HORA</th>
                        <th scope="col">EFECTIVO</th>
                        <th scope="col">TRANSFERENCIA</th>
                        <th scope="col">PAGADO</th>
                        <th scope="col">DEBIA</th>
                        </tr></thead><tbody>
                        @foreach ($amortizacionesdepagocompra->where('id',$negociacion_idcompra) as $amortizaciondepago)
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
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif

        @if($this->mostrarcompra=="true") {{-- COMPRAS --}}
        {{-- Datos de recepcion de Materiales --}}
        <div class="col-lg-8 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-secondary" @php echo $fondoo; @endphp >
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;">
              {{-- @php dd($recepcionescompras); @endphp --}}
              # de Almacen:
              <select name="recepcionmaterial_id" wire:model="recepcionmaterial_id"
                wire:onchange="busnumalcompra" id="recepcionmaterial_id" style="text-transform: uppercase; color: black;">
                  <option value="NULL" style="width: 100%" selected>(SELECCIONE)</option>
                  @foreach ($recepcionescompras as $facturar)
                    <option value="{{$facturar->id}}">{{$facturar->id.' '.$facturar->fecha.' '.$facturar->cedula.' '.$facturar->nombre  }}</option>
                  @endforeach
                </select>
                @error('recepcionmaterial_id')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror

                {{-- <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black; margin-right: 2px;"># de Almacen:</h3>
              <input wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 200px; border-radius: 5px; background-color: white; border: 0px solid #dc3545; color: #dc3545; margin-right: 2px; padding-top: 0;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror --}}

                {{-- @php /* dd($negociacionescredito=$this->busnegccredito('V22222222')); */
                  if($idtipopago==4){ $this->busnegccreditocompra($this->recepcionmaterial_id); } 
                @endphp --}}

              <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha de Recepción: {{ $fecha }}</h3></div>
            </div>
            
            <div class="card-body" style="display: flex; flex-wrap: wrap;">
              {{-- <div class="form-group"> --}}
        {{-- @php
            dd(is_null($this->recepcionmaterial_id));
        @endphp --}}
              @if ($this->recepcionmaterial_id>0)
                {{-- @if($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0]!=0) --}}
                {{-- @php dd($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0]); @endphp --}}
                  @php 
                    /* $this->pagoefectivoventas=0;
                    $this->pagotransfventas =0;
                    $this->totalpagoventas =0;
                    //$this->restapagoventas=0; */
                    $datalm = $recibir->where('id', $this->recepcionmaterial_id);
                    $this->fecha = isset($datalm->pluck('fecha')[0]) ? $datalm->pluck('fecha')[0] : "";
                    $this->cedula = isset($datalm->pluck('cedula')[0]) ? $datalm->pluck('cedula')[0] : "";
                    $datalmn=$vendedores->where('cedula',$datalm->pluck('cedula')[0])->pluck('nombre')[0];
                    $this->nombre = isset($datalmn) ? $datalmn : "";
                    $datalml=$lugares->where('id',$datalm->pluck('idlugar')[0])->pluck('descripcion')[0];
                    $this->idlugar = isset($datalml) ? $datalml : "";
                    $this->pesofull = isset($datalm->pluck('pesofull')[0]) ? $datalm->pluck('pesofull')[0] : "";
                    $this->pesovacio = isset($datalm->pluck('pesovacio')[0]) ? $datalm->pluck('pesovacio')[0] : "";
                    $this->pesoneto = isset($datalm->pluck('pesoneto')[0]) ? $datalm->pluck('pesoneto')[0] : "";
                    $this->pesocalculado = isset($datalm->pluck('pesocalculado')[0]) ? $datalm->pluck('pesocalculado')[0] : "";
                    $this->observaciones = isset($datalm->pluck('observaciones')[0]) ? $datalm->pluck('observaciones')[0] : "";
                  @endphp
                    
                <div style="width: 200px; margin-right: 2px;"><label for="cedula">Cédula o Rif
                  <input disabled wire:model="cedula" id="cedula" class="form-control" type="text" name="cedula"></label></div>
                <div style="width: 200px; margin-right: 2px;"><label for="nombre">Nombre
                  <input disabled wire:model="nombre" id="nombre" class="form-control" type="text" name="nombre" style="text-transform: uppercase;"></label></div>
                <div style="width: 200px; margin-right: 2px;"><label for="idlugar">Lugar
                  <input disabled wire:model="idlugar" id="idlugar" class="form-control" type="text" name="idlugar" style="text-transform: uppercase;">
                  {{-- <select disabled name="idlugar" wire:model="idlugar" id="idlugar" class="form-control"><option value="NULL" selected>(SELECCIONE LUGAR)</option>
                  @foreach ($lugares as $lugar)
                    <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                  @endforeach
                  </select> --}}</label></div>
                <div style="width: 200px; margin-right: 2px;"><label for="pesofull">Peso FULL
                  <input disabled wire:model="pesofull" wire:keyup="calpeso" id="pesofull" class="form-control" type="number" name="pesofull"></label></div>
                <div style="width: 200px; margin-right: 2px;"><label for="pesovacio">Peso VACIO
                  <input disabled wire:model="pesovacio" wire:keyup="calpeso" id="pesovacio" class="form-control" type="number" name="pesovacio"></label></div>
                <div style="width: 200px; margin-right: 2px;"><label for="pesoneto">Peso NETO
                  <input disabled wire:model="pesoneto" id="pesoneto" class="form-control" type="text" name="pesoneto"></label></div>
                <div style="width: 200px;"><label for="observaciones">Observaciones
                  <textarea disabled wire:model="observaciones" rows="1" id="observaciones" class="form-control" cols="30" name="observaciones"></textarea></label></div>
              @endif
            </div>
          </div>
        </div>
        
        {{-- LISTA DE MATERIALES A PAGAR --}}
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-secondary" @php echo $fondoo; $this->totalcalculado=0; session(['toprodacum' => 0]); @endphp><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;"><label>Lista de Materiales</label></h3></div>
            <div class="card-body">
              {{-- <div class="d-flex justify-content-end mb-2">
                  <button x-bind:disabled="!open" wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Material a la lista</button>
              </div> --}}
              <table class="table table-striped"><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">MATERIAL</th>
                    <th scope="col">KG</th>
                    <th scope="col"> </th>
                    <th scope="col">PRECIO</th>
                    <th scope="col"></th>
                    <th scope="col">TOTAL</th>
                  </tr></thead><tbody>
                  {{-- @php
                    function conn(){
                      $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
                      mysqli_select_db($conn,'remeca');
                      return $conn;
                    }
                    function traemateriald($a){
                      /* $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
                      mysqli_select_db($conn,'remeca'); */
                      $sqltrol='SELECT descripcion FROM _pproductos WHERE id='.$a;
                      $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
                      $datrol=mysqli_fetch_array($restrol);
                      $descmat=$datrol[0];
                      mysqli_free_result($restrol);
                      return $descmat;
                    }
                    function traematerialp($a){
                      / * $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
                      mysqli_select_db($conn,'remeca'); * /
                      $sqltrol='SELECT precio FROM _pproductos WHERE id='.$a;
                      $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
                      $datrol=mysqli_fetch_array($restrol);
                      $descmat=$datrol[0];
                      mysqli_free_result($restrol);
                      return $descmat;
                    }
                  @endphp --}}
                  @foreach ($productosrecepcion as $productorecepcion)
                  <tr><th scope="row">{{ $loop->iteration }}</th>
                    {{-- <td>{{ traemateriald($productorecepcion->producto_id) }}</td> --}}
                    <td>{{ $this->traedesmaterial($productorecepcion->producto_id) }}</td>
                    <td style="text-align: right;">
                      {{-- <input type="text" wire:model="cantidadp[{{ $loop->iteration }}]" value="{{ $productorecepcion->cantidadprorecmat }}"> --}}
                      @php
                          //$cantidadp1 = $productorecepcion->cantidadprorecmat;
                          /* echo <input type="text" wire:model="cantidadp{{ $loop->iteration }}" value="{{ $productorecepcion->cantidadprorecmat }}"> */
                          /* echo '<input type="text" wire:model="cantidadp1" value="'. (double)$productorecepcion->cantidadprorecmat.'">'; */
                      $cantpro=$productosrecepcion->count();
                      //dd($cantpro);

                      $estilocalculos='style="color: red; width: 110px; font-weight: 900;"';
                      $estilocalculosprecio='style="color: red; width: 80px; font-weight: 900;"';

                      /* echo '<input type="number" wire:model="cantidadp'.$loop->iteration.'" value="'.(double)$productorecepcion->cantidadprorecmat.'" '.$estilocalculos.'>'; */

                      if ($productorecepcion->operacion=="SUMA") { //PERMITE MOSTRAR LOS INPUT
                        /* echo '<input type="number" wire:model="cantidadp'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculosprecio.' value="'.$productorecepcion->cantidadprorecmat.'">'; */
                        session(['cantidadp'.$loop->iteration => $productorecepcion->cantidadprorecmat]);
                      }

                          //echo '<input type="text" wire:model="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                          
                          //echo '<input type="text" id="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                      @endphp
                      {{-- <input type="text" wire:model="cantidadp1" value="{{ (double)$productorecepcion->cantidadprorecmat }}"> --}}
                      
                      {{-- NO BORRAR EL DE ABAJO, IMPRIME LA CANTIDAD DE LOS PRODUCTOS --}}
                      {{ $formatter->formatCurrency($productorecepcion->cantidadprorecmat, ''), PHP_EOL }}</td>
   
                    <td>
                    @php 
                        if ($productorecepcion->operacion=="RESTA") {
                          echo '<a><i class="fas fa-minus text-danger"></i></a>';
                        }if ($productorecepcion->operacion=="SUMA") {
                          echo '<a><i class="color danger fas fa-asterisk text-success"></i></a>';
                          //echo '<h1 style="color:red">*</h1>';

                          //$precio = traematerialp($productorecepcion->producto_id);
                          /* //ESTE DE ABAJO ESTÁ BUENO Y TRAE EL PRECIO DE LA TABLA PRODUCTO                          
                          $precio = $this->traeprematerial($productorecepcion->producto_id); */

                          //$precio = $this->traeprematerial($productorecepcion->producto_id);
                          $precio = $this->traeprematerialcliente($this->cedula, $productorecepcion->producto_id);

                                              /* $toprod = $productorecepcion->cantidadprorecmat * traematerialp($productorecepcion->producto_id); */

                          $toprod = (double)$productorecepcion->cantidadprorecmat * (double)$precio;

                          //$toprod = $productorecepcion->cantidadprorecmat * $precio;
                          /* PRECIOS CLIENTES */

                          $toprodacum = (double)$toprodacum + (double)$toprod;
                          session(['toprodacum' => $toprodacum]);

                          //$precio[$loop->iteration] = array(); $toprod[$loop->iteration] = array();
                          //$precio[$loop->iteration] = traematerialp($productorecepcion->producto_id);
                          //$toprod[$loop->iteration] = $productorecepcion->cantidadprorecmat * $precio[$loop->iteration];
                          //echo '<input type="text" id="$precio['.$loop->iteration.']" value="'.traematerialp($productorecepcion->producto_id).'">';

                          //dd((double)$productorecepcion->cantidadprorecmat * (double)traematerialp($productorecepcion->producto_id));

                          //$toprodacum = $toprodacum + $toprod[$loop->iteration];
                          $totalpagado = $toprodacum;
                        }
                     @endphp
                    </td><td>
                      @php
                        $verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                        /* if ($verificaoperacion=="SUMA"){  */
                        if ($productorecepcion->operacion=="SUMA") {
                          /* <td>echo $precio[$loop->iteration]; } */
                          //echo $precio;
                          /* echo '<input type="text" wire:model="precio1" wire:keyup="calpreind">'; */
                          
                          /* PRECIOS MANUALES */                      
                          /* echo '<input type="number" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculosprecio.'>'; */
                          
                          
                          //echo '<input type="text" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind">';
                          
                          //echo (double)traematerialp($productorecepcion->producto_id);
                          
                          //NO BORRAR EL DE ABAJO, IMPRIME EL PRECIO DE LOS PRODUCTOS
                          //echo (double)$precio;
                          echo $formatter->formatCurrency((double)$precio, ''), PHP_EOL;
                          
                          /* echo '<td><input style="width: 100px; border:0 font-weight: 900" type="text" id="precio['.$loop->iteration.']" value="'.isset($precio[$loop->iteration]).'" disabled/></td>'; }else{ echo "<td></td>"; */ 
                        }
                      @endphp</td>
                    <td>
                      @php 
                        //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                        /* if ($verificaoperacion=="SUMA"){ */
                        if ($productorecepcion->operacion=="SUMA") {
                          echo '<a><i class="color danger fas fa-equals text-success"></i></a>';
                          //echo '<h1 style="color:red"><b>=</b></h1>'; 
                        } 
                      @endphp
                    </td>
                    <td style="text-align: right;">
                    @php 
                      //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                      //dd($verificaoperacion);
                      /* if ($verificaoperacion=="SUMA"){  */
                        /* echo '<input type="text" wire:model="toprod1">'; */

                      /* TOTAL PRECIOS MANUALES */                      
                      /* if ($productorecepcion->operacion=="SUMA") {
                        echo '<input type="number" wire:model="toprod'.$loop->iteration.'" '.$estilocalculos.' disabled>';
                      } */

                        //echo '<input type="text" wire:model="toprod'.$loop->iteration.'">';

                        //echo (double)$productorecepcion->cantidadprorecmat * (double)traematerialp($productorecepcion->producto_id);

                       //NO BORRAR EL DE ABAJO, IMPRIME EL TOTAL CALCULADO DE LOS PRODUCTOS
                       //$formatter->formatCurrency($restapagoneg, ''), PHP_EOL
                       echo $formatter->formatCurrency((double)$productorecepcion->cantidadprorecmat * (double)$precio, ''), PHP_EOL;

                      if ($productorecepcion->operacion=="SUMA") {
                        //echo $toprod;
                        /* echo isset($toprod[$loop->iteration]); */ 
                      } 
                    @endphp
                    <input style="border:0 font-weight: 900" type="hidden" id="toprod" value="{{ isset($toprod[$loop->iteration]) }}" disabled/></td>
                    <td>
                      @php 
                        if ($productorecepcion->operacion=="RESTA") {
                        /* if ($verificaoperacion=="RESTA") { */
                            //$acumulado=$acumulado-$productorecepcion->cantidadprorecmat;
                            $pesodisponible=$pesodisponible+$acumulado;
                            $pesodisponiblec=$pesodisponible;
                            $acumuladoc=$acumulado;
                        }if ($productorecepcion->operacion=="SUMA") {
                        /* }if ($verificaoperacion=="SUMA") { */
                            $acumulado=$acumulado+$productorecepcion->cantidadprorecmat;
                            $pesodisponible=$pesodisponible-$acumulado;
                            $pesodisponiblec=$pesodisponible;
                            $acumuladoc=$acumulado;
                          echo '<a><i class="color danger fas fa-plus text-success"></i></a>';
                        }
                      @endphp
                  </td></tr>@endforeach</tbody>
                  <tfoot><tr><td colspan="3"><label>TOTAL A PAGAR</label></td>
                    <td>{{-- <h1 style="font-weight:900; color:red">{{ (double)$pesotn }}</h1> --}}
                    </td><td></td><td></td>
                    <td>{{-- <h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($montotnc, ''), PHP_EOL }}
                      </h1> --}}
                      {{-- PRECIOS CLIENTES --}}
                    <h1 style="font-weight:900; color:red">
                      {{-- {{ $formatter->formatCurrency($this->totalcalculado, ''), PHP_EOL }} --}}
                      {{ $formatter->formatCurrency(session('toprodacum'), ''), PHP_EOL }}
                      {{-- /* PRECIOS DE CLIENTES */
                      /* $this->totalcalculado=0 */
                      $this->totalcalculado=(double)$toprod*(double)$precio; --}}
                      </h1>

                      {{-- @php $restapagoneg = $montotn; @endphp --}}
                    </td><td></td></tr>
                    <tr><td></td></tr>
                      @php
                        //dd($this->mostrarpagoventas);
                        /* $this->pagoefectivoventas=0;
                        $this->pagotransfventas =0;
                        $this->totalpagoventas =0;*/
                        if($this->recepcionmaterial_id!=session('valoridmaterialafacturar')){
                          $ocultarbotoncompra="false"; $this->pagoefectivoventas=''; $this->pagotransfventas='';
                          $this->validamontotncompra="";
                          $this->totalpagoventas=0; 
                          /* $this->restapagonegcompra=0; */
                          $restapagoventas=session('toprodacum');
                          session(['valoridmaterialafacturar' => $this->recepcionmaterial_id]);
                      } 
    
                      @endphp
                      @if($this->mostrarpagoventas=='true') {{-- CALCULO PAGO NEGOCIACION DE COMPRA --}}
                        <tr><td><label>PAGO</label></td>

                          <td><label style="width: 100%; margin-right: 2px;">Efectivo <label style="color: red;">{{ $formatter->formatCurrency(round($efectivodisc,2), ''), PHP_EOL }}</label></label><span class="parpadea pago">{{ $validamontotneventas }}</span></td><td></td>
                          <td><label style="width: 100%; margin-right: 2px;">Transferencia <label style="color: red;">{{ $formatter->formatCurrency(round($bancodisc,2), ''), PHP_EOL }}</label></label><span class="parpadea pago">{{ $validamontotntventas }}</span></td><td></td><td></td>
                        </tr>
                      
                        <tr>
                          <td colspan="2">
                            <input {{-- x-bind:disabled="!{{ $mostrarc }}" --}} type="number" wire:model="pagoefectivoventas" id="pagoefectivoventas" name="pagoefectivoventas" aria-describedby="pagoefectivoventas" placeholder="Efectivo" wire:keyup="calrestaventas({{$montotnc}})" size="10" maxlength="10" min="0" max="9999999999" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-align: right; font-weight:900; width: 100%; color: red;">
                          </td>
                          <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                          <td>
                            <input {{-- x-bind:disabled="!{{ $mostrarc }}" --}} type="number" wire:model="pagotransfventas" id="pagotransfventas" name="pagotransfventas" aria-describedby="pagotransfventas" placeholder="Transferencia" wire:keyup="calrestaventas({{$montotnc}})" size="10" maxlength="10" min="0" max="9999999999"onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="text-align: right; font-weight:900; width: 100%; color: red;">
                          </td>
                          <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                          <td colspan="2" style="text-align: right;"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagoventas,2), ''), PHP_EOL }}</h1></td>
                        </tr>
                      
                        <tr><td></td>
                          <td colspan=3><h1 style="font-weight:900; color:red">{{ $validamontotventas }}</h1></td>
                          <td><label>Resta</label></td>
                          <td colspan="2" style="text-align: right;"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagoventas, ''), PHP_EOL }}</h1></td>
                        </tr>
                      @endif
                    <tr><td></td></tr>
                  </tfoot>
            
                  @if ($nomostrarcalculopremantabpro=="true") {{-- ESTO ESTÁ DESACTIVADO --}}
                    {{-- INICIO CALCULO PAGO PRECIOS MANUALES Y CALCULADOS TABLA PRODUCTOS --}}
                   <tfoot><tr><td colspan="2">
                     <label>TOTAL</label></td>
                     <td><label><h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{-- {{ $acumulado }} --}}
                       {{-- </h1><input style="border:0 font-weight: 900" wire:model="pesocalculado" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/> --}}</label></td><td></td><td></td>
                     <td></td><td style="text-align: right;">{{-- <h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $toprodacum }}</h1> --}}

                       {{-- {{' AQUI '.session('toprodacum')}} --}}
                     {{-- PRECIOS MANUALES --}}
                     {{-- <input type="number" wire:model="totalcalculado" id="totalcalculado" name="totalcalculado" style="width: 110px; color:red; font-weight: 900; border: 1px;" disabled class="numeric"> --}}

                     {{-- PRECIOS CLIENTES --}}
                     <h1 style="font-weight:900; color:red">
                     {{-- {{ $formatter->formatCurrency($this->totalcalculado, ''), PHP_EOL }} --}}
                     {{ $formatter->formatCurrency(session('toprodacum'), ''), PHP_EOL }}
                     {{-- /* PRECIOS DE CLIENTES */
                     /* $this->totalcalculado=0 */
                     $this->totalcalculado=(double)$toprod*(double)$precio; --}}
                     </h1>

                     </td></tr>

                     <tr><td colspan="3">{{-- defer="state.observacionesc" --}}
                       <label>TOTAL PAGADO</label></td>

                     <td colspan="3"><h1 style="font-weight:900; color:red" class="text-x text-red-500 italic">{{ $sobregiro }}</h1>
                     @error('state.totalpagado')<p style="font-weight:900; color:red" class="text-x text-red-500 italic">{{$message}}</p>@enderror</td>
                       <td><div style="">
                     <h1 style="font-weight:900; color:red">{{-- {{ $toprodacum }} --}}</h1>
                     <input {{-- x-bind:disabled="!open" --}} style="width: 110px; color: green;font-weight:900;" id="state.totalpagado" name="state.totalpagado" wire:model.defer="state.totalpagado" wire:keyup="caldiferencia" x-show="{{ $mostrarm }}" type="number" required {{-- class="numeric" --}} /></div></td></tr>
                     <tr><td colspan="3">
                       <label>DIFERENCIA</label></td>
                       <td></td><td></td>
                       <td></td><td><div style="width: 50px;">
                     <h1 style=" font-weight:900; color:red">{{-- {{ $diferenciapago }} --}}</h1>
                     <input style="width: 110px; border:0; font-weight: 900; color: red;" id="state.diferenciapago" name="state.diferenciapago" wire:model.defer="state.diferenciapago" x-show="{{ $mostrarm }}" type="number" {{-- id="diferenciapago" --}} disabled{{-- value="{{ $toprodacum }}" --}} class="numeric"/> 
                     </div></td></tr>
                   </tfoot>
                     {{-- FIN CALCULO PAGO PRECIOS MANUALES Y CALCULADOS TABLA PRODUCTOS --}}
                  @endif

              </table>
            </div>
          </div>

{{-- AMORTIZACIONES DE PAGOS --}}
{{-- @if($idtipopago==4) {{-- Lista de Materiales #336699 --} }
<div class="col-lg-8 col-md-8 col-xs-12 mt-2">
  <div class="card">
    <div class="card-header bg-secondary">
      <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Amortizaciones a Créditos</h3></div>
    </div>
    <div class="card-body" style="/* background-color: #9FA5AA; */ display: flex; flex-wrap: wrap; margin-right: 2px;">
      <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
  @if (is_null($this->negociacion_idcompra)!='false')
  
    @if($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0]!=0)
      @php 
        if($negociacion_idcompra!=session('valoridcpp')){
            $ocultarboton="false"; $this->pagoefectivoneg=''; $this->pagotransfneg='';
            $this->validamontotn=""; $this->totalpagoneg=0; $this->restapagoneg=0;
            session(['valoridcpp' => $negociacion_idcompra]);
        } 
      @endphp
            <table class="table table-striped"><thead><tr>
              <tr><td><label>DEBE</label></td>
                <td><label for="idtipopagov" style="width: 100%; margin-right: 2px;">{{-- Tipo --} }</label></td><td></td>
                <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Efectivo</label></td><td></td>
                <td><label for="precioprov" style="width: 100%; margin-right: 2px;">Transferencia</label></td><td></td><td><label>Total</label></td><td></td>
                <td></td>
                <td><label>Resta</label></td>
              </tr><tr>
                <td><h1 style="font-weight:900; color:red">
                  {{ $formatter->formatCurrency($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')[0], ''), PHP_EOL }}</h1></td>
                  <td><a><i class="color danger fas fa-minus text-success"></i></a></td>
                  <td><h1 style="color: #28A745;"><strong>(</strong></h1></td>
                <td>
                  <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagoefectivonegcompra" id="pagoefectivonegcompra" name="pagoefectivonegcompra" aria-describedby="pagoefectivonegcompra" placeholder="Ingresar" wire:keyup="calrestaneg({{$amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%; border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                </td>
                <td><a><i class="color danger fas fa-plus text-success"></i></a></td>
                <td>
                  <input x-bind:disabled="!{{ $mostrar }}" type="text" wire:model="pagotransfnegcompra" id="pagotransfnegcompra" name="pagotransfnegcompra" aria-describedby="pagotransfnegcompra" placeholder="Ingresar" wire:keyup="calrestaneg({{$amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('totalresta')}})" size="9" maxlength="9" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%;border-color: white white green white; font-weight:900; color:red; padding-top: 0px;">
                </td>
                <td><h1 style="color: #28A745;"><strong>)</strong></h1></td>
                <td><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency(round($totalpagonegcompra,2), ''), PHP_EOL }}</h1></td>
                <td><a><i class="color danger fas fa-equals text-success"></i></a></td>
                <td colspan="2"><h1 style="font-weight:900; color:red">{{ $formatter->formatCurrency($restapagonegcompra, ''), PHP_EOL }}</h1></td>
              </tr>

              <tr><td></td>
                <td colspan=8><h1 style="font-weight:900; color:red">{{ $validamontotncompra }}</h1></td>
                <td colspan=2><label for="" style="width: 100%; margin-right: 2px;" class="align-self-baseline">
                  <button x-show="{{ $ocultarbotoncompra }}" wire:click="guardaramortizacion" class="btn btn-primary mt-4">Agregar</button>
                </label></td>
              </tr>
            </table>
        @endif
        <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">

      @if ($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->count())
              <label style="text-align: center; color: #17a2b8; width: 100%;">AMORTIZACIONES DE PAGO</label><label style="text-align: right;font-weight:900; color:red; width: 95%;">CREDITO POR:
                  {{ $formatter->formatCurrency($amortizacionesdepagocompra->where('id',$negociacion_idcompra)->pluck('monto')[0], ''), PHP_EOL }}</label>
              <table class="table table-striped"><thead><tr>
                <th scope="col" colspan="2">FECHA - HORA</th>
                <th scope="col">EFECTIVO</th>
                <th scope="col">TRANSFERENCIA</th>
                <th scope="col">PAGADO</th>
                <th scope="col">DEBIA</th>
                </tr></thead><tbody>
                @foreach ($amortizacionesdepagocompra->where('id',$negociacion_idcompra) as $amortizaciondepago)
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
@endif --} }
        </div> --}} {{-- Datos del pago --}}
        {{-- <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-secondary" @php echo $fondoo; @endphp>
              <h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;"><label class="d-flex justify-content-center">Fecha de Pago: {{ date('d-m-Y') }} | Número de Pago {{ $compra }}
              </label></h3>
            </div> {{-- display: flex; flex-wrap: wrap; --} }
            <div class="card-body" style=" margin-right: 2px;">
              {{-- <div style="width: 49%; margin-right: 2px;">
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
                </select>@error('state.idtipopago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div> --} }
                <div style="width: 100%; margin-right: 2px;">{{-- @if($idtipopago==4) --} }

                  @if($mostrarabonocompra=='true')
                  <label for="idtipopago" style="width: 100%; margin-right: 2px;">
                  {{-- Tipo de Venta @else --} } Tipo de Abono </label>
                  <select x-bind:disabled="!{{ $mostrarabonocompra }}" name="idtipopago" wire:model="idtipopago" id="idtipopago" style="width: 100%; text-transform: uppercase;">
                    <option value="null" style="width: 100%;" selected>(SELECCIONE)</option>
                    @if($mostrarabonocompra!='true')
                     <option value="1">Contado</option>
                     <option value="2">Crédito</option>
                    @endif
                    @if($mostrarabonocompra=='true')
                     <option value="3">Abono de Material</option>
                     <option value="4">Abono a Crédito</option>
                    @endif
                  @endif
                  </select>@error('idtipopago')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>


                    @php /* dd($negociacionescredito=$this->busnegccredito('V22222222')); */
                      if($idtipopago==4){ $negociacionescreditocompra=$this->busnegccreditocompra('v77777777'/* $cedula */); } 
                    @endphp
                    @if($idtipopago==4)
                      <div style="width: 49%; margin-right: 2px;"><label for="negociacion_idcompra" style="width: 100%; margin-right: 2px;">Crédito</label>
                        <select name="negociacion_idcompra" wire:model="negociacion_idcompra" id="negociacion_idcompra" style="width: 100%; text-transform: uppercase;" wire:onchange="cambioidcpc({{$this->negociacion_idcompra}})">
                          <option value="NULL" style="width: 100%;" selected>(SELECCIONE)</option>
                          @foreach ($negociacionescreditocompra as $negociacion) 
                            @if($negociacion->idnegociacioncompra!=0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">N: {{$negociacion->idnegociacioncompra." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                          @foreach ($negociacionescreditocompra as $negociacion) 
                            @if($negociacion->idnegociacioncompra==0)
                              <option value="{{$negociacion->id}}" style="width: 100%;">V: {{$negociacion->idcompra." (POR PAGAR: ".
                              $formatter->formatCurrency($negociacion->totalresta, ''), PHP_EOL
                              }})</option>
                            @endif
                          @endforeach
                        </select>@error('negociacion_idcompra')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</div>
                    @endif
                  
              <div style="width: 100%; margin-right: 2px;">
              <label for="observacionesc">Observaciones
              <textarea x-bind:disabled="!{{ $mostrar }}" id="observacionesc" name="observacionesc" wire:model="observacionesc" rows="1" style="width: 100%; margin-right: 2px;" required>Ninguna</textarea>@error('observacionesc')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label></div> {{--  --} }
            <div style="width: 100%;">
              <div style="width: 100%; margin-right: 2px;">
                @if($mostrarabonocompra!='true')
                <button x-show="{{ $mostrar }}" wire:click="default({{ $compra }})" class="btn btn-secondary ml-2 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                <div style="width: 49%; margin-right: 2px;">
                  @if ($this->nopagarventas=="true")
                    <button x-show="{{ $mostrar }}" id="btn-guardar" wire:click="update({{ $compra.','.$productosrecepcion.','.$totalcalculado }})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                  @endif</div>
                @endif
                <div style="width: 100%; margin-right: 2px;">
                  <button x-show="!{{ $mostrar }}" id="btn-generar" wire:click="generar" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> COMPRAR</button></label>
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="!{{ $mostrar }}" wire:click="nuevoabonocompra" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> ABONAR</button></div>
                @if($mostrarabonocompra=='true')
                <div style="width: 49%; margin-right: 2px;">
                  <button x-show="{{ $mostrar }}" wire:click="defaultabonocompra" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                  {{-- @if($idtipopagov==3) --} }
                    <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" {{-- wire:click="generardespacho" --} } class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button></div>
                  {{-- @endif --} }
                @endif
              </div>
            </div>
          </div>
          </div>
        </div> --}}
      </div>
      @endif
    </div>
  </div>
@section('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection