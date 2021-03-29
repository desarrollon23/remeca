<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">COMPRA DE MATERIAL</h3></div>
  <div x-data="{ open: false, vpeso: false }" class="content">
    <div class="container-fluid">
      <div class="row aling: center" >
        <div class="col-lg-12 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-danger" @php echo $fondoo; @endphp>
              <div style="display: flex; flex-wrap: wrap; margin-right: 2px;"><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black; margin-right: 2px;"># de Almacen:</h3>
              <input wire:model="recepcionmaterial_id" wire:keyup="busnumal" style="width: 200px; border-radius: 5px; background-color: white; border: 0px solid #dc3545; color: #dc3545; margin-right: 2px; padding-top: 0;" id="recepcionmaterial_id" class="form-control" type="number" name="recepcionmaterial_id" placeholder="Ingrese el Número">@error('recepcionmaterial_id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror<h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;">Fecha de Recepción: {{ $fecha }}</h3></div>
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
                <div style="width: 200px;"><label for="observaciones">Observaciones
                  <textarea disabled wire:model="observaciones" rows="1" id="observaciones" class="form-control" cols="30" name="observaciones"></textarea></label></div>
            </div>
          </div>
        </div>{{-- Lista de Materiales a Pagar --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-danger" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff; text-shadow: 2px 2px 2px black;"><label>Lista de Materiales</label></h3></div>
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
                    <td>
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
echo '<input type="number" wire:model="cantidadp'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculosprecio.'>';

                          //echo '<input type="text" wire:model="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                          
                          //echo '<input type="text" id="cantidadp'.$loop->iteration.'" value="'. (double)$productorecepcion->cantidadprorecmat.'">';
                      @endphp
                      {{-- <input type="text" wire:model="cantidadp1" value="{{ (double)$productorecepcion->cantidadprorecmat }}"> --}}
                      
                      {{-- NO BORRAR EL DE ABAJO, IMPRIME LA CANTIDAD DE LOS PRODUCTOS --}}
                      {{ $productorecepcion->cantidadprorecmat }}</td>
                    <td>
                    @php 
                        if ($productorecepcion->operacion=="RESTA") {
                          echo '<a><i class="fas fa-minus text-danger"></i></a>';
                        }if ($productorecepcion->operacion=="SUMA") {
                          echo '<a><i class="color danger fas fa-asterisk text-success"></i></a>';
                          //echo '<h1 style="color:red">*</h1>';

                          //$precio = traematerialp($productorecepcion->producto_id);
      $precio = $this->traeprematerial($productorecepcion->producto_id);

                          /* $toprod = $productorecepcion->cantidadprorecmat * traematerialp($productorecepcion->producto_id); */
      $toprod = $productorecepcion->cantidadprorecmat * $precio;

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
echo '<input type="number" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind('.$loop->iteration.', '.$cantpro.')" '.$estilocalculosprecio.'>';
                      //echo '<input type="text" wire:model="precio'.$loop->iteration.'" wire:keyup="calpreind">';

                      //echo (double)traematerialp($productorecepcion->producto_id);

        //NO BORRAR EL DE ABAJO, IMPRIME EL PRECIO DE LOS PRODUCTOS
        //echo (double)$precio;

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

                      //echo (double)$productorecepcion->cantidadprorecmat * (double)traematerialp($productorecepcion->producto_id);
                      
      //NO BORRAR EL DE ABAJO, IMPRIME EL TOTAL CALCULADO DE LOS PRODUCTOS
      //echo (double)$productorecepcion->cantidadprorecmat * (double)$precio;
                      

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
                    <td><label><h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $acumulado }}{{-- </h1><input style="border:0 font-weight: 900" wire:model="pesocalculado" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/> --}}</label></td><td></td><td></td>
                    <td></td><td>{{-- <h1 style="font-weight:900; color:red" id="pesocalculado"><i class="fa fa-usd"></i>{{ $toprodacum }}</h1> --}}

<input type="number" wire:model="totalcalculado" id="totalcalculado" name="totalcalculado" style="width: 110px; color:red; font-weight: 900; border: 0px;" disabled class="numeric"></td></tr>

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
<input style="width: 110px; border:0; font-weight: 900; color: red;" id="state.diferenciapago" name="state.diferenciapago" wire:model.defer="state.diferenciapago" x-show="{{ $mostrarm }}" type="number" {{-- id="diferenciapago" --}} disabled{{-- value="{{ $toprodacum }}" --}} class="numeric"/></div></td></tr>
                  </tfoot>
              </table>
            </div>
          </div>
        </div>{{-- Datos del pago --}}
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header bg-danger" @php echo $fondoo; @endphp>
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
        </div>
      </div>
    </div>
  </div>
@section('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection