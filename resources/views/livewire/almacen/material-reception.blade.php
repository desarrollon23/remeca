<div class="pt-1">
  <div class="card-header"><h3 class="card-title">RECEPCION DE MATERIAL</h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title"><label class="d-flex justify-content-center">FECHA: {{ date('d-m-Y') }}   |   # DE CIERRE {{$recepcionmaterial_id}}</label></h3>
            </div>
            <div class="card-body">
                
              <div class="form-group">
                <label for="cedula" style="width: 30%">Cédula</label><label>
                  <div class="input-group mb-3" style="width: 80%"> 
                    <input wire:model="cedula" id="cedula" type="text" class="form-control" placeholder="Ingrese la Cédula" name="cedula">
                    <div class="input-group-prepend">
                        <button  wire:click.prevent="buspro(cedula)" type="button" class="btn btn-danger">Buscar</button>
                      </div>
                      @error('cedula')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                  </div>
                </label>
                <label for="nombre" style="width: 30%">Nombre</label><label>
                <input wire:model="nombre" style="width: 100%" id="nombre" class="form-control" type="text" name="nombre" >@error('nombre')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror</label>
                <label for="idlugar" style="width: 30%">Lugar</label><label>
                <select name="idlugar" wire:model="idlugar" id="idlugar" class="form-control">
                  <option value="NULL" selected style="width: 100%">(SELECCIONE UN LUGAR)</option>
                  @foreach ($lugares as $lugar)
                    <option value="{{$lugar->id}}">{{$lugar->descripcion}}</option>
                  @endforeach
                </select></label>
                <label for="pesofull" style="width: 30%">Peso FULL</label><label>
                <input wire:model="pesofull" wire:keyup="calpeso" style="width: 100%" id="pesofull" class="form-control" type="text" name="pesofull" placeholder="Ingrese Peso FULL"></label>
                <label for="pesovacio" style="width: 30%">Peso VACIO</label><label>
                <input wire:model="pesovacio" wire:keyup="calpeso" style="width: 100%" id="pesovacio" class="form-control" type="text" name="pesovacio" placeholder="Ingrese Peso VACIO"></label>
                <label for="pesoneto" style="width: 30%">Peso NETO</label><label>
                <input disabled wire:model="pesoneto" style="width: 100%" wire:model="pesoneto" id="pesoneto" class="form-control" type="text" name="pesoneto" placeholder="Ingrese Peso NETO"></label>
                <label for="Observaciones">Observaciones</label>
                <textarea rows="2" class="form-control" id="exampleFormControlTextarea1" placeholder="Ingrese las Observaciones"></textarea><br>
                <div class="d-flex justify-content-center mb-3">
                <button wire:click="default" class="btn btn-secondary mb-3"><i class="fa fa-times mr-1"></i> CANCELAR</button>
                @if ($accionrecmat == "confirmar")
                    <button wire:click="confirmar" class="d-flex btn btn-primary mb-3"><i class="fa fa-save mr-1"></i> GUARDAR</button>                   
                @else
                    <button wire:click="guardar" class="d-flex btn btn-primary mb-3"><i class="fa fa-save mr-1"></i> GENERAR</button>
                @endif
                {{-- <button wire:click="guardar"{{--  wire:click.prevent="addNew" --} } class="btn btn-primary "><i class="fa fa-save mr-1 pt-1"></i> GUARDAR</button> --}}
                </div>
              </div>
            </div>
          </div>
        </div>{{-- Lista de Materiales a Recibir --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card card-success">
            <div class="card-header"><h3 class="card-title"><label>Lista de Materiales a Recibir</label></h3></div>
            <div class="card-body">
              <div class="d-flex justify-content-end mb-2">
                  <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Agregar Material a la lista</button>
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
                  @foreach ($materiales as $material)
                  <tr><th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ traematerial($material->producto_id) }}</td>
                    <td>{{ $material->cantidadprorecmat }}</td>
                    <td>
                    @php 
                        if ($material->operacion=="RESTA") {
                            echo '<a><i class="fas fa-minus text-danger"></i></a>';
                        }if ($material->operacion=="SUMA") {
                            echo '<a><i class="color danger fas fa-plus text-success"></i></a>';
                     }@endphp
                    </td>
                    <td>
                      <a href="" wire:click.prevent="edit({{ $material }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="confirmUserRemoval({{ $material->id }})"><i class="fa fa-trash text-danger"></i></a>
                      @php 
                        if ($material->operacion=="RESTA") {
                            $acumulado=$acumulado-$material->cantidadprorecmat;
                        }if ($material->operacion=="SUMA") {
                            $acumulado=$acumulado+$material->cantidadprorecmat;}
                      @endphp
                  </td></tr>@endforeach</tbody>
                  <tfoot><tr><td colspan="2">
                    <label>TOTAL</label></td>
                    <td><label><h1 style="font-weight:900; color:red" id="pesocalculado">{{ $acumulado }}</h1><input style="border:0 font-weight: 900" type="hidden" id="pesocalculado" value="{{ $acumulado }}" disabled/></label></td><td></td></tr>
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
      <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              @if ($showEditModal)
                <span>Editar Material</span>
              @else
                <span>Nuevo Material</span>
              @endif
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                
                <label><input wire:model="recepcionmaterial_id" style="width: 100%" id="recepcionmaterial_id" class="form-control" type="hidden" name="recepcionmaterial_id" placeholder="Ingrese Peso NETO"></label>

                <label for="exampleInputEmail1">Material</label>
                <select name="idproducto" wire:model.defer="state.producto_id" id="idproducto" placeholder="Ingrese el Nombre">
                  <option value="NULL" selected>(SELECCIONE UN MATERIAL)</option>
                  @foreach ($productos as $producto)
                    <option value="{{$producto->id}}">{{$producto->descripcion}}</option>
                  @endforeach
                 </select>
            </div>              
            <div class="form-group">
              <label for="cantidadprorecmat">Cantidad</label>
              <input type="text" wire:model.defer="state.cantidadprorecmat" class="form-control" id="cantidadprorecmat" aria-describedby="cantidadprorecmatHelp" placeholder="Ingrese la cantidad">
              @error('cantidadprorecmat') <div class="invalid-feedback">{{ $message }}</div>@enderror
              <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Material</label>
              <select name="operacion" wire:model.defer="state.operacion" id="operacion" placeholder="SELECCIONE LA OPERACION">
                <option value="SUMA" selected >SUMA</option><option value="RESTA">RESTA</option>
              </select>
              @error('operacion') <div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
            @if ($showEditModal)
              <span>Guardar Cambios</span>
            @else
              <span>Guardar</span>
            @endif
          </button>
          </div>
        </div>
      </form>
    </div>
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
