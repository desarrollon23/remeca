<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">COMPRA DE MATERIAL</h3></div>
  <div x-data="{ open: false, vpeso: false }" class="content">
    <div class="container-fluid">
      <div class="row aling: center" >
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp>
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; margin-right: 2px;"># de Almacen:</h3>
              <input {{-- x-bind:disabled="!open" --}} wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 200px; border-radius: 5px; background-color: #336699; border: 1px solid #fff; color: #fff; margin-right: 2px;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror<h3 class="card-title" style="color: #fff;">Fecha de Recepción: {{ $fecha }}</h3></div>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap;">
              {{-- <div class="form-group"> --}}
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
                <div style="width: 400px;"><label for="observaciones">Observaciones
                  <textarea disabled wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones"></textarea></label></div>
            </div>
          </div>
        </div>{{-- Lista de Materiales a Pagar --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff;"><label>Lista de Materiales</label></h3></div>
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
                  @php
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
                      /* $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
                      mysqli_select_db($conn,'remeca'); */
                      $sqltrol='SELECT precio FROM _pproductos WHERE id='.$a;
                      $restrol=mysqli_query(conn(),$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error(conn()));
                      $datrol=mysqli_fetch_array($restrol);
                      $descmat=$datrol[0];
                      mysqli_free_result($restrol);
                      return $descmat;
                    }
                  @endphp
                  @foreach ($productosrecepcion as $productorecepcion)
                  <tr><th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ traemateriald($productorecepcion->producto_id) }}</td>
                    <td>
                      {{-- <input type="text" wire:model="cantidadp[{{ $loop->iteration }}]" value="{{ $productorecepcion->cantidadprorecmat }}"> --}}
                      @php
                          //$cantidadp1 = $productorecepcion->cantidadprorecmat;
                          /* echo <input type="text" wire:model="cantidadp{{ $loop->iteration }}" value="{{ $productorecepcion->cantidadprorecmat }}"> */
                          /* echo '<input type="text" wire:model="cantidadp1" value="'. (double)$productorecepcion->cantidadprorecmat.'">'; */
    $cantpro=$productosrecepcion->count();
    //dd($cantpro);

    $estilocalculos='style="color: red; width: 80px; font-weight: 900;"';

echo '<input type="number" wire:model="cantidadp'.$loop->iteration.'" value="'.(double)$productorecepcion->cantidadprorecmat.'" '.$estilocalculos.'>';

                          //echo '<input type="text" wire:model="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                          
                          //echo '<input type="text" id="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                      @endphp
                      {{-- <input type="text" wire:model="cantidadp1" value="{{ (double)$productorecepcion->cantidadprorecmat }}"> --}}
                      {{ $productorecepcion->cantidadprorecmat }}</td>
                    <td>
                    @php 
                        if ($productorecepcion->operacion=="RESTA") {
                          echo '<a><i class="fas fa-minus text-danger"></i></a>';
                        }if ($productorecepcion->operacion=="SUMA") {
                          echo '<a><i class="color danger fas fa-asterisk text-success"></i></a>';
                          //echo '<h1 style="color:red">*</h1>';
                          $precio = traematerialp($productorecepcion->producto_id);
                          $toprod = $productorecepcion->cantidadprorecmat * traematerialp($productorecepcion->producto_id);
                          //$toprod = $productorecepcion->cantidadprorecmat * $precio;
                          $toprodacum = (double)$toprodacum + (double)$toprod;
                          session(['toprodacum', $toprodacum]);
                          //$precio[$loop->iteration] = array(); $toprod[$loop->iteration] = array();
                          //$precio[$loop->iteration] = traematerialp($productorecepcion->producto_id);
                          //$toprod[$loop->iteration] = $productorecepcion->cantidadprorecmat * $precio[$loop->iteration];
                          //echo '<input type="text" id="$precio['.$loop->iteration.']" value="'.traematerialp($productorecepcion->producto_id).'">';

                          //dd((double)$productorecepcion->cantidadprorecmat * (double)traematerialp($productorecepcion->producto_id));

                          //$toprodacum = $toprodacum + $toprod[$loop->iteration];
                          $totalpagado = $toprodacum;
                        }
                     @endphp
                    </td><td>@php
                    $verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                    /* if ($verificaoperacion=="SUMA"){  */
                    if ($productorecepcion->operacion=="SUMA") {
                    /* <td>echo $precio[$loop->iteration]; } */
                      //echo $precio;
                      /* echo '<input type="text" wire:model="precio1" wire:keyup="calpreind">'; */
echo '<input type="number" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculos.'>';
                      //echo '<input type="text" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind">';

                      echo (double)traematerialp($productorecepcion->producto_id);
                      /* echo '<td><input style="width: 100px; border:0 font-weight: 900" type="text" id="precio['.$loop->iteration.']" value="'.isset($precio[$loop->iteration]).'" disabled/></td>'; }else{ echo "<td></td>"; */ }
                    @endphp</td>
                    <td>
                      @php 
                    //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                    /* if ($verificaoperacion=="SUMA"){ */
                    if ($productorecepcion->operacion=="SUMA") {
                      echo '<a><i class="color danger fas fa-equals text-success"></i></a>';
                      //echo '<h1 style="color:red"><b>=</b></h1>'; 
                    } @endphp</td>
                    <td>@php 
                    //$verificaoperacion=isset($productorecepcion->operacion) ? "RESTA" : "SUMA";
                    //dd($verificaoperacion);
                    /* if ($verificaoperacion=="SUMA"){  */
                      /* echo '<input type="text" wire:model="toprod1">'; */
                      
echo '<input type="number" wire:model="toprod'.$loop->iteration.'" '.$estilocalculos.' disabled>';
                      //echo '<input type="text" wire:model="toprod'.$loop->iteration.'">';
                      echo (double)$productorecepcion->cantidadprorecmat * (double)traematerialp($productorecepcion->producto_id);

                    if ($productorecepcion->operacion=="SUMA") {
                      //echo $toprod;
                      /* echo isset($toprod[$loop->iteration]); */ } 
                    @endphp
                    <input style="border:0 font-weight: 900" type="hidden" id="toprod" value="{{ isset($toprod[$loop->iteration]) }}" disabled/></td>
                    <td>
                      @php 
                        if ($productorecepcion->operacion=="RESTA") {
                        /* if ($verificaoperacion=="RESTA") { */
                            $acumulado=$acumulado-$productorecepcion->cantidadprorecmat;
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
                  <tfoot><tr><td colspan="2">
                    <label>TOTAL</label></td>
                    <td><label><h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $acumulado }}</h1><input style="border:0 font-weight: 900" wire:model="pesocalculado" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/></label></td><td></td><td></td>
                    <td></td><td><h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $toprodacum }}</h1>

<input type="number" wire:model="totalcalculado" style="width: 80px; color:red; font-weight: 900; border: 0px;" disabled></td></tr>

                    <tr><td colspan="3">{{-- defer="state.observacionesc" --}}
                      <label>TOTAL PAGADO</label></td>

<td colspan="3"><h1 style="font-weight:900; color:red">{{ $sobregiro }}</h1></td>

                      <td><div style="">
                  <h1 style="font-weight:900; color:red">{{-- {{ $toprodacum }} --}}</h1>
<input x-bind:disabled="!open" style="width: 110px; color: green;font-weight:900;" wire:model.defer="state.totalpagado" {{-- wire:keyup="caldiferencia"  --}}wire:keyup="caldiferencia({{ $toprodacum }})" x-show="open" type="number" {{-- id="totalpagado" value="{{ $toprodacum }}" --}} {{-- class="numeric" --}} /></div></td></tr>
                    <tr><td colspan="3">
                      <label>DIFERENCIA</label></td>
                      <td></td><td></td>
                      <td></td><td><div style="width: 50px;">
                  <h1 style=" font-weight:900; color:red">{{-- {{ $diferenciapago }} --}}</h1>
<input style="width: 110px; border:0; font-weight: 900; color: red;" wire:model.defer="state.diferenciapago" x-show="open" type="number" {{-- id="diferenciapago" --}} disabled{{-- value="{{ $toprodacum }}" --}} /></div></td></tr>
                  </tfoot>
              </table>
            </div>
          </div>
        </div>{{-- Datos del pago --}}
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp>
              <h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Fecha de Pago: {{ date('d-m-Y') }} | Número de Pago {{ $compra }}
              </label></h3>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap;">
              <label for="idestatuspago">Estatus de Pago
              <select x-bind:disabled="!open" name="idestatuspago" wire:model.defer="state.idestatuspago" id="idestatuspago" placeholder="SELECCIONE" required>
                <option value="SELECCIONE" selected>(SELECCIONE)</option>
                <option value="1">Pagado</option><option value="2">Por Pagar</option>
              </select></label>
              <label for="idtipopago">Tipo de Pago
              <select x-bind:disabled="!open" name="idtipopago" wire:model.defer="state.idtipopago" id="idtipopago" placeholder="SELECCIONE" required>
                  <option value="SELECCIONE" selected>(SELECCIONE)</option>
                  <option value="1">Contado</option><option value="2">Crédito</option><option value="3">Abono</option>
                </select></label>
              <label for="observacionesc">Observaciones
              <textarea x-bind:disabled="!open" wire:model.defer="state.observacionesc" rows="1" id="observacionesc" {{-- class="form-control" --}} style="width: 400px; margin-right: 2px;" required>Ninguna</textarea>   
              {{-- <textarea disabled wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones"></textarea></label> --}}
            <div style="width: 80%; display: flex; flex-wrap: wrap;">
              <div style="width: 400px; margin-right: 2px;"><label>
                <button x-show="open" x-on:click="{ open = !open }" wire:click="default({{ $compra }})" class="btn btn-secondary ml-2 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button>

<button x-show="open" x-on:click="{ open = !open }" id="btn-guardar" wire:click="update({{ $compra.','.$productosrecepcion.','.$toprodacum.','.$totalpagado/* .','.$observacionesc  */}})" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GUARDAR</button>

<button x-show="!open" x-on:click="{ open = !open }" id="btn-generar" wire:click="generar" class="btn btn-primary  ml-2 mr-2"><i class="fa fa-save mr-1"></i> GENERAR</button></label>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>{{-- MODAL --}}
  <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
      <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}">
        {{-- <div x-data="{ close : false }" class="modal-content"> --}}
        <div x-data="main()" class="modal-content">
          <div class="modal-header" @php echo $fondoo; @endphp>
            {{-- <h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Fecha: {{ date('d-m-Y') }} | # de Almacen: {{$recepcionmaterial_id}}</label></h3> --}}

            <h5 class="modal-title" id="exampleModalLabel" style="color: #fff;">
              @if ($showEditModal)
                Editar Material
              @else
                Nuevo Material
              @endif
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <div class="modal-body">
            <label for="recepcionmaterial_id"><input wire:model="recepcionmaterial_id" style="width: 100%" id="recepcionmaterial_id" class="form-control" type="hidden" name="recepcionmaterial_id"></label>
            <div class="form-group">
                
                <label for="producto_id" style="width: 30%">Material</label><label>
                <select name="producto_id" wire:model.defer="state.producto_id" id="producto_id" placeholder="Ingrese el Nombre" style="width: 125%">
                  <option value="NULL" selected>(SELECCIONE)</option>
                  @foreach ($productos as $producto)
                    <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                  @endforeach
                 </select></label>
            </div>              
            <div class="form-group">
              {{-- SIRVE CON CHANGE Y CON click x-on:click="close = !close"--}}
              <label for="cantidadprorecmat" style="width: 30%">Peso</label><label>{{-- {{ $close }} --}}
              <input {{-- x-on:input="cambio(event)" --}} type="number" wire:model.defer="state.cantidadprorecmat" {{-- wire:keyup="verificarpeso" --}} style="width: 100%" class="form-control" id="cantidadprorecmat" aria-describedby="cantidadprorecmatHelp" placeholder="Ingrese la cantidad">
              @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
              <small id="emailHelp" class="form-text text-muted"></small></label>

              {{-- <label for="acumuladoc" style="width: 30%">TOTAL</label><label>
              <input disabled wire:model.defer="acumuladoc" style="width: 100%" id="acumuladoc" class="form-control" type="text" name="acumuladoc"></label>

              <label for="pesodisponiblec" style="width: 30%">FALTA</label><label>
              <input disabled wire:model.defer="pesodisponiblec" style="width: 100%" id="pesodisponiblec" class="form-control" type="text" name="pesodisponiblec"></label> --}}
            </div>
            
            <div class="form-group">
              <label for="pesodisponiblec" style="width: 30%">Operación</label><label>
              <select name="operacion" wire:model.defer="state.operacion" id="operacion" placeholder="SELECCIONE LA OPERACION" style="width: 125%">
                <option value="SUMA" selected >SUMA</option><option value="RESTA">RESTA</option>
              </select>
              @error('operacion') <div class="invalid-feedback">{{ $message }}</div>@enderror</label>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
            {{-- <template x-if="close"> --}}
              {{-- <div> --}}
                <button {{-- x-show="close" x-on:click="close = !close"  --}}type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                   @if ($showEditModal)
                     <span>Guardar Cambios</span>
                   @else
                     <span>Guardar</span>
                   @endif
                 </button>
              {{-- </div> --}}
            {{-- </template> --}}
          </div>
        </div>
      </form>
    </div>
    <script>function main(){
      /* var valor = "<?php echo $close; ?>";
      close = valor; */
      //alert('close: ' + close);
      /* return { close: valor } */
      return {
        cambio: function (event) {
          /* alert(event.target.value);
          close = event.target.value;
          alert('close1: ' + close); */
          this.close = false;
          //alert('close: ' + close);
          if(close == true){ 
            this.close = false;
            //alert('close: ' + close);
          } 
        }
      }
    }
    </script>
  </div>{{-- ELIMINAR MATERIAL --}}
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5>Eliminar Material</h5></div>
        <div class="modal-body"><h4>¿Está seguro de Eliminar el Material?</h4></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
          <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
        </div>
      </div>
    </div>
  </div>
</div>




{{-- <div class="pt-1">
  <div class="card-header"><h3 class="card-title">COMPRAS</h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
<div class="pt-3">
  <div class="bg-white rounded-lg shadow overflow-hidden max-w-3xl mx-auto p-4 mb-6">
    <div class="mb-3">
      <label for="cedula">FECHA: {{ date('d-m-Y') }}</label><label for="cedula"> # DE CIERRE </label>
      <label for="cedula">Cédula</label>
      <input wire:model="cedula" id="cedula" placeholder="Ingrese la Cédula"/>
      @error('cedula')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
      <label for="nombre">Nombre</label>
      <input wire:model="nombre" id="nombre" placeholder="Ingrese el Nombre"/>
      @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
      <label for="idlugar">Lugar</label>
      <select name="idlugar" wire:model="idlugar" id="idlugar" placeholder="Ingrese el Nombre">
        <option value="NULL" selected>(SELECCIONE UN LUGAR)</option>
        @foreach ($lugares as $lugar)
          <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
        @endforeach
      </select>
      <label for="pesofull">Peso FULL</label>
      <input wire:model="pesofull" id="pesofull" placeholder="Ingrese la Peso FULL"/>
      <label for="pesovacio">Peso VACIO</label>
      <input wire:model="pesovacio" id="pesovacio" placeholder="Ingrese la Peso VACIO"/>
      <label for="pesoneto">Peso NETO</label>
      <input wire:model="pesoneto" id="pesoneto" placeholder="Ingrese la Peso NETO"/>
      <label for="idproducto">Material</label>
      <select name="idproducto" wire:model="idproducto" id="idproducto" placeholder="Ingrese el Nombre">
      <option value="NULL" selected>(SELECCIONE UN MATERIAL)</option>
        @foreach ($productos as $producto)
          <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
        @endforeach
      </select>
      @error('idproducto')
        <p class="text-x text-red-500 italic">{{$message}}</p>
      @enderror
      <label for="cantidadpro">Cantidad KG</label>
      <input wire:model="cantidadpro" id="cantidadpro" placeholder="Ingrese la Cantidad"/>
      @error('cantidadpro')
        <p class="text-x text-red-500 italic">{{$message}}</p>
      @enderror
      <button wire:click="store" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Agregar Material a la lista</button>
      <label for="cantidadpro">Observaciones</label>
      <textarea rows="2" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese las Observaciones"></textarea>
--}}
{{--       @if ($accion == "store") --} }
        <button wire:click="store" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">GUARDAR</button>
        <button wire:click="default" class="bg-red-400 hover:bg-red-700 mb-2 text-white font-bold px-4 py-2 rounded">CANCELAR</button>
{{--       @else
        <button wire:click="update" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded">Modificar</button>
        <button wire:click="default" class="bg-red-400 hover:bg-red-700 mb-2 text-white font-bold px-4 py-2 rounded">Cancelar</button>
      @endif --} }
    </div>
  </div>
    
<section class="content aling=center max-w-4xl mx-auto">
  <div class="container-fluid mx-auto"><div class="row"><div class="col-12"><div class="card">
    <div class="card-header"><h3 class="card-title">Lista de Materiales a Recibir</h3></div>
    <div class="card-body">
      <table id="example2" class="table table-bordered table-striped"><thead><tr>
          <th>NÚMERO</th>
          <th>DESCRIPCION</th>
          <th>KG</th>
          <th>OPCIONES</th>
        </tr></thead>
        <tbody>
          @foreach ($compradores as $comprador)
          <tr class="hover:bg-green-200">
            <td class="px-1 py-1">{{$comprador->id}}</td>
            <td class="px-1 py-1">{{$comprador->cedula}}</td>
            <td class="px-1 py-1">{{$comprador->idlugar}}</td>
            <td class="px-1 py-1">
              <button wire:click="edit({{$comprador}})" class="bg-blue-400 hover:bg-blue-700 mb-2 text-white font-bold px-4 py-2 rounded w-full">Editar</button>
              <button wire:click="destroy({{$comprador}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-1 py-1 rounded w-full">Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot><tr aria-colspan="4"><td><label>TOTAL</label><label>TOTAL {{-- {{ TOTAL CALCULADO }} --}}</label></td></tr>
        </tfoot>
      </table>
    </div>
    </div></div></div></div>
  </section>
{{-- </div> --}}
