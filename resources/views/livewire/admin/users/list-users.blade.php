<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Mantenimiento de Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              {{-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
              </ol> --}}
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
       <!-- Main content -->
    <div class="content"><div class="container-fluid">
          <div class="row"><div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Nuevo Usuario</button>
                </div>
              <div class="card">
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                  {{-- <table class="table table-hover">--}}<thead><tr> 
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Email</th>
                      <th scope="col">Opciones</th>
                    </tr></thead><tbody>
                    @foreach ($users as $user)
                    <tr><th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <a href="" wire:click.prevent="edit({{ $user }})"><i class="fa fa-edit mr-2"></i></a>
                        <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i class="fa fa-trash text-danger"></i></a>
                    </td></tr>@endforeach</tbody>
                  </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  {{-- {{ $users->links() }} --}}
                </div>
              </div></div>
          </div></div>
    </div>

    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                @if ($showEditModal)
                  <span>Editar Usuario</span>
                @else
                  <span>Nuevo Usuario</span>
                @endif
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="name" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="nameHelp" placeholder="Ingrese el Nombre Completo">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small id="nameHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="email">Correo Electrónico</label>
                      <input type="email" wire:model.defer="state.email" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Ingrese el Correo Electrónico">
                      @error('email') <div class="invalid-feedback">{{ $message }}</div>@enderror
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="password">Clave</label>
                      <input type="password" wire:model.defer="state.password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Ingrese la Clave">
                      @error('password') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">Confirmar Clave</label>
                        <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirme la clave">
                    </div>
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
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header"><h5>Eliminar Usuario</h5></div>
          <div class="modal-body"><h4>¿Está seguro de Eliminar el Usuario?</h4></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
              <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Eliminar Usuario</button>
          </div>
        </div>
      </div>
    </div>

</div>
