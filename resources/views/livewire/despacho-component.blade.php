<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
    <div class="card-header"><h3 class="card-title">DESPACHO DE MATERIAL</h3></div>
    <div x-data="{ open: false, vpeso: false }" class="content">
      <div class="container-fluid">
        <div class="row aling: center" >
          <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
            <div class="card">
              <div class="card-header bg-warning" @php echo $fondoo; @endphp>
                <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black; margin-right: 2px;"># de Factura:</h3>
                <input wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 200px; border-radius: 5px; background-color: white; border: 0px solid #dc3545; color: #dc3545; margin-right: 2px; padding-top: 0;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror<h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha de Entrega: {{ date('d-m-Y') }}</h3></div>
              </div>
              <div class="card-body" style="display: flex; flex-wrap: wrap;">
                {{-- <div class="form-group"> --}}
                  <div style="width: 200px; margin-right: 2px;"><label for="cedulav">Cédula o Rif
                    <input disabled wire:model="cedulav" id="cedulav" class="form-control" type="text" name="cedulav"></label></div>
                  <div style="width: 200px; margin-right: 2px;"><label for="nombre">Nombre
                    <input disabled wire:model="nombre" id="nombre" class="form-control" type="text" name="nombre" style="text-transform: uppercase;"></label></div>
                  {{-- <div style="width: 200px; margin-right: 2px;"><label for="idlugar">Lugar
                    <input disabled wire:model="idlugar" id="idlugar" class="form-control" type="text" name="idlugar" style="text-transform: uppercase;"> --}}
                    {{-- <select disabled name="idlugar" wire:model="idlugar" id="idlugar" class="form-control"><option value="NULL" selected>(SELECCIONE LUGAR)</option>
                    @foreach ($lugares as $lugar)
                      <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                    @endforeach
                    </select> --}}{{-- </label></div> --}}
                  {{-- <div style="width: 200px; margin-right: 2px;"><label for="pesofull">Peso FULL
                    <input disabled wire:model="pesofull" wire:keyup="calpeso" id="pesofull" class="form-control" type="number" name="pesofull"></label></div>
                  <div style="width: 200px; margin-right: 2px;"><label for="pesovacio">Peso VACIO
                    <input disabled wire:model="pesovacio" wire:keyup="calpeso" id="pesovacio" class="form-control" type="number" name="pesovacio"></label></div>
                  <div style="width: 200px; margin-right: 2px;"><label for="pesoneto">Peso NETO
                    <input disabled wire:model="pesoneto" id="pesoneto" class="form-control" type="text" name="pesoneto"></label></div> --}}
                  <div style="width: 200px;"><label for="observacionesv">Observaciones
                    <textarea disabled wire:model="observacionesv" rows="1" id="observacionesv" class="form-control" cols="30" name="observacionesv"></textarea></label></div>
                  {{-- <div style="width: 80%; display: flex; flex-wrap: wrap;"> --}}
                    {{-- <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" wire:click="default({{ $compra }})" class="btn btn-secondary ml-2 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button></div>
                    <div style="width: 49%; margin-right: 2px;">
                      <button x-show="{{ $mostrar }}" id="btn-guardar" wire:click="update({{ $compra.','.$productosrecepcion.','.$totalcalculado }})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GUARDAR</button></div> --}}
                    <div style="width: 200px; margin-right: 2px; padding-top: 4px;">
                      <button x-show="!{{ $mostrar }}" id="btn-generar" wire:click="update({{ $recepcionmaterial_id }})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> ENTREGADO</button></label>
                    </div>
                  {{-- </div> --}}
              </div>
            </div>
          </div>{{-- Lista de Materiales a Pagar --}}
          <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
            <div class="card">
              <div class="card-header bg-warning" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;"><label>Lista de Materiales</label></h3></div>
              <div class="card-body">
                {{-- <div class="d-flex justify-content-end mb-2">
                    <button x-bind:disabled="!open" wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Material a la lista</button>
                </div> --}}
                <table class="table table-striped"><thead><tr> 
                      <th scope="col">#</th>
                      <th scope="col">MATERIAL</th>
                      <th scope="col">KG</th>
                      <th scope="col"> </th>
                      {{-- <th scope="col">PRECIO</th>
                      <th scope="col"></th>
                      <th scope="col">TOTAL</th> --}}
                    </tr></thead><tbody>
                    @foreach ($productosrecepcion as $productorecepcion)
                    <tr><th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $this->traedesmaterial($productorecepcion->producto_id) }}</td>
                      <td>
                        @php
      $cantpro=$productosrecepcion->count();
  
      $estilocalculos='style="color: red; width: 110px; font-weight: 900;"';
      $estilocalculosprecio='style="color: red; width: 80px; font-weight: 900;"';
  
  if ($productorecepcion->operacion=="SUMA") { //PERMITE MOSTRAR LOS INPUT
    //echo '<input type="number" wire:model="cantidadp'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculosprecio.'>';
  }
  
                        @endphp

                        {{ $productorecepcion->cantidadprorecmat }}</td>
                      <td>
                      @php 
                          if ($productorecepcion->operacion=="RESTA") {
                            //echo '<a><i class="fas fa-minus text-danger"></i></a>';
                          }if ($productorecepcion->operacion=="SUMA") {
                            //echo '<a><i class="color danger fas fa-asterisk text-success"></i></a>';
                            //echo '<h1 style="color:red">*</h1>';
  
                            //$precio = traematerialp($productorecepcion->producto_id);
        $precio = $this->traeprematerial($productorecepcion->producto_id);
  
                            /* $toprod = $productorecepcion->cantidadprorecmat * traematerialp($productorecepcion->producto_id); */
        $toprod = $productorecepcion->cantidadprorecmat * $precio;
  
                            //$toprod = $productorecepcion->cantidadprorecmat * $precio;
                            $toprodacum = (double)$toprodacum + (double)$toprod;
                            session(['toprodacum', $toprodacum]);
                            
                            $totalpagado = $toprodacum;
                          }
                       @endphp
                      </td><td>@php
                      $verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                      /* if ($verificaoperacion=="SUMA"){  */
                      if ($productorecepcion->operacion=="SUMA") {
                      }
                      @endphp</td>
                      <td>
                        @php 
                      //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                      /* if ($verificaoperacion=="SUMA"){ */
                      if ($productorecepcion->operacion=="SUMA") {
                        //echo '<a><i class="color danger fas fa-equals text-success"></i></a>';
                        //echo '<h1 style="color:red"><b>=</b></h1>'; 
                      } @endphp</td>
                      <td>@php 
                      //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                      //dd($verificaoperacion);
                      /* if ($verificaoperacion=="SUMA"){  */
                        /* echo '<input type="text" wire:model="toprod1">'; */
  
  if ($productorecepcion->operacion=="SUMA") {
  //  echo '<input type="number" wire:model="toprod'.$loop->iteration.'" '.$estilocalculos.' disabled>';
  }
  

                        
  
                      if ($productorecepcion->operacion=="SUMA") {
                        //echo $toprod;
                        /* echo isset($toprod[$loop->iteration]); */ } 
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
                            //echo '<a><i class="color danger fas fa-plus text-success"></i></a>';
                          }
                        @endphp
                    </td></tr>@endforeach</tbody>
                    <tfoot><tr><td colspan="2">
                      <label>TOTAL</label></td>
                      <td><label><h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $acumulado }}{{-- </h1><input style="border:0 font-weight: 900" wire:model="pesocalculado" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/> --}}</label></td><td></td><td></td>
                      <td></td><td>{{-- <h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $toprodacum }}</h1> --}}
  
  <input type="number" wire:model="totalcalculado" id="totalcalculado" name="totalcalculado" style="width: 110px; color:red; font-weight: 900; border: 0px;" disabled class="numeric"></td></tr>
  
                      <tr><td colspan="3">{{-- defer="state.observacionesc" --}}
                        {{-- <label>TOTAL PAGADO</label> --}}</td>
  
  <td colspan="3"><h1 style="font-weight:900; color:red" class="text-x text-red-500 italic">{{ $sobregiro }}</h1>
    @error('state.totalpagado')<p style="font-weight:900; color:red" class="text-x text-red-500 italic">{{$message}}</p>@enderror</td>
  
                        <td><div style="">
                    <h1 style="font-weight:900; color:red">{{-- {{ $toprodacum }} --}}</h1>
  <input {{-- x-bind:disabled="!open" --}} style="width: 110px; color: green;font-weight:900;" id="state.totalpagado" name="state.totalpagado" wire:model.defer="state.totalpagado" wire:keyup="caldiferencia" x-show="{{ $mostrarm }}" type="number" required {{-- class="numeric" --}} /></div></td></tr>
                      {{-- <tr><td colspan="3">
                        <label>DIFERENCIA</label></td>
                        <td></td><td></td>
                        <td></td><td><div style="width: 50px;">
                    <h1 style=" font-weight:900; color:red"> --}}{{-- {{ $diferenciapago }} --}}{{-- </h1>
  <input style="width: 110px; border:0; font-weight: 900; color: red;" id="state.diferenciapago" name="state.diferenciapago" wire:model.defer="state.diferenciapago" x-show="{{ $mostrarm }}" type="number" {{-- id="diferenciapago" --} } disabled{{-- value="{{ $toprodacum }}" --} } class="numeric"/></div></td></tr> --}}
                    </tfoot>
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