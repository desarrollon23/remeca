<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
    <div class="card-header"><h3 class="card-title">MANTENIMIENTO DE CLIENTES</h3></div>
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-4 col-md-4 col-xs-4 mt-2">
            <div class="card">
              <div class="card-header" @php echo $fondoo; @endphp>
                <h3 class="card-title" style="color: #fff; margin-right: 2px;">
                  <label class="d-flex justify-content-center">Cliente</label></h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="cedulac" style="width: 30%">Cédula</label>{{-- <label> --}}
                    <input wire:model="cedulac" style="width: 100%; text-transform: uppercase;" id="cedulac" type="text" class="form-control" placeholder="Ingrese la Cédula" name="cedulac">
                    @error('cedulac')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                  <label for="nombrec" style="width: 30%">Nombre</label>
                    <input wire:model="nombrec" style="width: 100%; text-transform: uppercase;" id="nombrec" class="form-control" type="text" placeholder="Ingrese el Número de Nombre" name="nombrec">
                    @error('nombrec')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror
                  <label for="direccionc" style="width: 30%">Dirección</label>
                    <input wire:model="direccionc" style="width: 100%; text-transform: uppercase;" id="direccionc" type="text" class="form-control" placeholder="Ingrese la Dirección" name="direccionc">
                    @error('direccionc')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                  <label for="telefonoc" style="width: 30%">Teléfono</label>
                    <input wire:model="telefonoc" style="width: 100%; text-transform: uppercase;" id="telefonoc" class="form-control" type="tel" {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}} placeholder="Ingrese el Número de Teléfono" name="telefonoc">
                    @error('telefonoc')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror
                  <label for="correoc" style="width: 30%">Correo</label>
                    <input wire:model="correoc" style="width: 100%" id="correoc" class="form-control" type="email" placeholder="INGRESE EL CORREO" name="correoc">@error('correoc')<p class="text-x text-red-500 alic">{{$message}}</p>
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
              <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff; margin-right: 2px;"><label>Lista de Clientes</label></h3></div>
              <div class="card-body">
                @if ($clientes->count())
                <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                      <th scope="col">#</th>
                      <th scope="col">Cédula</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Dirección</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Correo</th>
                      <th scope="col"></th>
                    </tr></thead><tbody>
                    @foreach ($clientes as $cliente)<tr class="hover:bg-green-200">
                      <td class="px-1 py-1">{{$cliente->id}}</td>
                          <td class="px-1 py-1">{{$cliente->cedulac}}</td>
                          <td class="px-1 py-1">{{$cliente->nombrec}}</td>
                          <td class="px-1 py-1">{{$cliente->direccionc}}</td>
                          <td class="px-1 py-1">{{$cliente->telefonoc}}</td>
                          <td class="px-1 py-1">{{$cliente->correoc}}</td>
                          <td class="px-1 py-1">
                        <a href="" wire:click.prevent="edit({{ $cliente }})"><i class="fa fa-edit mr-2"></i></a>
                        <a href="" wire:click.prevent="{{-- confirmUserRemoval({{ $cliente->id }}) --}}destroy({{ $cliente->id }})"><i class="fa fa-trash text-danger"></i></a>
                      </td></tr>
                    @endforeach</tbody>
                </table> 
                @else
                    {{ "No existen Clientes para mostrar" }}
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
