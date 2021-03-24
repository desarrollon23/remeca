<div class="pt-1">@php $fondoo='style="background: #336699;"'; @endphp
  <div class="card-header"><h3 class="card-title">MANTENIMIENTO DE MATERIALES</h3></div>
  <div class="content">
    <div class="container-fluid">
      <div class="row aling: center">
        <div class="col-lg-5 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp>
              <h3 class="card-title" style="color: #fff;">
                <label class="d-flex justify-content-center">Material</label></h3>
            </div>
            <div class="card-body">              
                <div class="input-group mb-3"> 
                  <label for="descripcion" style="width: 30%">Descripción</label>                
                  <input wire:model="descripcion" style="width: 100%" id="descripcion" class="form-control" type="text" placeholder="Ingrese la Descripción" name="descripcion">@error('descripcion')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                  <label for="precio" style="width: 30%">Precio</label>
                  <input wire:model="precio" style="width: 100%" id="precio" class="form-control" type="text" placeholder="Ingrese El Precio" name="precio">@error('precio')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                  <label for="cantidad" style="width: 30%">Cantidad</label>
                  <input wire:model="cantidad" style="width: 100%" id="cantidad" class="form-control" type="text" placeholder="Ingrese El Cantidad" name="cantidad">@error('cantidad')<p class="text-x text-red-500 italic">{{$message}}</p>@enderror
                </div>
                  <div class="d-flex justify-content-center mt-2">
                    {{-- <button wire:click="default" class="btn btn-secondary mb-3"><i class="fa fa-times mr-1"></i> CANCELAR</button> --}}
                    @if ($accion == "store")
                      <button wire:click="store" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Crear</button>
                    @else
                      <button wire:click="update" class="btn btn-primary mt-2"><i class="fa fa-save mr-1"></i>Modificar</button>
                      <button wire:click="default" class="btn btn-secondary mt-2"><i class="fa fa-times mr-1"></i>Cancelar</button>
                    @endif
                  {{-- </div> --}}
                {{-- </div> --}}
              </div>
            </div>
          </div>
        </div>{{-- Lista de Materiales a Recibir --}}
        <div class="col-lg-7 col-md-6 col-xs-6 mt-2">
          <div class="card">
            <div class="card-header" @php echo $fondoo; @endphp><h3 class="card-title" style="color: #fff;"><label class="d-flex justify-content-center">Lista de Materiales</label></h3></div>
            <div class="card-body">
              <table id="#example1" class="table table-bordered table-striped"{{-- class="table table-striped" --}}><thead><tr> 
                    <th scope="col">#</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col"></th>
                  </tr></thead><tbody>
                  @foreach ($productos as $producto)<tr class="hover:bg-green-200">
                    <td scope="row" class="px-1 py-1">{{$producto->id}}</td>
                    <td class="px-1 py-1">{{$producto->descripcion}}</td>
                    <td class="px-1 py-1">{{$producto->precio}}</td>
                    <td class="px-1 py-1">{{$producto->cantidad}}</td>
                    <td class="px-1 py-1">
                      <a href="" wire:click.prevent="edit({{ $producto }})"><i class="fa fa-edit mr-2"></i></a>
                      <a href="" wire:click.prevent="{{-- confirmUserRemoval({{ $producto->id }}) --}}destroy({{ $producto->id }})"><i class="fa fa-trash text-danger"></i></a>
                    </td></tr>
                  @endforeach</tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>{{-- ELIMINAR MATERIAL --}}
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5>Eliminar Material</h5></div>
        <div class="modal-body"><h4>¿Está seguro de Eliminar el Material?</h4></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>No Cancelar</button>
          <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Sí Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</div>
