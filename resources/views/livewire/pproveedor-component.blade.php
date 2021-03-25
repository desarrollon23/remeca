<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">MANTENIMIENTO DE PROVEEDORES</h3></div>
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp>
              <h3 class="card-title" style="color: #fff; margin-right: 2px;">
                <label class="d-flex justify-content-center">Proveedores</label></h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="cedula" style="width: 30%">Cédula</label>{{-- <label> --}}
                  <input wire:model="cedula" style="width: 100%; text-transform: uppercase;" id="cedula" type="text" class="form-control" placeholder="Ingrese la Cédula" name="cedula">
                  @error('cedula')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                <label for="nombre" style="width: 30%">Nombre</label>
                  <input wire:model="nombre" style="width: 100%; text-transform: uppercase;" id="nombre" class="form-control" type="text" placeholder="Ingrese el Número de Nombre" name="nombre">
                  @error('nombre')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror
                <label for="direccion" style="width: 30%">Dirección</label>
                  <input wire:model="direccion" style="width: 100%; text-transform: uppercase;" id="direccion" type="text" class="form-control" placeholder="Ingrese la Dirección" name="direccion">
                  @error('direccion')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                <label for="telefono" style="width: 30%">Teléfono</label>
                  <input wire:model="telefono" style="width: 100%; text-transform: uppercase;" id="telefono" class="form-control" type="tel" placeholder="Ingrese el Número de Teléfono" name="telefono">
                  @error('telefono')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror
                <label for="correo" style="width: 30%">Correo</label>
                  <input wire:model="correo" style="width: 100%" id="correo" class="form-control" type="email" placeholder="INGRESE EL CORREO" name="correo">@error('correo')<p class="text-x text-red-500 alic">{{$message}}</p>
                  @enderror
                <div class="d-flex justify-content-center mt-2">
                {{-- <button wire:click="default" class="btn btn-secondary mb-3"><i class="fa fa-times mr-1"></i> CANCELAR</button> --}}
                @if ($accion == "store")
                  <button wire:click="store" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Crear</button>
                @else
                  <button wire:click="update" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Modificar</button>
                  <button wire:click="default" class="btn btn-secondary mt-2"><i class="fa fa-times mr-1"></i>Cancelar</button>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>{{-- Lista de Proveedores --}}
        <div class="col-lg-8 col-md-6 col-xs-4 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff; margin-right: 2px;"><label>Lista de Proveedores</label></h3></div>
            <div class="card-body">
              @if ($pproveedores->count())
              <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($pproveedores as $proveedor)<tr class="hover:bg-green-200">
                    <td class="px-1 py-1">{{$proveedor->id}}</td>
                        <td class="px-1 py-1">{{$proveedor->cedula}}</td>
                        <td class="px-1 py-1">{{$proveedor->nombre}}</td>
                        <td class="px-1 py-1">{{$proveedor->direccion}}</td>
                        <td class="px-1 py-1">{{$proveedor->telefono}}</td>
                        <td class="px-1 py-1">{{$proveedor->correo}}</td>
                        <td class="px-1 py-1">
                      <a href="" wire:click.prevent="edit({{ $proveedor }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="{{-- confirmUserRemoval({{ $proveedor->id }}) --}}destroy({{ $proveedor->id }})"><i class="fa fa-trash text-danger"></i></a>
                    </td></tr>
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
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
  </div>
</div>
