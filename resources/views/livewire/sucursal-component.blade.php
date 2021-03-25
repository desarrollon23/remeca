<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">MANTENIMIENTO DE SUCURSALES</h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card card-primary">
            <div class="card-header" @php echo $fondoo; @endphp>
              <h3 class="card-title">
                <label class="d-flex justify-content-center">Sucursal</label></h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="descripcion" style="width: 30%">Descripción</label>{{-- <label> --}}
                  <div class="input-group mb-3" style="width: 100%"> 
                    <input wire:model="descripcion" id="descripcion" type="text" class="form-control" placeholder="Ingrese la Descripción" name="descripcion" style="text-transform: uppercase;"></div>
                    @error('descripcion')<p ass="text-x text-red-500 italic">{{$message}}</p>@enderror
                {{-- </label> --}}
                <label for="direccion" style="width: 30%">Dirección</label>{{-- <label> --}}
                <input wire:model="direccion" id="direccion" class="form-control" type="text" placeholder="Ingrese la Dirección" name="direccion" style="text-transform: uppercase;">@error('direccion')<p class="text-x text-red-500 alic">{{$message}}</p>@enderror{{-- </label> --}}
                <div class="d-flex justify-content-center mb-2">
                {{-- <button wire:click="default" class="btn btn-secondary mb-2"><i class="fa fa-times mr-1"></i> CANCELAR</button> --}}
                @if ($accion == "store")
                  <button wire:click="store" class="btn btn-primary mb-2"><i class="fa fa-save mr-1"></i>Crear</button>
                @else
                  <button wire:click="update" class="btn btn-primary mb-2"><i class="fa fa-save mr-1"></i>Modificar</button>
                  <button wire:click="default" class="btn btn-secondary mb-2"><i class="fa fa-times mr-1"></i>Cancelar</button>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>{{-- Lista de Sucursales --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card card-primary">
            <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title"><label>Lista de Sucursales</label></h3></div>
            <div class="card-body">
              @if ($sucursales->count())
              <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Opciones</th>
                  </tr></thead><tbody>
                  @foreach ($sucursales as $sucursal)
                  <tr class="hover:bg-green-200">
                    <th scope="row">{{ $sucursal->id }}</th>
                    <td>{{ $sucursal->descripcion }}</td>
                    <td>{{ $sucursal->direccion }}</td>
                    <td>
                      <a href="" wire:click.prevent="edit({{ $sucursal }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="{{-- confirmUserRemoval({{ $sucursal->id }}) --}}destroy({{ $sucursal->id }})"><i class="fa fa-trash text-danger"></i></a>
                    </td></tr>
                  @endforeach</tbody>
              </table>    
              @else
                  {{ "No existen Sucursales para mostrar" }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>{{-- ELIMINAR MATERIAL --}}
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
