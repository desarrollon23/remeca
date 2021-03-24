<div class="pt-1">
  <div class="card-header"><h3 class="card-title">COMPRA DE MATERIAL</h3></div>
  <div x-data="{ open: false }" class="content">
    <div class="container-fluid">
      <div class="row aling: center" >
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" style="background: #3f7819;">
              <h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Fecha: {{ date('d-m-Y') }} |</label></h3>

              <label for="id" style="width: 30%"># de Almacen:</label><label>
                <input x-bind:disabled="!open" wire:model="id" wire:keyup="busproc" style="width: 100%" id="id" class="form-control" type="text" name="id" placeholder="Ingrese la Cédula">
                {{-- @error('id')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror --}}
            </label>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="cedula" style="width: 30%">Cédula o Rif</label><label>
                    <input x-bind:disabled="!open" wire:model="cedula" wire:keyup="busproc" style="width: 100%" id="cedula" class="form-control" type="text" name="cedula" placeholder="Ingrese la Cédula">
                    @error('cedula')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                </label>
                <label for="nombre" style="width: 30%">Nombre</label><label>
                <input x-bind:disabled="!open" wire:model="nombre" wire:keyup="buspron" style="width: 100%" id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese el Nombre">
                @error('nombre')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                <label for="idlugar" style="width: 30%">Lugar</label><label>
                <select x-bind:disabled="!open" name="idlugar" wire:model="idlugar" id="idlugar" class="form-control">
                  <option value="NULL" style="width: 100%" selected>(SELECCIONE LUGAR)</option>
                  @foreach ($lugares as $lugar)
                    <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                  @endforeach
                </select></label>
                <label for="pesofull" style="width: 30%">Peso FULL</label><label>
                <input x-bind:disabled="!open" wire:model="pesofull" wire:keyup="calpeso" style="width: 100%" id="pesofull" class="form-control" type="number" name="pesofull" placeholder="Ingrese Peso FULL"></label>
                <label for="pesovacio" style="width: 30%">Peso VACIO</label><label>
                <input x-bind:disabled="!open" wire:model="pesovacio" wire:keyup="calpeso" style="width: 100%" id="pesovacio" class="form-control" type="number" name="pesovacio" placeholder="Ingrese Peso VACIO"></label>
                <label for="pesoneto" style="width: 30%">Peso NETO</label><label>
                <input disabled wire:model="pesoneto" style="width: 100%" id="pesoneto" class="form-control" type="text" name="pesoneto" placeholder="Ingrese Peso NETO"></label>
                <label for="observaciones">Observaciones</label>
                <textarea x-bind:disabled="!open" wire:model="observaciones" rows="1" id="observaciones" class="form-control" name="observaciones" placeholder="Ingrese las Observaciones"></textarea><br>
                {{-- <div>@php if(isset($nopuedeguardar)<>null){ echo '<p class="text-x text-red-500 italic">'.$nopuedeguardar.'</p>'; } @endphp</div> --}}
                <div wire:model="nopuedeguardar" class="text-x text-red-500 italic"></div>
                <div class="d-flex justify-content-center mb-1">
                  
                <button x-show="open" x-on:click="{ open = !open }" wire:click="default({{ $recepcionmaterial_id }})" class="btn btn-secondary mb-1 mr-2"><i class="fa fa-times mr-1"></i> CANCELAR</button>
                  <div x-show="open">
                    <button x-on:click="{ open = !open }" id="btn-guardar" wire:click="update({{ $recepcionmaterial_id }})" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GUARDAR</button>
                  </div>
                  <div x-show="!open">
                    <button x-on:click="{ open = !open }" id="btn-generar" wire:click="generar" class="btn btn-primary mb-1"><i class="fa fa-save mr-1"></i> GENERAR</button>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>{{-- Lista de Materiales a Recibir --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" style="background: #3f7819;"><h3 class="card-title" style="color: #fff;"><label>Lista de Materiales a Recibir</label></h3></div>
            <div class="card-body">
              <div class="d-flex justify-content-end mb-2">
                  <button x-bind:disabled="!open" wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Material a la lista</button>
              </div>
              <table class="table table-striped"><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">MATERIAL</th>
                    <th scope="col">KG</th>
                    <th scope="col"> </th>
                    <th scope="col">Opciones</th>
                  </tr></thead><tbody>
                  @php
                    function traematerial($a){
                      $conn=mysqli_connect("localhost", "root", '') or trigger_error(mysqli_error(),E_USER_ERROR);
                      mysqli_select_db($conn,'remeca');
                      $sqltrol='SELECT descripcion FROM _pproductos WHERE id='.$a;
                      $restrol=mysqli_query($conn,$sqltrol) or die('FALLO LA CONSULTA: '.mysqli_error($conn));
                      $datrol=mysqli_fetch_array($restrol);
                      $descmat=$datrol[0];
                      mysqli_free_result($restrol);
                      return $descmat;
                    }
                  @endphp
                  @foreach ($productosrecepcion as $productorecepcion)
                  <tr><th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ traematerial($productorecepcion->producto_id) }}</td>
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
                      <a href="" wire:click.prevent="edit({{ $productorecepcion }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="confirmUserRemoval({{ $productorecepcion->id }})"><i class="fa fa-trash text-danger"></i></a>
                      @php 
                        if ($productorecepcion->operacion=="RESTA") {
                            $acumulado=$acumulado-$productorecepcion->cantidadprorecmat;
                            $pesodisponible=$pesodisponible+$acumulado;
                            $pesodisponiblec=$pesodisponible;
                            $acumuladoc=$acumulado;
                        }if ($productorecepcion->operacion=="SUMA") {
                            $acumulado=$acumulado+$productorecepcion->cantidadprorecmat;
                            $pesodisponible=$pesodisponible-$acumulado;
                            $pesodisponiblec=$pesodisponible;
                            $acumuladoc=$acumulado;
                        }
                      @endphp
                  </td></tr>@endforeach</tbody>
                  <tfoot><tr><td colspan="2">
                    <label>TOTAL</label></td>
                    <td><label><h1 style="font-weight:900; color:red" id="pesocalculado">{{ $acumulado }}</h1><input style="border:0 font-weight: 900" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/></label></td><td></td></tr>
                      <tr><td colspan="2">
                        <label for="pesodisponible" style="width: 30%">FALTA</label></td><td><label>
                          <h1 style="font-weight:900; color:red" id="pesocalculado">{{ $pesodisponible }}</h1>
                          {{-- <input disabled wire:model="pesodisponible" style="width: 100%" id="pesodisponible" class="form-control" type="text" name="pesodisponible"> --}}</label>
                      </td></tr>
                  </tfoot>
              </table>
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
          <div class="modal-header" style="background: #3f7819;">
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