<x-admin-layout>
  <div style="background: white;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            <a href="{{ route('admin.roles.create')}}" class="btn btn-sm btn-secondary float-right">Nuevo Rol</a>
            <h1 class="m-0">Lista de Roles</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    @if (session('info'))
        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
    @endif
    <div class="content">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            {{-- @livewire('admin.users-index') --}}
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead><tr> 
                    {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                    <th scope="row">Id</th>
                    <th scope="col">Nombre</th>
                    {{-- @can('admin.roles.edit') --}}
                    <th scope="col" colspan="2">Opciones</th>
                    {{-- @endcan --}}
                  </tr></thead><tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td width="10px">  
                      {{-- @can('admin.roles.edit') --}}
                      <a href="{{ route('admin.roles.edit', $role)}}" class="btn btn-sm btn-primary">Editar</a>
                      {{-- @endcan --}}
                    </td>
                    <td width="10px">
                      {{-- @can('admin.roles.edit') --}}
                      <form action="{{ route('admin.roles.destroy', $role)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                      </form>
                      {{-- @endcan --}}
                    </td>
                  </tr>@endforeach</tbody>
                </table>
              </div>
              {{-- <div class="card-footer d-flex justify-content-end">
                {{ $users->links() }}
              </div> --}}
            </div>

          </div>
        </div>
      </div>
    </div>
    
  </div>
</x-admin-layout>