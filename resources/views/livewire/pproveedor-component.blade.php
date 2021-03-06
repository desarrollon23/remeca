<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">MANTENIMIENTO DE PROVEEDORES</h3></div>
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-12 col-md-4 col-xs-4 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp>
              <h3 class="card-title" style="color: #fff; margin-right: 2px;">
                <label class="d-flex justify-content-center">Proveedores</label></h3>
            </div>
            <div class="card-body" style="display: flex; flex-wrap: wrap; margin-right: 2px;">
              <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                <div style="width: 24%; margin-right: 2px;">
                  <label for="cedula" style="width: 100%;">Cédula
                  <input {{-- x-bind:disabled="false" @endif --}} wire:model="cedula" style="width: 100%; text-transform: uppercase;" id="cedula" type="text"{{--  class="form-control" --}} placeholder="Ingrese la Cédula" name="cedula">
                  @error('cedula')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                </div>
                <div style="width: 24%; margin-right: 2px;">
                  <label for="nombre" style="width: 100%;">Nombre
                  <input {{-- x-bind:disabled="false" @endif --}} wire:model="nombre" style="width: 100%; text-transform: uppercase;" id="nombre"{{--  class="form-control" --}} type="text" placeholder="Ingrese el Número de Nombre" name="nombre">
                  @error('nombre')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror</label>
                </div>
                <div style="width: 24%; margin-right: 2px;">
                <label for="direccion" style="width: 100%;">Dirección
                  <input {{-- x-bind:disabled="false" @endif --}} wire:model="direccion" style="width: 100%; text-transform: uppercase;" id="direccion" type="text"{{--  class="form-control" --}} placeholder="Ingrese la Dirección" name="direccion">
                  @error('direccion')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror</label>
                </div>
                <div style="width: 24%; margin-right: 2px;">
                  <label for="telefono" style="width: 100%;">Teléfono
                  <input {{-- x-bind:disabled="false" @endif --}} wire:model="telefono" style="width: 100%; text-transform: uppercase;" id="telefono"{{--  class="form-control" --}} type="tel" placeholder="Ingrese el Número de Teléfono" name="telefono">
                  @error('telefono')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror</label>
                </div>
                <div style="width: 24%; margin-right: 2px;">
                <label for="correo" style="width: 100%">Correo
                  <input {{-- x-bind:disabled="false" @endif --}} wire:model="correo" style="width: 100%" id="correo"{{--  class="form-control" --}} type="email" placeholder="INGRESE EL CORREO" name="correo">@error('correo')<p class="text-x text-red-500 alic">{{$message}}</p>
                  @enderror</label>
                </div>
                <div class="d-flex justify-content-center mt-2">
                  @if ($accion == "store")
                    <button {{--   x-bind:disabled="false" @end --}}if wire:click="store" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Crear</button>
                  @else
                    <button wire:click="update" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Modificar</button>
                    <button wire:click="default" class="btn btn-secondary mt-2"><i class="fa fa-times mr-1"></i>Cancelar</button>
                  @endif
                </div>
              </div>
              <div style="width: 100%; display: flex; flex-wrap: wrap; margin-right: 2px;">
                @if ($this->mostrartraerprecios=="true")
                  @foreach ($productos as $producto)
                    @if ($producto->id>1)
                      <div style="width: 90px; text-align: center; margin-right: 3px;">
                        <label style="width: 100%;">{{$producto->descripcion}}</label>
                        <input type="text" wire:model="p{{$producto->id}}"
                              id="p{{$producto->id}}" name="p{{$producto->id}}" placeholder="Ingresar" size="9" maxlength="9" min="0" max="99999999999" onkeypress="mascara(this,cpf)" onpaste="return false" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width: 100%; /* border-color: white white green white; */ font-weight:900; color:red; padding-top: 0px;">
                      </div>
                    @endif
                  @endforeach
                  <button wire:click="crearprecios" class="btn btn-primary mt-2 formulario-cambiarprecio" style="width: 20%;"><i class="fa fa-save mr-1"></i>Agregar Precios</button>    
                @endif
              </div>
            </div>
          </div>
        </div>{{-- Lista de Proveedores --}}
        <div class="col-lg-12 col-md-6 col-xs-4 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff; margin-right: 2px;"><label>Lista de Proveedores</label></h3></div>
            <div class="card-body">
              {{-- <div class="px-6 py-4">
                {{-- <input type="text" wire:model="buscarproveedor"> --} }
                <x-jet-input class="flex-1" placeholder="Buscar por Cédula, Rif o Nombre" wire:model="buscarproveedor" />
              </div> --}}
              
              @if ($pproveedores->count())
              <table id="example1" class="table table-bordered table-striped">
                <thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($pproveedores as $proveedor)<tr class="hover:bg-green-200">
                    <td>{{$proveedor->id}}</td>
                        <td>{{$proveedor->cedula}}</td>
                        <td>{{$proveedor->nombre}}</td>
                        {{-- <td style="text-align: right;">
                          @livewire('precio-producto', ['proveedor' => $proveedor, 'cedula' => $proveedor->cedula], key($proveedor->id))
                        </td> --}}
                        <td>{{$proveedor->direccion}}</td>
                        <td>{{$proveedor->telefono}}</td>
                        <td>{{$proveedor->correo}}</td>
                        <td>
                      <a href="" wire:click.prevent="edit({{ $proveedor }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="{{-- confirmUserRemoval({{ $proveedor->id }}) --}}destroy({{ $proveedor->id }})"><i class="fa fa-trash text-danger"></i></a>
                    </td></tr>
                    <tr><td colspan="8">
                      <label for="claveactual" style="width: 100%; text-align: center;">Lista de Precios</label>
                      @foreach ($productos as $producto)
                        @if ($producto->id>1)
                          {{-- <div style="width: 100%; text-align: center; margin-right: 3px;"> --}}
                            <label style="width: 130px;">{{$producto->descripcion."= ".
                              traerprecio($proveedor->cedula, $producto->id)}}
                            </label>
                          {{-- </div> --}}
                        @endif
                      @endforeach
                    </td></tr>
                    {{-- <tr>
                      <td class="px-1 py-1" {{-- style="text-align: right;" --} } colspan="8" >
                        {{-- @livewire('precio-producto', ['proveedor' => $proveedor, 'cedula' => $proveedor->cedula], key($proveedor->id)) --} }
                      </td>
                    </tr> --}}
                  @endforeach</tbody>
              </table>
              @else
                  {{ "No existen Proveedores para mostrar" }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  {{-- ELIMINAR MATERIAL --}}
  {{-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5>Eliminar Sucursal</h5></div>
        <div class="modal-body"><h4>¿Está seguro de Eliminar la Sucursal?</h4></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
          <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
        </div>
      </div>
    </div>
  </div> --}}
</div>
